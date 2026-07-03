<?php
  include("../includes/configuration.php");
  $email=$_REQUEST['email'];
  $logintype=$_REQUEST['logintype'];
   $otptype=$_REQUEST['otptype'];
  $checkmail=selectQuery(CONTACT,"*","Email='".$email."' order by req_id DESC LIMIT 1");

  if(count($checkmail))
  {
       $checkuser=selectQuery(SUPPORTLOGIN,"*","email='".$email."'");
       if(count($checkuser))
       {

       }
       else
       {
           $data=array(
            'email'=>$email
           );
            $in=insertQuery(SUPPORTLOGIN,$data);
       }
       ?>
         <form class="dialog-form inputField">
            <div class="col-md-12 text-center" style="margin-bottom:10px">
                           <?php
                           if($logintype!="pwd")
                           {
                                 if($otptype=="mobile")
                            {
                                  $last2mob=substr($contactNop, 8,2);
                                  echo "Verification Code Sent On Your Mobile ********".$last2mob;

                            }
                            else
                            {
                                   $emaillen=strlen($email);
                                    $first2email=substr($email, 0,2);
                                    $starstring="";
                                    $pos = strrpos($email, "@");

                                    $lst2email=substr($email,$pos);

                                    $lastlen=strlen($lst2email);
                                    $star= $emaillen-(2+$lastlen);
                                     for($i=0;$i<$star;$i++)
                                     {
                                            $starstring= $starstring."*";
                                     }
                                  echo "Verification Code Sent On Your Email ".$first2email.$starstring.$lst2email;;
                            }
                           }

                           ?>
                         </div>
                <div class="form-group">
                   <input type="text" placeholder="Please Enter Your Email Adress *" class="form-control loginu" value="<?php echo $email; ?>" readonly>
                     <input type="hidden" class="form-control logintype" value="<?php echo $logintype; ?>" readonly>
                </div>
                <?php
                  if($logintype=="otp")
                  {

                      $contactNop=$checkmail[0]['Telephone'];
                      $name=$checkmail[0]['Name'];
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
                            $_SESSION['deal']=$key;
                             $_SESSION['otptime'] = date('YmdHis');
                             $m = "Your One Time Password for Maha-E-Seva.com is ". $otp ." (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";
                             
                       if($otptype=="mobile")
                       {
                            $type="PHP";

                            $m1 = "Your One Time Password for Maha-E-Seva.com is ****** (OTP Request Code is Valid only for the next 15 Minutes) - Team Maha-E-Seva.com";

                                   $sms= sendsms($contactNop,$m,WORKINGKEY,SMS_SENDER);

                                   $id=(unserialize($sms));

                                             $msid=$id['data'][0]['id'];
                                              $status=$id['data'][0]['status'];
                                            $datasms=array(
                                              "msg_id"=>$msid,
                                              "msg_type"=>"OTP",
                                              "user_name"=> $name,
                                              "mobile_no"=>$contactNop,
                                              "message"=>$m1,
                                              "date"=>date("Y-m-d H:i:s"),
                                              "status"=>$status
                                            );
                                            $store=insertQuery(SMS,$datasms);
                       }
                       else
                       {
                              $mail1=$email;
                               $headers  = 'MIME-Version: 1.0' . "\r\n";
                               $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                               $headers .="From:".SITENAME."<".EMAIL_SENDER.">";
                             $subject="OTP";
                              $body=' <hr style="margin-bottom:50px"><div style="width: 70%;margin:0 auto">
                                <div style="background-color:#ED373C;padding: 5px;color: white;font-size: 25px;text-align: center;border-radius:15px;margin-bottom:20px">Welcome to the new world ..</div>
                                <div style="margin: 0 auto;text-align: center"><img src="'.SITEURL.'/img/projectimage/logo.png" alt="" /></div>

                                <p>Hi <br>
                               '.$m.'</p>


                                <p class="text-muted"><br>This is an automated email; if you received it in error, no action is required.<br>
                                For more information, please visit&nbsp;&nbsp;<a href='.SITEURL.'/">'.SITENAME.'</a>
                                </p>
                               ';
                              $sentmail = @mail($mail1 , $subject, $body, $headers);
                       }

                           echo $key;
                      ?>

                         <div class="form-group">
                            <input type="text" placeholder="Please Enter OTP" class="form-control pwd" maxlength="20">
                         </div>
                      <?
                  }
                  else
                  {
                      ?>
                         <div class="form-group">
                            <input type="password" placeholder="Please Enter Password" class="form-control pwd" maxlength="7">
                         </div>
                      <?
                  }
                ?>
                <div class="form-group text-center">
                <input type="button" value="Login" class="btn btnPrimary"  onclick="login()" >
                <?php
                  if($logintype=="otp")
                  {
                ?>
                <input type="button" value="Resend OTP" class="btn btn-danger"  onclick="resend('<?php echo base64_encode($contactNop); ?>')">
                <?php
                }
                ?>
                <input type="button" value="Cancel" class="btn btn-danger"  onclick="cancel()">

                </div>

                  <div class="col-md-3 col-xs-3" id="loader" ></div>
            </form>
       <?
  }
  else
  {
      echo 0;
  }
?>