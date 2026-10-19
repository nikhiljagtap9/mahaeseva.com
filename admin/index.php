<?php include("../includes/configuration.php"); $panel="admin"; 
//commented due to domain timeout issue 
//include("../callapi.php");
$getsetting = selectQuery(LOGINSETTING,"*"); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo SITENAME; ?> Admin</title>
<meta charset='UTF-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/backend/loginpage.css">
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo SITEURL; ?>/img/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo SITEURL; ?>/img/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo SITEURL; ?>/img/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo SITEURL; ?>/img/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo SITEURL; ?>/img/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo SITEURL; ?>/img/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo SITEURL; ?>/img/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo SITEURL; ?>/img/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo SITEURL; ?>/img/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192" href="<?php echo SITEURL; ?>/img/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo SITEURL; ?>/img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo SITEURL; ?>/img/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo SITEURL; ?>/img/favicon/favicon-16x16.png">
<link rel="manifest" href="<?php echo SITEURL; ?>/img/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo SITEURL; ?>/img/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<script>
    history.pushState(null, null, '<?php echo ADMINURL; ?>');
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, '<?php echo ADMINURL; ?>');
    });
</script>
<script>
    function preventBack(){ window.history.forward(); }
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
</script>
<script>
    function noBack(){ window.history.forward()}
    noBack();
    window.onload = noBack;
    window.onpageshow = function(evt){ if (evt.persisted) noBack() }
    window.onunload = function(){ void (0) }
</script>
<script>function back_block(){ window.history.foward(-1) }</script>
</head>
<body class="bg-light">
<div class="container">
    <div class="row">
        <div class="col-md-12 min-vh-100 d-flex flex-column justify-content-center">
            <div class="row">
                <div class="col-lg-4 col-md-8 mx-auto panel-login-form px-0">
                    <header class="text-center mb-4"><a href="<?php echo SITEURL ?>" target="_blank"><img src="<?php echo SITEURL; ?>/img/projectimage/logo.png" alt="Logo" class="img-fluid logo"/></a></header>
                    <div class="card rounded shadow shadow-sm shadow-lg mb-3 border-0 logform-body">
                        <h2 class="mb-4 text-center">Login To Admin Panel</h2>
                        <div class="msgs"></div>
                        <?php if($getsetting[0]['admin_authentication']==0){ $action = "adminlogin.php"; }
                        else{ $action="authentication.php"; } ?>
                        <form class="loginform" action="<?php echo $action; ?>" name="loginform" method="POST">
                            <div class="form-group position-relative">
                                <label>Username</label>
                                <span class="cust-input-group"><img src="<?php echo SITEURL; ?>/img/projectimage/icon-username.png" alt="icon-username"/></span>
                                <input type="text" name="username" id="user" class="form-control cust-group-padd" placeholder="Username"/>
                            </div>
                            <div class="form-group position-relative">
                                <label>Password</label>
                                <span class="cust-input-group"><img src="<?php echo SITEURL; ?>/img/projectimage/icon-password.png" alt="icon-password"/></span>
                                <input type="password" name="logkey" id="password" class="form-control cust-group-padd" placeholder="Password" autocomplete="off" />
                            </div>
                            <div class="form-group custom-control custom-checkbox mb-4 cc-fs-13">
                                <input type="checkbox" class="custom-control-input" id="admshowpass" name="example1">
                                <label class="custom-control-label" for="admshowpass">Show Password</label>
                            </div>
                            <?php if($getsetting[0]['admin_authentication']==0){ ?>
                            <input type="button" class="btn btn-primary btnPrimary btn-block" onclick='validate1();' name="login" value="SIGN IN"/>
                            <? } else{ ?>
                            <input type="button" class="btn btn-primary greenBtn btn-block" name="login" onclick='validate();' value="SIGN IN"/>
                            <? } ?>
                        </form>
                    </div>
                    <footer class="text-center cc-fs-13">
                        <div class="mb-1">Copyright &copy; <?php echo date("Y"); ?> <?php echo SITENAME; ?></div>
                        <div>Website Intelligence By - <a href="https://www.surun.in/" target="_blank">Surun Infocore System</a></div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo SITEURL; ?>/js/jquery.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/popper.min.js"></script>
<script  src="<?php echo SITEURL; ?>/js/bootstrap.min.js"></script>
<script>
$("#password").on('keyup', function(event) {
    if (event.keyCode == 13){
        chk="<?php echo $getsetting[0]['admin_authentication']; ?>";
        if(chk=="0"){ validate1(); } else if(chk=="1"){ validate(); }
    }
});
function validate(){
    var user = $("#user").val(); var pwd = $("#password").val();
    if(user!=""&&pwd!=""){
        var info = {user:user,pwd:pwd,action:"uservalidate"};
        $.ajax({
            type:"POST",
            url:"authenticationOn.php",
            data:info,
            success:function(response){
                if(response==1){ $(".loginform").submit(); } else{ $(".msgs").fadeIn().html("Invalid User Details").addClass('alert alert-danger').delay(2000).fadeOut(); }
            }
        });
    }
}
function validate1(){
    var user = $("#user").val(); var pwd = $("#password").val();
    if(user!=""&&pwd!=""){
        var info={user:user,pwd:pwd,action:"uservalidatewithoutotp"};
        $.ajax({
            type:"POST",
            url:"authenticationOn.php",
            data:info,
            success:function(response){
                if(response==1){ $(".loginform").submit(); }
                else{ $(".msgs").fadeIn().html("Invalid User Details").addClass('alert alert-danger').delay(2000).fadeOut(); }
            }
        });
    }
}
$('input[type="text"],input[type="password"]').val("");
$(document).ready(function(){
    $('#admshowpass').on('change',function(){
        var isChecked = $(this).prop('checked');
        if (isChecked){ $('#password').attr('type','text');}
        else { $('#password').attr('type','Password'); }
    });
});
</script>
</body>
</html>