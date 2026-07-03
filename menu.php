<?php $panel="website"; include("callapi.php");
$loginuserid = $_SESSION['reguser'];
if($loginuserid!=""){
$loginuserdetails = selectQuery(WEB_USER,"*","u_id=".$loginuserid." and isActive='1' ");
if(count($loginuserdetails)){
    $ufname = $loginuserdetails[0]['u_fname']; $ulname = $loginuserdetails[0]['u_lname']; $uemail = $loginuserdetails[0]['u_email'];
} else{
    if($loginuserid!="" && count($loginuserdetails)==0) ?>
    <script>window.location="logout.php";</script>
<? } } ?>
<header class="header header-top bg-dark">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-9 d-none d-md-block"><ul class="header-info list-inline text-white mb-md-0"><li><span class="fw-6">Contact</span> : <?php echo CONTACTNO; ?></li></ul></div>
            <div class="col-md-6 col-lg-3">
                <ul class="social-icons text-right list-inline m-0">
                    <li><a href="<?=FBLINK; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><li><a href="<?=TWITTERLINK;?>" target="_blank"><i class="fa fa-twitter"></i></a></li><li><a href="<?=INSTAGRAMLINK; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    <?php if($loginuserid==""){ ?>
                    <li><a href="#" class="logbtn" data-toggle="modal" data-target="#loginmod">Login</a></li>
                    <? } else{ ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $ufname; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo SITEURL; ?>/account"><i class="fa fa-caret-right"></i> My Account</a></li>
                            <li><a href="<?php echo SITEURL; ?>/account"><i class="fa fa-caret-right"></i> My Profile</a></li>
                            <li><a href="<?php echo SITEURL;?>/account/myagreements"><i class="fa fa-caret-right"></i> My Agreements</a></li>
                            <li><a href="<?php echo SITEURL; ?>/logout.php"><i class="fa fa-caret-right"></i> Logout</a></li>
                        </ul>
                    </li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>
</header> 
<nav class="navbar navbar-expand-md navigation py-3 bg-white">
    <div class="container navicontainer">
        <a class="navbar-brand" href="<?php echo SITEURL; ?>"><img src="<?php echo SITEURL; ?>/img/projectimage/logo.png" alt="logo" title="Maha-E-Seva"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <svg version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 384.97 384.97" xml:space="preserve" width="20" height="20"><g><g id="Menu"><path d="M12.03,84.212h360.909c6.641,0,12.03-5.39,12.03-12.03c0-6.641-5.39-12.03-12.03-12.03H12.03C5.39,60.152,0,65.541,0,72.182C0,78.823,5.39,84.212,12.03,84.212z"></path><path d="M372.939,180.455H12.03c-6.641,0-12.03,5.39-12.03,12.03s5.39,12.03,12.03,12.03h360.909c6.641,0,12.03-5.39,12.03-12.03S379.58,180.455,372.939,180.455z"></path><path d="M372.939,300.758H12.03c-6.641,0-12.03,5.39-12.03,12.03c0,6.641,5.39,12.03,12.03,12.03h360.909c6.641,0,12.03-5.39,12.03-12.03C384.97,306.147,379.58,300.758,372.939,300.758z"></path></g><g></g><g></g><g></g><g></g><g></g><g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
        </button>
        <div class="collapse navbar-collapse mt-md-3 mt-lg-0 pt-2 pt-lg-0" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="<?php echo SITEURL; ?>">Home</a></li>
                <?php if($loginuserid==""){ ?>
                <li class="nav-item"><a href="#" class="logbtn nav-link" data-toggle="modal" data-target="#loginmod">Create Rent Agreement</a></li>
                <? } else{ ?>
                <li class="nav-item"><a href="<?php echo SITEURL; ?>/agreement" class="nav-link">Create Rent Agreement</a></li>
                <? } ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo SITEURL; ?>#rentagrementcal">Rent Agreement Charges</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo SITEURL; ?>/bloglist">Blog</a></li>
                <li class="nav-item"><a class="nav-link pr-0" href="<?php echo SITEURL; ?>/contact.php">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav> 
<div class="modal userloginmodal" id="loginmod">
    <div class="modal-dialog mt-5">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-12 col-lg-6 bg-primary rounded-left py-5 text-white d-none d-lg-block">
                    <div class="media mb-4 mt-0 ml-2 align-middle">
                        <img src="<?php echo SITEURL; ?>/img/projectimage/reg-step-1.png" alt="reg-step-1" class="mr-3" width="70">
                        <div class="media-body align-self-center"><p class="mb-0">Fill An Online Form</p></div>
                    </div>
                    <div class="media mb-4 mt-0 ml-2 align-middle">
                        <img src="<?php echo SITEURL; ?>/img/projectimage/reg-step-2.png" alt="reg-step-2" class="mr-3" width="70">
                        <div class="media-body align-self-center"><p class="mb-0">Make an appointment for Biometric Verification</p></div>
                    </div>
                    <div class="media mt-0 ml-2 align-middle">
                        <img src="<?php echo SITEURL; ?>/img/projectimage/reg-step-3.png" alt="reg-step-3" class="mr-3" width="70">
                        <div class="media-body align-self-center"><p class="mb-0">Get your Registered Rent Agreement</p></div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="logIn py-5 pr-4 pl-3">
                        <h3 class="mb-0">Log In</h3>
                        <p>Your contact number is necessary for us to verify your identity</p>
                        <div class="loginmsgs"></div>
                        <form class="inputBorder log1">
                            <div class="form-group">
                                <!--<div class="input-group">
                                    <div class="input-group-addon">+91</div>
                                    <input type="text" id="loginmob" class="form-control" placeholder="Mobile Number" onkeyup="mobnumbercheck('loginmob')" maxlength="10">
                                </div>-->
                                <div class="input-group"><div class="input-group-prepend"><span class="input-group-text bg-white">+91</span></div><input type="number" id="loginmob" class="form-control border-left-0" placeholder="Mobile Number" onkeydown="limit(this);" onkeyup="mobnumbercheck('loginmob');limit(this);" max="10"></div>
                            </div>
                            <div class="mt-4"><button type="button" class="btn btn-primary getotpbnt" onclick="getotp('loginmob')">GET OTP</button>
                            <button type="button" class="btn btn-dark cancelloging0" onclick="closelogin()">Cancel</button></div>
                            <div class="otp display-none">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span></div>
                                        <input type="number" class="form-control" id="loginotp" placeholder="Enter OTP" max="6" onkeydown="otplimit(this);" onkeyup="otplimit(this);">
                                    </div>
                                    <!--<div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-eye" aria-hidden="true"></i></div>
                                        <input type="text" class="form-control" id="loginotp" placeholder="Enter OTP"  maxlength="6">
                                    </div>-->
                                </div>  
                                <div class="text-left small form-group"><p>Did Not Received OTP? Click to <a class="resendotp" onclick="resendotp('loginmob')">Resend OTP</a></p></div>
                                <div class="mt-3"><button type="button" class="btn btn-primary submit1" onclick="verifyotp('loginmob','loginotp')">Verify And Login</button> <button type="button" class="btn btn-secondary cancelloging" onclick="closelogin()">Cancel</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="loginmod1" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card logIn text-center">
                <div class="panel-heading"><h3><i class="fa fa-user"></i>Fill Details</h3></div>
                <div class="panel-body">
                    <div class="usermsgs"></div>
                    <?php if(count($loginuserdetails)&&($ufname==""||$uemail=="")){ ?>
                    <form class="inputBorder">
                        <div class="row">
                            <div class="col-md-6">
                                <input class="userid" type="hidden" value="<?php echo $loginuserid; ?>" >
                                <div class="form-group"><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div><input type="text" class="form-control userfname" id="userfname" placeholder="First Name" value="<?php echo $ufname; ?>" maxlength="20" onkeyup="namechk('userfname')"></div></div>
                            </div>
                            <div class="col-md-6"><div class="form-group"><input type="text" class="form-control userlname" id="userlname" placeholder="Last Name" value="<?php echo $ulname; ?>" maxlength="20" onkeyup="namechk('userlname')"></div></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group"><div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div><input type="text" class="form-control useremailid" id="useremailid" placeholder="Email Id" value="<?php echo $uemail; ?>" maxlength="80" onblur="mailchk('useremailid')"></div>
                        </div>
                        <button type="button" class="btn btn-success updatedata" onclick="filluserdetails('userid','userfname','userlname','useremailid')">Submit</button>
                        <a href="logout.php" class="btn btn-danger logout2">Logout</a>
                    </form>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>