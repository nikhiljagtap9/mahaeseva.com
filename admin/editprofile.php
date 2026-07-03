<?php include("../includes/configuration.php"); ?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | Edit Admin Profile</title>
    <? include "commoncss.php"; ?> 
</head>
<body>
<div class="page-body-wrapper">
    <? include 'header.php'; ?>
    <? include 'cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Authentication</h2></div><div class="btn-actions-pane-right"><button type="button" class="btn btn-primary btn-sm" onclick="showform()">Edit</button> <button class="btn btn-secondary btn-sm" onclick="goBack()">Back</button></div>
                </div>
                <div class="card-body profileinfo">
                    <div class="input-wrap mobErr"></div><div class="input-wrap pwd1Err"></div><div class="input-wrap pwdErr"></div>
                    <div class="row">
                        <div class="info col-lg-8 col-xl-6">
                            <div class="row">
                                <div class="col-4 col-sm-3 col-md-3 col-xl-3 cc-col-pad-view">Username</div>
                                <div class="col-8 col-sm-6 col-md-8 col-xl-8 cc-col-pad-view text-secondary"><?php echo $uname; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-sm-3 col-md-3 col-xl-3 cc-col-pad-view">Mobile</div>
                                <div class="col-8 col-sm-6 col-md-8 col-xl-8 cc-col-pad-view text-secondary"><?php if($result[0]['u_mob']){echo $result[0]['u_mob'];}else{echo "[Not Defined]"; } ?></div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-sm-3 col-md-3 col-xl-3 cc-col-pad-view">Password</div>
                                <div class="col-8 col-sm-6 col-md-8 col-xl-8 cc-col-pad-view text-secondary"><?php echo "<b>******</b>"; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal pt-3 profileform cc-display-none">
                    <div class="info col-lg-12 col-xl-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-xl-4 col-form-label">Username</div>
                            <div class="col-sm-8 col-md-6 col-lg-5 col-xl-8">
                                <input type="hidden" name="userid" id="userid" value="<?php echo base64_encode($result[0]['u_id']); ?>"/>
                                <input type="text" name="uname" class="form-control" id="username" value="<?php  echo $uname; ?>" placeholder="Username " maxlength="15"/>
                            </div>
                            <div class="col-md-5 unameErr"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-xl-4 col-form-label">Mobile</div>
                            <div class="col-sm-8 col-md-6 col-lg-5 col-xl-8"><input type="text" name="umbl" class="form-control number" id="umbl" value="<?php echo $result[0]['u_mob']; ?>" onkeyup="numbercheck('umbl')" placeholder="Mobile Number" maxlength="10"/></div>
                        </div>
                        <div class="form-group row chngpwdbtn">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-xl-4 col-form-label pt-0">Password</div>
                            <div class="col-sm-8 col-md-6 col-lg-5 col-xl-8"><a class="form-control-static chngpwd text-primary cc-cursor-pointer" onclick="showpwd()">I Want To Change My Password</a>
                            </div>
                        </div>
                        <div class="form-group row pwd cc-display-none">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-xl-4 col-form-label">New Password</div>
                            <div class="col-sm-8 col-md-6 col-lg-5 col-xl-8"><input type="password" name="pwd" class="form-control" id="pwd" placeholder="New Password" maxlength="15"/></div>
                        </div>
                        <div class="form-group row pwd cc-display-none">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-xl-4 col-form-label">Confirm Password</div>
                            <div class="col-sm-8 col-md-6 col-lg-5 col-xl-8"><input type="password" name="pwd1" class="form-control" id="pwd1" placeholder="Confirm New Password" maxlength="15"/></div>
                        </div>
                    </div>
                    <div class="card-footer text-right py-2">
                        <button class='btn btn-primary' onclick="chkdetails()" type="button">Update</button>
                        <button class='btn btn-secondary' onclick="canceledit()" type="button">Cancel</button>
                    </div>
                </form>
                <div class="pro-otp-col"><form class="form-horizontal otpform"></form></div>
            </div>
        </div>
        <?php include('footer.php');?>
    </div>
</div>
<script>
function numbercheck(id){
    var inp = $("#"+id).val();
    if(isNaN(inp)){ var newstr = inp.slice(0, -1); $("#"+id).val(newstr); }
}
function showpwd(){ $(".pwd").toggle(); $(".chngpwdbtn").toggle(); }
function showform(){ $(".profileform").toggle(); $(".profileinfo").toggle(); }
function canceledit(){
    info = {action:"cancel"}
    $.ajax({ type:"post", url:"profileupdate.php", data: info, success:function(response){ location.reload(); } });
}
function chkdetails(){
    var username = $("#username").val(); var mobile = $("#umbl").val(); var pwd = $("#pwd").val(); var pwd1 = $("#pwd1").val(); var userid = $("#userid").val(); var patt = new RegExp(/^[7-9][0-9]{9}$/); var res = patt.test(mobile);
    if(res==false){
        $(".mobErr").fadeIn().addClass("alert alert-danger").html("Invalid Mobile Number").delay(5000).fadeOut();
    } if(pwd!=""&&pwd1==""){
        $(".pwd1Err").fadeIn().addClass("alert alert-danger").html("Please Confirm Your Password").delay(5000).fadeOut();
    } if(pwd1!=""&&pwd==""){
        $(".pwdErr").fadeIn().addClass("alert alert-danger").html("Password Field Not Be Blank").delay(5000).fadeOut();
    } if((pwd1!=""&&pwd!="")&&(pwd!==pwd1)){
        $(".pwd1Err").fadeIn().addClass("alert alert-danger").html("Confirm Password Not Matched").delay(5000).fadeOut();
    } if(res==true&&((pwd1==""&&pwd=="")||((pwd1!=""&&pwd!="")&&(pwd===pwd1)))){
        info = {userid:userid,username:username,mobile:mobile,pwd:pwd,pwd1:pwd1,action:"sendotp"}
        $.ajax({
            type:"post", url:"profileupdate.php", data: info, success:function(response){
                if(response==1){
                    $.ajax({ type:"post", url:"editprofileotp.php", data: info,
                        success:function(response){ $(".profileform").hide(); $(".otpform").replaceWith(response); }
                    });
                } else{ }
            }
        });
    }
}
function resendotp(val1){
    var info = {mob:val1,action:"resendotp"};
    $(".resendloader").html("Please Wait.. Resending..");
    $.ajax({
        type:"POST", url:"profileupdate.php", data:info,
        success:function(response){
            $(".resendloader").html('<button class="btn btn-link resendbtn" onclick="resendotp('+val1+')"> Resend Now </button>');
            if(response==1){ } else{ }
        }
    });
}
function verifyotp(){
    var username = $("#username").val(); var mobile = $("#umbl").val(); var pwd = $("#pwd").val(); var pwd1 = $("#pwd1").val(); var userid = $("#userid").val(); var otp=$("#otp").val();
    var info = {userid:userid, username:username, mobile:mobile, pwd:pwd, pwd1:pwd1,otp:otp,action:"verifyotp"};
    $.ajax({
        type:"POST", url:"profileupdate.php", data:info,
        success:function(response){
            if(response==1){
                $(".msgs").fadeIn().html("OTP Expired").addClass("alert alert-danger").delay(2000).fadeOut();
            } else if(response==0){
                $(".msgs").fadeIn().html("Invalid OTP").addClass("alert alert-danger").delay(2000).fadeOut();
            } else{ setTimeout(function(){ location.href=response; }, 3000); }
        }
    });
}
</script>
</body>
</html>