<?php 
 function sendsms($to,$message,$data1,$data2,$templateid=null){
    $m = $message; $message = @urlencode($m); $mob = $to; $key = $data1; $sender = $data2; $format = "PHP";
    $template = ($templateid!=""?"&template_id=".$templateid:"");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api-alerts.solutionsinfini.com/v3/?method=sms&api_key=$key&to=$mob&sender=$sender&message=$message&format=$format".$template);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
     
 /*if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
    } else {
        echo 'Response: ' . $output;
    }*/ 
    curl_close($ch);
    return $output;
}

// whatsapp msg
function sendwhatsappsms($to,$message){
 
 $appkey = APPKEY;
 $authkey = AUTHKEY;

 $m = $message; $message = @urlencode($m);

$curl = curl_init();

$data = [
    "appkey" => "236274fd-8d6a-4b73-a280-0dc78677bb44",
    "authkey" => "3obDrw2bDgeeCIzDtQP1bn7hdpnjzGyNH93RNvrFJNjZZRvCoJ",
    "to" => '91'.$to,
    "message" => $m,
    "sandbox" => false
];

curl_setopt_array($curl, [
    CURLOPT_URL => "https://bhagwat.app/api/create-message",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($data), // Ensure correct JSON encoding
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",  // Ensure correct content type
        "Accept: application/json"
    ],
]);

$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if (curl_errno($curl)) {
   // echo "cURL Error: " . curl_error($curl);
$output = 0;
} else {
   // echo "HTTP Code: " . $httpCode . "\n";
   // echo "Response: " . $response;
$output = 1;
}

curl_close($curl);
return $output;



}

function mail_multiattachment($filename1,$filename2, $filename3,$filename4,$filename5,$filename6, $mailto, $from_mail, $from_name, $replyto, $subject, $message){
    $body = ''; $headers = '';
    $arr = array();
    if($filename1!=""){ array_push($arr,$filename1); }
    if($filename2!=""){ array_push($arr,$filename2); }
    if($filename3!=""){ array_push($arr,$filename3); }
    if($filename4!=""){ array_push($arr,$filename4); }
    if($filename5!=""){ array_push($arr,$filename5); }
    if($filename6!=""){ array_push($arr,$filename6); }
    $separator = md5(time());
    $headers = "From: ".$from_name."<".$from_mail.">" . PHP_EOL;
    $headers .= "Reply-To: ".$replyto . PHP_EOL;
    $headers .= "MIME-Version: 1.0".PHP_EOL;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . PHP_EOL . PHP_EOL;
    $body .= "Content-Transfer-Encoding: 7bit" . PHP_EOL;
    $body .= "This is a MIME encoded message." . PHP_EOL;
    $body .= "--" . $separator . PHP_EOL;
    $body .= "Content-Type: text/html; charset=\"iso-8859-1\"" . PHP_EOL;
    $body .= "Content-Transfer-Encoding: 8bit" . PHP_EOL . PHP_EOL;
    $body .= $message . PHP_EOL;
    $body .= "--" . $separator . PHP_EOL;
    for($i=0;$i<sizeOf($arr);$i++){
        $file = $arr[$i];
        $encoded_content = chunk_split(base64_encode(file_get_contents($file)));
        $body .= "--" . $separator . PHP_EOL;
        $body .="Content-Type: $file_type; name=\"$file\"\r\n";
        $body .="Content-Disposition: attachment; filename=\"$file\"\r\n";
        $body .="Content-Transfer-Encoding: base64\r\n";
        $body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n";
        $body .= $encoded_content;
    }
    if(mail($mailto, $subject, $body, $headers)){
    } else{ echo ""; }
}
function checkUser1($oauth_provider,$oauth_uid,$fname,$lname,$email,$gender,$locale,$picture){
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        //check for ip from share internet
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
        //Check for the Proxy User
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else{
        $ip = $_SERVER["REMOTE_ADDR"];
    }
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
    if( stristr($_SERVER['HTTP_USER_AGENT'],'ipad')){
        $device = "ipad";
    } else if((stristr($_SERVER['HTTP_USER_AGENT'],'iphone') ||         strstr($_SERVER['HTTP_USER_AGENT'],'iphone'))&&stristr($_SERVER['HTTP_USER_AGENT'],'Windows Phone')=== FALSE){
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
    $prev_query = selectQuery(SOC_USERS,"*","oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$oauth_uid."'");
    $data = array('oauth_provider'=>$oauth_provider, 'oauth_uid'=> $oauth_uid, 'fname'=>$fname, 'lname'=>$lname, 'email'=>$email, 'gender'=>$gender, 'locale'=>$locale, 'picture'=>$picture, 'modified'=>date("Y-m-d H:i:s"),);
    $update = insertQuery(SOC_USERS,$data);
    $getuser111 = selectQuery(WEB_USER,"*","u_email = '".$email."' and isDel='0'");
    if(count($getuser111)){
        $_SESSION['reguser'] = $getuser111[0]['u_id'];
        $_SESSION['uemail'] = $getuser111[0]['u_email'];
        $_SESSION['uname'] = $getuser111[0]['u_name'];
        $_SESSION['riderz_user'] = $getuser111[0]['u_id'];
        if($_SESSION['setuser']!="setted"){ $_SESSION['setuser']= 'notsetted'; }
        $data1 = array('source'=>$oauth_provider, 'last_login'=>date("d/m/Y H:i:s"));
        $insert1 = updateQuery(WEB_USER,$data1,"u_email = '".$email."' and isDel='0'");
        $checklastlogin = selectQuery(USERLOG,"*","user_id=".$getuser111[0]['u_id']." order by log_id desc limit 1");
        $lastlogin = $checklastlogin[0]['login_time'];
        $timearr = explode(" ",$lastlogin);
        $datearr1 = explode("/",$timearr[0]);
        $timearr1 = explode(":",$timearr[1]);
        $datestr = $datearr1[2].$datearr1[1].$datearr1[0].$timearr1[0].$timearr1[1].$timearr1[2];
        $datenow = date("YmdHis");
        $datediff = $datenow-$datestr;
        if($datediff>200){
            $datalog = array('user_id'=>$getuser111[0]['u_id'], 'login_source'=>$oauth_provider, 'username'=>$email, 'password'=>"", 'ip_address'=>$ip, 'browser_name'=>$browser, 'device_type'=>$device, 'details'=>$agent, 'login_time'=>date('d/m/Y H:i:s'), 'login_attempt'=>'success');
            $s = insertQuery(USERLOG,$datalog);
        }
    } else{
        $data1 = array('u_name'=>$fname, 'u_lname'=>$lname, 'u_gender'=>$gender, 'u_email'=>$email, 'email_verified'=>'1', 'isActive'=>'1', 'source'=>$oauth_provider, 'reg_date'=>date('d/m/Y'));
        $insert1 = insertQuery(WEB_USER,$data1);
        if($insert1){
            $getuser12 = selectQuery(WEB_USER,"*","u_email = '".$email."' and isDel='0'");
            $_SESSION['reguser'] = $getuser12[0]['u_id'];
            $_SESSION['uemail'] = $getuser12[0]['u_email'];
            $_SESSION['uname'] = $getuser12[0]['u_name'];
            $_SESSION['riderz_user'] = $getuser12[0]['u_id'];
            if($_SESSION['setuser']!="setted"){ $_SESSION['setuser']= 'notsetted'; }
            $data5 = array('source'=>$oauth_provider, 'last_login'=>date("d/m/Y H:i:s"));
            $insert1 = updateQuery(WEB_USER,$data5,"u_email = '".$email."' and isDel='0'");
            $checklastlogin = selectQuery(USERLOG,"*","user_id=".$getuser12[0]['u_id']." order by log_id desc limit 1");
            $lastlogin = $checklastlogin[0]['login_time'];
            $timearr = explode(" ",$lastlogin);
            $datearr1 = explode("/",$timearr[0]);
            $timearr1 = explode(":",$timearr[1]);
            $datestr = $datearr1[2].$datearr1[1].$datearr1[0].$timearr1[0].$timearr1[1].$timearr1[2];
            $datenow = date("YmdHis");
            $datediff = $datenow-$datestr;
            if($datediff>200){
                $datalog = array('user_id'=>$getuser12[0]['u_id'], 'login_source'=>$oauth_provider, 'username'=>$email, 'password'=>"", 'ip_address'=>$ip, 'browser_name'=>$browser, 'device_type'=>$device,
                'details'=>$agent, 'login_time'=>date('d/m/Y H:i:s'), 'login_attempt'=>'success');
                $s = insertQuery(USERLOG,$datalog);
            }
        }
    }
    $query = selectQuery(SOC_USERS,"*","oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$oauth_uid."'");
    return $query;
}
function checkUser2($oauth_provider1,$oauth_uid1,$fname1,$lname1,$email1,$gender1,$locale1,$link1,$picture1){
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){ $ip = $_SERVER["HTTP_CLIENT_IP"]; }
    elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){ $ip = $_SERVER["HTTP_X_FORWARDED_FOR"]; }
    else{ $ip = $_SERVER["REMOTE_ADDR"]; }
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
    if( stristr($_SERVER['HTTP_USER_AGENT'],'ipad')){
        $device = "ipad";
    } else if((stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone'))&&stristr($_SERVER['HTTP_USER_AGENT'],'Windows Phone')=== FALSE){
        $device = "iphone";
    } else if( stristr($_SERVER['HTTP_USER_AGENT'],'Windows Phone')){
        $device = "Windows Phone";
    }
    else if( stristr($_SERVER['HTTP_USER_AGENT'],'blackberry')){
        $device = "blackberry";
    } else if( stristr($_SERVER['HTTP_USER_AGENT'],'android')){
        $device = "android";
    } else if( stristr($_SERVER['HTTP_USER_AGENT'],'Windows NT 10.0')){
        $device = "Windows 10";
    } else if( stristr($_SERVER['HTTP_USER_AGENT'],'Windows NT 6.1')){
        $device = "Windows 7";
    }
    $prevQuery = selectQuery(GOOGLE_USERS,"*","oauth_provider = '".$oauth_provider1."' AND oauth_uid = '".$oauth_uid1."'");
    $data = array('oauth_provider'=>$oauth_provider1, 'oauth_uid'=> $oauth_uid1, 'fname'=>$fname1, 'lname'=>$lname1, 'email'=>$email1, 'gender'=>$gender1, 'locale'=>$locale1, 'gpluslink'=>$link1, 'picture'=>$picture1, 'created'=>date("Y-m-d H:i:s"), 'modified'=>date("Y-m-d H:i:s"));
    $update = insertQuery(GOOGLE_USERS,$data);
    $getuser55 = selectQuery(WEB_USER,"*","u_email = '".$email1."' and isDel='0'");
    if(count($getuser55)){
        $_SESSION['reguser'] = $getuser55[0]['u_id']; $_SESSION['uemail'] = $getuser55[0]['u_email']; $_SESSION['uname'] = $getuser55[0]['u_name']; $_SESSION['riderz_user'] = $getuser55[0]['u_id'];
        if($_SESSION['setuser']!="setted"){ $_SESSION['setuser']= 'notsetted'; }
        $data1 = array('source'=>$oauth_provider1, 'last_login'=>date("d/m/Y H:i:s"));
        $insert1 = updateQuery(WEB_USER,$data1,"u_email = '".$email1."' and isDel='0'");
        $data5 = array('source'=>$oauth_provider1,'last_login'=>date("d/m/Y H:i:s"));
        $insert1 = updateQuery(WEB_USER,$data5,"u_email = '".$email1."' and isDel='0'");
        $checklastlogin = selectQuery(USERLOG,"*","user_id=".$getuser55[0]['u_id']." order by log_id desc limit 1");
        $lastlogin = $checklastlogin[0]['login_time'];
        $timearr = explode(" ",$lastlogin);
        $datearr1 = explode("/",$timearr[0]);
        $timearr1 = explode(":",$timearr[1]);
        $datestr = $datearr1[2].$datearr1[1].$datearr1[0].$timearr1[0].$timearr1[1].$timearr1[2];
        $datenow = date("YmdHis");
        $datediff = $datenow-$datestr;
        if($datediff>200){
            $datalog=array('user_id'=>$getuser55[0]['u_id'], 'login_source'=>$oauth_provider1, 'username'=>$email1, 'password'=>"", 'ip_address'=>$ip, 'browser_name'=>$browser,
            'device_type'=>$device, 'details'=>$agent, 'login_time'=>date('d/m/Y H:i:s'), 'login_attempt'=>'success');
            $s = insertQuery(USERLOG,$datalog);
        }
    } else{
        $data1 = array('u_name'=>$fname1, 'u_lname'=>$lname1, 'u_gender'=>$gender1, 'u_email'=>$email1, 'email_verified'=>'1', 'isActive'=>'1', 'source'=>$oauth_provider1, 'reg_date'=>date('d/m/Y'));
        $insert1 = insertQuery(WEB_USER,$data1);
        if($insert1){
            $getuser12 = selectQuery(WEB_USER,"*","u_email = '".$email1."' and isDel='0'");
            $_SESSION['reguser'] = $getuser12[0]['u_id'];
            $_SESSION['uemail'] = $getuser12[0]['u_email'];
            $_SESSION['uname'] = $getuser12[0]['u_name'];
            $_SESSION['riderz_user'] = $getuser12[0]['u_id'];
            if($_SESSION['setuser']!="setted"){ $_SESSION['setuser']= 'notsetted'; }
            $data5 = array('source'=>$oauth_provider, 'last_login'=>date("d/m/Y H:i:s"));
            $insert1 = updateQuery(WEB_USER,$data5,"u_email = '".$email1."' and isDel='0'");
            $checklastlogin = selectQuery(USERLOG,"*","user_id=".$getuser12[0]['u_id']." order by log_id desc limit 1");
            $lastlogin = $checklastlogin[0]['login_time'];
            $timearr = explode(" ",$lastlogin);
            $datearr1 = explode("/",$timearr[0]);
            $timearr1 = explode(":",$timearr[1]);
            $datestr = $datearr1[2].$datearr1[1].$datearr1[0].$timearr1[0].$timearr1[1].$timearr1[2];
            $datenow = date("YmdHis");
            $datediff = $datenow-$datestr;
            if($datediff>200){
                $datalog = array('user_id'=>$getuser12[0]['u_id'], 'login_source'=>$oauth_provider1, 'username'=>$email1, 'password'=>"", 'ip_address'=>$ip, 'browser_name'=>$browser, 'device_type'=>$device, 'details'=>$agent, 'login_time'=>date('d/m/Y H:i:s'), 'login_attempt'=>'success');
                $s = insertQuery(USERLOG,$datalog);
            }
        }
    }
    $result = selectQuery(GOOGLE_USERS,"*","oauth_provider = '".$oauth_provider1."' AND oauth_uid = '".$oauth_uid1."'");
    return $result;
}
function formatMoney($number, $fractional=false){
    if($fractional){ $number = sprintf('%.2f', $number); }
    while(true){
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if($replaced != $number){ $number = $replaced; } else{ break; }
    }
    return $number;
}
function getleadno($no){
    if($no==0){ $leadno="000001"; }
    else{ $leadno = $no+1; }
    if(strlen($leadno)==1){ $newlead="00000".$leadno; }
    if(strlen($leadno)==2){ $newlead="0000".$leadno; }
    if(strlen($leadno)==3){ $newlead="000".$leadno; }
    if(strlen($leadno)==4){ $newlead="00".$leadno; }
    if(strlen($leadno)==5){ $newlead="0".$leadno; }
    if(strlen($leadno)==6){ $newlead=$leadno; }
    return $newlead;
}
function replace_nonletter($text){
    //replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '_', $text);
    //transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    //remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    //trim
    $text = trim($text, '_');
    //remove duplicate -
    $text = preg_replace('~-+~', '_', $text);
    //lowercase
    $text = strtolower($text);
    return $text;
}      
function createurltitle($text){
    //replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    //transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    //remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    //trim
    $text = trim($text, '-');
    //remove duplicate -
    $text = preg_replace('~-+~', '-', $text);
    //lowercase
    $text = strtolower($text);
    return $text;
}
function cssparse($file){
    $css = file_get_contents($file);
    preg_match_all( '/(?ims)([a-z0-9\s\,\>\.\:#_\-@]+)\{([^\}]*)\}/', $css, $arr);
    $result = array();
    foreach ($arr[0] as $i => $x){
        $selector = trim($arr[1][$i]);
        $rules = explode(';', trim($arr[2][$i]));
        $rules_arr = array();
        foreach($rules as $strRule){
            if(!empty($strRule)){
                $rule = explode(":", $strRule);
                $rules_arr[trim($rule[0])] = trim($rule[1]);
            }
        }
        $selectors = explode('<br>', trim($selector));
        foreach($selectors as $strSel){ $result[$strSel] = $rules_arr; }
    }
    return $result;
}
function getimgconfig($imgtype){
    $getimageconfigs = selectQuery(IMGCONFIG,"*","img_type='".$imgtype."'");
    $configs = json_encode($getimageconfigs,true);
    return $configs;
}
function getimgconfigpaths($imgtype){
    $getimageconfigs = selectQuery(IMGCONFIG,"imgs_location,thumb1_path,thumb2_path,thumb3_path,thumb4_path,thumb5_path,max_image_size,crop_width,crop_height,default_image_width,default_image_height, 	crop_enabled  ,max_image_count","img_type='".$imgtype."'");
    $configs = $getimageconfigs;
    return $configs;
}
function getRelativePath($from, $to){
    //some compatibility fixes for Windows paths
    $from = is_dir($from) ? rtrim($from, '\/') . '/' : $from;
    $to = is_dir($to) ? rtrim($to, '\/') . '/'   : $to;
    $from = str_replace('\\', '/', $from);
    $to = str_replace('\\', '/', $to);
    $from = explode('/', $from);
    $to = explode('/', $to);
    $relPath = $to;
    foreach($from as $depth => $dir){
        //find first non-matching dir
        if($dir === $to[$depth]){
            //ignore this directory
            array_shift($relPath);
        } else{
            //get number of remaining dirs to $from
            $remaining = count($from) - $depth;
            if($remaining > 1){
                //add traversals up to first matching dir
                $padLength = (count($relPath) + $remaining - 1) * -1;
                $relPath = array_pad($relPath, $padLength, '..');
                break;
            } else{ $relPath[0] = './' . $relPath[0]; }
        }
    }
    return implode('/', $relPath);
} ?>
