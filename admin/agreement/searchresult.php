<?php include("../../includes/configuration.php");
$searchby = $_REQUEST['searchby'];
$searchstring1 = $_REQUEST['searchfld'];
if($searchby=='Tenant'){ $q1 = selectQuery(AGR_TENENT,"*","tenent_name LIKE '%".$searchstring1."%'  "); }
if($searchby=='Landlord'){ $q1 = selectQuery(AGR_LANDLORD,"*","landlord_name LIKE '%".$searchstring1."%'  ");}
if($searchby=='Token'){ $q1 = selectQuery(AGR,"*","govt_token_no LIKE '%".$searchstring1."%'  "); } ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | Search Result</title>
    <?php include('../commoncss.php');?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php') ?>
    <?php include('../cssmenu.php') ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Search</h2></div></div>
                <div class="card-body border-bottom pb-0 pb-sm-3"><?php include("search.php");?></div>
                <div class="card-body">
                    <p class="search">Search result for <i><?php echo $searchstring1;?></i> into <i><?php echo $searchby;?></i> is :</p>
                     <div class="table-responsive">
                        <table class="example table table-bordered" id="search">
                            <?php if(count($q1)){ ?>
                            <thead><tr><th>#</th><th>Agreement ID</th><th>Token No</th><th>Posted By</th><th>Entry Date</th><th>Payment</th><th>Status</th><th>Action</th></tr></thead>
                            <?php } ?>
                            <tbody>
                                <?php $cnt = 1;
                                for($i=0;$i<count($q1);$i++){
                                $gettoken = selectQuery(AGR,"*","agreement_no='".$q1[$i]['agreement_no']."' and isDel='0'");
                                if(count($gettoken)){
                                $client = selectQuery(WEB_USER,"u_fname,u_lname","u_id=".$gettoken[0]['agree_by']);
                                $cname = $client[0]['u_fname']." ".$client[0]['u_lname'];
                                if($gettoken[0]['payment_mode']!=""){
                                    $mode = $gettoken[0]['payment_mode'];
                                    if($gettoken[0]['isPaid']=="1"){
                                        $paystatus="<span class='text-success'>(Paid)</span>";
                                    } else{
                                        $paystatus="<span class='text-danger'>(Pending)</span>";
                                    }
                                } else{
                                    $mode = "<span class='text-danger'>Not Processed</span>";
                                    $paystatus = "";
                                }
                                $delfunc = "del('del_agreement','".$gettoken[0]['agreement_no']."')";
                                $action = '<button type="button" class="btn btn-danger btn-sm" onclick="'.$delfunc.'"><i class="fa fa-trash"></i></button>'; ?>
                                <tr>
                                    <td><?php echo $cnt++;?></td>
                                    <td><?php echo "<a href='agreementdetails.php?agr=".base64_encode($q1[$i]['agreement_no'])."'>".$q1[$i]['agreement_no']."</a>";?></td>
                                    <td><?php echo $gettoken[0]['govt_token_no']; ?></td>
                                    <td><?php echo $cname; ?></td>
                                    <td><?php echo date("d M Y",strtotime($gettoken[0]['entry_on']))."<br>".date("h:i a",strtotime($gettoken[0]['entry_on']))?></td>
                                    <td><?php echo $mode ?> <div class='small'><?php echo $paystatus;?></div></td>
                                    <td><?php echo $gettoken[0]['agreement_status']; ?></td>
                                    <td><?php echo $action; ?></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                        <?php if(count($q1)<=0){ ?><p>Records Not Found</p><?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../footer.php'?>
    </div>
</div>
<script src="<?php echo SITEURL; ?>/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function(){ $('.example').DataTable(); });
</script>
</body>
</html>