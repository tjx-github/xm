<?php
if ($handle = opendir('./')) {
 
    while (false !== ($file = readdir($handle))) {
        if ($file == '.' || $file == '..') {
            continue;
        }
        write('d:/wamp/www/test/old/'.$file, 'd:/wamp/www/test/new/'.$file);
    }
 
    closedir($handle);
}
 
 
function write($old, $new) {
    $maxsize=1000;
    $image = new Imagick($old);
    if($image->getImageHeight() <= $image->getImageWidth())
    {
        $image->resizeImage($maxsize,0,Imagick::FILTER_LANCZOS,1);
    }
    else
    {
        $image->resizeImage(0,$maxsize,Imagick::FILTER_LANCZOS,1);
    }
    $image->setImageCompression(Imagick::COMPRESSION_JPEG);
    $image->setImageCompressionQuality(90);
    $image->stripImage();
    $image->writeImage($new);
    $image->destroy();
}
