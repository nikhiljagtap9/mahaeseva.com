<?php
    include("../includes/configuration.php");
    $panel="lms";
include("../callapi.php");

     $menusupportsetting=selectQuery(SUPPORTEMAIL,"*");
   $attachmentmax=$menusupportsetting[0]['attachment_size'];
   $allowedimgtypes=$menusupportsetting[0]['img_types'];
   $allowedapptypes=$menusupportsetting[0]['application_types'];

?>
 <!doctype html>
<html>
<head>
    <title><?php echo SITE_TITLE; ?> </title>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="t">
<meta name="description" content ="">
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/backlogin.css">
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/font-awesome-4.5.0/css/font-awesome.css" />

<link rel="shortcut icon" type="image/x-icon" href="<?php echo SITEURL; ?>/img/projectimage/favicon1.png">
<link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<script src="<?php echo SITEURL; ?>/js/jquery-1.12.0.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/bootstrap.min.js"></script>

</head>
<body class="mainbody">
 <div class="content" >
    <div class="contactRequest">
        <div class="col-md-4 col-md-offset-4 text-center header">
            <a href="<?php echo SITEURL; ?>/home" class="logo " itemscope>
                <img src="<?php echo SITEURL; ?>/img/projectimage/logo.png" alt="logo" title="<?php echo SITE_TITLE; ?>"   itemprop="logo" />
            </a>
        </div>
    <div class="container">
        <div class="row">
              <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-6 col-xs-12">
                <div class="card">
                    <div class="panel-body">
                        <div id="login-dialog">
                            <div class="msgsl"></div>
                            <form class="dialog-form inputField">
                                <div class="form-group">
                                   <input type="text" placeholder="Enter Email" class="form-control loginu" >
                                </div>
                                <div class="form-group">
                                <input type="button" value="I Have Password" class="btn btn-primary btnPrimary btn-block" id="pwd" onclick="checkmail('pwd')">
                                </div>
                                <div class="form-group">
                                <input type="button" value="I Dont Have Password" class="btn btn-block btn-danger" id="otp" onclick="checkotptype('otp')">
                                </div>
                                  <div class="col-md-3 col-xs-3" id="loader" > </div>
                            </form>
                        </div>
              </div>
               </div>
               </div>
        </div>
    </div>
</div>
</div>
<?php include 'footer.php'; ?>

  <script>
    function checkmail(id)
    {
        var email=$(".loginu").val();
        if(email=="")
        {
            $(".msgsl").fadeIn().html("Please Enter Email ID").addClass("alert alert-danger").delay(5000).fadeOut();
        }
        else
        {

        var logintype=id;
          $.ajax({
        	        url: '<?php echo SITEURL; ?>/contactrequest/checklogintype.php',
        	        type: 'POST',
        	        data: {
        	          email:email,
                      logintype:logintype
        	        },
        	        success: function(response){
        	          if(response){
                       if(response!=0)
                       {
                            $(".dialog-form").replaceWith(response);
                       }
                       else
                       {
                          $(".msgsl").fadeIn().html("Entered E-mail ID is not valid or not found in our system").addClass("alert alert-danger").delay(5000).fadeOut();
                       }
        	          }
        	        }
        	      });
        }
    }

    function checkotptype(id)
    {
        var email=$(".loginu").val();
        if(email=="")
        {
            $(".msgsl").fadeIn().html("Please Enter Email ID").addClass("alert alert-danger").delay(5000).fadeOut();;
        }
        else
        {


            var logintype=id;
              $.ajax({
        	        url: '<?php echo SITEURL; ?>/contactrequest/checkotptype.php',
        	        type: 'POST',
        	        data: {
        	          email:email,
                      logintype:logintype
        	        },
        	        success: function(response){
        	          if(response){
                       if(response!=0)
                       {
                            $(".dialog-form").replaceWith(response);
                       }
                       else
                       {
                          $(".msgsl").fadeIn().html("Entered E-mail ID is not valid or not found in our system").addClass("alert alert-danger").delay(5000).fadeOut();
                       }
        	          }
        	        }
        	      });
        }
    }

    function sendonemailoption(id)
    {
         var email=$(".loginu").val();
            var logintype=id;
              $.ajax({
        	        url: '<?php echo SITEURL; ?>/contactrequest/emailotptype.php',
        	        type: 'POST',
        	        data: {
        	          email:email,
                      logintype:logintype
        	        },
        	        success: function(response){
        	          if(response){
                       if(response!=0)
                       {
                            $(".dialog-form").replaceWith(response);
                       }
                       else
                       {
                          $(".msgsl").fadeIn().html("Entered E-mail ID is not valid or not found in our system").addClass("alert alert-danger").delay(5000).fadeOut();;
                       }
        	          }
        	        }
        	      });
    }

    function contactsysyemoption()
    {
            $.ajax({
    	        url: '<?php echo SITEURL; ?>/contactrequest/contactsystemadmin.php',
    	        type: 'POST',

    	        success: function(response){
    	               $(".otploader").html("");
    	          if(response){
                   if(response!=0)
                   {
                        $(".dialog-form").replaceWith(response);
                   }
                   else
                   {

                   }
    	          }
    	        }
    	      });
    }

    function checklogintype()
    {
         var load= '<?php echo LOADER; ?>';
     var loader=' <img src="'+load+'" alt="" />  ';
        $(".otploader").html(loader);
        var email=$(".loginu").val();
        var logintype=$(".logintype").val();
        var otptype=$(".otptype:checked").val();
          $.ajax({
    	        url: '<?php echo SITEURL; ?>/contactrequest/checklogintype.php',
    	        type: 'POST',
    	        data: {
    	          email:email,
                  logintype:logintype,
                  otptype:otptype
    	        },
    	        success: function(response){
    	               $(".otploader").html("");
    	          if(response){
                   if(response!=0)
                   {
                        $(".dialog-form").replaceWith(response);
                   }
                   else
                   {
                      $(".msgsl").fadeIn().html("Entered E-mail ID is not valid or not found in our system").addClass("alert alert-danger").delay(5000).fadeOut();
                   }
    	          }
    	        }
    	      });
    }
    function cancel()
    {
        location.reload();
    }

    function login()
    {
         var email=$(".loginu").val();
         var logintype=$(".logintype").val();
         var pwd=$(".pwd").val();
         if(pwd=="")
         {
             if(logintype=="otp")
             {
                     $(".msgsl").html("Please enter OTP").addClass("alert alert-danger");
             }
             else
             {
                   $(".msgsl").html("Please enter password").addClass("alert alert-danger");
             }
         }
         else
         {
             var info={email:email,logintype:logintype,pwd:pwd};
             $.ajax({
    	        url: '<?php echo SITEURL; ?>/contactrequest/checklogin.php',
    	        type: 'POST',
    	        data:info ,
    	        success: function(response){
    	          if(response){
                     if(response==1)
                     {
                         var loginurl='<?php echo SITEURL; ?>/contactrequest/home.php';
                           window.location=loginurl;
                     }
                     else if(response==2)
                     {
                         $(".msgsl").fadeIn().html("Invalid OTP").addClass("alert alert-danger").delay(5000).fadeOut();
                     }
                     else if(response==3)
                     {
                         $(".msgsl").fadeIn().html("Entered OTP is expired").addClass("alert alert-danger").delay(5000).fadeOut();
                     }
                     else if(response==4)
                     {
                          $(".msgsl").fadeIn().html("Invalid Credentails").addClass("alert alert-danger").delay(5000).fadeOut();
                     }
                     else if(response==5)
                     {
                           $(".msgsl").fadeIn().html("Invalid User").addClass("alert alert-danger").delay(5000).fadeOut();
                     }
    	          }
    	        }
    	      });
         }
    }

     function resend(no)
    {
         $.ajax({
	        url: '<?php echo SITEURL; ?>/contactrequest/resendotp.php',
	        type: 'POST',
	        data: {
	          no:no,

	        },
	        success: function(response){
	          if(response){

	          }
	        }
	      });
    }
  </script>
  </body>
</html>