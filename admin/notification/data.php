<?php include("../../includes/configuration.php");
$name = $_REQUEST['name']; $message = $_REQUEST['message']; $category = $_REQUEST['category'];
$result = selectQuery(NOTIFICATION,"*","name='".$name."'");
if( count($result) > 0){ echo 0; }
else{
    $data = array('name'=>$name,'message'=>$message,'category' => $category,'created_on'=> date("d/m/Y H:i:s"), 'isActive'=>'1');
    $insert = insertQuery(NOTIFICATION,$data);
    if($insert){ echo 1; } else{ echo 2; }
} ?>