<?php include("includes/configuration.php");
$user = $_SESSION['reguser'];
$userdata = selectQuery(WEB_USER,"*","u_id=".$user);
$segment = $path_info['call_parts'][1];
$agree = base64_decode($segment);
if($user==""||$agree==""){?><script>window.location="<?php echo SITEURL; ?>";</script><? }
$agrdata = selectQuery(AGR,"*","agreement_no='".$agree."'");
if($agrdata[0]['isPaid']=="1"){ ?><script>window.location="<?php echo SITEURL; ?>";</script><? }
$MERCHANT_KEY = MARCHANTKEY; $SALT = SALT; $PAYU_BASE_URL = PAYURL; $action = ''; $posted = array();
//Generate random transaction id
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20); ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITENAME; ?> | Payment Confirmation</title>
    <?php include 'commoncss.php' ?>
</head>
<body class="mainbody bg-light">
<?php include 'menu.php'; ?>
<div class="content py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-6 col-xl-5 m-auto paymentComfirm">
                <div class="card card-body">
                    <?php echo "<h5 class='mb-3'>Payment Against ".$agrdata[0]['agreement_no']."</h5>"; ?>
                    <div>
                        <table class="table mb-0">
                            <tr><td class="pl-0 border-top-0">Reg. Fee</td><td class="border-top-0 text-right"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['reg_fee']; ?></td></tr>
                            <tr><td class="pl-0">Stamp Duty</td><td class="text-right"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['stamp_duty']; ?></td></tr>
                            <tr><td class="pl-0">Service Charges</td><td class="text-right"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['service_charges']; ?></td></tr>
                            <tr><td class="pl-0">Visit Charges</td><td class="text-right"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['visit_charge']; ?></td></tr>
                            <tr class="<?=($agreement[0]['is_extra_visit']==0?'hidden':''); ?>"><td class="pl-0">Extra Visit Charges</td><td class="text-right"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['extra_visit_charges']; ?></td></tr>
                            <tr class="<?=($agreement[0]['is_police_initimation']==0?'hidden':''); ?>"><td class="pl-0">Police Intimation Charges</td><td class="text-right"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['police_initimation_charges']; ?></td></tr>
                            <tr><td class="pl-0">DHC</td><td class="text-right"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['dhc_charges']; ?></td></tr>
                            <tr class="h5"><td class="pl-0">Total Payable</td><td class="text-right totalChrg"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['total_charges']; ?></td></tr>
                            <tr>
                                <td colspan="2" class="px-0 pb-0 pt-3 border-top-0">
                                    <form action="<?php echo $action; ?>" method="POST" name="payuForm" id="payuForm" class="mb-0">
                                        <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
                                        <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                                        <input type="hidden" id="txnid" name="txnid" value="<?php echo $txnid ?>" />
                                        <input type="hidden" name="amount" value="<?php echo $agrdata[0]['total_charges']; ?>" />
                                        <input type="hidden" name="firstname" id="firstname" value="<?php echo $userdata[0]['u_fname']." ".$userdata[0]['u_lname']; ?>" />
                                        <input type="hidden" name="email" id="email" value="<?php echo $userdata[0]['u_email']; ?>" />
                                        <input type="hidden" name="phone" value="<?php echo $userdata[0]['u_mobile']; ?>" />
                                        <input type="hidden" name="udf1" id="udf1" value="<?php echo $agrdata[0]['agreement_no']; ?>" />
                                        <input type="hidden" name="productinfo" id="productinfo" value="<?php echo "Agreement"; ?>" />
                                        <input type="hidden" name="surl" value="<?php echo SITEURL; ?>/success" size="64" />
                                        <input type="hidden" name="furl" value="<?php echo SITEURL; ?>/failure" size="64" />
                                        <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                                        <button type="button" class="btn btn-primary pay px-3" onclick="validatepayment()">Pay Now</button> 
                                        <button type="button" class="btn btn-primary cod px-3" onclick="validatecod('<?php echo base64_encode($agrdata[0]['agreement_no']); ?>')">COD</button>
                                        <button type="button" class="btn btn-dark cancel px-3" onclick="cancelpayment()">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script>
function validatepayment(){
    var inv_id = $("#udf1").val(); var txnno = $("#txnid").val(); var payment_mode = "Online";
    var agreeid = "<?php echo base64_encode($agrdata[0]['agreement_no']); ?>";
    var info = { agreement_id:inv_id, txnno:txnno, payment_mode:payment_mode, action:"update_txnid" };
    $.ajax({
        type:"POST",
        url:"<?php echo SITEURL; ?>/ajax.php",
        data:info,
        success:function(response){
            if(response==0){ }
            else{
                $(".pay,.cod,.cancel").attr("disabled",true);
                //$(".pay").append(" "+loadimg);
                location.href="<?=SITEURL; ?>/proceedpayment/"+agreeid+"/"+txnno
                //$("#payuForm").submit();
            }
        }
    });
}
function validatecod(agr){
    $(".pay,.cod,.cancel").attr("disabled",true);
    window.location="<?php echo SITEURL; ?>/cod_success/"+agr;
}
function cancelpayment(){ window.location="<?php echo SITEURL; ?>"; }
</script>
</body>
</html>