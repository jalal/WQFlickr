<?php
/**
 *
 *
 * copyright: 2013 jalal @ gnomedia
 * license: MIT License, see LICENSE file
 */

namespace WQFlickr;

class Curl
{
  protected $curlh;
  const TIMEOUT_CONNECTION = 10;
  const TIMEOUT_TOTAL = 30;

  public function __construct($url, $params)
  {
    $this->curlh = curl_init();

    // set up the request
    curl_setopt($this->curlh, CURLOPT_URL, $url);
    // make sure we submit this as a post
    // curl_setopt($this->curlh, CURLOPT_POST, true);
    // if (isset($params)) {
    //     curl_setopt($this->curlh, CURLOPT_POSTFIELDS, $params);
    // }else{
    //     curl_setopt($this->curlh, CURLOPT_POSTFIELDS, "");
    // }
    // make sure problems are caught
    curl_setopt($this->curlh, CURLOPT_FAILONERROR, 1);
    // return the output
    curl_setopt($this->curlh, CURLOPT_RETURNTRANSFER, 1);
    // set the timeouts
    curl_setopt($this->curlh, CURLOPT_CONNECTTIMEOUT, self::TIMEOUT_CONNECTION);
    curl_setopt($this->curlh, CURLOPT_TIMEOUT,self::TIMEOUT_TOTAL);
    // set the PHP script's timeout to be greater than CURL's
    set_time_limit(self::TIMEOUT_CONNECTION + self::TIMEOUT_TOTAL + 5);
  }

  public function getResponse()
  {
    $result = curl_exec($this->curlh);
    if ( curl_errno($this->curlh) == 0) {
      curl_close($this->curlh);
      return $result;
    } else {
      $ex = new Exception('Request failed: ' . curl_error($this->curlh));
      curl_close($this->curlh);
      throw $ex;
    }
  }
}
