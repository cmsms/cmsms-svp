<?php

class SVPVideoFacebook extends SVPVideo
{
    public function player()
    {
        parse_str(parse_url($this->url, PHP_URL_QUERY), $vars);
        if (isset($vars['v'])) {
            $embed = 'http://www.facebook.com/v/' . $vars['v'];
            return $this->makeFlashObject($embed);
        }
    }

    public function thumbnail($params = array())
    {
        throw new Exception('Thumbnails not implemented for Facebook');
    }

    public function embedUrl()
    {
        throw new Exception('Thumbnails not implemented for Facebook');
    }
}