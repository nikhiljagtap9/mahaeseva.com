<?php include("includes/configuration.php");
    $action = $_REQUEST['action'];
    if($action=="update_txnid"){
        $agreement_id = $_REQUEST['agreement_id'];
        $txnno = $_REQUEST['txnno'];
        $payment_mode = $_REQUEST['payment_mode'];
        $agreedata = array("payment_mode"=>$payment_mode,"last_transaction_id"=>$txnno);
        $updatedata = updateQuery(AGR,$agreedata,"agreement_no='".$agreement_id."'");
        if($updatedata){
            $orddata = selectQuery(PAYMENT,"*","payment_no<>'' order by pay_id DESC limit 1");
            if(count($orddata)==0){ $payno = PAYMENTID."-A10000"; }
            else{
                $prefix = PAYMENTID; $lenght = strlen($prefix)+2; $lenghtlessone = $lenght-1;
                $orid = $orddata[0]['payment_no'];
                $numcnt = substr($orid,$lenght,5);
                if($numcnt==99999){
                    $start = substr($orid,0,$lenghtlessone);
                    $alpha = substr($orid,$lenghtlessone,1);
                    $b=++$alpha;
                    $payno= $start."".$b."10000";
                } else{
                    $start = substr($orid,0,$lenght); $a = intval($numcnt)+1; $payno = $start."".$a;
                }
            }
            $paymentdata = array("payment_no"=>$payno, "transaction_id"=>$txnno, "case_id"=>$agreement_id);
            insertQuery(PAYMENT,$paymentdata);
            echo 1;
        }
    }
    if($action=="update_appointment"){
        $agreement_id = $_REQUEST['agreement_id'];
        $appo_date = date("Y-m-d H:i",strtotime($_REQUEST['appointment_Date']));
        $exappo_date = date("Y-m-d H:i",strtotime($_REQUEST['ex_appointment_Date']));
        $appointmentdata = array("biometric_appointement_date"=>$appo_date,"ex_biometric_appointement_date"=>$exappo_date);
        $updateoppo = updateQuery(AGR,$appointmentdata,"agreement_no='".$agreement_id."'");
        if($updateoppo){ echo 1; } else{ echo 0; }
    }
    /**************************User login functionalities********************************************************/
    if($action=="sendotp"){
        $mobile = $_REQUEST['mob'];
        $length = 6;
        $chars = '0123456789';
        $chars_length = (strlen($chars) - 1);
        $string = $chars{rand(0, $chars_length)};
        for ($i = 1; $i < $length; $i = strlen($string)){
            $r = $chars{rand(0, $chars_length)};
            if($r != $string{$i - 1}) $string .=  $r;
        }
        $otp = $string;
        //$otp = '123456';
        $_SESSION['userotp'] = $otp;
        $_SESSION['userotptime'] = date('YmdHis');
        $type = "PHP";
        $m = "Your One Time Password (OTP) for Maha-E-Seva.com is ". $otp ." (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
        $m1 = "Your One Time Password (OTP) for Maha-E-Seva.com is ****** (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
       // $sms = sendsms($mobile,$m,WORKINGKEY,SMS_SENDER,"1207167593735371400");
        $sms = sendwhatsappsms($mobile,$m);
        $id = (unserialize($sms));
        $msid = $id['data']['0']['id'];
        $status = $id['data']['0']['status'];
        $datasms = array("msg_id"=>$msid, "msg_type"=>"OTP", "mobile_no"=>$mobile, "message"=>$m1, "date"=>date("Y-m-d H:i:s"), "status"=>$status);
        $store = insertQuery(SMS,$datasms);
        echo "1";
  }
  if($action=="resendotp"){
        $mobile=$_REQUEST['mob'];
            $length = 6;
            $chars = '0123456789';
           $chars_length = (strlen($chars) - 1);
           $string = $chars{rand(0, $chars_length)};
           for ($i = 1; $i < $length; $i = strlen($string))
             {
                $r = $chars{rand(0, $chars_length)};
                if ($r != $string{$i - 1}) $string .=  $r;
             }
             $otp = $string;
             $_SESSION['userotp']=$otp;
             $_SESSION['userotptime'] = date('YmdHis');
             $type="PHP";
            $m = "Your One Time Password (OTP) for Maha-E-Seva.com is ". $otp ." (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
            $m1 = "Your One Time Password (OTP) for Maha-E-Seva.com is ****** (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
           // $sms= sendsms($mobile,$m,WORKINGKEY,SMS_SENDER,"1207167593735371400");
            $sms = sendwhatsappsms($mobile,$m);
            $id=(unserialize($sms));
             $msid=$id['data']['0']['id'];
              $status=$id['data']['0']['status'];
            $datasms=array(
              "msg_id"=>$msid,
              "msg_type"=>"OTP",
              "mobile_no"=>$mobile,
              "message"=>$m1,
              "date"=>date("Y-m-d H:i:s"),
              "status"=>$status
            );
            $store=insertQuery(SMS,$datasms);
        echo 1;
  }
    if($action=="verifyotp")
  {
        $otp=$_REQUEST['otp'];
        $mob=$_REQUEST['mob'];
        $sessotp=$_SESSION['userotp'];
          $sessotptime=$_SESSION['userotptime'];
          $currtime=date('YmdHis');
          $diff=$currtime-$sessotptime;
          if($diff>1500)
          {
              echo 1; //expired
          }
          else
          {
              if($sessotp!=$otp)
              {
                  echo 0; //invalide
              }
              else
              {
                    $getuser=selectQuery(WEB_USER,"*","u_mobile='".$mob."' and isActive='1' ");
                    if(count($getuser))
                    {
                       $u_id=$getuser[0]['u_id'];
                       $u_email= $getuser[0]['u_email'];
                       $ufname=$getuser[0]['u_fname'];
                       $logdataupdate=array(
                         "last_login"=>date("d-m-Y H:i")
                        );
                         $updatetuser=updateQuery(WEB_USER,$logdataupdate,"u_id=".$u_id);
                    }
                    else
                    {
                        $logdata=array(
                         "u_mobile"=>$mob,
                          "added_on"=>date("Y-m-d H:i"),   
                         "last_login"=>date("d-m-Y H:i")
                        );
                         $insertuser=insertQuery(WEB_USER,$logdata);
                          $u_id=$insertuser;
                    }
                        $_SESSION['userotp']="";
                        $_SESSION['userotptime']="";
                        $_SESSION['reguser']= $u_id;
                    $_SESSION['last_login_timestamp'] = time();
                        if (!empty($_SERVER["HTTP_CLIENT_IP"]))
                        {
                         //check for ip from share internet
                         $ip = $_SERVER["HTTP_CLIENT_IP"];
                        }
                        elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
                        {
                         // Check for the Proxy User
                         $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                        }
                        else
                        {
                         $ip = $_SERVER["REMOTE_ADDR"];
                        }
                         $agent = $_SERVER['HTTP_USER_AGENT'];
                            $browser = 'NA';
                            if((preg_match('/MSIE/i',$agent)||preg_match('/Trident/i',$agent)||(preg_match('/Trident/i',$agent)&&stristr($_SERVER['HTTP_USER_AGENT'],'Windows Phone'))) && !preg_match('/Opera/i',$agent))
                            {
                                $browser = 'Internet Explorer';
                                $ub = "MSIE";
                            }
                            elseif(preg_match('/Windows NT 10/i',$agent) && preg_match('/Edge/i',$agent)){
                                $browser = 'Microsoft Edge';
                                $ub = "Edge";
                            }
                            elseif(preg_match('/Firefox/i',$agent))
                            {
                                $browser = 'Mozilla Firefox';
                                $ub = "Firefox";
                            }
                            elseif(preg_match('/Chrome/i',$agent))
                            {
                                $browser = 'Google Chrome';
                                $ub = "Chrome";
                            }
                            elseif(preg_match('/Safari/i',$agent))
                            {
                                $browser = 'Apple Safari';
                                $ub = "Safari";
                            }
                            elseif(preg_match('/Opera/i',$agent))
                            {
                                $browser = 'Opera';
                                $ub = "Opera";
                            }
                            elseif(preg_match('/Netscape/i',$agent))
                            {
                                $browser = 'Netscape';
                                $ub = "Netscape";
                            }
                            $device = '';
                    		if( stristr($_SERVER['HTTP_USER_AGENT'],'ipad') ) {
                    			$device = "ipad";
                    		}  else if((stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone'))&&stristr($_SERVER['HTTP_USER_AGENT'],'Windows Phone')=== FALSE) {
                    			$device = "iphone";
                    		}
                            else if( stristr($_SERVER['HTTP_USER_AGENT'],'Windows Phone') ) {
                              	$device = "Windows Phone";
                            }
                            else if( stristr($_SERVER['HTTP_USER_AGENT'],'blackberry') ) {
                    			$device = "blackberry";
                    		} else if( stristr($_SERVER['HTTP_USER_AGENT'],'android') ) {
                    			$device = "android";
                    		}
                            else if( stristr($_SERVER['HTTP_USER_AGENT'],'Windows NT 10.0') ) {
                              	$device = "Windows 10";
                            }
                             else if( stristr($_SERVER['HTTP_USER_AGENT'],'Windows NT 6.1') ) {
                              	$device = "Windows 7";
                            }
                         $datalog=array(
                         'user_id'=>$u_id,
                          'username'=>$mob,
                          'password'=>"",
                          'ip_address'=>$ip,
                          'browser_name'=>$browser,
                          'device_type'=>$device,
                          'details'=>$agent,
                          'login_time'=>date('d-m-Y H:i:s'),
                          'login_attempt'=>'success'
                        );
                        $s=insertQuery(USERLOG,$datalog);
                echo "home.php";
              }
          }
}
if($action=="filluserdata"){
    $ufname = $_REQUEST['ufname']; $ulname = $_REQUEST['ulname']; $uemail = $_REQUEST['uemail']; $uid = $_REQUEST['uid'];
    if($uid!=""){
        $data = array("u_fname"=>$ufname,"u_lname"=>$ulname,"u_email"=>$uemail);
        $updatetuser = updateQuery(WEB_USER,$data,"u_id=".$uid);
        if($updatetuser){ echo "1"; } else{echo "0";}
    } else{ echo "0"; }
}
