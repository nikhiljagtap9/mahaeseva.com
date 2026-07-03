<?php include("../../includes/configuration.php");
$page = 'supportindex'; $dept = base64_decode($_REQUEST['deptid']); $getdept = selectQuery(SUPPORTDEPT,"*","dept_id=".$dept); $staffs = selectQuery(SUPPORTSTAFF,"*","(acc_type='Staff' OR acc_type='Admin') AND  isActive='1' AND isDel='0' order by emp_name"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Department Settings</title>
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
                    <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title"><?php echo $getdept[0]['dept_name']; ?> Configuration</h2></div><div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                    <div class="card-body pb-2">
                        <div><!-- <b>SLA Time - <?php echo $getdept[0]['SLAtime']." Hours"; ?><button type="button" class="chngsla btn btn-link">(Change)</button></b>--></div>
                        <div class="updateslatime">
                            <div class="innerupdateslatime">
                                <form>
                                <input type="hidden" id="deptid" value="<?php echo $dept; ?>"/>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-md-4 col-lg-3 cc-mandatary-field col-form-label">Department Name</label>
                                    <div class="col-sm-7 col-md-6 col-lg-4"><input type="text" name="deptName" id="deptName" class="form-control" onkeyup="namechk1('deptName')" value="<?php echo $getdept[0]['dept_name']; ?>" maxlength="20" placeholder="Enter Department Name"/></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-md-4 col-lg-3 cc-mandatary-field col-form-label">SLA Time <span>(SLA Time In Hours)</span></label>
                                    <div class="col-sm-7 col-md-6 col-lg-4"><input type="text" name="sla" id="sla" class="form-control" onkeyup="chkno('sla')" value="<?php echo $getdept[0]['SLAtime']; ?>" maxlength="3" placeholder="Enter SLA Time"/></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-md-4 col-lg-3 cc-mandatary-field col-form-label">Department Manager</label>
                                    <div class="col-sm-7 col-md-6 col-lg-4">
                                        <select class="form-control mgr">
                                        <option value="">- Select Manager -</option>
                                        <?php for($i=0;$i<count($staffs);$i++){ ?>
                                        <option value="<?php echo $staffs[$i]['emp_id']; ?>" <? if($staffs[$i]['emp_id']==$getdept[0]['dept_mgr']){echo "selected";} ?>><?php echo $staffs[$i]['emp_name']; ?></option>
                                        <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row border-top"><div class="col-12 pt-2 text-right"><button type="button" class="btn btn-primary" id="updatesla">UPDATE</button> <a href="<?php echo ADMINURL?>support" id="cancel" class="btn btn-secondary">Cancel</a></div></div>
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
function chkno(inpid){ var entered = $("#"+inpid).val(); if(isNaN(entered)){ $("#"+inpid).val(""); } }
$(".chngsla").click(function(){ $(".updateslatime").toggle(); })
$("#cancelsla").click(function(){ $(".updateslatime").hide(); })
$("#updatesla").click(function(){
    var sla = $("#sla").val(); var deptid = $("#deptid").val(); var deptmgr = $(".mgr option:selected").val(); var deptName = $("#deptName").val();
    if(typeof deptName==""){ $("#deptName").css("border","1px solid red"); } else if(sla==""||sla==0){ $("#sla").css("border","1px solid red"); } else if(typeof deptmgr=="undefined"){ $(".mgr").css("border","1px solid red");} else{
        $("#sla,.mgr").css("border","1px solid #A8A8A8");
        var info={deptid:deptid, sla:sla, deptmgr:deptmgr, deptName:deptName};
        $.ajax({
            type:"POST", url:"updateSLA.php", data:info,
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