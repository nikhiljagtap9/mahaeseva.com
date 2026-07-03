  <?php

     include("../../includes/configuration.php");
            if(isset($_REQUEST['text_color']))
            {
                 $tcolor=$_REQUEST['text_color'];
            }
            else
            {
                 $tcolor="";
            }
            if(isset($_REQUEST['text_font']))
            {
                $tfont=$_REQUEST['text_font'];
            }
            else
            {
                 $tfont="";
            }
             if(isset($_REQUEST['text_size']))
            {
                $tsize=$_REQUEST['text_size'];
            }
            else
            {
                 $tsize="";
            }

            if($_REQUEST['bold']!="")
            {
                $bold='1';
            }
            else
            {
                 $bold="0";
            }

            if($_REQUEST['italic']!="")
            {
                $italic='1';
            }
            else
            {
                 $italic="0";
            }

            if($_REQUEST['underline']!="")
            {
                $underline='1';
            }
            else
            {
                 $underline="0";
            }


            if($_REQUEST['pos']!="")
            {
                $data=array(
               "description"=>addslashes($_REQUEST['details']),
               "btn_name"=>"",
               "btn_link"=>$_REQUEST['btn_link'],
               "text_position"=>$_REQUEST['pos'],
               "text_font"=>$tfont,
               "text_color"=>$tcolor,
               "text_size"=>$tsize,
               "isbold"=>$bold,
               "isitalic"=>$italic,
               "isunderline"=>$underline
             );
            }
            else
            {
                  $data=array(
                       "description"=>addslashes($_REQUEST['details']),
                       "btn_name"=>"",
                       "btn_link"=>$_REQUEST['btn_link'],
                       
                       "text_font"=>$tfont,
                       "text_color"=>$tcolor,
                       "text_size"=>$tsize,
                         "isbold"=>$bold,
                       "isitalic"=>$italic,
                       "isunderline"=>$underline
                     );
            }

          
          $getuser=updateQuery(MAIN_SLIDER,$data,"s_img_id=".$_REQUEST['img_id']);
          if($getuser)
          {
              echo 1;
          }
          else
          {
              echo 0;
          }
         ?>

