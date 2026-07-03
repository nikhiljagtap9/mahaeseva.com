<?php include("../../includes/configuration.php");
$getclient = selectQuery(SUPPORTSTAFF,"*","isActive='1' AND isDel='0' AND acc_type='Client' order by emp_name ASC ");
$getgroup = selectQuery(SUPPORTSTAFFGROUP,"*","group_status='1' and isDel='0'"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> : Add Project</title>
    <?php include('../commoncss.php'); ?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php'); ?>
    <?php include('../cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Projects</h2></div></div>
                <div class="card-body">
                    <table class="example table table-bordered">
                        <thead><tr><th>#</th><th>Client Name</th><th>Project</th><th>Client Email</th><th>Mobile</th><th>Status</th><th>Action</th></tr></thead>
                        <tbody>
                            <?php for($i=0;$i<count($getclient);$i++){ ?>
                            <tr>
                                <td><?php echo $i+1; ?></td>
                                <td><a href="updateproject.php?empid=<?php echo base64_encode($getclient[$i]['emp_id'])?>"><?php echo $getclient[$i]['emp_name']; ?> </a></td>
                                <td><?php echo $getclient[$i]['projects']; ?></td>
                                <td><?php echo $getclient[$i]['emp_email']; ?></td>
                                <td><?php echo $getclient[$i]['mobile']; ?></td>
                                <td><?php if($getclient[$i]['isActive']==1){ echo "Active"; }
                                else{ "Deactive"; } ?></td>
                                <td><a href="" onClick="delclient('<?php echo $getclient[$i]['emp_id']?>');" class="deletebtn red"><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
    </div>
</div>
<script src="<?php echo SITEURL; ?>/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script>$(document).ready(function(){ $('.example').DataTable(); });</script>
<script>
function delclient(clientid){
    if(confirm("Are you sure want to delete?")){
        info11 = {clientid:clientid, action:"del_client"};
        $.ajax({
            type:"POST", url:"addclientdata.php", data:info11,
            success:function(response){
                if(response==1){ window.location="<?php echo ADMINURL; ?>/support/viewclient.php"; }
                else{ alert("Error In Delete"); }
            }
        });
    }
}
</script>
</body>
</html>