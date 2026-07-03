<?php include("includes/configuration.php");
$segment = $path_info['call_parts'][1];
$orderid = base64_decode($segment);
$agrdata = selectQuery(AGR,"biometric_appointement_date","agreement_no='".$orderid."'");
?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITE_TITLE; ?> | Payment Success</title>
    <?php include 'commoncss.php'?>
</head>
<body class="bg-light">
<?php include 'menu.php';
if($_SESSION['reguser']==""){ ?>
<script>var x= '<?php echo SITEURL; ?>'; window.location.assign(x);</script>
<? } ?>
<div class="container content py-4">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 booking_details m-auto">
            <div class="card mx-md-4">
                <div class="card-body text-center p-4">
                    <img src="<?php echo SITEURL; ?>/img/projectimage/pay-success.png" alt="pay-success" class="img-fluid mb-3" width="60">
                    <h4 class="text-center fw-7">THANK YOU</h4>
                    <p class="lead cc-fs-16 mb-2">Your Agreement Is Successfully Submitted To Us </p>
                    <h5>Agreement No. <?php echo $orderid; ?></h5>
                    <p class="lead cc-fs-16">You have set your appointment for Bio-metric Verification on</p>
                    <h5 class="text-danger mb-0 fw-6"><?php echo date("d M Y h:i a",strtotime($agrdata[0]['biometric_appointement_date'])); ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>