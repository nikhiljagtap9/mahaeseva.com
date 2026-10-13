<!doctype html>
<?php include("../../includes/configuration.php"); $agr = base64_decode($_REQUEST['agr']); $agreement = selectQuery(AGR,"*","agreement_no='".$agr."'"); $userdata = selectQuery(WEB_USER,"*","u_id=".$agreement[0]['agree_by']); $landlord = selectQuery(AGR_LANDLORD,"*","agreement_no='".$agr."'"); $tenents = selectQuery(AGR_TENENT,"*","agreement_no='".$agr."'"); $vitness = selectQuery(AGR_VITNESS,"*","agreement_no='".$agr."'"); $rent = selectQuery(AGR_RENT,"*","agreement_no='".$agr."' order by `rent`"); $fitments = selectQuery(AGR_FITMENT,"*","agreement_no='".$agr."'"); ?>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> Admin</title>
    <? include "../commoncss.php"; ?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css"/>
</head>
<body>
<div class="page-body-wrapper">
    <? include '../header.php'; ?>
    <? include '../cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card" id="mainstatus">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Agreement - <?php echo $agr; ?> <small>( Status - <?php echo $agreement[0]['agreement_status']; ?> )</small></h2></div><div class="btn-actions-pane-right"><button type="button" class="btn btn-primary btn-sm" onclick="chngstatus('<?php echo $agreement[0]['agreement_no']; ?>')">Change Status</button></div></div>
                <div class="card-body mainstatus1" id="mainstatus1">
                    <div class="row">
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Posted By</b></div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php echo $userdata[0]['u_fname']." ".$userdata[0]['u_lname']; ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Entry Date</b></div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php echo date("d M Y h:i a",strtotime($agreement[0]['entry_on'])); ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Mobile Number</b></div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php echo $userdata[0]['u_mobile']; ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Payment Staus</b></div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7">
                                <?php if($agreement[0]['payment_mode']==""||($agreement[0]['payment_mode']=="Online"&&$agreement[0]['isPaid']=="0")){ ?>
                                <span>Pending</span>
                                <? } else if($agreement[0]['payment_mode']=="COD"){
                                    echo "COD";
                                    if($agreement[0]['isPaid']=="0"){ echo " (Pending)"; } else{ echo " (Received)"; }
                                } else if($agreement[0]['payment_mode']=="Online"&&$agreement[0]['isPaid']=="1"){ echo "Online";echo " (Received)"; } ?>
                            </div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Govt. Token No</b></div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['govt_token_no']!=""){ echo $agreement[0]['govt_token_no']; } else{ echo "-"; } ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Govt. Reg. No</b></div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['govt_reg_no']!=""){ echo $agreement[0]['govt_reg_no'];} else{ echo "-"; } ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>GRN for Stamp Duty & Reg. fee</b></div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['grn_for_stamp_duty']!=""){ echo $agreement[0]['grn_for_stamp_duty']; } else{ echo "-"; } ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>PRN for DHC</b></div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['grn_for_reg_fee']!=""){ echo $agreement[0]['grn_for_reg_fee']; } else{ echo "-"; } ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">                        
                <div class="col-md-12 col-lg-6 appointmentdata" id="appointmentdata">
                    <div class="card">
                        <div class="card-header sec-card-head justify-content-between align-items-center col-12 "><div><h2 class="card-head-title">Biomentric Appointment<small> <?php if($agreement[0]['biometric_appointement_date']<date("Y-m-d H:i:s") && $agreement[0]['agreement_status']=="Open"){ ?> <span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Overdue</span><? } ?></small></h2></div></div>
                        <div class="card-body">
                            <div class="appmsgs"></div>
                            <table class="table table-bordered mb-0">
                                <tr>
                                    <td class="py-2 align-middle"><b>Date</b></td>
                                    <td class="py-2 align-middle">
                                    <?php if($agreement[0]['biometric_appointement_date']!=""){echo date("d M y h:i a",strtotime($agreement[0]['biometric_appointement_date']));}else{echo "[Not Defined]";} ?>
                                    </td>
                                    <td class="text-right py-2 align-middle">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="edit('edit_appointment','<?php echo $agreement[0]['agreement_no']; ?>')"><i class="fa fa-edit"></i></button>
                                    <!-- <?php if(($agreement[0]['biometric_appointement_date']<date("Y-m-d H:i:s") && $agreement[0]['agreement_status']=="Open")|| $agreement[0]['agreement_status']=="Open"){ ?>
                                    <button type="button" class="btn btn-default btn-sm" onclick="edit('edit_appointment','<?php echo $agreement[0]['agreement_no']; ?>')"><i class="fa fa-edit text-success"></i></button>
                                    <? } ?>-->
                                    </td>
                                </tr>
                            </table>
                            <?php
                            if(!empty($agreement[0]['party_appointement'])){
                            ?>
                            <br>
                            <table class="table table-bordered mb-0">
                                <tr>
                                    <td class="py-2 align-middle"><b><?php echo ucfirst($agreement[0]['party_appointement']);?> Date</b></td>
                                    <td class="py-2 align-middle">
                                    <?php if($agreement[0]['ex_biometric_appointement_date']!=""){echo date("d M y h:i a",strtotime($agreement[0]['ex_biometric_appointement_date']));}else{echo "[Not Defined]";} ?>
                                    </td>
                                    <td class="text-right py-2 align-middle">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="edit('ex_edit_appointment','<?php echo $agreement[0]['agreement_no']; ?>')"><i class="fa fa-edit"></i></button>
                                    </td>
                                </tr>
                            </table>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6" id="paymentdata paymentdata1">
                    <div class="card">
                        <div class="card-header sec-card-head justify-content-between align-items-center col-12"><div><h2 class="card-head-title">Payment Details</h2></div></div>
                        <div class="card-body">
                            <div class="paymsgs"></div>
                            <table class="table table-bordered mb-0">
                                <tr>
                                    <td class="py-2"><b>Payment Status</b></td>
                                    <td class="py-2">
                                    <?php if($agreement[0]['payment_mode']==""||($agreement[0]['payment_mode']=="Online"&&$agreement[0]['isPaid']=="0")){ ?>
                                    <span>Pending</span>
                                    <? } else if($agreement[0]['payment_mode']=="COD"){
                                    echo "COD";
                                    if($agreement[0]['isPaid']=="0"){ echo " <span class='text-danger'>(Pending)</span>"; } else{ echo " <span class='text-success'>(Received)</span>"; }
                                    } else if($agreement[0]['payment_mode']=="Online"&&$agreement[0]['isPaid']=="1"){ echo "Online";echo " <span class='text-success'>(Received)</span>"; } ?>
                                    </td>
                                    <?php if($getusertype == 'Admin'){ //If user is admin ?>
                                    <td class="text-right py-2">
                                    <?php 
                                    if($agreement[0]['isPaid']=="0"){ ?>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="edit('edit_payment','<?php echo $agreement[0]['agreement_no']; ?>')"><i class="fa fa-edit"></i></button> <? } ?>
                                    </td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-header sec-card-head justify-content-between align-items-center col-12"><div><h2 class="card-head-title">LandLords</h2></div></div>
                        <div>
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
                                <div class="landlorddatamsgs"></div>
                                <?php for($i=0;$i<count($landlord);$i++){
                                $lcnt=$i+1; ?>
                                <div class="panel panel-default landlordList border-bottom px-3 py-2" id="landlordList">
                                    <div class="panel-heading d-flex align-items-center justify-content-between" role="tab" id="headingOne">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $lcnt; ?>" aria-expanded="false" aria-controls="collapseOne"><div class="panel-title"><?php echo $landlord[$i]['landlord_name']; ?></div></a>
                                        <div class="editBtn"><button type="button" class="btn btn-primary btn-sm" onclick="edit('edit_landlord','<?php echo $landlord[$i]['landlord_id']; ?>')"><i class="fa fa-edit"></i></button> <button type="button" class="btn btn-secondary btn-sm" onclick="del('del_landlord','<?php echo $landlord[$i]['landlord_id']; ?>')"><i class="fa fa-trash"></i></button></div>
                                    </div>
                                    <div id="collapse<?php echo $lcnt; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <form class="form-horizontal">
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Name</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $landlord[$i]['landlord_name']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Gender</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $landlord[$i]['landlord_gender']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>DOB</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $landlord[$i]['landlord_dob']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Age</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $landlord[$i]['landlord_age']." years"; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Occupation</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails" ><?php echo $landlord[$i]['landlord_occupation']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Contact No.</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $landlord[$i]['landlord_contact_no']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>PAN No.</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $landlord[$i]['landlord_pan_no']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Aadhaar No.</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $landlord[$i]['landlord_aadhaar_no']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Email</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $landlord[$i]['landlord_email']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Postal Address</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $landlord[$i]['landlord_address']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Pincode</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $landlord[$i]['landlord_address_pin']; ?></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-header sec-card-head justify-content-between align-items-center col-12"><div><h2 class="card-head-title">Tenants</h2></div></div>
                            <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="false">
                                <div class="tenentdatamsgs"></div>
                                <?php for($i=0;$i<count($tenents);$i++){
                                $lcnt=$i+1; ?>
                                <div class="panel panel-default landlordList border-bottom px-3 py-2" id="tenentList">
                                    <div class="panel-heading d-flex align-items-center justify-content-between" role="tab" id="headingTwo">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapset<?php echo $lcnt; ?>" aria-expanded="false" aria-controls="collapseOne"><div class="panel-title"><?php echo $tenents[$i]['tenent_name']; ?></div></a>
                                        <div class="editBtn"><button type="button" class="btn btn-primary btn-sm" onclick="edit('edit_tenent','<?php echo $tenents[$i]['tenent_no']; ?>')"><i class="fa fa-edit"></i></button> <button type="button" class="btn btn-secondary btn-sm" onclick="del('del_tenent','<?php echo $tenents[$i]['tenent_no']; ?>')"><i class="fa fa-trash"></i></button></div>
                                    </div>
                                    <div id="collapset<?php echo $lcnt; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            <form class="form-horizontal">
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Name</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $tenents[$i]['tenent_name']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Gender</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $tenents[$i]['tenent_gender']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>DOB</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $tenents[$i]['tenent_dob']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Age</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $tenents[$i]['tenent_age']." years"; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Occupation</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $tenents[$i]['tenent_occupation']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Contact No.</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $tenents[$i]['tenent_contact_no']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>PAN No.</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $tenents[$i]['tenent_pan_no']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Aadhaar No. </b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $tenents[$i]['tenent_aadhaar_no']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Email </b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $tenents[$i]['tenent_email']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Postal Address </b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $tenents[$i]['tenent_address']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-4 landLordDetails"><b>Pincode</b></label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $tenents[$i]['tenent_address_pin']; ?></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(count($vitness)){ ?>
                <div class="card">
                    <div class="card-header sec-card-head justify-content-between align-items-center col-12"><div><h2 class="card-head-title">Witness Details</h2></div></div>
                        <div class="panel-body">
                            <?php for($i=0;$i<count($vitness);$i++){
                            $lcnt = $i+1;?>
                            <div class="panel panel-default vitnessList border-bottom px-3 py-2" id="vitnessList">
                                <div class="panel-heading" role="tab" id="headingTwo"><a role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapset_v<?php echo $lcnt; ?>" aria-expanded="false" aria-controls="collapseOne"><div class="panel-title"><?php echo $vitness[$i]['vitness_name']; ?></div></a><div class="editBtn"></div></div>
                                <div id="collapset_v<?php echo $lcnt; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                  <div class="panel-body">
                                      <div class="row mt-2">
                                        <form class="form-horizontal col-lg-8">
                                            <div class="row">
                                                <label class="col-md-4 col-lg-2 landLordDetails">Name</label>
                                                <div class="col-md-8 col-lg-8 landLordDetails"><?php if($vitness[$i]['vitness_name'] == ""){ echo "NA"; } else{ echo $vitness[$i]['vitness_name']; } ?></div>
                                            </div>
                                            <div class="row">
                                                    <label class="col-4 col-md-2 landLordDetails">DOB</label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo $vitness[$i]['witness_dob']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-4 col-md-2 landLordDetails">Age</label>
                                                    <div class="col-8 col-md-8 landLordDetails"><?php echo ($vitness[$i]['witness_age']) ? $vitness[$i]['witness_age']." years" : ''; ?></div>
                                                </div>
                                            <div class="row">
                                                <label class="col-md-4 col-lg-2 landLordDetails">Email</label>
                                                <div class="col-md-8 col-lg-8 landLordDetails"><?php if($vitness[$i]['vitness_email'] == ""){ echo "NA"; } else{ echo $vitness[$i]['vitness_email']; } ?></div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-4 col-lg-2 landLordDetails">Mobile</label>
                                                <div class="col-md-8 col-lg-8 landLordDetails"><?php if($vitness[$i]['vitness_mbl'] == ""){ echo "NA";  } else{ echo $vitness[$i]['vitness_mbl']; } ?></div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-4 col-lg-2 landLordDetails">Adress</label>
                                                <div class="col-md-8 col-lg-8 text-muted landLordDetails"><?php if($vitness[$i]['vitness_address'] == ""){ echo "NA"; } else{ echo $vitness[$i]['vitness_address']; } ?></div>
                                            </div>
                                        </form>
                                    </div>
                            </div> 
                        </div> 
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            <div class="card" id="propdata">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2">
                    <div><h2 class="card-head-title">Property & Fitment Details</h2></div><div class="btn-actions-pane-right"><button type="button" class="btn btn-primary btn-sm" onclick="toggle('showprop')"><i class="fa fa-eye"></i> View</button> <button type="button" class="btn btn-primary btn-sm" onclick="edit('edit_prop','<?php echo $agr; ?>')"><i class="fa fa-edit"></i> Edit</button></div>
                </div>        
                <div class="card-body">
                    <div class="propmsgs"></div>
                    <div class="showprop cc-display-none">
                        <div class="row">
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Property Type</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php echo $agreement[0]['prop_type']; ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Property Use</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['prop_use']!=""){echo $agreement[0]['prop_use'];}else{echo "[Not Defined]";} ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Property Area</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php echo $agreement[0]['prop_area']." sq.ft."; ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Gallery area</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['prop_gallery_Area']!=""){echo $agreement[0]['prop_gallery_Area']." sq.ft.";}else{echo "[Not Defined]";} ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Parking area</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['prop_parking_Area']!=""){echo $agreement[0]['prop_parking_Area']." sq.ft.";}else{echo "[Not Defined]";} ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Building Name</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['prop_building_name']!=""){echo $agreement[0]['prop_building_name'];}else{echo "[Not Defined]";} ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Flat No</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['prop_flat_no']!=""){echo $agreement[0]['prop_flat_no'];}else{echo "[Not Defined]";} ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Floor No</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['prop_floor_no']!=""){echo $agreement[0]['prop_floor_no'];}else{echo "[Not Defined]";} ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Road</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['prop_road']!=""){echo $agreement[0]['prop_road'];}else{echo "[Not Defined]";} ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Locality</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['prop_locality']!=""){echo $agreement[0]['prop_locality'];}else{echo "[Not Defined]";} ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Survey Number</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['prop_no']!=""){echo $agreement[0]['prop_no'];}else{echo "[Not Defined]";} ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Village</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['prop_village']!=""){ echo $agreement[0]['prop_village']; } else{ echo "[Not Defined]"; } ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Tahsil</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['prop_tahsil']!=""){echo $agreement[0]['prop_tahsil'];}else{echo "[Not Defined]";} ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Dist</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['prop_dist']!=""){ echo $agreement[0]['prop_dist']; } else{ echo "[Not Defined]"; } ?></div>
                            </div>
                            <div class="form-group mb-2 row col-sm-6 col-md-6">
                                <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5"><b>Pincode</b></div>
                                <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($agreement[0]['prop_pin']!=""){ echo $agreement[0]['prop_pin']; } else{ echo "[Not Defined]"; } ?></div>
                            </div>
                        </div>
                        <table class="table table-bordered mb-0 mt-2">
                            <thead><tr><th>#</th><th>Perticular</th><th>Unit</th><th class="seperator" rowspan="10"></th><th>#</th><th>Perticular</th><th>Unit</th></tr></thead>
                            <tbody>
                            <tr><td class="py-2">1</td><td class="py-2">Fan</td><td class="py-2"><?php if($fitments[0]['fan']){ echo $fitments[0]['fan']; } else{ echo 0; } ?></td><td></td><td class="py-2">9</td><td class="py-2">Air conditioner</td><td class="py-2"><?php if($fitments[0]['ac']){echo $fitments[0]['ac'];}else{echo 0;} ?></td></tr>
                            <tr><td class="py-2">2</td><td class="py-2">Tubelight</td><td class="py-2"><?php if($fitments[0]['tubelight']){ echo $fitments[0]['tubelight']; }else{ echo 0; } ?></td>
                            <td></td><td class="py-2">10</td><td class="py-2">Electric Geezer</td><td class="py-2"><?php if($fitments[0]['electric_geezer']){echo $fitments[0]['electric_geezer'];}else{echo 0;} ?></td></tr>
                            <tr><td class="py-2">3</td><td class="py-2">Bulb</td><td class="py-2"><?php if($fitments[0]['bulb']){echo $fitments[0]['bulb'];}else{echo 0;} ?></td><td></td><td class="py-2">11</td><td class="py-2">Gas Geezer</td><td class="py-2"><?php if($fitments[0]['gas_geezer']){echo $fitments[0]['gas_geezer'];}else{echo 0;} ?></td></tr>
                            <tr><td class="py-2">4</td><td class="py-2">Bed</td><td class="py-2"><?php if($fitments[0]['bed']){echo $fitments[0]['bed'];}else{echo 0;} ?></td><td></td><td class="py-2">12</td><td class="py-2">Air Cooler</td><td class="py-2"><?php if($fitments[0]['air_cooler']){echo $fitments[0]['air_cooler'];}else{echo 0;} ?></td></tr>
                            <tr><td class="py-2">5</td><td class="py-2">Sofa</td><td class="py-2"><?php if($fitments[0]['sofa']){echo $fitments[0]['sofa'];}else{echo 0;} ?></td><td></td><td class="py-2">13</td><td class="py-2">Water Cooler</td><td class="py-2"><?php if($fitments[0]['water_cooler']){echo $fitments[0]['water_cooler'];}else{echo 0;} ?></td></tr>
                            <tr><td class="py-2">6</td><td class="py-2">Chair</td>
                            <td class="py-2"><?php if($fitments[0]['chair']){echo $fitments[0]['chair'];}else{echo 0;} ?></td><td></td><td class="py-2">14</td><td class="py-2">Curtains</td><td class="py-2"><?php if($fitments[0]['curtains']){echo $fitments[0]['curtains'];}else{echo 0;} ?></td></tr>
                            <tr><td class="py-2">7</td><td class="py-2">Table</td><td class="py-2"><?php if($fitments[0]['table']){echo $fitments[0]['table'];}else{echo 0;} ?></td><td></td><td class="py-2">15</td><td class="py-2">Washing Machine</td><td class="py-2"><?php if($fitments[0]['washing_machine']){echo $fitments[0]['washing_machine'];}else{echo 0;} ?></td></tr>
                            <tr><td class="py-2">8</td><td class="py-2">Cupboard</td><td class="py-2"><?php if($fitments[0]['cupboard']){echo $fitments[0]['cupboard'];}else{echo 0;} ?></td><td></td><td class="py-2">16</td><td class="py-2">Other</td><td class="py-2"><?php if($fitments[0]['other']){echo $fitments[0]['other'];}else{echo 0;} ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center col-12"><div><h2 class="card-head-title">Miscellaneous</h2></div></div>
                <div class="card-body">
                    <?php if(trim($agreement[0]['miscellaneous'])!=""){ echo nl2br(htmlspecialchars($agreement[0]['miscellaneous'])); } else{ echo "-"; } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-header sec-card-head justify-content-between align-items-center col-12"><div><h2 class="card-head-title">Rent and Duration Details</h2></div></div>
                        <div class="card-body limited-cont-overflow">
                            <div class="form-group mb-2 row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 control-label cc-font-weight-5"><b>Duration</b></div>
                                <div class="col-9 col-sm-9 col-md-9 col-lg-9"><?php if($agreement[0]['duration']!=""){echo $agreement[0]['duration']." Months";}else{echo "[Not Defined]";} ?></div>
                            </div>
                            <div class="form-group mb-2 row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 control-label cc-font-weight-5"><b>Deposite</b></div>
                                <div class="col-9 col-sm-9 col-md-9 col-lg-9"><i class="fa fa-inr"></i> <?php echo $agreement[0]['deposite']; ?></div>
                            </div>
                            <div class="form-group mb-2 row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 control-label cc-font-weight-5"><b>Date</b></div>
                                <div class="col-9 col-sm-9 col-md-9 col-lg-9"><?php echo date("d M Y",strtotime($agreement[0]['starting_from']))." <b>To</b> ".date("d M Y",strtotime($agreement[0]['end_to'])); ?></div>
                            </div>
                            <div class="form-group mb-0 row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 control-label cc-font-weight-5"><b>Rent</b></div>
                                <div class="col-9 col-sm-9 col-md-9 col-lg-9">
                                    <?php if($agreement[0]['rent_type']=="Fixed"){ ?>
                                    <span><i class="fa fa-inr"></i> <?php echo $rent[0]['rent'] ?> Per Month</span>
                                    <? } else{  ?>
                                    <table class="table">
                                        <tr><th>#</th><th>Months</th><th>Rent</th></tr>
                                        <?php for($i=0;$i<count($rent);$i++){ ?>
                                        <tr><th><?php echo $i+1; ?></th><th><?php echo $rent[$i]['duration']; ?></th><th><i class="fa fa-inr"></i> <?php echo $rent[$i]['rent']; ?></th></tr>
                                        <? } ?>
                                    </table>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-header sec-card-head justify-content-between align-items-center col-12"><div><h2 class="card-head-title">Fees</h2></div></div>
                        <div class="card-body limited-cont-overflow">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
                                <table class="table table-bordered mb-0">
                                    <tr><td class="py-2"><b>Reg. Fee</b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <?php echo $agreement[0]['reg_fee']; ?></td></tr>
                                    <tr><td class="py-2"><b>Stamp Duty</b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <?php echo $agreement[0]['stamp_duty']; ?></td></tr>
                                    <tr><td class="py-2"><b>Service Charges</b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <?php echo $agreement[0]['service_charges']; ?></td></tr>
                                    <tr><td class="py-2"><b>Visit Charges </b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <?php echo $agreement[0]['visit_charge']; ?></td></tr>
                                    <tr><td class="py-2"><b>DHC Charges </b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <?php echo $agreement[0]['dhc_charges']; ?></td></tr>
                                    <tr class="<?=($agreement[0]['is_extra_visit']==0?'hidden':''); ?>"><td class="py-2"><b>Extra Visit Charges </b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <?php echo $agreement[0]['extra_visit_charges']; ?></td></tr>
                                    <tr class="<?=($agreement[0]['is_police_initimation']==0?'hidden':''); ?>"><td class="py-2"><b>Police Intimation Charges </b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <?php echo $agreement[0]['police_initimation_charges']; ?></td></tr>
                                    <tr class="bg-light"><td class="py-2"><b>Total Charges</b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <?php echo $agreement[0]['total_charges']; ?></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../footer.php'?>
    </div>
</div>
<div class="modal fade dellandlord" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"><div class="modal-dialog modal-sm" role="document"><div class="modal-content"></div></div></div>
<div class="modal fade allinone" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"><div class="modal-dialog modal-md" role="document"><div class="modal-content"><div class="modal-body allinonebody"></div></div></div></div>
<script src="<?php echo SITEURL; ?>/js/generalfunctions.js"></script>
<script src="<?php echo SITEURL; ?>/js/datepicker/moment.js"></script>
<script src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>
<script>
$("#paydate").datetimepicker({ format: 'DD/MM/YYYY' });
function edit(action,id) {
    info = { action:action,id:id }
    $.ajax({ type:"POST", url:"ajax.php", data:info,
    success:function(response){ $(".allinone").modal("show"); $(".allinonebody").html(response); } });
}
function cancelupdate(){ $(".allinone").modal("hide"); $(".allinonebody").html("") }
function update(updating_id,action,nameval,gender,dob,age,occupation,contact,panno,addhar,email,addr,pin,msgclass){
    action = $("."+action).val(); updating_id = $("."+updating_id).val(); nameval = $("."+nameval).val(); gender=$("."+gender).val(); dob=$("."+dob).val();  age=$("."+age).val(); occupation=$("."+occupation).val(); contact=$("."+contact).val(); panno=$("."+panno).val(); addhar=$("."+addhar).val(); email=$("."+email).val(); addr=$("."+addr).val(); pin=$("."+pin).val();
    info = { action:action, id:updating_id, name:nameval, gender:gender,dob:dob,age:age, occupation:occupation, contact:contact, panno:panno, addhar:addhar, email:email, addr:addr, pin:pin}
    $.ajax({
        type:"POST", url:"ajax.php", data:info,
        success:function(response){
            if(response.trim()=="1"){
                $(".allinone").modal("hide");
                $(".allinonebody").html(response);
                location.reload();
                if(action=="update_landlord"){
                    $(".landlorddatamsgs").addClass("alert alert-success").fadeIn().html("Details Updated Successfully").delay(5000).fadeOut();
                    setTimeout(function(){  $('#right_col').load(document.URL +  ' #dashbody'); }, 3000);
                } else if(action=="update_tenent"){
                    $(".tenentdatamsgs").addClass("alert alert-success").fadeIn().html("Details Updated Successfully").delay(5000).fadeOut();
                    setTimeout(function(){  $('#right_col').load(document.URL +  ' #dashbody'); }, 3000);
                }
            } else{ $("."+msgclass).addClass("alert alert-danger").fadeIn().html("Error In Update").delay(5000).fadeOut(); }
        }
    });
}
function updateprop(agrno){
    action = "update_prop"; updating_id = agrno; arealoc = $(".arealoc:checked").val(); propertytype = $(".propertytype option:selected").val(); builtarea = $(".builtarea").val(); gallery = $(".gallery").val(); parking = $(".parking").val(); propertyuse = $(".propertyuse option:selected").val(); buildingname = $(".buildingname").val(); flat = $(".flat").val(); floor = $(".floor").val(); road = $(".road").val(); locality = $(".locality").val(); propno = $(".propno").val(); village = $(".village").val(); tahsil = $(".tahsil").val(); dist = $(".dist").val(); proppin = $(".proppin").val(); fan = $(".fan").val(); tbelight = $(".tbelight").val(); bulb = $(".bulb").val(); bed = $(".bed").val(); sofa = $(".sofa").val(); table1 = $(".table1").val(); chair = $(".chair").val(); cupboard = $(".cupboard").val(); ac = $(".ac").val(); elegeezer = $(".elegeezer").val(); gasgeezer = $(".gasgeezer").val(); cooler = $(".cooler").val(); watercooler = $(".watercooler").val(); curtains = $(".curtains").val(); VDO = $(".VDO").val(); purifier = $(".purifier").val(); kitchen = $(".kitchen").val(); washing_machine =  $(".washing_machine").val(); other = $(".other").val();
    info = {action:action, id:updating_id, arealoc:arealoc, propertytype:propertytype, builtarea:builtarea, gallery:gallery, parking:parking, propertyuse:propertyuse, buildingname:buildingname, flat:flat, floor:floor, road:road, locality:locality, propno:propno, village:village, tahsil:tahsil, dist:dist, proppin:proppin, fan:fan, tubelight:tbelight, bulb:bulb, bed:bed, sofa:sofa, table1:table1, chair:chair, cupboard:cupboard, ac:ac, elegeezer:elegeezer, gasgeezer:gasgeezer, cooler:cooler, watercooler:watercooler, curtains:curtains, VDO:VDO, purifier:purifier, kitchen:kitchen, washing_machine:washing_machine, other:other }
    $.ajax({
        type:"POST", url:"ajax.php", data:info,
        success:function(response){
            if(response.trim()=="1"){
                $(".allinone").modal("hide");
                $(".allinonebody").html(response);
                location.reload();
                $(".propmsgs").addClass("alert alert-success").fadeIn().html("Details Updated Successfully").delay(5000).fadeOut();
                setTimeout(function(){  $('#right_col').load(document.URL +  ' #dashbody'); }, 3000);
            } else{ $(".propupdatemsg").addClass("alert alert-danger").fadeIn().html("Error In Update").delay(5000).fadeOut(); }
        }
    });
}
function updateappointment(agrno,appotdateclass){
    action = "update_appointment"; updating_id = agrno; appdate = $("."+appotdateclass).val();
    info = { action:action, id:updating_id, appdate:appdate };
    $.ajax({
        type:"POST", url:"ajax.php", data:info,
        success:function(response){
            if(response.trim()=="1"){
                $(".allinone").modal("hide"); $(".allinonebody").html(response);
                location.reload();
                $(".appmsgs").addClass("alert alert-success").fadeIn().html("Appointment Date Changed").delay(5000).fadeOut();
                setTimeout(function(){  $('#right_col').load(document.URL +  ' #dashbody'); }, 3000);
            } else{
                $(".appupdatemsg").addClass("alert alert-danger").fadeIn().html("Error In Update").delay(5000).fadeOut();
            }
        }
    });
}
function exupdateappointment(agrno,appotdateclass){
    action = "ex_update_appointment"; updating_id = agrno; appdate = $("."+appotdateclass).val();
    info = { action:action, id:updating_id, appdate:appdate };
    $.ajax({
        type:"POST", url:"ajax.php", data:info,
        success:function(response){
            if(response.trim()=="1"){
                $(".allinone").modal("hide"); $(".allinonebody").html(response);
                location.reload();
                $(".appmsgs").addClass("alert alert-success").fadeIn().html("Appointment Date Changed").delay(5000).fadeOut();
                setTimeout(function(){  $('#right_col').load(document.URL +  ' #dashbody'); }, 3000);
            } else{
                $(".appupdatemsg").addClass("alert alert-danger").fadeIn().html("Error In Update").delay(5000).fadeOut();
            }
        }
    });
}
function updatepayment(agrno){
    action = "update_payment"; updating_id = agrno; paymode = $(".payment_mode option:selected").val(); payment_status = $(".payment_status option:selected").val(); paydate = $(".paydate").val();
    info = {action:action, id:updating_id, paymode:paymode, payment_status:payment_status, paydate:paydate };
    $.ajax({
        type:"POST", url:"ajax.php", data:info,
        success:function(response){
            if(response.trim()=="1"){
                $(".allinone").modal("hide"); $(".allinonebody").html(response);
                location.reload();
                $(".paymsgs").addClass("alert alert-success").fadeIn().html("Payment Updated").delay(5000).fadeOut();
                setTimeout(function(){ $('#right_col').load(document.URL +  ' #dashbody'); }, 3000);
            } else{ $(".payupdatemsg").addClass("alert alert-danger").fadeIn().html("Error In Update").delay(5000).fadeOut(); }
        }
    });
}
function chngstatus(agrno){
    info = {action:"chng_status",id:agrno}
    $.ajax({
        type:"POST", url:"ajax.php", data:info, success:function(response){ $(".allinone").modal("show"); $(".allinonebody").html(response); }
    });
}
function updatestatusdata(agrno){
    agrstatus = $(".agrstatus option:selected").val(); token = $(".token").val(); regno = $(".regno").val(); grnreg = $(".grnreg").val(); grnstamp = $(".grnstamp").val();
    info = { action:"update_status", id:agrno, agrstatus:agrstatus, token:token, regno:regno, grnreg:grnreg, grnstamp:grnstamp }
    $.ajax({
        type:"POST", url:"ajax.php", data:info,
        success:function(response){
            if(response.trim()=="1"){
                $(".allinone").modal("hide");
                $(".allinonebody").html(response);
                location.reload();
                $('#right_col').load(document.URL +  ' #dashbody');
            } else{ $(".statusmsg").addClass("alert alert-danger").fadeIn().html("Error In Update").delay(5000).fadeOut(); }
        }
    });
}
function del(action,id){
    info = {action:action,id:id}
    $.ajax({ type:"POST", url:"ajax.php", data:info,
    success:function(response){ $(".dellandlord").modal("show"); $(".dellandlord .modal-content").html(response); }
    });
}
function delconfirmed(action,id){
    info = {action:action,id:id}
    $.ajax({ type:"POST", url:"ajax.php", data:info, success:function(response){ $(".dellandlord").modal("hide"); $('#right_col').load(document.URL +  ' #dashbody'); } });
}
function cancelupdate1(){ $(".dellandlord").modal("hide"); $(".dellandlord .modal-content").html("") }
function toggle(clname){ $("."+clname).toggle(); }
</script>
</body>
</html>