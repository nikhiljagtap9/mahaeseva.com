<?php include("includes/configuration.php");
$_SESSION['a']=""; $_SESSION['b']=""; $_SESSION['c']=""; $_SESSION['d']="";    
$status = "failed"; $segment = $path_info['call_parts'][1]; $txnid = $path_info['call_parts'][2]; $agree = base64_decode($segment);
$data = array('isPaid'=>'0','last_payment_status'=>ucfirst($status),'last_payment_date'=>date("Y-m-d H:i:s"));
updateQuery(AGR,$data,"agreement_no='".$agree."'");
$paydata = array('transaction_status'=>ucfirst($status),'transaction_payment_gateway_status'=>ucfirst($status),'transaction_date'=>date("Y-m-d H:i:s"));
updateQuery(PAYMENT,$paydata,"transaction_id='".$txnid."'"); ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITE_TITLE; ?> | Payment Failure</title>
    <?php include 'commoncss.php'?>
</head>
<body class="bg-light">
    <?php include 'menu.php'?>
    <div class="container content py-4">
        <div class='row'>
            <div class="col-sm-9 col-md-7 col-lg-5 m-auto titlemsg ">
                <div class="card mx-md-4">
                    <div class="card-body text-center p-4">
                        <div class="headmsg text-danger"><img src="<?php echo SITEURL; ?>/img/projectimage/pay-fail.png" alt="pay-fail" class="img-fluid mb-3" width="60"></div>
                        <?php echo "<h4 class='text-center fw-7 text-uppercase'>Transaction ". $status ."</h4>";
                        echo "<p class='lead cc-fs-16 mb-2'>Your transaction id for this transaction is</p><h5 class='fw-7'>".$txnid.".</h5><p class='lead cc-fs-16 mb-0'>You may try again.</p>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>