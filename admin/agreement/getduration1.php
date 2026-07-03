<?php
 include("../../includes/configuration.php");

 $duration=$_REQUEST['duration'];
 $startdate=$_REQUEST['startdate'];
  $newdate = date ( 'Y-m-d' , strtotime($startdate));
 /*  $effectiveDate = strtotime("+".$duration." months", $newdate);   */
  $effectiveDate = date('Y-m-d', strtotime($newdate . "+".$duration." months") );
  $enddate=date('d-m-Y', strtotime($effectiveDate . "-1 day") ); /* strtotime ( "-1 day", strtotime ( $effectiveDate ) ) ;  */
  echo $enddate;
?>