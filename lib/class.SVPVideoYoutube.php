<?php

    class SVPVideoYoutube extends SVPVideo
    {
        protected $video_id;

        public function player()
        {
            $url = 'http://www.youtube.com/v/' . $this->getVideoId();
            if($this->modestbranding)
            {
                $url .= '?' . http_build_query(array('modestbranding' => 1));
            }

            return $this->makeFlashObject($url);
        }

        /**
         * Generate a YouTube URL for embedding
         * @return string
         */
        public function embedUrl()
        {
            $urlparams = array('rel' => 0);
            if ($this->modestbranding) {
                $urlparams['modestbranding'] = 1;
            }

            return 'http://www.youtube.com/embed/' . $this->getVideoId() . '?' . http_build_query($urlparams);
        }

        public function thumbnail($params = array())
        {
            $version =  (isset($params['version']))?$params['version']:'hqdefault.jpg';
            return 'http://i3.ytimg.com/vi/' . $this->getVideoId() . '/' . $version;
        }

        /**
         * Fetch the video ID
         */
        public function fetchVideoId()
        {
            $this->video_id = self::parseUrl($this->url);
        }

        public function getVideoId()
        {
            if(empty($this->video_id)) $this->fetchVideoId();
            return $this->video_id;
        }

        /**
         * @param $url YouTube URL
         * @return mixed|null Video ID
         */
        private static function parseUrl($url)
        {
            if (strpos($url, 'youtu.be') !== false) {
                $vars['v'] = str_replace('/', '', (string)parse_url($url, PHP_URL_PATH));
            } else {
                parse_str(parse_url($url, PHP_URL_QUERY), $vars);
            }
            if (isset($vars['v'])) {
                return $vars['v'];
            } else {
                return null; // Can't find video ID
            }
        }
    }