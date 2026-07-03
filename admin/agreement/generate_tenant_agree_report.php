<?PHP

$host_name = base64_decode($_REQUEST['data1']);
$database = base64_decode($_REQUEST['data2']); // Change your database nae
$username = base64_decode($_REQUEST['data3']);        // Your database user id
$password = base64_decode($_REQUEST['data4']);;

//$conn = mysqli_connect($host_name,$username,$password);
$conn = new PDO("mysql:host=$host_name; dbname=$database", $username, $password);  

    $sqllandlord="select * from agreement_landlord ";

  
   $result =  $conn->query($sqllandlord);
    $data=array();
  
  
  foreach($result as $row)
    {
        $sqltenant="select * from agreement_tenent where agreement_no='".$row['agreement_no']."' ";
        $result1= $conn->query($sqltenant);
        foreach($result1 as $row1)
            {


            $data1=array(
            "Agreement ID"=>$row['agreement_no'],
            "Owner Name"=>$row['landlord_name'],
            "Owner Number"=>$row['landlord_contact_no'],
            "Owner Email"=>$row['landlord_email'],
            "Owner Address"=>$row['landlord_address'],
            "Tenant Name"=>$row1['tenent_name'],
            "Tenant Number"=>$row1['tenent_contact_no'],
            "Tenant Email"=>$row1['tenent_email'],
            "Rent Property Address"=>$row1['tenent_address']
            );

           }
        array_push($data,$data1);

  }

  function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // filename for download
  $filename = "tenant_report_" . date('Ymd') . ".xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data as $row) {
    if(!$flag) {
      // display field/column names as first row
      echo implode("\t", array_keys($row)) . "\r\n";
      $flag = true;
    }
    array_walk($row, __NAMESPACE__ . '\cleanData');
    echo implode("\t", array_values($row)) . "\r\n";
  }

?>