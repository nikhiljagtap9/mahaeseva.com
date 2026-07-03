<?php include("../includes/configuration.php"); $page = 'visitorindex'; $host_name = HOST;
$database = DATABASE; $username = USERNM; $password = PASSWRD;
$getuser = selectQuery(VLIST,"v_id,ip,device,browser,details,time","time like '%".date('d/m/Y')."%' order by v_id DESC"); $allvisitors = selectQuery(VLIST,"count(*) as count","v_id<>''"); $Applecnt = 0; $Chromecnt = 0; $Netscapecnt = 0; $Explorercnt=0; $Edgecnt=0; $Firefoxcnt=0; $Operaecnt=0; $uncnt=0;$icecnt=0; $Windows7cnt=0;$Windows10cnt=0; $androidcnt=0; $blackberrycnt=0; $ioscnt=0; $windowsmobcnt=0;$linuxcnt=0;
for($i=0;$i<count($getuser);$i++){
    if($getuser[$i]['browser']=='Apple Safari'){
    $Applecnt++;
    } else if($getuser[$i]['browser']=='Google Chrome'){
    $Chromecnt++;
    } else if($getuser[$i]['browser']=='Internet Explorer'){
    $Explorercnt++;
    } else if($getuser[$i]['browser']=='Microsoft Edge'){
    $Edgecnt++;
    } else if($getuser[$i]['browser']=='Mozilla Firefox'){
    $Firefoxcnt++;
    } else if($getuser[$i]['browser']=='Netscape'){
    $Netscapecnt++;
    } else if($getuser[$i]['browser']=='Opera'){
    $Operaecnt++;
    } else if($getuser[$i]['browser']=='Iceweasel'){
    $icecnt++;
    } else if($getuser[$i]['browser']=='NA'||$getuser[$i]['browser']==''){
    $uncnt++;
    } if($getuser[$i]['device']=='Windows 7'){
    $Windows7cnt++;
    } else if($getuser[$i]['device']=='Windows 10'){
    $Windows10cnt++;
    } else if($getuser[$i]['device']=='Windows 10'){
    $Windows10cnt++;
    } else if($getuser[$i]['device']=='android'){
    $androidcnt++;
    } else if($getuser[$i]['device']=='blackberry'){
    $blackberrycnt++;
    } else if($getuser[$i]['device']=='Windows Phone'){
    $windowsmobcnt++;
    } else if($getuser[$i]['device']=='Linux'){
    $linuxcnt++;
    } else if($getuser[$i]['device']=='iphone'||$getuser[$i]['device']=='ipad'){
    $ioscnt++;
    }
} ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | Visitor Report</title>
    <?php include 'commoncss.php';?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css"/>   
</head>
<body>
<div class="page-body-wrapper">
    <?php include('header.php'); ?>
    <?php include('cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Search Visitor Report</h2></div></div>
                <div class="filterdata">
                     <form id="report" action="../excel.php">
                        <div class="card-body pb-1">
                            <div class="row">
                                <div class="col-6 col-sm-4 col-md-6 col-lg-3 mb-3">
                                    <input type="hidden" name="data1" class="form-control" value="<?php echo base64_encode($host_name); ?>"><input type="hidden" name="data2" class="form-control" value="<?php echo base64_encode($database); ?>"><input type="hidden" name="data3" class="form-control" value="<?php echo base64_encode($username); ?>">
                                    <input type="hidden" name="data4" class="form-control" value="<?php echo base64_encode($password); ?>">
                                    <label>From Date</label>
                                    <input type="text" name="pd" placeholder="From Date" class="form-control" id="datepicker">
                                </div>
                                <div class="col-6 col-sm-4 col-md-6 col-lg-3 mb-3">
                                    <label>To Date</label>
                                    <input type="text" name="pd1" placeholder="To Date" class="form-control" id="datepicker1">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-2 text-right"><button type="button" class="btn btn-primary generate" onclick="generatereport()">Download Report</button></div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Todays Visitors List (<?php echo count($getuser)." / ".$allvisitors[0]['count']; ?>)</h2></div></div>
                <div class="card-body">
                    <div class="msgsbox"></div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 stat1 mb-3 mb-md-0">
                            <h6 class="mb-3 cc-font-weight-5">Browser Specific Hits</h6>
                            <div class = "table-responsive">
                                <table class="work table table-bordered mb-0">
                                    <tr><td class="py-2">Apple Safari</td><td class="py-2"><?php echo $Applecnt; ?></td></tr>
                                    <tr><td class="py-2">Google Chrome</td><td class="py-2"><?php echo $Chromecnt; ?></td></tr>
                                    <tr><td class="py-2">Internet Explorer</td><td class="py-2"><?php echo $Explorercnt; ?></td></tr>
                                    <tr><td class="py-2">Microsoft Edge</td><td class="py-2"><?php echo $Edgecnt; ?></td></tr>
                                    <tr><td class="py-2">Mozilla Firefox</td><td class="py-2"><?php echo $Firefoxcnt; ?></td></tr>
                                    <tr><td class="py-2">Netscape</td><td class="py-2"><?php echo $Netscapecnt; ?></td></tr>
                                    <tr><td class="py-2">Opera</td><td class="py-2"><?php echo $Operaecnt; ?></td></tr>
                                    <tr><td class="py-2">Iceweasel - <span class="text-danger">(May Be Browser From Kali Linux)</span> </td><td class="py-2"><?php echo $icecnt; ?></td></tr>
                                    <tr><td class="py-2">Un-identified</td><td class="py-2"><?php echo $uncnt; ?></td></tr>
                                </table>
                            </div>
                        </div>    
                        <div class="col-md-6 col-sm-6 col-xs-12 stat1">
                            <h6 class="mb-3 cc-font-weight-5">OS Specific Hits</h6>
                            <div class="table-responsive">
                            <table class="work table table-bordered">
                                <tr><td class="py-2">Windows 7</td><td class="py-2" style="width:50px;"><?php echo $Windows7cnt; ?></td></tr>
                                <tr><td class="py-2">Windows 10</td><td class="py-2"><?php echo $Windows10cnt; ?></td></tr>
                                <tr><td class="py-2">Android</td><td class="py-2"><?php echo $androidcnt; ?></td></tr>
                                <tr><td class="py-2">Blackberry</td><td class="py-2"><?php echo $blackberrycnt; ?></td></tr>
                                <tr><td class="py-2">IOS</td><td class="py-2"><?php echo $ioscnt; ?></td></tr>
                                <tr><td class="py-2">WIndows (Mobile)</td><td class="py-2"><?php echo $windowsmobcnt; ?></td></tr>
                                <tr><td class="py-2">Linux</td><td class="py-2"><?php echo $linuxcnt; ?></td></tr>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Today's Visitor History</h2></div></div>
                <div class="card-body">
                    <div class="msgs"></div>
                    <div class = "table-responsive">
                        <table class="table table-bordered example">
                            <thead><tr><th>#</th><th>IP Address</th><th>Device</th><th>Browser</th><th>Details</th><th>Time</th></tr></thead>
                            <tbody>
                                <?php for($i=0;$i<count($getuser);$i++){ ?>
                                <tr><td class="td2"><?php echo $i+1; ?></td><td style="width: 100px;"><?php echo $getuser[$i]['ip']; ?></td><td><?php echo $getuser[$i]['device']; ?></td><td><?php echo $getuser[$i]['browser']; ?></td><td><?php echo $getuser[$i]['details']; ?></td><td><?php echo $getuser[$i]['time']; ?></td></tr>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php');?>
    </div>
</div>
<script src="<?php echo SITEURL; ?>/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/datepicker/moment.js"></script>
<script src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>
<script>
$("#datepicker").datetimepicker({ format: 'DD/MM/YYYY' })
$("#datepicker1").datetimepicker({ format: 'DD/MM/YYYY' })
$(document).ready(function(){ $('.example').DataTable(); });
function generatereport(){
    var date1 = $("#datepicker").val(); var date2 = $("#datepicker1").val(); var d1 = date1.split("/"); var d2 = d1[2] + "" + d1[1] + "" + d1[0]; var d3 = date2.split("/"); var d4 = d3[2] + "" + d3[1] + "" + d3[0];
    var diff = d4 - d2;
    if (date1 == "" || date2 == ""){
        $(".msgsbox").html("Please enter From and To dates").addClass("alert alert-danger").delay(5000).fadeOut();
    } else if (diff < 0){
        $(".msgsbox").html("From date may not be greater than To date").addClass("alert alert-danger").delay(5000).fadeOut();
    } else{ $("#report").submit() }
}
function formatDate(date){
    var d = new Date(date), month = '' + (d.getMonth() + 1), day = '' + d.getDate(), year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('');
}
</script>
</body>
</html>