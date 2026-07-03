<?php include("../includes/configuration.php"); $uname = $_REQUEST['user']; $pwd = md5($_REQUEST['pwd']);
$action = $_REQUEST['action'];
if($action=="uservalidate"){
    $getuser = selectQuery(USER,"*","username='".$uname."' and password='".$pwd."' and isActive='1'");
    if(count($getuser)==1){
        $mobile = $getuser[0]['u_mob']; $length = 6; $chars = '0123456789';
        $chars_length = (strlen($chars) - 1);
        $string = $chars{rand(0, $chars_length)};
        for ($i = 1; $i < $length; $i = strlen($string)){
        $r = $chars{rand(0, $chars_length)};
        if ($r != $string{$i - 1}) $string .=  $r;
        }
        $otp = $string;
        $_SESSION['adminotp']=$otp;
        $_SESSION['adminotptime'] = date('YmdHis');
        $type="PHP";
        $m = "Your One Time Password (OTP) for Maha-E-Seva.com is ". $otp ." (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
        $m1 = "Your One Time Password (OTP) for Maha-E-Seva.com is ****** (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
        $sms = sendsms($mobile,$m,WORKINGKEY,SMS_SENDER,"1207167593735371400");
        $id = (unserialize($sms));
        $msid = $id['data']['0']['id'];
        $status = $id['data']['0']['status'];
        $datasms=array( "msg_id"=>$msid, "msg_type"=>"OTP", "user_name"=> "Admin", "mobile_no"=>$mobile, "message"=>$m1, "date"=>date("Y-m-d H:i:s"), "status"=>$status);
        $store = insertQuery(SMS,$datasms); echo 1;
    } else{ echo 0; }
}
if($action=="uservalidatewithoutotp"){
    $getuser = selectQuery(USER,"*","username='".$uname."' and password='".$pwd."' and isActive='1'");
    if(count($getuser)==1){ $_SESSION['adminotp']=$otp; $_SESSION['adminotptime'] = date('YmdHis');
    echo 1;
    } else{ echo 0; }
}
if($action=="logincancel"){
    $_SESSION['adminotp']=""; $_SESSION['adminotptime'] = ""; echo 1;
}
if($action=="resendotp"){
    $mobile = $_REQUEST['mob']; $length = 6; $chars = '0123456789'; $chars_length = (strlen($chars) - 1); $string = $chars{rand(0, $chars_length)};
    for($i = 1; $i < $length; $i = strlen($string)){ $r = $chars{rand(0, $chars_length)};
    if ($r != $string{$i - 1}) $string .=  $r; }
    $otp = $string;
    $_SESSION['adminotp']=$otp;
    $_SESSION['adminotptime'] = date('YmdHis');
    $type="PHP";
    $m = "Your One Time Password (OTP) for Maha-E-Seva.com is ". $otp ." (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
    $m1 = "Your One Time Password (OTP) for Maha-E-Seva.com is ****** (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
    $sms= sendsms($mobile,$m,WORKINGKEY,SMS_SENDER,"1207167593735371400");
    $id=(unserialize($sms));
    $msid=$id['data']['0']['id'];
    $status=$id['data']['0']['status'];
    $datasms=array( "msg_id"=>$msid, "msg_type"=>"OTP", "user_name"=> "Admin", "mobile_no"=>$mobile, "message"=>$m1, "date"=>date("Y-m-d H:i:s"), "status"=>$status);
    $store = insertQuery(SMS,$datasms);
    echo 1;
}
if($action=="verifyotp"){
    $otp = $_REQUEST['otp']; $pwd1 = $_REQUEST['pwd1']; $getuser = selectQuery(USER,"*","username='".$uname."' and password='".$pwd1."' and isActive='1'");
    if(count($getuser)==1){
        $sessotp = $_SESSION['adminotp']; $sessotptime = $_SESSION['adminotptime'];
        $currtime = date('YmdHis'); $diff = $currtime-$sessotptime;
        if($diff>1500){ echo 1; }
        else{
            if($sessotp!=$otp){ echo 0; }
            else{
                if(!empty($_SERVER["HTTP_CLIENT_IP"])){
                    //check for ip from share internet
                    $ip = $_SERVER["HTTP_CLIENT_IP"];
                } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
                     // Check for the Proxy User
                     $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                } else{ $ip = $_SERVER["REMOTE_ADDR"]; }
                $agent = $_SERVER['HTTP_USER_AGENT'];
                $browser = 'NA';
                if((preg_match('/MSIE/i',$agent)||preg_match('/Trident/i',$agent)||(preg_match('/Trident/i',$agent)&&stristr($_SERVER['HTTP_USER_AGENT'],'Windows Phone'))) && !preg_match('/Opera/i',$agent)){
                    $browser = 'Internet Explorer'; $ub = "MSIE";
                } elseif(preg_match('/Windows NT 10/i',$agent) && preg_match('/Edge/i',$agent)){
                    $browser = 'Microsoft Edge'; $ub = "Edge";
                } elseif(preg_match('/Firefox/i',$agent)){
                    $browser = 'Mozilla Firefox'; $ub = "Firefox";
                } elseif(preg_match('/Chrome/i',$agent)){
                    $browser = 'Google Chrome'; $ub = "Chrome";
                } elseif(preg_match('/Safari/i',$agent)){
                    $browser = 'Apple Safari'; $ub = "Safari";
                } elseif(preg_match('/Opera/i',$agent)){
                    $browser = 'Opera'; $ub = "Opera";
                } elseif(preg_match('/Netscape/i',$agent)){
                    $browser = 'Netscape'; $ub = "Netscape";
                }
                $device = '';
                if( stristr($_SERVER['HTTP_USER_AGENT'],'ipad')){
                $device = "ipad";
                } else if((stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone'))&&stristr($_SERVER['HTTP_USER_AGENT'],'Windows Phone')=== FALSE) { $device = "iphone"; }
                else if( stristr($_SERVER['HTTP_USER_AGENT'],'Windows Phone')){ $device = "Windows Phone"; }
                else if( stristr($_SERVER['HTTP_USER_AGENT'],'blackberry')){ $device = "blackberry"; } else if( stristr($_SERVER['HTTP_USER_AGENT'],'android')){ $device = "android"; }
                else if( stristr($_SERVER['HTTP_USER_AGENT'],'Windows NT 10.0')){ $device = "Windows 10"; }
                else if( stristr($_SERVER['HTTP_USER_AGENT'],'Windows NT 6.1')){ $device = "Windows 7"; }
                $_SESSION['adminotp']=""; $_SESSION['adminotptime']=""; $_SESSION['user']=$getuser[0]['u_id'];
                $_SESSION['adminuname']=$uname; $_SESSION['last_login_timestamp'] = time();
                $s = base64_encode($_SESSION['user']);
                $getuser1 = selectQuery(SUPPORTSTAFF,"*","username='".$uname."' and emp_pwd='".$pwd1."' and isActive='1'");
                if(count($getuser1)==1){
                    $data = array( "last_login"=>date("d-m-Y H:i:s"));
                    $updateuser = updateQuery(SUPPORTSTAFF,$data,"emp_id=".$getuser1[0]['emp_id']);
                    $_SESSION['staff']=$getuser1[0]['emp_id'];
                    $_SESSION['dept']=$getuser1[0]['department'];
                    $_SESSION['staffname']=$getuser1[0]['emp_name'];
                    $_SESSION['acc_type']=$getuser1[0]['acc_type'];
                    $_SESSION['uname']=$getuser1[0]['username'];
                }
                $datalog=array( 'username'=>$uname, 'password'=>$pwd1, 'ip_address'=>$ip, 'browser_name'=>$browser, 'device_type'=>$device, 'details'=>$agent, 'login_time'=>date('d/m/Y H:i:s'), 'login_Attempt'=>'success');
                $sinsert = insertQuery(ADMINLOG,$datalog);
                if($getuser[0]['utype'] == 'Admin'){ echo "home.php?s=".$s; }
                else{ echo "subadminhome.php?s=".$s; }
            }
        }
    } else{ echo 2; }
}
if($action=="authenticateuser"){
    $username = base64_decode($_REQUEST['userid1']); $password = md5($_REQUEST['pwduser']); $getuser = selectQuery(USER,"*","u_id='".$username."' and password='".$password."' and isActive='1'");
    if(count($getuser)==1){ echo 1; }
    else{ echo 0; }
} ?>