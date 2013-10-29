<?php

class SVPVideo
{

    protected $url;
    protected $width = 425;
    protected $height = 344;
    protected $modestbranding = false;
    protected $wmode = 'opaque';

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function setModestBranding($active = false)
    {
        $this->modestbranding = $active;
    }

    public function setWmode($wmode)
    {
        $this->wmode = $wmode;
    }

    /**
     * Generate the player code
     * @return string
     */
    public function player()
    {
        return '<video width="' . $this->width . '" height="' . $this->height . '" controls>' . $this->getSource() . '</video>';
    }

    /**
     * Generate an url for embedding
     * @return string
     */
    public function embedUrl()
    {
        /** @var SVP $svp */
        $svp = cms_utils::get_module('SVP');
        global $id;
        return $svp->create_url($id, 'embedded', '', array('url' => $this->url), false, true);
    }

    /**
     * Generate the thumbnail
     * @param array $params
     * @throws Exception
     */
    public function thumbnail($params = array())
    {
        throw new Exception('Thumbnails not implemented');
    }

    private function getSource()
    {
        if (strpos($this->url, '.swf') !== FALSE) {
            return '<object data="' . $this->url . '" width="' . $this->width . '" height="' . $this->height . '"><embed src="' . $this->url . '" width="' . $this->width . '" height="' . $this->height . '"></object>';
        } elseif (strpos($this->url, '.mp4') !== FALSE) {
            return '<source src="' . $this->url . '" type="video/mp4">';
        } elseif (strpos($this->url, '.ogg') !== FALSE) {
            return '<source src="' . $this->url . '" type="video/ogg">';
        } elseif (strpos($this->url, '.webm') !== FALSE) {
            return '<source src="' . $this->url . '" type="video/webm">';
        } else {
            return '<source src="' . $this->url . '">';
        }
    }

    /**
     * Include a flash player object
     * @param $url
     * @return string
     */
    public function makeFlashObject($url)
    {
        return '
	<object width="' . $this->width . '" height="' . $this->height . '">
			<param name="movie" value="' . $url . '" />
			<param name="allowFullScreen" value="true" />
			<param name="allowscriptaccess" value="always" />
			<params name="wmode" value="' . $this->wmode . '" />
			<embed type="application/x-shockwave-flash" width="' . $this->width . '" height="' . $this->height . '" wmode="' . $this->wmode . '" src="' . $url . '" allowscriptaccess="always" allowfullscreen="true"></embed>
	</object>
	';
    }
}