<?php include("includes/configuration.php");
$userid = $_REQUEST['userid']; $username = $_REQUEST['username']; $mobile = $_REQUEST['mobile']; $pwd = $_REQUEST['pwd']; $pwd1 = $_REQUEST['pwd1']; ?>
<form class="form-horizontal otpform">
    <div class="card-body">
        <div class="form-group"><b>Verification Code Sent On Your Mobile Number <?php echo "********".substr($mobile,8,2); ?></b></div>
        <div class="msgs"></div>
        <div class="col-sm-8 col-md-8 col-lg-5 col-xl-4 px-0">
            <div class="form-group">
                <input type="text" name="otp" id="otp" class="form-control" placeholder="Verification Code"/>
                <!--<input type="hidden" name="username" id="user" class="form-control" placeholder="Username" value="<?php echo $uname; ?>"/>
                <input type="hidden" name="logkey" id="password" class="form-control" autocomplete="off" placeholder="Password" value="<?php echo $pwd; ?>"/>-->
            </div>
        </div>
        <div>Not Getting? <span class="resendloader"><button class="btn btn-link p-0 ml-2 resendbtn" onclick="resendotp('<?php echo $mobile; ?>')"> Resend Now </button></span></div>
    </div>
    <div class="card-footer py-2 text-right"><input type="button" class="btn btn-primary" name="login" value="Validate And Update" onclick="verifyotp();"/> <input type="button" class="btn btn-secondary" name="back" value="Cancel" onclick="canceledit();"/></div>
</form>

