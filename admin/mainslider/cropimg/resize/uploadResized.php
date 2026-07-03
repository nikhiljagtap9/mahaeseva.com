<?php
      include("../../config.php");
if ($_POST)
{      ini_set('memory_limit','-1');
   define('UPLOAD_DIR','../../'.PATH_CROP_RESIZED_IMG);
    $img = $_POST['image'];
    $img = str_replace('data:image/jpeg;base64,','',$img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = UPLOAD_DIR.$_POST['imgname'].'.png';
    $success = file_put_contents($file, $data);
    
    echo "1";
}
?>