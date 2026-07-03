<?php include("../../includes/configuration.php");
$page ='managesms'; $host_name = HOST; $database = DATABASE; $username = USERNM;$password = PASSWRD; $topup = selectQuery(SMS,"*","date like '%".date('Y-m-d')."%' order by sms_id DESC"); $distcat = selectQuery(SMS,"distinct msg_type","1 order by msg_type ASC"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Manage SMS</title>
    <? include "../commoncss.php"; ?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css"/> 
</head>
<body>
<div class="page-body-wrapper">
    <? include '../header.php'; ?>
    <? include '../cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Manage SMS</h2></div><div class="btn-actions-pane-right"><a href="addtopup.php" class="btn btn-primary btn-sm">Add SMS Top-Up</a></div></div>
                <div class="card-body">
                    <div>
                        <?php $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://api-alerts.solutionsinfini.com/v3/?method=account.credits&api_key=".WORKINGKEY."&format=PHP");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch); curl_close($ch); $arr = (unserialize($output));
                        $credit = floor($arr['data']['credits']); ?>
                        <h6 class="mb-3">Available SMS Credits - <span style="color:<?php if($credit<=200){echo 'red';} ?>"><?php echo $credit; ?></span></h6>
                    </div>
                    <div class="filterdata">
                        <div class="msgsbox"></div>
                        <form id="report" action="generatesmsreport.php">
                            <div class="row border-bottom mb-3">
                                <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                    <select name="smstype" id="smstype" class="form-control">
                                        <option value="All">All</option>
                                        <?php for($i=0;$i<count($distcat);$i++){ ?>
                                        <option value="<?php echo $distcat[$i]['msg_type']; ?>"><?php echo $distcat[$i]['msg_type']; ?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                    <input type="hidden" name="data1" class="form-control" value="<?php echo base64_encode($host_name); ?>"><input type="hidden" name="data2" class="form-control" value="<?php echo base64_encode($database); ?>"><input type="hidden" name="data3" class="form-control" value="<?php echo base64_encode($username); ?>"><input type="hidden" name="data4" class="form-control" value="<?php echo base64_encode($password); ?>"><input type="text" name="pd" placeholder="From Date" class="form-control" id="datepicker">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 form-group"><input type="text" name="pd1" placeholder="To Date" class="form-control" id="datepicker1"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12 text-left form-group"><button type="button" class="btn btn-primary generate" onclick="generatereport()">Download Report</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Today's Sent SMS <?php echo "(".count($topup).")"; ?></h2></div><div class="btn-actions-pane-right"><button class="refresh btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh Status</button></div></div>
                <div class="card-body">
                    <div class="msgs"></div>
                    <div class="todaysms">
                        <div class="table-responsive">
                            <table class="example table table-bordered">
                                <thead><tr><th>#</th><th>Date</th><th>SMS Type</th><th>Mobile No</th><th>SMS</th><th>Status</th></tr></thead>
                                <tbody>
                                    <?php if(count($topup)){
                                    for($i=0;$i<count($topup);$i++){ ?>
                                    <tr>
                                        <td><?php echo $i+1; ?></td>
                                        <td><?php echo $topup[$i]['date']; ?></td>
                                        <td><?php echo $topup[$i]['msg_type']; ?></td>
                                        <td><?php echo $topup[$i]['mobile_no']; ?></td>
                                        <td><?php echo $topup[$i]['message']; ?></td>
                                        <td><?php if($topup[$i]['status']=="DELIVRD"){ ?>
                                        <span style="color:green"><?php echo '<i class="fa fa-check-circle" aria-hidden="true"></i> Sent'; ?></span> <? } else{ echo $topup[$i]['status']; } ?></td>
                                    </tr>
                                    <? } } else{ ?>
                                    <tr><td colspan="7" class="text-center">No SMS sent today</td></tr>
                                    <? } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>   
    </div>
</div>
<script src="<?php echo SITEURL; ?>/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/datepicker/moment.js"></script>
<script src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>
<script>$(document).ready(function(){ $('.example').DataTable(); });</script>
<script>
$("#datepicker").datetimepicker({ format: 'DD/MM/YYYY' })
$("#datepicker1").datetimepicker({ format: 'DD/MM/YYYY' })
function generatereport(){
    var date1 = $("#datepicker").val(); var date2 = $("#datepicker1").val(); var d1 = date1.split("/"); var d2 = d1[2] + "" + d1[1] + "" + d1[0]; var d3 = date2.split("/"); var d4 = d3[2] + "" + d3[1] + "" + d3[0]; var diff = d4 - d2;
    if (date1 == "" || date2 == ""){
        $(".msgsbox").html("Please enter From and To dates").addClass("alert alert-danger").delay(5000).fadeOut();
    } else if (diff < 0){
        $(".msgsbox").html("From date may not be greater than To date").addClass("alert alert-danger").delay(5000).fadeOut();
    } else{ $("#report").submit() }
}
function formatDate(date){
    var d = new Date(date), month = '' + (d.getMonth() + 1), day = '' + d.getDate(),
    year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('');
}
$(document).ready(function(){
    $(".refresh").click(function(){
        $(".refresh").attr('disabled',true);
        $.ajax({
            url: "refreshstatus.php", success: function(){
                $(".refresh").attr('disabled',false); $(".refresh img").remove(); location.reload();
            }
        });
    });
});
</script>
</body>
</html>