<?php include("../../includes/configuration.php"); $getdata = selectQuery(STATUS,"*","isdel='0'"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Manage Status</title>
    <?php include('../commoncss.php'); ?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php'); ?>
    <?php include('../cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2">
                    <div><h2 class="card-head-title">Manage Status</h2></div>
                    <div class="btn-actions-pane-right"><a href="addstatus.php" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add New Status</a></div>
                </div>
                <div class="card-body">
                    <div class="msgs"></div>
                    <table class="example table table-bordered">
                        <thead><tr><th>#</th><th>Status Name</th><th>Active / Deactive</th><th>Delete</th></tr></thead>
                        <tbody>
                            <?php for($i=0;$i<count($getdata);$i++){ ?>
                            <tr>
                                <td><?php echo $i+1; ?></td>
                                <td><a href="viewstatus.php?s_id=<?php echo base64_encode($getdata[$i]['s_id']) ?>"><?php echo $getdata[$i]['status']; ?></a></td>
                                <td><input type="checkbox" class="tg"  data-toggle="toggle" data-on="Active" data-off="Deactive" data-id="<?php echo $getdata[$i]['s_id']; ?>" data-width="100" data-height="30" id="checkbox_<?php echo $getdata[$i]['s_id']; ?>" name="checkbox_<?php echo $getdata[$i]['s_id']; ?>" <?php if($getdata[$i]['isActive']==1){ echo "checked";}else{echo "";} ?>></td>
                                <td><button type="button" onclick="del('<?php echo $getdata[$i]['s_id']; ?>')" class="deletebtn btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></td>
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
<script>
$(document).ready(function(){
    $('.example').DataTable();
    $(".tg").on("change",function(){
        var uid = $(this).attr('data-id'); var getid = $(this).attr('id'); var c = $("#"+getid+":checked").val();
        if(c=="on"){     
            var info = {uid:uid,status:"1"};
            $.ajax({
                type:"POST", url:"statuschng.php", data:info,
                success:function(response){
                    if(response==1){ $('.msgs').fadeIn().addClass("alert alert-success").html("Status Activated Successfully").delay(5000).fadeOut(); } else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
                }
            });
        } else{
            var info = {uid:uid, status:"0"};
            $.ajax({
                type:"POST", url:"statuschng.php", data:info,
                success:function(response){
                    if(response==1){ $('.msgs').fadeIn().addClass("alert alert-success").html("Status Deactivated Successfully").delay(5000).fadeOut(); } else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
                }
            });
        }
    });
})
function del(id){      
    var uid = id;
    if(id!=""){
        if(confirm("Are you Deleting status?")){
            var info = {uid:uid};
            $.ajax({ type:"POST", url:"del.php", data:info,
                success:function(response){
                    if(response==1){ $('.msgs').fadeIn().addClass("alert alert-success").html("Status Deleted Successfully").delay(5000).fadeOut(); location.reload();
                    } else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
                }
            });
        } else{ }
    }
}
</script>
</body>
</html>