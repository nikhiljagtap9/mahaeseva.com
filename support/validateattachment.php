<?php
    $allowedformat=explode(",",$_REQUEST['allowformat']);
    $maxsize=$_REQUEST['maxsize'];
    $type=mime_content_type ($_FILES['attachment']['tmp_name']);

   if(!in_array($type, $allowedformat))
   {
     echo "Attached File Type '".$type."' Not Allowed";
   }
   else if($_FILES['attachment']['size']>$maxsize)
   {
     echo "Attached File Size Exceed";
   }
   else
   {
       echo 1;
   }
?>