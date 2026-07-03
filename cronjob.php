<?php
  include("includes/configuration.php");


   /* ********************************************** Agreement Expiry SMS  **************************************************************************************************** */
  $agreementexpiry=selectQuery(AGR,"agreement_no,end_to,agree_by","end_to='".date("d-m-Y")."' and isDel='0'");
  for($j=0;$j<count($agreementexpiry);$j++)
  {
      $agrno=$agreementexpiry[$j]['agreement_no'];
      $landloard=selectQuery(AGR_LANDLORD,"*","agreement_no='".$agrno."'");
       $tenent=selectQuery(AGR_TENENT,"*","agreement_no='".$agrno."'");
       $user=$agreementexpiry[$j]['agree_by'];
       $userdata=selectQuery(WEB_USER,"*","u_id=".$user);

      $client =$userdata[0]['u_fname']." ".$userdata[0]['u_lname'];
      $clientmob =$userdata[0]['u_mobile'];
       $sms1="Todays Alert : Rent Agreement Expiry - ".$agrno;
        

             if(SMS_SYSTEM=="ON")
             {
                    $resp1= sendsms(ADMINNO,$sms1,WORKINGKEY,SMS_SENDER);
                     $id1=(unserialize($resp1));
                         $msid1=$id1['data']['0']['id'];
                          $status1=$id1['data']['0']['status'];
                        $datasms1=array(
                          "msg_id"=>$msid1,
                          "msg_type"=>"Agreement Expiry",

                          "mobile_no"=>ADMINNO,
                          "message"=>$sms1,
                          "date"=>date("Y-m-d H:i:s"),
                          "status"=>$status
                        );
                        $store1=insertQuery(SMS,$datasms1);
             }
       for($i=0;$i<count($landloard);$i++)
       {

            $Umob =$landloard[$i]['landlord_contact_no'];
           /*  $smsU1="Dear,
 Alert : Your Rent Agreement #".$agrno." is expiring today"; */
            $smsU1="Dear, Alert: Your Rent Agreement # ".$agrno." is expiring today. Regards, Maha-E-Seva.com Team 92727 82424 www.mahaeseva.com";
             if(SMS_SYSTEM=="ON")
             {
                    $resp1= sendsms($Umob,$smsU1,WORKINGKEY,SMS_SENDER,"1207162564887635827");
                     $id1=(unserialize($resp1));
                         $msid1=$id1['data']['0']['id'];
                          $status1=$id1['data']['0']['status'];
                        $datasms1=array(
                          "msg_id"=>$msid1,
                          "msg_type"=>"Agreement Expiry",

                          "mobile_no"=>$Umob,
                          "message"=>$smsU1,
                          "date"=>date("Y-m-d H:i:s"),
                          "status"=>$status
                        );
                        $store1=insertQuery(SMS,$datasms1);
             }
       }

             for($i=0;$i<count($tenent);$i++)
       {

            $Umob =$tenent[$i]['tenent_contact_no'];
           /*  $smsU1="Dear,
Alert : Your Rent Agreement #".$agrno." is expiring today"; */
$smsU1="Dear, Alert: Your Rent Agreement # ".$agrno." is expiring today. Regards, Maha-E-Seva.com Team 92727 82424 www.mahaeseva.com";

             if(SMS_SYSTEM=="ON")
             {
                    $resp1= sendsms($Umob,$smsU1,WORKINGKEY,SMS_SENDER,"1207162564866348243");
                     $id1=(unserialize($resp1));
                         $msid1=$id1['data']['0']['id'];
                          $status1=$id1['data']['0']['status'];
                        $datasms1=array(
                          "msg_id"=>$msid1,
                          "msg_type"=>"Agreement Expiry",

                          "mobile_no"=>$Umob,
                          "message"=>$smsU1,
                          "date"=>date("Y-m-d H:i:s"),
                          "status"=>$status
                        );
                        $store1=insertQuery(SMS,$datasms1);
             }
       }
  }


       /* ********************************************** CHECK FOR TICKET OVERDUE  **************************************************************************************************** */
  $checkallreq=selectQuery(CONTACT,"*","isOverdue='0' and overdue_date<='".date("Y-m-d H:i:s")."'");

 if(count($checkallreq))
 {
      $data=array(
      "status"=>"Overdue",
      "isOverdue"=>"1"
     );
     for($i=0;$i<count($checkallreq);$i++)
     {
          $updateflag=updateQuery(CONTACT,$data,"req_id=".$checkallreq[$i]['req_id']);
          if($updateflag)
          {
              $getdeptmgroverdue=selectQuery(SUPPORTSTAFF,"*","department=".$checkallreq[$i]['dept']." and isActive='1' and post='Manager'");
              $getdeptallstaffoverdue=selectQuery(SUPPORTSTAFF,"*","department=".$checkallreq[$i]['dept']." and isActive='1' and post='Staff'");
              $assignedstaffoverdue=selectQuery(SUPPORTSTAFF,"*","emp_id=".$checkallreq[$i]['assigned_staff']);
               $deptoverdue=selectQuery(SUPPORTDEPT,"*","dept_id=".$checkallreq[$i]['dept']);
               if($supportmail[0]['overdue_tkt']==1)
                {
                      $headersover  = 'MIME-Version: 1.0' . "\r\n";
                        $headersover .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headersover .= "From:".SITENAME."<".EMAIL_SENDER.">";
                        $subjectover="Overdue Ticket Alert - ".$checkallreq[$i]['contact_request_id'];


                       if($supportmail[0]['overdue_tkt_admin']==1)
                        {
                           $emailover =EMAIL_SENDER;
                            $bodyover='<hr style="margin-bottom:50px"> <div style="width: 70%;margin:0 auto">

                            <div style="margin: 0 auto;text-align: center"><img src="'.SITEURL.'/img/projectimage/logo.png" alt="" /></div>

                            <p>Dear Admin,<br><br>
                                <p style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                    A ticket #'.$checkallreq[$i]['contact_request_id'].'  assigned to you or in your department is seriously overdue.  </p>
                                     <p style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                            We should all work hard to guarantee that all tickets are being addressed in a timely manner. Enough baby talk...please address the issue or you will hear from me again.
                                     </p>
                                    <p align="left" style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                          For reference the ticket details are as follows -
                                                  <table width="100%" style="border-collapse:collapse;border-spacing:0;margin:10px auto;border-style:none;border-width:0;margin-left:10px;">
                                                     <tr>
                                                         <td style="width:25%">Ticket ID</td>
                                                         <td>=</td>
                                                         <td>'.$checkallreq[$i]['contact_request_id'].'</td>
                                                     </tr>

                                                     <tr>
                                                         <td>Date Created</td>
                                                         <td>=</td>
                                                          <td>'.$checkallreq[$i]['date'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Due Date</td>
                                                         <td>=</td>
                                                          <td>'.$checkallreq[$i]['overdue_date'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Department</td>
                                                         <td>=</td>
                                                         <td>'.$deptoverdue[0]['dept_name'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Assigned Staff</td>
                                                         <td>=</td>
                                                         <td>'.$assignedstaffoverdue[0]['emp_name'].'</td>
                                                     </tr>
                                                 </table>

                               </p>
                           </p>
                            </div>';
                             $sentmailover1 = mail($emailover, $subjectover, $bodyover, $headersover);
                        }
                        if($supportmail[0]['overdue_tkt_mgr']==1)
                        {
                             $emailover =$getdeptmgroverdue[0]['emp_email'];
                             $bodyover='<hr style="margin-bottom:50px"> <div style="width: 70%;margin:0 auto">

                            <div style="margin: 0 auto;text-align: center"><img src="'.SITEURL.'/img/projectimage/logo.png" alt="" /></div>

                            <p>Dear '.$getdeptmgroverdue[0]['emp_name'].',<br><br>
                                <p style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                    A ticket #'.$checkallreq[$i]['contact_request_id'].'  assigned to you or in your department is seriously overdue.  </p>
                                     <p style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                            We should all work hard to guarantee that all tickets are being addressed in a timely manner. Enough baby talk...please address the issue or you will hear from me again.
                                     </p>
                                    <p align="left" style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                          For reference the ticket details are as follows -
                                                  <table width="100%" style="border-collapse:collapse;border-spacing:0;margin:10px auto;border-style:none;border-width:0;margin-left:10px;">
                                                     <tr>
                                                         <td style="width:25%">Ticket ID</td>
                                                         <td>=</td>
                                                         <td>'.$checkallreq[$i]['contact_request_id'].'</td>
                                                     </tr>

                                                     <tr>
                                                         <td>Date Created</td>
                                                         <td>=</td>
                                                          <td>'.$checkallreq[$i]['date'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Due Date</td>
                                                         <td>=</td>
                                                          <td>'.$checkallreq[$i]['overdue_date'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Department</td>
                                                         <td>=</td>
                                                         <td>'.$deptoverdue[0]['dept_name'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Assigned Staff</td>
                                                         <td>=</td>
                                                         <td>'.$assignedstaffoverdue[0]['emp_name'].'</td>
                                                     </tr>
                                                 </table>

                               </p>
                           </p>
                            </div>';
                             $sentmailover2 = mail($emailover, $subjectover, $bodyover, $headersover);
                        }
                        if($supportmail[0]['overdue_tkt_staff']==1)
                        {
                            $staffemailoverdue=array();
                            for($j=0;$j<count($getdeptallstaffoverdue);$j++)
                            {

                               $emailover=$getdeptallstaffoverdue[$j]['emp_email'];
                               $bodyover='<hr style="margin-bottom:50px"> <div style="width: 70%;margin:0 auto">

                            <div style="margin: 0 auto;text-align: center"><img src="'.SITEURL.'/img/projectimage/logo.png" alt="" /></div>

                            <p>Dear '.$getdeptallstaffoverdue[$j]['emp_name'].',<br><br>
                                <p style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                    A ticket #'.$checkallreq[$i]['contact_request_id'].'  assigned to you or in your department is seriously overdue.  </p>
                                     <p style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                            We should all work hard to guarantee that all tickets are being addressed in a timely manner. Enough baby talk...please address the issue or you will hear from me again.
                                     </p>
                                    <p align="left" style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                          For reference the ticket details are as follows -
                                                  <table width="100%" style="border-collapse:collapse;border-spacing:0;margin:10px auto;border-style:none;border-width:0;margin-left:10px;">
                                                     <tr>
                                                         <td style="width:25%">Ticket ID</td>
                                                         <td>=</td>
                                                         <td>'.$checkallreq[$i]['contact_request_id'].'</td>
                                                     </tr>

                                                     <tr>
                                                         <td>Date Created</td>
                                                         <td>=</td>
                                                          <td>'.$checkallreq[$i]['date'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Due Date</td>
                                                         <td>=</td>
                                                          <td>'.$checkallreq[$i]['overdue_date'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Department</td>
                                                         <td>=</td>
                                                         <td>'.$deptoverdue[0]['dept_name'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Assigned Staff</td>
                                                         <td>=</td>
                                                         <td>'.$assignedstaffoverdue[0]['emp_name'].'</td>
                                                     </tr>
                                                 </table>

                               </p>
                           </p>
                            </div>';
                              $sentmailover3 = mail($emailover, $subjectover, $bodyover, $headersover);
                            }
                        }
                }
          }
     }
     }
      /* **************************************************************************************************************************************************************** */




    $date1=date("Y-m-d");
    $date2=date('Y-m-d', strtotime("+1 days"));

    $dayapp1=selectQuery(AGR,"*","biometric_appointement_date like '%".$date1."%' and isDel='0'");
    $dayapp2=selectQuery(AGR,"*","biometric_appointement_date like '%".$date2."%' and isDel='0'");

    $todaylist="";
    $tomorrowlist="";

    for($i=0;$i<count($dayapp1);$i++)
    {
        $user=$dayapp1[$i]['agree_by'];
        $userdata=selectQuery(WEB_USER,"*","u_id=".$user);
        $todaylist=$todaylist."
".$userdata[0]['u_fname']." ".$userdata[0]['u_lname']. " - ".$userdata[0]['u_mobile']." (".date("h:i a",strtotime($dayapp1[$i]['biometric_appointement_date'])).")";

         $sms="Rent Agreement Appointment Reminder-#".$dayapp1[$i]['agreement_no']."
Date-".date("d M Y h:i a",strtotime($dayapp1[$i]['biometric_appointement_date']))."
KYC Documents of all Landlord(s) & Tenant(s)- Aadhar, PAN, Light Bill
Any Change Call-".ADMINNO; "Regards,
Maha-E-Seva.com Team
92727 82424
www.mahaeseva.com
"
             if(SMS_SYSTEM=="ON")
             {
                    $resp= sendsms($userdata[0]['u_mobile'],$sms,WORKINGKEY,SMS_SENDER,"1207162564906638366");
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
    }

     for($i=0;$i<count($dayapp2);$i++)
    {
         $user=$dayapp1[$i]['agree_by'];
        $userdata=selectQuery(WEB_USER,"*","u_id=".$user);
         $tomorrowlist=$tomorrowlist."
".$userdata[0]['u_fname']." ".$userdata[0]['u_lname']. " - ".$userdata[0]['u_mobile']." (".date("h:i a",strtotime($dayapp2[$i]['biometric_appointement_date'])).")";

          $sms="Rent Agreement Appointment Reminder-#".$dayapp2[$i]['agreement_no']."
Date-".date("d M Y h:i a",strtotime($dayapp2[$i]['biometric_appointement_date']))."
KYC Documents of all Landlord(s) & Tenant(s)-Aadhar, PAN, Light Bill
Any Change Call-".ADMINNO;
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
    }


          /************************************************ SMS to admin ****************************************/

    if(count($dayapp1))
    {
             $sms1="Admin, Following Bio-Appts for today -
".$todaylist;

             if(SMS_SYSTEM=="ON")
             {
                    $resp1= sendsms(ADMINNO,$sms1,WORKINGKEY,SMS_SENDER,"1207162564927888476");
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
    }

     if(count($dayapp2))
    {
             $sms1="Admin, Following Bio-Appts for tomorrow  -
".$tomorrowlist;

             if(SMS_SYSTEM=="ON")
             {
                    $resp1= sendsms(ADMINNO,$sms1,WORKINGKEY,SMS_SENDER, "1207162634159791372");
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
    }



 /* ********************************************** CHECK FOR TICKET OVERDUE  **************************************************************************************************** */
  $checkallreq=selectQuery(CONTACT,"*","isOverdue='0' and overdue_date<='".date("Y-m-d H:i:s")."'");

 if(count($checkallreq))
 {
      $data=array(
      "status"=>"Overdue",
      "isOverdue"=>"1"
     );
     for($i=0;$i<count($checkallreq);$i++)
     {
          $updateflag=updateQuery(CONTACT,$data,"req_id=".$checkallreq[$i]['req_id']);
          if($updateflag)
          {
              $getdeptmgroverdue=selectQuery(SUPPORTSTAFF,"*","department=".$checkallreq[$i]['dept']." and isActive='1' and post='Manager'");
              $getdeptallstaffoverdue=selectQuery(SUPPORTSTAFF,"*","department=".$checkallreq[$i]['dept']." and isActive='1' and post='Staff'");
              $assignedstaffoverdue=selectQuery(SUPPORTSTAFF,"*","emp_id=".$checkallreq[$i]['assigned_staff']);
               $deptoverdue=selectQuery(SUPPORTDEPT,"*","dept_id=".$checkallreq[$i]['dept']);
               if($supportmail[0]['overdue_tkt']==1)
                {
                      $headersover  = 'MIME-Version: 1.0' . "\r\n";
                        $headersover .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headersover .= "From:".SITENAME."<".EMAIL_SENDER.">";
                        $subjectover="Overdue Ticket Alert - ".$checkallreq[$i]['contact_request_id'];


                       if($supportmail[0]['overdue_tkt_admin']==1)
                        {
                           $emailover =EMAIL_SENDER;
                            $bodyover='<hr style="margin-bottom:50px"> <div style="width: 70%;margin:0 auto">

                            <div style="margin: 0 auto;text-align: center"><img src="'.SITEURL.'/img/projectimage/logo.png" alt="" /></div>

                            <p>Dear Admin,<br><br>
                                <p style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                    A ticket #'.$checkallreq[$i]['contact_request_id'].'  assigned to you or in your department is seriously overdue.  </p>
                                     <p style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                            We should all work hard to guarantee that all tickets are being addressed in a timely manner. Enough baby talk...please address the issue or you will hear from me again.
                                     </p>
                                    <p align="left" style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                          For reference the ticket details are as follows -
                                                  <table width="100%" style="border-collapse:collapse;border-spacing:0;margin:10px auto;border-style:none;border-width:0;margin-left:10px;">
                                                     <tr>
                                                         <td style="width:25%">Ticket ID</td>
                                                         <td>=</td>
                                                         <td>'.$checkallreq[$i]['contact_request_id'].'</td>
                                                     </tr>

                                                     <tr>
                                                         <td>Date Created</td>
                                                         <td>=</td>
                                                          <td>'.$checkallreq[$i]['date'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Due Date</td>
                                                         <td>=</td>
                                                          <td>'.$checkallreq[$i]['overdue_date'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Department</td>
                                                         <td>=</td>
                                                         <td>'.$deptoverdue[0]['dept_name'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Assigned Staff</td>
                                                         <td>=</td>
                                                         <td>'.$assignedstaffoverdue[0]['emp_name'].'</td>
                                                     </tr>
                                                 </table>

                               </p>
                           </p>
                            </div>';
                             $sentmailover1 = mail($emailover, $subjectover, $bodyover, $headersover);
                        }
                        if($supportmail[0]['overdue_tkt_mgr']==1)
                        {
                             $emailover =$getdeptmgroverdue[0]['emp_email'];
                             $bodyover='<hr style="margin-bottom:50px"> <div style="width: 70%;margin:0 auto">

                            <div style="margin: 0 auto;text-align: center"><img src="'.SITEURL.'/img/projectimage/logo.png" alt="" /></div>

                            <p>Dear '.$getdeptmgroverdue[0]['emp_name'].',<br><br>
                                <p style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                    A ticket #'.$checkallreq[$i]['contact_request_id'].'  assigned to you or in your department is seriously overdue.  </p>
                                     <p style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                            We should all work hard to guarantee that all tickets are being addressed in a timely manner. Enough baby talk...please address the issue or you will hear from me again.
                                     </p>
                                    <p align="left" style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                          For reference the ticket details are as follows -
                                                  <table width="100%" style="border-collapse:collapse;border-spacing:0;margin:10px auto;border-style:none;border-width:0;margin-left:10px;">
                                                     <tr>
                                                         <td style="width:25%">Ticket ID</td>
                                                         <td>=</td>
                                                         <td>'.$checkallreq[$i]['contact_request_id'].'</td>
                                                     </tr>

                                                     <tr>
                                                         <td>Date Created</td>
                                                         <td>=</td>
                                                          <td>'.$checkallreq[$i]['date'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Due Date</td>
                                                         <td>=</td>
                                                          <td>'.$checkallreq[$i]['overdue_date'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Department</td>
                                                         <td>=</td>
                                                         <td>'.$deptoverdue[0]['dept_name'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Assigned Staff</td>
                                                         <td>=</td>
                                                         <td>'.$assignedstaffoverdue[0]['emp_name'].'</td>
                                                     </tr>
                                                 </table>

                               </p>
                           </p>
                            </div>';
                             $sentmailover2 = mail($emailover, $subjectover, $bodyover, $headersover);
                        }
                        if($supportmail[0]['overdue_tkt_staff']==1)
                        {
                            $staffemailoverdue=array();
                            for($j=0;$j<count($getdeptallstaffoverdue);$j++)
                            {

                               $emailover=$getdeptallstaffoverdue[$j]['emp_email'];
                               $bodyover='<hr style="margin-bottom:50px"> <div style="width: 70%;margin:0 auto">

                            <div style="margin: 0 auto;text-align: center"><img src="'.SITEURL.'/img/projectimage/logo.png" alt="" /></div>

                            <p>Dear '.$getdeptallstaffoverdue[$j]['emp_name'].',<br><br>
                                <p style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                    A ticket #'.$checkallreq[$i]['contact_request_id'].'  assigned to you or in your department is seriously overdue.  </p>
                                     <p style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                            We should all work hard to guarantee that all tickets are being addressed in a timely manner. Enough baby talk...please address the issue or you will hear from me again.
                                     </p>
                                    <p align="left" style="text-align:left;vertical-align:baseline;margin-top:0;margin-right:0;margin-bottom:1.3em;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                          For reference the ticket details are as follows -
                                                  <table width="100%" style="border-collapse:collapse;border-spacing:0;margin:10px auto;border-style:none;border-width:0;margin-left:10px;">
                                                     <tr>
                                                         <td style="width:25%">Ticket ID</td>
                                                         <td>=</td>
                                                         <td>'.$checkallreq[$i]['contact_request_id'].'</td>
                                                     </tr>

                                                     <tr>
                                                         <td>Date Created</td>
                                                         <td>=</td>
                                                          <td>'.$checkallreq[$i]['date'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Due Date</td>
                                                         <td>=</td>
                                                          <td>'.$checkallreq[$i]['overdue_date'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Department</td>
                                                         <td>=</td>
                                                         <td>'.$deptoverdue[0]['dept_name'].'</td>
                                                     </tr>
                                                     <tr>
                                                         <td>Assigned Staff</td>
                                                         <td>=</td>
                                                         <td>'.$assignedstaffoverdue[0]['emp_name'].'</td>
                                                     </tr>
                                                 </table>

                               </p>
                           </p>
                            </div>';
                              $sentmailover3 = mail($emailover, $subjectover, $bodyover, $headersover);
                            }
                        }
                }
          }
     }


 }
  /* **************************************************************************************************************************************************************** */


?>