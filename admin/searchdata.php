<?php include("../includes/configuration.php");

if($action == "search"){
$search = $_REQUEST['search'];
if($search!=""){
    
    $where="A.isDel='0' AND (A.agreement_no like '%".$search."%' || A.govt_token_no like '%".$search."%'  || A.prop_locality like '%".$search."%'  || A.prop_village like '%".$search."%' || U.u_fname like '%".$search."%' || U.u_lname like '%".$search."%' || L.landlord_name like '%".$search."%' || L.landlord_contact_no like '%".$search."%' || L.landlord_email like '%".$search."%' || L.landlord_pan_no like '%".$search."%'  || L.landlord_aadhaar_no like '%".$search."%' || T.tenent_name like '%".$search."%' || T.tenent_contact_no like '%".$search."%' || T.tenent_email like '%".$search."%' || T.tenent_pan_no like '%".$search."%'  || T.tenent_aadhaar_no like '%".$search."%') group by A.agreement_no";
    $fields="A.agree_id,A.agreement_no,A.govt_token_no,A.starting_from,A.end_to,U.u_fname,U.u_lname,U.u_mobile"; 
   $agreement = selectQuery(AGR." as A LEFT JOIN ".WEB_USER." as U on A.agree_by=U.u_id LEFT JOIN ".AGR_LANDLORD." as L on A.agreement_no=L.agreement_no LEFT JOIN ".AGR_TENENT." as T on A.agreement_no=T.agreement_no",$fields,$where); 
 ?>
    <div class="table-responsive">
        <table class="usert table table-bordered mt-3 mb-0">
            <thead><tr><th>#</th><th>Agreement No</th><th>Entry By</th><th>Agreement Duration</th><th>Landlord's</th><th>Tenent's</th></tr></thead>
            <tbody>
                <?php 
                if(count($agreement)){
                for($i=0;$i<count($agreement);$i++){ $row=$agreement[$i];
                    $tenentarr=array(); $landlordarr=array();
                    $landlord = selectQuery(AGR_LANDLORD,"landlord_name","agreement_no='".$row['agreement_no']."'"); $tenents = selectQuery(AGR_TENENT,"tenent_name","agreement_no='".$row['agreement_no']."'");  
                    for($t=0;$t<count($tenents);$t++){ array_push($tenentarr,$tenents[$t]['tenent_name']);}
                    for($t=0;$t<count($tenents);$t++){ array_push($landlordarr,$landlord[$t]['landlord_name']);}
                    ?>
                <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><a href="<?=ADMINURL; ?>agreement/agreementdetails.php?agr=<?=base64_encode($row['agreement_no']);?>" target="blank"><?=$row['agreement_no']; ?></a></td>
                    <td><?=$row['u_fname'].' '.$row['u_lname']; ?></td>
                    <td><?=date("d M Y",strtotime($row['starting_from'])).' TO '.date("d M Y",strtotime($row['end_to'])); ?></td>
                    <td><?=implode("<br>",$landlordarr); ?></td>
                    <td><?=implode("<br>",$tenentarr); ?></td>
                </tr>
                <? } 
                }else{
                    ?><tr><td colspan="6">No Result Found</td></tr><?
                }?>
            </tbody>
        </table>
    </div>
    <? }/*  else if(count($orderdata)){ ?>
    <div class="table-responsive" >
        <table class="display table table-bordered neworder-table">
            <thead><tr><th>#</th><th>Order Date</th><th>Order Id</th> <th>Status</th><th>Sub-Order ID</th><th>Product Details</th><th>Quantity</th></tr></thead>
            <tbody>
                <?php for($j=0;$j<count($orderdata);$j++){
                $cnt = $j+1; ?>
                <tr>
                    <td><?=$cnt; ?></td> 
                    <td><?=date("d M Y h:i A",strtotime($orderdata[$j]['purchase_date'])) ?></td>
                    <td class="text-primary cc-cursor-pointer"><a href="<?php echo ADMINURL ?>order/order_details.php?transid=<?php echo $orderdata[$j]['transaction_id'] ?>"><?php echo $orderdata[$j]['order_id'] ?> </a></td> 
                    <td> <?php  echo $orderdata[$j]['order_current_Status'] ?> </td>
                    <td class="text-primary cc-cursor-pointer" onclick="get_item(<?php echo $orderdata[$j]['item_id'] ?>)"><a> <?=$orderdata[$j]['purchase_order_id']; ?></a></td>
                    <td><?=$orderdata[$j]['display_product_name']; ?><br>
                    <? $variationon = $orderdata[$j]['variation_on'];
                    if($variationon!=""){
                    $variationonarr = explode("|",$variationon); $variativaluearr = explode("|",$orderdata[$j]['variation_values']);
                    for($v=0;$v<count($variationonarr);$v++){ ?><span><?=$variationonarr[$v]; ?> : <?=$variativaluearr[$v]; ?></span><? } } ?>
                    </td>
                    <td><?=$orderdata[$j]['quantity'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } }*/  }
if($action == "date_range_search"){
    $fromdt = date("Y-m-d 00:00:00", strtotime($_REQUEST['fromdt']));
    $todt = date("Y-m-d 23:59:59", strtotime($_REQUEST['todt']) ) ;
    $user_of_currant_month = selectQuery(BUYER,"count(u_id) as u_id","(reg_date between '".$fromdt."' and '".$todt."') ");
    $vendor_of_currant_month = selectQuery(VENDOR,"count(dealer_id) as dealer_id","(insdate between '".$fromdt."' and '".$todt."') ");
    $order_of_currant_month = selectQuery(PURCH,"count(pur_id) as pur_id","(purchase_date  between '".$fromdt."' and '".$todt."') ");
    $resdata = array("user" => $user_of_currant_month[0]['u_id'],"vendor" => $vendor_of_currant_month[0]['dealer_id'],"order" => $order_of_currant_month[0]['pur_id'] );
    echo json_encode($resdata); 
} ?>