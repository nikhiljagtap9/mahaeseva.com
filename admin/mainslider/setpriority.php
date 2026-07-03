<?php
   include("../../includes/configuration.php");

       $priority=$_REQUEST['prio'];
       $img=$_REQUEST['img'];  
       $data=array(
          'priority'=>$priority
       );
      $getuser=updateQuery(MAIN_SLIDER,$data,"s_img_id=".$img);
      if($getuser)
      {
          echo 1;
      }
      else
      {
          echo 0;
      }
?>