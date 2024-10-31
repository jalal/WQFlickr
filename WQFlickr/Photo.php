<?php
/**
  * THe photo class
  *
  *  @category  API
  *  @package   Flickr
  *  @author    jalal @ gnomedia <jalal@gnomedia.com>
  *  @copyright 2013 jalal @ gnomedia
  *  @license   MIT License, see LICENSE file
  *  @link
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
  private $basic_url = 'https://farm%d.staticflickr.com/%s/%s_%s_%s.jpg';

  /**
   * [__construct description]
   *
   * @param [type] $data [description]
   */
  public function __construct($data)
  {
    $this->id        = $data['id'];
    $this->secret    = $data['secret'];
    $this->server    = $data['server'];
    $this->farm      = $data['farm'];
    $this->title     = $data['title'];
    $this->isprimary = $data['isprimary'];
  }

  /**
   * [setSrc description]
   *
   * @param string $value [description]
   */
  public function setSrc($value='')
  {
    $this->src = $value;
  }

  /**
   * [setOrig description]
   *
   * @param string $value [description]
   */
  public function setOrig($value='')
  {
    $this->orig = $value;
  }

  /**
   * [getSrc description]
   *
   * @param  string $size [description]
   * @return [type]       [description]
   */
  public function getSrc($size='t')
  {
    return sprintf($this->basic_url, $this->farm, $this->server, $this->id, $this->secret, $size);
  }

  /**
   * [getTitle description]
   *
   * @return [type] [description]
   */
  public function getTitle()
  {
    return $this->title;
  }
}
