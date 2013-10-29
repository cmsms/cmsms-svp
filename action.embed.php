<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for SVP "default" action

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
   Typically, this will display something from a template
   or do some other task.
   
*/

if (isset($params['url']))
{
	$mod_params = array();
	
	if(isset($params['modestbranding'])) $mod_params['modestbranding'] = 1;
	
	echo SVPBase::embed($params['url'], $mod_params);
}
