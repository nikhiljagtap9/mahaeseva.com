<?php include("includes/configuration.php");
$user = $_SESSION['reguser']; $userdata = selectQuery(WEB_USER,"*","u_id=".$user); $segment = $path_info['call_parts'][1]; $agree = base64_decode($segment);
if($user==""||$agree==""){ ?> <script>window.location="<?php echo SITEURL; ?>";</script>
<? }
$agrdata = selectQuery(AGR,"*","agreement_no='".$agree."'"); ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITENAME; ?> | Book Appointment</title>
    <?php include 'commoncss.php'?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css">
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'AW-726761326');
    </script>
</head>
<body class="mainbody bg-light">
<?php include 'menu.php'?>
<div class="content py-4" ng-app="myApp" ng-controller="myCtrl">
    <div class="container">
        <div class="row">
            <div class="col-md-4 bookappointment centerDiv offset-md-4">
                <div class="card mb-0">
                    <div class="card-body">
                        <h5 class="fw-6 mb-4">Book Appointment</h5>
                        <div class="msgs"></div>
                        <!--<div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Appointment Date</label>
                                <input type='text' class="form-control appotdate" id='appotdate' />
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label>Appointment Date</label>
                            <div class='input-group date'>
                                <input type='text' class="form-control appotdate-new border-right-0" id='appotdate'/>
                                <div class="input-group-append"><span class="input-group-text bg-white border-left-0"><span class="fa fa-calendar-o"></span></span></div>
                            </div>
                        </div>
                        <?php
                        if(!empty($agrdata[0]['party_appointement'])){
                        ?>
                        <div class="form-group">
                        <label><?php echo ucfirst($agrdata[0]['party_appointement']);?> Appointment Date</label>
                            <div class='input-group date'>
                                <input type='text' class="form-control exappotdate-new border-right-0" id='exappotdate'/>
                                <div class="input-group-append"><span class="input-group-text bg-white border-left-0"><span class="fa fa-calendar-o"></span></span></div>
                            </div>
                        </div>

                        <?php }
                        ?>
                        <button type="button" class="btn btn-primary btn-block" onclick="book('<?php echo $agree; ?>','<?php echo base64_encode($agree); ?>')">Book Appointment & Proceed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script src="<?php echo SITEURL; ?>/js/generalfunctions.js"></script>
<script src="<?php echo SITEURL; ?>/js/datepicker/moment.js"></script>
<script src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>
<script>
var tomorrow = moment().add('days', 1) ;
$("#appotdate").datetimepicker({ format: 'DD-MM-YYYY HH:mm', minDate:tomorrow })
$("#exappotdate").datetimepicker({ format: 'DD-MM-YYYY HH:mm', minDate:tomorrow })
function book(agrino,enc){
    appointment_Date = $(".appotdate-new").val();
    ex_appointment_Date = $(".exappotdate-new").val();
    if(appointment_Date==""){
        $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Please Select Appointment Date').delay(5000).fadeOut();
    } else{
        var info = { agreement_id:agrino, appointment_Date:appointment_Date, ex_appointment_Date:ex_appointment_Date, action:"update_appointment" };
        $.ajax({
            type:"POST", url:"<?php echo SITEURL; ?>/ajax.php", data:info,
            success:function(response){
                if(response==0){
                    $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Error in Appointment Date Set').delay(5000).fadeOut();
                } else{ window.location="<?php echo SITEURL; ?>/pay/"+enc; }
            }
        });
    }
}
</script>
</body>
</html>