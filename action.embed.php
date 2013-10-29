<?php
if (!cmsms()) exit;

if (isset($params['url']))
{
    $video = SVPBase::getInstance($params['url'], $params);

    try {
        echo $video->embedUrl();
    } catch (Exception $e) {
        echo '<!-- ' . $e->getMessage() . ' -->';
    }
}
