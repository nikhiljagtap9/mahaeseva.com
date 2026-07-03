<?php include("../includes/configuration.php");
$chin = curl_init(); curl_setopt($chin, CURLOPT_URL, "https://www.spanel.surun.in/invoiceapi/".apikey."/all");
curl_setopt($chin, CURLOPT_REFERER, SITEURL); curl_setopt($chin, CURLINFO_HEADER_OUT, true); curl_setopt($chin, CURLOPT_RETURNTRANSFER, 1); $outputin = curl_exec($chin); curl_close($outputin);
$invoicedatafromapi=unserialize($outputin);
$inv = $invoicedatafromapi['invoices']; ?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | All Invoices</title>
    <? include "commoncss.php"; ?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
    <? include 'header.php'; ?>
    <? include 'cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-"0>
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Invoice History</h2></div></div>
                <div class="card-body">
                    <div class="table-responsive">
                       <div class="msgs"></div>
                        <table class="example table table-bordered">
                            <thead><tr><th>#</th><th>Invoice ID</th><th>Invoice For</th><th>Invoice Amount</th><th>Invoice date</th></tr></thead>
                            <tbody>
                                <?php for($i=0;$i<count($inv);$i++){ ?>
                                <tr>
                                    <td><?php echo $i+1; ?></td>
                                    <td><a href="invoicedetails.php?cid=<?php echo base64_encode($inv[$i]['invoice_id']); ?>"><?php echo $inv[$i]['invoice_id']; ?></a></td>
                                    <td><?php echo $inv[$i]['invoice_type']; ?></td>
                                    <td><i class="fa fa-inr"></i> <?php echo $inv[$i]['final_amount']; ?></td>
                                    <td><?php echo date("d M Y h:i a",strtotime($inv[$i]['invoice_date'])) ?></td>
                                </tr>
                                <? } ?>
                            </tbody>
                       </table>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php');?>
    </div>
</div>
<script src="<?php echo SITEURL; ?>/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script>$(document).ready(function(){ $('.example').DataTable(); });</script>
</body>
</html>