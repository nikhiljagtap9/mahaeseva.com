<?php include("../../includes/configuration.php");
$allin = selectQuery(ORDER ." as o LEFT JOIN ".PACKING." as p on o.final_order=p.order_id LEFT JOIN ".SHIPPING." as s on o.final_order=s.order_id LEFT JOIN ".WEB_USER." as u on o.user_id=u.u_id LEFT JOIN ".DELIVERY_ADR." as addr on o.shipping_addr_id=addr.adr_id","*","o.final_order='".$_REQUEST['order_id']."'");
$prod_list = $allin[0]['inv_id']; $qty_list = $allin[0]['quantity']; $per_price = $allin[0]['per_price']; $arr = explode(",",$prod_list); $arr1 = explode(",",$qty_list); $arr2 = explode(",",$per_price);
/* $inv = selectQuery(INV,"*","inv_no=".$_REQUEST['order_id']);
$prod = selectQuery(PROD,"*","prod_id=".$inv[0]['prod_id']);
$sub = selectQuery(SUB,"*");
if(count($sub)){
    for($i=0;$i<count($sub);$i++){
        $protable = selectQuery($sub[$i]['table_name'],"*","product_name='".$prod[0]['prod_name']."'");
        if(count($protable)){
            $mst = selectQuery(MSTPROD,"*","prod_mod_id=".$protable[0]['prod_id']." and prod_table='".$sub[$i]['table_name']."'");
            $img = selectQuery(MOD_IMG,"*","mod_id=".$mst[0]['mp_id']." limit 1");
        }
    }
}*/
?>
<div class="ordertable">
     <div class="row">
         <div class="col-md-6">
            <div class="row list-view">
               <div class="col-md-4"><b>Order ID</b></div>
               <div class="col-md-8"><?php echo $allin[0]['final_order']; ?></div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="row list-view">
               <div class="col-md-4"><b>Order Date</b></div>
               <div class="col-md-8"><?php echo $allin[0]['payment_date']; ?></div>
            </div>
         </div>
     </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row list-view">
                <div class="col-md-4"><b>Customer Name</b></div>
                <div class="col-md-8"><?php echo $allin[0]['u_name']; ?></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row list-view">
                <div class="col-md-4"><b>Mobile No.</b></div>
                <div class="col-md-8"><?php echo $allin[0]['u_mobile']; ?></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row list-view">
                <div class="col-md-4"><b>Shipping Address</b></div>
                <div class="col-md-8"><?php echo $allin[0]['address'].", ".$allin[0]['landmark'].", ".$allin[0]['city'].", ".$allin[0]['state']." - ".$allin[0]['pincode']."<br>".$allin[0]['mobile']; ?></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row list-view">
                <div class="col-md-4"><b>Shipping Charges</b></div>
                <div class="col-md-8"><?php if($allin[0]['totalshipping'])echo $allin[0]['totalshipping']; else echo "-"; ?></div>
            </div>
        </div>
     </div>
     <div class="row">
         <div class="col-md-6">
            <div class="row list-view">
               <div class="col-md-4"><b>Total Amount</b></div>
               <div class="col-md-8"><?php echo $allin[0]['final_amount']." /-"; ?></div>
            </div>
         </div>
        <div class="col-md-6">
            <div class="row list-view">
                <div class="col-md-4"><b>Coupon Applied</b></div>
                <div class="col-md-8">
                <?php if($allin[0]['coupon']!=""||$allin[0]['coupon']!=0){
                    $getcpnname = selectQuery(MSTCPN,"*","mc_id=".$allin[0]['coupon']);
                    $a = selectQuery($getcpnname[0]['cpn_table'],"*","cpn_id=".$getcpnname[0]['cpn_id']);
                    if($a){ echo $a[0]['cpn_name']; $appliedcoupon=$allin[0]['coupon']; }
                    else{ echo "-"; }
                } ?>
                </div>
            </div>
        </div>
     </div>
</div>
<hr>
<div class="panel-title">Item List</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead><tr><th></th><th class="text-left w1">Item </th><th>Processing</th><th>Shipping</th><th>Delivery</th></tr></thead>
        <tbody>
            <?php for($j=1;$j<=sizeOf($arr);$j++){
            $cnt = $j-1; $proddata = selectQuery(INV." as inv LEFT JOIN ".PROD." as prod ON inv.prod_id = prod.prod_id","*","inv_no=".$arr[$cnt]);
            $sub=selectQuery(SUB,"*");
            if(count($sub)){
                for($i=0;$i<count($sub);$i++){
                    $protable = selectQuery($sub[$i]['table_name'],"*","product_name='".$proddata[0]['prod_name']."'");
                    if(count($protable)){
                        $mst = selectQuery(MSTPROD,"*","prod_mod_id=".$protable[0]['prod_id']." and prod_table='".$sub[$i]['table_name']."'");
                        $img = selectQuery(MOD_IMG,"*","mod_id=".$mst[0]['mp_id']." ORDER BY img_id ASC LIMIT 1");
                    }
                }
            } ?>
            <tr>
            <td><img src="<?php echo SITEURL; ?>/img/modelimg/<?php echo $img[0]['img_name']; ?>" class="brandThumb" class="img-responsive" alt="proimage"></td>
            <td class="text-left"><b class="dred"><?php echo $proddata[0]['prod_name']; ?></b>
            <br><b>Seller : </b> <?php echo $proddata[0]['pur_from']; ?> <br><b>Qty : </b><?php echo $arr1[$cnt]; ?>
            <br><b>Amount : </b><?php
            if($allin[0]['coupon']!=""||$allin[0]['coupon']!=0){
                $cpndetails = selectQuery(COMBO1,"*","cpn_id=".$allin[0]['coupon']." and prod_id=".$arr[$cnt]);
                if(count($cpndetails)){      
                    $master = selectQuery(MSTCPN,"*","mc_id=".$allin[0]['coupon']);
                    $cpnname = selectQuery($master[0]['cpn_table'],"*","cpn_id=".$master[0]['cpn_id']); ?>
                    <span class="midline mt5 red" ><i class="fa fa-inr"></i><?php echo $arr2[$cnt]*$arr1[$cnt]." /-"; ?></span><br>
                    <? if($allin[0]['ord_type']=="buy"){
                        $price = ($arr2[$cnt]*$arr1[$cnt])-($allin[0]['total_saving']*$arr1[$cnt]);
                        $save = $allin[0]['total_saving']*$arr1[$cnt];
                    } else{
                        $price = ($arr2[$cnt]*$arr1[$cnt])-($allin[0]['total_saving']*$arr1[$cnt]);
                        $save = $allin[0]['total_saving']*$arr1[$cnt];
                    }
                    echo "<i class='fa fa-inr'></i>".$price." /-<br>";
                    echo "<span class='green'><b>Saved</b>= <i class='fa fa-inr'></i>".$save." /-</span><br>";
                    echo "<span class='green'>Promo code applied=".$cpnname[0]['cpn_name']."</span>";
                } else{ ?> <i class="fa fa-inr"></i> <? echo $price= $arr2[$cnt]*$arr1[$cnt]." /-"; }
            } else{ ?> <i class="fa fa-inr"></i> <? echo $price= $arr2[$cnt]*$arr1[$cnt]." /-"; } ?>
            </td>
            <?php $packing = selectQuery(PACKING,"*","order_id='".$_REQUEST['order_id']."' AND inventory=".$arr[$cnt]);
            $shipping = selectQuery(SHIPPING,"*","packing_id='".$packing[0]['packing_id']."'"); ?>
            <td align="center"><?php if($packing[0]['packed']=='1'){ ?>
            <i class="fa fa-check green" ></i><span class="green"></span><br>
            <? } else{ ?> <span class="orange1">In Progress</span><? } ?></td>
            <td><?php if(count($shipping)==0){ ?><i class="fa fa-times red"></i>
            <? } else{
            if($shipping[0]['shipped_date']!=''){ ?>
            <i class="fa fa-check green"></i><span class="green">Dispatched</span><br>
            <? echo $shipping[0]['shipped_date']; /* ."<br>Docket:".$shipping[0]['docket_no'];   ;  */ }
            else{ ?><span class="orange1">In Progress</span>
            <? } } ?></td>
            <td>
            <?php if(count($shipping)==0||$shipping[0]['shipped_date']==''){ ?>
            <i class="fa fa-times red"></i>
            <? } else{
            if($shipping[0]['delivered_on']!=''){ ?>
            <i class="fa fa-check green" ></i><span class="green">Delivered</span><br>
            <? echo $shipping[0]['delivered_on'];/*."<br> Delivered_By:".$shipping_stat[0]['shipped_by'];*/
            /* echo $shipping_stat[0]['delivered_on']."<br> Delivered_By:".$shipping_stat[0]['shipped_by'];*/
            } else if($shipping[0]['shipped_date']!=''&&$shipping[0]['delivered_on']==''){ ?>
            <span class="orange1">In Progress</span>
            <? } else{ ?><i class="fa fa-times red" ></i>
            <? } } ?>
            </td>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>