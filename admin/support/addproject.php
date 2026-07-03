<?php include("../../includes/configuration.php"); $getclient = selectQuery(SUPPORTCLIENT,"*","isActive='1'"); $getgroup = selectQuery(SUPPORTSTAFFGROUP,"*","group_status='1' and isDel='0'"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Add Project</title>
    <?php include('../commoncss.php'); ?>
</head>
<body>
<div class="page-body-wrapper">
      <?php include('../header.php'); ?>
    <?php include('../cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Add New Project</h2></div><div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                <div class="card-body">
                    <div class="msgs"></div>
                    <form>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-4 col-lg-2 col-form-label cc-mandatary-field">Client</label>
                            <div class="col-sm-9 col-md-6 col-lg-4">
                                <select class="form-control" id="client">
                                <option>Select Client</option>
                                <?php for($i=0;$i<count($getclient);$i++){ ?>
                                <option value="<?php echo $getclient[$i]['client_id']; ?>"><?php echo $getclient[$i]['client_name']; ?></option>
                                <? } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-4 col-lg-2 col-form-label cc-mandatary-field">Project Name</label>
                            <div class="col-sm-9 col-md-6 col-lg-4">
                                <input type="text" name="projectname" id="projectname" onblur="firstcapital('projectname')" onkeyup="checkchar(event,'projectname')" class="form-control projectname text-capitalize" maxlength="50" value="" placeholder="Enter Project Name"/>
                            </div>
                        </div>
                        <div class="row border-top text-right">
                        <div class="col-12 pt-3"><button type="button" id="submit" class="btn btn-primary">Add</button> <button type="reset" id="cancel" class="btn btn-secondary">Cancel</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
    </div>
</div>
<script>
$(".clientemail").val(""); $(".clientpwd").val("");
function checkchar(event,id){
    var key = event.which || event.keyCode;
    var inp=$("#"+id).val();
    if (key >= 65 && key <= 90 || key == 8 || key == 9 || key == 13 ||key == 16 || key == 32 ||key == 35 || key == 36 || key == 46 || key == 45){ $("#"+id).val(inp); } else{ var newstr = inp.slice(0, -1); $("#"+id).val(newstr); }
};
$(document).ready(function(){
    $("#submit").on("click",function(){
        var client_id = $("#client option:selected").val(); var projectname = $(".projectname").val();
        if ((client_id=="")||(projectname == "")){
            $('.msgs').fadeIn().addClass("alert alert-danger").html("Please Fill All Required Fields").delay(5000).fadeOut();
        } else{
            $("#submit").prop("disabled",true);
            var infodata = { client_id:client_id, projectname:projectname, action:"addproject" };
            $.ajax({
                type:"POST", url:"addclientdata.php", data:infodata,
                success:function(response){
                    if(response==2){
                        $('.msgs').fadeIn().addClass("alert alert-success").html("Info Added Successfully!!!").delay(5000).fadeOut();
                    } else{
                        $('.msgs').fadeIn().addClass("alert alert-success").html("Info Not Added").delay(5000).fadeOut();
                    }
                }
            });
        }
    });
});
</script>
</body>
</html>