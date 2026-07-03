<?php include("../../includes/configuration.php"); $getalldept = selectQuery(SUPPORTDEPT,"*",'isActive="1"'); $staffgrpid = base64_decode($_REQUEST['gid']); $getstafgrpdetail = selectQuery(SUPPORTSTAFFGROUP,"*","group_id='".$staffgrpid."'"); $dept = explode(",", $getstafgrpdetail[0]['access_to_dept']); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | View Staff Group Details</title>
    <?php include('../commoncss.php'); ?>
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php'); ?>
    <?php include('../cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Update Staff Group</h2></div><div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                <div class="card-body pb-2">
                    <div class="msgs"></div>
                    <form autocomplete="off" >
                        <div class="form-group row">
                            <label class="col-lg-3 col-xl-2">Staff Group</label>
                            <div class="col-lg-6 col-xl-6"><?php echo $getstafgrpdetail[0]['group_name'];?>
                            <input type="hidden" name="grpname" id="grpname" class="custom-control-input form-control grpname text-capitalize" maxlength="50" value="<?php echo $getstafgrpdetail[0]['group_name'];?>" />
                            <input type="hidden" name="grid" id="grid" class="custom-control-input form-control grid text-capitalize" maxlength="50" value="<?php echo $getstafgrpdetail[0]['group_id'];?>" /></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-4 col-lg-3 col-xl-2">Status</label>
                            <div class="col-sm-8 col-md-8 col-lg-6 col-xl-6">
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="radio" id="staffgrppstatusact" class="custom-control-input status" value ="1" name="status" <?if($getstafgrpdetail[0]['group_status'] == 1){ echo "checked";} else{ echo ""; } ?>> <label class="custom-control-label" for="staffgrppstatusact">Active</label></div>
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="radio" id="staffgrppstatusdeact" class="custom-control-input status" value="0" name="status" <?if($getstafgrpdetail[0]['group_status'] == 0){ echo "checked" ;} else{echo "";} ?>> <label class="custom-control-label" for="staffgrppstatusdeact">DeActive</label></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-4 col-lg-3 col-xl-2">Department Access</label>
                            <div class="col-sm-8 col-md-8 col-lg-6 col-xl-6">
                                <?php for($i= 0;$i< count($getalldept);$i++){ ?>
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="checkbox" name="dept" id="deptacc<?php echo $getalldept[$i]['dept_id']; ?>" class="dept custom-control-input" value ="<?php echo $getalldept[$i]['dept_id']; ?>" <? if(in_array($getalldept[$i]['dept_id'], $dept)){ echo "checked";} else echo "no"; ?>/><label class="custom-control-label" for="deptacc<?php echo $getalldept[$i]['dept_id']; ?>"><?php echo $getalldept[$i]['dept_name']; ?></label></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-4 col-lg-3 col-xl-2">Can Create Ticket</label>
                            <div class="col-sm-8 col-md-8 col-lg-6 col-xl-6">
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" class="Create custom-control-input" id="creattickyes" value ="1" name="Create" <?if($getstafgrpdetail[0]['Create'] == 1){ echo "checked" ;} else{echo "";} ?>> <label class="custom-control-label" for="creattickyes">Yes</label></div>
                                <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="Create custom-control-input" id="creattickno" value="0" name="Create" <?if($getstafgrpdetail[0]['Create'] == 0){ echo "checked";} else{ echo ""; } ?>> <label class="custom-control-label" for="creattickno">No</label></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-4 col-lg-3 col-xl-2">Can Edit Ticket</label>
                            <div class="col-sm-8 col-md-8 col-lg-6 col-xl-6">
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" class="Edit custom-control-input" id="edittickyes" value ="1" name="Edit" <?if($getstafgrpdetail[0]['Edit'] == 1){ echo "checked" ;} else{ echo ""; } ?>><label class="custom-control-label" for="edittickyes">Yes</label></div>
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" class="Edit custom-control-input" id="edittickno" value="0" name="Edit" <?if($getstafgrpdetail[0]['Edit'] == 0){ echo "checked" ;} else{ echo ""; } ?>><label class="custom-control-label" for="edittickno">No</label></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-4 col-lg-3 col-xl-2">Can Close Ticket</label>
                            <div class="col-sm-8 col-md-8 col-lg-6 col-xl-6">
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" class="Close custom-control-input" id="closetickyes" value ="1" name="Close" <?if($getstafgrpdetail[0]['Close'] == 1){ echo "checked" ;} else { echo ""; }?>><label class="custom-control-label" for="closetickyes">Yes</label></div>
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" class="Close custom-control-input" id="closetickno" value="0" name="Close" <?if($getstafgrpdetail[0]['Close'] == 0){ echo "checked" ;} else{ echo ""; } ?>><label class="custom-control-label" for="closetickno">No</label></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-4 col-lg-3 col-xl-2">Can Transfer Ticket</label>
                            <div class="col-sm-8 col-md-8 col-lg-6 col-xl-6">
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio"  class="Transfer custom-control-input" id="tranfertickyes" value ="1" name="Transfer" <?if($getstafgrpdetail[0]['Transfer'] == 1){ echo "checked" ;} else{ echo ""; }?>><label class="custom-control-label" for="tranfertickyes">Yes</label></div>
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" class="Transfer custom-control-input" id="tranfertickno" value="0" name="Transfer" <?if($getstafgrpdetail[0]['Transfer'] == 0){ echo "checked" ;} else{ echo ""; }?>><label class="custom-control-label" for="tranfertickno">No</label></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-4 col-lg-3 col-xl-2">Can Delete Ticket</label>
                            <div class="col-sm-8 col-md-8 col-lg-6 col-xl-6">
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" class="Delete1 custom-control-input" id="deletetickyes" value ="1" name="Delete1" <?if($getstafgrpdetail[0]['Delete1'] == 1){ echo "checked" ;} else{ echo ""; }?>><label class="custom-control-label" for="deletetickyes">Yes</label></div>
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" class="Delete1 custom-control-input" id="deletetickno" value="0" name="Delete1" <?if($getstafgrpdetail[0]['Delete1'] == 0){ echo "checked" ;} else{ echo ""; }?>><label class="custom-control-label" for="deletetickno">No</label></div>
                            </div>
                        </div>
                        <div class="row border-top"><div class="col-12 pt-2 text-right"><button type="button" id="submit" class="btn btn-primary">update</button> <a href="<?php echo ADMINURL?>support/staffgrouplist.php" id="cancel" class="btn btn-secondary">Cancel</a></div></div>
                    </form>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
    </div>
</div>
<script>
$("#submit").on("click",function(){
    var grid = $(".grid").val(); var grpname = $(".grpname").val(); var status = $('input[name="status"]:checked').val(); var Create = $('input[name="Create"]:checked').val(); var Edit = $('input[name="Edit"]:checked').val(); var Close = $('input[name="Close"]:checked').val(); var Transfer = $('input[name="Transfer"]:checked').val(); var Delete1 = $('input[name="Delete1"]:checked').val();
    var action = "update";
    if ($('.dept:checked').length){
        var chkId = '';
        $('.dept:checked').each(function(){ chkId += $(this).val() + ","; });
        chkId = chkId.slice(0, -1);
    }
    if((grpname=="") || (status == "undefined") || (Create == "undefined")  || (Edit == "undefined")  || (Transfer == "undefined" || Delete1 == "")){ $('.msgs').fadeIn().addClass("alert alert-danger").html("Please fill all requierd fieldss").delay(5000).fadeOut(); }
    else{
        var info = { grid:grid, grpname:grpname, status:status, chkId:chkId, Create:Create, Edit:Edit, Close:Close, Transfer:Transfer, Delete1:Delete1, action:action };
        $.ajax({
            type:"POST", url:"staffgroupdata.php", data:info,
            success:function(response){
                if(response==1){  
                    $('.msgs').fadeIn().addClass("alert alert-success").html("Staff group Updated Successfully").delay(5000).fadeOut();
                    window.setTimeout( function(){ window.location.href= "<?php echo SITEURL ?>/admin/support/staffgrouplist.php"; }, 500 );
                } else{ $('.msgs').fadeIn().addClass("alert alert-success").html("Not Updated").delay(5000).fadeOut(); }
            }
        });
    }
});
</script>
</body>
</html>