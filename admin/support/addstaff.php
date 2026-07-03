<?php include("../../includes/configuration.php"); $getdept = selectQuery(SUPPORTDEPT,"*","isActive='1' and isDel='0'"); $getgroup = selectQuery(SUPPORTSTAFFGROUP,"*","group_name!='Client' AND group_status='1' and isDel='0'"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Add Staff</title>
    <?php include('../commoncss.php'); ?>
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php'); ?>
    <?php include('../cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Add New Staff</h2></div><div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                <div class="card-body">
                    <div class="msgs"></div>
                    <form>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-3 col-lg-3 col-xl-2 cc-mandatary-field">Department</label>
                            <div class="col-sm-9 col-md-6 col-lg-6 col-xl-4">
                                <select class="form-control dept">
                                    <option value="">Select Department</option>
                                    <?php for($i=0;$i<count($getdept);$i++){ ?>
                                    <option value="<?php echo $getdept[$i]['dept_id']; ?>"><?php echo $getdept[$i]['dept_name']; ?></option>
                                    <? } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-3 col-lg-3 col-xl-2 cc-mandatary-field">Group</label>
                            <div class="col-sm-9 col-md-6 col-lg-6 col-xl-4">
                                <select class="form-control group">
                                <option value="">Select Groups</option>
                                <?php for($i=0;$i<count($getgroup);$i++){ ?>
                                <option value="<?php echo $getgroup[$i]['group_id']; ?>" ><?php echo $getgroup[$i]['group_name']; ?></option>
                                <? } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-3 col-lg-3 col-xl-2 cc-mandatary-field">Employee Name</label>
                            <div class="col-sm-9 col-md-6 col-lg-6 col-xl-4">
                                <input type="text" name="empname" id="empname" onblur="firstcapital('empname')" onkeyup="namechk1('empname')" class="form-control empname text-capitalize" maxlength="50" value="" />
                                <input type="hidden" name="deptid" id="deptid" class="deptid" value="<?php echo $dept; ?>"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-3 col-lg-3 col-xl-2 cc-mandatary-field">Email</label>
                            <div class="col-sm-9 col-md-6 col-lg-6 col-xl-4">
                                <input type="text" name="empemail" id="empemail" class="form-control empemail" autocomplete="off" value="" maxlength="70"  onblur="mailchk('empemail');checkemail('empemail');">
                                <input type="hidden" name="isemail" class="form-control isemail" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-3 col-lg-3 col-xl-2 cc-mandatary-field">Username</label>
                            <div class="col-sm-9 col-md-6 col-lg-6 col-xl-4"><input type="text" name="username" id="username" class="form-control username" maxlength="20" /></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-3 col-lg-3 col-xl-2 cc-mandatary-field">Set Password</label>
                            <div class="col-sm-9 col-md-6 col-lg-6 col-xl-4"><input type="password" name="emppwd" class="form-control emppwd" maxlength="20" value="" autocomplete="off" /></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-3 col-lg-3 col-xl-2">Account Type</label>
                            <div class="col-sm-9 col-md-6 col-lg-6 col-xl-4">
                                <input type="radio" name="acctype" class="acctype" value="Admin" /> Admin
                                <input type="radio" name="acctype" class="acctype" value="Staff" checked /> Staff
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-3 col-lg-3 col-xl-2"></label>
                            <div class="col-sm-9 col-md-6 col-lg-6 col-xl-4"><input type="checkbox" name="access" class="access" value="1" <? if($getemp[0]['admin_panel_access']=="1"){echo "checked";}else{} ?> /> Give Admin Panel Access</div>
                        </div>
                        <div class="row border-top">
                            <div class="col-12 text-right pt-3"><button type="button" id="submit" class="btn btn-primary">Add</button> <button type="reset" id="cancel" class="btn btn-secondary">Cancel</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
    </div>
</div>
<script>
$(".empemail").val(""); $(".emppwd").val("");
function checkemail(inpid){
    var email = $("#"+inpid).val(); var checktype="checkemail";
    var patt = new RegExp(/^[a-zA-Z0-9._\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/);
    var res = patt.test(email);
    if(res){
        $("#"+inpid).css("border","1px solid #c3c3c3");
        $("#submit").prop("disabled",true);
        var info = {email:email,action:checktype};
        $.ajax({
            type:"POST", url:"checkavalability.php", data:info,
            success:function(response){
                if(response=="1"){ $(".isemail").val("1"); $("#submit").prop("disabled",false); }
                if(response=="0"){
                    $('.msgs').fadeIn().addClass("alert alert-danger").html("One Employee is available  with same Email. Please change email").delay(5000).fadeOut();
                    $(".isemail").val("0");
                    $("#submit").prop("disabled",true);
                }
            }
        });
    } else{ $("#"+inpid).css("border","1px solid red"); $("#submit").prop("disabled",true); }
}
$(document).ready(function(){
    $("#submit").on("click",function(){
        checkemail('empemail'); var empid = $(".empid").val(); var username = $(".username").val(); var dept = $(".dept option:selected").val(); var group = $(".group option:selected").val(); var empname = $(".empname").val(); var empemail = $(".empemail").val(); var emppwd = $(".emppwd").val(); var acctype = $(".acctype:checked").val(); var access = $(".access:checked").val();
        if(typeof access=="undefined"){ adminacceess="0"; } else{ adminacceess="1"; }
        if((username=="")||(empname == "") || (dept == "")|| (group == "") || (empemail == "") || (emppwd == "")){
            $('.msgs').fadeIn().addClass("alert alert-danger").html("Please fill all requierd fields").delay(5000).fadeOut();
        } else{
            $("#submit").prop("disabled",true);
            var info = { username:username, empname:empname, empemail:empemail, emppwd:emppwd, dept:dept, group:group, acctype:acctype, adminacceess:adminacceess};
            $.ajax({
                type:"POST", url:"addstaffdata.php", data:info,
                success:function(response){
                    if(response==0){ $('.msgs').fadeIn().addClass("alert alert-success").html("Not Inserted").delay(5000).fadeOut(); }
                    else{
                        $('.msgs').fadeIn().removeClass("alert alert-danger").addClass("alert alert-success").html("Staff Added Successfully").delay(5000).fadeOut();
                        window.setTimeout( function(){ window.location="staff.php"; }, 50 );
                    }
                }
            });
        }
    });
});
</script>
</body>
</html>