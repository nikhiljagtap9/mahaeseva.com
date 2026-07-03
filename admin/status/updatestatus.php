<?php include("../../includes/configuration.php");
$s_id = $_REQUEST['s_id']; $status = $_REQUEST['status']; $data = array( "status"=>$status);
$data = updateQuery(STATUS,$data,"s_id=".$s_id);
if($data){ echo 1; } else{ echo 0; } ?>