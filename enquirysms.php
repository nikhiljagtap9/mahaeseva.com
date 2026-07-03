<?php
    include("includes/configuration.php");

    $action=$_REQUEST['action'];
    $supportmail = selectQuery(SUPPORTEMAIL, "*");
    if (!empty ($_SERVER["HTTP_CLIENT_IP"])) {
//check for ip from share internet
  $ip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif (!empty ($_SERVER["HTTP_X_FORWARDED_FOR"])) {
// Check for the Proxy User
  $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else {
  $ip = $_SERVER["REMOTE_ADDR"];
}
$agent = $_SERVER['HTTP_USER_AGENT'];
$browser = 'NA';
if ((preg_match('/MSIE/i', $agent) || preg_match('/Trident/i', $agent) || (preg_match('/Trident/i', $agent) && stristr($agent, 'Windows Phone'))) && !preg_match('/Opera/i', $agent)) {
  $browser = 'Internet Explorer';
  $ub = "MSIE";
}
elseif (preg_match('/Windows NT 10/i', $agent) && preg_match('/Edge/i', $agent)) {
  $browser = 'Microsoft Edge';
  $ub = "Edge";
}
elseif (preg_match('/Firefox/i', $agent) && !preg_match('/Iceweasel/i', $agent)) {
  $browser = 'Mozilla Firefox';
  $ub = "Firefox";
}
elseif (preg_match('/Chrome/i', $agent)) {
  $browser = 'Google Chrome';
  $ub = "Chrome";
}
elseif (preg_match('/Safari/i', $agent)) {
  $browser = 'Apple Safari';
  $ub = "Safari";
}
elseif (preg_match('/Opera/i', $agent)) {
  $browser = 'Opera';
  $ub = "Opera";
}
elseif (preg_match('/Netscape/i', $agent)) {
  $browser = 'Netscape';
  $ub = "Netscape";
}
elseif (preg_match('/Iceweasel/i', $agent) && preg_match('/Firefox/i', $agent)) {
  $browser = 'Iceweasel';
  $ub = "Iceweasel";
}
$device = '';
if (stristr($agent, 'ipad')) {
  $device = "ipad";
}
else
  if ((stristr($agent, 'iphone') || strstr($agent, 'iphone')) && stristr($agent, 'Windows Phone') === FALSE) {
    $device = "iphone";
  }
  else
    if (stristr($agent, 'Windows Phone')) {
      $device = "Windows Phone";
    }
    else
      if (stristr($agent, 'blackberry')) {
        $device = "blackberry";
      }
      else
        if (stristr($agent, 'android')) {
          $device = "android";
        }
        else
          if (stristr($agent, 'Windows NT 10.0')) {
            $device = "Windows 10";
          }
          else
            if (stristr($agent, 'Windows NT 6.1')) {
              $device = "Windows 7";
            }
            else
              if (preg_match('/linux/i', $agent)) {
                $device = "Linux";
              }
    if($action=="sendotp")
    {
        $name=$_REQUEST['name'];

        $mobile=$_REQUEST['mobile'];
        $email=$_REQUEST['email'];
        $message=$_REQUEST['message'];
        $fieldvalue = $_REQUEST['sessionval'];
        $sessionvalue = $_SESSION['randomstring'];


        /*echo $name." ".$mobile." ".$email." ".$message." ".$fieldvalue." ".$sessionvalue;
        exit;*/


       /* if($sessionvalue==$fieldvalue &&$name!=""&&$mobile!=""&&$email!=""&&$message!="")  */
       if($name!=""&&$mobile!=""&&$email!=""&&$message!="")
        {
            $deptid="1";

            if($deptid!="")
            {

                $getdept=selectQuery(SUPPORTDEPT,"*","dept_id=".$deptid);
                $time=$getdept[0]['SLAtime'];
                    if($time!="")
                    {
                        $a="+".$time." hours";
                        $new_time = date("Y-m-d H:i:s",strtotime($a));
                    }
                    else
                    {
                        $new_time ="";
                    }

                    $getstaff=selectQuery(SUPPORTSTAFF,"*","department=".$deptid." and isDel='0'");

                    for($k=0;$k<count($getstaff);$k++)
                    {
                        if($getstaff[$k]['emp_name']!=""&&$getstaff[$k]['emp_email']!="")
                        {
                            array_push($staff,$getstaff[$k]['emp_name']);
                            array_push($staffemails,$getstaff[$k]['emp_email']);
                        }
                    }

                    $dept=$getdept[0]['dept_name'];
                    $deptstr='For Department '.$dept.'';
            }
            else
            {
                $dept="";
                $deptstr='For Department - Not Defined';
            }

            $staffemaillist=implode(",",$staffemails);
            $lastRE=selectQuery(CONTACT,"*","1 order by req_id DESC LIMIT 1");
            if(count($lastRE))
            {
                $reqid=getleadno($lastRE[0]['contact_request_id']);
            }
            else
            {
                $reqid="000001";
            }

                $data=array(
                    "tkt_source"=>"SMS",
                    "contact_request_id"=>$reqid,
                    "entry_by"=>"Client",
                    "Name"=>$name,
                    "Email"=>$email,
                    "Telephone"=>$mobile,
                    "Comment"=>$message,
                    "dept"=>$deptid,
                    "date"=>date("Y-m-d H:i:s"),
                    "overdue_date"=>$new_time,
                    "isOpen"=>'1',
                    "ip_address" => $ip,
                    "device" =>  $device,
                    "browser" => $browser,

                );
                $last=insertQuery(CONTACT,$data);



                if($last)
                {

                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= "From:".SITENAME."<".EMAIL_SENDER.">";
                    $subject="Support Request- ".$reqid;

                        if($supportmail[0]['new_tkt_alert']=="1")
                        {
                            if($supportmail[0]['new_tkt_alert_admin']=="1")
                            {

                                $body1='<div style="font-size:16px;font-family:calibri;">
                                <div style="margin:20px 0;">
                                        <img src="'.SITEURL.'/img/projectimage/logo.png" alt="" />
                                    </div>
                                    <div><b>Dear Admin,</b></div>
                                    <div style="color:grey;margin-bottom: 20px;">Following new support ticket is created  '.$deptstr.'- </div>
                                    <hr  style="border:1px solid #e8e8e8;margin-bottom: 8px;color:#CECECE">
                                        <table style="line-height:23px;">
                                            <tr>
                                              <td style="width:55%;"><b>Support Ticket ID</b></td>
                                              <td style="color:grey;">'.$reqid.'</td>
                                            </tr>
                                            <tr>
                                              <td><b>Date &amp; Time</b></td>
                                              <td style="color:grey;">'.date("d/m/Y H:i:s").'</td>
                                            </tr>
                                            <tr>
                                              <td> <b>Name</b> </td>
                                              <td style="color:grey;">'.$name.'</td>
                                            </tr>
                                            <tr>
                                              <td><b>Email (New/Existing)</b></td>
                                              <td style="color:grey;">'. $email.'</td>
                                            </tr>
                                            <tr>
                                              <td><b>Mobile Number</b></td>
                                              <td style="color:grey;">'. $tele.'</td>
                                            </tr>
                                             <tr>
                                              <td><b>Message</b></td>
                                              <td style="color:grey;">'.$cmnt.'</td>
                                            </tr>
                                        </table>
                                    <br><hr style="border:1px solid #e8e8e8;"><br>
                                    Please give quick follow up to this user<br>
                                </div>';

                                $sentmail = mail(EMAIL_SENDER, $subject, $body1, $headers);
                            }

                            /* ************************************send emails to dept manager and staff******************************************************************* */

                            if($dept!="")
                            {
                                //to department manager
                                if($supportmail[0]['new_tkt_alert_mgr']=="1")
                                {
                                    $emailmgr =$getdept[0]['dept_manager_email'];

                                    $bodymgr='<div style="font-family:calibri;font-size:16px;">
                                                <div style="margin:20px 0;">
                                                    <img src="'.SITEURL.'/img/projectimage/logo.png" alt="" />
                                                </div>
                                                <p>Dear '.$getdept[0]['dept_manager'].',</p>
                                                <p style="color:grey;">Following new support ticket is created '.$deptstr.'  - </p>
                                                      <hr>
                                                   <table style="width:100%; line-height:23px;margin-bottom: 15px;">
                                                    <tr>
                                                      <td style="width:40%;"><b>Support Ticket ID</b></td>
                                                      <td style="color:grey;">'.$reqid.'</td>
                                                    </tr>
                                                    <tr>
                                                      <td><b>Date &amp; Time</b></td>
                                                      <td style="color:grey;">'.date("d/m/Y H:i:s").'</td>
                                                    </tr>
                                                    <tr>
                                                      <td> <b>Name</b> </td>
                                                      <td style="color:grey;">'.$name.'</td>
                                                    </tr>
                                                    <tr>
                                                      <td><b>Email (New/Existing)</b></td>
                                                      <td style="color:grey;">'. $email.'</td>
                                                    </tr>
                                                    <tr>
                                                      <td><b>Mobile Number</b></td>
                                                      <td style="color:grey;">'. $tele.'</td>
                                                    </tr>
                                                     <tr>
                                                      <td><b>Message</b></td>
                                                      <td style="color:grey;">'.$cmnt.'</td>
                                                    </tr>
                                            </table>
                                                  <hr>
                                                  Please give quick follow up to this user<br>
                                            </div>';

                                        $sentmailmgr = mail($emailmgr, $subject, $bodymgr, $headers);
                                }

                                if($supportmail[0]['new_tkt_alert_members']=="1")
                                {
                                    if(sizeOf($staffemails))
                                    {

                                        $emailstaff =$staffemaillist;

                                        $bodystaff='<hr style="margin-bottom:50px"> <div style="width: 70%;margin:0 auto">

                                            <div style="margin: 0 auto;text-align: center"><img src="'.SITEURL.'/img/projectimage/logo.png" alt="" /></div>

                                            <p>Dear Staff,<br><br>Following new support ticket is created '.$deptstr.'  - <br>
                                                  <hr  style="border-style:groove;margin-bottom: 8px;color:#CECECE">

                                               <table>
                                                <tr>
                                                  <td>Support Ticket ID</td>
                                                  <td>:</td>
                                                  <td>'.$reqid.'</td>
                                                </tr>
                                                <tr>
                                                  <td>Date &amp; Time</td>
                                                  <td>:</td>
                                                  <td>'.date("d/m/Y H:i:s").'</td>
                                                </tr>
                                                <tr>
                                                  <td> Name </td>
                                                  <td>:</td>
                                                  <td>'.$name.'</td>
                                                </tr>
                                                <tr>
                                                  <td>Email (New/Existing)</td>
                                                  <td>:</td>
                                                  <td>'. $email.'</td>
                                                </tr>
                                                <tr>
                                                  <td>Mobile Number</td>
                                                  <td>:</td>
                                                  <td>'. $tele.'</td>
                                                </tr>
                                                 <tr>
                                                  <td>Message</td>
                                                  <td>:</td>
                                                  <td>'.$cmnt.'</td>
                                                </tr>

                 							 </table>

                                              <br><hr style="border-style:groove;color:#CECECE"><br>
                                              Please give quick follow up to this user<br>

                                           </p>
                                            </div>';

                                            $sentmailstaff = mail($emailstaff, $subject, $bodystaff, $headers);
                                    }
                                }
                            }

                            if($supportmail[0]['new_tkt_alert_client']=="1")
                            {
                             /* *********************************************************************************************************************************************** */

                                $bodyclient='<div style="font-family:calibri;font-size:16px;">
                                                <div style="margin:20px 0;"><img src="'.SITEURL.'/img/projectimage/logo.png" alt="" /></div>
                                                <hr>
                                                <p><b>Dear</b> '.$name.',</p>
                                                <p style="color:grey;">Your support ticket bearing ticket ID '.$reqid.' has been assigned to our Customer Happiness Manager for
                                                further action and we will find a happyness solution to your query in a very short span of time.<br><br>
                                                Thank you for your cooperation.<br> Please do let us know if you have any queries in this regard.
                                                </p>
                                                <hr>
                                            </div>';

                                  $sentmail1client = mail($email, $subject, $bodyclient, $headers);
                              }
                        }
                                  /*echo 1;*/
                }
               



$m="Thank you for contacting  https://www.mahaeseva.com,, our customer happiness manager will contact you soon.";    // To User

$m1="Dear Admin, following user have raised enquiry -
Username : ".$name."
Mobile : ".$mobile."
Message : ".$message." 

Regards,
Maha-E-Seva.com Team";                            // To Admin

        if(SMS_SYSTEM=="ON")
        {
        $sms= sendsms($mobile,$m,WORKINGKEY,SMS_SENDER,"1207162340104603761");     // To User

        // To USER
            $id=(unserialize($sms));

            $msid=$id['data']['0']['id'];
            $status=$id['data']['0']['status'];

            $datasms=array(
              "msg_id"=>$msid,
              "msg_type"=>"Enquiry",
              "user_name"=>$name,
              "mobile_no"=>$mobile,
              "email"=>$email,
			  "sms"=>$message,
              "message"=>$m,
              "date"=>date("Y-m-d H:i:s"),
              "status"=>$status,
			  "isUser"=>1
            );

        $insert=insertQuery(SMS,$datasms);

        // TO ADMIN
        $arr = explode(",",ADMINMOB);
        for($k=0;$k<sizeOf($arr);$k++)
        {
            $tempmob = $arr[$k];
            $sms1= sendsms($tempmob,$m1,WORKINGKEY,SMS_SENDER,"1207162400063159612");

            $id1=(unserialize($sms1));

            $msid1=$id1['data']['0']['id'];
            $status1=$id1['data']['0']['status'];
            $datasms1=array(
              "msg_id"=>$msid1,
              "msg_type"=>"Enquiry",
              "user_name"=>$name,
              "mobile_no"=>$tempmob,
              "sms"=>$message,
              "message"=>$m1,
              "email"=>$email,
              "date"=>date("Y-m-d H:i:s"),
              "status"=>$status1,
              
            );

            $insert1=insertQuery(SMS,$datasms1);
        }
        }  // SMS SYSTEM ON/OFF


            echo "1";
        }
        else
        {
            echo "2";
        }
  }

?>