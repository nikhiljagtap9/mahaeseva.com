<?php include("../../includes/configuration.php");
$deptid = base64_decode($_REQUEST['dept']);
if($deptid==1){ $page=1; } else if($deptid==2){ $page=2; } else if($deptid==3){ $page=3; } else{ $page=4; }
$getopen = selectQuery(CONTACT,"*","dept=".$deptid." and isOpen='1' and isClosed='0'");
$getans = selectQuery(CONTACT,"*","dept=".$deptid." and isAnswered='1'");
$getclosed = selectQuery(CONTACT,"*","dept=".$deptid." and isClosed='1'");
$getoverdue=selectQuery(CONTACT,"*","dept=".$deptid." and isOverdue='1'");
/* echo  $getoverdue; */
$getdeptname = selectQuery(SUPPORTDEPT,"*","dept_id=".$deptid); ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITE_TITLE; ?> : Support Requests - <?php echo $getdeptname[0]['dept_name']; ?></title>
    <?php include('../commoncss.php'); ?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php'); ?>
    <?php include('../cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Support Requests - <?php echo $getdeptname[0]['dept_name']; ?></h2></div></div>
                <div class="card-body">
                    <div class="msgs"></div>
                    <div id="tabs">
                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#open">Open (<?php echo count($getopen); ?>)</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#answered">Answered (<?php echo count($getans); ?>)</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#overdue">Overdue (<?php echo count($getoverdue); ?>)</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#closed">Closed (<?php echo count($getclosed); ?>)</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="open" class="tab-pane active">
                                <h6 class="mb-3">Open Tickets (<?php echo count($getopen); ?>)</h6>
                                <table class="example table table-bordered">
                                    <thead><tr><th>#</th><th>Ticket ID</th><th>Date</th><th>Department</th><th>Client</th><th>Status</th></tr></thead>
                                    <tbody>
                                        <?php for($i=0;$i<count($getopen);$i++){ ?>
                                        <tr>
                                        <td><?php echo $i+1; ?></td>
                                        <td><a href="requestdetails.php?req=<?php echo base64_encode($getopen[$i]['contact_request_id']); ?>"><?php echo $getopen[$i]['contact_request_id']; ?></a></td>
                                        <td><?php echo $getopen[$i]['date']; ?></td>
                                        <td><?php echo $getdeptname[0]['dept_name']; ?></td>
                                        <td><?php echo $getopen[$i]['Name']; ?></td>
                                        <td><?php echo $getopen[$i]['status']; ?></td>
                                        </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="answered" class="tab-pane">
                                <h6 class="mb-3">Answered Tickets (<?php echo count($getans); ?>)</h6>
                                <table class="example table table-bordered">
                                    <thead><tr><th>#</th><th>Ticket ID</th><th>Date</th><th>Department</th><th>Client</th><th>Status</th></tr></thead>
                                    <tbody>
                                        <?php for($i=0;$i<count($getans);$i++){ ?>
                                        <tr>
                                            <td><?php echo $i+1; ?></td>
                                            <td><a href="requestdetails.php?req=<?php echo base64_encode($getans[$i]['contact_request_id']); ?>"><?php echo $getans[$i]['contact_request_id']; ?></a></td>
                                            <td><?php echo $getans[$i]['date']; ?></td>
                                            <td><?php echo $getdeptname[0]['dept_name']; ?></td>
                                            <td><?php echo $getans[$i]['Name']; ?></td>
                                            <td><?php echo $getans[$i]['status']; ?></td>
                                        </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="overdue" class="tab-pane">
                                <h6 class="mb-3"> Overdue Tickets (<?php echo count($getoverdue); ?>)</h6>
                                <table class="example table table-bordered">
                                    <thead><tr><th>#</th><th>Ticket ID</th><th>Date</th><th>Department</th><th>Client</th><th>Status</th></tr></thead>
                                    <tbody>
                                    <?php for($i=0;$i<count($getoverdue);$i++){ ?>
                                    <tr>
                                        <td><?php echo $i+1; ?></td>
                                        <td><a href="requestdetails.php?req=<?php echo base64_encode($getoverdue[$i]['contact_request_id']); ?>"><?php echo $getoverdue[$i]['contact_request_id']; ?></a></td>
                                        <td><?php echo $getoverdue[$i]['date']; ?></td>
                                        <td><?php echo $getdeptname[0]['dept_name']; ?></td>
                                        <td><?php echo $getoverdue[$i]['Name']; ?></td>
                                        <td><?php echo $getoverdue[$i]['status']; ?></td>
                                    </tr>
                                    <? } ?>
                                    </tbody>
                               </table>
                            </div>
                            <div id="closed" class="tab-pane">
                                <h6 class="mb-3">Closed Tickets (<?php echo count($getclosed); ?>)</h6>
                                <table class="example table table-bordered">
                                    <thead><tr><th>#</th><th>Ticket ID</th><th>Date</th><th>Department</th><th>Client</th><th>Status</th></tr></thead>
                                    <tbody>
                                        <?php for($i=0;$i<count($getclosed);$i++){ ?>
                                        <tr>
                                            <td><?php echo $i+1; ?></td>
                                            <td><a href="requestdetails.php?req=<?php echo base64_encode($getclosed[$i]['contact_request_id']); ?>"><?php echo $getclosed[$i]['contact_request_id']; ?></a></td>
                                            <td><?php echo $getclosed[$i]['date']; ?></td>
                                            <td><?php echo $getdeptname[0]['dept_name']; ?></td>
                                            <td><?php echo $getclosed[$i]['Name']; ?></td>
                                            <td><?php echo $getclosed[$i]['status']; ?></td>
                                        </tr>
                                        <? }?>
                                    </tbody>
                                </table>
                             </div>
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
<script>$(document).ready(function(){ $('.example').DataTable(); })</script>
</body>
</html>