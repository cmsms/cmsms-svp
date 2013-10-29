<?php

/* 
	Social Video Player

	copyright: Jean-Christophe Cuvelier - 2010 (cybertotophe@gmail.com)
*/

class SVPBase
{
	/*
		For the moment, it's more like a library rather than a real object...
	*/
	
	// PUBLIC
	
	public static function player ($url, $params = array())
	{
		if (!isset($params['width']))$params['width'] = 425; 
		if (!isset($params['height']))$params['height'] = 344; 
		
		if (strpos($url, 'youtu') !== false)
		{
			return self::YouTubePlayer($url, $params);
		}
		elseif (strpos($url, 'facebook') !== false)
		{
			return self::FacebookPlayer($url, $params);
		}
		elseif (strpos($url, 'vimeo') !== false)
		{
			return self::VimeoPlayer($url, $params);
		}
		elseif (strpos($url, 'dailymotion') !== false)
		{
			return self::DailyMotionPlayer($url, $params);
		}
		else
		{
			return '<!-- UNKNOWN VIDEO SYSTEM: ' . $url . '-->';
		}
	}
	
	public static function embed ($url, $params = array())
	{
	  // Only YouTube supported for the moment
	  if (strpos($url, 'youtu') !== false)
		{
			return self::YouTubeEmbed($url, $params);
		}
		else
		{
			return '<!-- UNKNOWN VIDEO SYSTEM: ' . $url . '-->';
		}
	}
	
	public static function thumbnail($url, $params = array())
	{
		if (strpos($url, 'youtu') !== false)
		{
			return self::YouTubeThumbnail($url, $params);
		}
		elseif (strpos($url, 'vimeo') !== false)
		{
			return self::VimeoThumbnail($url, $params);
		}	
		elseif (strpos($url, 'dailymotion') !== false)
		{
			return self::DailyMotionThumbnail($url, $params);
		}
		else
		{
			return '<!-- UNKNOWN VIDEO SYSTEM: ' . $url . '-->';
		}
	}
	
	
	// PRIVATE
	
	private static function YouTubeEmbed($url, $params = array())
	{
	  $v = self::YouTubeGetVariable($url);
	  if($v)
	  {
	    $urlparams = array('rel' => 0);
	    if(isset($params['modestbranding']))
	    {
	      $urlparams['modestbranding'] = 1;
	    }
      // return 'http://www.youtube.com/embed/'.$v.'?rel=0';
      return 'http://www.youtube.com/embed/'.$v.'?' . http_build_query($urlparams);
	  }
	  else
	  {
	    return null;
	  }
	}
	
	private static function YouTubeGetVariable($url)
	{
		if (strpos($url, 'youtu.be') !== false)
		{
			$vars['v'] = str_replace('/','', (string) parse_url($url, PHP_URL_PATH));
		}
		else
		{
			parse_str(parse_url($url, PHP_URL_QUERY), $vars);
		}
		if(isset($vars['v']))
		{
			return $vars['v'];
		}
		else
		{
			return null; // Can't find code
		}
	}
	
	private static function YouTubePlayer($url, $params = array())
	{
		$width = isset($params['width'])?$params['width']:425;
		$height = isset($params['height'])?$params['height']:344;
		$v = self::YouTubeGetVariable($url);
		if ($v) 
		{
      $embed = 'http://www.youtube.com/v/'.$v;
      
      $urlparams = array();
	    if(isset($params['modestbranding'])) $urlparams['modestbranding'] = 1;
	    if(count($urlparams)) $embed .= '?' . http_build_query($urlparams);
	    
      // $embed = self::YouTubeEmbed($url,$params);
			return self::makeFlashObject($embed, $params);
		}
		return null;
	}	
	
	private static function FacebookPlayer($url, $params = array())
	{
		$width = isset($params['width'])?$params['width']:425;
		$height = isset($params['height'])?$params['height']:344;
		parse_str(parse_url($url, PHP_URL_QUERY), $vars);
		if (isset($vars['v'])) 
		{
			$embed = 'http://www.facebook.com/v/'.$vars['v'];
			return self::makeFlashObject($embed, $params);
		}
		return null;
	}
	
	private static function VimeoPlayer($url, $params = array())
	{
		$oembed = self::getVimeoXml($url, $params);
		return html_entity_decode($oembed->html);
	}
	
	private static function DailyMotionPlayer($url, $params = array())
	{
		$embed = str_replace('dailymotion.com/video', 'dailymotion.com/swf', $url);
		return self::makeFlashObject($embed, $params);
		
	}
	
	private static function makeFlashObject($url, $params = array())
	{
		$width = isset($params['width'])?$params['width']:425;
		$height = isset($params['height'])?$params['height']:344;		
		$wmode = isset($params['wmode'])?$params['wmode']:'opaque';		
		
		$flash = '
	<object width="'.$width.'" height="'.$height.'">
			<param name="movie" value="'.$url.'" />
			<param name="allowFullScreen" value="true" />
			<param name="allowscriptaccess" value="always" />
			<params name="wmode" value="'.$wmode.'" />
			<embed type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'" wmode="'.$wmode.'" src="'.$url.'" allowscriptaccess="always" allowfullscreen="true"></embed>
	</object>
	';
		return $flash;
	}
	
	
	private static function YouTubeThumbnail($url,$params = array())
	{
		$v = self::YouTubeGetVariable($url);
		if ($v) 
		{
		  if(isset($params['version']))
		  {
		    $version = $params['version'];
		  }
		  else
		  {
		    $version = 'hqdefault.jpg';
		  }
			return 'http://i3.ytimg.com/vi/'.$v.'/'.$version;
		}
		return null;
	}
	
	private static function VimeoThumbnail($url, $params = array())
	{
		$oembed = self::getVimeoXml($url, $params);
		return html_entity_decode($oembed->thumbnail_url);
	}

	
	private static function DailyMotionThumbnail($url,$params=array())
	{
		return '<!-- NOT IMPLEMENTED FOR DAILYMOTION YET -->';
		
		//return "TEST" . self::test1($url);
		//return "TEST" . self::getDailyMotionThumbnail($url);
	}
	
	// DailyMotion Specifics
	
	private static function getDailyMotionThumbnail($url)
	{ 
		$embed = str_replace('dailymotion.com/video', 'dailymotion.com/swf', $url);
		
		//Start the Curl session
		$session = curl_init($embed);
		curl_setopt($session, CURLOPT_HEADER, true);
		curl_setopt($session, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9');
		curl_setopt($session, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		// Make the call
		$response = curl_exec($session);
		$error = curl_error($session);
		$header_size = curl_getinfo($session,CURLINFO_HEADER_SIZE);
		$headers = substr($response, 0, $header_size);
		list($header,  $headers) = explode("\n\n",  $headers, 2);
//		var_dump($header);
		$matches = array();
		preg_match('/Location:(.*?)\n/', $header, $matches);
		var_dump($matches);
		$urlInfo = parse_url(trim(array_pop($matches)));
		parse_str($urlInfo['query'], $output);
		return $output['previewURL'];
	}
	
	private static function test1($url)
	{
		$embed = str_replace('dailymotion.com/video', 'dailymotion.com/swf', $url);
		$session = curl_init($embed);
		curl_setopt($session, CURLOPT_HEADER, true);
		curl_setopt($session, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9');
		curl_setopt($session, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		// Make the call
		$response = curl_exec($session);
		$error = curl_error($session);
		$result = array( 'header' => '',
		'body' => '',
		'curl_error' => '',
		'http_code' => '',
		'last_url' => '');
		if ( $error != "" )
		{
		$result['curl_error'] = $error;
		}
		else
		{
		$header_size = curl_getinfo($session,CURLINFO_HEADER_SIZE);
		$result['header'] = substr($response, 0, $header_size);
		$result['body'] = substr( $response, $header_size );
		$result['http_code'] = curl_getinfo($session, CURLINFO_HTTP_CODE);
		$result['last_url'] = curl_getinfo($session, CURLINFO_EFFECTIVE_URL);
		list($header,  $result['header']) = explode("\n\n",  $result['header'], 2);
		var_dump($header);
		$matches = array();
		preg_match('/Location:(.*?)\n/', $header, $matches);
		$urlInfo = parse_url(trim(array_pop($matches)));
		var_dump($urlInfo);
		//$newUrl = $urlInfo['scheme'] . '://' . $urlInfo['host'] . $urlInfo['path'] . ($urlInfo['query']?'?'.$urlInfo['query']:'');
		parse_str($urlInfo['query'], $output);
		$flvURL = $output ['url'];
		$thumbnailURL = $output['previewURL'];
		return $thumbnailURL;
		}
	}
	
	
	// VIMEO SPECIFICS
	
	private static function getVimeoXml($url, $params = array())
	{
		/*
		You may want to use oEmbed discovery instead of hard-coding the oEmbed endpoint.
		*/
		$oembed_endpoint = 'http://www.vimeo.com/api/oembed';

		// Create the URLs
		//	$json_url = $oembed_endpoint.'.json?url='.rawurlencode($url);
		$xml_url = $oembed_endpoint.'.xml?url='.rawurlencode($url);

		if (isset($params['width']))
		{
			$xml_url .= '&maxwidth=' . rawurlencode($params['width']);
		}


		if (isset($params['height']))
		{
			$xml_url .= '&maxheight=' . rawurlencode($params['height']);
		}

		// Curl helper function
			$curl = curl_init($xml_url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			$return = curl_exec($curl);
			curl_close($curl);

		// Load in the oEmbed XML
			return simplexml_load_string($return);
	}
	
}
?>