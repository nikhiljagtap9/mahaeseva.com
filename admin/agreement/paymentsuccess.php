<?php include ("../../includes/configuration.php");
$segment = $_REQUEST['agr']; $orderid = base64_decode($segment);
$agrdata = selectQuery(AGR,"biometric_appointement_date","agreement_no='".$orderid."'"); ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITE_TITLE; ?></title>
    <?php include('../commoncss.php');?>
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php') ?>
    <?php include('../cssmenu.php') ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="row">
                <div class="col-7 m-auto booking_details payment-success text-center">
                    <div class="card p-4 p-md-5">
                        <i class="fa fa-check text-success mb-2" aria-hidden="true"></i>
                        <h3 class="mb-0"><b>THANK YOU</b></h3>
                        <p class="lead mb-3">Your Agreement Is Successfully Submitted To Us</p>
                        <h5>Agreement No - <?php echo $orderid; ?></h5>
                        <p class="lead mb-1">You have set your appointment for Bio-metric Verification on</p>
                        <h4 class="text-primary mb-0"><?php echo date("d M Y h:i a",strtotime($agrdata[0]['biometric_appointement_date'])); ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../footer.php'?>
    </div>
</div>
</body>
</html>