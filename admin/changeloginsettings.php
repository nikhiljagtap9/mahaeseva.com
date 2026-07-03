<?php include("../includes/configuration.php"); $action = $_REQUEST['action']; $mob = $_REQUEST['mob']; $admin = $_REQUEST['admin']; $seller = $_REQUEST['seller']; $user = $_REQUEST['user'];
if($action=="updatemob"){
    $data = array( 'u_mob'=>$mob ); $getuser = updateQuery(USER,$data,"utype='Admin'");
    if($getuser){ echo 1; } else{ echo 0; }
}
if($action=="updatesetting"){
    $getuser = selectQuery(USER,"*","utype='Admin' and isActive='1' and isDel='0'");
    if($admin==1&&$getuser[0]['u_mob']==""){ echo 2; }
    else{
        $data1 = array( "admin_authentication"=>$admin, "seller_authentication"=>$seller, "user_authentication"=>$user );
        $getsetting = updateQuery(LOGINSETTING,$data1);
        if($getsetting){ echo 1; } else{ echo 0; }
    }
} ?>