<?php include("../../includes/configuration.php"); include("config.php"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Testimonial</title>
    <?php include('../commoncss.php') ?>
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
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2">
                    <div><h2 class="card-head-title">Testimonials</h2></div>
                    <div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div>
                </div>
                <div class="card-body sliderimage">
                    <div class="d-none" id="formdiv">
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
                           <div id="crop-avatar">
                                       <div class="avatar-view bannerUploadBtn mb-3" title="Click here to Upload Images" id="avatar-view">
                                <button type="button" class="btn btn-primary btn-sm pull-left" id="edit">Add New Testimonial</button><br>
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
                                                    
                                                      <h4 class="h5 modal-title" id="avatar-modal-label">Upload Image : (<span id="avatar-modal-label_num">1/<? echo NUMBER_OF_IMG_UPLOAD; ?></span>)</h4>
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


                                                          <!--<label for="avatarInput">Choose Image</label>
                                                          <input type="file" class="avatar-input" id="avatarInput" name="avatar_file" onchange="readURL(this)" multiple>-->

                                                        </div>

                                                        <div class="row">
                                                          <div class="col-md-12">
                                                          <div id="filedrag">
                                                            <div class="avatar-wrapper" id="avatar-wrapper" >
                                                                <div class="text-center drag_drop_div">
                                                                   <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                                    <p>Drag & Drop file here</p>
                                                                </div>
                                                            </div>
                                                          </div>
                                                          </div>
                                                          <div class="col-md-3 text-center d-none">

                                                          <div  class="cropviewdiv">
                                                          <div class="radio">
                                                              <? if(DEFAULT_SAVE=="CROP") { ?>

                                                            <label class="radio"><input type="radio" id="cropradio" name="todo" value="crop" checked><b>Crop Preview</b></label>
                                                           <? } else { ?>

                                                            <label class="radio"><input type="radio" id="cropradio" name="todo" value="crop"><b>Crop Preview</b></label>
                                                           <? } ?>
                                                           </div>
                                                                <div class="avatar-preview preview-lg" id="prevlg">
                                                            <img src="cropimg/img/picture.jpg"  alt="cropimg">
                                                            </div>
                                                           </div>
                                                              <div class="resizeviewdiv">
                                                              <div class="radio">
                                                                <? if(DEFAULT_SAVE=="RESIZE") { ?>

                                                                <label class="radio"><input type="radio" name="todo" value="resize" checked><b>Resize Preview</b></label>
                                                            <? } else { ?>
                                                            <input type="radio" name="todo" value="resize" id="todoresize"><b>Resize Preview</b>
                                                              <? } ?>
                                                              </div>
                                                               <div  id="filesInfo">
                                                             <img src="../cropimg/img/picture.jpg" class="img-responsive" alt="cropimg">
                                                            </div>
                                                            </div>

                                                            <div class="avatar-preview preview-md d-none"></div>
                                                            <div class="avatar-preview preview-sm d-none"></div>

                                                          </div>
                                                        </div>
                                                        <div class="row avatar-btns">
                                                          <div class="col-md-12">
                                                            <button class="btn btn-primary" type="button" id='selectFile'>Select File</button>
                                                            <input type="file" class="avatar-input d-none" id="avatarInput" name="avatar_file" onchange="readURL(this)" multiple>
                                                             <button class="btn btn-success" type="button" onclick="ifradioselected()">Done</button>
                                                             <button type="submit" name="submitbutton" class="btn btn-success avatar-save d-none">Submit</button>
                                                             <button class="btn btn-dark" data-dismiss="modal" type="button">Close</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>
                        <div class="loadingmodal" aria-label="Loading" role="img" tabindex="-1"><div class="progress"></div><div id="percentage"></div></div>
                    </div>
                    <div class="alert alert-info">Note : The expected image dimensions are - <b><?php echo CROPBOX_WIDTH; ?>x<?php echo CROPBOX_HEIGHT; ?>  pixel</b>.</div>
                    <div class="msgs12"></div><div class="msgs"></div>
                    <div class="table-responsive tshufle">
                       <table class="table table-bordered">
                            <thead><tr><th>#</th><th>Image</th><th>Testimonial</th><th>Active / Deactive</th><th class="text-center">Delete</th></tr></thead>
                            <tbody class="tbodyrow">
                                <?php $gettestimonials = selectQuery(TESTIMONIALS,"*","isDel='0' ");
                                for($i=0;$i<count($gettestimonials);$i++){ ?>
                                <tr>
                                    <td><?php echo $i+1; ?></td>
                                    <td><div class="brandThumb"><img src="<?php echo SITEURL; ?>/img/testimonials/<?php echo $gettestimonials[$i]['test_image']; ?>" id="image" class="img-responsive" width="70"></div></td>
                                    <td class="" style="width:19% !important"><button onclick="view('<?php echo $gettestimonials[$i]['test_id']; ?>')" class="btn btn-primary btn-sm">View/Edit</button></td>
                                    <td style="width: 15%;"><input type="checkbox" class="tg"  data-toggle="toggle" data-on="Active" data-off="Deactive" data-id="<?php echo $gettestimonials[$i]['test_id']; ?>" data-width="100" data-height="30" id="checkbox_<?php echo $gettestimonials[$i]['test_id']; ?>" name="checkbox_<?php echo $gettestimonials[$i]['test_id']; ?>" <?php if($gettestimonials[$i]['isActive']==1){echo "checked";}else{echo "";} ?>>   </td>
                                    <td class="text-center" style="width:100px;"><button type="button" onclick="del('<?php echo $gettestimonials[$i]['test_id']; ?>')" class="btn btn-danger btn-sm deletebtn"><i class="fa fa-trash-o"></i></button></td>
                                </tr>
                                <? } ?>
                            </tbody>
                       </table>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h4 class="h5 modal-title" id="myModalLabel"></h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body" id="modal-body"></div></div></div></div>
<script src="<?php echo SITEURL; ?>/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script src="cropimg/dist/cropper.js"></script>
<script src="img_config/js/main.js"> </script>
<script>
$('#selectFile').click(function(){ $(".avatar-input[type='file']").trigger('click'); })
function visible(id){ $("#" + id).css("display", "block"); $("#" + id).val(""); $("#c_" + id).text("") }
$('input:radio[name="todo"]').change(function(){
    if($(this).val() == "resize") $("#todochoice").val("resize");
    else $("#todochoice").val("crop");
});
function ifradioselected(){
    if($("#todochoice").val() == "" || $("#img_numm").val() == "0" || $("#config_error").val() == 1){
        $("#config_error_msg").html("Error in configuration!");
        setTimeout(function(){ $("#config_error_msg").html(""); }, 2000);
        return false;
    } else{
        $("#cropped_img_width").val(cropboxdimension_width); $("#cropped_img_height").val(cropboxdimension_height);
        if(edit != 0) $("#cropped_img_num").val(edit);
        else $("#cropped_img_num").val($(".imgdiv").length + 1); $(".avatar-save").click();
    }
}
function readURL_fordrag(file){
    if(file){
        var reader = new FileReader();
        reader.onload = function(e){ $('#filesInfo').html('<img id="resizepreview" src="' + e.target.result + '">'); }
        reader.readAsDataURL(file);
    }
    resizeAndPreview(file);
}
function readURL(input){
    $("#dropped").val(0);
    if (input.files && input.files[0]){
        var reader = new FileReader(); reader.onload = function(e) { $('#filesInfo').html('<img id="resizepreview" src="' + e.target.result + '">'); }
        reader.readAsDataURL(input.files[0]);
    }
    if(window.File && window.FileReader && window.FileList && window.Blob){
        var files = document.getElementById('avatarInput').files;
        for(var i = 0; i < files.length; i++){ resizeAndPreview(files[i]); }
    }
}
function resizeAndPreview(file){
    var reader = new FileReader();
    reader.onloadend = function(){
        var tempImg = new Image();
        tempImg.src = reader.result;
        tempImg.onload = function(){
            var MAX_WIDTH = MAX_RESIZE_WIDTH; var MAX_HEIGHT = MAX_RESIZE_HEIGHT; var tempW = tempImg.width; var tempH = tempImg.height; var oriw = tempW; var orih = tempH; var ratio = Math.min(180 / tempW, 180 / tempH); var displaywidth = tempW * ratio; var displayheight = tempH * ratio;
            if(tempW > tempH){
                if(tempW > MAX_WIDTH){ tempH *= MAX_WIDTH / tempW; tempW = MAX_WIDTH; }
            } else{
                if(tempH > MAX_HEIGHT){ tempW *= MAX_HEIGHT / tempH; tempH = MAX_HEIGHT; }
            }
            var canvas = document.createElement('canvas');
            canvas.width = tempW;
            canvas.height = tempH;
            var ctx = canvas.getContext("2d");
            ctx.beginPath();
            ctx.rect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "white";
            ctx.fill();
            ctx.drawImage(this, (canvas.width - tempW) / 2, (canvas.height - tempH) / 2, tempW, tempH);
            var dataURL = canvas.toDataURL("image/jpeg");
            $("#dataURL").val(dataURL);
            $('#filesInfo img').css("width", displaywidth + 'px');
            $('#filesInfo img').css("height", displayheight + 'px');
            $('#filesInfo ').css("width", displaywidth + 'px');
            $('#filesInfo ').css("height", displayheight + 'px');
            // $('#filesInfo img').css("position",'absolute');
            $('#filesInfo img').css("margin", 'auto');
            $('#filesInfo img').css("top", '0px');
            $('#filesInfo img').css("bottom", '0px');
            $('#filesInfo img').css("left", '0px');
            $('#filesInfo img').css("right", '0px');
        }
    }
    reader.readAsDataURL(file);
}
$(document).ready(function(){
    $('input:radio[name="todo"]').change(function(){
        if ($(this).val() == "resize"){ $("#todochoice").val("resize");
        }else{
            if($("#nnwidth").val() < cropboxdimension_width || $("#nnheight").val() < cropboxdimension_height)
            alert('Note : If Image dimensions are smaller than desired cropping dimension, blank space will be seen in remaining part!');
            $("#todochoice").val("crop");
        }
    });
});
function submit(){
    $("#msg").html(""); $("#formdiv").css("display", "none"); $("#crop-avatar").css("display", "block");
    num_of_images = $("#imgnumber").val(); $("#numi").html("Number of Images to be uploaded:" + num_of_images); $("#cropped_img_numconst").val(num_of_images); $("#cropped_img_name").val($("#galname").val());
}
function addmoreimage(){ edit = 0; addingone = 1; $("#avatar-view").click(); }
function editimg(i){
    addingone = 0; edit = i; $("#avatar-modal-label").html("Edit Image"); $("#avatar-view").click();
}
function removeimg(i){
    var r = confirm("Do you really want to delete this Image? Removing this Image will decrease Images count by 1?");
    if(r == true){
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: { removing_img: i, galleryname: $("#cropped_img_name").val(), totalimgcount: $('#table-ajax tr').length - 1}
        }).done(function(data){
            num_of_images = num_of_images - 1;
            $("#cropped_img_numconst").val(num_of_images);
            //reshow the updated table
            $('#table-ajax tr:last').remove();
            $("#imagesuploaded_" + i).attr("src", "uploadedimages/" + $("#cropped_img_name").val() + "_" + i + ".png?timestamp=" + new Date().getTime());
        });
    } else{ }
}
$('.example').DataTable();
function view(imgid){
    $.ajax({
        type:"POST", url:"viewdetails.php", data:{img_id:imgid},
        success:function(response){
            $("#myModalLabel").html("Update Testimonial Details")
            $("#modal-body").html(response);
            $("#myModal1").modal("show");
        }
    });
}
function updatedata(){
    var client_name = banddata.elements["client_name"].value;
    var testimonials = banddata.elements["testimonials"].value;
    var img_id = banddata.elements["img_id"].value;
    $.ajax({
        type:"POST",
        url:"updatetext.php",
        data:{img_id:img_id,client_name:client_name,testimonials:testimonials},
        success:function(response){
            if(response==1){
                $('.msgs12').fadeIn().addClass("alert alert-success").html("Details Updated Successfully!!!").delay(5000).fadeOut();
                $("#myModal1").modal("hide");
                location.reload();
            } else{
                $('.msgs12').fadeIn().addClass("alert alert-danger").html("Fail To upload").delay(5000).fadeOut();
                $("#myModal1").modal("hide");
            }
        }
    });
}
$(".tg").on("change",function(){
    var testid = $(this).attr('data-id'); var getid = $(this).attr('id'); var c = $("#"+getid+":checked").val();
    if(c=="on"){     
        var info = {testid:testid,status:"1"};
        $.ajax({ type:"POST", url:"statuschng.php", data:info,
            success:function(response){
                if(response==1){     
                    $('.msgs').fadeIn().addClass("alert alert-success").html("Testimonial Activated Successfully").delay(5000).fadeOut();
                    location.reload();
                } else{    
                    $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut();
                    location.reload();
                }
            }
        });
    } else{
        var info = {testid:testid,status:"0"};
        $.ajax({
            type:"POST",
            url:"statuschng.php",
            data:info,
            success:function(response){
                if(response==1){     
                    $('.msgs').fadeIn().addClass("alert alert-success").html("Testimonial Deactivated Successfully").delay(5000).fadeOut();
                } else{     
                    $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut();
                }
            }
        });
    }
});
function del(id){
    var uid = id;
    if (id != ""){
        if(confirm("Are You Sure To Delete? ")){
            var info = { pid: uid, action: "deltesti" };
            $.ajax({
                type: "POST", url: "delimg.php", data: info,
                success: function(response){
                    if(response == 1){
                        $('.msgs').fadeIn().addClass("alert alert-success").html("Testimonial Deleted Successfully").delay(5000).fadeOut();
                        location.reload();
                    } else{
                        $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut();
                    }
                }
            });
        } else{ }
    }
}
</script>
</body>
</html>