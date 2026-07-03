<?php

include("includes/configuration.php");
$user = $_SESSION['reguser'];

$userdata = selectQuery(WEB_USER, "*", "u_id=" . $user);
$status = $_POST["status"];
$firstname = $_POST["firstname"];
$amount = $_POST["amount"];
$txnid = $_POST["txnid"];
$posted_hash = $_POST["hash"];
$key = $_POST["key"];
$productinfo = $_POST["productinfo"];
$email = $_POST["email"];
$invid = $_POST["udf1"];
$status1 = $_POST['unmappedstatus'];
$error = $_POST['error'];
$salt = SALT;
$orderid = $invid;
if (isset($_POST["additionalCharges"])) {
  $additionalCharges = $_POST["additionalCharges"];
  $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
} else {
  $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
}
$hash = hash("sha512", $retHashSeq);

if ($error != "E000" && $status != "success") {
  echo "Invalid Transaction. Please try again";
} else {


  $data = array(
    'isPaid' => '1',
    'last_payment_status' => ucfirst($status),
    'last_payment_date' => date("Y-m-d H:i:s")
  );
  $query = updateQuery(AGR, $data, "agreement_no='" . $orderid . "'");

  $paydata = array(
    'transaction_status' => ucfirst($status),
    'transaction_payment_gateway_status' => ucfirst($status1),
    'transaction_date' => date("Y-m-d H:i:s")
  );
  $updatepay = updateQuery(PAYMENT, $paydata, "transaction_id='" . $txnid . "'");

  $agrdata = selectQuery(AGR, "*", "agreement_no='" . $orderid . "'");

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= "From:" . SITENAME . "<" . EMAIL_SENDER . ">";
  $subject = "Agreement -" . $orderid;
  $body = '<hr style="margin-bottom:50px">
               <div style="width: 100%;margin:0 auto;padding:25px;border-radius:20px;border:1px solid #ddd;">

            <div style="margin: 0 auto;text-align: left"><img src="' . SITEURL . '/img/projectimage/logo.png" alt="" /></div>

            <p>Dear ' . $userdata[0]['u_fname'] . ' ' . $userdata[0]['u_lname'] . ',<br><br>
            Thank you for regsitering your Online Rent Agreement on <a href="' . SITEURL . '">' . SITEURL . '</a>
            Agreement No - ' . $orderid . '
            Bio-Metric Appointment - ' . date("d M Y h:i a", strtotime($agrdata[0]['biometric_appointement_date'])) . '
              <hr style="color:#ddd">

              <div style="margin-top:10px">
                <b>please login to your account for more details <a href="' . SITEURL . '">' . SITEURL . '</a>? </b>
             </div>

            <div style="margin-top:10px">
                  With Regards,<br>
                  Team ' . SITENAME . '
             </div>';
  $sentmail = mail($email, $subject, $body, $headers);

  $headers1  = 'MIME-Version: 1.0' . "\r\n";
  $headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers1 .= "From:" . SITENAME . "<" . EMAIL_SENDER . ">";
  $subject1 = "Agreement Received:" . $orderid;
  $body1 = ' <hr style="margin-bottom:50px"><div style="width: 90%;margin:0 auto;padding:25px;border-radius:20px;border:1px solid #ddd">

            <div style="margin: 0 auto;text-align: left"><img src="' . SITEURL . '/img/projectimage/logo.png" alt="" /></div>

            <p>Dear Admin<br>
               Agreement received with following details -</p>
                <p>
               Client Details- <br>
             </p>
             <table cellpadding="10" cellspacing="0">

                     <tr>
                      <td>Client Name</td>
                        <td>' . $userdata[0]['u_fname'] . ' ' . $userdata[0]['u_lname'] . '</td>
                    </tr>
                     <tr class="total">
                        <td>Mobile No</td>
                          <td>' . $userdata[0]['u_mobile'] . ' </td>
                     </tr>
                    <tr>
                      <td>Email ID</td>
                        <td>' . $userdata[0]['u_email'] . '</td>
                    </tr>

                  </table>
             <p>
               Payment Details- <br>
             </p>
             <table cellpadding="10" cellspacing="0">
                     <tr>
                      <td>Agreement No</td>
                        <td>' . $orderid . '</td>
                    </tr>
                    <tr>
                      <td>Appointment Date</td>
                      <td>' . date("d M Y h:i a", strtotime($agrdata[0]['biometric_appointement_date'])) . '</td>
                    </tr>
                     <tr class="total">
                        <td>Transaction Id</td>
                          <td>' . $txnid . ' </td>
                     </tr>
                     <tr class="total">
                        <td>Total Paid</td>
                          <td>' . $amount . ' /- (Online)</td>
                     </tr>
                     <tr class="total">
                        <td>Payment Date</td>
                          <td>' . date("d-m-Y") . '</td>
                     </tr>
                  </table>
            <div>

                <hr style="color:#ddd">

            </div>
            </div>';

  $sentmail2 = @mail(EMAIL_ORDER, $subject1, $body1, $headers1);


  $sms =  "Dear " . $userdata[0]['u_fname'] . " " . $userdata[0]['u_lname'] . ",
Thank you for registering your Online Rent Agreement on Maha-E-Seva.com
Agreement No - " . $orderid . "
Bio-Metric Appointment - " . date("d M Y h:i a", strtotime($agrdata[0]['biometric_appointement_date'])) . "

Regards,
Maha-E-Seva.com Team";


  if (SMS_SYSTEM == "ON") {
    $resp = sendsms($userdata[0]['u_mobile'], $sms, WORKINGKEY, SMS_SENDER, "1207162399964819412");
    $id = (unserialize($resp));
    $msid = $id['data']['0']['id'];
    $status = $id['data']['0']['status'];
    $datasms = array(
      "msg_id" => $msid,
      "msg_type" => "Agreement Received",

      "mobile_no" => $userdata[0]['u_mobile'],
      "message" => $sms,
      "date" => date("Y-m-d H:i:s"),
      "status" => $status
    );
    $store = insertQuery(SMS, $datasms);
  }
  /************************************************ SMS to admin ****************************************/

  $sms1 = "Dear Admin,
New Online Rent Agreement from Web
#" . $orderid . "
Bio - " . date("d M Y h:i a", strtotime($agrdata[0]['biometric_appointement_date'])) . "
" . $userdata[0]['u_fname'] . " " . $userdata[0]['u_lname'] . "
Payment - " . $amount . " (Online)
          
Regards,
maha-e-seva.com team";

  if (SMS_SYSTEM == "ON") {
    $resp1 = sendsms(ADMINNO, $sms1, WORKINGKEY, SMS_SENDER, "1207162342971467471");
    $id1 = (unserialize($resp1));
    $msid1 = $id1['data']['0']['id'];
    $status1 = $id1['data']['0']['status'];
    $datasms1 = array(
      "msg_id" => $msid1,
      "msg_type" => "Agreement Received",

      "mobile_no" => ADMINNO,
      "message" => $sms1,
      "date" => date("Y-m-d H:i:s"),
      "status" => $status
    );
    $store1 = insertQuery(SMS, $datasms1);
  }

  $path = SITEURL . "/paymentsuccess/" . base64_encode($invid);
?>
  <script>
    var x = '<?php echo $path; ?>';
    window.location.assign(x);
  </script>
<?php
}
?>