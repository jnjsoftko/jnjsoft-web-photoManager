<?php
function updateGpsData($imagePath, $latitude, $longitude, $outputPath) {
    // exiftool을 사용하여 GPS 데이터를 변경합니다.
    $latitudeRef = ($latitude >= 0) ? 'N' : 'S'; // 북반구/남반구
    $longitudeRef = ($longitude >= 0) ? 'E' : 'W'; // 동쪽/서쪽

    // exiftool 명령어 생성
    $command = sprintf(
        'exiftool -GPSLatitude=%f -GPSLatitudeRef=%s -GPSLongitude=%f -GPSLongitudeRef=%s -overwrite_original -o %s %s',
        abs($latitude), $latitudeRef, abs($longitude), $longitudeRef, escapeshellarg($outputPath), escapeshellarg($imagePath)
    );

    // 시스템 명령어 실행
    exec($command, $output, $return_var);

    if ($return_var == 0) {
        echo "GPS 정보가 성공적으로 업데이트되었습니다!";
    } else {
        echo "GPS 정보를 업데이트하는 데 실패했습니다.";
    }
}

$imagePath = 'path_to_your_image.jpg'; // 원본 이미지 경로
$outputPath = 'new_image_with_gps.jpg'; // GPS 정보를 수정한 새로운 이미지 저장 경로
$latitude = 37.5665; // 새 GPS 위도
$longitude = 126.9780; // 새 GPS 경도

updateGpsData($imagePath, $latitude, $longitude, $outputPath);
?>