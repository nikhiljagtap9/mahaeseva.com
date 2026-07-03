  <?php
     include("../../includes/configuration.php");
    if($_POST['removing_img'] != "")
    {
            if($_POST['removing_img']==$_POST['totalimgcount'])      //last img is being removed
            {
                  if (unlink(SITEURL."/img/mainslider/".$_POST['galleryname']."_".$_POST['removing_img'].".png"))
                  echo 1;
                  else
                  echo 0;
              //remove  row from database also
            }
            else                                   //any from the middle is being removed
            {
                    if(unlink(SITEURL."/img/mainslider/".$_POST['galleryname']."_".$_POST['removing_img'].".png") && rename (SITEURL."/img/mainslider/".$_POST['galleryname']."_".$_POST['totalimgcount'].".png"  , SITEURL."/img/mainslider/".$_POST['galleryname']."_".$_POST['removing_img'].".png"))
                    echo 1;
                    else
                    echo 0;
                //remove    $_POST['totalimgcount one row from db
            }

            deleteQuery(MAIN_SLIDER,"img_name='".$_POST['galleryname']."_".$_POST['totalimgcount'].".png'");

    }
    ?>