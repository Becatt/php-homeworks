<?php

    if(!empty($_POST)) {
      $numQuestion = 0;
      $correctAnswer = 0;
      for ($i=1; $i < count($_POST); $i++) {
        $numQuestion++;
        $value = $_POST['q' . $i];

        if($value == 'answer') { 
          $correctAnswer++;
           
        }
      } 
      
      $userName = $_POST['name'];
      $percent = ($correctAnswer / $numQuestion * 100); 

      if($percent<70) {
        echo 'Тест не пройден';
        exit;
      } 
    } 
    

$textUp = 'Данный сертификат подтверждает, что пользователь';
$textDown = 'прошел тест на ' . $percent . '%';

$image = imagecreatetruecolor(600, 424);
$backCololr = imagecolorallocate($image, 244, 244, 244);
$textCololr = imagecolorallocate($image, 2, 99, 167);

$certFile = __DIR__ . '/certificate.png';
if (!file_exists($certFile)) {
  echo 'Файл с картинкой не найден!';
  exit;
}
$imSert = imagecreatefrompng($certFile);

imagefill($image, 0, 0, $backCololr);
imagecopy($image, $imSert, 0, 0, 0, 0, 600, 424);

$fontFile = __DIR__ . '/ARIAL.TTF';
if (!file_exists($fontFile)) {
  echo 'Файл со шрифтом не найден!';
  exit;
}

imagettftext($image, 12, 0, 100, 210, $textCololr, $fontFile, $textUp);
imagettftext($image, 18, 0, 100, 260, $textCololr, $fontFile, $userName);
imagettftext($image, 12, 0, 100, 300, $textCololr, $fontFile, $textDown);
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);