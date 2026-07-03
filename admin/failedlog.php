<?php include("../includes/configuration.php");
$s = selectQuery(USERLOG,"*","login_attempt='failed' order by log_id DESC LIMIT 30");
$s1 = selectQuery(USERLOG,"*","login_attempt='failed' order by log_id DESC"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | Failed Login</title>
    <? include "commoncss.php"; ?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
    <? include 'header.php'; ?>
    <? include 'cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">User Failed Attempts</h2></div></div>
                <div class="card-body">
                    <div class="mb-3"> Total Failed Attempts : <?php echo count($s1)." times"; ?> </div>
                     <div class="table-responsive">  
                        <table class="example table table-bordered">
                            <thead><tr><th>#</th><th>Username</th><th>Attempted Password</th><th>Time</th><th>Device Type</th><th>Browser</th><th>IP Address</th></tr></thead>
                            <tbody> 
                                <? for($i=0;$i<count($s);$i++){ ?>
                                <tr>
                                    <td><?php echo $i+1; ?></td>
                                    <td><?php echo $s[$i]['username']; ?></td>
                                    <td><?php echo $s[$i]['password']; ?></td>
                                    <td><?php echo $s[$i]['login_time'];
                                    $date2 = str_replace("/","-",$s[$i]['login_time']);
                                    $from_time = strtotime($date2);
                                    $to_time1 =date("d-m-Y H:i:s");
                                    $to_time = strtotime($to_time1);
                                    echo " (".round(abs($to_time - $from_time) / 60,0). " minutes ago)"; ?></td>
                                    <td><?php echo $s[$i]['device_type']; ?></td>
                                    <td><?php echo $s[$i]['browser_name']; ?></td>
                                    <td><?php echo $s[$i]['ip_address']; ?></td>
                                </tr>
                                <? } ?>                  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'?>
    </div>
</div>
<script src="<?php echo SITEURL; ?>/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script>$(document).ready(function(){ $('.example').DataTable(); });</script>
</body>
</html>
