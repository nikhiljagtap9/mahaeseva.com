<?php include("../../includes/configuration.php"); $empid = base64_decode($_REQUEST['empid']); $getclient1 = selectQuery(SUPPORTSTAFF,"*","emp_id='".$empid."' "); $getclient = selectQuery(SUPPORTCLIENT,"*","isActive='1'"); $getproject = selectQuery(PROJECTLIST,"*","status='1' order by proj_name ASC"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> : Add Project</title>
    <?php include('../commoncss.php'); ?>
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php'); ?>
    <?php include('../cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Update Project</h2></div><div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                <div class="card-body">
                    <div class="msgs"></div>
                    <form>
                        <div>
                        <div class="form-group row">
                        <label class="col-md-2 col-form-label cc-mandatary-field">Client Name</label>
                        <div class="col-md-4"><input type="text" name="clientname" id="clientname" onblur="firstcapital('clientname')" onkeyup="checkchar(event,'clientname')" class="form-control clientname text-capitalize" maxlength="40" value="<?php echo $getclient1[0]['emp_name'];?>" />
                        <input type="hidden" name="deptid" id="deptid" class="deptid" value="<?php echo $getclient1[0]['projects']; ?>"/></div>
                        </div>
             <div class="form-group row">
                <label class="col-md-2 col-form-label cc-mandatary-field">Project</label>
                <div class="col-md-4">
                    <!--<div class="form-group row">-->
                        <select class="form-control" id="project" onchange="checkproject();">
                            <option value="">Select</option>
                            <option value="ADD">Add New Project</option>
                            <?php

                            for($i=0;$i<count($getproject);$i++)
                            {
                            ?>
                               <option value="<?php echo $getproject[$i]['proj_name']; ?>"><?php echo $getproject[$i]['proj_name']; ?></option>
                            <?}
                            ?>
                        </select>
                    <!--</div> -->

                        <div class="documentlist">
                            <input type="hidden" name="projlist" id="projlist" value="<?php echo $getclient1[0]['projects'];?>">
                            <?php
                                $projects = $getclient1[0]['projects'];
                                $arr = array();
                                $arr = explode(",",$projects);
                                for($j=0;$j<count($arr);$j++)
                                {
                            ?>
                                <div class="replace">
                                    <div class="form-group row"><label style=""><?php echo $arr[$j];?></label>
                                    <?php if($getclient1[0]['projects']!=""){?>
                                    <button type="button" class="btn btn-default" onclick="deleteproj('<?php echo $arr[$j]; ?>','<?php echo $getclient1[0]['emp_id'];?>');"><i class="fa fa-times"></i></button>
                                    <?php }?>
                                    <span id=""></span></div>
                                </div>
                            <?php }?>

                        </div>

                </div>
                <div class="col-md-2"><button type="button" class="btn btnPrimary" onclick="addproj('project')">AddToList</button></div>
             </div>
    <div id="showproj" class="form-group row">
                    <label class="col-md-2 col-form-label cc-mandatary-field">Add Project</label>
                    <div class="col-md-4">
                         <input type="text" name="projectname" id="projectname" class="form-control" placeholder="Enter New Project"/>
                    </div>
                     <div class="col-md-1"><button type="button" class="btn btn-primary" onclick="checkaddproj();">AddProject</button></div>
                </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label cc-mandatary-field">Email</label>
                            <div class="col-md-4"><input type="text" name="clientemail" id="clientemail" class="form-control clientemail" autocomplete="off" value="" maxlength="70"  onblur="checkemail('clientemail');" value="<?php echo $getclient1[0]['emp_email'];?>" placeholder="Enter Email ID">
                            <input type="hidden" name="isemail" class="form-control isemail"/></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Mobile No</label>
                            <div class="col-md-4"><input type="text" name="mobile" id="mobile" onkeyup="numbercheck('mobile')" class="form-control" maxlength="10" value="<?php echo $getclient1[0]['mobile'];?>" placeholder="Enter Contact Number"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label cc-mandatary-field">Username</label>
                            <div class="col-md-4"><input type="text" name="username" id="username" class="form-control username" maxlength="20" value="<?php echo $getclient1[0]['username'];?>" placeholder="Enter Username"/></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label cc-mandatary-field">Set Password</label>
                            <div class="col-md-4"><input type="password" name="clientpwd" class="form-control clientpwd" maxlength="20" value="" autocomplete="off" value="<?php echo $getclient1[0]['password'];?>" placeholder="Enter Password"/></div>
                        </div>
                        <div class="row border-top"><div class="col-12 pt-2 text-right"><button type="button" id="submit" class="btn btn-primary">Update</button> <button type="button" id="cancel" class="btn btn-secondary" onclick="goBack()">Cancel</button></div></div>
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
    var inp = $("#"+id).val();
    if(key >= 65 && key <= 90 || key == 8 || key == 9 || key == 13 ||key == 16 || key == 32 ||key == 35 || key == 36 || key == 46 || key == 45){  $("#"+id).val(inp); } else{ var newstr = inp.slice(0, -1); $("#"+id).val(newstr); }
}
function deleteproj(projname,empid){
    var action = "delproj";
    $.ajax({
        type : "post", url : "addclientdata.php", data : { projname:projname, empid:empid, action:action },
        success : function(res){
            if(res==1){ location.reload(); } else{ $(".replace").html(res); }
        }
    });
}
$("#showproj").hide();
function checkproject(){
    var project = $("#project option:selected").val();
    if(project==""){
        $('.msgs').fadeIn().addClass("alert alert-danger").html("Please Select Project Name").delay(5000).fadeOut();
    }
    if(project=="ADD"){ $("#showproj").show(); }
}
function checkaddproj(){
    var projectname = $("#projectname").val();
    if(projectname==""){
        $('.msgs').fadeIn().addClass("alert alert-danger").html("Please Enter Project Name").delay(5000).fadeOut();
    } else{
        $("#projbtn").html("Adding...");
        var infodata={projectname:projectname,action:"addproject"};
        $.ajax({
            type:"POST", url:"addclientdata.php", data:infodata,
            success:function(response){
            if(response==2){
                $('.msgs').fadeIn().addClass("alert alert-success").html("Project Added Successfully!!!").delay(5000).fadeOut();
                location.reload();
            } else{ $('.msgs').fadeIn().addClass("alert alert-success").html("Project Not Added").delay(5000).fadeOut(); }
            }
        });
    }
}
function addproj(id){
    var projoption = $("#"+id+" option:selected").val(); var projlist = $("#projlist").val();
    if(projlist!=""){ var projarr = projlist.split(","); } else{ var projarr=[]; }
    if(projoption!=""){
        classname = projoption.replace(/\s/g, '');
        var removefunction="removeproj('"+classname+"div','"+projoption+"');";
        /*var str=' <div class="form-group row '+classname+'div"><div class="form-inline"><div class="form-group row" style="width:100%;"><label style="">'+projoption+'</label> <button type="button" class="btn btn-default" style="" onclick="'+removefunction+'"><i class="fa fa-times"></i></button><span id="'+classname+'error"></span></div></div></div>';*/
        var str=' <div class="form-group row '+classname+'div"><label style="">'+projoption+'</label> <button type="button" class="btn btn-default" style="" onclick="'+removefunction+'"><i class="fa fa-times"></i></button><span id="'+classname+'error"></span></div>';
        $(".documentlist").append(str);
        /*$("#"+id+" option:contains('"+projoption+"')").attr("disabled","disabled");*/
        $("#"+id+" option:contains('"+projoption+"')").remove();
        projarr.push(projoption);
        projstr=projarr.toString();
        $("#projlist").val(projstr);
    }
}
function removeproj(divclass,proj_name){
    $(".documentlist ."+divclass).remove();
    var projlist = $("#projlist").val(); var newarr=[];
    var projarr = projlist.split(",");
    for(i=0;i<projarr.length;i++){
        if(projarr[i]==proj_name){ $("#project option[value='"+proj_name+"']").attr("disabled",false); }
        else{ newarr.push(projarr[i]); }
    }
    projstr = newarr.toString();
    $("#projlist").val(projstr);
}
function checkemail(inpid){
    var email = $("#"+inpid).val(); var checktype = "Emailcheck";
    var patt = new RegExp(/^[a-zA-Z0-9._\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/);
    var res = patt.test(email);
    if(res){
        $("#"+inpid).css("border","1px solid #c3c3c3");
        $("#submit").prop("disabled",false);
        var info = {email:email, checktype:checktype};
        $.ajax({
            type:"POST", url:"checkavalability.php", data:info,
            success:function(response){
                if(response==1){ }
                if(response==0){
                    $('.msgs').fadeIn().addClass("alert alert-danger").html("Email Already Exists").delay(5000).fadeOut();
                    $(".isemail").val("0");
                }
            }
        });
    } else{ $("#"+inpid).css("border","1px solid red"); $("#submit").prop("disabled",true); }
}
$("#submit").on("click",function(){
    var clientname = $(".clientname").val(); var projlist = $("#projlist").val(); var clientemail = $(".clientemail").val(); var mobile = $("#mobile").val(); var username = $(".username").val(); var clientpwd = $(".clientpwd").val(); var empid = <?php echo $empid;?>;
    $("#submit").prop("disabled",true);
    var infodata = { empid:empid, clientname:clientname, project:projlist, clientemail:clientemail, mobile:mobile, username:username, clientpwd:clientpwd, action:"updateproject" };
    $.ajax({
        type:"POST", url:"addclientdata.php", data:infodata,
        success:function(response){
            if(response==2){ $('.msgs').fadeIn().addClass("alert alert-success").html("Project Updated Successfully!!!").delay(5000).fadeOut(); location.reload(); }
            else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("Not Updated").delay(5000).fadeOut(); }
        }
    });
});
function numbercheck(id){
    var inp = $("#"+id).val();
    if(isNaN(inp)){ var newstr = inp.slice(0, -1); $("#"+id).val(newstr); }
}
</script>
</body>
</html>