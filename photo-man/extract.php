<?php
function getGps($exifCoord, $hemi) {
    $degrees = count($exifCoord) > 0 ? gps2Num($exifCoord[0]) : 0;
    $minutes = count($exifCoord) > 1 ? gps2Num($exifCoord[1]) : 0;
    $seconds = count($exifCoord) > 2 ? gps2Num($exifCoord[2]) : 0;

    $flip = ($hemi == 'S' || $hemi == 'W') ? -1 : 1;

    return $flip * ($degrees + ($minutes / 60) + ($seconds / 3600));
}

function gps2Num($coordPart) {
    $parts = explode('/', $coordPart);

    if (count($parts) <= 0) {
        return 0;
    }
    if (count($parts) == 1) {
        return $parts[0];
    }
    return floatval($parts[0]) / floatval($parts[1]);
}

function formatGpsTime($gpsTime, $gpsDate) {
    if (!$gpsTime || !$gpsDate) {
        return "No GPS Time";
    }

    // 시, 분, 초를 계산
    $hours = intval(gps2Num($gpsTime[0]));
    $minutes = intval(gps2Num($gpsTime[1]));
    $seconds = intval(gps2Num($gpsTime[2]));

    // 날짜는 이미 'YYYY:mm:dd' 형식으로 제공됨
    $date = str_replace(':', '-', $gpsDate);

    // UTC 기준 시간 생성
    $utcTime = new DateTime("$date $hours:$minutes:$seconds", new DateTimeZone('UTC'));

    // 'Asia/Seoul' 시간대로 변환
    $utcTime->setTimezone(new DateTimeZone('Asia/Seoul'));

    // 원하는 형식으로 출력 (YYYY-mm-dd HH:mm:ss)
    return $utcTime->format('Y-m-d H:i:s');
}

function extractExifGpsData($imagePath) {
    if (!file_exists($imagePath)) {
        return "File does not exist.";
    }

    $exif = exif_read_data($imagePath, 'EXIF', true);

    if ($exif && isset($exif['GPS'])) {
        $gpsLat = $exif['GPS']['GPSLatitude'];
        $gpsLatRef = $exif['GPS']['GPSLatitudeRef'];
        $gpsLong = $exif['GPS']['GPSLongitude'];
        $gpsLongRef = $exif['GPS']['GPSLongitudeRef'];
        $gpsTime = isset($exif['GPS']['GPSTimeStamp']) ? $exif['GPS']['GPSTimeStamp'] : null;
        $gpsDate = isset($exif['GPS']['GPSDateStamp']) ? $exif['GPS']['GPSDateStamp'] : null;

        $latitude = getGps($gpsLat, $gpsLatRef);
        $longitude = getGps($gpsLong, $gpsLongRef);

        // 'Asia/Seoul' 시간대로 변환된 시간
        $formattedTime = formatGpsTime($gpsTime, $gpsDate);

        return [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'time' => $formattedTime
        ];
    } else {
        return "No GPS data found.";
    }
}

$imagePath = '/Users/youchan/Local Sites/photomanager/app/public/photo-man/photos/20240916_105405.jpg'; // 이미지 파일 경로
$result = extractExifGpsData($imagePath);
print_r($result);

// Array ( [latitude] => 37.410833333333 [longitude] => 126.67555555556 [time] => 2024-09-16 10:53:56 )
// 37.410833333333,126.67555555556
?>