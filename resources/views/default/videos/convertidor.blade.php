<?php
/**
 * @author Gustavo Zimbron
 * @copyright 2017
 */

 /*-----
// Cargamos la foto original
$im = imagecreatefrompng('assets/img/original.png');
// Primero crearemos nuestra imagen de la estampa manualmente desde GD
$marca_agua = imagecreatefrompng("assets/img/marca_agua2.png");
// Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
$margen_dcho = 10;
$margen_inf = 10;
$sx = imagesx($marca_agua);
$sy = imagesy($marca_agua);
// Fusionar la estampa con nuestra foto con una opacidad del 50%
imagecopymerge($im, $marca_agua, 0, imagesy($im) - $sy, 0, 0, $sx, $sy, 80); 
// Guardar la imagen en un archivo y liberar memoria
imagepng($im, 'assets/img/nueva_imagen.png'); 
imagedestroy($im);
---*/


/*
ffmpeg -i "public/assets/videos_web/demo03.mp4" -c:v libvpx -c:a libvorbis "public/assets/videos_web/salida01.webm"
*/


$execQuery = 'ffmpeg -i assets/videos_web/demo02.mp4 -i assets/img/LogoConecte.png -filter_complex "overlay=10:10" assets/videos_web/salida03.mp4';
$outVideo = shell_exec ("$execQuery 2>&1");
// echo $outVideo

/*
require '../vendor/autoload.php';

$ffmpeg = FFMpeg\FFMpeg::create();
$video = $ffmpeg->open('../public/assets/videos_web/demo03.mp4');
$video
    ->filters()
    ->watermark('../public/assets/img/LogoConecte.png', array(
        'position' => 'relative',
        'top' => 10,
        'left' => 10,
    ));

  $format = (new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'));
  $video ->save($format, '../public/assets/videos_web/export.mp4');
  */
?>