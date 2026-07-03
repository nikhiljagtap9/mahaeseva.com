<?php include("../../includes/configuration.php"); $getalldept = selectQuery(SUPPORTDEPT,"*",'isActive="1"'); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Add Staff Group</title>
    <?php include('../commoncss.php'); ?>
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php'); ?>
    <?php include('../cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2">
                <div><h2 class="card-head-title">Add New Staff group</h2></div>
                <div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                <div class="card-body pb-2">
                    <div class="msgs"></div>
                    <form autocomplete="off">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Staff Group</label>
                            <div class="col-md-4"><input type="text" name="grpname" id="grpname" class="form-control grpname text-capitalize" maxlength="50" value="" onblur="checkname();"/></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">Status</label>
                            <div class="col-md-4">
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" class="status custom-control-input" value ="1" name="status" checked="checked"> <label class="custom-control-label" for="customRadio">Active</label></div>
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" class="status custom-control-input" value="0" name="status"><label class="custom-control-label" for="customRadio">Deactive</label></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">Dept Access</label>
                            <div class="col-md-4"><?php for($i= 0;$i< count($getalldept);$i++ ){ ?>
                            <div class="custom-control custom-checkbox"><input type="checkbox" name="dept" class="dept custom-control-input" value ="<?php echo $getalldept[$i]['dept_id']; ?>" id="detaccess<?php echo $getalldept[$i]['dept_id']; ?>"/> <label class="custom-control-label" for="detaccess<?php echo $getalldept[$i]['dept_id']; ?>"><?php echo $getalldept[$i]['dept_name']; ?></label></div>
                            <?php } ?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">Can Create Ticket</label>
                            <div class="col-md-4"><div class="custom-control custom-checkbox custom-control-inline">
                            <input type="radio" id="creqtickyes" class="Create custom-control-input" value ="1" name="Create"> <label class="custom-control-label" for="creqtickyes">Yes</label></div>
                            <div class="custom-control custom-checkbox custom-control-inline"><input type="radio" id="creqtickno" class="Create custom-control-input" value="0" name="Create"  checked="checked"> <label class="custom-control-label" for="creqtickno">No</label></div></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">Can Edit Ticket</label>
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="radio" id="edittickyes" class="Edit custom-control-input" value ="1" name="Edit"> <label class="custom-control-label" for="edittickyes">Yes</label></div>
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="radio" id="edittickno" class="Edit custom-control-input" value="0" name="Edit" checked="checked"> <label class="custom-control-label" for="edittickno">No</label></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">Can Close Ticket</label>
                            <div class="col-md-4">
                            <div class="custom-control custom-checkbox custom-control-inline"><input type="radio" id="closeticketyes" class="Close custom-control-input" value ="1" name="Close"> <label class="custom-control-label" for="closeticketyes">Yes</label></div>
                            <div class="custom-control custom-checkbox custom-control-inline"><input type="radio" id="closeticketno" class="Close custom-control-input" value="0" name="Close" checked="checked"> <label class="custom-control-label" for="closeticketno">No</label></div>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label class="col-md-2">Can Transfer Ticket</label>
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox custom-control-inline"><input type="radio" id="transticketyes" class="Transfer custom-control-input" value ="1" name="Transfer"> <label class="custom-control-label" for="transticketyes">Yes</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline"><input type="radio" id="transticketno" class="Transfer custom-control-input" value="0" name="Transfer" checked="checked"> <label class="custom-control-label" for="transticketno">No</label></div>
                        </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">Can Delete Ticket</label>
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="radio" id="delticketyes" class="Delete1 custom-control-input" value ="1" name="Delete1"> <label class="custom-control-label" for="delticketyes">Yes</label></div>
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="radio" id="delticketno" class="Delete1 custom-control-input" value="0" name="Delete1" checked="checked"> <label class="custom-control-label" for="delticketno">No</label></div>
                            </div>
                        </div>
                        <div class="row border-top"><div class="col-12 pt-2 text-right"><button type="button" id="submit" class="btn btn-primary">Add</button> <a href="<?php echo ADMINURL?>support/staffgrouplist.php" id="cancel" class="btn btn-primary btnred">Cancel</a></div></div>
                    </form>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
    </div>
</div>
<script>
$("#submit").on("click",function(){
    var grpname = $(".grpname").val(); var status = $('input[name="status"]:checked').val(); var Create = $('input[name="Create"]:checked').val(); var Edit = $('input[name="Edit"]:checked').val(); var Close = $('input[name="Close"]:checked').val(); var Transfer = $('input[name="Transfer"]:checked').val(); var Delete1 = $('input[name="Delete1"]:checked').val(); var createguest = $('input[name="createguest"]:checked').val(); var editguest = $('input[name="editguest"]:checked').val(); var Deleteguest = $('input[name="Deleteguest"]:checked').val(); var action = "add";
    if($('.dept:checked').length){
        var chkId = '';
        $('.dept:checked').each(function(){ chkId += $(this).val() + ","; });
        chkId = chkId.slice(0, -1);
    }
    if((grpname=="") || (status == "undefined") || (Create == "undefined") || (Edit == "undefined") || (Transfer == "undefined" || Delete1 == "")){
        $('.msgs').fadeIn().addClass("alert alert-danger").html("Please fill all requierd fieldss").delay(5000).fadeOut();
    } else{
        var info = { grpname:grpname, status:status, chkId:chkId, Create:Create, Edit:Edit, Close:Close, Transfer:Transfer, Delete1:Delete1, action:action};
        $.ajax({
            type:"POST",
            url:"staffgroupdata.php", data:info, success:function(response){
                if(response==1){  
                    $('.msgs').fadeIn().addClass("alert alert-success").html("Staff group Added Successfully").delay(5000).fadeOut();
                    window.setTimeout(function(){ window.location.href= "<?php echo SITEURL ?>/admin/support/staffgrouplist.php"; }, 500 );
                } else if(response==3){
                    $('.msgs').fadeIn().addClass("alert alert-success").html("Group Name already Exist").delay(5000).fadeOut();
                } else{
                    $('.msgs').fadeIn().addClass("alert alert-success").html("Not Inserted").delay(5000).fadeOut();
                }
            }
        });
    }
});
function checkname(){
    var grpname = $(".grpname").val(); var action = "checkavailabilty";
    var info = {grpname:grpname,action:action}
    $.ajax({
        type:"POST", url:"staffgroupdata.php", data:info,
        success:function(response){
            if(response == "1"){
                $('.msgs').fadeIn().addClass("alert alert-success").html("Staff Group name available").delay(5000).fadeOut();
                $("#submit").removeAttr("disabled","disabled");
            } else{
                $('.msgs').fadeIn().addClass("alert alert-success").html("Staff Group name Not available").delay(5000).fadeOut();
                $("#submit").prop("disabled","disabled");
            }
        }
    });
}
</script>
</body>
</html>