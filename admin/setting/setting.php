<?php include("../../includes/configuration.php"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Setting</title>
    <? include "../commoncss.php"; ?>
</head>
<body>
<div class="page-body-wrapper">
    <? include '../header.php'; ?>
    <? include '../cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2">
                <div><h2 class="card-head-title">Add Subadmin</h2></div><div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                <div class="card-body pb-2">
                    <form class="form-horizontal">
                        <h6 class="mb-3">Credential</h6>
                        <div class="msgs1"></div>
                        <div class="row border-bottom mb-3">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-12 col-lg-4 col-form-label cc-mandatary-field">Username</label>
                                    <div class="col-sm-12 col-md-12 col-lg-8"><input type="text" name="uname" id="uname" class="form-control text-capitalize" placeholder="Enter Username" maxlength="20" onkeyup="this.value=this.value.replace(/[^a-z]/gi,'');" /></div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-12 col-lg-4 col-form-label cc-mandatary-field">Password</label>
                                    <div class="col-sm-12 col-md-12 col-lg-8"><input type="password" name="pass" id="pass" class="form-control" placeholder="Enter Password" maxlength="20" /></div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-12 col-lg-4 col-form-label cc-mandatary-field">Email ID</label>
                                    <div class="col-sm-12 col-md-12 col-lg-8"><input type="text" name="uemail" id="uemail" class="form-control" placeholder="Enter Email ID" maxlength="50" /></div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-12 col-lg-4 col-form-label cc-mandatary-field">Mobile No</label>
                                    <div class="col-sm-12 col-md-12 col-lg-8"><input type="text" name="umbl" id="umbl" class="form-control number" placeholder="Enter Mobile No" maxlength="10" /></div>
                                </div>
                            </div>
                        </div>
                        <h6 class="mb-3">Select Department</h6>
                        <div class="row">
                            <?php $categories = selectQuery(menu,"distinct category");
                            for($c=0;$c<count($categories);$c++){
                            $menu = selectQuery(menu,"*","isActive='1' And category='".$categories[$c]['category']."' order by menu_name ASC");
                            if(count($menu)){ ?>
                            <div class="col-sm-6 col-md-6 col-lg-4 mb-3">
                                <h6 class="text-primary"><b><?php echo $categories[$c]['category']; ?> Departments</b></h6>
                                <?php for($i=0;$i<count($menu);$i++){ ?>
                                <div class="custom-control custom-checkbox mb-2"><input type="checkbox" id="seldeppt<?php echo $menu[$i]['menu_id']; ?>" class="menu custom-control-input" value="<?php echo $menu[$i]['menu_id']; ?>"> <label class="custom-control-label" for="seldeppt<?php echo $menu[$i]['menu_id']; ?>"><?php echo ucfirst($menu[$i]['menu_name']); ?></label></div>
                                <? } ?>
                            </div>
                            <? } } ?>
                        </div>
                        <div class="msgs"></div>
                        <div class="row border-top"><div class="col-12 pt-2 text-right"><button type="button" name="create" id="submit" class="btn btn-primary">Add Subadmin</button></div></div>
                    </form>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
    </div>
</div>
<script>
$("#submit").on("click",function(){
    var uname = $("#uname").val(); var pass = $("#pass").val(); var uemail = $("#uemail").val(); var umbl = $("#umbl").val(); var arr=[];
    $(".menu:checked").each(function(){ arr.push($(this).val()); });
    var str= arr.toString();
    if((str !="") && (uname != "") && (pass != "") && (umbl != "") && (uemail != "")){
        var info = { menuid:str,uname:uname,pass:pass,umbl:umbl,uemail:uemail };
        $.ajax({ type:"POST", url:"addsubmenu.php", data:info,
            success:function(response){
                if(response==1){
                    $('.msgs').fadeIn().removeClass("alert alert-danger").addClass("alert alert-success").html("Subadmin Added Successfully").delay(5000).fadeOut();
                    setTimeout(function(){ window.history.back()}, 2000);
                } if(response==0){
                    $('.msgs').fadeIn().addClass("alert alert-success").html("Please try  other username").delay(5000).fadeOut();
                } if(response==2){
                    $('.msgs').fadeIn().addClass("alert alert-success").html("Not Inserted").delay(5000).fadeOut();
                }
            }
        });
    } else{ $('.msgs').fadeIn().addClass("alert alert-danger").html("Please fill all field").delay(5000).fadeOut(); }
});
$(".number").keyup(function(){
    $(this).keydown(function(e){
    var key = e.which || e.keyCode;
    if ((!e.shiftKey && !e.altKey && !e.ctrlKey && key >= 48 && key <= 57 || key >= 96 && key <= 105 ||key == 190 || key == 188 || key == 109 || key == 110 ||key == 8 || key == 9 || key == 13 ||key == 35 || key == 36 || key == 37 || key == 39 || key == 46 || key == 45)||(e.ctrlKey && key >= 99 && key <= 118)){ return true; }
    else{ $(".number").val(""); return false; }
    });
});
$(".number").keyup(function(){
    var mob = $("#umbl").val(); var patt = new RegExp(/^[7-9][0-9]{9}$/); var res = patt.test(mob);
    if(res){ $('.msgs1').fadeOut(); }
    else{ $('.msgs1').fadeIn().addClass("alert alert-danger").html("Enter Valid Mobile Number"); }
});
$('#uemail').on('keyup',function(){
    var email = $("#uemail").val();
    var patt = new RegExp(/^[a-zA-Z0-9._\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/);
    var res = patt.test(email);
    if(res){ $('.msgs1').fadeOut(); }
    else{ $('.msgs1').fadeIn().addClass("alert alert-danger").html("Invalid Email Address"); }
});
</script>
</body>
</html>