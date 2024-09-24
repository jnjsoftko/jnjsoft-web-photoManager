<?php
if ( ! defined( 'ABSPATH' ) ) {
define( 'ABSPATH', __DIR__ . '/' );
}
require_once ABSPATH . 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(ABSPATH);
$dotenv->load();
$photo_dir = trim($_ENV['PHOTO_DIR']);
print_r($_SERVER['DOCUMENT_ROOT'] . '/env/vendor/autoload.php');
print_r($photo_dir);
?>