<?php include("../includes/configuration.php");
if(!empty($_SERVER["HTTP_CLIENT_IP"])){
    //check for ip from share internet
    $ip = $_SERVER["HTTP_CLIENT_IP"];
} elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
    // Check for the Proxy User
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}else{ $ip = $_SERVER["REMOTE_ADDR"]; }
$agent = $_SERVER['HTTP_USER_AGENT'];
$browser = 'NA';
if((preg_match('/MSIE/i',$agent)||preg_match('/Trident/i',$agent)||(preg_match('/Trident/i',$agent)&&stristr($_SERVER['HTTP_USER_AGENT'],'Windows Phone'))) && !preg_match('/Opera/i',$agent)){
    $browser = 'Internet Explorer';
    $ub = "MSIE";
} elseif(preg_match('/Windows NT 10/i',$agent) && preg_match('/Edge/i',$agent)){
    $browser = 'Microsoft Edge';
    $ub = "Edge";
} elseif(preg_match('/Firefox/i',$agent)){
    $browser = 'Mozilla Firefox';
    $ub = "Firefox";
} elseif(preg_match('/Chrome/i',$agent)){
    $browser = 'Google Chrome';
    $ub = "Chrome";
} elseif(preg_match('/Safari/i',$agent)){
    $browser = 'Apple Safari';
    $ub = "Safari";
} elseif(preg_match('/Opera/i',$agent)){
    $browser = 'Opera';
    $ub = "Opera";
} elseif(preg_match('/Netscape/i',$agent)){
    $browser = 'Netscape';
    $ub = "Netscape";
}
$device = '';
if(stristr($_SERVER['HTTP_USER_AGENT'],'ipad')){
    $device = "ipad";
} else if((stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone'))&&stristr($_SERVER['HTTP_USER_AGENT'],'Windows Phone')=== FALSE){
    $device = "iphone";
} else if( stristr($_SERVER['HTTP_USER_AGENT'],'Windows Phone')){
    $device = "Windows Phone";
} else if( stristr($_SERVER['HTTP_USER_AGENT'],'blackberry')){
    $device = "blackberry";
} else if( stristr($_SERVER['HTTP_USER_AGENT'],'android')){
    $device = "android";
} else if( stristr($_SERVER['HTTP_USER_AGENT'],'Windows NT 10.0')){
    $device = "Windows 10";
} else if( stristr($_SERVER['HTTP_USER_AGENT'],'Windows NT 6.1')){
    $device = "Windows 7";
}
$uname = $_POST['username'];
$pwd = md5($_POST['logkey']);
if($uname=="" || $pwd==""){ echo '<script>window.location="index.php?err='.base64_encode(1).'";</script>'; }
else{
    $getuser = selectQuery(USER,"*","username='".$uname."' and password='".$pwd."' and isActive='1'");
    if(count($getuser)==1){
        $_SESSION['user'] = $getuser[0]['u_id'];
        $_SESSION['adminsess'] = $getuser[0]['u_id'];
        $_SESSION['adminuname'] = $uname;
        $_SESSION['last_login_timestamp'] = time();
        $s=base64_encode($_SESSION['user']);
        $getuser1 = selectQuery(SUPPORTSTAFF,"*","username='".$uname."' and emp_pwd='".$pwd."' and isActive='1'");
    if(count($getuser1)==1){
        $data=array( "last_login"=>date("d-m-Y H:i:s") );
        $updateuser = updateQuery(SUPPORTSTAFF,$data,"emp_id=".$getuser1[0]['emp_id']);
        $_SESSION['staff'] = $getuser1[0]['emp_id'];
        $_SESSION['dept'] = $getuser1[0]['department'];
        $_SESSION['staffname'] = $getuser1[0]['emp_name'];
        $_SESSION['acc_type'] = $getuser1[0]['acc_type'];
        $_SESSION['uname'] = $getuser1[0]['username'];
    }
    $datalog=array('username'=>$uname, 'password'=>$pwd, 'ip_address'=>$ip, 'browser_name'=>$browser, 'device_type'=>$device, 'details'=>$agent, 'login_time'=>date('d/m/Y H:i:s'), 'login_Attempt'=>'success');
    $sinsert = insertQuery(ADMINLOG,$datalog);
    if($getuser[0]['utype'] == 'Admin'){ echo '<script>window.location="'.ADMINURL.'home.php?admin='.$s.'";</script>';
    } else{ echo '<script>window.location="subadminhome.php?admin='.$s.'";</script>'; }
    } else{
        $datalog=array('username'=>$uname, 'password'=>$_POST['logkey'], 'ip_address'=>$ip, 'browser_name'=>$browser,
        'device_type'=>$device, 'details'=>$agent, 'login_time'=>date('d/m/Y H:i:s'), 'login_Attempt'=>'failed');
        $s = insertQuery(ADMINLOG,$datalog);
        echo '<script>window.location="index.php?err='.base64_encode(2).'";</script>';
    }
} ?>