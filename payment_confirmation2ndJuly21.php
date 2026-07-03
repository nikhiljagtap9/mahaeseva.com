<?php include("includes/configuration.php");
    $user = $_SESSION['reguser'];
    $userdata = selectQuery(WEB_USER,"*","u_id=".$user);
    $segment = $path_info['call_parts'][1];
    $agree = base64_decode($segment);
    if($user==""||$agree==""){?><script>window.location="<?php echo SITEURL; ?>";</script><? }
    $agrdata = selectQuery(AGR,"*","agreement_no='".$agree."'");
    if($agrdata[0]['isPaid']=="1"){ ?><script>window.location="<?php echo SITEURL; ?>";</script><? }
    $action = $PAYU_BASE_URL . '/_payment';
    $MERCHANT_KEY = MARCHANTKEY; $SALT = SALT; $PAYU_BASE_URL = PAYURL; $action = ''; $posted = array();
    if(!empty($_POST)){ foreach($_POST as $key => $value){$posted[$key] = $value;}  }
    $formError = 0;
    if(empty($posted['txnid'])){
        //Generate random transaction id
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    } else { $txnid = $posted['txnid'];}
    $hash = '';
    //Hash Sequence
    $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
    if(empty($posted['hash']) && sizeof($posted) > 0){
    if(empty($posted['key'])|| empty($posted['txnid'])|| empty($posted['amount'])|| empty($posted['firstname'])|| empty($posted['email'])|| empty($posted['phone'])|| empty($posted['productinfo'])|| empty($posted['surl'])|| empty($posted['furl'])|| empty($posted['service_provider'])){
    $formError = 1;
    } else{
        //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';
        foreach($hashVarsSeq as $hash_var){
            $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
            $hash_string .= '|';
        }
        $hash_string .= $SALT;
        $hash = strtolower(hash('sha512', $hash_string));
        $action = $PAYU_BASE_URL . '/_payment';
    }
} elseif(!empty($posted['hash'])){
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
} ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITENAME; ?> | Payment</title>
    <?php include 'commoncss.php' ?>
</head>
    <body class="mainbody bg-light" onLoad="submitPayuForm()">
     <?php include 'menu.php'; ?>
        <div class="content py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 m-auto paymentComfirm">
                        <div class="card card-body">
                            <?php echo "<h5 class='mb-3 fw-8'>Payment Against ".$agrdata[0]['agreement_no']."</h5>"; ?>
                            <div>
                            <table class="table mb-0">
                              <tr>
                               <td class="pl-0 border-top-0">Reg. Fee</td>
                               <td class="border-top-0 text-right"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['reg_fee']; ?></td>
                              </tr>
                              <tr>
                               <td class="pl-0">Stamp Duty</td>
                               <td class="text-right"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['stamp_duty']; ?></td>
                              </tr>
                              <tr>
                               <td class="pl-0">Service Charges</td>
                               <td class="text-right"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['service_charges']; ?></td>
                              </tr>
                               <tr>
                               <td class="pl-0">Visit Charges</td>
                               <td class="text-right"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['visit_charge']; ?></td>
                              </tr>
                               <tr class="<?=($agreement[0]['is_extra_visit']==0?'hidden':''); ?>">
                               <td class="pl-0">Extra Visit Charges</td>
                               <td class="text-right"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['extra_visit_charges']; ?></td>
                              </tr>
                               <tr class="<?=($agreement[0]['is_police_initimation']==0?'hidden':''); ?>">
                               <td class="pl-0">Police Intimation Charges</td>
                               <td class="text-right"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['police_initimation_charges']; ?></td>
                              </tr>
                              <tr class="h5">
                               <td class="pl-0"><b>Total Payable</b></td>
                               <td class="text-right totalChrg"><i class="fa fa-inr"></i> <?php echo $agrdata[0]['total_charges']; ?></td>
                              </tr>
                              <tr>
                               <td colspan="2" class="px-0 pb-0 pt-3 border-top-0">
                                  <form action="<?php echo $action; ?>" method="POST" name="payuForm" id="payuForm" class="mb-0">
                                     <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
                                      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                                      <input type="hidden" id="txnid" name="txnid" value="<?php echo $txnid ?>" />
                                      <input type="hidden" name="amount" value="<?php echo $agrdata[0]['total_charges']; ?>" />
                                      <input  type="hidden" name="firstname" id="firstname" value="<?php echo $userdata[0]['u_fname']." ".$userdata[0]['u_lname']; ?>" />
                                      <input  type="hidden" name="email" id="email" value="<?php echo $userdata[0]['u_email']; ?>" />
                                      <input  type="hidden" name="phone" value="<?php echo $userdata[0]['u_mobile']; ?>" />
                                       <input  type="hidden" name="udf1" id="udf1" value="<?php echo $agrdata[0]['agreement_no']; ?>" />
                                        <input  type="hidden" name="productinfo" id="productinfo" value="<?php echo "Agreement"; ?>" />
                                      <input  type="hidden" name="surl" value="<?php echo SITEURL; ?>/success" size="64" />
                                      <input  type="hidden" name="furl" value="<?php echo SITEURL; ?>/failure" size="64" />
                                      <input  type="hidden" name="service_provider" value="payu_paisa" size="64" />
                                 <!-- <?php
                                       if(!$hash)
                                       { ?>-->
                                             <button type="button" class="btn btn-primary pay px-3" onclick="validatepayment()">Pay Now</button> <!--  <input type="button" onclick="validandsubmit()" value="PAY NOW" class="btn btn-primary btnred"  />         -->
                                      <!-- <?php
                                       }
                                    ?>-->
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
            var inv_id=$("#udf1").val();
             var txnno=$("#txnid").val();
             var payment_mode="Online";
            var info={agreement_id:inv_id,txnno:txnno,payment_mode:payment_mode,action:"update_txnid"};
              $.ajax({
              type:"POST",
              url:"<?php echo SITEURL; ?>/ajax.php",
              data:info,
              success:function(response){
                  if(response==0){}
                  else{
                      $(".pay,.cod,.cancel").attr("disabled",true);
                      $(".pay").append(" "+loadimg);

                       $("#payuForm").submit();
                  }

              }
              });
       }

    function validatecod(agr){
    $(".pay,.cod,.cancel").attr("disabled",true);
    $(".cod").append(" "+loadimg);
    window.location="<?php echo SITEURL; ?>/cod_success/"+agr;
    }

    function cancelpayment(){window.location="<?php echo SITEURL; ?>";}

    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
    if(hash == ''){return;}
    var payuForm = document.forms.payuForm;
    payuForm.submit();
    }
</script>
</body>
</html>