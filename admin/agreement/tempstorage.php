<?php include("../../includes/configuration.php"); $tempdate = selectQuery(TEMP_STORE,"*","1 order by store_id DESC"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | Temporary Storage</title>
    <?php include('../commoncss.php');?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php') ?>
    <?php include('../cssmenu.php') ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Temporary</h2></div></div>
                <div class="card-body">
                    <div class="msgs_new"></div>
                    <div class="table-responsive">
                        <table class="example table table-bordered" id="employee-grid">
                            <thead><tr><th>#</th><th>Client</th><th>Mobile</th><th>Email</th><th>Token No</th><th colspan="2">Action</th></tr></thead>
                            <tbody>
                                <?php for($i=0;$i<count($tempdate);$i++){ ?>
                                <tr>
                                    <td><?php echo $i+1; ?></td>
                                    <td><?php echo $tempdate[$i]['fname']." ".$tempdate[$i]['lname']; ?></td>
                                    <td><?php echo $tempdate[$i]['mobile']; ?></td>
                                    <td><?php if($tempdate[$i]['email']!=""){echo $tempdate[$i]['email'];}else{echo "[Not Defined]";} ?></td>
                                    <td><?php echo $tempdate[$i]['tokenno']; ?></td>
                                    <td><a href="tempdetails.php?tempid=<? echo base64_encode($tempdate[$i]['store_id']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a></td>
                                    <td><button type="button" class="btn btn-danger btn-sm" onclick="del('del_tempdata','<?php echo $tempdate[$i]['store_id']; ?>')"><i class="fa fa-trash"></i></button></td>
                                </tr><? } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../footer.php'?>
    </div>
</div>
<div class="modal fade dellandlord" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"><div class="modal-dialog modal-sm" role="document"><div class="modal-content"></div></div></div>
<script src="<?php echo SITEURL; ?>/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script>$(document).ready(function(){ $('#employee-grid').DataTable(); });</script>
<script>
function del(action,id){
    info = {action:action,id:id}
    $.ajax({
        type:"POST", url:"ajax.php", data:info, success:function(response){ $(".dellandlord").modal("show"); $(".dellandlord .modal-content").html(response); }
    });
}
function delconfirmed(action,id){
    info={action:action,id:id}
    $.ajax({
        type:"POST", url:"ajax.php", data:info, success:function(response){ location.reload(); }
    });
}
function cancelupdate1(){ $(".dellandlord").modal("hide"); $(".dellandlord .modal-content").html("") }
</script>
</body>
</html>