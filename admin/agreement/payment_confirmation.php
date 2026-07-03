<?php include ("../../includes/configuration.php"); $segment = $_REQUEST['agr']; $agree = base64_decode($segment);
if($agree==""){ ?>
<script>window.location="<?php echo ADMINURL; ?>home.php";</script>
<? }
$agrdata = selectQuery(AGR,"*","agreement_no='".$agree."'");
if($agrdata[0]['isPaid']=="1"){ ?>
<script>window.location="<?php echo SITEURL; ?>";</script>
<? } ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITENAME; ?> | Payment Confirmation</title>
    <?php include('../commoncss.php');?>
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php') ?>
    <?php include('../cssmenu.php') ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card paymentComfirm mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><?php echo "<h2 class='card-head-title'>Payment Against ".$agrdata[0]['agreement_no']."</h2>"; ?></div></div>
                <div class="card-body pb-2">
                    <div class="form-group row">
                        <div class="col-6 col-sm-4 col-md-5 col-lg-3">Reg. Fee</div>
                        <div class="col-6 col-sm-8 col-md-7 col-lg-9"><i class="fa fa-inr"></i><?php echo $agrdata[0]['reg_fee']; ?></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6 col-sm-4 col-md-5 col-lg-3">Stamp Duty</div>
                        <div class="col-6 col-sm-8 col-md-7 col-lg-9"><i class="fa fa-inr"></i><?php echo $agrdata[0]['stamp_duty']; ?></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6 col-sm-4 col-md-5 col-lg-3">Service Charges</div>
                        <div class="col-6 col-sm-8 col-md-7 col-lg-9"><i class="fa fa-inr"></i><?php echo $agrdata[0]['service_charges']; ?></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6 col-sm-4 col-md-5 col-lg-3">Visit Charges</div>
                        <div class="col-6 col-sm-8 col-md-7 col-lg-9"><i class="fa fa-inr"></i><?php echo $agrdata[0]['visit_charge']; ?></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6 col-sm-4 col-md-5 col-lg-3">DHC </div>
                        <div class="col-6 col-sm-8 col-md-7 col-lg-9"><i class="fa fa-inr"></i><?php echo $agrdata[0]['dhc_charges']; ?></div>
                    </div>
                    <div class="form-group row <?=($agreement[0]['is_extra_visit']==0?'hidden':''); ?>">
                        <div class="col-6 col-sm-4 col-md-5 col-lg-3">Extra Visit Charges</div>
                        <div class="col-6 col-sm-8 col-md-7 col-lg-9"><i class="fa fa-inr"></i><?php echo $agrdata[0]['extra_visit_charges']; ?></div>
                    </div>
                    <div class="form-group row <?=($agreement[0]['is_police_initimation']==0?'hidden':''); ?>">
                        <div class="col-6 col-sm-4 col-md-5 col-lg-3">Police Intimation Charges</div>
                        <div class="col-6 col-sm-8 col-md-7 col-lg-9"><i class="fa fa-inr"></i><?php echo $agrdata[0]['police_initimation_charges']; ?></div>
                    </div>
                    <div class="form-group row <?=($agreement[0]['is_police_initimation']==0?'hidden':''); ?>">
                        <div class="col-6 col-sm-4 col-md-5 col-lg-3">Total Payable</div>
                        <div class="col-6 col-sm-8 col-md-7 col-lg-9"><i class="fa fa-inr"></i><?php echo $agrdata[0]['total_charges']; ?></div>
                    </div>
                    <div class="form-group row <?=($agreement[0]['is_police_initimation']==0?'hidden':''); ?>">
                        <div class="col-6 col-4 col-sm-4 col-md-5 col-lg-3">Payment Status</div>
                        <div class="col-6 col-sm-8 col-md-7 col-lg-9">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="radio" name="paystatus" class="paystatus custom-control-input" id="paystatusrec" value="Received" checked="checked"/>
                                <label class="custom-control-label" for="paystatusrec">Received</label>
                            </div>
                             <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="radio" name="paystatus" class="paystatus custom-control-input" id="paystatuspend" value="Pending"/>
                                <label class="custom-control-label" for="paystatuspend">Pending</label>
                            </div>    
                        </div>
                    </div>
                    <div class="row border-top">
                        <div class="col-md-12 text-right pt-2">
                            <!--<form action="<?php echo $action; ?>" method="POST" name="payuForm" id="payuForm">     -->
                            <!--<input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
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
                            <input type="hidden" name="service_provider" value="payu_paisa" size="64" />-->
                            <!-- <?php
                            if(!$hash){ ?>-->
                            <!--<button type="button" class="btn btn-success pay" onclick="validatepayment()">Pay Now</button>--><!--<input type="button" onclick="validandsubmit()" value="PAY NOW" class="btn btn-primary btnred" /> -->
                            <!-- <?php } ?>-->
                            <button type="button" class="btn btn-primary cod" onclick="validatecod('<?php echo base64_encode($agrdata[0]['agreement_no']); ?>')">Proceed</button>
                            <button type="button" class="btn btn-dark cancel" onclick="cancelpayment()">Cancel</button>
                            <!-- </form>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../footer.php'?>
    </div>
</div>
<script>
function validatecod(agr){
    paystat = $(".paystatus:checked").val();
    window.location = "<?php echo ADMINURL; ?>agreement/cod_success.php?agr="+agr+"&stat="+paystat;
}
function cancelpayment(){ window.location="<?php echo SITEURL; ?>"; }
var hash = '<?php echo $hash ?>';
function submitPayuForm(){
    if(hash == ''){ return; } var payuForm = document.forms.payuForm; payuForm.submit();
}
</script>
</body>
</html>