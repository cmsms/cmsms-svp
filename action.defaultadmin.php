<?php
if (!isset($gCms)) exit;

if (! $this->CheckAccess())
	{
	return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
	}

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for SVP "defaultadmin" admin action
   
   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
   Typically, this will display something from a template
   or do some other task.
   
*/


?>
<p>Player: YouTube, Vimeo and Dailymotion are supported.</p>
<p>Thumbnails: Currently only YouTube and Vimeo are supported. Dailymotion to come later.</p>