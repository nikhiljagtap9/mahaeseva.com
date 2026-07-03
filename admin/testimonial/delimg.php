<?php include("../../includes/configuration.php");
$pid = $_REQUEST['pid'];
$data = array( "isDel"=>"1");
$update = updateQuery(TESTIMONIALS,$data,"test_id='".$pid."' ");
if($update){ echo "1"; } else{ echo "0"; } ?>