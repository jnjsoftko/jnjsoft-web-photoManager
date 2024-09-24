<?php
$root = $_SERVER['DOCUMENT_ROOT'] . "/_env";
require_once $root . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable($root);
$dotenv->load();
$photo_dir = trim($_ENV['PHOTO_DIR']);
$exiftool_path = trim($_ENV['EXIFTOOL_PATH']);

function photo_dir() {
    global $photo_dir;
    return $photo_dir;
}

function exiftool_path() {
    global $exiftool_path;
    return $exiftool_path;
}
?>