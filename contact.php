<?php include("includes/configuration.php"); ?>
<!doctype html>
<html lang="en">
<head>
<title><?php echo SITE_TITLE;?> | Contact Us</title>
<?php include 'commoncss.php'?>
<script>
    function refreshCaptcha(){ var img = document.images['captchaimg']; img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000; }
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-726761326"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){ dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'AW-726761326');
</script>
</head>
<body class="bg-light">
<?php include 'menu.php' ?>
<div class="map"><iframe src="<?php echo MAP ?>" height="250" class="border-0"></iframe></div>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-5 pr-5 mb-5 mb-lg-0">
                <div class="section-title">
                    <h2 class="fw-7 h5">Select your queries & write to our experts.</h2>
                    <p class="cc-fs-16 fw-3 mb-4 text-muted">Mahaeseva is India's trusted do-it-yourself portal for legal documents. Our online tool lets you customize any legal document for your needs. We also assist you with Govt. services. Register your rent Agreement at your Door Step.</p>
                </div>
                <div class="cont-pg-details pt-2">
                    <div class="media mb-3">
                        <i class="fa fa-phone mt-1 mr-3 text-center text-white"></i>
                        <div class="media-body"><p class="fw-7 mb-0 small text-muted">CONTACT NUMBER</p><span class="cc-fs-16 fw-6"><?php echo CONTACTNO; ?></span></div>
                    </div>
                    <div class="media">
                        <i class="fa fa-map-marker mt-1 mr-3 text-center text-white"></i>
                        <div class="media-body"><p class="fw-7 mb-0 small text-muted">ADDRESS</p><span class="cc-fs-16 fw-6"><?php echo ADDRESS; ?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-7">
                <div class="contact-form-wrap">
                    <h2 class="fw-7 h5 mb-2">Contact Form</h2>
                    <p class="cc-fs-16 fw-3 mb-2 text-muted">You can submit your query or give us a call on : <span class="fw-8"><?php echo CONTACTNO; ?></span>.</p>
                    <div class="contformbody">
                        <div class="msgs"></div><div class="emlerr"></div><div class="teleerr"></div><div class="text-center"><?php if(isset($msg)){?>
                        <?php echo $msg;?>
                        <?php } ?> </div>
                        <form class="contactform inputBorder" name="contactform" action="#" method="post">
                            <div class="row">
                                <?php $getdept = selectQuery(SUPPORTDEPT,"*","isDel='0' and isActive='1'");
                                if(count($getdept)){ ?>
                                <div class="col-sm-6 col-md-6 pr-sm-0">
                                    <div class="form-group mb-2">
                                        <select class="form-control dept" name="dept">
                                            <option value="">Select Department</option>
                                            <?php for($i=0;$i<count($getdept);$i++){ ?>
                                            <option value="<?php echo $getdept[$i]['dept_id']; ?>"><?php echo $getdept[$i]['dept_name']; ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <? } else{ ?>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group mb-2"><select class="form-control dept" name="dept"><option value="">Select Department</option></select></div>
                                </div>
                                <? } ?>
                                <div class="col-sm-6 col-md-6"><div class="form-group mb-2"><input type="text" maxlength="50" minlength="3" class="form-control newattr" name="name" placeholder="Enter Your Name" value="" id="name"/></div></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 pr-0"><div class="form-group mb-2"><input type="text" class="form-control" maxlength="70" minlength="7" name="email" value="" placeholder="Enter Email Address" id="cemail" /></div></div>
                                <div class="col-sm-6 col-md-6"><div class="form-group mb-2"><input type="text" class="form-control" name="tele" id="tele" value="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Enter Mobile Number." maxlength="10" /></div></div>
                            </div>
                            <div class="form-group mb-2"><textarea name="cmnt" placeholder="Enter Your Comment Max Limit 300 Character." class="form-control" maxlength="300" id="textareas" rows="6"></textarea></div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3 col-md-3"><img src="<? echo SITEURL; ?>/captcha.php?rand=<?php echo rand();?>" id='captchaimg' alt="captchaimg"></div>
                                    <div class="col-sm-5 col-md-5"><div class="input-group mb-3"><input id="captcha_code" name="captcha_code" placeholder="Enter code" value="" type="text" autocomplete="off" class="form-control border-right-0"><div class="input-group-prepend rounded-right">
                                    <span class="input-group-text bg-white rounded-right border-left-0"><a href='javascript: refreshCaptcha();'><img src="img/projectimage/icons/refresh-button.svg" alt="refresh-button" width="15" data-no-retina class="svg"></a></span>
                                    </div></div></div>
                                </div>
                            </div>
                            <div class="pt-2"><button type="button" name="submit" class="btn btn-primary px-3 send" id="submit" onclick="validate();">Submit</button> <a href="<?php echo SITEURL; ?>/contactrequest" class="btn btn-dark px-3">Check Request Status</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php' ?>
<script src="js/particles.js/particles.min.js"></script>
<script src="js/particles.js/particles.settings.js"></script>
 <script>
function validate(){
    var name = document.contactform.name.value; var email = document.contactform.email.value; var tele = document.contactform.tele.value; var cmnt = document.contactform.cmnt.value; var dept = document.contactform.dept.value; var captcha_code = document.contactform.captcha_code.value; var patt = new RegExp(/^[a-zA-Z0-9._\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/); var res = patt.test(email); var patt1 = new RegExp(/^[7-9][0-9]{9}$/); var res1 = patt1.test(tele);
    if ((dept == "") || (name == "") || (email  == "") || (tele  == "") || (cmnt  == "") || (captcha_code == "") ||  (res == false ) || (res1 == false )){
        $('.msgs').fadeIn().addClass("alert alert-danger").html("Please fill all details correclty").delay(3000).fadeOut();
        return false;
    } else{
        $.ajax({
            url: '<?php echo SITEURL; ?>/contact_submit.php',
            type: 'POST',
            data: {name: name, email:email, tele:tele, dept:dept, cmnt:cmnt, captcha_code:captcha_code},
	        success: function(response){
	            $("#submit img").remove();
                if(response){
                    if(response==0){
                        $('.msgs').fadeIn(); $('.msgs').addClass("alert alert-danger"); $(".msgs").html("Please Try Again Later"); $('.msgs').delay(2000).fadeOut();
                    }
                    if(response==1){
                        $('.msgs').fadeIn().addClass("alert alert-success").html("Thank you for contacting us, our customer happiness manager will contact you soon.").delay(3000).fadeOut();
                        document.getElementById("name").value="";
                        document.getElementById("cemail").value="";
                        document.getElementById("tele").value="";
                        document.getElementById("textareas").value="";
                        document.getElementById("captcha_code").value="";
                    }
                    if(response==2){
                        $('.msgs').fadeIn().addClass("alert alert-danger").html("Captcha Not Match").delay(3000).fadeOut();
                    }
	           }
	       }
	   });
    }
}
function submitForm(){
    if(validate()){ document.forms["contactform"].submit(); document.forms["contactform"].reset(); }
}
$(document).ready(function(){
    $(".newattr").keydown(function(e){
        var key = e.which || e.keyCode;
        if (key >= 65 && key <= 90 || key == 190 || key == 188 || key == 109 || key == 110 || key == 32 || key == 8 || key == 9 || key == 13 || key == 35 || key == 36 || key == 37 || key == 39 || key == 46 || key == 45)
        return true;
        return false;
    });
});   
function numbercheck(id){
    $("#"+id).keyup(function(b){
        var a=b.which||b.keyCode;
        if((!b.shiftKey&&!b.altKey&&!b.ctrlKey&&a>=48&&a<=57||
        a>=96&&a<=105||a==190||a==188||a==109||a==110||a==8||a==9||a==13||a==35||a==36||a==37||a==39||a==46||a==45)||
        (b.ctrlKey&&a>=99&&a<=118)){ return true } else{ $("#"+id).val(""); return false; }
    });
}
function clearform(){
    document.getElementById("name").value=""; document.getElementById("cemail").value=""; document.getElementById("tele").value=""; document.getElementById("textareas").value=""; document.getElementById("captcha_code").value="";
}
$("#tele").on('blur',function(){
    var tele = $("#tele").val(); var patt = new RegExp(/^[7-9][0-9]{9}$/); var res = patt.test(tele);
    if(res){ $(".teleerr").html(""); }
    else{ $('.teleerr').fadeIn(); $('.teleerr').addClass("alert alert-danger"); $(".teleerr").html("Enter Valid Mobile Number &nbsp;"); $('.teleerr').delay(3000).fadeOut(); }
});
$('#cemail').on('blur',function(){
    var cemail = $("#cemail").val(); var patt = new RegExp(/^[a-zA-Z0-9._\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/); var res = patt.test(cemail);
    if(res){ $(".emlerr").html(" "); }
    else{
        $('.emlerr').fadeIn(); $('.emlerr').addClass("alert alert-danger"); $(".emlerr").html("Pleas Enter Valid email "); $('.emlerr').delay(3000).fadeOut();
    }
});
</script>
</body>
</html>