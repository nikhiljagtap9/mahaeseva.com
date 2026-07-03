<?php
    include("../includes/configuration.php");
     $menusupportsetting=selectQuery(SUPPORTEMAIL,"*");
   $attachmentmax=$menusupportsetting[0]['attachment_size'];
   $allowedimgtypes=$menusupportsetting[0]['img_types'];
   $allowedapptypes=$menusupportsetting[0]['application_types'];
?>
<!doctype html>
<html>
<head>
    <title><?php echo SITE_TITLE; ?> </title>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="t">
<meta name="description" content ="">
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/supportpanel.css">
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/font-awesome-4.5.0/css/font-awesome.css" />
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/bootstrap-toggle.min.css" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo SITEURL; ?>/img/projectimage/favicon1.png">
<link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<script src="<?php echo SITEURL; ?>/js/jquery-1.12.0.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/bootstrap.min.js"></script>

  </head>
<body class="mainbody">

<div class="header">
    <div class="container">
        <div class="row">
           <div class="col-md-4 col-sm-3">
                <a href="<?php echo SITEURL; ?>/home" itemscope>
                    <img src="<?php echo SITEURL; ?>/img/projectimage/logo.png" alt="logo" title="<?php echo SITE_TITLE; ?>"   itemprop="logo" width="170"  class="logomobile" />
                </a>
            </div>
            <div class="col-md-8 col-sm-9">
            <div class="navbar-header pull-left">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <i class="fa fa-bars"></i>
              </button>
            </div>
            <a href="logout.php" class="pull-right logoutbtn"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
            </div>
        </div>
    </div>
</div>