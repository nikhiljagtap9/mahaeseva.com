<?php include ("../../includes/configuration.php");
$user = $_SESSION['reguser']; $segment = $_REQUEST['agr']; $agree = base64_decode($segment); $agrdata = selectQuery(AGR,"*","agreement_no='".$agree."'"); 

// echo "<pre>";
// print_r($agrdata[0]['party_appointement']);
// die();
?>  
<!doctype html>
<html>
<head>
    <title><?php echo SITENAME; ?> | Book Appointment</title>
    <?php include('../commoncss.php');?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css"/>
</head>
<body class="">
<div class="page-body-wrapper">
    <?php include('../header.php') ?>
    <?php include('../cssmenu.php') ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card bookappointment mb-0">
            <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Book Appointment</h2></div></div>
                <div class="card-body">
                    <div class="msgs"></div>
                    <div class="form-group row">
                        <label class="col-md-3">Appointment Already Taken ?</label>
                        <div class="col-md-5">
                        <input type='radio' name="appaction" class="appaction" id='appaction' value="Yes"> Yes&nbsp;&nbsp;
                        <input type='radio' name="appaction" class="appaction" id='appaction' value="No" checked> No
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Appointment Date</label>
                        <div class="col-md-4"><input type='text' class="form-control appotdate" id='appotdate' /></div>
                    </div>
                    <?php

                   if(!empty($agrdata[0]['party_appointement'])){
                   ?>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"><?php echo ucfirst($agrdata[0]['party_appointement']);?> Appointment Date</label>
                        <div class="col-md-4"><input type='text' class="form-control exappotdate" id='exappotdate' /></div>
                    </div>

                    <?php }
                    ?>
                    <div><button type="button" class="btn btn-primary" onclick="book('<?php echo $agree; ?>','<?php echo base64_encode($agree); ?>')">Proceed</button></div>
                </div>
            </div>
        </div>
        <?php include '../footer.php'?>
    </div>
</div>
<script src="<?php echo SITEURL; ?>/js/datepicker/moment.js"></script>
<script src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>
<script>
    var tomorrow = moment().add('days', 1);
    $("#appotdate").datetimepicker({ minDate:moment(), format: 'DD-MM-YYYY HH:mm', })
    $("#exappotdate").datetimepicker({ minDate:moment(), format: 'DD-MM-YYYY HH:mm', })

    function book(agrino,enc){
        appointment_Date = $(".appotdate").val();
        ex_appointment_Date = $(".exappotdate").val();
        appaction = $(".appaction:checked").val();
        if(appointment_Date==""){
            $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Please Select Appointment Date').delay(5000).fadeOut();
        } else{
            var info ={ agreement_id:agrino, appointment_Date:appointment_Date,ex_appointment_Date:ex_appointment_Date, appaction:appaction, action:"update_appointment"};
            $.ajax({
                type:"POST",
                url:"<?php echo SITEURL; ?>/ajax.php",
                data:info,
                success:function(response){
                    if(response.trim()==0){
                        $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Error in Appointment Date Set').delay(5000).fadeOut();
                    } else{ window.location="<?php echo ADMINURL; ?>agreement/payment_confirmation.php?agr="+enc; 
                    }
                }
            });
        }
    }
</script>
</body>
</html>