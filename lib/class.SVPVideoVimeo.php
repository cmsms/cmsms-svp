<?php

class SVPVideoVimeo extends SVPVideo
{
    protected $video_id;

    public function player()
    {
        $oembed = $this->getVimeoXml();
        return html_entity_decode($oembed->html);
    }

    public function embedUrl()
    {
        $video = $this->getVimeoXml();
        if(isset($video->video_id))
        {
            $url = 'http://player.vimeo.com/video/' . $video->video_id;

            if($this->modestbranding)   $url .= '?' . http_build_query(array('badge' => 0, 'title' => 0, 'byline' => 0));

            return $url;
        }
        else
        {
            throw new Exception('No VIDEO ID Found for VIMEO! (url: ' . $this->url .')');
        }
    }

    public function thumbnail($params = array())
    {
        $oembed = $this->getVimeoXml();
        return html_entity_decode($oembed->thumbnail_url);
    }

    private function getVimeoXml()
    {
        $oembed_endpoint = 'http://vimeo.com/api/oembed.xml';

        $url_params = array('url' => $this->url);

        if(!empty($this->width))    $url_params['maxwidth'] = $this->width;
        if(!empty($this->height))   $url_params['maxheight'] = $this->height;

        $oembed_endpoint .= '?' . http_build_query($url_params);

        // Curl helper function
        $curl = curl_init($oembed_endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        $return = curl_exec($curl);
        curl_close($curl);

        // Load in the oEmbed XML
        return simplexml_load_string($return);
    }
}