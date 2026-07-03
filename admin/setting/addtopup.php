<?php include("../../includes/configuration.php"); ?>
<!doctype html>
<html lang='en'>
<head>
 <title><?php echo SITE_TITLE; ?> | Add OTP</title>
<? include "../commoncss.php"; ?>
</head>
<body>
<div class="page-body-wrapper">
    <? include '../header.php'; ?>
    <? include '../cssmenu.php'; ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Add SMS Top-Up</h2></div><div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                <div class="card-body pb-2">
                    <div class="msgs"></div>
                    <h6 class="mb-3">Current SMS Balance <span class="label label-info"><?php echo $credit; ?></span></h6>
                    <div class="msgs1"></div>
                    <form>
                        <div class="row">
                            <div class="col-md-2 col-sm-4 col-xs-6 text-center"><div class="smsico plan1 btn-info rounded-circle mb-2"><b>PLAN<br>A</b></div><div class="col-md-12"> <span>[10000 SMS]</span>
                            <h4><label class="radio-inline"><input type="radio" name="plan" class="plan" value="plan1,10000,1500" autocomplete="off"/><span class="currencysymbol"> </span><b>1500</b></label></h4></div></div>
                            <div class="col-md-2 col-sm-4 col-xs-6 text-center"><div class="smsico plan2 btn-danger rounded-circle mb-2"><b>PLAN<br>B</b></div><div class="col-md-12"><span>[20000 SMS]</span>
                            <h4><label class="radio-inline"><input type="radio" name="plan" class="plan" value="plan2,20000,1000" autocomplete="off"/><span class="currencysymbol"> </span><b>1000</b></label></h4></div></div>
                            <div class="col-md-2 col-sm-4 col-xs-6 text-center"><div class="smsico plan3 btn-warning rounded-circle mb-2"><b>PLAN<br>C</b></div><div class="col-md-12"><span> [50000 SMS]</span>
                            <h4><label class="radio-inline"><input type="radio" name="plan" class="plan" value="plan3,50000,2000" autocomplete="off"/><span class="currencysymbol"> </span><b>2000</b></label></h4></div></div>
                        </div>
                        <div class="row border-top"><div class="col-12 text-right pt-2"><button type="button" name="create" id="submit" class="btn btn-primary">Send Top-up Request</button></div></div>
                    </form>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
     </div>
</div>
<script>
$("#submit").on("click",function(){
    $('.msgs').fadeIn();
    $('.msgs').html('<i class="fa-li fa fa-spinner fa-spin size30"></i>Please wait while we are sending your request').addClass("alert alert-success");
    $('.msgs').delay(5000).fadeOut();
    var plan = $(".plan:checked").val();
    if((typeof plan!="undefined")){
        var info = { plan:plan };
        $.ajax({
            type:"POST", url:"requesttopup.php", data:info,
            success:function(response){
                if(response==1){
                    $('.msgs').fadeIn().addClass("alert alert-success").html("Request submitted successfully").delay(5000).fadeOut();
                } if(response==0){
                    $('.msgs').fadeIn().addClass("alert alert-success").html("Please try again").delay(5000).fadeOut();
                }
            }
        });
    } else{
       $('.msgs').fadeIn().addClass("alert alert-danger").html("Please select plan").delay(5000).fadeOut();
    }
});
$('input[type="radio"]').click(function(){
    var inputValue = $(this).attr("value");
    var targetBox = $("." + inputValue);
    $(".smsico").not(targetBox).removeClass("scalar");
    $(targetBox).addClass("scalar");
});
</script>
</body>
</html>
