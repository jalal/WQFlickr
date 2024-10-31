<?php
/**
 *
 *
 * copyright: 2013 jalal @ gnomedia
 * license: MIT License, see LICENSE file
 */

namespace WQFlickr;

require_once 'WQFlickr/Photo.php';

/**
*
*/
class Photoset extends Api
{

  private $photos = array();
  private $title = '';
  private $description = '';
  private $count = '';
  private $created = '';

  function __construct($setid=0, $size='t')
  {
    # api... flickr.photosets.getPhotos
    $params = array('method'=>'flickr.photosets.getPhotos',
                    'photoset_id'=>$setid,
                    'format'=>'php_serial');
    $url = $this->createURL($params);
    $resp = $this->getResponse($url);
    $set = unserialize($resp);
    if (isset($arr['stat']) && $arr['stat'] == 'fail') {
      throw new Exception("Error! Flickr response: " . $arr['message'] . ' (' . $arr['code'] . ')');
    }
    foreach ($set['photoset']['photo'] as $p) {
      $this->photos[] = new Photo($p);
    }
  }

  /**
   * Getter for photos
   *
   * @return mixed
   */
  public function getPhotos()
  {
      return $this->photos;
  }

  /**
   * Setter for photos
   *
   * @param mixed $photos Value to set
   * @return self
   */
  public function setPhotos($photos)
  {
      $this->photos = $photos;
      return $this;
  }


  /**
   * Getter for title
   *
   * @return mixed
   */
  public function getTitle()
  {
      return $this->title;
  }

  /**
   * Setter for title
   *
   * @param mixed $title Value to set
   *
   * @return self
   */
  public function setTitle($title)
  {
      $this->title = $title;
      return $this;
  }

  /**
   * Getter for description
   *
   * @return mixed
   */
  public function getDescription()
  {
      return $this->description;
  }

  /**
   * Setter for description
   *
   * @param mixed $description Value to set
   *
   * @return self
   */
  public function setDescription($description)
  {
      $this->description = $description;
      return $this;
  }

  /**
   * Getter for count
   *
   * @return mixed
   */
  public function getCount()
  {
      return $this->count;
  }

  /**
   * Setter for count
   *
   * @param mixed $count Value to set
   *
   * @return self
   */
  public function setCount($count)
  {
      $this->count = $count;
      return $this;
  }

  /**
   * Getter for created
   *
   * @return mixed
   */
  public function getCreated()
  {
      return $this->created;
  }

  /**
   * Setter for created
   *
   * @param mixed $created Value to set
   * @return self
   */
  public function setCreated($created)
  {
      $this->created = $created;
      return $this;
  }

  /**
   * [getPhoto description]
   *
   * @param  [type] $idx [description]
   * @return [type]      [description]
   */
  public function getPhoto($idx)
  {
      if (count($this->photos) > 0) {
          return $this->photos[$idx];
      }
      return false;
  }

}
