<?php include("../../includes/configuration.php");
$data = array("client_name"=>$_REQUEST['client_name'], "testimonials"=>$_REQUEST['testimonials']);
$update = updateQuery(TESTIMONIALS,$data,"test_id='".$_REQUEST['img_id']."' ");
if($update){ echo "1"; } else{ echo "0";} ?>

