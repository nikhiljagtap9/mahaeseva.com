 <?php include("../includes/configuration.php");
      $user=$_SESSION['reguser'];
      $userdata=selectQuery(WEB_USER,"*","u_id=".$user);
      $orders=selectQuery(AGR,"*","user_id=".$user."  order by agree_id DESC");

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
</head>
<body>
<?php include 'menu.php' ?>
<div class="container top-area" id="maincontainer">
<div class="row">
<?php include('sidebar.php')?>
  <div class="col-md-9 col-sm-8">
   <div class="col-md-12 head" >My Orders - <?php echo count($orders); ?></div>
           	<div class="order_list">
             <?
             $resultsPerPage = 10;
             $rev3 = selectQuery(ORDER, "*","user_id=".$user." and (payment_status='paid'||payment_status='cod') AND final_order<>'' order by ord_id DESC");
             if (count($rev3) == 0) {
               ?>
                     <p class="cc text-center">NO ORDERS FOUND</p>
                     <?php
                   }
                   else {
                     for ($i = 0; $i < count($rev3); $i++)
                     {
                         ?>
                         <div class="orderbox ">
                         <fieldset class="fieldset card">
                            <legend class="legend">&nbsp;<span><a href="<?php echo SITEURL;?>/account/orderdetails.php?ord=<? echo $rev3[$i]['final_order']; ?>" class="boldblack" style="color:white"><?php echo $rev3[$i]['final_order']; ?></a></span>&nbsp;&nbsp;</legend>
                        <!-- <div class="col-md-12 col-xs-12">

                         </div>-->
                         <?
                         $prod_list=$rev3[$i]['inv_id'];
                          $qty_list=$rev3[$i]['quantity'];
                          $per_price=$rev3[$i]['per_price'];
                           $arr=explode(",",$prod_list);
                          $arr1=explode(",",$qty_list);
                          $arr2=explode(",",$per_price);
                         $invarr=explode(",",$rev3[$i]['inv_id']);
                           $shipping = selectQuery(SHIPPING, "*","order_id='".$rev3[$i]['final_order']."' and delivered='1'");
                           $returned=0;
                           $inreturn=0;
                           $cancelled=0;
                           $incancelation=0;
                           for($k=0;$k<sizeOf($arr);$k++)
                           {
                               $prodcancel=selectQuery(cancelation,"*","order_id='".$rev3[$i]['final_order']."' AND inv_id=".$arr[$k]);
                               if(count($prodcancel))
                               {
                                     $que=selectQuery(cancelresponse,"*","cancelation_id='".$prodcancel[0]['order_cancel_id']."' order by res_id ASC");
                                    $laststatus=selectQuery(cancelresponse,"*","cancelation_id='".$prodcancel[0]['order_cancel_id']."' order by res_id DESC LIMIT 1");
                                    if($laststatus[0]['solved']=="solved")
                                    {
                                        $cancelled=$cancelled+1;
                                    }
                                    else
                                    {
                                         $incancelation=$incancelation+1;
                                    }
                               }


                                 $prodreturn=selectQuery(returned,"*","order_id='".$rev3[$i]['final_order']."' AND inv_id=".$arr[$k]);
                                 if(count($prodreturn))
                                   {
                                         $rque=selectQuery(returnresponse,"*","return_id='".$prodreturn[0]['order_return_id']."' order by res_id ASC");
                                         $rlaststatus=selectQuery(returnresponse,"*","return_id='".$prodreturn[0]['order_return_id']."' order by res_id DESC LIMIT 1");
                                          if($rlaststatus[0]['solved']=="solved")
                                            {
                                                $returned=$returned+1;
                                            }
                                            else
                                            {
                                                 $inreturn=$inreturn+1;
                                            }
                                   }
                              ?>
                                <div class="col-md-12 col-sm-12 col-xs-12 marginbot25">
                                      <li>

                                            <?php

                                                 /* $cnt=$j-1;   */
                                                  $proddata = selectQuery(INV." as inv LEFT JOIN ".PROD." as prod ON inv.prod_id = prod.prod_id","*","inv_no=".$arr[$k]);
                                                   $return=$proddata[0]['return_policy'];
                                                   $sub=selectQuery(SUB,"*");
                                                   if(count($sub))
                                                   {
                                                       for($z=0;$z<count($sub);$z++)
                                                       {
                                                           $protable=selectQuery($sub[$z]['table_name'],"*","product_name='".$proddata[0]['prod_name']."'");
                                                           if(count($protable))
                                                           {
                                                             $mst=selectQuery(MSTPROD,"*","prod_mod_id=".$protable[0]['prod_id']." and prod_table='".$sub[$z]['table_name']."'");
                                                             $img=selectQuery(MOD_IMG,"*","mod_id=".$mst[0]['mp_id']." ORDER BY img_id ASC LIMIT 1");
                                                           }
                                                       }
                                                   }
                                                    $prodcancel=selectQuery(cancelation,"*","order_id='".$rev3[$i]['final_order']."' AND product_id=".$mst[0]['mp_id']);
                                                     $que=selectQuery(cancelresponse,"*","cancelation_id='".$prodcancel[0]['order_cancel_id']."' order by res_id ASC");
                                                     $laststatus=selectQuery(cancelresponse,"*","cancelation_id='".$prodcancel[0]['order_cancel_id']."' order by res_id DESC LIMIT 1");

                                                     $prodreturn=selectQuery(returned,"*","order_id='".$rev3[$i]['final_order']."' AND product_id=".$mst[0]['mp_id']);
                                                     $rque=selectQuery(returnresponse,"*","return_id='".$prodreturn[0]['order_return_id']."' order by res_id ASC");
                                                     $rlaststatus=selectQuery(returnresponse,"*","return_id='".$prodreturn[0]['order_return_id']."' order by res_id DESC LIMIT 1");
                                                      $shippingchrg=$rev3[$i]['shiping_chrges'];
                                                $shiparr=explode("&",$shippingchrg);
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

                                                                 $packing = selectQuery(PACKING,"*","order_id='".$rev3[$i]['final_order']."' AND inventory=".$arr[$k]);
                                                                  $shipping = selectQuery(SHIPPING,"*","packing_id='".$packing[0]['packing_id']."'");


                                                   ?>
                                                 <!--  </table>   -->

                                                      <!--  <fieldset class="fieldset"> -->
                                                         <!--  <legend class="legend">&nbsp;<span><?php echo $proddata[0]['prod_name']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qty: <?php echo $arr1[$k]; ?>&nbsp;&nbsp;</legend>   -->
                                                          <div clas="col-md-12 col-sm-12 col-xs-12 marginbot25">
                                                            <div class="panel-heading"><div class="panel-title"><?php echo $proddata[0]['prod_name']; ?> | Quantity : <?php echo $arr1[$k]; ?></div></div>
                                                          </div>
                                                            <div class="row">
                                                         <div class="col-md-2 col-sm-4 col-xs-12 orderThumb">

                                                            <img src="<?php echo SITEURL; ?>/img/modelimg/thumb200x200/<?php echo $img[0]['img_name']; ?>"  class="img-responsive" alt="<?php echo $proddata[0]['prod_name']; ?>"><!--<b> Product sold by: </b><br><?php echo $proddata[0]['pur_from']; ?>-->


                                                         </div>

                                                              <div class="col-md-4 col-sm-6 col-xs-12">
                                                                 <div class=" borderb">
                                                                    <i class="fa fa-gift green space1" ></i><span class="green"></span> <br>
                                                                    <h5><b>Payment</b></h5>
                                                                    <hr class="newsep">
                                                            <?php
                                                            if($rev3[$i]['coupon']!=""||$rev3[$i]['coupon']!=0)
                                                                   {
                                                                         $cpndetails=selectQuery(COMBO1,"*","cpn_id=".$rev3[$i]['coupon']." and prod_id=".$arr[$k]);

                                                                         if(count($cpndetails))
                                                                         {      $master=selectQuery(MSTCPN,"*","mc_id=".$rev3[$i]['coupon']);
                                                                                $cpnname=selectQuery($master[0]['cpn_table'],"*","cpn_id=".$master[0]['cpn_id']);
                                                                             ?>
                                                                              <!--<b>Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</b><span class="midline mt5 red" ><i class="fa fa-inr"></i><?php echo $arr2[$cnt]*$arr1[$cnt]." /-<br>"; ?></span>             -->
                                                                             <?
                                                                                   if($rev3[$i]['ord_type']=="buy")
                                                                                     {
                                                                                         $price= ($arr2[$k])-($rev3[$i]['total_saving']);
                                                                                         $save=$rev3[$i]['total_saving'];
                                                                                     }
                                                                                     else
                                                                                     {
                                                                                          $price= ($arr2[$k])-($rev3[$i]['total_saving']);
                                                                                            $save=$rev3[$i]['total_saving'];
                                                                                     }   ?>

                                                                            <table class="t">
                                                                            <tr><td>Amount</td><td>: </td><td><span class="midline mt5 red" ><?php /*echo $arr2[$k]*$arr1[$k]." /-<br>";*/
                                                                                     echo " ".money_format("<i class='fa fa-inr'></i> %!.0n",$arr2[$k])."/-";

                                                                             ?></span></td></tr>
                                                                                  <tr><td>Shipping chrg</td><td>: </td>

                                                                                            <?php
                                                                      if($thisprodchrg)
                                                                      {
                                                                          if($rev3[$i]['payment_status']=="cod")
                                                                          {
                                                                              if($thisprodcodchrg=="Including COD ORDERS")
                                                                              {
                                                                                  ?>
                                                                                  <td> <!--<i class="fa fa-inr"></i> <?php echo $thisprodchrg; ?>-->

                                                                                   <?php
                                                                                         echo " ".money_format("<i class='fa fa-inr'></i> %!.0n",$thisprodchrg)."/-";
                                                                                    ?>
                                                                                    </td>

                                                                                  <?
                                                                              }
                                                                              else
                                                                              {
                                                                                  ?>
                                                                                   <td>  <i class="fa fa-inr"></i> <?php echo "0"; ?>  </td>
                                                                                  <?
                                                                              }
                                                                          }
                                                                          else
                                                                          {
                                                                              ?>
                                                                                 <td> <!--<i class="fa fa-inr"></i> <?php echo $thisprodchrg; ?>-->
                                                                                   <?php
                                                                                         echo " ".money_format("<i class='fa fa-inr'></i> %!.0n",$thisprodchrg)."/-";
                                                                                    ?>
                                                                                  </td>
                                                                              <?
                                                                          }
                                                                      }
                                                                      else
                                                                      {
                                                                          ?>
                                                                        <td>  <i class="fa fa-inr"></i> <?php echo "0"; ?>  </td>
                                                                      <?
                                                                      }
                                                                     ?>

                                                                                </tr>
                                                                            <tr><td>Paid</td><td>: </td><td><?php /* echo $price;*/        echo " ".money_format("<i class='fa fa-inr'></i> %!.0n",$price)."/-";   ?></td></tr>
                                                                            <tr><td>Promo code</td><td>: </td><td><?php echo $cpnname[0]['cpn_name'] ?></td></tr>
                                                                            <tr><td>You Saved</td><td>: </td><td><i class='fa fa-inr'></i><?php echo $save; ?></td></tr>

                                                                            </table>

                                                                            <?php
                                                                         }
                                                                         else
                                                                         {
                                                                           ?>
                                                                           <table class="t">
                                                                           <tr><td>Amount</td><td>:</td><td><?  $price= $arr2[$k];
                                                                                    echo " ".money_format("<i class='fa fa-inr'></i> %!.0n",$price)."/-";

                                                                               ?></td></tr>
                                                                                 <tr><td>Shipping</td><td>:</td>

                                                                                            <?php
                                                                      if($thisprodchrg)
                                                                      {
                                                                          if($rev3[$i]['payment_status']=="cod")
                                                                          {
                                                                              if($thisprodcodchrg=="Including COD ORDERS")
                                                                              {
                                                                                  ?>
                                                                                  <td> <!--<i class="fa fa-inr"></i> <?php echo $thisprodchrg; ?>-->
                                                                                     <?php
                                                                                         echo " ".money_format("<i class='fa fa-inr'></i> %!.0n",$thisprodchrg)."/-";
                                                                                     ?>
                                                                                    </td>

                                                                                  <?
                                                                              }
                                                                              else
                                                                              {
                                                                                  ?>
                                                                                   <td>  <i class="fa fa-inr"></i> <?php echo "0"; ?>  </td>
                                                                                  <?
                                                                              }
                                                                          }
                                                                          else
                                                                          {
                                                                              ?>
                                                                                 <td> <!--<i class="fa fa-inr"></i> <?php echo $thisprodchrg; ?>-->
                                                                                   <?php
                                                                                         echo " ".money_format("<i class='fa fa-inr'></i> %!.0n",$thisprodchrg)."/-";
                                                                                   ?>
                                                                                  </td>
                                                                              <?
                                                                          }
                                                                      }
                                                                      else
                                                                      {
                                                                          ?>
                                                                        <td>  <i class="fa fa-inr"></i> <?php echo "0"; ?>  </td>
                                                                      <?
                                                                      }
                                                                     ?>

                                                                                </tr>
                                                                                <tr><td>Paid</td><td>:</td><td> <?  $price= $arr2[$k]." /-";
                                                                                  echo " ".money_format("<i class='fa fa-inr'></i> %!.0n",$price)."/-";
                                                                                   ?></td></tr>
                                                                                <tr><td>Promo code</td><td>:</td><td>-</td></tr>
                                                                                <tr><td>You saved</td><td>:</td><td>0</td></tr>
                                                                           </table>
                                                                        <?php
                                                                         }
                                                                   }
                                                                   else
                                                                   {
                                                                       $price= $arr2[$k];
                                                                       echo " ".money_format("<i class='fa fa-inr'></i> %!.0n",$price)."/-";

                                                                   } ?>




                                                          </div>
                                                          </div>

                                                                  <div class="col-md-2 col-sm-4 col-xs-12">
                                                        <div class="borderb">


                                                                          <?php $fulldate= $rev3[$i]['payment_date'];

                                                                          $divide = explode(" ", $fulldate);

                                                                          ?>
                                                                          <div>
                                                                          <i class="fa fa-arrow-circle-o-right green space1" ></i><span class="green"></span> <br>
                                                                         <h5><b>Order</b></h5>
                                                                         <hr class="newsep">
                                                                          <table class="datet">
                                                                          <tr><td class="text-left"></td><td>Date</td><td>:</td><td class="text-left"><?php  echo $divide[0] ?></td></tr>
                                                                            <tr><td class="text-left"></td><td>Time</td><td>:</td><td class="text-left"><?php  echo $divide[1] ?></td></tr>
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
                                                                                  <button  class="btn greenBtn cancelpro" data-id="<?php echo $rev3[$i]['final_order']; ?>"  onclick="cancelrequestpro('<?php echo $rev3[$i]['final_order']; ?>','<?php echo $arr[$k];?>','<?php echo $arr1[$k];?>','<?php echo  $proddata[0]['prod_name']; ?>','<?php echo $price; ?>','<?php echo $mst[0]['mp_id']; ?>')" style="color:white;text-decoration:none;margin-top:10px;width:100%;" > Cancel</button>
                                                                                <?
                                                                                }

                                                                            }
                                                                          ?>


                                                                          </div>
                                                              </div>
                                                       </div>

                                                       <div class="col-md-2 col-sm-4 col-xs-12">
                                                             <div class="borderb">
                                                                <?php

                                                                     if(count($shipping)==0)
                                                                    {
                                                                        ?>
                                                                        <i class="fa fa-dot-circle-o red space1"></i><br>
                                                                           <h5><b>Dispatch</b></h5>
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

                                                                                <?
                                                                              $fulldate1 = $shipping[0]['shipped_date']; /* ."<br>Docket:".$shipping[0]['docket_no'];   ;  */
                                                                                    $divide1 = explode(" ", $fulldate1);

                                                                              ?>

                                                                           <i class="fa fa-check green space1"></i><br>

                                                                           <h5><b>Dispatch</b></h5>
                                                                              <hr class="newsep">
                                                                              <table class="datet">
                                                                              <tr><td>Date</td><td>:</td><td class="text-left"><?php  echo $divide1[0] ?></td></tr>
                                                                                <tr><td>Time</td><td>:</td><td class="text-left"><?php  echo $divide1[1] ?></td></tr>
                                                                              </table>
                                                                           <?php }
                                                                            else
                                                                            {

                                                                                ?>
                                                                           <i class="fa fa-check green space1"></i><br>

                                                                           <h5><b>Dispatch</b></h5>
                                                                               <hr class="newsep">
                                                                                   <div >  <span class="red">In Progress</span> </div>
                                                                                <?
                                                                            }
                                                                         }
                                                                         else
                                                                         {
                                                                            ?>


                                                                          <i class="fa fa-dot-circle-o red space1"></i><br>

                                                                           <div class="text-center"> Dispatch</div>
                                                                           <hr class="newsep">
                                                                            <?
                                                                         }

                                                                    }
                                                                 ?>
                                                                 </div>
                                                             </div>

                                                        <div class="col-md-2 col-sm-4 col-xs-12">
                                                            <div class="borderb">
                                                                <?php
                                                                    if(count($shipping)==0||$shipping[0]['shipped_date']=='')
                                                                    {
                                                                        ?>
                                                                        <i class="fa fa-dot-circle-o space1 red"></i> <br>
                                                                           <h5><b>Delivery</b></h5>
                                                                            <hr class="newsep">
                                                                        <?
                                                                    }
                                                                    else
                                                                    {
                                                                        if($shipping[0]['delivered_on']!='')
                                                                        {
                                                                            ?>

                                                                            <?
                                                                            $fulldate2 =$shipping[0]['delivered_on'];
                                                                             $divide2 = explode(" ", $fulldate2);

                                                                          ?>

                                                                           <i class="fa fa-check green space1" ></i><br>

                                                                           <h5><b>Delivery</b></h5>
                                                                          <hr class="newsep">
                                                                          <table class="datet">
                                                                          <tr><td>Date</td><td>:</td><td class="text-left"><?php  echo $divide2[0] ?></td></tr>
                                                                            <tr><td>Time</td><td>:</td><td class="text-left"><?php  echo $divide2[1] ?></td></tr>
                                                                          </table>

                                                                        <?php
                                                                        }
                                                                        else if($shipping[0]['shipped_date']!=''&&$shipping[0]['delivered_on']=='')
                                                                        {
                                                                            ?>


                                                                          <i class="fa fa-dot-circle-o space1 red"></i> <br>

                                                                           <h5><b>Delivery</b></h5>
                                                                            <hr class="newsep">
                                                                                <div class=""><span class="red ">In Progress</span> </div>
                                                                            <?
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
                                                                                                 <button class=" btn btn-primary returnpro" data-id="<?php echo $_REQUEST['ord']; ?>"  onclick="returnrequestpro('<?php echo $_REQUEST['ord']; ?>','<?php echo $arr[$cnt];?>','<?php echo $arr1[$cnt];?>','<?php echo  $proddata[0]['prod_name']; ?>','<?php echo $price; ?>','<?php echo $mst[0]['mp_id']; ?>')" style="color:white;text-decoration:none;margin-top:10px" > Return</button>
                                                                                              <?
                                                                                           }
                                                                                          else
                                                                                          {
                                                                                                ?>
                                                                                                 <abbr title="Out Of Return Policy"> <button class=" btn btn-primary returnpro" data-id="<?php echo $_REQUEST['ord']; ?>"  onclick="returnrequestpro('<?php echo $_REQUEST['ord']; ?>','<?php echo $arr[$cnt];?>','<?php echo $arr1[$cnt];?>','<?php echo  $proddata[0]['prod_name']; ?>','<?php echo $price; ?>','<?php echo $mst[0]['mp_id']; ?>')" style="color:white;text-decoration:none;margin-top:10px" disabled>No Return</button></abbr>
                                                                                                <?
                                                                                          }
                                                                                       }

                                                                                    }
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                           <i class="fa fa-dot-circle-o red space1" ></i>
                                                                        <?
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

                                                                                    }
                                                                            }
                                                                         }



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
                                                                      <div class="cancelid pull-left"> Cancellation ID  <?php echo $prodcancel[0]['cancelation_id']; ?>
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
                                                                       </div>
                                                                        <div class="pull-right" >
                                                                       <button type="button" style="float:right" id="dispbtn<?php echo $i; ?>" onclick="toggledetails('dispbtn<?php echo $i; ?>','details<?php echo $i; ?>')"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                                                                       </div>
                                                                 </div>
                                                                 <div class="row">
                                                                 <div class="col-md-12 col-sm-12 col-xs-12 cancelationdetails" id="details<?php echo $i; ?>" style="">
                                                                      <table class="table table-bordered">
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
                                                                 </div>
                                                              <?
                                                          }
                                                           if(count($prodreturn))
                                                          {
                                                              ?>

                                                              <?php

                                                              ?>
                                                                 <div class="col-md-12 col-sm-12 col-xs-12 returnbox">
                                                                     <div class="col-md-6 col-sm-6 col-xs-6 text-left" style="margin-top:5px;">  Return ID  #<?php echo $prodreturn[0]['return_id']; ?>
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
                                                                       </div>
                                                                       <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                                                       <button type="button" style="float:right" id="dispbtn1<?php echo $i; ?>" onclick="toggledetails1('dispbtn1<?php echo $i; ?>','details1<?php echo $i; ?>')"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                                                                      </div>
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

                                                          <!-- </fieldset>      -->


                                          </li>
                                </div>
                              <?

                           }
                       ?>
                         </fieldset>
                         </div>
                       <?
                      }
                      ?>
                   <?php if (count($orders) > count($rev3)) {?>
                    	<li class="loadbutton pull-right"><button class="loadmore btn btn-primary"  data-page="2">Load More</button></li>
                           <?php
                         }
                         else {
                           ?>

          	   <!-- <li class="cb">No More Orders</li>            -->
                        <?php
                      }
                    }
                    ?>
            </div>
   </div>

</div>
</div>
     <div class="modal fade" id="cancelorder" tabindex="-1" role="dialog"   >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
                  </div>
                  <div class="modal-body" id="modal-body">

                  </div>

                </div>
              </div>
            </div>

<?php include 'footer.php' ?>



     <script>
        function goBack() {
            window.history.back();
        }

        $(document).ready(function(){
        $("#track").click(function(){
         $.fancybox({
               autoDimensions: true,
             'content':'<div class="popup"><div class="head">Tracking History</div><div>  <table><tr><td>Order Placed on date</td>   <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td>11/01/2016</td></tr><tr><td>Material Dispatched On Date</td>   <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td>11/01/2016</td></tr><tr><td>Material Delivered On Date</td>   <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td>11/01/2016</td></tr></table></div></div>'
         });
        })
        })
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


             function cancelrequestpro(orderid,invid,qty,proname,price,masterid)
            {

                  $.ajax({
                  type:"POST",
                  url:"cancelrequestpro.php",
                  data:{order_id:orderid,proid:invid,proname:proname,price:price,masterid:masterid,qty:qty},
                  success:function(response){
                   $("#myModalLabel").html("Product Cancelation Request")
                   $("#modal-body").html(response);
                   $("#cancelorder").modal("show");
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
                   $("#cancelorder").modal("show");
                  }
                  });

            }

            function validatedata()
           {
                   var invid=contactform.elements["invid"].value;
                   var price=contactform.elements["price"].value;
                   var masterid=contactform.elements["masterid"].value;
                    var qty=contactform.elements["qty"].value;
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
                              $(".msgs").html("Please Try Again Later").addClass("alert alert-danger");
                              $("#submit").val("Send");
                               $(".sendingmsg1").html("");

                         }
                         if(response==1)
                         {
                                   $("#submit").val("Send");

                                  $("#cancelorder").modal("hide");
                                 location.reload();
                                  $(".msgs1").html("Your Request Generated Sucsessfully. Our Team Will Contact You Soon").addClass("alert alert-success").fadeout(50000);
                                    $(".sendingmsg1").html("");
                         }


        	          }

        	        }
        	      });

           }

           function canceldata()
           {
                $("#cancelorder").modal("hide");
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

                         $("#cancelorder").modal("hide");
                                 location.reload();
                                  /*$(".msgs1").html("Your Request Generated Sucsessfully. Our Team Will Contact You Soon").css({'color':'green'}).fadeout(50000);    */
                                   $(".sendingmsg").html("");
                         }


        	          }

        	        }
        	      });
                }
           }


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
     </div>
</body>
</html>