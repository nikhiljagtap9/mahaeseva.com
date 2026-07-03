<?php
$host_name = base64_decode($_REQUEST['data1']);
$database = base64_decode($_REQUEST['data2']); // Change your database nae
$username = base64_decode($_REQUEST['data3']);        // Your database user id
$password = base64_decode($_REQUEST['data4']);;
$conn = mysqli_connect($host_name,$username,$password);
mysqli_select_db($conn,$database);
$a = $_REQUEST['pd'];$dat1 =explode("/",$a);
$date1 = $dat1[2]."-".$dat1[1]."-".$dat1[0]." 00:00:00";
$b = $_REQUEST['pd1'];$dat2 =explode("/",$b);
$date2 = $dat2[2]."-".$dat2[1]."-".$dat2[0]." 23:59:59";
$c = $_REQUEST['smstype'];
if($c=="All"){$sql="select * from sms_send_details where date between '".$date1."' and '".$date2."'"; }
else{$sql="select * from sms_send_details where msg_type='".$c."' and (date between '".$date1."' and '".$date2."')"; }
$result = mysqli_query($conn,$sql); $data = array();
while($row=mysqli_fetch_array($result)){
    $data1=array( "Date Time"=>$row['date'], "Message Type"=>$row['msg_type'], "User"=>$row['user_name'], "Mobile No"=>$row['mobile_no'], "SMS"=>$row['message'], "Status"=>$row['status'] );
    array_push($data,$data1);
}
function cleanData(&$str){
$str = preg_replace("/\t/", "\\t", $str);
$str = preg_replace("/\r?\n/", "\\n", $str);
if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}
$filename = "smsreport_" . date('Ymd') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
$flag = false;
foreach($data as $row){
    if(!$flag){
    // display field/column names as first row
    echo implode("\t", array_keys($row)) . "\r\n";
    $flag = true;
    }
    array_walk($row, __NAMESPACE__ . '\cleanData');
    echo implode("\t", array_values($row)) . "\r\n";
} ?>