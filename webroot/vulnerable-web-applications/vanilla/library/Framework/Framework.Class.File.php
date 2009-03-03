<?php
/**
 * Description: Handles retrieving and saving files to the filesystem.
 * Applications utilizing this file: Filebrowser;
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
 * Object representation of a file.
 * @package Framework
 */
class File {
	var $Name;
	var $Extension;
	var $Path;					// Directory path to the file
	var $Body;
	var $Size;
}


/**
 * Handles retrieving and saving files to the filesystem.
 * @package Framework
 */
class FileManager {
	var $ErrorManager;
	var $Name;

	function FileExtension($File) {
		if (strstr($File->Name, '.')) {
			return substr(strrchr($File->Name, '.'), 1, strlen($File->Name));
		} else {
			return "";
		}
	}

	function FileManager() {
		$this->Name = "FileManager";
	}

	function FilePath($File) {
		if (substr($File->Path, strlen($File->Path) - 1, strlen($File->Path)) != "/") $File->Path .= "/";
		return $File->Path.$File->Name;
	}

	function Get($File) {
		// Ensure required properties are set
		$FauxContext = 0;
		if ($File->Name == "") $this->ErrorManager->AddError($FauxContext, $this->Name, "Get", "You must supply a file name.", "", 0);
		if ($File->Path == "") $this->ErrorManager->AddError($FauxContext, $this->Name, "Get", "You must supply a file path.", "", 0);
		if ($this->ErrorManager->ErrorCount == 0) {
			$File->Extension = $this->FileExtension($File);
			$FilePath = $this->FilePath($File);
			$FileHandle = @fopen($FilePath, "r");
			if (!$FileHandle) {
				$this->ErrorManager->AddError($FauxContext, $this->Name, "Get", "The file could not be opened.", $FilePath, 0);
			} else {
				$File->Size = filesize($FilePath);
				$File->Body = @fread($FileHandle, $File->Size);
				if (!$File->Body) $this->ErrorManager->AddError($FauxContext, $this->Name, "Get", "The file could not be read.", "", 0);
				@fclose($FileHandle);
			}
		}
		return $this->ErrorManager->Iif($File, false);
	}
}
?>