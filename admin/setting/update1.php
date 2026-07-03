<?php include("../../includes/configuration.php"); $subid = $_REQUEST['getid']; $menuid = $_REQUEST['menuid']; $mob = $_REQUEST['mobile']; $pass = $_REQUEST['pass'];
$data = array('u_mob'=>$mob,'password' => md5($pass), 'allocatemenu' => $menuid,);
$update = updateQuery(USER,$data,"u_id=".$subid);
if($update) echo 1;
else echo 2; ?>