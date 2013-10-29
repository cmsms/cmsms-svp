<?php
#-------------------------------------------------------------------------
# Module: SVP - Give the module a YouTube, Vimeo or DailyMotion url and it will give you back a player or thumbnail with desired sizes.
# Version: 0.0.1, Jean-Christophe Cuvelier
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2010 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
# This file originally created by ModuleMaker module, version 0.3.2
# Copyright (c) 2010 by Samuel Goldstein (sjg@cmsmadesimple.org) 
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------

#-------------------------------------------------------------------------
# For Help building modules:
# - Read the Documentation as it becomes available at
#   http://dev.cmsmadesimple.org/
# - Check out the Skeleton Module for a commented example
# - Look at other modules, and learn from the source
# - Check out the forums at http://forums.cmsmadesimple.org
# - Chat with developers on the #cms IRC channel
#-------------------------------------------------------------------------
require_once('libraries/classes/SVPBase.class.php');

class SVP extends CMSModule
{

	function GetName()					{	return 'SVP';							}
	function GetFriendlyName()			{	return $this->Lang('friendlyname');		}
	function GetVersion()				{	return '0.1.8';							}
	function GetHelp()					{	return $this->Lang('help');				}
	function GetAuthor()				{	return 'Jean-Christophe Cuvelier';		}
	function GetAuthorEmail()			{	return 'jcc@morris-chapman.com';		}
	function GetChangeLog()				{	return $this->Lang('changelog');		}
	function IsPluginModule()			{	return true;							}
	function HasAdmin()					{	return true;							}
	function GetAdminSection()			{	return 'extensions';					}
	function GetAdminDescription()		{	return $this->Lang('admindescription');	}
	function VisibleToAdminUser()		{   return $this->CheckAccess();					}
	function CheckAccess($perm = '')	{	return $this->CheckPermission($perm);	}
	
    function DisplayErrorPage($id, &$params, $return_id, $message='')
    {
		$this->smarty->assign('title_error', $this->Lang('error'));
		$this->smarty->assign_by_ref('message', $message);

        // Display the populated template
        echo $this->ProcessTemplate('error.tpl');
    }

	function GetDependencies()			{	return array();	}
	function MinimumCMSVersion()		{	return "1.6";	}

	/*
	function MaximumCMSVersion()
	{
		return "";
	}
	*/

	function InstallPostMessage()		{	return $this->Lang('postinstall');	}
	function UninstallPostMessage()		{	return $this->Lang('postuninstall');	}
	function UninstallPreMessage()		{	return $this->Lang('really_uninstall');	}
	function SetParameters()			{   $this->RegisterModulePlugin();	}
}

?>
