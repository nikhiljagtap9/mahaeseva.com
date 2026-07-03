<?php include("../../includes/configuration.php"); $getuser = selectQuery(WEB_USER,"*","isDel='0' order by u_id DESC"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Users List</title>
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
            <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Users - All List</h2></div><div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
            <div class="card-body">
                <div class="msgs"></div>
                <div class="table-responsive">
                    <table class="example table table-bordered">
                        <thead><tr><th>#</th><th>Name</th><th>Mobile No.</th><th>Email</th><th>Last Login</th><th>Active</th><th>Delete</th></tr>
                        </thead>
                            <tbody>
                                <?php for($i=0;$i<count($getuser);$i++){ ?>
                                <tr>
                                    <td class="td2"><?php echo $i+1; ?></td>
                                    <td><?php if($getuser[$i]['u_fname']==""&&$getuser[$i]['u_lname']==""){ echo "[Not Defined]"; }
                                    else{ ?><a href="<?php echo ADMINURL; ?>users/usersdetails.php?u_id=<?php echo base64_encode($getuser[$i]['u_id']); ?>"><?php echo $getuser[$i]['u_fname']."&nbsp;".$getuser[$i]['u_lname']; ?></a><? } ?></td>
                                    <td><?php echo $getuser[$i]['u_mobile']; ?></td>
                                    <td class="td1"><?php if($getuser[$i]['u_email']==""){ echo "[Not Defined]"; }
                                    else{ echo $getuser[$i]['u_email'];} ?></td>
                                    <td class="td1"><?php if($getuser[$i]['last_login']!=""){ ?>
                                    <?php echo date("d M Y h:i a",strtotime($getuser[$i]['last_login'])); ?>
                                    <br><a href="<?php echo ADMINURL; ?>userlog.php?a=<?php echo base64_encode($getuser[$i]['u_id']); ?>" target="_blank" style="font-size:12px">More Details</a>
                                    <? } else{ echo "--"; } ?></td>
                                    <td class="td1"><input type="checkbox" class="tg" data-toggle="toggle" data-on="Active" data-off="Deactive" data-id="<?php echo $getuser[$i]['u_id']; ?>" data-width="100" data-height="30" id="checkbox_<?php echo $getuser[$i]['u_id']; ?>" name="checkbox_<?php echo $getuser[$i]['u_id']; ?>" <?php if($getuser[$i]['isActive']==1){echo "checked";}else{echo "";} ?> onchange="tgchng('<?php echo $getuser[$i]['u_id']; ?>','checkbox_<?php echo $getuser[$i]['u_id']; ?>')"></td>
                                    <td class="td1 text-center"><button type="button" class="deletebtn btn btn-danger btn-sm" onclick="del('<?php echo $getuser[$i]['u_id']; ?>')"><i class="fa fa-trash-o"></i></button></td>
                                </tr>
                                <? } ?>
                            </tbody>
                        </table>
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
$('.example').DataTable();
function del(id){      
    var uid=id;
    if(id!=""){
        if(confirm("Are You Sure To Delete User ")){
            var info = {uid:uid};
            $.ajax({ type:"POST", url:"deluser.php", data:info,
                success:function(response){
                    if(response==1){ $('.msgs').fadeIn().addClass("alert alert-success").html("USer Deleted Successfully").delay(5000).fadeOut();
                    location.reload(); }
                    else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
                }
            });
        } else{ }
    }
}
function tgchng(v1,v2){
    var uid = v1; var getid = v2; var c = $("#"+getid+":checked").val();
    if(c=="on"){     
        var info={uid:uid,status:"1"};
        $.ajax({ 
            type:"POST", url:"statuschng.php", data:info,
            success:function(response){
                if(response==1){  $('.msgs').fadeIn().addClass("alert alert-success").html("User Activated Successfully").delay(5000).fadeOut(); } else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
            }
        });
    } else{
        var info = {uid:uid,status:"0"};
        $.ajax({
            type:"POST", url:"statuschng.php", data:info,
            success:function(response){
                if(response==1){ $('.msgs').fadeIn().addClass("alert alert-success").html("User Deactivated Successfully").delay(5000).fadeOut(); } else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("ERROR..").delay(5000).fadeOut(); }
            }
        });
    }
}
</script>
</body>
</html>