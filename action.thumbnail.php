<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for SVP "thumbnail" action

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
   Typically, this will display something from a template
   or do some other task.
   
*/


if (isset($params['url']))
{
	$mod_params = array();
	if(isset($params['width']))	{ $mod_params['width'] = $params['width'];}
	if(isset($params['height']))	{ $mod_params['height'] = $params['height'];}
	if(isset($params['version']))	{ $mod_params['version'] = $params['version'];}
	
	echo SVPBase::thumbnail($params['url'], $mod_params);
}
