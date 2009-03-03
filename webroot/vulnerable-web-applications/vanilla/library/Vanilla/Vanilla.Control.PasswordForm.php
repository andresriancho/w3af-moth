<?php
/**
 * The PasswordForm control allows users to change their password in Vanilla.
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
 * @package Vanilla
 * @version 1.1.4
 */


/**
 * The PasswordForm control allows users to change their password in Vanilla.
 * @package Vanilla
 */
class PasswordForm extends PostBackControl {
	var $UserManager;
	var $User;

	function PasswordForm (&$Context, &$UserManager, $UserID) {
		$this->Name = 'PasswordForm';
		if ($Context->Configuration['ALLOW_PASSWORD_CHANGE']) $this->ValidActions = array('ProcessPassword', 'Password');
		$this->Constructor($Context);
		if ($this->IsPostBack) {
			$this->UserManager = &$UserManager;
			$this->User = $this->Context->ObjectFactory->NewContextObject($Context, 'User');
			$this->User->GetPropertiesFromForm();
			$this->User->UserID = $UserID;
			if ($this->PostBackAction == 'ProcessPassword' && $this->IsValidFormPostBack()) {
				if ($this->UserManager->ChangePassword($this->User)) {
					$Url = GetUrl($this->Context->Configuration, $this->Context->SelfUrl);
					//@todo: Should the process die here?
					Redirect($Url, '302', '', 0);
				}
			}
		}
		$this->CallDelegate('Constructor');
	}

	function Render() {
		if ($this->IsPostBack) {
			$this->CallDelegate('PreRender');
			include(ThemeFilePath($this->Context->Configuration, 'account_password_form.php'));
			$this->CallDelegate('PostRender');
		}
	}
}
?>