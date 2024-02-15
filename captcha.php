<?php
session_start();

// Génération du code CAPTCHA
$captcha_code = mt_rand(1000, 9999);
$_SESSION['captcha_code'] = $captcha_code;

// Création de l'image CAPTCHA
$image = imagecreate(100, 30);
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);

$font_path = 'font/AvengeRegular-Yzdxy.ttf'; // Chemin vers la police TrueType (ttf)

imagettftext($image, 20, 0, 10, 25, $text_color, $font_path, $captcha_code);

// Affichage de l'image CAPTCHA
header('Content-Type: image/jpeg');
imagejpeg($image);
imagedestroy($image);
?>
