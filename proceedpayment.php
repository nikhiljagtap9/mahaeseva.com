<?php
include("includes/configuration.php");
$user = $_SESSION['reguser'];
$segment = $path_info['call_parts'][1];
$txnid = $path_info['call_parts'][2];
$agree = base64_decode($segment);
if($user==""||$agree==""){?><script>window.location="<?php echo SITEURL; ?>";</script><? }
$agrdata = selectQuery(AGR,"*","agreement_no='".$agree."'");
$userdata=selectQuery(WEB_USER,"*","u_id=".$user);
?>
<style>#overlay {
position: fixed; /* Sit on top of the page content */
display: none; /* Hidden by default */
width: 100%; /* Full width (cover the whole page) */
height: 100%; /* Full height (cover the whole page) */
top: 0;left: 0;right: 0;bottom: 0;
background-color: rgba(0,0,0,0.5); /* Black background with opacity */
z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
cursor: pointer; /* Add a pointer on hover */
}
.loader {
border: 16px solid #f3f3f3;
border-radius: 50%;
border-top: 16px solid #3498db;
width: 60px; height: 60px;
-webkit-animation: spin 2s linear infinite; /* Safari */
animation: spin 2s linear infinite;
display:table-cell;vertical-align:middle;
left:0;right:0;top:0;bottom:0; margin:auto;position:absolute
}

/* Safari */
@-webkit-keyframes spin {0% { -webkit-transform: rotate(0deg); }100% { -webkit-transform: rotate(360deg); }}

@keyframes spin {0% { transform: rotate(0deg); }100% { transform: rotate(360deg); }}
</style>
<?
include 'razorpay-php/Razorpay.php';
//use Razorpay\Api\Api;

$api = new Razorpay\Api\Api(RAZORAPIKEY, RAZORSECRETE);
$orderData = [
'receipt'         => txnid,
'amount'          => $agrdata[0]['total_charges'] * 100, // 2000 rupees in paise
'currency'        => 'INR',
'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];

if($razorpayOrderId){
$orddata=array("transaction_id"=>$razorpayOrderId);
updateQuery(PAYMENT,$orddata,"transaction_id='".$txnid."'");
}
$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $agrdata[0]['total_charges'];

if ($displayCurrency !== 'INR')
{
$url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
$exchange = json_decode(file_get_contents($url), true);

$displayAmount = $exchange['rates'][$displayCurrency] * $agrdata[0]['total_charges'] / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
$checkout = $_GET['checkout'];
}

$data = [
"key"               => RAZORAPIKEY,
"amount"            => $agrdata[0]['total_charges'],
"name"              => SITENAME,
"description"       => "Purchase",
"image"             => SITEURL."/img/projectimage/logo.png",
"prefill"           => [
"name"              => $userdata[0]['u_fname']." ".$userdata[0]['u_lname'],
"email"             => $userdata[0]['u_email'],
"contact"           =>$userdata[0]['u_mobile'] ,
],
"notes"             => ["address" => ""],
"theme"             => [
"color"             => "#F37254"
],
"order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR'){
$data['display_currency']  = $displayCurrency; $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("razorpay_checkout/manual.php");
?><script> document.getElementById('transaction_id').value = "<?php echo $razorpayOrderId; ?>"; 
document.getElementById('agreement_id').value = "<?php echo $agree; ?>";    </script><?
?>
<div id="overlay">
<div class="loader"></div>
</div>
<script> document.getElementById("overlay").style.display = "block";         </script>