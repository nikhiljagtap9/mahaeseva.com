<?php include ("../includes/configuration.php"); ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITE_TITLE; ?> | Account Details</title>
    <?php include '../commoncss.php' ?>
</head>
<body class="bg-light">
    <?php $user = $_SESSION['reguser']; $userdata = selectQuery(WEB_USER,"*","u_id=".$user); $prodid = base64_decode($_REQUEST['p']); $userid = base64_decode($_REQUEST['u']); $s = base64_encode($prodid); $complex = array($s); $prod = selectQuery(MODEL,"*","mod_id=".$prodid); $img = selectQuery(MOD_IMG,"*","mod_id=".$prodid." and isDel='0' LIMIT 1"); $review = selectQuery(REVIEW,"*","mod_id=".$prodid); $review1=selectQuery(REVIEW,"*","mod_id=".$prodid." AND u_id=".$userid);
    if( $user== ""){ ?>
    <script>var x ='<?php echo SITEURL; ?>'; window.location.assign(x);</script>
    <?php } ?>
    <?php $Notification = selectQuery(Notification,"*","isDel='0' and  isActive ='1' and Inmyaccount= '1' and show_on_all = '0'");
    if(count( $Notification)){ ?>
    <div class="notification">
        <div class="col-md-11 col-xs-12 notificationtext"><img src="<?php echo SITEURL; ?>/img/projectimage/<?php echo $Notification[0]['notificationico']; ?>" alt="notification"  class="pull-letf alertthumb"/>
        <div class="alertdescription"><a href="<?php echo $Notification[0]['notificationlink']; ?>" class="text-white"><?php echo $Notification[0]['notification']; ?></a></div></div>
        <div class="col-md-1 col-xs-2 text-right"><span class="fa fa-times" id="close_notification"></span></div>
    </div>
<?php } ?>
<?php include '../menu.php' ?>
<div class="content py-4">
    <div class="container">
        <h5 class="mb-3 fw-6">Account Details</h5>
        <div class="row">
            <?php include('sidebar.php')?>
            <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                <div class="editProfile card">
                    <div class="card-body">
                        <h5 class="mb-3 fw-6">Edit Profile</h5>
                        <div class="acntmsg"></div>
                        <input type="hidden" name="uid" id="uid" value="<?php echo $userdata[0]['u_id'];  ?>"/>
                        <form>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 pr-sm-0">
                                    <div class="form-group"><input type="text" name="userfname" class="form-control" id="ufname" value="<?php echo $userdata[0]['u_fname']; ?>" placeholder="First Name" maxlength="20" onkeyup="namechk('ufname')"/></div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group"><input type="text"  name="userlname" class="form-control" id="ulname" value="<?php echo $userdata[0]['u_lname'];  ?>" placeholder="Last Name" maxlength="20" onkeyup="namechk('ulname')"/></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 pr-sm-0">
                                    <div class="form-group">
                                        <input type="text" name="umbl" class="form-control" id="umbl" value="<?php echo $userdata[0]['u_mobile']; ?>" placeholder="Mobile No" maxlength="10" onkeyup="mobnumbercheck1('umbl')"/>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="adress" class="form-control" id="uadress" value="<?php  echo $userdata[0]['u_email']; ?>" placeholder="Email" maxlength="80" onblur="mailchk('uadress')"/>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary edit">Update Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade dellandlord" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">Enter OTP To Update your Profile</div>
            <div class="modal-body text-muted inputBorder">
                <div class="otpmsgs"></div>
                <input type="text" name="otp" class="form-control" id="otp" placeholder="OTP" maxlength="6"/>
            </div>
            <div class="modal-footer text-left"><button type="button" class="btn btn-primary btn-sm" onclick="validateotp()">Verify</button> <button type="button" class="btn btn-dark btn-sm" onclick="cancelupdate()">Close</button></div>
        </div>
    </div>
</div>
<?php include '../footer.php' ?>
<script>
$(document).ready(function(){
    $(".edit").click(function(){
        var uid = $("#uid").val(); var ufname = $("#ufname").val(); var ulname = $("#ulname").val(); var uemail = $("#uadress").val(); var umbl = $("#umbl").val(); var patt = new RegExp(/^[7-9][0-9]{9}$/); var res = patt.test(umbl);
        if((ufname == "") ||  (ulname == "") || (umbl == "") || (uemail == "") ){
            $(".acntmsg").fadeIn().html("Please fill all fields.").addClass("alert alert-danger").delay(2000).fadeOut();
        } else if(umbl==""){
            $(".acntmsg").fadeIn().html("Please enter mobile number").addClass("alert alert-danger").delay(2000).fadeOut();
        } else if(res==false){
            $(".acntmsg").fadeIn().html("Please enter valid mobile number").addClass("alert alert-danger").delay(2000).fadeOut();
        } else if(uemail==""){
            $(".acntmsg").fadeIn().html("Please enter email").addClass("alert alert-danger").delay(2000).fadeOut();
        } else{
            var info = { mob:umbl };
            $.ajax({
                type:"post", url:"otp.php", data: info, success:function(response){ $(".dellandlord").modal("show"); }
            })
            /* var info = { uid:uid, uname:uname, umbl:umbl, uemail:uemail, uadress:uadress, postal:postal };
            $.ajax({
                type:"post", url:"updateuseracnt.php", data: info,
                success:function(response){
                    $("#loaderc").html('');
                    if(response == 1){
                        $(".acntmsg").fadeIn().addClass("alert alert-success").html("Record Updated Successfully").delay(5000).fadeOut();
                        window.location.href = "index.php";
                    } if(response == 0){
                        $(".acntmsg").fadeIn().addClass("alert alert-danger").html("Problem Occurs While Updating").delay(5000).fadeOut();
                        window.location.href = "index.php";
                    }
                }
            });*/
        }
    });
});
function cancelupdate(){ $(".dellandlord").modal("hide"); }
function validateotp(){
    var otp = $("#otp").val(); var uid = $("#uid").val(); var ufname = $("#ufname").val(); var ulname = $("#ulname").val(); var uemail = $("#uadress").val(); var umbl = $("#umbl").val();
    var info = { code:otp };
    $.ajax({
        type:"post", url:"verify.php", data: info,
        success:function(response){
            if(response=="2"){
                $(".otpmsgs").fadeIn().html("OTP Expired.. Please try again later").addClass("alert alert-danger").delay(2000).fadeOut();
                setTimeout(function(){$(".dellandlord").modal("hide");  }, 3000);
            } else if(response=="0"){
                $(".otpmsgs").fadeIn().html("Invalid OTP").addClass("alert alert-danger").delay(2000).fadeOut();
            } else{
                $(".dellandlord").modal("hide");
                var info = { uid:uid, ufname:ufname, ulname:ulname, uemail:uemail, umbl:umbl };
                $.ajax({
                    type:"post", url:"updateuseracnt.php", data: info,
                    success:function(response){
                        if(response == 1){
                        $(".acntmsg").fadeIn().addClass("alert alert-success").html("Record Updated Successfully").delay(5000).fadeOut();
                        setTimeout(function(){ window.location.href="index.php";  }, 5000); }
                        if(response == 0){
                            $(".acntmsg").fadeIn().addClass("alert alert-danger").html("Problem Occurs While Updating").delay(5000).fadeOut();
                        }
                    }
                });
            }
        }
    })
}
function mobnumbercheck1(id){
    var inp = $("#"+id).val(); var last = inp.charAt(0);
    if(isNaN(inp)){ var newstr = inp.slice(0, -1); $("#"+id).val(newstr); }
    if(last!=7&&last!=8&&last!=9){ $("#"+id).val(""); }
}
</script>
</body>
</html>