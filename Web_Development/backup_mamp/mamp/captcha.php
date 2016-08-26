<?php
session_start();
$img = imagecreate(60, 15);
$fundo = imagecolorallocate($img, 255, 255, 0);
$fonte = imagecolorallocate($img, 0, 0, 0);
imagestring($img, 5, 0, 0, ''.$_SESSION['captcha'].'', $fonte);
header("Content-type: image/jpeg");
imagejpeg($img);
?>