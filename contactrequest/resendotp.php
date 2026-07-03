<?php
  include("../includes/configuration.php");
  $_SESSION['otp']="";
  $_SESSION['otptime'] = "";
  $contactNop =base64_decode($_REQUEST['no']);
  $chkseller=selectQuery(dealer,"*","personalcontactno='".$contactNop."' and isDel='0'");
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
                 $_SESSION['otp']=$otp;

                 $_SESSION['otptime'] = date('YmdHis');
                 $type="PHP";
                 $m = "Your One Time Password for Maha-E-Seva.com is ". $otp ." (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
                 $m1 = "Your One Time Password for Maha-E-Seva.com is ****** (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";

               $sms= sendsms($contactNop,$m,WORKINGKEY,SMS_SENDER);

               $id=(unserialize($sms));

                         $msid=$id['data']['0']['id'];
                          $status=$id['data']['0']['status'];
                        $datasms=array(
                          "msg_id"=>$msid,
                          "msg_type"=>"OTP",
                          "user_name"=> $chkseller[0]['dealer_name'],
                          "mobile_no"=>$contactNop,
                          "message"=>$m1,
                          "date"=>date("Y-m-d H:i:s"),
                          "status"=>$status
                        );
                        $store=insertQuery(SMS,$datasms);
