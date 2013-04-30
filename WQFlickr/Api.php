<?php
/**
 *
 *
 * copyright: 2013 jalal @ gnomedia
 * license: MIT License, see LICENSE file
 */

namespace WQFlickr;

require_once('WQFlickr/Curl.php');

class Api
{
  const REST_ENDPOINT = "http://api.flickr.com/services/rest/";

  private static $key;
  private static $secret;

  public function __construct($key='', $secret='')
  {
    // key and secret are required
    if (!empty($key)) {
      self::$key = $key;
    } else {
      throw new Exception('Flickr API key is required.');
     }
    if (!empty($secret)) {
      self::$secret = $secret;
    } else {
      throw new Exception('Flickr API secret is required.');
    }
  }
  public function getKey()
  {
    return self::$key;
  }
  public function getSecret()
  {
    return self::$secret;
  }

  public function createURL($params)
  {
    $str = Api::REST_ENDPOINT . '?api_key=' . self::$key;
    if (is_array($params)) {
      foreach ($params as $key => $value) {
        $str .= '&' . $key . '=' . $value;
      }
      // $str = substr($str, 0, -1);
    }
    return $str;
  }
  public function getResponse($url='')
  {
    $c = new Curl($url, array());
    return $c->getResponse();
  }
}
