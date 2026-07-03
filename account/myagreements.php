<?php $user = $_SESSION['reguser']; $userdata = selectQuery(WEB_USER,"*","u_id=".$user); $orders = selectQuery(AGR,"*","agree_by=".$user." and isDel='0'  order by agree_id DESC"); ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITE_TITLE; ?> | My Agreement</title>
    <?php include 'commoncss.php' ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-726761326"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){ dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'AW-726761326');
    </script>
</head>
<body class="bg-light">
<?php include 'menu.php' ?>
<div class="content py-4">
    <div class="container">
        <h5 class="mb-3">My Agreements <span class="badge badge-pill badge-danger"><?php echo count($orders); ?></span></h5>
        <div class="row">
            <?php include('sidebar.php')?>
            <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">My Agreement</h5>
           	            <div class="order_list">
                            <? $rev3 = selectQuery(AGR, "*","agree_by=".$user." order by agree_id DESC");
                            if(count($rev3) == 0){ ?>
                            <div class="cc text-center text-muted">No Agreement Found</div>
                            <?php } else{ ?>
                            <div class="table-responsive">
                                <table class="example table table-bordered mb-0">
                                    <thead class="bg-light"><tr><th>#</th><th>Agreement No.</th><th>Entry Date</th><th>Fees</th><th>Payment</th><th>Status</th><th>View</th></tr></thead>
                                    <tbody>
                                    <? for($i = 0; $i < count($rev3); $i++){ ?>
                                    <tr>
                                        <td><?php echo $i+1; ?></td>
                                        <td><?php echo $rev3[$i]['agreement_no']; ?></td>
                                        <td><?php echo date("d M Y h:i a",strtotime($rev3[$i]['entry_on'])) ?></td>
                                        <td>Rs. <?php echo $rev3[$i]['total_charges']; ?></td>
                                        <td><?php if($rev3[$i]['payment_mode']==""||($rev3[$i]['payment_mode']=="Online"&&$rev3[$i]['isPaid']=="0")){ ?>
                                        <a href="<?php echo SITEURL; ?>/pay/<?php echo base64_encode($rev3[$i]['agreement_no']); ?>" class="btn btn-primary btn-sm">Pay Now</a>
                                        <? } else if($rev3[$i]['payment_mode']=="COD"){ echo "COD"; }
                                        else if($rev3[$i]['payment_mode']=="Online"&&$rev3[$i]['isPaid']=="1"){ echo "Paid"; } ?></td>
                                        <td><?php echo $rev3[$i]['agreement_status']; ?></td>
                                        <td><a href="<?php echo SITEURL; ?>/account/agreement_view/<?php echo base64_encode($rev3[$i]['agreement_no']); ?>" target="_blank">View</a></td>
                                    </tr>
                                    <? } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>
</body>
</html>