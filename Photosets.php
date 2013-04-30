<?php
/**
 *
 *
 * copyright: 2013 jalal @ gnomedia
 * license: MIT License, see LICENSE file
 */

namespace WQFlickr;

require_once 'WQFlickr/Photoset.php';

class Photosets extends Api
{
  private $user_id;
  private $page=0, $pages=0, $perpage=0, $total=0;
  private $sets = array();

  public function __construct($key='', $secret='', $user_id='')
  {
    $this->user_id = $user_id;
    parent::__construct($key, $secret);
    $this->load();
  }

  public function getList()
  {
    return $this->sets;
  }

/*
   http://farm9.staticflickr.com/8263/8606976248_ef1989b006.jpg
   where:
   '9' is $farm
   8263 is $server
   8606976248 is $pic id
   ef1989b0006 is $secret

   full details here:
   http://www.flickr.com/services/api/misc.urls.html
 */
  public function getFotoset($setid='', $size='t')
  {
    try {
      $photoset = new Photoset($setid, $size);
    } catch (Exception $e) {
      die('Caught exception in getFotoset');
    }
    // print_r($photos);
    return $photoset;
  }

  public function load()
  {
    # code... flickr.photosets.getList
    $params = array('method'=>'flickr.photosets.getList',
                    'user_id'=>$this->user_id,
                    'format'=>'php_serial');
    $url = $this->createURL($params);
    try {
      $resp = $this->getResponse($url);
    } catch (Exception $e) {
      die('Caught exception');
    }
    $a = unserialize($resp);
    $photosets = $a['photosets'];
    $this->page = $photosets['page'];
    $this->pages = $photosets['pages'];
    $this->perpage = $photosets['perpage'];
    $this->total = $photosets['total'];
    $sets = array();
    foreach ($photosets['photoset'] as $ps) {
      $sets[] = array('id' => $ps['id'],
                     'title' => $ps['title']['_content'],
                     'description' => $ps['description']['_content'],
                     'count' => $ps['photos'],
                     'created' => $ps['date_create']
                     );
    }
    $this->sets = $sets;
    // print_r ($url);
    // print_r  ($sets);
    // return $sets;
  }

}
