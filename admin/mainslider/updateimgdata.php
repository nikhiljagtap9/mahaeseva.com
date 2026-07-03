<?php
     include("../../includes/configuration.php");
     $imgid=base64_decode($_REQUEST['img']);

     $getuser=selectQuery(MAIN_SLIDER,"*","s_img_id=".$imgid);

?>

<!doctype html>

<html lang=''>
<head>
 <title><?php echo SITE_TITLE; ?> : Slider</title>
<?php include '../commoncss.php';?>

      <?php include "config.php";      ?>
</head>

<body>
<div class="page-body-wrapper">
    <?php include('../header.php') ?>
    <?php include('../cssmenu.php') ?>
    <div class="main-panel">
        <div class="dashbody">
        <div class="card">
            <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Subadmin Login Details</h2></div><div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
            
        <div class="card-body">

            <div class="msgs"></div>

           <div class="avatar-view"  id="avatar-view" style="cursor:pointer;">
           <img src="<?php echo SITEURL; ?>/img/mainslider/<?php echo $getuser[0]['img_name']; ?>" style="width:100%;height: 100%" alt="mainsliderimage">
           </div>

             </div>
    </div>


    <div class="card">
        <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Destination Page URL</h2></div></div>
        <div class="card-body">
             <form name="sliderdata">
                 <!--  <div class="panel-heading"><div class="panel-title">Overlay Text</div></div>

                        <textarea class="summernote" id="editor1"  name="text_details" style="width:100%;min-height:200px !important"><?php echo $getuser[0]['description']; ?></textarea>

                    <div class="clearfix"></div>
                        <div class="deviderpadd"></div>
                      <div class="selectposition">
                      <div class="panel-heading"><div class="panel-title">Select Text Position</div></div>
                    <div class="row">
                            <div class="col-md-3 form-group">
                                  <input type="radio" name="text_pos" class="text_pos" value="center" checked onchange="getval('center')"> Center
                            </div>
                            <div class="col-md-3 form-group">
                                  <input type="radio" name="text_pos" class="text_pos" value="center-top" <? if($getuser[0]['text_position']=="center-top"){echo "checked";} ?> onchange="getval('center-top')"> Center-Top
                            </div>
                            <div class="col-md-3 form-group">
                                  <input type="radio" name="text_pos" class="text_pos" value="center-bottom" <? if($getuser[0]['text_position']=="center-bottom"){echo "checked";} ?> onchange="getval('center-bottom')"> Center-Bottom
                            </div>
                            <div class="col-md-3 form-group">
                                  <input type="radio" name="text_pos" class="text_pos" value="top-left" <? if($getuser[0]['text_position']=="top-left"){echo "checked";} ?> onchange="getval('top-left')"> Top-Left
                            </div>
                            <div class="col-md-3 form-group">
                                  <input type="radio" name="text_pos" class="text_pos" value="top-right" <? if($getuser[0]['text_position']=="top-right"){echo "checked";} ?> onchange="getval('top-right')"> Top-Right
                            </div>
                            <div class="col-md-3 form-group">
                                  <input type="radio" name="text_pos" class="text_pos" value="bottom-left" <? if($getuser[0]['text_position']=="bottom-left"){echo "checked";} ?> onchange="getval('bottom-left')"> Bottom-Left
                            </div>
                            <div class="col-md-3 form-group">
                                  <input type="radio" name="text_pos" class="text_pos" value="bottom-right" <? if($getuser[0]['text_position']=="bottom-right"){echo "checked";} ?> onchange="getval('bottom-right')"> Bottom-Right
                            </div>
                             <input type="hidden" name="position" id="position"     <? if($getuser[0]['text_position']!=""){ ?>value="<? echo $getuser[0]['text_position']; ?>"  <?  } ?>/>
                            </div>
                    </div>-->

        <div>
     
                <div class="form-group">
                 <input type="text" name="btn_link" id="btn_link" class="form-control btn_link" maxlength="500" placeholder="Enter Page Link" required value="<?php echo $getuser[0]['btn_link']; ?>"/>
            </div>
        </div>

        <div class="row"><div class="col-md-12"><div class="msgs12"></div></div></div>
        <div class="form-group">
            <input type="hidden" name="img_id" id="img_id"  value="<?php echo $getuser[0]['s_img_id']; ?>"/>
            <input type="button" name="savedata" id="savedata" class="btn btn-primary greenBtn pull-right" value="Save" onclick="updatedata()"/>
        </div>
           </form>


              </div>
    </div>   </div>
              <?php include('../footer.php');?>
              </div>

       </div>


 <script type="text/javascript" src="../summernote/summernote.js"></script>
      <script type="text/javascript">
    $(function() {
      $('.summernote').summernote({
          //fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather'],
        height: 200
      });

      });

    </script>
<script type="text/javascript">
    $(function() {

        $('.dropdown-toggle').on('click', function(e) {

                $(this).parent().show();
        });
    });
</script>



<script>
    function getval(a) {
        window.c = a;
    }

    function updatedata() {

        var btn_link = sliderdata.elements["btn_link"].value;
        var img_id = sliderdata.elements["img_id"].value;
    /*    var setpos = sliderdata.elements["position"].value;

        var editorText = $('.summernote').summernote('code');*/

        if (window.c != "" || window.c != "undefined") {
            var pos = window.c;
        }/* else {
            var pos = setpos;
        }*/

        $.ajax({
            type: "POST",
            url: "updatetext.php",
            data: {
                img_id: img_id,
                btn_link: btn_link,

            },
            success: function(response) {
                if (response == 1) {
                    $('.msgs12').fadeIn();
                    $('.msgs12').addClass("alert alert-success");
                    $('.msgs12').html("Details Updated");
                    $('.msgs12').delay(5000).fadeOut();
                    $("#myModal1").css("display", "none");
                    $("#myModal1").css("opacity", "0");
                    window.location="<?php echo ADMINURL ?>mainslider"
                } else {
                    $('.msgs12').fadeIn();
                    $('.msgs12').addClass("alert alert-danger");
                    $('.msgs12').html("Fail To upload");
                    $('.msgs12').delay(5000).fadeOut();
                    $("#myModal1").css("display", "none");
                    $("#myModal1").css("opacity", "0");
                }
            }
        });


    }
</script>

</body>
</html>