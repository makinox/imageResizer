<?php

header('Content-type: image/jpeg');

$target = "2000.jpg";
$wtrmrk_file = "watermark.png";
$middle_wtrmrk_file = "middle-watermark.png";
$little_wtrmrk_file = "little-watermark.png";
$newcopy = "completo.jpg";

$wa = 0;
$nuevo_ancho = 0;
$nuevo_alto = 0;

list($ancho, $alto) = getimagesize($target);

if (($ancho + $alto) > 10000) {
    $nuevo_ancho = $ancho * 0.05;
    $nuevo_alto = $alto * 0.05;
    $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    $origen = imagecreatefromjpeg($target);
    imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

} else if (($ancho + $alto) > 3000) {
    $nuevo_ancho = $ancho * 0.2;
    $nuevo_alto = $alto * 0.2;
    $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    $origen = imagecreatefromjpeg($target);
    imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
} else if (($ancho + $alto) > 2000) {
    $nuevo_ancho = $ancho * 0.4;
    $nuevo_alto = $alto * 0.4;
    $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    $origen = imagecreatefromjpeg($target);
    imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
} else if (($ancho + $alto) > 1296) {
    $nuevo_ancho = $ancho * 0.65;
    $nuevo_alto = $alto * 0.65;
    $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    $origen = imagecreatefromjpeg($target);
    imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
} else if (($ancho + $alto) > 1200) {
    $nuevo_ancho = $ancho * 0.7;
    $nuevo_alto = $alto * 0.7;
    $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    $origen = imagecreatefromjpeg($target);
    imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
} else if ( ($ancho + $alto) > 640 ) {
    $nuevo_ancho = $ancho * 0.8;
    $nuevo_alto = $alto * 0.8;
    $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    $origen = imagecreatefromjpeg($target);
    imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
} else if ( ($ancho + $alto) > 300 ) {
    $nuevo_ancho = $ancho * 0.9;
    $nuevo_alto = $alto * 0.9;
    $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    $origen = imagecreatefromjpeg($target);
    imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
    $wa = 1;
} else {
    $nuevo_ancho = $ancho;
    $nuevo_alto = $alto;
    $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    $origen = imagecreatefromjpeg($target);
    imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
    $wa = 1;
}

imagedestroy($origen);


// Preparando la marca de agua
if ($nuevo_ancho < 260) {
    $watermark = imagecreatefrompng($little_wtrmrk_file);
    imagealphablending($watermark, false);
    imagesavealpha($watermark, true);
    imagefilter($watermark, IMG_FILTER_COLORIZE, 0, 0, 0, 127 * (1 - 0.3));

} else if ($nuevo_ancho < 380) {
    $watermark = imagecreatefrompng($middle_wtrmrk_file);
    imagealphablending($watermark, false);
    imagesavealpha($watermark, true);
    imagefilter($watermark, IMG_FILTER_COLORIZE, 0, 0, 0, 127 * (1 - 0.3));
} else {
    $watermark = imagecreatefrompng($wtrmrk_file);
    imagealphablending($watermark, false);
    imagesavealpha($watermark, true);
    imagefilter($watermark, IMG_FILTER_COLORIZE, 0,0,0,127* (1 - 0.3));
}


// Mete la marca de agua
// $img = imagecreatefromjpeg($thumb);
$img_w = imagesx($thumb);
$img_h = imagesy($thumb);
$wtrmrk_w = imagesx($watermark);
$wtrmrk_h = imagesy($watermark);
$dst_x = ($img_w / 2) - ($wtrmrk_w / 2);
$dst_y = ($img_h / 2) - ($wtrmrk_h / 2);
imagecopy($thumb, $watermark, $dst_x, $dst_y, 0, 0, $wtrmrk_w, $wtrmrk_h);
imagejpeg($thumb, $newcopy, 100);
imagedestroy($thumb);
imagedestroy($watermark);

//imagejpeg($newcopy);

echo $ancho;