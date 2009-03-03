<?php
/**
 * Manages the global variables for the context of the page.
 * Applications utilizing this file: Vanilla;
 *
 * Copyright 2003 Mark O'Sullivan
 * This file is part of Lussumo's Software Library.
 * Lussumo's Software Library is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
 * Lussumo's Software Library is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with Vanilla; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 * The latest source code is available at www.lussumo.com
 * Contact Mark O'Sullivan at mark [at] lussumo [dot] com
 *
 * @author Mark O'Sullivan
 * @copyright 2003 Mark O'Sullivan
 * @license http://lussumo.com/community/gpl.txt GPL 2
 * @package Framework
 * @version 1.1.3
 */

/**
 * Manages the global variables for the context of the page.
 * @package Framework
 */
class Context {
	/**
	 * @var Authenticator
	 */
	var $Authenticator;

	/**
	 * @var PeopleSession
	 */
	var $Session;

	/**
	 * @var Database An implimentation of the Database interface
	 */
	var $Database;

	/**
	 * @var MessageCollector Used to collect and display warning message
	 */
	var $WarningCollector;

	/**
	 * @var ErrorManager Used to collect and display fatal error
	 */
	var $ErrorManager;

	/**
	 * @var MessageCollector Collect sql request to display for debugging
	 */
	var $SqlCollector;

	/**
	 * @var ObjectFactory Create object (and load the class - file - for you
	 * @link http://lussumo.com/docs/doku.php?id=vanilla:development:objectfactory
	 */
	var $ObjectFactory;

	/**
	 * @var string Url of the current page (this should be hard-coded by each page since php server vars are unreliable)
	 */
	var $SelfUrl;

	/**
	 * @var string Url to the style folder
	 */
	var $StyleUrl;

	/**
	 * @var string Current Mode ( Debug, Release, etc...)
	 */
	var $Mode;

	/**
	 * @var string Body tag attributes - used by themes/head.php.
	 */
	var $BodyAttributes;

	/**
	 * @var string Title of the page; used for the title tag.
	 */
	var $PageTitle;

	/**
	 * @var StringManipulator
	 */
	var $StringManipulator;

	/**
	 * @var array
	 */
	var $Dictionary;

	/**
	 * @var array
	 */
	var $Configuration;

	/**
	 * @var array
	 */
	var $DelegateCollection;

	/**
	 * @var array Map the table references to the forum table names (minus the table prefix).
	 */
	var $DatabaseTables;

	/**
	 * @var array Map the column ceferences to the forum Column names.
	 */
	var $DatabaseColumns;

	/**
	 * @var array An associative array of variables that can be passed down through the context object into various parts of the application
	 */
	var $PassThruVars;

	/**
	 * Add a function to a delegation
	 * @param string $ClassName
	 * @param string $DelegateName
	 * @param string $FunctionName
	 * @return void
	 * @link http://lussumo.com/docs/doku.php?id=vanilla:development:delegation
	 */
	function AddToDelegate($ClassName, $DelegateName, $FunctionName) {
		if (!array_key_exists($ClassName, $this->DelegateCollection)) $this->DelegateCollection[$ClassName] = array();
		if (!array_key_exists($DelegateName, $this->DelegateCollection[$ClassName])) $this->DelegateCollection[$ClassName][$DelegateName] = array();
		$this->DelegateCollection[$ClassName][$DelegateName][] = $FunctionName;
	}

	/**
	 * Constructor.
	 * @param array &$Configuration
	 * @return void
	 */
	function Context(&$Configuration) {
		$this->Configuration = &$Configuration;
		$this->BodyAttributes = '';
		$this->StyleUrl = '';
		$this->PageTitle = '';
		$this->Dictionary = array();
		$this->DelegateCollection = array();
		$this->PassThruVars = array();

		$this->CommentFormats = array();
		$this->CommentFormats[] = 'Text';

		// Create an object factory
		$this->ObjectFactory = new ObjectFactory();

		// Current Mode
		$this->Mode = ForceIncomingCookieString('Mode', '');

		// Url of the current page (this should be hard-coded by each page since php server vars are unreliable)
		$this->SelfUrl = ForceString($Configuration['SELF_URL'], 'index.php');

		// Instantiate a SqlCollector (for debugging)
		$this->SqlCollector = new MessageCollector();
		$this->SqlCollector->CssClass = 'Sql';

		// Instantiate a Warning collector (for user errors)
		$this->WarningCollector = new MessageCollector();

		// Instantiate an Error manager (for fatal errors)
		$this->ErrorManager = new ErrorManager();

		// Instantiate a Database object (for performing database actions)
		$this->Database = new $Configuration['DATABASE_SERVER']($this);

		// Instantiate the string manipulation object
		$this->StringManipulator = new StringManipulator($this->Configuration);
		// Add the plain text manipulator
		$TextFormatter = new TextFormatter();
		$this->StringManipulator->AddManipulator($Configuration['DEFAULT_FORMAT_TYPE'], $TextFormatter);
	}

	/**
	 * Parse a string; mainly used for output filter.
	 * @param string $String
	 * @param mixed $Object Object related to the string in some way
	 * @param string $Format The string-formatter that will parse the string.
	 * @param string $FormatPurpose Use the FORMAT_STRING_FOR_DISPLAY constant.
	 * @return string
	 */
	function FormatString($String, $Object, $Format, $FormatPurpose) {
		$sReturn = $this->StringManipulator->Parse($String, $Object, $Format, $FormatPurpose);
		// Now pass the string through global formatters
		$sReturn = $this->StringManipulator->GlobalParse($sReturn, $Object, $FormatPurpose);
		return $sReturn;
	}

	/**
	 * Get the test associated to code-word in the Dictionary array.
	 * If the entry is missing, it will return the code word.
	 * @link http://lussumo.com/docs/doku.php?id=vanilla:administrators:languages
	 * @param string $Code Code-word
	 * @return string
	 */
	function GetDefinition($Code) {
		if (array_key_exists($Code, $this->Dictionary)) {
			return $this->Dictionary[$Code];
		} else {
			return $Code;
		}
	}

	/**
	 * Should be used in extension to set new definitions.
	 * This way, if a translation exists in the translation file,
	 * the definition in the extension will not override it.
	 * @param string $Code Code-word
	 * @param string $Definition dfeault definition
	 * @return void
	 */
	function SetDefinition($Code, $Definition) {
		if (!array_key_exists($Code, $this->Dictionary)) {
			$this->Dictionary[$Code] = $Definition;
		}
	}

	/**
	 * {@link PeopleSession::Start() Authenticate} user by its session or its "remember me" cookie;
	 * set {@link $Authenticator} and {@link $Session}.
	 * @return void
	 */
	function StartSession() {
		$this->Authenticator = $this->ObjectFactory->NewContextObject($this, 'Authenticator');
		$this->Session = $this->ObjectFactory->NewObject($this, 'PeopleSession');
		$this->Session->Start($this, $this->Authenticator);
		// The style url (as defined by the user session)
		if (@$this->Session->User) {
			$this->StyleUrl = $this->Session->User->StyleUrl;
			// Make sure that the Database object knows what the StyleUrl is
			$this->Database->Context->StyleUrl = $this->StyleUrl;
		}
	}

	/**
	 * Destructor; unset all the properties.
	 */
	function Unload() {
		if ($this->Database) $this->Database->CloseConnection();
		unset($this->Authenticator);
		unset($this->Session);
		unset($this->Database);
		unset($this->WarningCollector);
		unset($this->ErrorManager);
		unset($this->SqlCollector);
		unset($this->SelfUrl);
		unset($this->StyleUrl);
		unset($this->Mode);
		unset($this->BodyAttributes);
		unset($this->PageTitle);
		unset($this->StringManipulator);
		unset($this->Dictionary);
		unset($this->Configuration);
		unset($this->DelegateCollection);
		unset($this->DatabaseTables);
		unset($this->DatabaseColumns);
		unset($this->PassThruVars);
	}
}
?>