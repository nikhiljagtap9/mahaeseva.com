<?php
     include("../../includes/configuration.php");
     $imgid=$_POST['imgid'];
     $setval='1';
                    $data= array(
                         'isDel'=>$setval
                      );

     $getimgname=selectQuery(MAIN_SLIDER,"*","s_img_id=".$imgid);
      for($i=0;$i<count($getimgname);$i++)
      {
         $imgname=$getimgname[$i]['img_name'];
      }
     $que=updateQuery(MAIN_SLIDER,$data,"s_img_id=".$imgid);
     rename("../../img/mainslider/".$imgname,"../../img/mainslider/DEL_".$imgname);
     
         if($que)
         {

           echo 1;
         }
         else
         {
           echo 0;
         }
?>