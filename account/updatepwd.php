<?php include("../includes/configuration.php");
$uid = $_REQUEST['uid'] ; $oldpwd = $_REQUEST['oldpwd'] ; $password = $_REQUEST['password']; $encrypt = md5($password); $password1 = $_REQUEST['password1']; $encode = md5($oldpwd); $userdata = selectQuery(WEB_USER,"*","u_id=".$uid); $dbpass = $userdata[0]['password'];
if($encode == $dbpass){
    $data = array( 'password'=> $encrypt, );
    $update = updateQuery(WEB_USER,$data,"u_id=".$uid);
    if($update)
    echo "2";
    else
    echo "3";
} else{ echo "0"; } ?>