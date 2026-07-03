<?php
      include("../includes/configuration.php");
      $inid=base64_decode($_REQUEST['cid']);
      $chin = curl_init();
     curl_setopt($chin, CURLOPT_URL, "https://www.spanel.surun.in/invoiceapi/".apikey."/".$inid);
     curl_setopt($chin, CURLOPT_REFERER, SITEURL);
     curl_setopt($chin, CURLINFO_HEADER_OUT, true);
     curl_setopt($chin, CURLOPT_RETURNTRANSFER, 1);

     $outputin = curl_exec($chin);
     curl_close($outputin);
     $invoicedatafromapi=unserialize($outputin);

?>
<!DOCTYPE html>
<html lang=''>

<head>

 <title><?php echo SITENAME; ?> Admin</title>
<? include "commoncss.php"; ?>
<link rel="stylesheet" href="../css/jquery.dataTables.min.css">
<style>
 .invoice-head
 {
   background:#5F425E;color:#fff
 }

 .cartlogo
 {
     margin-top:10%
 }

</style>
</head>
<body>
<div class="page-body-wrapper">
    <? include 'header.php'; ?>
    <? include 'cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
      <div class="card">
         <div class="panel-body">
            <div class="panel-title pull-left">  Invoice  - #<?php echo $invoicedatafromapi['invoice_id']; ?></div>
             <div class="panel-title pull-right">
                <a href="<?php echo ADMINURL; ?>/allinvoices.php" class="btn btn-default btn-sm" type="button">Back</a>
             </div>
         </div>
      </div>

      <div class="card">
                <div class="panel-body">
                    <div class="row invoice-head">
                      <div class="col-md-6 pull-left" style="margin-bottom:20px">
                         <h3><?php echo $invoicedatafromapi['company']; ?></h3>

                         <?php echo $invoicedatafromapi['address']; ?>
                      </div>
                      <div class="col-md-3 col-md-offset-3 text-center imgbox">
                       <img src="<?php echo $invoicedatafromapi['logo']; ?> " alt="" class="cartlogo"/>
                      </div>

                    </div>

                    <div class="row">
                    <div class="col-md-12"><h5><b>To,</b></h5></div>
                      <div class="col-md-6">
                          <div><b><?php echo $invoicedatafromapi['client']; ?></b></div>
                          <div><b><?php echo $invoicedatafromapi['project']; ?></b></div>
                      </div>
                      <div class="col-md-6  pull-right">
                        <div class="row">
                         <div class="col-md-3"><b> Invoice ID</b></div>
                         <div class="col-md-6"><?php echo $invoicedatafromapi['invoice_id']; ?></div>
                        </div>
                        <div class="row">
                         <div class="col-md-3"><b> Date</b></div>
                         <div class="col-md-6"><?php echo date("d M Y h:i a",strtotime($invoicedatafromapi['invoice_date'])); ?></div>
                        </div>

                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <table class="table table-bordered">
                         <tr style="background:#C5513A;color:#fff">
                          <th>Sr. No</th>
                          <th>Perticular</th>
                          <th>Price</th>
                         </tr>

                           <?php
                            if($invoicedatafromapi['invoice_type']<>'SMS Renewal'&&$invoicedatafromapi['invoice_type']<>'Domain Renewal')
                            {
                                ?>
                                   <tr>
                                       <td>1</td>

                                      <td><?php echo $invoicedatafromapi['invoice_type']; ?></td>
                                       <td>  <i class="fa fa-inr"></i> <?php echo $invoicedatafromapi['invoice_amount']; ?> </td>
                                     </tr>
                                  <tr>
                                    <td>2</td>
                                    <td>

                                      <div class="col-md-12">
                                         <h5>Hosting</h5>
                                      </div>
                                      <div class="col-md-12">
                                      <ol>
                                       <li><span><b>Hosting Server  : </b></span> <span><?php echo $invoicedatafromapi['hosting_server']; ?></span></li>
                                      <!-- <li><span><b>Hosting Server IP : </b></span> <span><?php echo $invoicedatafromapi['hosting_server_ip']; ?></span></li>  -->
                                        <li><span><b>Hosting validity : </b></span> <span><?php echo date("d M Y",strtotime($invoicedatafromapi['hosting_end_date'])); ?></span></li>
                                      </ol>
                                      </div>
                                    </td>
                                    <td>
                                     <?php
                                        if(is_numeric($invoicedatafromapi['hosting_price']))
                                        {
                                            ?>
                                              <i class="fa fa-inr"></i> <?php echo $invoicedatafromapi['hosting_price']; ?>
                                            <?
                                        }
                                        else
                                        {
                                            echo $invoicedatafromapi['hosting_price'];
                                        }
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>3</td>
                                    <td>
                                      <div class="col-md-12">
                                         <h5>Domain</h5>
                                      </div>
                                      <div class="col-md-12">
                                      <ol>
                                       <li><span><b>Domain Purchase By : </b></span> <span><?php echo $invoicedatafromapi['domain_purchase_by']; ?></span></li>
                                       <li><span><b>Domain Registrar: </b></span> <span><?php echo $invoicedatafromapi['domain_registrar']; ?></span></li>
                                        <li><span><b>Domain validity : </b></span> <span><?php echo date("d M Y",strtotime($invoicedatafromapi['domain_registrar_end_date'])); ?></span></li>
                                      </ol>
                                      </div>
                                    </td>
                                    <td>
                                     <?php
                                        if(is_numeric($invoicedatafromapi['domain_price']))
                                        {
                                            ?>
                                              <i class="fa fa-inr"></i> <?php echo $invoicedatafromapi['domain_price']; ?>
                                            <?
                                        }
                                        else
                                        {
                                           echo $invoicedatafromapi['domain_price'];
                                        }
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>4</td>
                                    <td>
                                      <div class="col-md-12">
                                         <h5>SMS</h5>
                                      </div>
                                      <div class="col-md-12">
                                      <ol>
                                       <li><span><b>SMS Quantity : </b></span> <span><?php echo $invoicedatafromapi['total_sms_alocate']; ?></span></li>

                                        <li><span><b>SMS validity : </b></span> <span><?php echo date("d M Y",strtotime($invoicedatafromapi['sms_end_date'])); ?></span></li>
                                      </ol>
                                      </div>
                                    </td>
                                    <td>
                                     <?php
                                        if(is_numeric($invoicedatafromapi['sms_price']))
                                        {
                                            ?>
                                              <i class="fa fa-inr"></i> <?php echo $invoicedatafromapi['sms_price']; ?>
                                            <?
                                        }
                                        else
                                        {
                                           echo $invoicedatafromapi['sms_price'];
                                        }
                                      ?>
                                    </td>
                                  </tr>
                                <?
                            }
                            else if($invoicedatafromapi['invoice_type']=='SMS Renewal')
                            {
                                ?>
                                 <tr>
                                    <td>1</td>
                                    <td>
                                      <div class="col-md-12">
                                         <h5>SMS</h5>
                                      </div>
                                      <div class="col-md-12">
                                      <ol>
                                       <li><span><b>SMS Quantity : </b></span> <span><?php echo $invoicedatafromapi['total_sms_allocated']; ?></span></li>

                                        <li><span><b>SMS validity : </b></span> <span><?php echo date("d M Y",strtotime($invoicedatafromapi['sms_end_date'])); ?></span></li>
                                      </ol>
                                      </div>
                                    </td>
                                    <td>
                                     <?php
                                        if(is_numeric($invoicedatafromapi['sms_price']))
                                        {
                                            ?>
                                              <i class="fa fa-inr"></i> <?php echo $invoicedatafromapi['sms_price']; ?>
                                            <?
                                        }
                                        else
                                        {
                                           echo $invoicedatafromapi['sms_price'];
                                        }
                                      ?>
                                    </td>
                                  </tr>
                                <?
                            }
                             else if($invoicedatafromapi['invoice_type']=='Domain Renewal')
                            {
                                ?>
                                 <tr>
                                    <td>1</td>
                                    <td>
                                      <div class="col-md-12">
                                         <h5>Domain</h5>
                                      </div>
                                      <div class="col-md-12">
                                      <ol>
                                       <li><span><b>Domain Purchase By : </b></span> <span><?php echo $invoicedatafromapi['domain_purchase_by']; ?></span></li>
                                       <li><span><b>Domain Registrar: </b></span> <span><?php echo $invoicedatafromapi['domain_registrar']; ?></span></li>
                                        <li><span><b>Domain validity : </b></span> <span><?php echo date("d M Y",strtotime($invoicedatafromapi['domain_regstrar_end_date'])); ?></span></li>
                                      </ol>
                                      </div>
                                    </td>
                                    <td>
                                     <?php
                                        if(is_numeric($invoicedatafromapi['domain_price']))
                                        {
                                            ?>
                                              <i class="fa fa-inr"></i> <?php echo $invoicedatafromapi['domain_price']; ?>
                                            <?
                                        }
                                        else
                                        {
                                           echo $invoicedatafromapi['domain_price'];
                                        }
                                      ?>
                                    </td>
                                  </tr>
                                <?
                            }

                             if($invoicedatafromapi['cgst']!="0"&&$invoicedatafromapi['cgst']!="")
                             {
                                 ?>
                                  <tr>
                                    <td colspan="2" class="text-right"><b>CGST (9%)</b></td>
                                    <td colspan="2"><i class="fa fa-inr"></i> <?php echo $invoicedatafromapi['cgst'] ?></td>
                                   </tr>
                                 <?
                             }
                             if($invoicedatafromapi['sgst']!="0"&&$invoicedatafromapi['sgst']!="")
                             {
                                 ?>
                                    <tr>
                                    <td colspan="2" class="text-right"><b>SGST (9%)</b></td>
                                    <td colspan="2"><i class="fa fa-inr"></i> <?php echo $invoicedatafromapi['sgst'] ?></td>
                                   </tr>
                                 <?
                             }
                           ?>

                           <tr>
                            <td colspan="2" class="text-right"><b>Total Amount</b></td>
                            <td colspan="2"><i class="fa fa-inr"></i> <?php echo $invoicedatafromapi['final_amount'] ?></td>
                           </tr>
                        </table>
                      </div>
                    </div>
                </div>
            </div>

    </div>
<?php include('footer.php');?>
 <script src="<?php echo SITEURL; ?>/js/jquery.dataTables.min.js"></script>
</div>
</div>

</body>
</html>