<?php include("../../includes/configuration.php"); $getstaffgrp = selectQuery(SUPPORTSTAFFGROUP,"*","isdel='0'"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Support Staff Group</title>
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
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Manage Staff Groups</h2></div><div class="btn-actions-pane-right"><a href="addstaffgroup.php" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add New Staff Group</a></div></div>
                <div class="card-body">
                    <div class="msgs"></div>
                    <table class="example table table-bordered">
                        <thead><tr><th>#</th><th>Group Name</th><th>Active / Deactive</th><th>Delete</th></tr></thead>
                        <tbody>
                            <?php for($i=0;$i<count($getstaffgrp);$i++){ ?>
                            <tr>
                                <td class="td2"><?php echo $i+1; ?></td>
                                <td><a href="viewstaffgrodetail.php?gid=<?php echo base64_encode($getstaffgrp[$i]['group_id']) ?>"><?php echo $getstaffgrp[$i]['group_name']; ?></a></td>
                                <td><input type="checkbox" class="tg" data-toggle="toggle" data-on="Active" data-off="Deactive" data-id="<?php echo $getstaffgrp[$i]['group_id']; ?>" data-width="100" data-height="30" id="checkbox_<?php echo $getstaffgrp[$i]['group_id']; ?>" name="checkbox_<?php echo $getstaffgrp[$i]['group_id']; ?>" <?php if($getstaffgrp[$i]['group_status']==1){echo "checked";}else{echo "";} ?>></td>
                                <td><button type="button" onclick="del('<?php echo $getstaffgrp[$i]['group_id']; ?>')" class="deletebtn btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></td>
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
$('.example').DataTable();
$(".tg").on("change",function(){
    var uid = $(this).attr('data-id'); var getid = $(this).attr('id'); var c = $("#"+getid+":checked").val();
    var action = "statusupdate";
    if(c=="on"){
        var info={uid:uid,status:"1",action:action};
        $.ajax({ type:"POST", url:"staffgroupdata.php", data:info,
            success:function(response){
                if(response==1){  $('.msgs').fadeIn().addClass("alert alert-success").html("Staff Activated Successfully").delay(5000).fadeOut(); }
                else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
            }
        });
    } else{
        var info = {uid:uid,status:"0", action:action};
        $.ajax({
            type:"POST",
            url:"staffgroupdata.php",
            data:info,
            success:function(response){
                if(response==1){     
                    $('.msgs').fadeIn().addClass("alert alert-success").html("Staff Group Deactivated Successfully").delay(5000).fadeOut();
                } else{  $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
            }
        });
    }
});   
function del(id){      
    var uid = id; var action="del";
    if(id!=""){
        if(confirm("Info : Deleting department will affect the staff members belonging to the department, so please redefine the department access for such members ")){
            var info = { uid:uid, action:action };
            $.ajax({
                type:"POST", url:"staffgroupdata.php", data:info,
                success:function(response){
                    if(response==1){
                        $('.msgs').fadeIn().addClass("alert alert-success").html("Staff Group Deleted Successfully").delay(5000).fadeOut();
                        location.reload();
                    } else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
                }
            });
        } else{ }
    }
}
</script>
</body>
</html>