<!DOCTYPE HTML>
<?php
include("../includes/configuration.php");
      $uname=$_REQUEST['username'];
  $pwd=md5($_REQUEST['logkey']);
  $getuser=selectQuery(USER,"*","username='".$uname."' and password='".$pwd."' and isActive='1'");
  if(count($getuser)==1)
        {
            $mobile=$getuser[0]['u_mob'];
        }
 ?>

<html>
<head>
  <title><?php echo SITENAME; ?> Admin</title>

<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/backlogin.css"/>
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/bootstrap.min.css">
</head>

<body class="mainbody">
<div class="content">
<div class="container loginForm">
<div class="row">
    <div class="col-md-4 col-md-offset-4 text-center header">
        <a href="<?php echo SITEURL; ?>/home" itemscope="" class="logo">
            <img width="auto" height="auto" src="<?php echo SITEURL; ?>/img/projectimage/logo.png" alt="logo" title="Image Title" itemprop="logo" class="img-responsive">
        </a>
    </div>
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center sellerlogin">
    <div class="card">
    <div class="panel-body">
    <h3 class="marginbot25 margintop0">Login To Admin Panel</h3>
    <br>
    <div class="msgs"></div>
           <div>
               <b> Verification Code Sent On Your Mobile Number <br>
                <?php echo "********".substr($mobile,8,2); ?></b> <br>
               Not Getting? <span class="resendloader"><button class="btn btn-link resendbtn" onclick="resendotp('<?php echo $mobile; ?>')"> Resend Now </button></span>
            </div>
            <div class="form-group">
           <input type="text"  name="otp" id="otp" class="form-control mbottom15" placeholder="Verification Code"/>
           </div>
              <input type="hidden"  name="username" id="user" class="form-control mbottom15" placeholder="Username" value="<?php echo $uname; ?>"/>
             <input type="hidden"  name="logkey" id="password" class="form-control mbottom15" autocomplete="off " placeholder="Password" value="<?php echo $pwd; ?>"/>
             <input type="submit"  class="btn btn-success btn-block" name="login" value="Validate And Login" onclick="verifyotp();"/>
             <input type="button" class="btn btn-danger btn-block" name="back" value="Cancel" onclick="logincancel();"/>
    </div></div> </div>
  </div>
</div>
</div>

<?php include 'footer.php';?>

    <script src="../js/jquery-1.12.0.min.js"></script>
    <script>
    function resendotp(val1)
    {
          var info={mob:val1,action:"resendotp"};
                $(".resendloader").html("Please Wait.. Resending..");
                $.ajax({
                        type:"POST",
                        url:"authenticationOn.php",
                        data:info,
                        success:function(response){
                            $(".resendloader").html('<button class="btn btn-link resendbtn" onclick="resendotp('+val1+')"> Resend Now </button>');
                          if(response==1)
                          {

                          }
                          else
                          {

                          }
                       }
                  });
    }
    function logincancel()
    {
          var info={action:"logincancel"};
                $.ajax({
                        type:"POST",
                        url:"authenticationOn.php",
                        data:info,
                        success:function(response){
                          if(response==1)
                          {
                              location.href="index.php";
                          }
                          else
                          {

                          }
                       }
                  });
    }
    function verifyotp()
    {
         var user=$("#user").val();
         var pwd=$("#password").val();
          var otp=$("#otp").val();
          var info={user:user,pwd1:pwd,otp:otp,action:"verifyotp"};
           $.ajax({
                type:"POST",
                url:"authenticationOn.php",
                data:info,
                success:function(response){
                  if(response==1)
                  {
                      $(".msgs").html("OTP Expired");
                  }
                  else if(response==0)
                  {
                      $(".msgs").html("Invalid OTP");
                  }
                  else
                  {
                       location.href=response;
                  }
               }
          });

    }
        $('input[type="text"],input[type="password"]').val("");
    </script>
</body>
</html>
