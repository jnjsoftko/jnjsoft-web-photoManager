<?php
require_once 'inc/functions.php';

$photo_dir = photo_dir();
$exiftool_path = exiftool_path();

print_r($photo_dir);
print_r($exiftool_path);
?>