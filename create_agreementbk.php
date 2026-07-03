<?php include ("includes/configuration.php");
$cityarr = unserialize (cityarr);
$occuarr = unserialize (occuarr);
$proparr = unserialize (proparr);
sort($cityarr);
sort($occuarr); ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITENAME; ?> | Create Rent Agreement</title>
    <meta charset="UTF-8">
    <?php include 'commoncss.php'; ?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css">
</head>
<body class="mainbody bg-light">
<?php include 'menu.php';
if($loginuserid==""){ ?><script>window.location="home.php";</script><? } ?>
<div class="bg-primary text-white py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-md-flex justify-content-between  align-items-center">
                <h5 class="no-print mb-2 mb-md-0">Create New Leave & License Agreement</h5>
                <div><span class="no-print"></span><span id="leadno" class="text-info"></span><span> <b>Date</b> - <?php echo date("d-m-Y [ H:i ]"); ?></span></div>
            </div>
        </div>
    </div>
</div>
<div class="content pb-4">
    <div class="bg-white agrecretab py-3 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled mb-0">
                        <li class="pill1 active"><a data-toggle="pill" href="#Step1">Landlord</a></li>
                        <li class="pill2"><a data-toggle="pill" href="#Step2">Tenant</a></li>
                        <li class="pill3"><a data-toggle="pill" href="#Step3">Property</a></li>
                        <li class="pill4"><a data-toggle="pill" href="#Step4">Rent</a></li>
                        <li class="pill5"><a data-toggle="pill" href="#Step5">Additional Services</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row maindiv">
            <div class="col-md-12 col-lg-5 licenceform mb-4 mb-lg-0" id="licenceform">
                <div class="tab-content">
                    <div id="Step1" class="tab-pane active in"><?php include("step1form.php"); ?></div>
                    <div id="Step2" class="tab-pane"><?php include("step2form.php"); ?></div>
                    <div id="Step3" class="tab-pane"><?php include("step3form.php"); ?></div>
                    <div id="Step4" class="tab-pane"><?php include("step4form.php"); ?></div>
                    <div id="Step5" class="tab-pane"><?php include("step5form.php"); ?></div>
                </div>
                <div class="msgs"></div>
            </div>
            <div class="col-md-12 col-lg-7 licencedetails" id="licencedata">
                <div class="card card-body">
                    <h4 class="mb-3 fw-6 text-uppercase text-center">Leave And License Agreement</h4>
                    <?php include("licencedata.php"); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create-agree-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm agreeNote" role="document">
        <div class="modal-content">
            <div class="modal-header pb-0 border-bottom-0"><h5 class="modal-title text-primary">IMPORTANT NOTE</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            <div class="modal-body">
                <p>Please keep all landlord and tanants Details with you before filling the Form.</p>
                <ol class="pl-3 mb-0"><li>Pan Card</li><li>Aadhar Card</li><li>Mobile No</li><li>Property Details</li></ol>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script src="<?php echo SITEURL; ?>/js/step1.js"></script>
<script src="<?php echo SITEURL; ?>/js/step2.js"></script>
<script src="<?php echo SITEURL; ?>/js/step3.js"></script>
<script src="<?php echo SITEURL; ?>/js/step4.js"></script>
<script src="<?php echo SITEURL; ?>/js/step5.js"></script>
<script src="<?php echo SITEURL; ?>/js/datepicker/moment.js"></script>
<script src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/generalfunctions.js"></script>
<script>
$(document).ready(function(){
    $("#create-agree-modal").modal("show");
    var modalDialog = $(this).find(".agreeNote");
    $("#create-agree-modal").on("shown.bs.modal", alignModal);
    $(window).on("resize", function(){ $("#create-agree-modal:visible").each(alignModal); });
});
</script>
<script>
$("#datepicker").datetimepicker({
    format: 'DD/MM/YYYY'  }).
    on('dp.change', function (e) { // Event listener for date change
    const selectedDate = e.date ? e.date.format('DD/MM/YYYY') : null;
    if (selectedDate) {
        $(".landlorddetails .current .dob").html(selectedDate);
    }
});

$("#datepicker1").datetimepicker({ 
    format: 'DD/MM/YYYY' })
    .on('dp.change', function (e) { // Event listener for date change
    const selectedDate = e.date ? e.date.format('DD/MM/YYYY') : null;
    if (selectedDate) {
        $(".tenentdetails .current .dob").html(selectedDate);
    }
});
</script>
</body>
</html>