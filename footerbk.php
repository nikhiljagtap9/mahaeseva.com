<?php $desktop = selectQuery(VLIST,"count(*) as count","device<>'android' AND device<>'Windows Phone' AND device<>''");
$mobile = selectQuery(VLIST,"count(*) as count","(device='android' OR device='Windows Phone') AND device<>''"); ?>
<footer class="main-footer bg-dark pt-4 pt-md-5">
    <div class="container foot-main">
        <div class="row pb-4 pb-md-5">
            <div class="col-sm-6 col-md-4 col-lg-4 pr-4 mb-4 mb-md-0">
                 <div class="foot-contact-col">
                    <h5 class="foot-head mb-3 fw-5">Contact Information</h5>
                    <div class="footer-contacts mb-3"><div class="media"><i class="fa fa-phone"></i><div class="media-body"><a href="#"><?php echo CONTACTNO; ?></a></div></div></div> 
                    <div class="footer-contacts mb-3"><div class="media"><i class="fa fa-envelope"></i><div class="media-body"><a href="#"><?php echo email_footer; ?></a></div></div></div> 
                    <div class="footer-contacts"><div class="media"><i class="fa fa-map-marker"></i><div class="media-body"><?php echo ADDRESS; ?></div></div></div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <h5 class="foot-head mb-3 fw-5">Customer Services</h5>
                <ul class="list-unstyled foot-menu">
                    <li><a href="<?php echo SITEURL; ?>/termsconditions" class="pt-0">Terms & condition</a></li>
                    <li><a href="<?php echo SITEURL; ?>/privacy-policy">Privacy Policy</a></li>
                    <li><a href="<?php echo SITEURL; ?>/cancellation-refund-policy">Cancellation & Refund</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <h5 class="foot-head mb-3 fw-5">Social Links</h5>
                <ul class="social-links list-inline mb-0"><li><a href="<?=FBLINK; ?>" target="_blank" class="mb-3"><i class="fa fa-facebook"></i> Facebook</a></li><li><a href="<?=TWITTERLINK;?>" target="_blank" class="mb-3"><i class="fa fa-twitter"></i> Twitter</a></li><li><a href="<?=INSTAGRAMLINK; ?>" target="_blank"><i class="fa fa-instagram"></i> Instagram</a></li>
                </ul>    
            </div>
            <div class="col-12">
                <div class="foot-ser-link mt-4">
                    <h5 class="foot-head fw-5 mb-3">Important Links</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="<?php echo SITEURL; ?>">Online Rent Agreement</a></li>
                        <li><a href="<?php echo SITEURL; ?>">Rent Agreement</a></li>
                        <li><a href="<?php echo SITEURL; ?>">Registered Rent Agreement</a></li>
                        <li><a href="<?php echo SITEURL; ?>">Registered Agreement</a></li>
                        <li><a href="<?php echo SITEURL; ?>">Rent Agreement In Pune</a></li>
                        <li><a href="<?php echo SITEURL; ?>">Online Rent Agreement In Pune</a></li>
                        <li><a href="<?php echo SITEURL; ?>">Doorstep Rent Agreement</a></li>
                        <li><a href="<?php echo SITEURL; ?>">Online Rent Agreement Cost</a></li>
                        <li><a href="<?php echo SITEURL; ?>">Rent Agreement Online Charges</a></li>
                        <li><a href="<?php echo SITEURL; ?>">Rent Agreement Process</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer bg-dark pt-4 pb-5 pb-md-5">
        <div class="container">
            <div class="row mb-4 mb-md-0">
                <div class="col-md-5"><p class="copyright mb-2 mb-md-0">&copy; <?php echo SITENAME; ?> <?php echo date("Y"); ?> All Rights Reserved</p></div>
                <div class="col-md-7 text-md-right">Website Intelligence By - <a href="https://www.surun.in/" class="endcolor" target="_blank" itemscope itemtype="http://schema.org/Organization">Surun Infocore Systems</a></div>
            </div>
        </div>
    </div>
</footer>
<!-- Enquiry On SMS -->
<div class="sentEnquiry" id="sentenq">
    <div class="card">
        <div class="panel-heading sentEnquiryHead"><div class="panel-title"><i class="fa fa-envelope" aria-hidden="true"></i> Enquiry On SMS</div></div>
        <div class="panel-body">
            <form id="mahae">
                <?php function generateRandomString($length1=10){
                    $original_string1 = array_merge(range(0,9), range('a','z'), range('A', 'Z'));
                    $original_string1 = implode("", $original_string1);
                    return substr(str_shuffle($original_string1), 0, $length1);
                }
                $randstring1 = generateRandomString(3);   //Passing random string length
                $_SESSION['randomstring1'] = $randstring1; ?>
                <input type="hidden" name="sessionval" id="sessionval1" value="<?php echo $randstring1;?>"/>
                <div class="form-group">
                    <label>Name<span class="star">*</span></label>
                    <input type="text" id="enqname" class="form-control" onkeyup="checkname();" maxlength="30" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label>Mobile No<span class="star">*</span></label>
                    <input type="text" id="mobile" class="form-control" onkeyup="checkmob();" maxlength="10" placeholder="Enter Mobile No">
                </div>
                <div class="form-group">
                    <label>Email<span class="star">*</span></label>
                    <input type="text" id="enqemail" class="form-control" maxlength="50" placeholder="Enter Email">
                    <span id="erremail"></span>
                </div>
                <div class="form-group">
                    <label>Message<span class="star">*</span></label>
                    <textarea  id="message" class="form-control" onkeyup="checkmessage();" rows="3" maxlength="150" placeholder="Enter Message"></textarea>
                    <span id="errmsg"></span>
                </div>
                <button type="button" id="enqsubmit" class="btn btn-default sendEnquirybtn">Submit</button>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo SITEURL; ?>/js/jquery.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/popper.min.js"></script>
<script  src="<?php echo SITEURL; ?>/js/bootstrap.min.js"></script>
<script>(function(a,b,c,d){try{var e=b.head||b.getElementsByTagName("head")[0];var f=b.createElement("script");f.setAttribute("src",c);f.setAttribute("charset","UTF-8");f.defer=true;a.neuroleadId=d;e.appendChild(f)}catch(g){}})(window,document,"https://cdn.leadster.com.br/neurolead/neurolead.min.js","018TSuO6alfRQUBImjxHTeYat")</script>

<?php if(count($loginuserdetails)&&($ufname==""||$uemail=="")){ ?>
<script>$(document).ready(function(){ $("#loginmod1").modal("show"); })</script>
<? } ?>
<script>var chatbot_id=21904;!function(){var t,e,a=document,s="smatbot-chatbot";a.getElementById(s)||(t=a.createElement("script"),t.id=s,t.type="text/javascript",t.src="https://smatbot.s3.amazonaws.com/files/smatbot_plugin.js.gz",e=a.getElementsByTagName("script")[0],e.parentNode.insertBefore(t,e))}();</script><script src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/1.5.1/fingerprint2.min.js"></script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', '<?php echo GOOGLEANAYTICSID ?>', 'auto');
ga('send', 'pageview');
</script>
<script>
$(".sentEnquiry .sentEnquiryHead").click(function(){ $(".sentEnquiry .panel-body").slideToggle(); });
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
            } else{ document.location.href="/"; }
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
function closelogin(){ $("#loginmod").modal("hide"); $(".modal-backdrop").css("display", "none"); }
function calculate(){
    proparea = $(".calpropertytype option:selected").val(); duration = $(".calduration").val(); deposite = $(".caldeposite ").val(); rent = $(".calrent").val(); service="<?php echo SERVICECHRG; ?>";  //service charges
    visticharge = '<?php echo VISITCHRG ?>';
    var dhccharge = '<?php echo DHC; ?>';
    if(duration!=""&&deposite!=""&&rent!=""){
        totalinamt = rent * duration; depo10 = (deposite/100)*10; tax = parseInt(totalinamt)+parseInt(depo10);
        stamp = (tax*0.25)/100; rval = Math.round(stamp); roundup = rval;
        totalchrgs = parseInt(roundup)+parseInt(service)+parseInt(proparea)+parseInt(visticharge)+parseInt(dhccharge);
        result='<div class="panel-body">' +
        '<br>'+
        '<h3 class="mb-3">Rent Agreement Registration Cost</h3>'+
        '<table class="table table-bordered mb-0">'+
        '<tr><td class="py-2"><b>Registaration Charges</b></td><td class="py-2">Rs. '+parseInt(proparea)+'</td></tr>'+
        '<tr><td class="py-2"><b>Stamp Duty</b></td><td class="py-2">Rs. '+parseInt(roundup)+'</td></tr>'+
        '<tr><td class="py-2"><b>Service Charges</b></td><td class="py-2">Rs. '+parseInt(service)+'</td></tr>'+
        '<tr><td class="py-2"><b>Visit Charges</b></td><td class="py-2">Rs. '+parseInt(visticharge)+'</td></tr>'+
        '<tr><td class="py-2"><b>DHC</b></td><td class="py-2">Rs. '+parseInt(dhccharge)+'</td></tr>'+
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
function limit(element){
    var max_chars = 10;
    if(element.value.length > max_chars){
        element.value = element.value.substr(0, max_chars);
        $(".getotpbnt").attr("disabled",false);
    }
}
function otplimit(otpcnt){
    var max_chars = 6;
    if(otpcnt.value.length > max_chars){
        otpcnt.value = otpcnt.value.substr(0, max_chars);
    }
}
</script>