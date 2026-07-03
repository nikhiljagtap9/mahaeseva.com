<?php include("../includes/configuration.php"); $id = base64_decode($_GET['id']); $getid = selectQuery(USER,"*","u_id=".$id); $getname = $getid[0]['username']; $s = selectQuery(ADMINLOG,"*","username='".$getname."'"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | Subadmin Login Details</title>  
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
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Subadmin Login Details</h2></div></div>
                <div class="card-body">
                    <div class="table-resonsive">
                        <table class="example table table-bordered">
                            <thead><th>#</th><th>Username</th><th>Login Time</th><th>Device Type</th><th>Browser</th><th>IP Address</th></thead>
                            <tbody>
                            <? for($i=0;$i<count($s);$i++){ ?>
                            <tr><td><?php echo $i+1; ?></td><td><?php echo $s[$i]['username'] ?></td>
                            <td><?php echo $s[$i]['login_time']; $date2 = str_replace("/","-",$s[$i]['login_time']);
                                $from_time = strtotime($date2); $to_time1 =date("d-m-Y H:i:s"); $to_time = strtotime($to_time1); $all = round(($to_time - $from_time) / 60); $d = floor ($all / 1440);
                                $h = floor (($all - $d * 1440) / 60); $m = $all - ($d * 1440) - ($h * 60);
                                if($d>0){ echo " (".$d." day ".$h.":".$m." min ago)"; }
                                else{ echo " (".$h.":".$m." min ago)"; } ?>
                            </td>
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