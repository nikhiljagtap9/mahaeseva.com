<?php include("../includes/configuration.php");
  $host_name = HOST;
$database = DATABASE; // Change your database nae
$username = USERNM;          // Your database user id
$password = PASSWRD;
      $user=$_SESSION['reguser'];
      $userdata=selectQuery(WEB_USER,"*","u_id=".$user);
      $allin=selectQuery(ORDER ." as o LEFT JOIN ".WEB_USER." as u on o.user_id=u.u_id LEFT JOIN ".DELIVERY_ADR." as addr on o.shipping_addr_id=addr.adr_id","*","o.final_order='".$_REQUEST['ord']."' and o.user_id=".$user);
      $prod_list=$allin[0]['inv_id'];
      $qty_list=$allin[0]['quantity'];
      $per_price=$allin[0]['per_price'];
       $shipping=$allin[0]['shiping_chrges'];
       $shiparr=explode("&",$shipping);
        $totalshipchrges=$allin[0]['totalshipping'];
      $arr=explode(",",$prod_list);
      $arr1=explode(",",$qty_list);
      $arr2=explode(",",$per_price);
?>

<!doctype html>
<html>
<head>
 <title><?php echo SITE_TITLE; ?> </title>
 <meta charset='UTF-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="keywords" content="<?php echo METAKEYWORDS; ?>"  >
   <meta name="description" content ="<?php echo METADESCRIPTION; ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITEURL; ?>/img/projectimage/favicon1.png">
<?php include '../commoncss.php' ?>


<style>.loadbutton,.msgsrate{text-align:center}.mt{margin-top:0}.bt{margin-bottom:0}.mtm{margin-top:-20px}.mt3{margin-top:3px}.color{color:#A0A0A0}.greentext{color:#23CC31}.msgsrate{color:#fff;margin-top:10px;padding:10px;border-radius:15px;margin-bottom:10px;font-size:12px;display:none}.bx-wrapper .bx-pager{bottom:-95px}.bx-wrapper .bx-pager a{border:1px solid #ccc;display:block;margin:0 5px;padding:3px}.popup table td,.task li{padding:5px}.bx-wrapper .bx-pager a.active,.bx-wrapper .bx-pager a:hover{border:1px solid #5280DD}.bx-wrapper{margin-bottom:20px}.bx-viewport{min-height:350px!important}.fancymain{width:500px}.circleBase{border-radius:50%;behavior:url(PIE.htc)}.task li{border-bottom:1px solid #C9C9C9}.fancybox-inner{width:auto}.order_list{list-style:none}..loadmore{background:red}.printdata{display:none}@media print{.mb20,.w100{text-align:center}a[href]:after{content:none!important}#BrowserPrintDefaults,#ab,#contact,.bg,.cartdetils,.darkblack1,.headmsg,.line1,.logname,.noneed,.orderdetails,.print,.searchinput,.sidebar,.topf,header{display:none}.top-main-area{border-bottom:0!important}img{width:100px!important}.mb20 img{display:inline;width:50%}.w100{width:100%}.printdata{display:block}.mb20{width:15%!important;float:left}}.mt20{margin-top:0!important}.space{margin-top:50px}.cb{color:black}.w96{width: 96%;margin: 0 auto}.w100{width: 100%}  .w20{width: 20%;}   .red{color:red}.green{color:green}.dred{color:#E31837}  .orange1 {color:#CC871E}.white{color:white}
      .cancel:hover
      {
         color:#337ab7;
         text-decoration: underline
      }
      .fieldset{border:1px solid #c3c3c3;margin-top:10px;padding-bottom: 10px}
       .legend {

    display: block;
    font-size: 14px;
    margin-bottom: 7px;
    margin-left: 10px;
    padding: 0 0 0 4px;
    width: auto;
    background-color:#20b2aa;
    color:white;
}
.smallsize{
    font-size: 10px;
}
   .datet  td{
       padding: 1px;
   }
    .space1{
        margin-left: 40px;
        font-size:20px;
    }
      .ordership th{
                   color:white;
      }
       .pt{
           padding-top:24px;
       }
         .pt1{
             padding-top:20px;
         }
         .tlign{
               text-align:right;
           }


          .btn {
              font-weight:normal;
              font-size:13px;
          }
          .pp{
              padding: 5px 15px;
          }

   .cancelationbox
   {
       background:#c3c3c3;font-weight:bold;padding-bottom: 5px;padding-top: 5px;margin-top:10px
   }
   .cancelationdetails
   {
       background:#fff;font-weight:normal;padding-bottom: 5px;padding-top: 5px;display:none;
   }

   .returnbox
   {
       background:#c3c3c3;font-weight:bold;padding-bottom: 5px;padding-top: 5px;margin-top:10px
   }
   .returndetails
   {
       background:#fff;font-weight:normal;padding-bottom: 5px;padding-top: 5px;display:none;
   }

  </style>
</head>

<body>

<?php include '../menu.php' ?>

<div class="container top-area" id="maincontainer">
<div class="row">
<?php include('sidebar.php')?>

<div class="col-md-9 orderdetails">

<div  class="genepdf marginbot15">
             <div class="row">
                <!--<div class="col-md-8 p0">
            <table class="status w100" >

            </table>
            </div>-->


                          <div class="col-md-6 tlign">

                <?php
                    $cancel=selectQuery(cancelation,"*","order_id='".$_REQUEST['ord']."'");
                    if(count($cancel))
                    {
                    }
                    else
                    {

                    }
                     ?>



                 </div>

                 <div  class="col-md-6 tlign"  ><!--<a href="javascript:window.print()" type="button" class="cb"> <i class="fa fa-print" aria-hidden="true"></i> PRINT INVOICE</a>&nbsp;&nbsp;-->

                <a href="<?php echo SITEURL;?>/account/pdfDownload.php?ord=<?php echo $_REQUEST['ord'] ?>" target="_blank">  <button type="submit" class="btn btn-primary greenBtn generate" > <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;GENERATE PDF</button> </a>
               </div>

                 </div>
            </div>

            
        <div class="col-md-12 head"><span class="text-left"><a  style="float: left;color: #FFFFFF" href="<?php echo SITEURL;?>/account/myorders"  ><i class="fa fa-chevron-circle-left" aria-hidden="true" ></i> Back</a> </span>My Orders - <?php echo count($orderscnt); ?></div>
        <?php
        if(count($allin)==0)
        {
            echo " Requested order details does not seems to be yours ";
            ?>
                <a href="<?php echo SITEURL;?>/account/myorders">Click Here</a> to see your oders.
            <?
        }
        else
        {
           ?>



              <div class="clearfix"></div>

            <div class="card">
                <div class="panel-body">
                <div class="msgs1"></div>
                <div class="row">
                    <div class="col-md-6 paddbot15">
                    <div class="row">
                        <div class="col-md-4"><b>Order ID</b></div>
                        <div class="col-md-8 mute-text"><?php echo $_REQUEST['ord']; ?></div>
                    </div>
                    </div>
                    <div class="col-md-6 paddbot15">
                    <div class="row">
                        <div class="col-md-4"><b>Order Date</b></div>
                        <div class="col-md-8 mute-text"><?php echo $allin[0]['payment_date']; ?></div>
                    </div>
                    </div>
                    </div>
                     <hr class="margin0">
                    <div class="row">
                    <div class="col-md-6 paddbot15">
                    <div class="row">
                        <div class="col-md-4"><b>Customer Name</b></div>
                        <div class="col-md-8 mute-text"><?php echo $allin[0]['u_name']; ?></div>
                    </div>
                    </div>
                    <div class="col-md-6 paddbot15">
                    <div class="row">
                        <div class="col-md-4"><b>Mobile No.</b></div>
                        <div class="col-md-8 mute-text"><?php echo $allin[0]['u_mobile']; ?></div>
                    </div>
                    </div>
                    </div>
                     <hr class="margin0">
                    <div class="row">
                    <div class="col-md-6 paddbot15">
                    <div class="row">
                        <div class="col-md-4"><b>Shipping Address</b></div>
                        <div class="col-md-8 mute-text"><?php echo $allin[0]['address']."<br>".$allin[0]['landmark']."<br>".$allin[0]['city'].", ".$allin[0]['state']." - ".$allin[0]['pincode']."<br>".$allin[0]['mobile']; ?></div>
                    </div>
                    </div>
                    <div class="col-md-6 paddbot15">
                    <div class="row">
                        <div class="col-md-4"><b>Shipping Charges</b></div>
                        <div class="col-md-8 mute-text">
                    <?php
                      if($totalshipchrges)
                      {
                           /*echo $totalshipchrges." /-"; */
                             echo " ".money_format("<i class='fa fa-inr'></i> %!.0n",$totalshipchrges)."/-";
                      }
                      else
                      {
                            echo "0"." /-";
                      }
                    ?></div>
                    </div>
                    </div>
                    </div>
                    <hr class="margin0">
                    <div class="row">
                    <div class="col-md-6 paddbot15">
                    <div class="row">
                        <div class="col-md-4"><b>Total Payable</b></div>
                        <div class="col-md-8 mute-text"><?php /*echo $allin[0]['final_amount']." /-";*/
                      echo " ".money_format("<i class='fa fa-inr'></i> %!.0n",$allin[0]['final_amount'])."/-";
                     ?></div>
                    </div>
                    </div>
                    <div class="col-md-6 paddbot15">
                    <div class="row">
                        <div class="col-md-4"><b>Coupon Applied</b></div>
                        <div class="col-md-8 mute-text"
                        <?php
                      if($allin[0]['coupon']!=""||$allin[0]['coupon']!=0)
                      {
                          $getcpnname=selectQuery(MSTCPN,"*","mc_id=".$allin[0]['coupon']);

                            $a=selectQuery($getcpnname[0]['cpn_table'],"*","cpn_id=".$getcpnname[0]['cpn_id']);
                                if($a)
                                {
                                  echo $a[0]['cpn_name'];
                                  $appliedcoupon=$allin[0]['coupon'];
                                 }
                                 else
                                 {
                                   echo "-";
                                 }
                      }
                     ?>
                     </div>
                    </div>
                    </div>
                    </div>

                </div>
                <hr class="margin0">
                    <div class="row">
                    <div class="col-md-6 paddbot15">
                    <div class="row">
                        <div class="col-md-4"><b>Order Type</b></div>
                        <div class="col-md-8 mute-text"><?php if($allin[0]['payment_status']=="cod"){echo "COD";}if($allin[0]['payment_status']=="paid"){echo "Online Paid";} ?></div>
                    </div>
                    </div>
                    </div>

            </div>
            </div>
            <div class="clearfix"></div>
            <div class="itemlist">
                <div class="head">
                    Item(s) In The Order
                </div>

                    <?php
                         for($j=1;$j<=sizeOf($arr);$j++)
                          {
                              $cnt=$j-1;
                              $proddata = selectQuery(INV." as inv LEFT JOIN ".PROD." as prod ON inv.prod_id = prod.prod_id","*","inv_no=".$arr[$cnt]);
                               $return=$proddata[0]['return_policy'];
                               $sub=selectQuery(SUB,"*");
                               if(count($sub))
                               {
                                   for($i=0;$i<count($sub);$i++)
                                   {
                                       $protable=selectQuery($sub[$i]['table_name'],"*","product_name='".$proddata[0]['prod_name']."'");
                                       if(count($protable))
                                       {
                                         $mst=selectQuery(MSTPROD,"*","prod_mod_id=".$protable[0]['prod_id']." and prod_table='".$sub[$i]['table_name']."'");
                                         $img=selectQuery(MOD_IMG,"*","mod_id=".$mst[0]['mp_id']." ORDER BY img_id ASC LIMIT 1");
                                       }
                                   }
                               }
                                $prodcancel=selectQuery(cancelation,"*","order_id='".$_REQUEST['ord']."' AND product_id=".$mst[0]['mp_id']);
                                 $que=selectQuery(cancelresponse,"*","cancelation_id='".$prodcancel[0]['order_cancel_id']."' order by res_id ASC");
                                 $laststatus=selectQuery(cancelresponse,"*","cancelation_id='".$prodcancel[0]['order_cancel_id']."' order by res_id DESC LIMIT 1");

                                 $prodreturn=selectQuery(returned,"*","order_id='".$_REQUEST['ord']."' AND product_id=".$mst[0]['mp_id']);
                                 $rque=selectQuery(returnresponse,"*","return_id='".$prodreturn[0]['order_return_id']."' order by res_id ASC");
                                 $rlaststatus=selectQuery(returnresponse,"*","return_id='".$prodreturn[0]['order_return_id']."' order by res_id DESC LIMIT 1");
                               for($m=0;$m<sizeOf($shiparr);$m++)
                               {
                                   $a=explode(",",$shiparr[$m]);
                                   $iscod=$a[1];
                                   $b=explode("-",$a[0]);
                                   $shipprod=$b[0];
                                   $shipchrg=$b[1];
                                   if($shipprod==$mst[0]['mp_id'])
                                   {
                                       $thisprodchrg= $shipchrg;
                                       $thisprodcodchrg=$iscod;
                                   }
                                   else
                                   {
                                       $thisprodchrg= "0";
                                   }
                               }


                               ?>
                             <!--  </table>   -->

                                    <div class="card">
                                        <div class="panel-body">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                            <div><span><?php echo $proddata[0]['prod_name']; ?></span> [ Quantity : <?php echo $arr1[$cnt]; ?> ]</div>
                                           
                                            </div>
                                        </div>
                                        <div class="row">


                                        <div class="col-md-2 col-xs-12"><img src="<?php echo SITEURL; ?>/img/modelimg/<?php echo $img[0]['img_name']; ?>" width="90%" height="90%" class="img-responsive" alt="<?php  echo $proddata[0]['prod_name']; ?>"> </div>
                                      <div class="col-md-4 col-xs-12">
                                             <div class=" borderb">
                                            <i class="fa fa-gift green space1" ></i><span class="green"></span> <br>
                                               <div class="margin:0 auto">
                                                     <div class="text-left"><b>Payment Details</b></div>
                                                     <hr class="newsep"></div>
                                        <?php
                                        if($allin[0]['coupon']!=""||$allin[0]['coupon']!=0)
                                               {
                                                     $cpndetails=selectQuery(COMBO1,"*","cpn_id=".$allin[0]['coupon']." and prod_id=".$arr[$cnt]);

                                                     if(count($cpndetails))
                                                     {      $master=selectQuery(MSTCPN,"*","mc_id=".$allin[0]['coupon']);
                                                            $cpnname=selectQuery($master[0]['cpn_table'],"*","cpn_id=".$master[0]['cpn_id']);
                                                         ?>
                                                          <!--<b>Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</b><span class="midline mt5 red" ><i class="fa fa-inr"></i><?php echo $arr2[$cnt]*$arr1[$cnt]." /-<br>"; ?></span>             -->
                                                         <?
                                                               if($allin[0]['ord_type']=="buy")
                                                                 {
                                                                     $price= ($arr2[$cnt])-($allin[0]['total_saving']);
                                                                     $save=$allin[0]['total_saving'];
                                                                 }
                                                                 else
                                                                 {
                                                                      $price= ($arr2[$cnt])-($allin[0]['total_saving']);
                                                                        $save=$allin[0]['total_saving'];
                                                                 }   ?>

                                                        <table class="t">
                                                        <tr><td style="width:120px;">Amount</td><td class="mute-text"><span class="midline red" ><?php echo $arr2[$cnt]*$arr1[$cnt]." /-<br>"; ?></span></td></tr>
                                                              <tr><td>Shipping Chrg</td>

                                                                        <?php
                                                  if($thisprodchrg)
                                                  {
                                                      if($allin[0]['payment_status']=="cod")
                                                      {
                                                          if($thisprodcodchrg=="Including COD ORDERS")
                                                          {
                                                              ?>
                                                              <td class="mute-text">  <?php /*echo $thisprodchrg;*/  echo " ".money_format("<span class='currencysymbol'></span> %!.0n",$thisprodchrg)."/-"; ?>  </td>

                                                              <?
                                                          }
                                                          else
                                                          {
                                                              ?>
                                                               <td class="mute-text">  <span class='currencysymbol'></span> <?php echo "0"; ?>  </td>
                                                              <?
                                                          }
                                                      }
                                                      else
                                                      {
                                                          ?>
                                                             <td class="mute-text"> <?php /*echo $thisprodchrg;*/    echo " ".money_format("<span class='currencysymbol'></span> %!.0n",$thisprodchrg)."/-"; ?> </td>
                                                          <?
                                                      }
                                                  }
                                                  else
                                                  {
                                                      ?>
                                                    <td class="mute-text">  <span class='currencysymbol'></span> <?php echo "0"; ?>  </td>
                                                  <?
                                                  }
                                                 ?>

                                                            </tr>

                                                        <tr><td>Promo Code</td><td class="mute-text"><?php /*echo $cpnname[0]['cpn_name'] */    echo " ".money_format("<span class='currencysymbol'></span> %!.0n",$cpnname[0]['cpn_name'])."/-";   ?></td></tr>
                                                        <tr><td>You Saved</td><td class="mute-text"><?php /*echo $save;*/   echo " ".money_format("<span class='currencysymbol'></span> %!.0n",$save)."/-"; ?></td></tr>
                                                         <tr><td>Paid</td><td class="mute-text"><?php /* echo $price;*/   echo " ".money_format("<span class='currencysymbol'></span> %!.0n",$price)."/-";    ?></td></tr>
                                                        </table>

                                                        <?php
                                                     }
                                                     else
                                                     {
                                                       ?>
                                                       <table class="t">
                                                       <tr><td style="width:120px;">Amount</td><td class="mute-text"><? $price= $arr2[$cnt];
                                                                     echo " ".money_format("<span class='currencysymbol'></span> %!.0n",$price)."/-";

                                                            ?></td></tr>
                                                             <tr><td>Shipping Chrg</td>

                                                                        <?php
                                                  if($thisprodchrg)
                                                  {
                                                      if($allin[0]['payment_status']=="cod")
                                                      {
                                                          if($thisprodcodchrg=="Including COD ORDERS")
                                                          {
                                                              ?>
                                                              <td class="mute-text"> <span class='currencysymbol'></span> <?php echo $thisprodchrg; ?>  </td>

                                                              <?
                                                          }
                                                          else
                                                          {
                                                              ?>
                                                               <td class="mute-text">  <span class='currencysymbol'></span> <?php echo "0"; ?>  </td>
                                                              <?
                                                          }
                                                      }
                                                      else
                                                      {
                                                          ?>
                                                             <td class="mute-text"> <span class='currencysymbol'></span> <?php echo $thisprodchrg; ?> </td>
                                                          <?
                                                      }
                                                  }
                                                  else
                                                  {
                                                      ?>
                                                    <td class="mute-text">  <span class='currencysymbol'></span> <?php echo "0"; ?>  </td>
                                                  <?
                                                  }
                                                 ?>

                                                            </tr>

                                                            <tr><td>Promo Code</td><td class="mute-text">-</td></tr>
                                                            <tr><td>You Saved</td><td class="mute-text">0</td></tr>
                                                            <tr><td>Paid</td><td class="mute-text"> <?  $price= $arr2[$cnt];   echo " ".money_format("<i class='fa fa-inr'></i> %!.0n",$price)."/-";   ?></td></tr>
                                                       </table>
                                                    <?php
                                                     }
                                               }
                                               else
                                               {
                                                  ?> <span class='currencysymbol'></span> <? echo $price= $arr2[$cnt]." /-";
                                               } ?>




                                      </div>
                                      </div>
                                        <?php
                                             $packing = selectQuery(PACKING,"*","order_id='".$_REQUEST['ord']."' AND inventory=".$arr[$cnt]);
                                              $shipping = selectQuery(SHIPPING,"*","packing_id='".$packing[0]['packing_id']."'");
                                        ?>

                                    <div class="col-md-2 col-xs-12">
                                    <div class="borderb">

                                                      <i class="fa fa-arrow-circle-o-right green space1" ></i><span class="green"></span> <br>
                                                      <?php $fulldate= $allin[0]['payment_date'];

                                                      $divide = explode(" ", $fulldate);

                                                      ?>
                                                      <div class="margin:0 auto">
                                                     <div class="text-left"> <b>Order Details</b></div>
                                                     <hr class="newsep">
                                                      <table class="datet">
                                                      <tr><td>Date</td><td class="text-left mute-text"><?php  echo $divide[0] ?></td></tr>
                                                        <tr><td>Time</td><td class="text-left mute-text"><?php  echo $divide[1] ?></td></tr>
                                                      </table>
                                                      <?php
                                                        if(count($prodcancel))
                                                        {
                                                             if(count($prodcancel))
                                                             {
                                                                  if($laststatus[0]['solved']=="solved" && (
                                                                    $laststatus[0]['status']=="Returned entire money back to the client by online payment - Without shipping charges" ||
                                                                    $laststatus[0]['status']=="Returned entire money back to the client by online payment - With shipping charges" ))
                                                                    {
                                                                        echo " <span style='color:red'> Cancelled </span>";
                                                                    }
                                                                    else if($laststatus[0]['solved']=="solved" && $laststatus[0]['status']=="Cancellation request Refused - Out of Terms and conditions " )
                                                                    {
                                                                        echo " Refused";
                                                                    }
                                                                 else
                                                                 {
                                                                       echo "<span style='color:red'>Cancellation Requested</span>";
                                                                 }

                                                             }
                                                        }
                                                        else
                                                        {
                                                            if($shipping[0]['shipped_date']=='')
                                                            {
                                                                ?>
                                                              <button  class=" btn btn-primary btn-block greenBtn cancelpro" style="margin-top: 10px;" data-id="<?php echo $_REQUEST['ord']; ?>"  onclick="cancelrequestpro('<?php echo $_REQUEST['ord']; ?>','<?php echo $arr[$cnt];?>','<?php echo $arr1[$cnt];?>','<?php echo  $proddata[0]['prod_name']; ?>','<?php echo $price; ?>','<?php echo $mst[0]['mp_id']; ?>')" style="color:white;text-decoration:none" > Cancel</button>
                                                            <?
                                                            }

                                                        }
                                                      ?>

                                                      </div>
                                          </div>
                                   </div>
                                         <div class="col-md-2 col-xs-12">
                                         <div class="borderb">
                                            <?php

                                                 if(count($shipping)==0)
                                                {
                                                    ?>
                                                       <i class="fa fa-dot-circle-o red space1"></i><br>
                                                       <div class="text-left"> <b>Dispatch Details</b></div>
                                                       <hr class="newsep">
                                                    <?
                                                }
                                                else
                                                {
                                                     if(!count($prodcancel))
                                                     {
                                                         if($shipping[0]['shipped_date']!='')
                                                        {
                                                            ?>
                                                              <i class="fa fa-check green space1"></i><br>
                                                            <?
                                                          $fulldate1 = $shipping[0]['shipped_date']; /* ."<br>Docket:".$shipping[0]['docket_no'];   ;  */
                                                                $divide1 = explode(" ", $fulldate1);

                                                          ?>
                                                         <div class="text-left"> <b>Dispatch Details</b></div>
                                                          <hr class="newsep">
                                                          <table class="datet">
                                                          <tr><td>Date</td><td class="text-left mute-text"><?php  echo $divide1[0] ?></td></tr>
                                                            <tr><td>Time</td><td class="text-left mute-text"><?php  echo $divide1[1] ?></td></tr>
                                                          </table>
                                                       <?php }
                                                        else
                                                        {

                                                            ?> <i class="fa fa-dot-circle-o green space1"></i><br>
                                                           <div class="text-left"> <b>Dispatch Details</b></div>
                                                           <hr class="newsep">
                                                               <div >  <span class="red">In Progress</span> </div>
                                                            <?
                                                        }
                                                     }
                                                     else
                                                     {
                                                        ?>
                                                           <i class="fa fa-dot-circle-o red space1"></i><br>
                                                       <div class="text-left"> <b>Dispatch Details</b></div>
                                                       <hr class="newsep">
                                                        <?
                                                     }

                                                }
                                             ?>
                                             </div>
                                         </div>
                                        <div class="col-md-2 col-xs-12">
                                        <div class="borderb">
                                            <?php
                                                if(count($shipping)==0||$shipping[0]['shipped_date']=='')
                                                {
                                                    ?>
                                                       <i class="fa fa-dot-circle-o space1 red"></i> <br>
                                                       <div class="text-left"> <b>Delivery Details</b></div>
                                                        <hr class="newsep">
                                                    <?
                                                }
                                                else
                                                {
                                                    if($shipping[0]['delivered_on']!='')
                                                    {
                                                        ?>
                                                          <i class="fa fa-check green space1" ></i><br>
                                                        <?
                                                        $fulldate2 =$shipping[0]['delivered_on'];
                                                         $divide2 = explode(" ", $fulldate2);

                                                      ?>
                                                     <div class="text-left"> <b>Delivery Details</b></div>
                                                      <hr class="newsep">
                                                      <table class="datet">
                                                      <tr><td>Date</td><td class="text-left mute-text"><?php  echo $divide2[0] ?></td></tr>
                                                        <tr><td>Time</td><td class="text-left mute-text"><?php  echo $divide2[1] ?></td></tr>
                                                      </table>

                                                    <?php
                                                    }
                                                    else if($shipping[0]['shipped_date']!=''&&$shipping[0]['delivered_on']=='')
                                                    {
                                                        ?>
                                                         <i class="fa fa-dot-circle-o space1 red"></i> <br>
                                                       <div class="text-left"> <b>Delivery Details</b></div>
                                                        <hr class="newsep">
                                                            <div class=""><span class="red ">In Progress</span> </div>
                                                        <?
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                       <i class="fa fa-dot-circle-o red space1" ></i>
                                                    <?
                                                     }
                                                     ?>
                                                      <?php
                                                        if(count($prodreturn))
                                                        {
                                                             if(count($prodreturn))
                                                             {
                                                                  if($rlaststatus[0]['solved']=="solved" && ($rlaststatus[0]['status']=="Product collected back and returned entire money back to the client as described above  - With shipping charges" ||
                                                                    $rlaststatus[0]['status']=="Product collected back and returned entire money back to the client as described above  - Without  shipping charges" ||
                                                                    $rlaststatus[0]['status']=="Product collected back and returned entire money back to the client by online payment  - With  shipping charges" ||
                                                                    $rlaststatus[0]['status']=="Product collected back and returned entire money back to the client by online payment  - Without  shipping charges"))
                                                                    {
                                                                        echo " <span style='color:red'> Returned </span>";
                                                                    }
                                                                    else if($rlaststatus[0]['solved']=="solved" && $rlaststatus[0]['status']=="Return request Refused - Out of Terms and conditions " )
                                                                    {
                                                                        echo " Refused";
                                                                    }
                                                                 else
                                                                 {
                                                                       echo "<span style='color:red'>Return Requested</span>";
                                                                 }

                                                             }
                                                        }
                                                        else
                                                        {
                                                            if(!count($prodreturn)&&$shipping[0]['delivered_on']!='')
                                                                {
                                                                     $originalDate = $shipping[0]['delivered_on'];
                                                                    $newDate = date("Y-m-d H:i:s", strtotime($originalDate));

                                                                    $addeddate = strtotime("+".$return." days", strtotime($newDate));

                                                                    $newdatte= date("Y-m-d H:i:s", $addeddate);
                                                                   if($return!=0 && $return!="")
                                                                   {
                                                                       if(date("Y-m-d H:i:s")<=$newdatte)
                                                                       {
                                                                          ?>
                                                                             <button class=" btn btn-primary returnpro" data-id="<?php echo $_REQUEST['ord']; ?>"  onclick="returnrequestpro('<?php echo $_REQUEST['ord']; ?>','<?php echo $arr[$cnt];?>','<?php echo $arr1[$cnt];?>','<?php echo  $proddata[0]['prod_name']; ?>','<?php echo $price; ?>','<?php echo $mst[0]['mp_id']; ?>')" style="color:white;text-decoration:none" > Return</button>
                                                                          <?
                                                                       }
                                                                      else
                                                                      {
                                                                            ?>
                                                                             <abbr title="Out Of Return Policy"> <button class=" btn btn-primary returnpro" data-id="<?php echo $_REQUEST['ord']; ?>"  onclick="returnrequestpro('<?php echo $_REQUEST['ord']; ?>','<?php echo $arr[$cnt];?>','<?php echo $arr1[$cnt];?>','<?php echo  $proddata[0]['prod_name']; ?>','<?php echo $price; ?>','<?php echo $mst[0]['mp_id']; ?>')" style="color:white;text-decoration:none" disabled>No Return</button></abbr>
                                                                            <?
                                                                      }
                                                                   }
                                                                    ?>

                                                                    <?
                                                                }
                                                        }
                                                      ?>
                                                        <?php

                                                      ?>
                                                     <?
                                                }
                                            ?>
                                            </div>
                                         </div>

                                    </div>
                                    <?php
                                      if(count($prodcancel))
                                      {
                                          ?>

                                          <?php

                                          ?>
                                             <div class="col-md-12 col-sm-12 col-xs-12 cancelationbox">
                                                   Cancellation ID  #<?php echo $prodcancel[0]['cancelation_id']; ?>
                                                   <?php
                                                    if($laststatus[0]['solved']=="solved" && (
                                                                    $laststatus[0]['status']=="Returned entire money back to the client by online payment - Without shipping charges" ||
                                                                    $laststatus[0]['status']=="Returned entire money back to the client by online payment - With shipping charges" ))
                                                        {
                                                            echo " - Cancelled";
                                                        }
                                                    if($laststatus[0]['solved']=="solved" && $laststatus[0]['status']=="Cancellation request Refused - Out of Terms and conditions " )
                                                        {
                                                            echo " - Refused";
                                                        }
                                                   ?>
                                                   <button type="button" style="float:right" id="dispbtn<?php echo $i; ?>" onclick="toggledetails('dispbtn<?php echo $i; ?>','details<?php echo $i; ?>')"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                                             </div>
                                             <div class="col-md-12 col-sm-12 col-xs-12 cancelationdetails" id="details<?php echo $i; ?>" style="">
                                                  <table class="table table-bordered" style="border:2px solid #b8b8b8 !important">
                                                    <tr>
                                                     <td> <?php echo $prodcancel[0]['indate']; ?></td>
                                                     <td>Cancellation requested by you</td>
                                                    </tr>
                                                    <?php
                                                      for($y=0;$y<count($que);$y++)
                                                      {
                                                          ?>
                                                           <tr>
                                                                 <td> <?php echo $que[$y]['response_date']; ?></td>
                                                                <td><?php echo $que[$y]['status']; ?></td>
                                                           </tr>

                                                          <?
                                                      }
                                                    ?>
                                                  </table>
                                             </div>
                                          <?
                                      }
                                       if(count($prodreturn))
                                      {
                                          ?>

                                          <?php

                                          ?>
                                             <div class="col-md-12 col-sm-12 col-xs-12 returnbox">
                                                   Return ID  #<?php echo $prodreturn[0]['return_id']; ?>
                                                   <?php
                                                    if($rlaststatus[0]['solved']=="solved" && ($rlaststatus[0]['status']=="Product collected back and returned entire money back to the client as described above  - With shipping charges" ||
                                                        $rlaststatus[0]['status']=="Product collected back and returned entire money back to the client as described above  - Without  shipping charges" ||
                                                        $rlaststatus[0]['status']=="Product collected back and returned entire money back to the client by online payment  - With  shipping charges" ||
                                                        $rlaststatus[0]['status']=="Product collected back and returned entire money back to the client by online payment  - Without  shipping charges"))
                                                        {
                                                            echo " - Returned";
                                                        }
                                                    if($rlaststatus[0]['solved']=="solved" && $rlaststatus[0]['status']=="Rerutn request Refused - Out of Terms and conditions " )
                                                        {
                                                            echo " - Refused";
                                                        }
                                                   ?>
                                                   <button type="button" style="float:right" id="dispbtn1<?php echo $i; ?>" onclick="toggledetails1('dispbtn1<?php echo $i; ?>','details1<?php echo $i; ?>')"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                                             </div>
                                             <div class="col-md-12 col-sm-12 col-xs-12 returndetails" id="details1<?php echo $i; ?>" style="">
                                                  <table class="table table-bordered" style="border:2px solid #b8b8b8 !important">
                                                    <tr>
                                                     <td> <?php echo $prodreturn[0]['indate']; ?></td>
                                                     <td>Return requested by you</td>
                                                    </tr>
                                                    <?php
                                                      for($y=0;$y<count($rque);$y++)
                                                      {
                                                          ?>
                                                           <tr>
                                                                 <td> <?php echo $rque[$y]['response_date']; ?></td>
                                                                <td><?php echo $rque[$y]['status']; ?></td>
                                                           </tr>

                                                          <?
                                                      }
                                                    ?>
                                                  </table>
                                             </div>
                                          <?
                                      }
                                    ?>
                                        </div>
                                       </div>

                               <?
                          }
                     ?>


            </div>
          </div>
           <?
        }
    ?>

  <div class="clearfix"></div>
 </div>
</div>

 <div class="col-md-12 mt20 printdata">
               <!-- <div style="background-color:#9F3567;height: 50px;width: 100%;">adszfvsf</div>  -->
            <table  class="table table-bordered ">
                <tr>
                    <td ><b>Order ID</b> </td>

                    <td><?php echo $_REQUEST['ord']; ?></td>

                    <td> <b>Order Date</b></td>

                    <td><?php echo $allin[0]['payment_date']; ?></td>
                </tr>
                 <tr>
                    <td><b>Customer Name</b> </td>

                    <td><?php echo $allin[0]['u_name']; ?></td>

                    <td><b>Mobile No.</b> </td>

                    <td><?php echo $allin[0]['u_mobile']; ?></td>
                </tr>
                <tr>
                    <td><b>Shipping Address </b></td>

                    <td colspan="4"><?php echo $allin[0]['address']."<br>".$allin[0]['landmark']."<br>".$allin[0]['city'].", ".$allin[0]['state']." - ".$allin[0]['pincode']."<br>".$allin[0]['mobile']; ?></td>
                </tr>


                 <tr>
                    <th>Coupon Applied</th>

                    <td>
                    <?php
                      if($allin[0]['coupon']!=""||$allin[0]['coupon']!=0)
                      {
                          $getcpnname=selectQuery(MSTCPN,"*","mc_id=".$allin[0]['coupon']);

                            $a=selectQuery($getcpnname[0]['cpn_table'],"*","cpn_id=".$getcpnname[0]['cpn_id']);
                                if($a)
                                {
                                  echo $a[0]['cpn_name'];
                                  $appliedcoupon=$allin[0]['coupon'];
                                 }
                                 else
                                 {
                                   echo "-";
                                 }
                      }
                     ?>
                     </td>
                     <th>Status</th>
                     <td>
                           <?php
                    $cancel=selectQuery(cancelation,"*","order_id='".$_REQUEST['ord']."'");
                    if(count($cancel))
                    {
                            if($cancel[0]['request_Action']=="unsolved")
                            {
                                 ?>
                                    <span style="color:red">CANCELLATION IN PROCESS</span>
                                 <?php
                            }
                            if($cancel[0]['request_Action']=="solved")
                            {
                               ?>
                                   <span style="color:red">ORDER CANCELLED</span>
                               <?php
                            }
                    }
                    else
                    {
                        ?>
                                <span style="color:red">In Process</span>
                            <!--<a href="" type="button" class="cancel" data-id="<?php echo $_REQUEST['ord']; ?>" onclick="cancelrequest('<?php echo $_REQUEST['ord']; ?>')" style="color:black">CANCEL YOUR ORDER</a>      -->
                        <?php
                    }
                     ?>
                      </td>
                 </tr>

            </table>

            <div class="col-md-10 col-md-offset-1 " >

            </div>
            <div class="col-md-12">
             <?php for($j=1;$j<=sizeOf($arr);$j++)
                          {      $cnt=$j-1;
                              $proddata = selectQuery(INV." as inv LEFT JOIN ".PROD." as prod ON inv.prod_id = prod.prod_id","*","inv_no=".$arr[$cnt]);

                                $sub=selectQuery(SUB,"*");
                               if(count($sub))
                               {
                                   for($i=0;$i<count($sub);$i++)
                                   {
                                       $protable=selectQuery($sub[$i]['table_name'],"*","product_name='".$proddata[0]['prod_name']."'");
                                       if(count($protable))
                                       {
                                         $mst=selectQuery(MSTPROD,"*","prod_mod_id=".$protable[0]['prod_id']." and prod_table='".$sub[$i]['table_name']."'");
                                         $img=selectQuery(MOD_IMG,"*","mod_id=".$mst[0]['mp_id']." ORDER BY img_id ASC LIMIT 1");
                                       }
                                   }
                               }   ?>
                            <div class=" mb20" >
                            <div class="w100"> <img src="<?php echo SITEURL; ?>/img/modelimg/<?php echo $img[0]['img_name']; ?>" width="100%" height="100%" class="img-responsive" alt="<?php  echo $proddata[0]['prod_name'];  ?>"></div>
                             <div class="clearfix"></div>
                            <div class="w100"><?php echo $proddata[0]['prod_name']; ?>   </div>
                              </div>


                    <?php }    ?>
             </div>
             <br>
                <table class="table mb0 mt20" >
                <tr>

                    <th class="text-left w1">Item </th>
                    <th class="text-left w1">Price</th>
                    <th class="text-left w1">Qty</th>
                     <th class="text-left w1">Shipping Charges</th>
                    <th class="text-left w1">Total </th>

                </tr>
                    <?php
                         for($j=1;$j<=sizeOf($arr);$j++)
                          {
                              $cnt=$j-1;
                              $proddata = selectQuery(INV." as inv LEFT JOIN ".PROD." as prod ON inv.prod_id = prod.prod_id","*","inv_no=".$arr[$cnt]);
                               $sub=selectQuery(SUB,"*");
                               if(count($sub))
                               {
                                   for($i=0;$i<count($sub);$i++)
                                   {
                                       $protable=selectQuery($sub[$i]['table_name'],"*","product_name='".$proddata[0]['prod_name']."'");
                                       if(count($protable))
                                       {
                                         $mst=selectQuery(MSTPROD,"*","prod_mod_id=".$protable[0]['prod_id']." and prod_table='".$sub[$i]['table_name']."'");
                                         $img=selectQuery(MOD_IMG,"*","mod_id=".$mst[0]['mp_id']." limit 1");
                                       }
                                   }
                               }

                               if($allin[0]['coupon']!=""||$allin[0]['coupon']!=0)
                               {
                                     $cpndetails=selectQuery(COMBO1,"*","cpn_id=".$allin[0]['coupon']." and prod_id=".$arr[$cnt]);
                                     if(count($cpndetails))
                                     {
                                         if($allin[0]['ord_type']=="buy")
                                         {
                                             $price= ($arr2[$cnt]*$arr1[$cnt])-($allin[0]['total_saving']*$arr1[$cnt]);

                                         }
                                         else
                                         {
                                              $price= ($arr2[$cnt]*$arr1[$cnt])-($allin[0]['total_saving']*$arr1[$cnt]);

                                         }
                                     }
                                     else
                                     {
                                         $price= $arr2[$cnt]*$arr1[$cnt];
                                     }
                               }
                               else
                               {
                                    $price= $arr2[$cnt]*$arr1[$cnt];
                               }
                                for($m=0;$m<sizeOf($shiparr);$m++)
                               {
                                   $a1=explode(",",$shiparr[$m]);
                                   $iscod1=$a1[1];
                                   $b1=explode("-",$a1[0]);
                                   $shipprod1=$b1[0];
                                   $shipchrg1=$b1[1];
                                   if($shipprod1==$mst[0]['mp_id'])
                                   {
                                       $thisprodchrg1= $shipchrg1;
                                       $thisprodcodchrg1=$iscod1;
                                   }
                                   else
                                   {
                                       $thisprodchrg1= "0";
                                   }
                               }

                               ?>
                                    <tr>

                                        <td><?php echo $proddata[0]['prod_name']; ?>
                                        <br>Sold By:&nbsp;<?php echo $proddata[0]['pur_from']; ?>
                                        </td>
                                        <td><i class="fa fa-inr"></i>
                                        <?php
                                           if($allin[0]['applied_for']==$arr[$cnt])
                                           {
                                               echo $arr2[$cnt]-$allin[0]['total_saving'];
                                           }
                                           else
                                           {
                                               echo $arr2[$cnt];
                                           }
                                          ?></td>
                                         <td><?php echo $arr1[$cnt]; ?></td>
                                          <td>
                                               <?php

                                                     if($thisprodchrg1)
                                                  {
                                                      if($allin[0]['payment_status']=="cod")
                                                      {
                                                          if($thisprodcodchrg=="Including COD ORDERS")
                                                          {
                                                              ?>
                                                               <i class="fa fa-inr"></i> <?php echo $thisprodchrg1; ?>

                                                              <?
                                                          }
                                                          else
                                                          {
                                                              ?>
                                                                 <i class="fa fa-inr"></i> <?php echo "0"; ?>
                                                              <?
                                                          }
                                                      }
                                                      else
                                                      {
                                                          ?>
                                                              <i class="fa fa-inr"></i> <?php echo $thisprodchrg1; ?>
                                                          <?
                                                      }
                                                  }
                                                  else
                                                  {
                                                       ?>
                                                           <i class="fa fa-inr"></i> <?php echo "0"; ?>
                                                       <?
                                                  }

                                               ?>
                                          </td>
                                         <td><i class="fa fa-inr"></i> <?php echo $price+$thisprodchrg1." /-"; ?></td>

                                    </tr>


                               <?
                          }
                     ?>

                     <tr><th class="text-left">Total </th><td></td><td></td><td></td><td class="text-left"><i class="fa fa-inr"></i> <?php echo $allin[0]['final_amount']." /-"; ?></td></tr>
                </table>
              <!-- <div class="totl"></div>  -->

              <!--  <table class="table sum">

                </table>-->


            </div>
            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="flase" >
              <div class="modal-dialog" role="document" style="top:150px;overflow-y: initial !important;width:auto">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"></h4>

                  </div>
                  <div class="modal-body" id="modal-body"  style="height: auto;overflow-y: auto;">

                  </div>

                </div>
              </div>
            </div>
<?php include '../footer.php' ?>


<script type="text/javascript" src="../fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="../fancybox/helpers/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="../fancybox/helpers/jquery.fancybox-media.js"></script>
<script type="text/javascript" src="../fancybox/helpers/jquery.fancybox-thumbs.js"></script>
     <script>
        function goBack() {
            window.history.back();
        }
     </script>
<script>
$(document).ready(function(){

$("#track").click(function(){
 $.fancybox({
       autoDimensions: true,
     'content':'<div class="popup"><div class="head">Tracking History</div><div>  <table><tr><td>Order Placed on date</td>   <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td>11/01/2016</td></tr><tr><td>Material Dispatched On Date</td>   <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td>11/01/2016</td></tr><tr><td>Material Delivered On Date</td>   <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td>11/01/2016</td></tr></table></div></div>'
 });
});
});
$( document ).on( 'click', '.loadmore', function () {
        	     $(this).text('Loading...');
        	     var ele = $(this).parent('li');
        	      $.ajax({
        	        url: '<?php echo SITEURL; ?>/account/ordersloadmore.php',
        	        type: 'POST',
        	        data: {
        	          page:$(this).data('page')

        	        },
        	        success: function(response){
        	          if(response){
        	            ele.hide();
        	            $(".order_list").append(response);

        	          }

        	        }
        	      });
        	});

      </script>
     <script>
      $('.close').on('click', function () {
                    $("#myModal1").css("display","none");
                    $("#myModal1").css("opacity","0");
                });
        /* function cancelrequest(orderid)
            {
                  $.ajax({
                  type:"POST",
                  url:"cancelrequest.php",
                  data:{order_id:orderid},
                  success:function(response){
                   $("#myModalLabel").html("Entire Order Cancelation Request")
                   $("#modal-body").html(response);
                    $("#myModal1").css("display","block");
                    $("#myModal1").css("opacity","1");
                  }
                  });

            }*/

             function cancelrequestpro(orderid,invid,qty,proname,price,masterid)
            {

                  $.ajax({
                  type:"POST",
                  url:"cancelrequestpro.php",
                  data:{order_id:orderid,proid:invid,proname:proname,price:price,masterid:masterid,qty:qty},
                  success:function(response){
                   $("#myModalLabel").html("Product Cancelation Request")
                   $("#modal-body").html(response);
                    $("#myModal1").css("display","block");
                    $("#myModal1").css("opacity","1");
                  }
                  });

            }

               function returnrequestpro(orderid,invid,qty,proname,price,masterid)
            {

                  $.ajax({
                  type:"POST",
                  url:"returnrequestpro.php",
                  data:{order_id:orderid,proid:invid,proname:proname,price:price,masterid:masterid,qty:qty},
                  success:function(response){
                   $("#myModalLabel").html("Product Return Request")
                   $("#modal-body").html(response);
                    $("#myModal1").css("display","block");
                    $("#myModal1").css("opacity","1");
                  }
                  });

            }

            function validatedata()
           {
                   var invid=contactform.elements["invid"].value;
                   var price=contactform.elements["price"].value;
                   var qty=contactform.elements["qty"].value;
                    var masterid=contactform.elements["masterid"].value;
                   var proname=contactform.elements["proname"].value;
                  var orderid=contactform.elements["orderid"].value;
                var uname=contactform.elements["uname"].value;
                var email=contactform.elements["email"].value;
                var tele=contactform.elements["tele"].value;
                var cmnt="";
                 var reason ="";

                     $(".sendingmsg1").html("Please wait while we are sending your request..");
                     $(".msgs").html("").css({'color':'red','border':'none'});
                   $("#submit").val("Sending..");
                   $.ajax({
        	        url: '<?php echo SITEURL; ?>/account/cancelation_submit.php',
        	        type: 'POST',
        	        data: {
        	            invid:invid,
                       price:price,
                       masterid:masterid,
                       qty:qty,
                       proname:proname,
        	          ord:orderid,
                      email:email,
                      tele:tele,
                      uname:uname,
                      cmnt:cmnt,
                      reason:reason

        	        },
        	        success: function(response){
        	          if(response){
        	            if(response==0)
                         {
                              $(".msgs").html("Please Try Again Later").css({'color':'red','border':'1px solid red'});
                              $("#submit").val("Send");
                               $(".sendingmsg1").html("");

                         }
                         if(response==1)
                         {
                                   $("#submit").val("Send");

                                   $("#myModal1").css("display","none");
                                 $("#myModal1").css("opacity","0");
                                 location.reload();
                                  $(".msgs1").html("Your Request Generated Sucsessfully. Our Team Will Contact You Soon").css({'color':'green'}).fadeout(50000);
                                    $(".sendingmsg1").html("");
                         }


        	          }

        	        }
        	      });

           }

           function canceldata()
           {
                 $("#myModal1").css("display","none");
                 $("#myModal1").css("opacity","0");
           }
             function returndata()
           {
                   var invid=rcontactform.elements["rinvid"].value;
                   var price=rcontactform.elements["rprice"].value;
                   var masterid=rcontactform.elements["rmasterid"].value;
                    var qty=rcontactform.elements["rqty"].value;
                   var proname=rcontactform.elements["rproname"].value;
                  var orderid=rcontactform.elements["rorderid"].value;
                var uname=rcontactform.elements["runame"].value;
                var email=rcontactform.elements["remail"].value;
                var tele=rcontactform.elements["rtele"].value;
                var cmnt=rcontactform.elements["rcmnt"].value;
                 var reason =rcontactform.elements["rreason"].value;;
                if(reason=="")
                {
                   $(".msgs").html("Please select return reason").css({'color':'red','border':'1px solid red'});
                }
                else if(cmnt.length<=1)
                {
                   $(".msgs").html("Please enter comment").css({'color':'red','border':'1px solid red'});
                }
                else
                {
                    $(".sendingmsg").html("Please wait while we are sending your request..");
                     $(".msgs").html("").css({'color':'red','border':'none'});
                   $("#return").val("Sending..");
                   $.ajax({
        	        url: '<?php echo SITEURL; ?>/account/prodreturn_submit.php',
        	        type: 'POST',
        	        data: {
        	            invid:invid,
                       price:price,
                       masterid:masterid,
                       qty:qty,
                       proname:proname,
        	          ord:orderid,
                      email:email,
                      tele:tele,
                      uname:uname,
                      cmnt:cmnt,
                      reason:reason

        	        },
        	        success: function(response){
        	          if(response){
        	            if(response==0)
                         {
                              $(".msgs").html("Please Try Again Later").css({'color':'red','border':'1px solid red'});
                              $("#return").val("Send");
                             $(".sendingmsg").html("");
                         }
                         if(response==1)
                         {
                                   $("#return").val("Send");

                                   $("#myModal1").css("display","none");
                                 $("#myModal1").css("opacity","0");
                                 location.reload();
                                  /*$(".msgs1").html("Your Request Generated Sucsessfully. Our Team Will Contact You Soon").css({'color':'green'}).fadeout(50000);    */
                                   $(".sendingmsg").html("");
                         }


        	          }

        	        }
        	      });
                }
           }
          /* function validate()
            {
                var orderid=contactform.elements["orderid"].value;
                var uname=contactform.elements["uname"].value;
                var email=contactform.elements["email"].value;
                var tele=contactform.elements["tele"].value;
                var cmnt=contactform.elements["cmnt"].value;
                 var reason =contactform.elements["reason"].value;;
                if(reason=="")
                {
                   $(".msgs").html("Please select cancelation reason").css({'color':'red','border':'1px solid red'});
                }
                else if(cmnt.length<=1)
                {
                   $(".msgs").html("Please enter comment").css({'color':'red','border':'1px solid red'});
                }
                else
                {
                     $(".msgs").html("").css({'color':'red','border':'none'});
                   $("#submit").val("Sending..");
                   $.ajax({
        	        url: '<?php echo SITEURL; ?>/account/cancelation_submit.php',
        	        type: 'POST',
        	        data: {
        	          ord:orderid,
                      email:email,
                      tele:tele,
                      uname:uname,
                      cmnt:cmnt,
                      reason:reason

        	        },
        	        success: function(response){
        	          if(response){
        	            if(response==0)
                         {
                              $(".msgs").html("Please Try Again Later").css({'color':'red','border':'1px solid red'});
                              $("#submit").val("Send");

                         }
                         if(response==1)
                         {
                                   $("#submit").val("Send");

                                   $("#myModal1").css("display","none");
                                 $("#myModal1").css("opacity","0");
                                 location.reload();
                                  $(".msgs1").html("Your Request Generated Sucsessfully. Our Team Will Contact You Soon").css({'color':'green'}).fadeout(50000);
                         }


        	          }

        	        }
        	      });
                }
            }*/


     </script>
     <script>
        function toggledetails(btn,id)
        {
            var disp=$("#"+id).css('display');
            if(disp=='block')
            {
                   $("#"+btn).replaceWith('<button type="button" style="float:right" id="'+btn+'" onclick="toggledetails(\''+btn+'\',\''+id+'\')"><i class="fa fa-angle-down" aria-hidden="true"></i></button>');
            }
            else
            {
                   $("#"+btn).replaceWith('<button type="button" style="float:right" id="'+btn+'" onclick="toggledetails(\''+btn+'\',\''+id+'\')"><i class="fa fa-angle-up" aria-hidden="true"></i></button>');
            }
            $("#"+id).toggle();
        }
         function toggledetails1(btn,id)
        {
            var disp=$("#"+id).css('display');
            if(disp=='block')
            {
                   $("#"+btn).replaceWith('<button type="button" style="float:right" id="'+btn+'" onclick="toggledetails1(\''+btn+'\',\''+id+'\')"><i class="fa fa-angle-down" aria-hidden="true"></i></button>');
            }
            else
            {
                   $("#"+btn).replaceWith('<button type="button" style="float:right" id="'+btn+'" onclick="toggledetails1(\''+btn+'\',\''+id+'\')"><i class="fa fa-angle-up" aria-hidden="true"></i></button>');
            }
            $("#"+id).toggle();
        }
      </script>
</body>
</html>

