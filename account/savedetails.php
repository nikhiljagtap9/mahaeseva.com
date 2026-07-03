<?php include("../includes/configuration.php");
$ord = $_REQUEST['ord']; $amt = $_REQUEST['amount']; $shipping_chrgs = $_REQUEST['shipping_chrgs']; $shipcharges_commsep = $_REQUEST['shipcharges_commsep'];
if(isset($_REQUEST['quantity'])){
    $data = array('final_amount'=>$amt, 'totalshipping'=>$shipping_chrgs, 'quantity'=>$_REQUEST['quantity'], 'shiping_chrges'=>$shipcharges_commsep);
} else{
    $data = array('final_amount'=>$amt, 'totalshipping'=>$shipping_chrgs, 'shiping_chrges'=>$shipcharges_commsep);
}
$query = updateQuery(ORDER,$data,"order_id='".$ord."'");
if($query){ echo "1"; }
else{ echo "0"; } ?>