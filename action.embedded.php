<?php
if (!cmsms()) exit;

if (isset($params['url']))
{
    $video = SVPBase::getInstance($params['url'], $params);

    $video->setWidth('100%');
    $video->setHeight('100%');

    try {
        echo $video->player();
    } catch (Exception $e) {
        echo '<!-- ' . $e->getMessage() . ' -->';
    }
}
