<?php include("../../includes/configuration.php"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | Rent Agreements</title>
    <?php include '../commoncss.php';?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
    <? include '../header.php'; ?>
    <? include '../cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center">
                    <div><h2 class="card-head-title">Rent Agreements</h2></div>
                    <?php if($getusertype=='Admin'){ ?> <div class="btn-actions-pane-right"><button type="button" class="btn btn-primary btn-sm generate" onclick="generatereport()">Extract Report</button></div> <? } ?>
                </div>
                <div class="card-body">
                    <form id="report" action="generate_tenant_agree_report.php">
                        <input type="hidden" name="data1" class="form-control" value="<?php echo base64_encode($host_name); ?>">
                        <input type="hidden" name="data2" class="form-control" value="<?php echo base64_encode($database); ?>">
                        <input type="hidden" name="data3" class="form-control" value="<?php echo base64_encode($username); ?>">
                        <input type="hidden" name="data4" class="form-control" value="<?php echo base64_encode($password); ?>">
                    </form>
                    <div class="row border-bottom pb-3 mb-4">
                        <div class="col-12">
                            <h6 class="mb-3">Search</h6>
                            <?php include("search.php");?>
                        </div>
                    </div>
                    <div class="msgs_new"></div>
                    <div class="table-responsive">
                        <table class="example table table-bordered" id="employee-grid">
                            <thead><tr><th>#</th><th>Agreement ID </th><th>Token No</th><th>Posted By</th><th>Entry Date</th><th>Payment</th><th>Status</th><th>Action</th></tr></thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade dellandlord" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document"><div class="modal-content"></div></div>
            </div>
        </div>
        <?php include '../footer.php'?>
    </div>
</div> 
<script src="<?php echo SITEURL; ?>/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function(){
    var dataTable = $('#employee-grid').DataTable({
        "processing": true, "paging": true, "serverSide": true, "searching": { "regex": true },
        "pageLength": 10, "lengthMenu": [ [10, 25, 50, 100], [10, 25, 50, 100] ],
        "ajax":{
            url :"agr_grid_data.php",
            type: "post",
            error: function(){
                $(".employee-grid-error").html("");
                $("#employee-grid").append('<tbody class="employee-grid-error text-muted"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#employee-grid_processing").css("display","none");
            }
        }
    });
});
function del(action,id){
    info = { action:action, id:id }
    $.ajax({
        type:"POST", url:"ajax.php", data:info, success:function(response){ $(".dellandlord").modal("show"); $(".dellandlord .modal-content").html(response); }
    });
}
function delconfirmed(action,id){
    info={action:action,id:id}
    $.ajax({ type:"POST", url:"ajax.php", data:info, success:function(response){ location.reload(); }
    });
}
function cancelupdate1(){ $(".dellandlord").modal("hide"); $(".dellandlord .modal-content").html("") }
function generatereport(){ $("#report").submit(); }
</script>
</body>
</html>