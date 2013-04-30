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

  public $photos = array();

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
}
