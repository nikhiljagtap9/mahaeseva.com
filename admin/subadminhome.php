<?php include("../includes/configuration.php");

/* $_SESSION['orderid']=""; $s=base64_decode($_REQUEST['s']);
if($s!=""&&$_SESSION['user']==""){ $_SESSION['user']=$s; }*/
/*$getprodsell1 = selectQuery(ORDER,"*","(payment_status='paid'||payment_status='cod')");*/
?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> Admin</title>
    <?php include 'commoncss.php';?>
</head>
<body>
<div class="page-body-wrapper">
    <?php include('header.php') ?>
    <?php include('cssmenu.php') ?>
    <div class="main-panel">
        <div class="dashbody"></div>
        <?php include('./footer.php');?>
    </div>
</div>
</body>
</html>
