<?php include("../../includes/configuration.php"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Add Department</title>
    <?php include('../commoncss.php'); ?>
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php'); ?>
    <?php include('../cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Add Department</h2></div><div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                <div class="card-body">
                    <div class="msgs"></div>
                    <div class="row">
                        <form class="form-horizontal col-lg-8">
                            <div class="msgs1"></div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-md-5 col-lg-4 control-label">Department Name <span class="red">*</span></label>
                                <div class="col-sm-8 col-md-7 col-lg-5"><input type="text" name="dept" id="dept" onkeyup="checkchar(event,'dept')" onblur="firstcapital('dept')" class="form-control text-capitalize" placeholder="Department Name" maxlength="20" /></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-md-5 col-lg-4 control-label">SLA Time <span><small class="text-muted">(SLA Time In Hours)</small></span><span class="red">*</span></label>
                                <div class="col-sm-8 col-md-7 col-lg-5 col-sm-12 col-xs-12"><input type="text" name="sla" id="sla" class="form-control" onkeyup="chkno('sla')" maxlength="3" placeholder="SLA Time"/></div>
                            </div>
                            <button type="button" name="create" id="submit" class="btn btn-primary">Add  Department</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
     </div>
</div>
<script>
function checkchar(event,id){
    var key = event.which || event.keyCode;
    var inp=$("#"+id).val();
    if (key >= 65 && key <= 90 || key == 8 || key == 9 || key == 13 ||key == 16 || key == 32 ||key == 35 || key == 36 || key == 46 || key == 45){ $("#"+id).val(inp); } else{ var newstr = inp.slice(0, -1); $("#"+id).val(newstr); }
};
function chkno(inpid){ var entered = $("#"+inpid).val(); if(isNaN(entered)){ $("#"+inpid).val(""); } }
$(document).ready(function(){
    $("#submit").on("click",function(){
        var dept = $("#dept").val(); var sla = $("#sla").val();
        if((dept!="") && (sla!="")){
            var info = {dept:dept,sla:sla};
            $.ajax({ type:"POST", url:"deptdata.php", data:info,
                success:function(response){
                if(response==1){
                    $('.msgs').fadeIn().removeClass("alert alert-danger").addClass("alert alert-success").html("Department Added Successfully").delay(5000).fadeOut();
                    window.setTimeout( function(){ window.location = "index.php"; }, 500);
                } if(response==0){
                    $('.msgs').fadeIn().addClass("alert alert-danger").html("Department Already available").delay(5000).fadeOut();
                } if(response==2){ $('.msgs').fadeIn().addClass("alert alert-danger").html("Not Inserted").delay(5000).fadeOut(); }
                }
            });
        } else{
        $('.msgs').fadeIn().addClass("alert alert-danger").html("Please fill all requierd fields").delay(5000).fadeOut();}
    });
});
</script>
</body>
</html>