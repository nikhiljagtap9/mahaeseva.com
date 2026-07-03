<?php include("../includes/configuration.php");
/*$_SESSION['orderid']="";
$s=base64_decode($_REQUEST['s']);
if($s!=""&&$_SESSION['user']==""){ $_SESSION['user']=$s; }*/
$s = selectQuery(USERLOG,"*","user_id=".base64_decode($_REQUEST['a'])." order by log_id DESC LIMIT 30");
$s1 = selectQuery(USERLOG,"*","user_id=".base64_decode($_REQUEST['a'])." order by log_id DESC");
$getuser = selectQuery(WEB_USER,"*","u_id=".base64_decode($_REQUEST['a'])); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | User Login Details</title>
    <?php include('commoncss.php') ?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
    <?php include('header.php') ?>
    <?php include('cssmenu.php') ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">User Login Details <?php echo $getuser[0]['u_fname']." ".$getuser[0]['u_lname']; ?></h2></div></div>
                <div class="card-body">
                    <div class="mb-3 cc-font-weight-5">Total Login Attempts : <?php echo count($s1)." times"; ?></div>
                    <div class="table-responsive">
                        <table class="example table table-bordered">
                            <thead><tr><th>#</th><th>Login Time</th><th>Login Source</th><th>Device Type</th><th>Browser</th><th> IP Address</th></tr></thead>
                            <tbody>
                                <? for($i=0;$i<count($s);$i++){ ?>
                                <tr>
                                    <td><?php echo $i+1; ?></td>
                                    <td><?php echo date("d M Y h:i a",strtotime($s[$i]['login_time']));
                                    $date2 = str_replace("/","-",$s[$i]['login_time']); $from_time = strtotime($date2);
                                    $to_time1 = date("d-m-Y H:i:s"); $to_time = strtotime($to_time1); $all = round(($to_time - $from_time) / 60); $d = floor ($all / 1440); $h = floor (($all - $d * 1440) / 60); $m = $all - ($d * 1440) - ($h * 60);
                                    if($d>0){ echo " (".$d." day ".$h.":".$m." min ago)"; }
                                    else{ echo " (".$h.":".$m." min ago)"; } ?></td>
                                    <td><?php if($s[$i]['login_source']){ echo ucfirst($s[$i]['login_source']); }
                                    else{ echo "Website"; } ?></td>
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