<?php include("../../includes/configuration.php");
$s_id = base64_decode($_REQUEST['s_id']); $getdata = selectQuery(STATUS,"*","s_id=".$s_id); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Status Settings</title>
    <?php include('../commoncss.php'); ?>
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php'); ?>
    <?php include('../cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="tech-dept">
                <div class="card mb-0">
                    <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title"><?php echo $getdata[0]['status']; ?> Configuration</h2></div><div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                    <div class="card-body pb-2">
                        <div class="updateslatime">
                            <div class="msgs"></div>
                            <div class="innerupdateslatime">
                                <form>
                                <input type="hidden" id="s_id" value="<?php echo $s_id; ?>"/>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-md-4 col-lg-3 cc-mandatary-field col-form-label">Status Name</label>
                                    <div class="col-sm-7 col-md-6 col-lg-4"><input type="text" name="status" id="status" class="form-control" onkeyup="namechk1('status')" value="<?php echo $getdata[0]['status']; ?>" maxlength="80" placeholder="Enter Status Name"/></div>
                                </div>
                                <div class="row border-top"><div class="col-12 pt-2 text-right"><button type="button" class="btn btn-primary" id="update">UPDATE</button> <a href="<?php echo ADMINURL?>status" id="cancel" class="btn btn-secondary">Cancel</a></div></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
    </div>
</div>
<script>
$("#update").click(function(){
    var s_id = $("#s_id").val(); 
    var status = $("#status").val();
    if(typeof status==""){ $("#status").css("border","1px solid red"); } 
    else{
        var info={s_id:s_id, status:status};
        $.ajax({
            type:"POST", url:"updatestatus.php", data:info,
            success:function(response){
                if(response==1){ $('.msgs').fadeIn().addClass("alert alert-success").html("Updated Successfully").delay(5000).fadeOut();
                location.reload(); }
                else{ $('.msgs').fadeIn().addClass("alert alert-success").html("Not Updated").delay(5000).fadeOut(); }
            }
        });
    }
})
</script>
</body>
</html>