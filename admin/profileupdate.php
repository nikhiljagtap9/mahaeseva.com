<?php include("../includes/configuration.php");
$userid = $_REQUEST['userid']; $username = $_REQUEST['username']; $mobile = $_REQUEST['mobile']; $pwd = $_REQUEST['pwd']; $pwd1 = $_REQUEST['pwd1']; $action = $_REQUEST['action']; $getuser = selectQuery(USER,"*","u_id=".base64_decode($userid));
if($action=="sendotp"){
    if(count($getuser)==1){
        $length = 6; $chars = '0123456789'; $chars_length = (strlen($chars) - 1);
        $string = $chars{rand(0, $chars_length)};
        for($i = 1; $i < $length; $i = strlen($string)){
            $r = $chars{rand(0, $chars_length)};
            if($r != $string{$i - 1}) $string .=  $r;
        }
        $otp = $string;
        $_SESSION['profileotp'] = $otp;
        $_SESSION['profileotptime'] = date('YmdHis');
        $type="PHP";
        $m = "Your One Time Password (OTP) for Maha-E-Seva.com is ". $otp ." (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
        $m1 = "Your One Time Password (OTP) for Maha-E-Seva.com is ****** (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
        $sms = sendsms($mobile,$m,WORKINGKEY,SMS_SENDER,"1207167593735371400");
        $id=(unserialize($sms));
        $msid = $id['data']['0']['id'];
        $status = $id['data']['0']['status'];
        $datasms = array("msg_id"=>$msid, "msg_type"=>"OTP", "user_name"=> "Admin", "mobile_no"=>$mobile, "message"=>$m1,
        "date"=>date("Y-m-d H:i:s"), "status"=>$status);
        $store=insertQuery(SMS,$datasms);
        echo 1;
    }else{ echo 0; }
}
if($action=="cancel"){ $_SESSION['profileotp']=""; $_SESSION['profileotptime'] = ""; echo 1;}
if($action=="resendotp"){
    $mobile = $_REQUEST['mob']; $length = 6; $chars = '0123456789'; $chars_length = (strlen($chars) - 1); $string = $chars{rand(0, $chars_length)};
    for($i = 1; $i < $length; $i = strlen($string)){
        $r = $chars{rand(0, $chars_length)};
        if($r != $string{$i - 1}) $string .=  $r;
    }
    $otp = $string;
    $_SESSION['profileotp']=$otp;
    $_SESSION['profileotptime'] = date('YmdHis');
    $type="PHP";
    $m = "Your One Time Password (OTP) for Maha-E-Seva.com is ". $otp ." (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
    $m1 = "Your One Time Password (OTP) for Maha-E-Seva.com is ****** (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
    $sms= sendsms($mobile,$m,WORKINGKEY,SMS_SENDER,"1207167593735371400");
    $id=(unserialize($sms));
    $msid=$id['data']['0']['id'];
    $status=$id['data']['0']['status'];
    $datasms=array("msg_id"=>$msid, "msg_type"=>"OTP", "user_name"=> "Admin", "mobile_no"=>$mobile, "message"=>$m1,
    "date"=>date("Y-m-d H:i:s"), "status"=>$status);
    $store=insertQuery(SMS,$datasms);
    echo 1;
}
if($action=="verifyotp"){
    $otp = $_REQUEST['otp'];
    if(count($getuser)==1){
        $sessotp=$_SESSION['profileotp']; $sessotptime = $_SESSION['profileotptime']; $currtime = date('YmdHis');
        $diff=$currtime-$sessotptime;
        if($diff>1500){ echo 1; }
        else{
            if($sessotp!=$otp){ echo 0; }
            else{
                $data=array();
                if($getuser[0]['username']!=$username){ $data['username']=$username; $unamechng=1; }
                if($getuser[0]['u_mob']!=$mobile){ $data['u_mob']=$mobile; }
                if(($pwd!=""&&$pwd1!="")&&($pwd===$pwd1)){
                    if($getuser[0]['password']!=md5($pwd)){ $data['password']=md5($pwd); $pwdchng=1; }
                }
                if(sizeOf($data)>0){ $updateuser=updateQuery(USER,$data,"u_id=".base64_decode($userid)); }
                $_SESSION['profileotp']="";
                $_SESSION['profileotptime']="";
                if($pwdchng==1||$unamechng==1){ echo "logout.php"; }
                else{ echo "editprofile.php"; }
            }
        }
    } else{ echo 2; }
} ?>