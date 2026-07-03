<?php include("../../includes/configuration.php"); $getclient = selectQuery(SUPPORTCLIENT,"*","isActive='1'");
$getproject = selectQuery(PROJECTLIST,"*","status='1' order by proj_name ASC"); ?>
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
        <div class="card mb-0">
            <div class="card-header sec-card-head justify-content-between align-items-center py-2">
                    <div><h2 class="card-head-title">Add New Project</h2></div>
                    <div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div>
                </div>
            
        <div class="card-body">

          <div class="msgs"></div>
         <form>

              <div class="form-group row">
                <label class="col-md-2 col-form-label">Project<span class="text-danger">*</span></label>
                <div class="col-md-4">

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


                        <div class="documentlist">
                            <input type="hidden" name="projlist" id="projlist">
                        </div>

                </div>
                <div class="col-md-2"><button type="button" class="btn btn-primary" onclick="addproj('project')">AddToList</button></div>
             </div>
             
              <div id="showproj" class="form-group row">
                  <label class="col-md-2 col-form-label">Project<span class="text-danger">*</span></label>
                  <div class="col-md-4"><input type="text" name="projectname" id="projectname" class="form-control"/></div>
                     <div class="col-md-2"><button type="button" class="btn btn-primary" onclick="checkaddproj();">Add Project</button></div>
                </div>

             <div class="form-group row">
                <label class="col-md-2 col-form-label">Client Name<span style="color:red;">*</span></label>
                <div class="col-md-4">
                  <!--<input type="text" name="clientname" id="clientname"  onblur="checkname('clientname');" onblur="firstcapital('clientname')" onkeyup="checkchar(event,'clientname')" class="form-control clientname text-capitalize" maxlength="40" value="" />-->
                  <input type="text" name="clientname" id="clientname"  onblur="checkname('clientname');" onkeyup="checkchar(event,'clientname')" class="form-control clientname text-capitalize" maxlength="40" value="" />
                   <input type="hidden" name="deptid" id="deptid" class="deptid"/>
                </div>
             </div>

             <div class="form-group row">
                <label class="col-md-2 col-form-label">Email<span style="color:red;">*</span></label>
                <div class="col-md-4">
                  <input type="text" name="clientemail" id="clientemail" class="form-control clientemail" autocomplete="off" value="" maxlength="70"  onblur="checkemail('clientemail');">
                     <input type="hidden" name="isemail" class="form-control isemail" />
                </div>
             </div>
             <div class="form-group row">
                <label class="col-md-2 col-form-label">Mobile No</label>
                <div class="col-md-4">
                  <input type="text" name="mobile" id="mobile" onkeyup="numbercheck('mobile')" class="form-control" maxlength="10">
                </div>
             </div>
             <div class="form-group row">
                <label class="col-md-2 col-form-label">Username<span style="color:red;">*</span></label>
                <div class="col-md-4">
                  <input type="text" name="username" id="username"  class="form-control username" maxlength="20"  />
                </div>
             </div>
             <div class="form-group row">
                <label class="col-md-2 col-form-label">Set Password<span style="color:red;">*</span></label>
                <div class="col-md-4">
                  <input type="password" name="clientpwd" class="form-control clientpwd" maxlength="20" value="" autocomplete="off" />
                </div>
             </div>

              <div class="row">
                <label class="col-md-2"></label>
                <div class="col-md-4">
                  <button type="button" id="submit" class="btn btn-primary"> Add </button>
                  <button type="button" id="cancel" class="btn btn-secondary" onclick="goBack()"> Cancel </button>
                </div>
             </div>
       
         </form>
                </div>
            </div>
     </div>
     <?php include('../footer.php');?>
</div>
</div>
<script src="../../js/bootstrap-switch.js"></script>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="../../js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../../js/buttons.html5.min.js"></script>
<script src="../../js/bootstrap-toggle.min.js"></script>

<script>
    $(".clientemail").val("");
    $(".clientpwd").val("");
function goBack() {
    window.history.back();
}
function checkchar(event,id)
{
    var key = event.which || event.keyCode;
    var inp=$("#"+id).val();
    if (key >= 65 && key <= 90 ||
        // Backspace and Tab and Enter and shift
            key == 8 || key == 9 || key == 13 ||key == 16 ||
        // Space and Home and End
            key == 32 ||key == 35 || key == 36 ||
        // Del and Ins
            key == 46 || key == 45)
        {
            $("#"+id).val(inp);
        }
        else
        {
            var newstr = inp.slice(0, -1);
            $("#"+id).val(newstr);
        }
}

$("#showproj").hide();
function checkproject()
{
    var project = $("#project option:selected").val();
    if(project=="")
    {
        $('.msgs').fadeIn();
        $('.msgs').addClass("alert alert-danger");
        $('.msgs').html("Please Select Project Name");
        $('.msgs').delay(5000).fadeOut();
    }
    if(project=="ADD")
    {
        $("#showproj").show();
    }
}
function checkaddproj()
{
    var projectname = $("#projectname").val();
   /* var client_id = $("#clientid").val(); */
    if(projectname=="")
    {
        $('.msgs').fadeIn();
        $('.msgs').addClass("alert alert-danger");
        $('.msgs').html("Please Enter Project Name");
        $('.msgs').delay(5000).fadeOut();
    }
    else
    {

        $("#projbtn").html("Adding...");
        var infodata={projectname:projectname,action:"addproject"};
        $.ajax({
                type:"POST",
                url:"addclientdata.php",
                data:infodata,
                success:function(response){

                    if(response==2)
                    {
                        $('.msgs').fadeIn();
                        $('.msgs').addClass("alert alert-success");
                        $('.msgs').html("Project Added Successfully!!!");
                        $('.msgs').delay(5000).fadeOut();
                        location.reload();
                    }
                    else
                    {
                        $('.msgs').fadeIn();
                        $('.msgs').addClass("alert alert-success");
                        $('.msgs').html("Project Not Added");
                        $('.msgs').delay(5000).fadeOut();

                    }
                }
            });
    }
}

function addproj(id)
{
    var projoption=$("#"+id+" option:selected").val();
    var projlist=$("#projlist").val();
    if(projlist!="")
    {
        var projarr=projlist.split(",");
    }
    else
    {
       var projarr=[];
    }

     if(projoption!="")
     {
        classname = projoption.replace(/\s/g, '');
        var removefunction="removeproj('"+classname+"div','"+projoption+"');";

        /*var str=' <div class="form-group '+classname+'div"><div class="form-inline"><div class="form-group" style="width:100%;"><label style="">'+projoption+'</label> <button type="button" class="btn btn-default" style="" onclick="'+removefunction+'"><i class="fa fa-times"></i></button><span id="'+classname+'error"></span></div></div></div>';*/
        var str=' <div class="form-group '+classname+'div"><label style="">'+projoption+'</label> <button type="button" class="btn btn-default" style="" onclick="'+removefunction+'"><i class="fa fa-times"></i></button><span id="'+classname+'error"></span></div>';
        $(".documentlist").append(str);
        /*$("#"+id+" option:contains('"+projoption+"')").attr("disabled","disabled");*/
        $("#"+id+" option:contains('"+projoption+"')").remove();
        projarr.push(projoption);
        projstr=projarr.toString();

        $("#projlist").val(projstr);
     }
}
function removeproj(divclass,proj_name)
{
    $(".documentlist ."+divclass).remove();
    var projlist=$("#projlist").val();
    var newarr=[];
    var projarr=projlist.split(",");
    for(i=0;i<projarr.length;i++)
    {
        if(projarr[i]==proj_name)
        {
            $("#project option[value='"+proj_name+"']").attr("disabled",false);
        }
        else
        {
            newarr.push(projarr[i]);
        }
    }
    projstr=newarr.toString();
    $("#projlist").val(projstr);
 }

function checkname(name)
{
    var clientname = $("#"+name).val();
    var info={clientname:clientname,action:"checkname"};
        $.ajax({
            type:"POST",
            url:"checkavalability.php",
            data:info,
            success:function(response){
                if(response==1)
                {
                }
                if(response==0)
                {
                    $('.msgs').fadeIn();
                    $('.msgs').addClass("alert alert-danger");
                    $('.msgs').html("Client Name Already Exists");
                    $('.msgs').delay(5000).fadeOut();
                    $("#"+name).val("");
                    /*$(".isemail").val("0");*/
                }
            }
        });

}
function checkemail(inpid)
{
    var email = $("#"+inpid).val();
    var checktype="Emailcheck";
    var patt = new RegExp(/^[a-zA-Z0-9._\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/);
    var res = patt.test(email);
    if(res)
    {
        $("#"+inpid).css("border","1px solid #c3c3c3");
        $("#submit").prop("disabled",false);
       /* var info={email:email,checktype:checktype,action:"checkemail"};
        $.ajax({
            type:"POST",
            url:"checkavalability.php",
            data:info,
            success:function(response){
                if(response==1)
                {
                }
                if(response==0)
                {
                    $('.msgs').fadeIn();
                    $('.msgs').addClass("alert alert-danger");
                    $('.msgs').html("Email Already Exists");
                    $('.msgs').delay(5000).fadeOut();
                    $(".isemail").val("0");
                    $("#"+inpid).val("");
                }
            }
        });*/
    }
    else
    {
        $("#"+inpid).css("border","1px solid red");
        $("#submit").prop("disabled",true);
        $('.msgs').fadeIn();
        $('.msgs').addClass("alert alert-danger");
        $('.msgs').html("Please Enter Valid Email");
        $('.msgs').delay(5000).fadeOut();

    }
}

$(document).ready(function() {

    $("#submit").on("click",function() {
        var clientname =$(".clientname").val();
        var projlist =$("#projlist").val();
        var clientemail= $(".clientemail").val();
        var mobile= $("#mobile").val();
        var username=$(".username").val();
        var clientpwd= $(".clientpwd").val();

        /*alert(clientname+projlist+clientemail+mobile+username+clientpwd);*/

        if ((clientname == "") || (projlist == "") || (project=="ADD") || (clientemail == "") || (username=="")||  (clientpwd == ""))
        {
            $('.msgs').fadeIn();
            $('.msgs').addClass("alert alert-danger");
            $('.msgs').html("Please Fill All Required Fields");
            $('.msgs').delay(5000).fadeOut();
        }

        else
        {
            $("#submit").prop("disabled",true);
            var infodata={clientname:clientname,project:projlist,clientemail:clientemail,mobile:mobile,username:username,clientpwd:clientpwd,action:"addclient"};
            $.ajax({
                type:"POST",
                url:"addclientdata.php",
                data:infodata,
                success:function(response){
                /*alert(response);*/
                    if(response==1)
                    {
                        $('.msgs').fadeIn();
                        $('.msgs').addClass("alert alert-success");
                        $('.msgs').html("Client Added Successfully!!!");
                        $('.msgs').delay(5000).fadeOut();
                        location.reload();
                    }
                    else
                    {
                        $('.msgs').fadeIn();
                        $('.msgs').addClass("alert alert-danger");
                        $('.msgs').html("Not Added");
                        $('.msgs').delay(5000).fadeOut();
                    }
                }
            });
        }
    });
});

function numbercheck(id)
{
   var inp=$("#"+id).val();

   if(isNaN(inp))
   {
       var newstr = inp.slice(0, -1);
       $("#"+id).val(newstr);
   }
}
</script>
</body>
</html>