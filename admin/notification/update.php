<?php include("../../includes/configuration.php");
$n_id = $_REQUEST['n_id']; $name = $_REQUEST['name']; $message = $_REQUEST['message']; $category = $_REQUEST['category']; 
$data = array( "name"=>$name, "message" => $message,"category" => $category);
$data = updateQuery(NOTIFICATION,$data,"id=".$n_id);
if($data){ echo 1; } else{ echo 0; } ?>