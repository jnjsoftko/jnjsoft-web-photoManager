<?php
function updateGpsData($imagePath, $latitude, $longitude, $altitude, $outputPath) {
  // Determine Latitude and Longitude references
  $latitudeRef = ($latitude >= 0) ? 'N' : 'S'; // North/South
  $longitudeRef = ($longitude >= 0) ? 'E' : 'W'; // East/West

  // Altitude reference: 0 = Above sea level, 1 = Below sea level
  $altitudeRef = ($altitude >= 0) ? 0 : 1; // Above/Below sea level

  // Construct exiftool command with altitude
  $command = sprintf(
      'exiftool -GPSLatitude=%f -GPSLatitudeRef=%s -GPSLongitude=%f -GPSLongitudeRef=%s -GPSAltitude=%f -GPSAltitudeRef=%d -overwrite_original -o %s %s',
      abs($latitude), $latitudeRef, abs($longitude), $longitudeRef, abs($altitude), $altitudeRef, escapeshellarg($outputPath), escapeshellarg($imagePath)
  );

  print_r($command);

  // Execute the command
  exec($command, $output, $return_var);

  if ($return_var == 0) {
      echo "GPS and altitude information successfully updated!";
  } else {
      echo "Failed to update GPS and altitude information.";
  }
}


$imagePath = 'C:/Users/Jungsam/Local Sites/photomanager/app/public/photo-man/photos/_20240916_105405.jpg'; // 원본 이미지 경로
$outputPath = 'C:/Users/Jungsam/Local Sites/photomanager/app/public/photo-man/photos/_20240916_105405.jpg'; // GPS 정보를 수정한 새로운 이미지 저장 경로
$latitude = 37.5665; // 새 GPS 위도
$longitude = 126.9780; // 새 GPS 경도

updateGpsData($imagePath, $latitude, $longitude, $outputPath);
?>