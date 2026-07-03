<!doctype html>
<?php
     include("../../includes/configuration.php");
  /*  $dept=base64_decode($_REQUEST['dept']);   */
     $emp=base64_decode($_REQUEST['emp']);
    $getdept=selectQuery(SUPPORTDEPT,"*","isActive='1'  and isDel='0'");
     $getgroup=selectQuery(SUPPORTSTAFFGROUP,"*","group_status='1' and isDel='0'");
     $getemp=selectQuery(SUPPORTSTAFF,"*","emp_id=".$emp);
?>
<html lang=''>
<head>
 <title><?php echo SITE_TITLE; ?> : Setting</title>
<?php include('../commoncss.php'); ?>
<link rel="stylesheet" href="../../css/bootstrap-table.css" />
<link rel="stylesheet" href="../../css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../../css/buttons.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="../../css/responsive.dataTables.min.css" />
</head>
<body>
<div class="page-body-wrapper">
      <?php include('../header.php'); ?>
    <?php include('../cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
        <div class="card">
            <div class="card-header sec-card-head justify-content-between align-items-center py-2">
                    <div><h2 class="card-head-title">Edit Staff Details</h2></div>
                    <div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div>
                </div>
        <div class="card-body">

             <div class="msgs"></div>
                 <form class="form-horizontal">

                      <div class="form-group row">
                        <label class="col-md-2">Department<span class="text-danger">*</span></label>
                        <div class="col-md-4">
                         <select class="form-control dept">
                         <option value="">Select Department</option>
                            <?php
                              for($i=0;$i<count($getdept);$i++)
                              {
                                  ?>
                                    <option value="<?php echo $getdept[$i]['dept_id']; ?>" <? if($getdept[$i]['dept_id']==$getemp[0]['department']){echo "selected";} ?>><?php echo $getdept[$i]['dept_name']; ?></option>
                                  <?
                              }
                             ?>
                         </select>
                        </div>
                     </div>
                      <div class="form-group row">
                        <label class="col-md-2">Group<span class="text-danger">*</span></label>
                        <div class="col-md-4">
                         <select class="form-control group">
                         <option value="">Select Groups</option>
                            <?php
                              for($i=0;$i<count($getgroup);$i++)
                              {
                                  ?>
                                    <option value="<?php echo $getgroup[$i]['group_id']; ?>" <? if($getgroup[$i]['group_id']==$getemp[0]['emp_group']){echo "selected";} ?>><?php echo $getgroup[$i]['group_name']; ?></option>
                                  <?
                              }
                             ?>
                         </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-md-2">Employee Name<span class="text-danger">*</span></label>
                        <div class="col-md-4">
                          <input type="text" name="empname" id="empname" onblur="firstcapital('empname')" class="form-control empname text-capitalize" maxlength="50" value="<?php echo $getemp[0]['emp_name']; ?>" />
                           <input type="hidden" name="empid" class="form-control empid" value="<?php echo $getemp[0]['emp_id']; ?>" />
                        </div>
                     </div>

                     <div class="form-group row">
                        <label class="col-md-2">Email<span class="text-danger">*</span></label>
                        <div class="col-md-4">
                          <input type="text" name="empemail" id="empemail" class="form-control empemail" maxlength="70" value="<?php echo $getemp[0]['emp_email']; ?>" onblur="checkemail('empemail')" />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-md-2">Username<span class="text-danger">*</span></label>
                        <div class="col-md-4">
                          <input type="text" name="username" id="username"  class="form-control username" maxlength="20" value="<?php echo $getemp[0]['username']; ?>" />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-md-2">Set Password</label>
                        <div class="col-md-4">
                          <input type="password" name="emppwd" class="form-control emppwd" maxlength="20" value="" />
                        </div>
                     </div>
                       <div class="form-group row">
                        <label class="col-md-2">Status</label>
                        <div class="col-md-4">
                          <input type="radio" name="status" class="status"  value="1" <? if($getemp[0]['isActive']=="1"){echo "checked";}else{}  ?> /> Active&nbsp;&nbsp;
                            <input type="radio" name="status" class="status"  value="0" <? if($getemp[0]['isActive']=="0"){echo "checked";}else{}  ?> /> Deactive&nbsp;&nbsp;
                        </div>
                     </div>
                       <div class="form-group row">
                        <label class="col-md-2">Account Type</label>
                        <div class="col-md-4">
                          <input type="radio" name="acctype" class="acctype"  value="Admin" <? if($getemp[0]['acc_type']=="Admin"){echo "checked";}else{}  ?> /> Admin&nbsp;&nbsp;
                            <input type="radio" name="acctype" class="acctype"  value="Staff" <? if($getemp[0]['acc_type']=="Staff"){echo "checked";}else{}  ?> /> Staff&nbsp;&nbsp;
                        </div>
                     </div>
                      <div class="form-group row">
                          <label class="col-md-2"></label>
                           <div class="col-md-4">
                          <input type="checkbox" name="access" class="access" value="1" <? if($getemp[0]['admin_panel_access']=="1"){echo "checked";}else{}  ?> /> Give Admin Panel Access&nbsp;&nbsp;
                           </div>
                     </div>
                  
            
                        <div>
                          <button type="button" id="submit" class="btn btn-primary"> Update </button>
                        <a href="<?php echo ADMINURL?>support/staff.php"  id="cancel" class="btn btn-primary btnred">Cancel</a>
                          <button type="button" id="delbtn" class="btn btn-secondary" onclick="delstaff('<?php echo $emp; ?>')">Delete Staff</button>
                        </div>
                
                 </form>
            </div>
             </div>
     </div>
     <?php include('../footer.php'); ?>
     </div>
</div>

<script>

    function checkemail(inpid) {
        var email = $("#" + inpid).val();
        var patt = new RegExp(/^[a-zA-Z0-9._\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/);
        var res = patt.test(email);
        if (res) {
            $("#" + inpid).css("border", "1px solid #c3c3c3");
            $("#submit").prop("disabled", false);
        } else {
            $("#" + inpid).css("border", "1px solid red");
            $("#submit").prop("disabled", true);
        }
    }
    function delstaff(empid)
        {
            if(confirm("Info : Deleting Employee will NOT afffect the previously defined tickets"))
             {
                  var info={empid:empid};
                  $.ajax({
                        type:"POST",
                        url:"deletestaff.php",
                        data:info,
                        success:function(response){
                           if(response==1)
                              {
                                   window.location = "staff.php";
                              }
                              else
                              {
                               $('.msgs').fadeIn();
                               $('.msgs').addClass("alert alert-danger");
                                $('.msgs').html("ERROR..");
                                $('.msgs').delay(5000).fadeOut();
                              }
                        }
                  });
             }
        }
    $(document).ready(function() {
        $("#submit").on("click", function() {
            var empid = $(".empid").val();
            var username=$(".username").val();
            var dept = $(".dept option:selected").val();
            var group = $(".group option:selected").val();
            var empname = $(".empname").val();

            var empemail = $(".empemail").val();
            var emppwd = $(".emppwd").val();
            var status = $(".status:checked").val();
              var acctype = $(".acctype:checked").val();
            var encoded = $(".encodeddept").val();
            var access = $(".access:checked").val();
           if(typeof access=="undefined")
           {
               adminacceess="0";
           }
           else
           {
              adminacceess="1";
           }

            if ((username!="")&&(empname != "") && (dept != "")&& (group != "") && (empemail != "")) {
                var info = {
                    empid: empid,
                    username:username,
                    dept:dept,
                    group:group,
                    empname: empname,
                   /* emppost: emppost,      */
                    empemail: empemail,
                    emppwd: emppwd,
                    status: status,
                    acctype:acctype,
                    adminacceess:adminacceess
                };
                $.ajax({
                    type: "POST",
                    url: "updatestaffdata.php",
                    data: info,
                    success: function(response) {
                        if (response == 1) {
                            $('.msgs').fadeIn();
                             $('.msgs').removeClass("alert alert-danger");
                            $('.msgs').addClass("alert alert-success");
                            $('.msgs').html("Details updated Successfully");
                            $('.msgs').delay(5000).fadeOut();
                            window.setTimeout(function() {
                                window.location = "staff.php";
                            }, 500);
                        }
                        if (response == 0) {
                            $('.msgs').fadeIn();
                              $('.msgs').removeClass("alert alert-success");
                            $('.msgs').addClass("alert alert-danger");
                            $('.msgs').html("Not Inserted");
                            $('.msgs').delay(5000).fadeOut();
                        }
                    }
                });
            } else {
                $('.msgs').fadeIn();
                  $('.msgs').removeClass("alert alert-success");
                $('.msgs').addClass("alert alert-danger");
                $('.msgs').html("Please fill all requierd fields");
                $('.msgs').delay(5000).fadeOut();
            }
        });
        function goBack() {
                    window.history.back();
                    }

    });
</script>

</body>
</html>