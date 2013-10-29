<?php
if (!cmsms()) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for SVP "default" action

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
   Typically, this will display something from a template
   or do some other task.
   
*/

if (isset($params['url']))
{
    $video = SVPBase::getInstance($params['url'], $params);

    try {
        echo $video->player();
    } catch (Exception $e) {
        echo '<!-- ' . $e->getMessage() . ' -->';
    }
}
elseif(isset($params['debug']))
{
    echo '<p style="color: red;">URL Not specified!</p>';
}