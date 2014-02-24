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
    $video = SVPBase::getInstance($params['url'], $params);

    try {
        echo $video->thumbnail($params);
    } catch (Exception $e) {
        echo '<!-- ' . $e->getMessage() . ' -->';
    }
}
