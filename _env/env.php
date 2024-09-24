<?php
$root = $_SERVER['DOCUMENT_ROOT'] . "/_env";
require_once $root . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable($root);
$dotenv->load();
$photo_dir = trim($_ENV['PHOTO_DIR']);
print_r($photo_dir);
?>