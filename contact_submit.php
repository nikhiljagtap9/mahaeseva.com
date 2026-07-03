<?php session_start();
include("includes/configuration.php");
$supportmail = selectQuery(SUPPORTEMAIL,"*"); $name = ucwords($_POST['name']); $tele = $_POST['tele']; $cmnt = $_POST['cmnt']; $email = $_POST['email']; $orderid = $_POST['ord']; $deptid = $_POST['dept']; $staff = array(); $staffemails = array();
if($deptid!=""){
    $getdept = selectQuery(SUPPORTDEPT,"*","dept_id=".$deptid);
    $time = $getdept[0]['SLAtime'];
    if($time!=""){
        $a="+".$time." hours";
        $new_time = date("Y-m-d H:i:s",strtotime($a));
    } else{ $new_time =""; }
    $getstaff = selectQuery(SUPPORTSTAFF,"*","department=".$deptid." and isDel='0'");
    for($k=0;$k<count($getstaff);$k++){
        if($getstaff[$k]['emp_name']!=""&&$getstaff[$k]['emp_email']!=""){
            array_push($staff,$getstaff[$k]['emp_name']);
            array_push($staffemails,$getstaff[$k]['emp_email']);
        }
    }
    $dept = $getdept[0]['dept_name'];
    $deptstr = 'For Department - '.$dept.'';
} else{
    $dept = "";
    $deptstr = 'For Department - Not Defined';
}
$staffemaillist = implode(",",$staffemails);
$lastRE = selectQuery(CONTACT,"*","1 order by req_id DESC LIMIT 1");
if(count($lastRE)){
    $reqid = getleadno($lastRE[0]['contact_request_id']);
} else{ $reqid = "000001"; }
$insert = mysql_query($sql,con);
$data = array("tkt_source"=>"Website","contact_request_id"=>$reqid,"Name"=>$name,"Email"=>$email,"Telephone"=>$tele,"Comment"=>addslashes($cmnt),"dept"=>$deptid,"date"=>date("Y-m-d H:i:s"),"overdue_date"=>$new_time,"isOpen"=>'1');
if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){
 echo "2"; } else{
    $last = insertQuery(CONTACT,$data);
    if($last){
        if($supportmail[0]['new_tkt_alert']==1){
            $emailsub =$email;
            if($supportmail[0]['new_tkt_alert_admin']==1){
                $headers1 = 'MIME-Version: 1.0' . "\r\n";
                $headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers1 .= "From:".SITENAME."<".EMAIL_SENDER.">";
                $subject1="Contact Request- ".$reqid;
                $body1='<div style="font-family:calibri;font-size: 16px;">
                <img src="'.SITEURL.'/img/projectimage/logo.png" alt="" />
                <p><b>Dear Admin,</b></p>
                <p style="color:grey;">Following new support ticket is created  '.$deptstr.'- </p>
                <table style="width:100%;">
                <tr>
                <td style="padding: 6px 0;width:30%;"><b>Support Ticket ID</b></td>
                <td style="color:grey;">'.$reqid.'</td>
                </tr>
                <tr>
                <td style="padding: 6px 0;width:30%;"><b>Date &amp; Time</b></td>
                <td style="color:grey;">'.date("d/m/Y H:i:s").'</td>
                </tr>
                <tr>
                <td style="padding: 6px 0;width:30%;"> <b>Name</b> </td>
                <td style="color:grey;">'.$name.'</td>
                </tr>
                <tr>
                <td style="padding: 6px 0;width:30%;"><b>Email (New/Existing)</b></td>
                <td style="color:grey;">'. $email.'</td>
                </tr>
                <tr>
                <td style="padding: 6px 0;width:30%;"><b>Mobile Number</b></td>
                <td style="color:grey;">'. $tele.'</td>
                </tr>
                <tr>
                <td style="padding: 6px 0;width:30%;"><b>Message</b></td>
                <td style="color:grey;">'.$cmnt.'</td>
                </tr>
                </table>
                <p style="color:grey;">Please give quick follow up to this user </p>
                </div>';
                $sentmail = mail(EMAIL_SENDER, $subject1, $body1, $headers1);
            }
            /***send emails to dept manager and staff***/
            if($dept!=""){
                if($supportmail[0]['new_tkt_alert_mgr']==1){
                    $emailmgr = $getdept[0]['dept_manager_email'];
                    $headersmgr = 'MIME-Version: 1.0' . "\r\n";
                    $headersmgr .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headersmgr .= "From:".SITENAME."<".EMAIL_SENDER.">";
                    $subjectmgr = "Support Request- ".$reqid;
                    $bodymgr = '<div style="font-family:calibri;font-size: 16px;">
                    <img src="'.SITEURL.'/img/projectimage/logo.png" alt="" />
                    <p><b>Dear '.$getdept[0]['dept_manager'].',</b></p>
                    <p style="color:grey;">Following new support ticket is created '.$deptstr.'  - </p>
                    <table style="width:100%;">
                    <tr>
                    <td style="padding:6px 0;width:30%;font-family:calibri;"><b>Support Ticket ID</b></td>
                    <td style="color:grey; font-family:calibri;">'.$reqid.'</td>
                    </tr>
                    <tr>
                    <td style="padding:6px 0;width:30%;font-family:calibri;"><b>Date &amp; Time</b></td>
                    <td style="color:grey;font-family:calibri;">'.date("d/m/Y H:i:s").'</td>
                    </tr>
                    <tr>
                    <td style="padding:6px 0;width:30%;font-family:calibri;"> <b>Name</b> </td>
                    <td style="color:grey;font-family:calibri;">'.$name.'</td>
                    </tr>
                    <tr>
                    <td style="padding:6px 0;width:30%;font-family:calibri;"><b>Email (New/Existing)</b></td>
                    <td style="color:grey;font-family:calibri;">'. $email.'</td>
                    </tr>
                    <tr>
                    <td style="padding:6px 0;width:30%;font-family:calibri;"><b>Mobile Number</b></td>
                    <td style="color:grey;font-family:calibri;">'. $tele.'</td>
                    </tr>
                    <tr>
                    <td style="padding:6px 0;width:30%;font-family:calibri;"><b>Message</b></td>
                    <td style="color:grey;font-family:calibri;">'.$cmnt.'</td>
                    </tr>
                    </table>
                    <p style="color:grey;">Please give quick follow up to this user</p>
                    </div>';
                    $sentmailmgr = mail($emailmgr, $subjectmgr, $bodymgr, $headersmgr);
            }
            if($supportmail[0]['new_tkt_alert_members']==1){
                if(sizeOf($staffemails)){
                    $emailstaff = $staffemaillist;
                    $headersstaff = 'MIME-Version: 1.0' . "\r\n";
                    $headersstaff .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headersstaff .= "From:".SITENAME."<".EMAIL_SENDER.">";
                    $subjectstaff = "Support Request- ".$reqid;
                    $bodystaff = '<div style="font-family:calibri;font-size: 16px;">
                    <img src="'.SITEURL.'/img/projectimage/logo.png" alt="" />
                    <p><b>Dear Staff,</b></p>
                    <p style="color:grey;">Following new support ticket is created '.$deptstr.'  - </p>
                    <table style="width:100%;">
                    <tr>
                    <td style="padding:6px 0;width:35%;font-family:calibri;"><b>Support Ticket ID</b></td>
                    <td style="color:grey;font-family:calibri;">'.$reqid.'</td>
                    </tr>
                    <tr>
                    <td style="padding:6px 0;width:35%;font-family:calibri;"><b>Date &amp; Time</b></td>
                    <td style="color:grey;font-family:calibri;">'.date("d/m/Y H:i:s").'</td>
                    </tr>
                    <tr>
                    <td style="padding:6px 0;width:35%;font-family:calibri;"> <b>Name</b> </td>
                    <td style="color:grey;font-family:calibri;">'.$name.'</td>
                    </tr>
                    <tr>
                    <td style="padding:6px 0;width:35%;font-family:calibri;"><b>Email (New/Existing)</b></td>
                    <td style="color:grey;font-family:calibri;">'. $email.'</td>
                    </tr>
                    <tr>
                    <td style="padding:6px 0;width:35%;font-family:calibri;"><b>Mobile Number</b></td>
                    <td style="color:grey;font-family:calibri;">'. $tele.'</td>
                    </tr>
                    <tr>
                    <td style="padding:6px 0;width:35%;font-family:calibri;"><b>Message</b></td>
                    <td style="color:grey;font-family:calibri;">'.$cmnt.'</td>
                    </tr>
                    </table>
                    <p style="color:grey;">Please give quick follow up to this user</p>
                    </div>';
                    $sentmailstaff = mail($emailstaff, $subjectstaff, $bodystaff, $headersstaff);
                }
            }
        }
        if($supportmail[0]['new_tkt_alert_client']==1){
            $headersclient = 'MIME-Version: 1.0' . "\r\n";
            $headersclient .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headersclient .= "From:".SITENAME."<".EMAIL_SENDER.">";
            $subjectclient = "Contact Request- ".$reqid;
            $bodyclient = '<div style="font-family:calibri;font-size: 16px;">
            <img src="' . SITEURL . '/img/projectimage/logo.png" alt="" />
            <p><b>Dear '.$name.',</b></p>
            <p style="color:grey;">Your support ticket bearing ticket ID '.$reqid.' has been assigned to our Customer Happiness Manager for
            further action and we will find a happiness solution to your query in a very short span of time.</p>
            <div><b>Thank you for your cooperation.</b></div>
            <p style="margin-top:5px;color:grey;"> Please do let us know if you have any queries in this regard.</p>
            </div>';
            $sentmail1client = mail($emailsub, $subjectclient, $bodyclient, $headersclient);
        }
    }
    echo 1;
    } else{ echo 0; }
} ?>