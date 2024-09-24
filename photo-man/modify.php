<?php
require_once 'inc/functions.php';
$photo_dir = photo_dir();

function updateGpsData($imagePath, $latitude, $longitude, $altitude, $outputPath) {
  $exiftool_path = exiftool_path();

  // Determine Latitude and Longitude references
  $latitudeRef = ($latitude >= 0) ? 'N' : 'S'; // North/South
  $longitudeRef = ($longitude >= 0) ? 'E' : 'W'; // East/West

  // Altitude reference: 0 = Above sea level, 1 = Below sea level
  $altitudeRef = ($altitude >= 0) ? 0 : 1; // Above/Below sea level

  // Construct exiftool command with altitude
  $command = sprintf(
    $exiftool_path .' -GPSLatitude=%f -GPSLatitudeRef=%s -GPSLongitude=%f -GPSLongitudeRef=%s -GPSAltitude=%f -GPSAltitudeRef=%d -overwrite_original -o %s %s',
    abs($latitude), $latitudeRef, abs($longitude), $longitudeRef, abs($altitude), $altitudeRef, escapeshellarg($outputPath), escapeshellarg($imagePath)
  );

  print_r($command);
  echo "<br/>";
  echo "<br/>";

  // Execute the command
  exec($command . ' 2>&1', $output, $return_var);
  print_r($output); // This will print the error messages, if any.
  echo "<br/>";
  echo "<br/>";

  if ($return_var == 0) {
      echo "GPS and altitude information successfully updated!";
  } else {
      echo "Failed to update GPS and altitude information.";
  }
}

$imagePath = $photo_dir . '_20240916_105405.jpg';
$outputPath = $photo_dir . '20240916_105405.jpg';
$latitude = 37.3333; // 새 GPS 위도
$longitude = 126.4444; // 새 GPS 경도
$altitude = 50;

updateGpsData($imagePath, $latitude, $longitude, $altitude, $outputPath);
?>
<!-- 
$imagePath = 'C:/Users/Jungsam/Local Sites/photomanager/app/public/photo-man/photos/20240916_105405.jpg'; // 원본 이미지 경로
$outputPath = 'C:/Users/Jungsam/Local Sites/photomanager/app/public/photo-man/photos/20240916_105405.jpg'; // GPS 정보를 수정한 새로운 이미지 저장 경로\ -->