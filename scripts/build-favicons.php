<?php

/**
 * Normaliza o PNG para ícone quadrado 96×96 (crop central), gera 48×48 e favicon.ico.
 * Uso: php scripts/build-favicons.php
 */
$base = dirname(__DIR__).'/public';
$src = $base.'/favicon-96.png';
if (! is_file($src)) {
    fwrite(STDERR, "Missing $src\n");
    exit(1);
}

$s = imagecreatefrompng($src);
if ($s === false) {
    fwrite(STDERR, "Cannot read PNG\n");
    exit(1);
}

$w = imagesx($s);
$h = imagesy($s);
$side = min($w, $h);
$sx = (int) (($w - $side) / 2);
$sy = (int) (($h - $side) / 2);

$crop = imagecreatetruecolor($side, $side);
imagealphablending($crop, false);
imagesavealpha($crop, true);
$transparent = imagecolorallocatealpha($crop, 0, 0, 0, 127);
imagefilledrectangle($crop, 0, 0, $side, $side, $transparent);
imagealphablending($crop, true);
imagecopy($crop, $s, 0, 0, $sx, $sy, $side, $side);
imagedestroy($s);

function saveSquareSize($srcGd, int $px, string $path): void
{
    $out = imagecreatetruecolor($px, $px);
    imagealphablending($out, false);
    imagesavealpha($out, true);
    $t = imagecolorallocatealpha($out, 0, 0, 0, 127);
    imagefilledrectangle($out, 0, 0, $px, $px, $t);
    imagealphablending($out, true);
    imagecopyresampled($out, $srcGd, 0, 0, 0, 0, $px, $px, imagesx($srcGd), imagesy($srcGd));
    imagesavealpha($out, true);
    imagepng($out, $path);
    imagedestroy($out);
}

$imagesDir = $base.'/images';
if (! is_dir($imagesDir)) {
    mkdir($imagesDir, 0755, true);
}

saveSquareSize($crop, 96, $base.'/favicon-96.png');
saveSquareSize($crop, 48, $base.'/favicon-48.png');
saveSquareSize($crop, 192, $imagesDir.'/logo-192.png');
imagedestroy($crop);

$png = file_get_contents($base.'/favicon-96.png');
$pngLen = strlen($png);
$iw = unpack('N', substr($png, 16, 4))[1];
$ih = unpack('N', substr($png, 20, 4))[1];
$bw = $iw >= 256 ? 0 : $iw;
$bh = $ih >= 256 ? 0 : $ih;
$offset = 22;
$header = pack('vvv', 0, 1, 1);
$entry = pack('CCCC', $bw, $bh, 0, 0);
$entry .= pack('v', 1);
$entry .= pack('v', 32);
$entry .= pack('V', $pngLen);
$entry .= pack('V', $offset);
file_put_contents($base.'/favicon.ico', $header.$entry.$png);

echo "OK: square favicons + images/logo-192.png, favicon.ico\n";
