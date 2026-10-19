<!DOCTYPE HTML>
<?php
include("../includes/configuration.php");
$panel="support";
//commented due to domain timeout issue
//include("../callapi.php");

 $getdept=selectQuery(SUPPORTDEPT,"*","isDel='0' and isActive='1'");

 ?>

<html>
<head>
<title><?php echo SITENAME; ?> Support</title>
<meta charset='UTF-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/backlogin.css"><!-- For sellre, admin, support login page -->
<link rel="shortcut icon" href="<?php echo SITEURL; ?>/img/projectimage/favicon1.png">

      <script type = "text/javascript" >
    history.pushState(null, null, 'index.php');
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'index.php');
    });
    </script>
    <script>
  function preventBack(){window.history.forward();}
  setTimeout("preventBack()", 0);
  window.onunload=function(){null};
</script>
<script type="text/javascript">
        function noBack()
         {
             window.history.forward()
         }
        noBack();
        window.onload = noBack;
        window.onpageshow = function(evt) { if (evt.persisted) noBack() }
        window.onunload = function() { void (0) }
    </script>
    <script type="text/javascript">
function back_block() {
window.history.foward(-1)
}
</script>
</head>

<body class="mainbody">
<div class="content">
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
    <div class="header">
         <a href="<?php echo SITEURL; ?>/home" itemscope="" class="logo">
<img width="auto" height="auto" src="<?php echo SITEURL; ?>/img/projectimage/logo.png" alt="logo" title="Image Title" itemprop="logo" class="img-responsive">
<div class="clearfix"></div>
</a>
</div>
        <div class="card">
        <div class="panel-body">
        <div class="msgs"></div>

        <div class="form-group">
           <input type="text"  name="username" class="form-control username" placeholder="Username"/>
          </div>
          <div class="form-group">
             <input type="password"  name="logkey"  class="form-control logkey" autocomplete="off " placeholder="Password"/>
         </div>
             <input type="button"  class="btn btnPrimary btn-block login" onclick="login()" name="login" value="SIGN IN"/>
          <!-- </form>        -->
           </div>
           </div>
         </div>
  </div>
</div>
</div>
<script src="<?php echo SITEURL; ?>/js/jquery-1.12.0.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/bootstrap.min.js"></script>
<script>
 function login()
{
    username=$(".username").val();
    logkey=$(".logkey").val();
    form_data={username:username,logkey:logkey}
        $.ajax({
            type:"POST",
            url:"login_check1.php",
            data:form_data,
                success:function(response){
                    /*alert(response); */
                    $(".login img").remove();
                    $(".login").attr("disabled",false);
                    if(response)
                    {
                        /*alert(response);*/
                        if(response==0)
                        {
                            $(".msgs").fadeIn().html("Invalid Details").addClass("alert-danger").delay(5000).fadeOut();
                        }
                        else if(response==1)
                        {
                            $(".msgs").fadeIn().html("Insert Username And Password").addClass("alert-danger").delay(5000).fadeOut();
                        }
                        else
                        {
                            window.location=response;
                        }
                    }

                }
        });
}
</script>
<?php include 'footer.php';?>

    <script>
        $('input[type="text"],input[type="password"]').val("");


    </script>
</body>
</html>