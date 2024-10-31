<html>
<head>
  <title>Flickr API test page</title>
</head>
<body>
  <h1>Flickr API Test</h1>
  <ul>
    <li>Square 50 's'</li>
    <li>Square 75 'q'</li>
    <li>Thumb (75x100) 't'</li>
    <li>Small 240 (180x240) 'm'</li>
    <li>Small 320 (240x320) 'n'</li>
    <li>Medium 500 (375x500) ''</li>
    <li>Medium 640 (480x640) 'z'</li>
    <li>Original 'o'</li>
  </ul>
<?php
function makeLink($id) {
  return $_SERVER['PHP_SELF'] . '?setid=' . $id;
}

// set_include_path(get_include_path() . PATH_SEPARATOR . './includes');
require_once 'WQFlickr/Api.php';
require_once 'WQFlickr/Photosets.php';

$api_key = '42df3afea0ff0bd73b63ecf48c0da00f';
$secret = 'e6b40c05dbb6fe5c';
$nsid = "61638823@N03";

$fotosets = new WQFlickr\Photosets($api_key, $secret, $nsid);
$sets = $fotosets->getList();
print '<ol>';
foreach ($sets as $set) {
  print '<li><a href="' . makeLink($set['id']) . '">' . $set['title'] . ' (' . $set['count'] . ')</a></li>';
}
print '</ol>';

$set = $fotosets->getLatest();
print '<h3>Latest set: (' . $set->getTitle() . ')</h3>';
$fotos = $set->getPhotos();
foreach ($fotos as $foto) {
  print '<a href="'. $foto->getSrc('z') . '" target="_blank"><img src="' . $foto->getSrc() . '" alt="' . $foto->getTitle() . '" title="' . $foto->getTitle() . '" /></a>';
}

print '<h3>Selected set:</h3>';
if ($_GET['setid']) {
  $set = $fotosets->getFotoset($_GET['setid'], 't');
  // print_r($set);
  $fotos = $set->getPhotos();
  foreach ($fotos as $foto) {
    print '<a href="'. $foto->getSrc('z') . '" target="_blank"><img src="' . $foto->getSrc() . '" alt="' . $foto->getTitle() . '" title="' . $foto->getTitle() . '" /></a>';
  }
}

?>
</body>
</html>
