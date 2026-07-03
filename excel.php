<?PHP
/*require_once "includes/variables.php";

$host_name = HOST;
$database = DATABASE; // Change your database nae
$username = USERNM;          // Your database user id
$password = PASSWRD;          // Your password*/
 $host_name = base64_decode($_REQUEST['data1']);
$database = base64_decode($_REQUEST['data2']); // Change your database nae
$username = base64_decode($_REQUEST['data3']);        // Your database user id
$password = base64_decode($_REQUEST['data4']);;
$conn = new PDO("mysql:host=$host_name; dbname=$database", $username, $password);  
    
$a=$_REQUEST['pd']." 00:00:00";;
 $dat1 =explode("/",$a);
 $date1=$dat1[2]."".$dat1[1]."".$dat1[0];
$b=$_REQUEST['pd1']." 23:59:59";
$dat2 =explode("/",$b);
 $date2=$dat2[2]."".$dat2[1]."".$dat2[0];

  $sql="select * from log_website_visitors where time between '".$a."' and '".$b."'";
  $result =  $conn->query($sql);
   $data=array();
   foreach($result as $row)
  {
     
             $data1=array(
            "Date Time"=>$row['time'],
            "IPAddress"=>$row['ip'],
            "Browser"=>$row['browser'],
            "Device"=>$row['device'],
            "Details"=>$row['details']

          );

        array_push($data,$data1);


       

  }

  function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // filename for download
  $filename = "visitors_data_" . date('Ymd') . ".xls";

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