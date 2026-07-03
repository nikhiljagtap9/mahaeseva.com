<?php include("../includes/configuration.php"); ?>
<!doctype html>  
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | Setting & Logs</title>
    <? include "commoncss.php"; ?>
</head>
<body>
<div class="page-body-wrapper">
    <? include 'header.php'; ?>
    <? include 'cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="row">
                <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                    <div class="card pressetting text-center border-0 shadow-sm"><div class="card-body"><a href="<?php echo ADMINURL; ?>setting/viewsubadminlist.php"><div class="preseticon btn-danger"><i class="fa fa-users" aria-hidden="true"></i></div><b>Manage Subadmins</b></a></div></div>
                </div>
                <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                    <div class="card pressetting text-center border-0 shadow-sm">
                        <div class="card-body"><a href="<?php echo ADMINURL; ?>authenticateuser.php">
                        <div class="preseticon btn-success"><i class="fa fa-user" aria-hidden="true"></i></div>
                        <b>Edit Profile</b></a></div>
                    </div>
                </div>
                <?php if($getusertype=='Admin'){ ?>
                <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                    <div class="card pressetting text-center border-0 shadow-sm">
                        <div class="card-body"><a href="<?php echo ADMINURL; ?>settings.php" >
                        <div class="preseticon btn-warning"><i class="fa fa-check-circle" aria-hidden="true"></i> </div><b>2 Step Authentication</b></a></div>
                    </div>
                </div>
                <? } ?>
                <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                    <div class="card pressetting text-center border-0 shadow-sm">
                        <div class="card-body"><a href="<?php echo ADMINURL; ?>allfailedlogins.php" >
                        <div class="preseticon btn-info"><i class="fa fa-cog"></i></div><b>All Failed Login</b></a></div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                    <div class="card pressetting text-center border-0 shadow-sm">
                        <div class="card-body"><a href="<?php echo ADMINURL; ?>plandetails.php" target="_blank">
                        <div class="preseticon btn-info"><i class="fa fa-bars"></i></div>
                        <b>Plan Details</b></a></div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php');?>
    </div>
</div>
</body>
</html>