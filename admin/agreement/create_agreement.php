<?php include ("../../includes/configuration.php"); $cityarr = unserialize (cityarr); $occuarr=unserialize (occuarr); $proparr = unserialize (proparr); sort($cityarr); sort($occuarr);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo SITENAME; ?> | Create Agreement</title>
    <?php include('../commoncss.php');?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/summernote/summernote.css">
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php') ?>
    <?php include('../cssmenu.php') ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Create New Leave & License Agreement</h2></div> <div class="btn-actions-pane-right"><b>Date</b> - <?php echo date("d-m-Y [ H:i ]"); ?></div></div>
                <div class="card-body">
                    <div class="licence-steps mb-3">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link agrmstep1 active" href="#Step0">Client</a></li>
                            <li class="nav-item"><a class="nav-link agrmstep2" href="#Step1">Landlord</a></li>
                            <li class="nav-item"><a class="nav-link agrmstep3" href="#Step2">Tenant</a></li>
                            <li class="nav-item"><a class="nav-link agrmstep4" href="#Stepn">Witness</a></li>
                            <li class="nav-item"><a class="nav-link agrmstep5" href="#Step3">Property</a></li>
                            <li class="nav-item"><a class="nav-link agrmstep6" href="#Step4">Rent</a></li>
                            <li class="nav-item"><a class="nav-link agrmstep7" href="#Step5">Additional Services</a></li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-5 licenceform" id="licenceform">                   
                            <div class="tab-content">
                                <div class="msgs"></div>
                                <div id="Step0" class="tab-pane active"><?php include("step0form.php"); ?></div>
                                <div id="Step1" class="tab-pane fade"><?php include("step1form.php"); ?></div>
                                <div id="Step2" class="tab-pane fade"><?php include("step2form.php"); ?></div>
                                <div id="Stepn" class="tab-pane fade"><?php include("stepnform.php"); ?></div>
                                <div id="Step3" class="tab-pane fade"><?php include("step3form.php"); ?></div>
                                <div id="Step4" class="tab-pane fade"><?php include("step4form.php"); ?></div>
                                <div id="Step5" class="tab-pane fade"><?php include("step5form.php"); ?></div>
                            </div>
                        </div>
                        <div class="col-md-7" id="licencedata">
                            <div class="licencedetails p-3 border">
                                <h4 class="mb-4">Leave And License Agreement</h4>
                                <?php include("licencedata.php"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../footer.php'?>     
    </div>
</div>
<script src="<?php echo SITEURL; ?>/summernote/summernote.js"></script>
<script src="<?php echo ADMINURL; ?>agreement/generalfunctions.js"></script>
<script src="<?php echo SITEURL; ?>/js/datepicker/moment.js"></script>
<script src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo ADMINURL; ?>agreement/step1.js"></script>
<script src="<?php echo ADMINURL; ?>agreement/step2.js"></script>
<script src="<?php echo ADMINURL; ?>agreement/stepn.js"></script>
<script src="<?php echo ADMINURL; ?>agreement/step3.js"></script>
<script src="<?php echo ADMINURL; ?>agreement/step4.js"></script>
<script src="<?php echo ADMINURL; ?>agreement/step5.js"></script>
<script>
    $(function(){ $('.summernote').summernote({ height: 200 }); });
    $('.summernote').val("");
</script>
<script>
$("#datepicker").datetimepicker({
    format: 'DD/MM/YYYY'  }).
    on('dp.change', function (e) { // Event listener for date change
    const selectedDate = e.date ? e.date.format('DD/MM/YYYY') : null;
    if (selectedDate) {
        $(".landlorddetails .current .dob").html(selectedDate);
        age = calculateAge(selectedDate);
        $('#landlord1age').val(age);
        showvalinput('landlord1age','age');
        console.log(selectedDate); // Logs the selected date

    }
});

$("#datepicker1").datetimepicker({ 
    format: 'DD/MM/YYYY' })
    .on('dp.change', function (e) { // Event listener for date change
    const selectedDate = e.date ? e.date.format('DD/MM/YYYY') : null;
    if (selectedDate) {
        $(".tenentdetails .current .dob").html(selectedDate);
        age = calculateAge(selectedDate);
        $('#tenent1age').val(age);
        showvalinput('tenent1age','age');
        console.log(selectedDate); // Logs the selected date
    }
});
function calculateAge(dob) {
    let dobArray = dob.split('/');
    let birthDate = new Date(dobArray[2], dobArray[1] - 1, dobArray[0]);
    let today = new Date();
    
    let age = today.getFullYear() - birthDate.getFullYear();
    let monthDifference = today.getMonth() - birthDate.getMonth();
    
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}
</script>
</body>
</html>