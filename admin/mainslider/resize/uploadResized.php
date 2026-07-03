<?php

  include("../../../includes/configuration.php");
    if ($_POST)
    {
        ini_set('memory_limit','-1');
         define('UPLOAD_DIR','../../../img/mainslider/');
        $img = $_POST['image'];
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = UPLOAD_DIR .$_POST['imgname'].'.png';
        $success = file_put_contents($file, $data);
      /*  $data = array(
                'img_name'=>$_POST['imgname'].'.png',
                'inserted_date'=>date('d/m/Y')
                );

               insertQuery(MAIN_SLIDER,$data);*/
        echo "1";
    }

?>