<?php include("../../includes/configuration.php"); $store = base64_decode($_REQUEST['tempid']); $tempdate = selectQuery(TEMP_STORE,"*","store_id=".$store); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | Temporary Storage</title>
    <?php include('../commoncss.php');?>
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php') ?>
    <?php include('../cssmenu.php') ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Temporary Storage</h2></div> <div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">First Name</div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php echo $tempdate[0]['fname']; ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Last Name</div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php echo $tempdate[0]['lname']; ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Mobile No</div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php echo $tempdate[0]['mobile']; ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Email</div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php echo $tempdate[0]['email']; ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Govt. Token No </div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7">
                            <?php if($tempdate[0]['tokenno']!=""){ echo $tempdate[0]['tokenno']; }
                            else{ echo "[Not Defined]"; } ?></div>
                        </div>
                    </div>
                    <div class="form-group mb-0 row">
                        <div class="col-12 control-label cc-font-weight-5">Other Info : </div>
                        <div class="col-12">
                        <?php if($tempdate[0]['otherinfo']!=""){ echo $tempdate[0]['otherinfo']; }
                        else{ echo "[Not Defined]"; } ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../footer.php'?>
    </div>
</div>
</body>
</html>