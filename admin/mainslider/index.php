<?php include("../../includes/configuration.php"); include("config.php");
$page = 'sliderindex'; $getuser = selectQuery(MAIN_SLIDER,"*","isDel='0' order by priority ASC"); $s = $_REQUEST['s']; ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Slider</title>
    <?php include('../commoncss.php');?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/uploadImagepopup/main.css">
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/uploadImagepopup/cropper.min.css">
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php') ?>
    <?php include('../cssmenu.php') ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center">
                <div><h2 class="card-head-title">Main Slider Management</h2></div></div>
                <div class="card-body sliderimage">
                    <div class="msgs"></div>
                 <div class="d-none" id="formdiv" >
                      <table style="margin-left: 100px;border-collapse: separate;border-spacing: 10px 10px;border-collapse: separate;border-spacing: 10px 10px;width: 800px;text-align:left">
                          <tbody><tr><td colspan="2" style="text-align:center;color:red" id="msg"></td></tr>
                             <tr><td style="vertical-align: top"><span style="color:red">*</span>Image Gallery Name:</td>
                                 <td style="vertical-align: top"><input type="text" id="galname" value="slider">(This name will be prefixed with Image Name.Eg.Gallery_1.jpg)<br>(Name should not contain special characters,symbols or spaces; Must be less than 20 chars)</td>
                             </tr>
                             <tr><td style="vertical-align: top"><span style="color:red">*</span>Number of Images you want to upload:</td>
                                 <td style="vertical-align: top"><input type="text" id="imgnumber" value="1">(Max:20)</td></tr>
                             <tr><td colspan="2" style="text-align:center"><input type="button" id="btnBacisinfo"  onclick="submit()" value="Submit"/></td></tr>
                      </tbody></table>
                    </div>
                           <div class="pull-right" id="crop-avatar">
                                            <div class="avatar-view bannerUploadBtn" title="Click here to Upload Images" id="avatar-view">
                                               <button type="button" class="btn btn-primary" id="edit">Add New Image</button>
                                            </div>
                                     <script>
                                        var cropboxdimension_width=<? echo CROPBOX_WIDTH; ?>;
                                        var cropboxdimension_height=<? echo CROPBOX_HEIGHT; ?>;
                                        var MAX_RESIZE_WIDTH = <? echo RESIZE_WIDTH; ?>;
                                        var MAX_RESIZE_HEIGHT = <? echo RESIZE_HEIGHT; ?>;
                                        var filesThatWereDropped = new Array();
                                        var edit=0;
                                        var nwidth=0;
                                        var nheight=0;
                                        </script>
                                       
                                        <?
                                        $config_error=0;
                                          if(IMAGE_PREFIX=="" || PATH_CROP_RESIZED_IMG=="" || DEFAULT_SAVE=="" || CROPBOX_WIDTH=="" || CROPBOX_HEIGHT=="" || RESIZE_HEIGHT=="" || RESIZE_WIDTH=="" || IMG_UPLOAD=="" || NEED_IN_ORIGINAL_SIZE=="" || DEL_PREFIX=="")
                                          $config_error=1;
                                          echo "<input type='hidden' id='config_error' value='".$config_error."'>";
                                        ?>
                                            <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                              <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                  <form class="avatar-form" action="img_config/crop.php" enctype="multipart/form-data" method="post" id="fileinfo">
                                                    <div class="modal-header" >
                                                    
                                                      <h5 class="modal-title" id="avatar-modal-label">Upload Image : (<span id="avatar-modal-label_num">1/<? echo NUMBER_OF_IMG_UPLOAD; ?></span>)</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
             
                                                    </div>
                                                    <div class="modal-body" >
                                                      <div class="avatar-body">
                                                        <div class="avatar-upload">
                                                         <div class="valchng">
                                                              <input type="hidden" id="cropped_img_name" class="cropped_img_name" name="cropped_img_name" value="<? echo IMAGE_PREFIX; ?><?php echo date('dmyhis'); ?>" >
                                                        </div>
                                                            <input type="hidden" class="cropped_img_num" name="cropped_img_num" id="cropped_img_num" value="0">
                                                           <input type="hidden" class="cropped_img_width" name="cropped_img_width" id="cropped_img_width" value="">
                                                         <input type="hidden" class="cropped_img_height" name="cropped_img_height" id="cropped_img_height" value="">
                                                          <input type="hidden" class="dataURL" name="dataURL" id="dataURL" value="">
                                                            <? if(DEFAULT_SAVE=="CROP") { ?>
                                                          <input type="hidden" class="todochoice" name="todochoice" id="todochoice" value="crop">
                                                           <? } else if(DEFAULT_SAVE=="RESIZE") { ?>
                                                          <input type="hidden" class="todochoice" name="todochoice" id="todochoice" value="resize">
                                                           <? } else { ?>
                                                           <input type="hidden" class="todochoice" name="todochoice" id="todochoice" value="">
                                                           <? } ?>
                                                          <input type="hidden" class="avatar-src" name="avatar_src">
                                                          <input type="hidden" class="avatar-data" name="avatar_data">
                                                          <input type="hidden" class="dropped" name="dropped" value="0" id="dropped">
                                                           <input type="hidden" class="img_ppath" name="img_ppath" id="img_ppath" value="<? echo PATH_CROP_RESIZED_IMG; ?>">
                                                          <input type="hidden" class="img_upload" name="img_upload" id="img_upload" value="<? echo IMG_UPLOAD; ?>"> <!--SINGLE or MULTI-->
                                                          <input type="hidden" class="default_save" name="default_save" id="default_save" value="<? echo DEFAULT_SAVE; ?>">
                                                          <?
                                                            if(IMG_UPLOAD=="SINGLE")
                                                            echo '<input type="hidden" class="img_numm" name="img_numm" id="img_numm" value="1">';
                                                            else if(IMG_UPLOAD=="MULTI")
                                                            echo '<input type="hidden" class="img_numm" name="img_numm" id="img_numm" value="'.NUMBER_OF_IMG_UPLOAD.'">';
                                                            else
                                                            echo '<input type="hidden" class="img_numm" name="img_numm" id="img_numm" value="">';
                                                          ?>
                                                         
                                                          
                                                        </div>
                                                        <div class="row">
                                                          <div class="col-md-9" >
                                                          <div id="filedrag">
                                                            <div class="avatar-wrapper" id="avatar-wrapper" >
                                                                <div class="text-center drag_drop_div">
                                                                   <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                                    <p>Drag & Drop file here</p>
                                                                </div>
                                                            </div>
                                                          </div>
                                                          </div>
                                                          <div class="col-md-3 text-center">
                                                          <div  class="cropviewdiv">
                                                              <? if(DEFAULT_SAVE=="CROP") { ?>
                                                            <label class="radio-inline"><input type="radio" id="cropradio" name="todo" value="crop" checked><b>Crop Preview</b></label>
                                                           <? } else { ?>
                                                            <label class="radio-inline"><input type="radio" id="cropradio" name="todo" value="crop"><b>Crop Preview</b></label>
                                                           <? } ?>
                                                                <div class="avatar-preview preview-lg" id="prevlg">
                                                            <img src="../cropimg/img/picture.jpg"  alt="cropimg">
                                                            </div>
                                                           </div>
                                                              <div class="resizeviewdiv">
                                                                <? if(DEFAULT_SAVE=="RESIZE") { ?>
                                                                <label class="radio-inline"><input type="radio" name="todo" value="resize" checked><b>Resize Preview</b></label>
                                                            <? } else { ?>
                                                            <input type="radio" name="todo" value="resize" id="todoresize"><b>Resize Preview</b>
                                                              <? } ?>
                                                               <div  id="filesInfo">
                                                             <img src="../cropimg/img/picture.jpg" class="img-responsive" alt="cropimg">
                                                            </div>
                                                            </div>
                                                            <div class="avatar-preview preview-md"  style="display:none"></div>
                                                            <div class="avatar-preview preview-sm"  style="display:none"></div>
                                                          </div>
                                                        </div>
                                                        <div class="row avatar-btns">
                                                          <div class="col-md-12">
                                                              <button class="btn btn-primary" type="button" id='selectFile'>Select File</button>
                                                              <input type="file" class="avatar-input d-none" id="avatarInput" name="avatar_file" onchange="readURL(this)" multiple>
                                                             <button class="btn btn-success" type="button" onclick="ifradioselected()">Done</button>
                                                             <button type="submit" name="submitbutton" style="display:none" class="btn btn-primary greenBtn avatar-save">Submit</button>
                                                             <button class="btn btn-dark" onclick="closse()" type="button">Close</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>
                                                 <div class="loadingmodal" aria-label="Loading" role="img" tabindex="-1">
                                                    <div class="progress"></div>
                                                    <div style="width:100%;text-align: center;font-size: 20px;color:#3C8DBC;font-weight:bold" id="percentage"></div>
                                                    </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="deviderpadd"></div>
                                             <div class="alert alert-info">
                                            Note : Image Dimensions should not be less than <b><?php echo CROPBOX_WIDTH; ?>x<?php echo CROPBOX_HEIGHT; ?>  pixel</b>.</div>
                      <div class="msgs12"></div>
                    <div class="table-responsive tshufle">
                       <table class="table table-bordered example">
                            <thead>
                              <tr>
                                <th>Image</th>
                                <th>View/Edit</th>
                                <th class="text-center">Delete</th>
                                   </tr>
                            </thead>
                            <tbody  class="tbodyrow">
                                <?php
                                    for($i=0;$i<count($getuser);$i++)
                                    {
                                        ?>
                                           <tr   id="<? echo $getuser[$i]['s_img_id']; ?>">
                                              <td style="width: 65%;"><img src="<?php echo SITEURL; ?>/img/mainslider/<?php echo $getuser[$i]['img_name']; ?>" alt="sliderimage" width="300"></td>
                                              <td class=""><a href="updateimgdata.php?img=<?php echo base64_encode($getuser[$i]['s_img_id']); ?>" class="btn btn-primary btn-sm">View/Edit</a></td>
                                              <td class="text-center"><button type="button" onclick="showdelopopup('<?php echo $getuser[$i]['s_img_id']; ?>')" class="deletebtn btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                                 </td>
                                           </tr>
                                        <?
                                    }
                                ?>
                            </tbody>
                       </table>
                      </div>
            </div>
            </div>
                <button class="save btn btn-success pull-right" id= "save">Save sequence</button>
            </div>
           <div id="confirm" class="modal fade" role="dialog">
           <div class="vertical-alignment-helper">
  <div class="modal-dialog modal-sm vertical-align-center">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" >Confirmation?</h4>
      </div>
      <div class="modal-body">Do You Really Want To Delete This Image?</div>
    <div class="modal-footer">
  </div>
    </div>
  </div>
  </div>
</div>
<?php include('../footer.php');?>
<script src="<?php echo SITEURL; ?>/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script src="../cropimg/dist/cropper.js"></script>
<script src="img_config/js/main.js"></script>
</div>
</div>
    
<script>
$('#selectFile').click(function(){ $(".avatar-input[type='file']").trigger('click'); })
$("table tbody").sortable({ update: function(event, ui){ $(this).children().each(function(index){ }); } });
$("#save").click(function(){
var str = "";
$('.tbodyrow  tr').each(function(){
    if($(this).attr('id') != "") {
  str += $(this).attr('id') + ",";
  }
})
str = str.replace(/,\s*$/, "");
var info={action:"setpriority",str:str};
  $.ajax({
      data: info,
      type: 'POST',
      url: 'setpri.php',
      success:function(result) {
           $('.msgs').fadeIn();
           $('.msgs').addClass("alert alert-success");
           $('.msgs').html("image priority Updated Successfully");
          setTimeout(function(){ location.reload(); }, 3000);
            }
             })
              });
	</script>
          <script>
function visible(id){
    $("#"+id).css("display","block");
    $("#"+id).val("");
    $("#c_"+id).text("")
}
                $('input:radio[name="todo"]').change(function()
                                             {
                                                 if($(this).val()=="resize")
                                                 $("#todochoice").val("resize");
                                                 else
                                                 $("#todochoice").val("crop");
                                             });
                                              function ifradioselected()
                                           {
                                               if ($("#todochoice").val()=="" || $("#img_numm").val()=="0" || $("#config_error").val()==1)
                                               {
                                                   $("#config_error_msg").html("Error in configuration!");
                                                   setTimeout(function(){
                                                        $("#config_error_msg").html("");
                                                    }, 2000);
                                                   return false;
                                                   }
                                               else
                                               {
                                                 $("#cropped_img_width").val(cropboxdimension_width);
                                                 $("#cropped_img_height").val(cropboxdimension_height);
                                                 if(edit!=0)
                                                 $("#cropped_img_num").val(edit);
                                                 else
                                                 $("#cropped_img_num").val($(".imgdiv").length+1);
                                                 $(".avatar-save").click();
                                               }
                                           }
                                           function readURL_fordrag(file)
                                           {
                                                         if (file)
                                                            {
                                                                var reader = new FileReader();
                                                                reader.onload = function (e)
                                                                {
                                                                   $('#filesInfo').html('<img id="resizepreview" src="'+e.target.result+'">');
                                                                }
                                                                reader.readAsDataURL(file);
                                                            }
                                                            resizeAndPreview(file);
                                           }
                                           function readURL(input)
                                           {                       $("#dropped").val(0);
                                                            if (input.files && input.files[0])
                                                            {
                                                                var reader = new FileReader();
                                                                reader.onload = function (e)
                                                                {
                                                                   $('#filesInfo').html('<img id="resizepreview" src="'+e.target.result+'">');
                                                                }
                                                                reader.readAsDataURL(input.files[0]);
                                                            }
                                                            if (window.File && window.FileReader && window.FileList && window.Blob)
                                                            {
                                                                var files = document.getElementById('avatarInput').files;
                                                                for(var i = 0; i < files.length; i++) {
                                                                    resizeAndPreview(files[i]);
                                                                }
                                                            }
                                           }
                                           function resizeAndPreview(file)
                                           {
                                                        var reader = new FileReader();
                                                            reader.onloadend = function() {
                                                            var tempImg = new Image();
                                                            tempImg.src = reader.result;
                                                            tempImg.onload = function() {
                                                                var MAX_WIDTH = MAX_RESIZE_WIDTH;
                                                                var MAX_HEIGHT = MAX_RESIZE_HEIGHT;
                                                                var tempW = tempImg.width;
                                                                var tempH = tempImg.height;
                                                                var oriw=tempW;
                                                                var orih=tempH;
                                                                var ratio = Math.min(180 / tempW, 180 / tempH);
                                                                var displaywidth=tempW*ratio;
                                                                var displayheight=tempH*ratio;
                                                                if (tempW > tempH) {
                                                                    if (tempW > MAX_WIDTH) {
                                                                       tempH *= MAX_WIDTH / tempW;
                                                                       tempW = MAX_WIDTH;
                                                                    }
                                                                } else {
                                                                    if (tempH > MAX_HEIGHT) {
                                                                       tempW *= MAX_HEIGHT / tempH;
                                                                       tempH = MAX_HEIGHT;
                                                                    }
                                                                }
                                                                  var canvas = document.createElement('canvas');
                                                                    canvas.width = tempW;
                                                                    canvas.height = tempH;
                                                                    var ctx = canvas.getContext("2d");
                                                                    ctx.beginPath();
                                                                    ctx.rect(0, 0, canvas.width, canvas.height);
                                                                    ctx.fillStyle = "white";
                                                                    ctx.fill();
                                                                    ctx.drawImage(this,(canvas.width-tempW)/2, (canvas.height-tempH)/2, tempW, tempH);
                                                                    var dataURL = canvas.toDataURL("image/jpeg");
                                                                    $("#dataURL").val(dataURL);
                                                                    $('#filesInfo img').css("width",displaywidth+'px');
                                                                    $('#filesInfo img').css("height",displayheight+'px');
                                                                   // $('#filesInfo img').css("position",'absolute');
                                                                    $('#filesInfo img').css("margin",'auto');
                                                                    $('#filesInfo img').css("top",'0px');
                                                                    $('#filesInfo img').css("bottom",'0px');
                                                                    $('#filesInfo img').css("left",'0px');
                                                                    $('#filesInfo img').css("right",'0px');
                                                              }
                                                           }
                                                           reader.readAsDataURL(file);
                                           }
          $(document).ready(function() {
         // submit();
         /* setcropdim(); */
            $('input:radio[name="todo"]').change(function(){
                if($(this).val()=="resize")
            {
                 $("#todochoice").val("resize");
            }
            else
            {
               if($("#nnwidth").val() < cropboxdimension_width || $("#nnheight").val() < cropboxdimension_height )
               alert('Note : If Image dimensions are smaller than desired cropping dimension, blank space will be seen in remaining part!');
              $("#todochoice").val("crop");
            }
            });
           });
        function submit()
        {
               $("#msg").html("");
               $("#formdiv").css("display","none");
               $("#crop-avatar").css("display","block");
               num_of_images= $("#imgnumber").val();
               $("#numi").html("Number of Images to be uploaded:"+num_of_images);
               $("#cropped_img_numconst").val(num_of_images);
               $("#cropped_img_name").val($("#galname").val());
        }
        ///////////////////////////////////////////////////
        function addmoreimage()
        {
           edit=0;
           addingone=1;
           $("#avatar-view").click();
        }
        function editimg(i)
        {
           addingone=0;
           edit=i;
           $("#avatar-modal-label").html("Edit Image");
           $("#avatar-view").click();
        }
        function removeimg(i)
        {
           var r = confirm("Do you really want to delete this Image? Removing this Image will decrease Images count by 1?");
           if (r == true)
           {
                    $.ajax({
                    method: "POST",
                    url:"ajax.php",
                    data: {
                          removing_img:i ,
                          galleryname:$("#cropped_img_name").val(),
                          totalimgcount:$('#table-ajax tr').length -1
                          }
                      }).done(function(data)
                      {
                           num_of_images=num_of_images-1;
                           $("#cropped_img_numconst").val(num_of_images);
                           //reshow the updated table
                           $('#table-ajax tr:last').remove();
                           $("#imagesuploaded_"+i).attr("src","uploadedimages/"+ $("#cropped_img_name").val()+"_"+i+".png?timestamp=" + new Date().getTime());
                    });
           }
           else
           {  }
        }
          </script>
               <script>
             
                          $('.example').DataTable();
            
          
     
            function del(id)
            {      var imgid=id;
                       if(id!="")
                       {
                         var info={imgid:imgid};
                                  $.ajax({
                                        type:"POST",
                                        url:"delimg.php",
                                        data:info,
                                        success:function(response){
                                           if(response==1)
                                              {
                                                $('.msgs').fadeIn();
                                                  $('.msgs').addClass("alert alert-success");
                                                  $('.msgs').html("Image Deleted Successfully");
                                                  $('.msgs').delay(5000).fadeOut();
                                                location.reload();
                                              }
                                              else
                                              {
                                               $('.msgs').fadeIn();
                                               $('.msgs').addClass("alert alert-danger");
                                                $('.msgs').html("ERROR..");
                                                $('.msgs').delay(5000).fadeOut();
                                              }
                                        }
                                  });
                       }
            }
            function getval(a)
            {
                window.c=a;
            }
            function updatedata()
            {
               /* var details=$(".text_details").val();   */
                var details=sliderdata.elements["text_details"].value;
               /* var btn_name=sliderdata.elements["btn_name"].value;    */
                var btn_link=sliderdata.elements["btn_link"].value;
                var img_id=sliderdata.elements["img_id"].value;
                var setpos=sliderdata.elements["position"].value;
                 var isbold= document.getElementsByClassName('isbold');
                  var isitalic=$("#isitalic:checked").val();
                  var isunderline=$("#isunderline:checked").val();
                   if (document.getElementsByClassName('isbold').checked) {
                        alert("checked");
                    } else {
                        alert("You didn't check it! Let me check it for you.");
                    }
                if(window.c!=""||window.c!="undefined")
                {
                  var pos=window.c;
                }
                else
                {
                    var pos=setpos;
                }
                 var text_font=sliderdata.elements["text_font"].value;
                  var text_color=sliderdata.elements["t_color"].value;
                 var text_size=sliderdata.elements["text_size"].value;
               /* if(details!="" && btn_name!="" && btn_link!=""&& pos!="")
                {*/
                     $.ajax({
                          type:"POST",
                          url:"updatetext.php",
                          data:{img_id:img_id,details:details,btn_link:btn_link,pos:pos,text_font:text_font,text_color:text_color,text_size:text_size,bold:bold,italic:italic,underline:underline},
                          success:function(response){
                               if(response==1)
                               {
                                   $('.msgs12').fadeIn();
                                  $('.msgs12').css("background","green");
                                   $('.msgs12').css("color","white");
                                  $('.msgs12').html("Details Updated");
                                  $('.msgs12').delay(5000).fadeOut();
                                  $("#myModal1").css("display","none");
                                 $("#myModal1").css("opacity","0");
                                 location.reload();
                               }
                               else
                               {
                                   $('.msgs12').fadeIn();
                                  $('.msgs12').css("background","red");
                                   $('.msgs12').css("color","white");
                                  $('.msgs12').html("Fail To upload");
                                  $('.msgs12').delay(5000).fadeOut();
                                   $("#myModal1").css("display","none");
                                    $("#myModal1").css("opacity","0");
                               }
                          }
                    });
             /*  }
                else
                {
                      $('.msgs12').fadeIn();
                      $('.msgs12').css("color","red");
                      $('.msgs12').html("Insert All Details");
                      $('.msgs12').delay(5000).fadeOut();
                }*/
            }
            function view(imgid)
            {
                  $.ajax({
                  type:"POST",
                  url:"viewdetails.php",
                  data:{img_id:imgid},
                  success:function(response){
                   $("#myModalLabel").html("Image Text")
                   $(".modal-body").html(response);
                    $("#myModal1").modal("show");
                  }
                  });
            }
             function setprio(imgid,textid)
            {
                var prio=("#"+textid).val();
               var img= imgid;
               var info={prio:prio,img:img}
                  $.ajax({
                  type:"POST",
                  url:"setpriority.php",
                  data:info,
                  success:function(response){
                     location.reload();
                  }
                  });
            }
        </script>
              <script>
               function setpri(id)
          {
           var imgid =id;
          var priority = $('#'+id).val();
       
           var info={imgid:imgid,priority:priority};
                                  $.ajax({
                                        type:"POST",
                                        url:"setpri.php",
                                        data:info,
                                        success:function(response){
                                           if(response==1)
                                              {
                                                $('.msgs').fadeIn();
                                                  $('.msgs').addClass("alert alert-success");
                                                  $('.msgs').html("Priority set ");
                                                  $('.msgs').delay(5000).fadeOut();
                                                location.reload();
                                              }
                                              else if(response ==0)
                                              {
                                               $('.msgs').fadeIn();
                                               $('.msgs').addClass("alert alert-danger");
                                                $('.msgs').html("ERROR..");
                                                $('.msgs').delay(5000).fadeOut();
                                              }
                                               else if(response ==2)
                                              {
                                               $('.msgs').fadeIn();
                                               $('.msgs').addClass("alert alert-danger");
                                                $('.msgs').html("This Priority already exist");
                                                $('.msgs').delay(5000).fadeOut();
                                              }
                                        }
                                  });
          }
           function closse()
            {
              $(".close").click();
            }
              </script>
                <script>
 function showdelopopup(delid)
            {
                 $.ajax({
                  type:"POST",
                  url:"delpopup.php",
                  data:{delid:delid},
                  success:function(response){
                   $(".modal-footer").html(response);
                    $("#confirm").modal("show");
                  }
                  });
            }
</script>
</body>
</html>