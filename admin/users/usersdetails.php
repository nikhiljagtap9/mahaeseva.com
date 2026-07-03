<?php include("../../includes/configuration.php"); $userid = base64_decode($_REQUEST['u_id']); $getuser = selectQuery(WEB_USER,"*"," u_id='".$userid."'"); ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITE_TITLE; ?> : User Details</title>
    <? include "../commoncss.php"; ?>
</head>
<body>
<div class="page-body-wrapper">
    <? include '../header.php'; ?>
    <? include '../cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">User Details<!--<?php echo $getuser[0]['u_name']; ?>--></h2></div> <div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-lg-2 col-xl-2 mb-3 mb-sm-0">
                            <?
                            /* if ($getuser[0]['profile_pic']!="")
                            echo "<img src='".SITEURL."/img/userprofilepic/user_".$userid.".png' style='width:120px'  alt='propic'/>";
                            else*/
                            echo "<img src='".SITEURL."/img/projectimage/User-icon.png' class='rounded img-fluid' alt='propic'/>"; ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-lg-10 col-xl-9">
                            <div class="row">
                                <div class="form-group mb-2 row col-sm-6 col-md-6">
                                    <div class="col-5 col-sm-12 col-md-12 col-lg-12 col-xl-5 control-label cc-font-weight-5">Member Since</div>
                                    <div class="col-7 col-sm-12 col-md-12 col-lg-12 col-xl-7"><?php echo date("d M Y h:i a",strtotime($getuser[0]['added_on'])); ?></div>
                                </div>
                                <div class="form-group mb-2 row col-sm-6 col-md-6">
                                    <div class="col-5 col-sm-12 col-md-12 col-lg-12 col-xl-5 control-label cc-font-weight-5">Name</div>
                                    <div class="col-7 col-sm-12 col-md-12 col-lg-12 col-xl-7"><?php echo $getuser[0]['u_fname']." ".$getuser[0]['u_lname']; ?></div>
                                </div>
                                <div class="form-group mb-2 row col-sm-6 col-md-6">
                                    <div class="col-5 col-sm-12 col-md-12 col-lg-12 col-xl-5 control-label cc-font-weight-5">Email</div>
                                    <div class="col-7 col-sm-12 col-md-12 col-lg-12 col-xl-7"><?php echo $getuser[0]['u_email']; ?></div>
                                </div>
                                <div class="form-group mb-2 row col-sm-6 col-md-6">
                                    <div class="col-5 col-sm-12 col-md-12 col-lg-12 col-xl-5 control-label cc-font-weight-5">Mobile</div>
                                    <div class="col-7 col-sm-12 col-md-12 col-lg-12 col-xl-7"><?php echo $getuser[0]['u_mobile']; ?></div>
                                </div>
                                <? $orderdet=selectQuery(AGR,"*","agree_by=".$userid." and isDel='0'"); ?>
                                <div class="form-group mb-2 row col-sm-6 col-md-6">
                                    <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Total Agreements</div>
                                    <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php echo count($orderdet); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="shippaddress"></div>
                    </div>
                </div>
            </div>
            <div class="data-box">
                <div class="prodedit">
                    <div class="card mb-0">
                        <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Agreements</h2></div></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="usert table table-bordered mb-0">
                                    <thead><tr><th>#</th><th>Agreement No</th><th>Request Date</th><th>Total Charges</th><th>Govt Reg. No.</th><th>Govt Token No.</th><th>Agreement Period</th><th>Ends After</th></tr></thead>
                                    <tbody>
                                    <? if(count($orderdet)>0){
                                    for($i=0;$i<count($orderdet);$i++){ ?>
                                    <tr>
                                        <td><? echo $i+1;?></td>
                                        <td><a href="<?php echo ADMINURL; ?>agreement/agreementdetails.php?agr=<?php echo base64_encode($orderdet[$i]['agreement_no']); ?>" target="_blank"><? echo $orderdet[$i]['agreement_no'];?></a></td>
                                        <td><? echo date("d M Y",strtotime($orderdet[$i]['entry_on']));?><br>
                                        <? echo date("h:i a",strtotime($orderdet[$i]['entry_on']));?>
                                        </td>
                                        <td><i class="fa fa-inr"></i> <? echo $orderdet[$i]['total_charges'];?></td>
                                        <td><? if($orderdet[$i]['govt_reg_no']!=""){echo $orderdet[$i]['govt_reg_no'];}else{echo "-";} ?></td>
                                        <td><? if($orderdet[$i]['govt_token_no']!=""){echo $orderdet[$i]['govt_token_no'];}else{echo "-";} ?></td>
                                        <td><? echo date("d M Y",strtotime($orderdet[$i]['starting_from']));?>
                                        <br><b>To</b><br>
                                        <? echo date("d M Y",strtotime($orderdet[$i]['end_to']));?></td>
                                        <td><?php $taoday=date("Y-m-d");
                                        $futute=date("Y-m-d",strtotime($orderdet[$i]['end_to']));
                                        if($futute<$taoday){ ?>
                                        <span class="text-danger">Expired</span>
                                        <? }else{
                                        $date1 = new DateTime($taoday);  //current date or any date
                                        $date2 = new DateTime($futute);   //Future date
                                        $diff = $date2->diff($date1)->format("%a");  //find difference
                                        $days = intval($diff); ?>
                                        <span class="<?php if($days<10){?>text-danger<?} ?>"><?php echo $days." days"; ?></span>
                                        <? } ?></td>
                                    </tr>
                                    <? }
                                    } else{ echo "<tr><td colspan='9' style='color:red;text-align:center'>No Records Found!</td></tr>"; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="msgs"></div>
                </div>
            </div>
        </div>
        <?php include '../footer.php';?>
    </div>
</div>
</body>
</html>