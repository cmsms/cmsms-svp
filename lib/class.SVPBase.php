<?php

/* 
	Social Video Player

	copyright: Jean-Christophe Cuvelier - 2010 (cybertotophe@gmail.com)
*/

class SVPBase
{
    /**
     * @param $url
     * @param array $params
     * @return SVPVideo|SVPVideoYoutube|SVPVideoFacebook|SVPVideoVimeo|SVPVideoDailymotion
     */
    public static function getInstance($url, $params = array())
    {
        if (strpos($url, 'youtu') !== false) {
            /** @var SVPVideoYoutube $instance */
            $instance = new SVPVideoYoutube($url);
        } elseif (strpos($url, 'facebook') !== false) {
            $instance = new SVPVideoFacebook($url);
        } elseif (strpos($url, 'vimeo') !== false) {
            $instance = new SVPVideoVimeo($url);
        } elseif (strpos($url, 'dailymotion') !== false) {
            $instance = new SVPVideoDailymotion($url);
        } else {
            $instance = new SVPVideo($url);
        }

        if (isset($params['width'])) $instance->setWidth($params['width']);
        if (isset($params['height'])) $instance->setHeight($params['height']);
        if (isset($params['modestbranding'])) $instance->setModestBranding(true);
        if (isset($params['wmode'])) $instance->setWmode($params['wmode']);

        return $instance;
    }

    /**
     * @param $url
     * @param array $params
     * @return null|string
     * @deprecated
     */

    public static function player($url, $params = array())
    {
        $video = self::getInstance($url, $params);

        try {
            return $video->player();
        } catch (Exception $e) {
            echo '<!-- ' . $e->getMessage() . ' -->';
        }
    }

    /**
     * @param $url
     * @param array $params
     * @return null|string
     * @deprecated since 1.0.0
     */
    public static function embed($url, $params = array())
    {
        $video = self::getInstance($url, $params);

        try {
            return $video->embedUrl();
        } catch (Exception $e) {
            echo '<!-- ' . $e->getMessage() . ' -->';
        }
    }

    /**
     * @param $url
     * @param array $params
     * @return string
     * @deprecated since 1.0.0
     */
    public static function thumbnail($url, $params = array())
    {
        $video = self::getInstance($url, $params);

        try {
            return $video->thumbnail();
        } catch (Exception $e) {
            echo '<!-- ' . $e->getMessage() . ' -->';
        }

    }
}

?>