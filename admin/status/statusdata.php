<?php include("../../includes/configuration.php");
$status = $_REQUEST['status'];
$result = selectQuery(STATUS,"*","status='".$status."'");
if( count($result) > 0){ echo 0; }
else{
    $data = array('status'=>$status, 'created_on'=> date("d/m/Y H:i:s"), 'isActive'=>'1');
    $insert = insertQuery(STATUS,$data);
    if($insert){ echo 1; } else{ echo 2; }
} ?>