PHP로 이미 저장된 이미지 파일의 EXIF 데이터, 특히 GPS 정보를 수정하는 것은 PHP 기본 기능으로는 불가능하지만, 이를 수행하기 위해서는 외부 라이브러리나 도구를 사용할 수 있습니다. 예를 들어, **exiftool**과 같은 강력한 도구를 시스템 명령어로 호출하거나 **PHPExif**와 같은 외부 PHP 라이브러리를 사용할 수 있습니다.

방법 1: exiftool 사용하기
exiftool은 사진의 EXIF 데이터를 읽고 수정할 수 있는 도구입니다. PHP에서 시스템 명령어로 exiftool을 실행하여 GPS 정보를 수정할 수 있습니다.

exiftool 설치 및 사용법:

exiftool 설치

Ubuntu에서 exiftool을 설치하려면 다음 명령어를 사용합니다:

```
sudo apt-get install exiftool
```

PHP 코드에서 exiftool 호출
아래 PHP 코드를 사용하여 기존 이미지의 GPS 정보를 변경하거나 새로운 GPS 정보를 가진 이미지 파일을 생성할 수 있습니다.

=====

Windows 10에서도 exiftool을 설치하고 사용할 수 있습니다. 설치 과정은 매우 간단하며, 설치 후에는 PHP에서 시스템 명령어로 exiftool을 호출하여 사용할 수 있습니다.

🖥️ Windows 10에 exiftool 설치 및 사용 방법:

1. ExifTool 다운로드
ExifTool 공식 웹사이트에 접속합니다.
Windows용 ExifTool을 다운로드합니다. 보통 .zip 파일 형태로 제공됩니다.
2. ExifTool 설치
다운로드한 exiftool(-version).zip 파일의 압축을 풉니다.
압축을 풀면 exiftool(-version).exe 파일이 생성됩니다. 이 파일을 사용하기 편한 경로(예: C:\exiftool\)로 이동합니다.
exiftool(-version).exe 파일의 이름을 **exiftool.exe**로 변경합니다.
3. 환경 변수 설정 (옵션)
exiftool.exe를 전역적으로 사용할 수 있도록 설정하려면 환경 변수에 경로를 추가할 수 있습니다.

환경 변수 설정:

Windows 탐색기에서 내 PC(또는 "This PC")를 우클릭 → 속성을 선택합니다.
고급 시스템 설정을 클릭하고, 환경 변수 버튼을 클릭합니다.
시스템 변수 섹션에서 Path 항목을 선택하고 편집을 클릭합니다.
새로 만들기를 클릭하고 exiftool.exe가 저장된 폴더 경로(예: C:\exiftool\)를 추가합니다.
변경 사항 저장 후, 명령 프롬프트에서 exiftool을 입력하여 설치가 잘 되었는지 확인합니다.

4. ExifTool 사용
이제 cmd 명령 프롬프트나 PHP 코드에서 exiftool 명령어를 사용할 수 있습니다.

예시:

cmd
코드 복사
exiftool -ver
이 명령을 입력하면 exiftool의 버전이 출력됩니다.

5. PHP에서 사용하기
설치 후 PHP 코드에서 exec() 함수로 exiftool 명령을 실행할 수 있습니다. 아래는 Windows 환경에서 PHP로 exiftool을 호출하는 예시입니다.

php
코드 복사
<?php
function updateGpsData($imagePath, $latitude, $longitude, $outputPath) {
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

$imagePath = 'C:\path\to\your\image.jpg'; // 이미지 파일 경로
$outputPath = 'C:\path\to\new_image_with_gps.jpg'; // 새로 생성할 이미지 경로
$latitude = 37.5665; // 새로운 위도
$longitude = 126.9780; // 새로운 경도

updateGpsData($imagePath, $latitude, $longitude, $outputPath);
?>
🧙🏾‍♂️: 이제 Windows 10에 exiftool을 설치하고 사용할 수 있습니다. 이 방법을 시도해보시겠어요, 아니면 설치 과정에 대해 더 알고 싶으신가요?