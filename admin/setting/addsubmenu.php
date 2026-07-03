<?php include("../../includes/configuration.php");
$uname = $_REQUEST['uname']; $pass = $_REQUEST['pass']; $md5pass = md5($pass); $menuid = $_REQUEST['menuid']; $uemail = $_REQUEST['uemail']; $umbl = $_REQUEST['umbl']; $result = selectQuery(USER,"*","username='".$uname."'");
if(count($result) > 0){ echo 0; }
else{
$data=array('utype'=>"subadmin",'u_name'=>"subadmin",'u_mob' => $umbl,'u_email'=> $uemail,'username' => $uname,'password' => $md5pass,'allocatemenu' => $menuid,);
$insert = insertQuery(USER,$data);
if($insert){ echo 1; } else{echo 2;}
} ?>