<?php include("../../includes/configuration.php"); $getuser = selectQuery(WEB_USER,"*","isDel='0' order by u_id DESC"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Users</title>
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
                <div class="card-header sec-card-head justify-content-between align-items-center py-2">
                <div><h2 class="card-head-title">List - All Live Cart Users</h2></div>
                <div class="btn-actions-pane-right"><a class="btn btn-primary btn-sm" href="index.php">Show All Users</a></div></div>
                <div class="card-body">
                    <div class="msgs"></div>
                    <table class="example table table-bordered">
                        <thead><tr><th>#</th><th>Name</th><th>Orders</th><th>Live Cart</th><th>Mobile No</th><th>Email</th><th>Last Login</th><th>Active</th><th>Delete</th></tr>   </thead>
                        <tbody>
                        <?php for($i=0;$i<count($getuser);$i++){
                        $cartdet = selectQuery(ADDTOCART,"*","u_id=".$getuser[$i]['u_id']." and checkedout=0 ");
                        if(count($cartdet) >0){ ?>
                        <tr>
                            <td class="td2"><?php echo $i+1; ?></td>
                            <td><a href="usersdetails.php?u_id=<?php echo $getuser[$i]['u_id']; ?>"><?php echo $getuser[$i]['u_name']; ?></a></td>
                            <? $orderdet=selectQuery(ORDER,"*","user_id=".$getuser[$i]['u_id']." and (payment_status='paid'||payment_status='cod') and final_order<>''"); ?>
                            <td class="td1"><?php echo count($orderdet); ?></td>
                            <? $cartdet=selectQuery(ADDTOCART,"*","u_id=".$getuser[$i]['u_id']." and checkedout=0 "); ?>
                            <td class="td1"><?php if(count($cartdet) >0)echo "<span style='color:green'>Active</span>" ; else echo "-"; ?></td>
                            <td class="td1"><?php echo $getuser[$i]['u_mobile']; ?></td>
                            <td class="td1"><?php if($getuser[$i]['email_verified']){?> <!--<span class="glyphicon glyphicon-ok-sign" style="color:green"></span>--> <span style="color:green"><?php echo $getuser[$i]['u_email']; ?></span> <?}else{ ?><!--<span class="glyphicon glyphicon-remove-circle" style="color:red"></span>--><span style="color:red"><?php echo $getuser[$i]['u_email']; ?></span> <? } ?></td>
                            <td class="td1"><?php echo $getuser[$i]['last_login']; ?></td>
                            <td class="td1"><input type="checkbox" class="tg"  data-toggle="toggle" data-on="Active" data-off="Deactive" data-id="<?php echo $getuser[$i]['u_id']; ?>" data-width="100" data-height="30" id="checkbox_<?php echo $getuser[$i]['u_id']; ?>" name="checkbox_<?php echo $getuser[$i]['u_id']; ?>" <?php if($getuser[$i]['isActive']==1){echo "checked";}else{echo "";} ?> onchange="tgchng('<?php echo $getuser[$i]['u_id']; ?>','checkbox_<?php echo $getuser[$i]['u_id']; ?>')"></td>
                            <!-- <td class="td1"><a href="view.php?s=<?php echo $getcpid[$i]['cpn_id']; ?>&type='flat'">View/Edit</a></td>  -->
                            <td class="td1 text-center"><button type="button" onclick="del('<?php echo $getuser[$i]['u_id']; ?>')" class="red deletebtn"><i class="fa fa-trash-o"></i></button></td>
                            </tr>
                            <? } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include '../footer.php';?>
    </div>
</div>
<script src="<?php echo SITEURL; ?>/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script>
$('.example').DataTable();
function del(id){
    var uid = id;
    if(id != ""){
        if(confirm("Are You Sure To Delete User ")){
            var info = { uid: uid };
            $.ajax({
                type: "POST",
                url: "deluser.php",
                data: info,
                success: function(response){
                    if (response == 1){ $('.msgs').fadeIn().addClass("alert alert-success").html("USer Deleted Successfully").delay(5000).fadeOut();
                    location.reload(); } else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
                }
            });
        } else{ }
    }
}
function tgchng(v1, v2){
    var uid = v1; var getid = v2; var c = $("#" + getid + ":checked").val();
    if (c == "on") {
            var info = { uid: uid, status: "1" };
            $.ajax({
                type: "POST",
                url: "statuschng.php",
                data: info,
                success: function(response){
                    if (response == 1) {
                        $('.msgs').fadeIn().addClass("alert alert-success").html("User Activated Successfully").delay(5000).fadeOut();
                    } else{
                        $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut();
                    }
                }
            });
        } else{
        var info = { uid: uid, status: "0" };
        $.ajax({ type: "POST", url: "statuschng.php", data: info,
            success: function(response){
                if(response == 1){
                    $('.msgs').fadeIn().addClass("alert alert-success").html("User Deactivated Successfully").delay(5000).fadeOut();
                } else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
            }
        });
    }
}
</script>
</body>
</html>