<?php
/**
 *
 *
 * copyright: 2013 jalal @ gnomedia
 * license: MIT License, see LICENSE file
 */

namespace WQFlickr;

/**
*
*/
class Photo
{
  private $id;
  private $secret;
  private $server;
  private $farm;
  private $title;
  private $isprimary;
  private $basic_url = 'http://farm%d.staticflickr.com/%s/%s_%s_%s.jpg';

  public function __construct($data)
  {
    $this->id = $data['id'];
    $this->secret = $data['secret'];
    $this->server = $data['server'];
    $this->farm = $data['farm'];
    $this->title = $data['title'];
    $this->isprimary = $data['isprimary'];
  }

  public function setSrc($value='')
  {
    $this->src = $value;
  }

  public function setOrig($value='')
  {
    $this->orig = $value;
  }

  public function getSrc($size='t')
  {
    return sprintf($this->basic_url, $this->farm, $this->server, $this->id, $this->secret, $size);
  }

  public function getTitle()
  {
    return $this->title;
  }
}
