<?php include("../includes/configuration.php"); ?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | Plan Details</title>
    <? include "commoncss.php"; ?>
    <link rel="stylesheet" href="../css/bootstrap-table.css" />
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../css/buttons.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-toggle.min.css" />
    <link rel="stylesheet" href="../../css/pikaday.css">
</head>
<body>
<div class="page-body-wrapper">
    <? include 'header.php'; ?>
    <? include 'cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Domain Registration Details</h2></div><div class="btn-actions-pane-right"><a href="allinvoices.php" class="btn btn-primary btn-sm">Invoice History</a></div></div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Domain name</div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($plandatafromapi['domain_name']!=""){ echo $plandatafromapi['domain_name']; }
                            else{ echo ['NOT FOUND']; } ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Domain Registrar</div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($plandatafromapi['domain_registrar']!=""){ echo $plandatafromapi['domain_registrar']; } else{ echo ['NOT FOUND']; } ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Domain Registration Date</div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($plandatafromapi['domain_registrar_date']!=""){ echo date("d M Y",strtotime($plandatafromapi['domain_registrar_date'])); } else{ echo ['NOT FOUND']; } ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Domain Expiry Date</div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($plandatafromapi['domain_registrar_end_date']!=""){ echo date("d M Y",strtotime($plandatafromapi['domain_registrar_end_date'])); } else{ echo ['NOT FOUND']; } ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Hosting Details</h2></div></div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Hosting Plan</div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($plandatafromapi['hosting_plan']!=""){ echo $plandatafromapi['hosting_plan']; }
                            else{ echo ['NOT FOUND']; } ?></div>
                        </div>
                    <div class="form-group mb-2 row col-sm-6 col-md-6">
                        <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Hosting Provider</div>
                        <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($plandatafromapi['hosting_server']!=""){ echo $plandatafromapi['hosting_server']; }else{ echo ['NOT FOUND']; } ?></div>
                    </div>
                    <div class="form-group mb-2 row col-sm-6 col-md-6">
                        <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Hosting start Date</div>
                        <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($plandatafromapi['hosting_start_date']!=""){ echo date("d M Y",strtotime($plandatafromapi['hosting_start_date'])); } else{ echo ['NOT FOUND']; } ?></div>
                    </div>
                    <div class="form-group mb-2 row col-sm-6 col-md-6">
                        <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Hosting End Date</div>
                        <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($plandatafromapi['hosting_end_date']!=""){ echo date("d M Y",strtotime($plandatafromapi['hosting_end_date'])); } else{ echo ['NOT FOUND']; } ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-0">
            <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">SMS Details</h2></div></div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group mb-2 row col-sm-6 col-md-6">
                        <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">SMS Sender</div>
                        <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php echo $smssender;?></div>
                    </div>
                    <div class="form-group mb-2 row col-sm-6 col-md-6">
                           <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">Total SMS Allocated</div>
                           <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($plandatafromapi['total_sms_alocate']!=""){ echo $plandatafromapi['total_sms_alocate']; } else{ echo ['NOT FOUND']; } ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">SMS Balance</div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php echo $credit; ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">SMS Plan Start Date</div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($plandatafromapi['sms_date']!=""){ echo date("d M Y",strtotime($plandatafromapi['sms_date'])); }
                            else{ echo ['NOT FOUND']; } ?></div>
                        </div>
                        <div class="form-group mb-2 row col-sm-6 col-md-6">
                            <div class="col-5 col-sm-12 col-md-12 col-lg-5 control-label cc-font-weight-5">SMS Plan End Date</div>
                            <div class="col-7 col-sm-12 col-md-12 col-lg-7"><?php if($plandatafromapi['sms_end_date']!=""){ echo date("d M Y",strtotime($plandatafromapi['sms_end_date'])); }
                            else{ echo ['NOT FOUND']; } ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php');?> 
    </div>
</div>
</body>
</html>