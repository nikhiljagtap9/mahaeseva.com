<?php include("../../includes/configuration.php");
/* $getstaff=selectQuery(SUPPORTSTAFF." as e LEFT JOIN ".SUPPORTDEPT." as d on e.department=d.dept_id LEFT JOIN ".SUPPORTSTAFFGROUP." as g on e.emp_group=g.group_id","*","e.isdel='0' order by e.emp_name ASC");*/
$getstaff = selectQuery(SUPPORTSTAFF,"*","acc_type!='Client' AND isdel='0' order by emp_name ASC"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Manage Staffs Members</title>
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
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h5 class="card-head-title">Manage Staffs Members</h5></div><div class="btn-actions-pane-right"><a href="addstaff.php" class="btn btn-primary btn-sm">Add New Staff</a></div></div>
                <div class="card-body">
                    <div class="table-resonsive">
                       <table class="example table table-bordered">
                            <thead><tr><th>#</th><th>Staff Name</th><th>Username</th><th>Status</th><th>Group</th><th>Department</th><th>Created</th><th>Last Login</th></tr></thead>
                            <tbody>
                                <?php for($i=0;$i<count($getstaff);$i++){ ?>
                                <tr>
                                <td class="td2"><?php echo $i+1; ?></td>
                                <td><a href="editemp.php?emp=<?php echo base64_encode($getstaff[$i]['emp_id']) ?>"><?php echo $getstaff[$i]['emp_name']; ?></a></td>
                                <td><?php if($getstaff[$i]['username']!=""){ echo $getstaff[$i]['username']; }
                                else{ echo "[Not Defined]"; } ?></td>
                                <td><?php if($getstaff[$i]['isActive']==1){ echo "<span class='text-success' style='font-weight:bold'>Active</span>"; } else{ echo "<span class='text-danger'>Deactive</span>"; } ?></td>
                                <td><?php if($getstaff[$i]['emp_group']!=""&&$getstaff[$i]['emp_group']!="0"){
                                $getstaffgroup = selectQuery(SUPPORTSTAFFGROUP,"*","group_id=".$getstaff[$i]['emp_group']); echo $getstaffgroup[0]['group_name']; }
                                else{ echo "<span class='text-danger'>[Not Defined]</span>"; } ?></td>
                                <td><?php if($getstaff[$i]['department']!=""&&$getstaff[$i]['department']!="0"){
                                $getstaffdept = selectQuery(SUPPORTDEPT,"*","dept_id=".$getstaff[$i]['department']); echo $getstaffdept[0]['dept_name'];
                                } else{ echo "<span class='text-danger'>[Not Defined]</span>"; } ?></td>
                                <td><?php echo $getstaff[$i]['added_on']; ?></td>
                                <td><?php if($getstaff[$i]['last_login']!=""){echo $getstaff[$i]['last_login'];}else { echo "-"; } ?></td>
                                </tr>
                                <? } ?>
                            </tbody>
                       </table>
                    </div>
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
                    if(response==1){     
                        $('.msgs').fadeIn().addClass("alert alert-success").html("Department Activated Successfully").delay(5000).fadeOut();
                    } else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
                }
            });
        } else{
            var info = {uid:uid,status:"0"};
            $.ajax({
                type:"POST", url:"statuschng.php", data:info,
                success:function(response){
                    if(response==1){     
                        $('.msgs').fadeIn().addClass("alert alert-success").html("Department Deactivated Successfully").delay(5000).fadeOut();
                    } else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
                }
            });
        }
    });
})
function del(id){
    var uid = id;
    if(id!=""){
        if(confirm("Are You Sure To Delete This Department? ")){
            var info = {uid:uid};
            $.ajax({
                type:"POST", url:"del.php", data:info,
                success:function(response){
                    if(response==1){
                        $('.msgs').fadeIn().addClass("alert alert-success").html("Department Deleted Successfully").delay(5000).fadeOut();
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