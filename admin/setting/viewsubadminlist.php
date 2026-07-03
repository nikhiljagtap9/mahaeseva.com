<?php include("../../includes/configuration.php"); $page = 'viewsubadminlist'; $getsubadmin = selectQuery(USER,"*","utype='subadmin' and isdel='0'"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Sub admins</title>
    <? include "../commoncss.php"; ?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
    <? include '../header.php'; ?>
    <? include '../cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">SubAdmin List </h2></div><div class="btn-actions-pane-right"><a href="setting.php" class="btn btn-primary btn-sm">Add New Subadmin</a> <button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                <div class="card-body">
                    <div class="msgs"></div>
                    <table class="example table table-bordered">
                        <thead><tr><th>#</th><th>Name</th><th>Mobile No</th><th>Email ID</th><th>Allocated  </th><th>View Login</th><th>Active / Deactive</th><th class="text-center">Delete</th></tr>
                        </thead>
                        <tbody><?php for($i=0;$i<count($getsubadmin);$i++){ ?>
                            <tr>
                                <td class="td2"><?php echo $i+1; ?></td>
                                <td><a href="<?php echo ADMINURL;?>setting/update.php?id=<?php echo base64_encode($getsubadmin[$i]['u_id']); ?>"><?php echo $getsubadmin[$i]['username']; ?></a></td>
                                <td><?php echo $getsubadmin[$i]['u_mob']?></td>
                                <td><?php echo $getsubadmin[$i]['u_email']?></td>
                                <td><?php /*echo $getsubadmin[$i]['allocatemenu']*/;
                                $new = explode(",",$getsubadmin[$i]['allocatemenu']);
                                $arr = array();
                                for($j=0;$j<sizeof($new);$j++){ $arr[]="menu_id=".$new[$j]; }
                                $ids = implode(" OR ",$arr);
                                $decidemenu = selectQuery(menu,"*",$ids); ?>
                                <?php for($k=0;$k<count($decidemenu);$k++){ echo "" .$decidemenu[$k]['menu_name']."<br>"; } ?></td>
                                <td><a href="<?php echo ADMINURL; ?>subadminlastlog.php?id=<?php echo base64_encode($getsubadmin[$i]['u_id']) ?>">View last login</a></td>
                                <td> <input type="checkbox" class="tg" data-toggle="toggle" data-on="Active" data-off="Deactive" data-id="<?php echo $getsubadmin[$i]['u_id']; ?>" data-width="100" data-height="30" id="checkbox_<?php echo $getsubadmin[$i]['u_id']; ?>" name="checkbox_<?php echo $getsubadmin[$i]['u_id']; ?>" <?php if($getsubadmin[$i]['isActive']==1){echo "checked";}else{echo "";} ?>></td>
                                <td class="text-center"><button type="button" onclick="del('<?php echo $getsubadmin[$i]['u_id']; ?>')" class="btn btn-danger btn-sm deletebtn"><i class="fa fa-trash-o"></i></button></td>
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
$(".tg").on("change", function(){
    var uid = $(this).attr('data-id'); var getid = $(this).attr('id'); var c = $("#" + getid + ":checked").val();
    if(c == "on"){
    var info = { uid: uid, status: "1" };
    $.ajax({
        type: "POST", url: "statuschng.php", data: info,
        success: function(response){
            if(response == 1){
                $('.msgs').fadeIn().addClass("alert alert-success").html("Subadmin Activated Successfully").delay(5000).fadeOut();
            } else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
        }
    });
    } else{
        var info = { uid: uid, status: "0" };
        $.ajax({
            type: "POST", url: "statuschng.php", data: info,
            success: function(response){
                if(response == 1){
                    $('.msgs').fadeIn().addClass("alert alert-success").html("Subadmin Deactivated Successfully").delay(5000).fadeOut();
                } else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
            }
        });
    }
});
function del(id){
    var uid = id;
    if(id != ""){
        if(confirm("Are You Sure To Delete This SUBADMIN?")){
            var info = { uid: uid };
            $.ajax({
                type: "POST", url: "del.php", data: info,
                success: function(response){
                    if(response == 1){
                        $('.msgs').fadeIn().addClass("alert alert-success").html("Subadmin Deleted Successfully").delay(5000).fadeOut();
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