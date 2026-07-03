<?php include("../../includes/configuration.php"); $id12=base64_decode($_GET['id']); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Update Subadmin</title>
    <? include "../commoncss.php"; ?>
</head>
<body>
<div class="page-body-wrapper">
    <? include '../header.php'; ?>
    <? include '../cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Update Subadmin</h2></div></div>
                <div class="card-body pb-2">
                    <form class="form-horizontal">
                        <?php $getid = selectQuery(USER,"*","u_id=".$id12); ?>
                        <div>
                            <h6 class="mb-3">Credential</h6>
                            <div class="msgs1"></div>
                            <div id="getid" class="cc-display-none"><?php echo $id12; ?></div>
                                <div class="row border-bottom mb-3">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-12 col-lg-4 col-form-label cc-mandatary-field">Username</label>
                                            <div class="col-sm-12 col-md-12 col-lg-8"><input type="text" name="uname" id="uname" class="form-control" value="<?php echo $getid[0]['username'];?>" disabled="disabled" placeholder="Enter Username"/></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-left">Password</label>
                                            <div class="input-group col-md-8 col-sm-12 col-xs-12">
                                            <input type="password" name="pass" id="pass" class="form-control emppwd" maxlength="" value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-12 col-lg-4 col-form-label">Email</label>
                                            <div class="col-sm-12 col-md-12 col-lg-8"><input type="text" name="uemail" id="uemail" class="form-control" maxlength="15" value="<?php echo $getid[0]['u_email'] ?>" disabled="disabled" placeholder="Enter Email"/></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-12 col-lg-4 col-form-label">Mobile No</label>
                                            <div class="col-sm-12 col-md-12 col-lg-8"><input type="text" name="umbl" id="umbl" class="form-control number" maxlength="10" value="<?php echo $getid[0]['u_mob'] ?>" placeholder="Enter Mobile No"/></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div>
                        <h6 class="mb-3">Select Department</h6>
                        <div class="msgs"></div>
                        <div>
                            <?php $id = $getid[0]['u_id']; $uname = $getid[0]['username']; $type = $getid[0]['utype']; $menuid = $getid[0]['allocatemenu']; $new = explode(",",$menuid); $arr = array();
                            for($i=0;$i<sizeof($new);$i++){ $arr[]="menu_id=".$new[$i]; }
                            $ids = implode(" OR ",$arr);
                            $decidemenu = selectQuery(menu,"*",$ids); $menuname = array();
                            for($i=0;$i<count($decidemenu);$i++){ $menud= $decidemenu["$i"]['menu_name']; array_push($menuname, $menud); } ?>
                            <div class="row">
                                <?php $categories = selectQuery(menu,"distinct category");
                                for($c=0;$c<count($categories);$c++){
                                $menu = selectQuery(menu,"*","isActive='1' And category='".$categories[$c]['category']."' order by menu_name ASC");
                                if(count($menu)){ ?>
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-3">
                                        <h6 class="mb-2 text-primary"><?php echo $categories[$c]['category']; ?> Departments</h6>
                                        <?php for($i=0;$i<count($menu);$i++){ ?>
                                        <div class="custom-control custom-checkbox mb-2"><input type="checkbox" id="seldept<?php echo $menu[$i]['menu_id']; ?>" class="menu custom-control-input" <? if (in_array($menu[$i]['menu_name'], $menuname)) echo "checked"; else echo ""; ?>  value="<?php echo $menu[$i]['menu_id']; ?>"> <?php echo ucfirst($menu[$i]['menu_name']); ?> <label class="custom-control-label" for="seldept<?php echo $menu[$i]['menu_id']; ?>">Check this custom checkbox</label></div>
                                        <? } ?>
                                    </div>
                                    <? } } ?>
                                </div>
                            </div>
                        </div>
                        <div class="msgsucc"></div>
                        <div class="row border-top"><div class="col-12 text-right pt-2"><button type="button" name="create" id="submit" class="btn btn-primary">Update</button></div></div>
                    </form>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
     </div>
</div>
<script>
$("#submit").on("click",function(){
    var uname = $("#uname").val(); var getid = $("#getid").html(); var umbl = $("#umbl").val(); var pass = $("#pass").val(); var arr=[];
    $(".menu:checked").each(function(){ arr.push($(this).val()); });
    var str = arr.toString();
    if((str !="")){
        var info = {menuid:str, getid:getid, mobile:umbl,pass:pass};
        $.ajax({
            type:"POST", url:"update1.php", data:info,
            success:function(response){
                if(response==1){
                    $('.msgsucc').fadeIn().removeClass("alert alert-danger").addClass("alert alert-success").html("Subadmin updated Successfully").delay(5000).fadeOut();
                    setTimeout(function (){ window.history.back() }, 2000);
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
    if(res){ $('.msgs1').fadeOut(); } else{ $('.msgs1').fadeIn().addClass("alert alert-danger").html("Enter Valid Mobile Number"); }
});
$('#uemail').on('keyup',function(){
    var email = $("#uemail").val(); var patt = new RegExp(/^[a-zA-Z0-9._\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/); var res = patt.test(email);
    if(res){ $('.msgs1').fadeOut(); }else{ $('.msgs1').fadeIn().addClass("alert alert-danger").html("Invalid Email Address"); }
});
</script>
</body>
</html>