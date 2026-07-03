<?php
   include("includes/configuration.php");
        $segment=$path_info['call_parts'][1];
        $orderid=base64_decode($segment);
      
          $data=array(
               'payment_mode'=>"COD",
               'last_payment_date'=>"",
               'last_transaction_id'=>"",
               'last_payment_status'=>""
            );
            $query=updateQuery(AGR,$data,"agreement_no='".$orderid."'");

           $agrdata=selectQuery(AGR,"*","agreement_no='".$orderid."'");
           $user=$agrdata[0]['agree_by'];

           $amount=$agrdata[0]['total_charges'];
           $payment_mode=$agrdata[0]['payment_mode'];
           $biometric_appointement_date = date('d M Y h:i a', strtotime(date($agrdata[0]['biometric_appointement_date'])));

            $userdata=selectQuery(WEB_USER,"*","u_id=".$user);

           $headers  = 'MIME-Version: 1.0' . "\r\n";
                 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                 $headers .= "From:".SITENAME."<".EMAIL_SENDER.">";
                 $subject="Agreement -".$orderid;
                $body='<hr style="margin-bottom:50px">
               <div style="width: 100%;margin:0 auto;padding:25px;border-radius:20px;border:1px solid #ddd;">

                    <div style="margin: 0 auto;text-align: left"><img src="'.SITEURL.'/img/projectimage/logo.png" alt="logo" /></div>

                    <p>Dear '.$userdata[0]['u_fname'].' '.$userdata[0]['u_lname'].',</p>
                    <p>Thank you for regsitering your Online Rent Agreement on <a href="'.SITEURL.'">'.SITEURL.'</a></p>
                    <p>You appointment details are :</p>

                    <ol type="1">
                        <li>Agreement No - '.$orderid.'</li>
                        <li>Bio-Metric Appointment - '.$biometric_appointement_date.'</li>
                    </ol>

                    <hr style="color:#ddd">

                    <div style="margin-top:10px">
                        <b>Please login to your account for more details <a href="'.SITEURL.'">'.SITEURL.'</a> </b>
                    </div>

                    <div style="margin-top:10px">
                          With Regards,<br>
                          Team '.SITENAME.'
                    </div>';
           $sentmail = mail($userdata[0]['u_email'], $subject, $body, $headers);

            $headers1  = 'MIME-Version: 1.0' . "\r\n";
            $headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers1 .= "From:".SITENAME."<".EMAIL_SENDER.">";
            $subject1="Agreement Received:".$orderid;
            $body1=' <hr style="margin-bottom:50px"><div style="width: 90%;margin:0 auto;padding:25px;border-radius:20px;border:1px solid #ddd">

            <div style="margin: 0 auto;text-align: left"><img src="'.SITEURL.'/img/projectimage/logo.png" alt="" /></div>

            <p>Dear Admin,<br>
               Agreement received with following details -</p>
                <p>
               Client Details- <br>
             </p>
             <table cellpadding="10" cellspacing="0">

                     <tr>
                      <td>Client Name</td>
                        <td>'.$userdata[0]['u_fname'].' '.$userdata[0]['u_lname'].'</td>
                    </tr>
                     <tr class="total">
                        <td>Mobile No</td>
                          <td>'.$userdata[0]['u_mobile'].' </td>
                     </tr>
                    <tr>
                      <td>Email ID</td>
                        <td>'.$userdata[0]['u_email'].'</td>
                    </tr>

                  </table>
             <p>
               Payment Details- <br>
             </p>
             <table cellpadding="10" cellspacing="0">
                     <tr>
                      <td>Agreement No</td>
                        <td>'.$orderid.'</td>
                    </tr>
                    <tr>
                      <td>Appointment Date</td>
                      <td>'.$biometric_appointement_date.'</td>
                    </tr>

                     <tr class="total">
                        <td>Total Amount</td>
                          <td>'.$amount.' /- (COD)</td>
                     </tr>

                  </table>
            <div>

                <hr style="color:#ddd">

            </div>
            </div>';

           $sentmail2= @mail(EMAIL_ORDER, $subject1, $body1, $headers1);

             $sms="Dear ".$userdata[0]['u_fname']." ".$userdata[0]['u_lname'].",
Thank you for regsitering your Online Rent Agreement on ".SITENAME."
Agreement No - ".$orderid."
Bio-Metric Appointment - ".date("d M Y h:i a",strtotime($agrdata[0]['biometric_appointement_date']));
             if(SMS_SYSTEM=="ON")
             {
                    $resp= sendsms($userdata[0]['u_mobile'],$sms,WORKINGKEY,SMS_SENDER);
                     $id=(unserialize($resp));
                 $msid=$id['data']['0']['id'];
                  $status=$id['data']['0']['status'];
                $datasms=array(
                  "msg_id"=>$msid,
                  "msg_type"=>"Agreement Received",

                  "mobile_no"=>$userdata[0]['u_mobile'],
                  "message"=>$sms,
                  "date"=>date("Y-m-d H:i:s"),
                  "status"=>$status
                );
                $store=insertQuery(SMS,$datasms);
             }
          /************************************************ SMS to admin ****************************************/
              $sms1="Dear Admin,
New Online Rent Agreement from Web
#".$orderid."
Bio - ".date("d M Y h:i a",strtotime($agrdata[0]['biometric_appointement_date']))."
".$userdata[0]['u_fname']." ".$userdata[0]['u_lname']."
Payment - ".$amount." ".$payment_mode.".";
             if(SMS_SYSTEM=="ON")
             {
                    $resp1= sendsms(ADMINNO,$sms1,WORKINGKEY,SMS_SENDER);
                     $id1=(unserialize($resp1));
                 $msid1=$id1['data']['0']['id'];
                  $status1=$id1['data']['0']['status'];
                $datasms1=array(
                  "msg_id"=>$msid1,
                  "msg_type"=>"Agreement Received",
                  "mobile_no"=>ADMINNO,
                  "message"=>$sms1,
                  "date"=>date("Y-m-d H:i:s"),
                  "status"=>$status
                );
                $store1=insertQuery(SMS,$datasms1);
             }

            $path=SITEURL."/paymentsuccess/".base64_encode($orderid);
             ?>
              <script>
                      var x= '<?php echo $path; ?>';
                        window.location.assign(x);
                    </script>
