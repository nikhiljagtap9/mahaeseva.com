<?php include("../includes/configuration.php"); ?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | Authentication</title>
    <?php include 'commoncss.php';?>
</head>
<body>
<div class="page-body-wrapper">
    <?php include('header.php'); ?>
    <?php include('cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Authentication</h2></div><div class="btn-actions-pane-right"><a href="<?php echo ADMINURL;?>presetting.php" class="btn btn-secondary btn-sm">Back</a></div></div>
                <div class="card-body">
                    <div class="info">
                        <h6 class="mb-3">Please Re-authenticate Yourself</h6>
                        <div class="msgs"></div>
                        <form>
                            <div class="row">
                                <div class="col-lg-7 col-xl-6">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-form-label">Password</div>
                                        <div class="col-sm-8 col-md-7 col-lg-8"><input type="hidden" name="userid" id="userid" value="<?php echo base64_encode($result[0]['u_id']); ?>"/>
                                        <input type="password" name="pwd" id="pwd" class="form-control" maxlength="20" placeholder="Enter Current Password" /></div>
                                        <div class="unameErr"></div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="button" onclick="authenticateuser()">Next</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php');?> 
    </div>
</div>
<script>
$("#pwd").val("");
function authenticateuser(){
    var userid = $("#userid").val(); var pwd = $("#pwd").val();
    if(pwd!=""){
        var info = { userid1:userid, pwduser:pwd, action:"authenticateuser" };
        $.ajax({ type:"POST", url:"authenticationOn.php", data:info,
            success:function(response){
                if(response==1){ location.href="editprofile.php"; }
                else{ $('.msgs').fadeIn();$('.msgs').addClass("alert alert-danger");$('.msgs').html('Invalid Password');$('.msgs').delay(5000).fadeOut(); }
            }
        });
    } else{
        $('.msgs').fadeIn();$('.msgs').addClass("alert alert-danger");$('.msgs').html('Please Enter Password');$('.msgs').delay(5000).fadeOut();
    }
}
</script>
</body>
</html>