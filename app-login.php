<?php include("includes/configuration.php"); ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITE_TITLE;?> | User Login</title>
    <?php include 'commoncss.php'?>
    <style>.tawk-min-container, .tawk-min-container .tawk-button, #st3s675fk7k1f9lofm0g{display: none !important;}</style>
</head>
<body class="bg-light">
<div class="container pt-5">
    <div class="row align-items-center w-100 justify-content-between mx-auto">
        <div class="col-12 text-center">
            <div class="logIn">
                <div><a class="navbar-brand" href="<?php echo SITEURL; ?>"><img src="<?php echo SITEURL; ?>/img/projectimage/logo.png" alt="logo" title="Maha-E-Seva" height="36" class="img-fluid"></a></div>
                <p class="cc-fs-16 fw-3 text-muted">Get Fastest Rent Agreement At Your Doorstep</p>
                <h4 class="mb-2 fw-6">LOGIN</h4>
                <p class="text-muted">Your contact number is necessary for us to verify your identity</p>
                <div class="loginmsgs"></div>
                <form class="log1 mobapplogin">
                    <div class="form-group">
                        <div class="input-group"><div class="input-group-prepend"><span class="input-group-text bg-white">+91</span></div><input type="text" id="loginmob" class="form-control border-left-0" placeholder="Mobile Number" onkeyup="mobnumbercheck('loginmob')" maxlength="10"></div>
                    </div>
                    <div><button type="button" class="btn btn-primary btn-block getotpbnt" onclick="getotp('loginmob')">GET OTP</button></div>
                    <div class="otp display-none">
                        <div class="form-group">
                            <div class="input-group"><div class="input-group-prepend"><span class="input-group-text bg-white"><i class="fa fa-eye" aria-hidden="true"></i></span></div>
                            <input type="text" class="form-control border-left-0" id="loginotp" placeholder="Enter OTP" maxlength="6"></div>
                            <!--<div class="input-group"><div class="input-group-addon"><i class="fa fa-eye" aria-hidden="true"></i></div><input type="text" class="form-control" id="loginotp" placeholder="Enter OTP"  maxlength="6"></div>-->
                        </div>  
                        <div class="small form-group text-center">Did Not Received OTP? Click to <a class="resendotp text-primary" onclick="resendotp('loginmob')">Resend OTP</a></div>
                        <div class="mt-3"><button type="button" class="btn btn-primary btn-block submit1 text-uppercase" onclick="verifyotp('loginmob','loginotp')">Verify And Login</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo SITEURL; ?>/js/jquery.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/popper.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/bootstrap.min.js"></script>
<script>
function checkname(){
    var name = $("#enqname").val(); var alphanumeric = /^[0-9a-zA-Z]+$/; var onlyalphabets = /[^\w\s]/gi; var inp = $("#enqname").val(); var last = inp.slice(-1);
    restrictspecialchars = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
    var isSplChar = restrictspecialchars.test(name);
    if(isSplChar){
        var no_spl_char = name.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, ''); $("#enqname").val(no_spl_char);
    } else if(isNaN(last)==false&&last!=" "){
        var newstr = inp.slice(0, -1); $("#enqname").val(newstr);
    } else if(name.length<=2){
        $("#enqname").css("border","1px solid red"); $("#errmsg").html("Enter min. 3 character").css("color","red");
    } else if(name.length>=3){
        $("#enqname").css("border-color","grey"); $("#errmsg").html("");
    }
}
function checkmob(){
    var mobile = $("#mobile").val();
    if(isNaN(mobile)){ var newstr = mobile.slice(0, -1); $("#mobile").val(newstr); }
    else if (!(mobile.charAt(0) == "9" || mobile.charAt(0) == "8" || mobile.charAt(0) == "7")){
        $("#mobile").css("border", "1px solid red"); $("#errmsg").html("No should start with 7,8 or 9").css("color","red");
    } else if(mobile.length!=10){
        $("#mobile").css("border", "1px solid red"); $("#errmsg").html("Please check the No").css("color","red");
    } else{
        $("#mobile").css("border", "1px solid #BDBDBD"); $("#errmsg").html("");
    }
}
$('#enqemail').on('keyup', function(){
    var email = $("#enqemail").val(); var patt = new RegExp(/^[a-zA-Z0-9_\-\.\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/);   var res = patt.test(email);
    if(res){ $("#erremail").html(" "); } else{ $("#erremail").html("Please enter valid email ").css('color', 'red'); }
});
function checkmessage(){
    var message = $("#message").val();
    if(message==""){
        $("#message").css("border", "1px solid red"); $("#errmsg").html("Please enter message").css("color","red");
    } else if(message.length<=5){
        $("#message").css("border","1px solid red"); $("#errmsg").html("Enter min. 6 character").css("color","red");
    } else if(message.length>=3){
        $("#message").css("border-color","grey"); $("#errmsg").html("");
    }
}
$("#enqsubmit").click(function(){
    var name = $("#enqname").val(); var mobile = $("#mobile").val(); var email = $("#enqemail").val(); var patt = new RegExp(/^[a-zA-Z0-9._\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/); var res = patt.test(email); var message = $("#message").val();
    if(name==""){ $("#enqname").css("border","1px solid red"); }
    else if(mobile==""){ $("#mobile").css("border","1px solid red"); }
    else if(!res){ $("#erremail").html("Please enter valid email ").css('color', 'red'); }
    else if(message==""){ $("#message").css("border","1px solid red"); }
    else{
        $.ajax({
            url : "<?php echo SITEURL; ?>/enquirysms.php", type : "post", data : {name:name, mobile:mobile, email:email, message:message,action:"sendotp"},
            success : function(res){
                $("#enqsubmit").attr('disabled',false);
                $("#enqsubmit img").remove();
                if(res==1){
                    $("#errmsg").fadeIn().html("Thank you for contacting us. We will get back to you soon.").css("color","green").fadeOut(5000);
                    $("#mahae").trigger('reset');
                } else{ $("#errmsg").html("Message Not Sent").css("color","red"); }
            }
        });
    }
});
function mobnumbercheck(id){
    var inp = $("#"+id).val(); var last = inp.charAt(0);
   
    if(isNaN(inp)){ var newstr = inp.slice(0, -1); $("#"+id).val(newstr); }
    if(last!=7&&last!=8&&last!=9){ $("#"+id).val(""); }
    
    if(inp.length=="10"){ $(".getotpbnt").attr("disabled",false); }
    else{ $(".getotpbnt").attr("disabled",true); }
}
function numbercheck(id){
    var inp = $("#"+id).val();
    if(isNaN(inp)){ var newstr = inp.slice(0, -1); $("#"+id).val(newstr); } else{ }
}
function namechk(id){
    var name = $('#'+id).val();
    var alphanumers = /^[a-zA-Z]+$/;
    if(!alphanumers.test(name)){ var newstr = name.slice(0, -1); $("#"+id).val(newstr); }
}
function mailchk(id){
    var email = $("#"+id).val();
    var patt = new RegExp(/^([\w\-\.]+)@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([\w\-]+\.)+)([a-zA-Z]{2,4}))$/);
    var res = patt.test(email);
    if(res){ } else{ $("#"+id).val(""); $("#"+id).focus(); }
}
function getotp(mob){
    var mob = $("#"+mob).val();
    if(mob.length=="10"){
        $(".getotpbnt,.cancelloging0").attr("disabled",true);
        var info={mob:mob,action:"sendotp"};
        $.ajax({
            type:"POST", url:"<?php echo SITEURL; ?>/ajax.php", data:info,
            success:function(response){
                if(response==1){
                    $(".getotpbnt,.cancelloging0").hide(); $(".otp").show(); $("#"+mob).attr("disabled",true);
                } else{ $(".loginmsgs").fadeIn().removeClass("alert alert-success").html("Error in OTP sending.. Try after some time").addClass("alert alert-danger").delay(3000).fadeOut(); }
            }
        });
    } else{ $(".loginmsgs").fadeIn().removeClass("alert alert-success").html("Enter Valid Mobile Number").addClass("alert alert-danger").delay(3000).fadeOut(); }
}
function resendotp(val1){
    var mob = $("#"+val1).val(); var info = {mob:mob,action:"resendotp"};
    $(".resendotp").html("Please Wait.. Resending..");
    $.ajax({
        type:"POST", url:"<?php echo SITEURL; ?>/ajax.php", data:info,
        success:function(response){
            $(".resendotp").html('Click To Resend OTP');
            if(response==1){ } else{ }
        }
    });
}
function verifyotp(mob,otp){
    var mob = $("#"+mob).val(); var otp = $("#"+otp).val(); var info = {mob:mob,otp:otp,action:"verifyotp"};
    $.ajax({
        type:"POST", url:"<?php echo SITEURL; ?>/ajax.php", data:info,
        success:function(response){
            if(response==1){
                $(".loginmsgs").fadeIn().removeClass("alert alert-success").html("OTP Expired.. Try after some time").addClass("alert alert-danger").delay(3000).fadeOut();
            } else if(response==0){
                $(".loginmsgs").fadeIn().removeClass("alert alert-success").html("Invalid OTP").addClass("alert alert-danger").delay(3000).fadeOut();
            } else if(response==2){
                $(".loginmsgs").fadeIn().removeClass("alert alert-success").html("Invalid Details").addClass("alert alert-danger").delay(3000).fadeOut();
            } else{ window.location.href = "<?php echo SITEURL; ?>/account"; }
        }
    });
}
function filluserdetails(uid,fname,lname,email){
    var uemail = $("."+email).val(); var ulname = $("."+lname).val(); var ufname = $("."+fname).val(); var u_id = $("."+uid).val();
    if(ufname==""||ulname==""||uemail==""){
        $(".usermsgs").fadeIn().removeClass("alert alert-success").html("Please fill all details to proceed").addClass("alert alert-danger").delay(3000).fadeOut();
    } else{
        $(".updatedata,.logout2").attr("disabled",true);
        var info = {ufname:ufname,ulname:ulname,uemail:uemail,uid:u_id,action:"filluserdata"};
        $.ajax({
            type:"POST", url:"<?php echo SITEURL; ?>/ajax.php",
            data:info,
            success:function(response){
                $(".updatedata,.logout2").attr("disabled",false);
                $(".updatedata img").remove();
                if(response==1){ location.reload(); }
                else{ $(".usermsgs").fadeIn().removeClass("alert alert-success").html("Error in storing details").addClass("alert alert-danger").delay(3000).fadeOut(); }
            }
        });
    }
}
function calculate(){
    proparea = $(".calpropertytype option:selected").val(); duration = $(".calduration").val(); deposite = $(".caldeposite ").val(); rent = $(".calrent").val(); service="<?php echo SERVICECHRG; ?>";  //service charges
    visticharge = '<?php echo VISITCHRG ?>';
    if(duration!=""&&deposite!=""&&rent!=""){
        totalinamt = rent * duration; depo10 = (deposite/100)*10; tax = parseInt(totalinamt)+parseInt(depo10);
        stamp = (tax*0.25)/100; rval = Math.round(stamp); roundup = rval;
        totalchrgs = parseInt(roundup)+parseInt(service)+parseInt(proparea)+parseInt(visticharge);
        result='<div class="panel-body">' +
        '<br>'+
        '<h3 class="mb-3">Rent Agreement Registration Cost</h3>'+
        '<table class="table table-bordered mb-0">'+
        '<tr><td class="py-2"><b>Registaration Charges</b></td><td class="py-2">Rs. '+parseInt(proparea)+'</td></tr>'+
        '<tr><td class="py-2"><b>Stamp Duty</b></td><td class="py-2">Rs. '+parseInt(roundup)+'</td></tr>'+
        '<tr><td class="py-2"><b>Service Charges</b></td><td class="py-2">Rs. '+parseInt(service)+'</td></tr>'+
        '<tr><td class="py-2"><b>Visit Charges</b></td><td class="py-2">Rs. '+parseInt(visticharge)+'</td></tr>'+
        '<tr><td class="py-2"><h5>Total Charges</h5></td><td class="py-2"><h5>Rs. '+totalchrgs+'</h5></td> </tr>'+
        '<table>'+
        '</div>';
        $(".calculate-result").html(result);
    } else{
        $(".calcimsgs").removeClass("alert alert-success").addClass("alert alert-danger").fadeIn().html("Please Enter All Details For Calculations").delay(5000).fadeOut();
    }
}
function roundUp1(value){ return (~~((value + 99) / 100) * 100); }
$(function(){
    $('a').each(function(){
        if($(this).prop('href') == window.location.href){ $(this).addClass('active'); $(this).parents('li').addClass('active'); }
    });
});
function goBack(){ window.history.back(); }
</script>
</body>
</html>