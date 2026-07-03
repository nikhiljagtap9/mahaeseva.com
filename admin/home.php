<?php include("../includes/configuration.php"); $page = 'home'; 

?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> | Home</title>
    <?php include 'commoncss.php';?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
<?php include('header.php'); ?>
<?php include('cssmenu.php'); ?>
<div class="main-panel">
    <div class="dashbody">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-3 reg-update-dash">
                <div class="dash-update-tiles rounded bg-danger mb-3 p-3 text-white position-relative">
                    <a href="<?php echo ADMINURL; ?>users">
                        <span class="fa fa-user position-absolute bg-white text-danger"></span>
                        <div class="dash-update-body"><div class="h5"><?php echo count($usermenu); ?>
                        <!-- <hr class="margin0">
                        <?php echo count($totalusermenu); ?>--></div><small>Total</small><h6 class="mb-0">Users</h6></div>
                    </a>
                </div>
             </div>
             <div class="col-sm-6 col-md-6 col-lg-3 reg-update-dash">
                 <div class="dash-update-tiles rounded bg-success mb-3 p-3 text-white position-relative">
                    <a href="<?php echo ADMINURL; ?>agreement/index.php">
                        <span class="fa fa-file-text position-absolute bg-white text-success"></span>
                        <div class="dash-update-body"><div class="h5"><?php echo count($totalagr); ?></div><small>Total</small><h6 class="mb-0">Live Agreements</h6></div>
                    </a>
                </div>
             </div>
            <div class="col-sm-6 col-md-6 col-lg-3 reg-update-dash">
                <div class="dash-update-tiles rounded bg-info mb-3 p-3 text-white position-relative">
                    <a href="<?php echo ADMINURL; ?>agreement/index.php">
                    <span class="fa fa-inr position-absolute bg-white text-info"></span>
                    <div class="dash-update-body"><div class="h5">
                    <?php if($totalpayments[0]['payment']!=""){ echo formatMoney($totalpayments[0]['payment']); }
                    else{ echo 0; } ?></div><small>Total</small><h6 class="mb-0">Payment Received</h6></div>
                    </a>
                </div>
            </div>
        </div>
        <!--<div class="card">
            <div class="card-body">
                <div class="panel-heading"><div class="panel-title"><i class="fa fa-search" aria-hidden="true"></i> Universal Search</div></div>
                <form><input type="search" name="search" id="search" autocomplete="off" class="form-control" placeholder="Search ( User Name/ User Email/ User Mobile/ Order ID/ Transaction ID/ Order Date (DD/MM/YYYY))"/></form>
                <div class="searchresult"></div>
            </div>
        </div>-->
        <h2 class="h5 mb-3"><? echo date('F Y'); ?> Statistics</h2>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-3 reg-update-dash">
                    <div class="dash-update-tiles rounded bg-warning mb-3 p-3 text-white position-relative">
                        <a href="<?php echo ADMINURL; ?>agreement/index.php">
                        <span class="fa fa-user position-absolute bg-white text-warning"></span>
                        <div class="dash-update-body"><div class="h5">
                        <?php $regmonthcnt=0;
                        for($i=0;$i<count($usermenu);$i++){
                            $regdate = $usermenu[$i]['added_on'];
                            $datearr = explode("-",$regdate);
                            if($datearr[1]==date('m')&&$datearr[0]==date('Y')){ $regmonthcnt++; }
                        } echo $regmonthcnt; ?></div><h6 class="mb-0">Registrations Users</h6></div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 reg-update-dash">
                    <div class="dash-update-tiles rounded bg-primary mb-3 p-3 text-white position-relative">
                        <a href="<?php echo ADMINURL; ?>agreement/index.php">
                        <span class="fa fa-file-text position-absolute bg-white text-primary"></span>
                        <div class="dash-update-body"><div class="h5"> <?php $agrcnt = 0;
                        for($i=0;$i<count($totalagr);$i++){
                        $entdate = $totalagr[$i]['entry_on'];
                        $datearrq = explode("-",$entdate);
                        if($datearrq[1]==date('m')&&$datearrq[0]==date('Y')){ $agrcnt++; } }
                        echo $agrcnt; ?></div><h6 class="mb-0">Total Agreements</h6></div></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 reg-update-dash">
                    <div class="dash-update-tiles rounded bg-success mb-3 p-3 text-white position-relative">
                        <a href="<?php echo ADMINURL; ?>agreement/index.php">
                        <span class="fa fa-inr position-absolute bg-white text-info"></span>
                        <div class="dash-update-body"><div class="h5">
                        <?php if($monthpayments[0]['payment']!=""){ echo formatMoney($monthpayments[0]['payment']); }
                       else{ echo 0; } ?></div><h6 class="mb-0">Payment Received</h6></div></a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Universal Search</h2></div></div> 
                <div class="card-body">
                    <form><input type="search" name="search" id="search" autocomplete="off" class="form-control" placeholder="Search By Agreement No / Token No / Property Location / Property City / Entry By / Tenent Name, Mobile, Email / Landlord Name, Mobile, Email"/></form>
                    <div class="searchresult"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Appointments</h2></div></div>
                <div class="card-body">
                    <?php $date0=date("Y-m-d"); $date1=date("Y-m-d"); $date2=date('Y-m-d', strtotime("+1 days"));
                    $date3=date('Y-m-d', strtotime("+2 days")); $date4=date('Y-m-d', strtotime("+3 days")); $date5=date('Y-m-d', strtotime("+4 days")); $date6=date('Y-m-d', strtotime("+5 days")); $date7=date('Y-m-d', strtotime("+6 days")); $date8=date('Y-m-d', strtotime("+7 days")); $overdue=selectQuery(AGR,"*","biometric_appointement_date<'".$date0." 00:00:00' and agreement_status='Open' and isDel='0' order by biometric_appointement_date ASC"); $dayapp1=selectQuery(AGR,"*","biometric_appointement_date like '%".$date1."%' and isDel='0' order by biometric_appointement_date ASC"); $dayapp2=selectQuery(AGR,"*","biometric_appointement_date like '%".$date2."%' and isDel='0' order by biometric_appointement_date ASC"); $dayapp3=selectQuery(AGR,"*","biometric_appointement_date like '%".$date3."%' and isDel='0' order by biometric_appointement_date ASC"); $dayapp4=selectQuery(AGR,"*","biometric_appointement_date like '%".$date4."%' and isDel='0' order by biometric_appointement_date ASC"); $dayapp5=selectQuery(AGR,"*","biometric_appointement_date like '%".$date5."%' and isDel='0' order by biometric_appointement_date ASC"); $dayapp6=selectQuery(AGR,"*","biometric_appointement_date like '%".$date6."%' and isDel='0' order by biometric_appointement_date ASC"); $dayapp7=selectQuery(AGR,"*","biometric_appointement_date like '%".$date7."%' and isDel='0' order by biometric_appointement_date ASC"); $dayapp8=selectQuery(AGR,"*","biometric_appointement_date like '%".$date8."%' and isDel='0' order by biometric_appointement_date ASC"); ?>
                    <ul class="nav nav-tabs mb-3" id="tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#overdue">Overdue ( <?php echo count($overdue); ?> )</a></li>
                        <?php for($i=1;$i<=8;$i++){
                        $var1 = ${"date" . $i}; $var2=${"dayapp".$i}; ?>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day<?php echo $i; ?>">
                        <?php echo date("d M",strtotime($var1)); ?> (<?php echo count($var2); ?>)
                        </a></li>
                        <? } ?>
                    </ul>
                    <div class="tab-content">
                        <div id="overdue" class="tab-pane active">
                            <h6 class="mb-3">Overdue Appointments</h6>
                            <div class="table-responsive">
                            <table class="today table example table-bordered mb-0">
                                <thead><tr><th>#</th><th>Agreement No</th><th>Client Name</th><th>Mobile No.</th><th>Date & Time</th><th>Charges</th><th>Payment</th><th>Status</th></tr></thead>
                                <tbody>
                                    <?php if(count($overdue)){
                                    for($i=0;$i<count($overdue);$i++){
                                    $user = selectQuery(WEB_USER,"*","u_id=".$overdue[$i]['agree_by']); ?>
                                    <tr>
                                        <td><?php echo $i+1; ?></td>
                                        <td><a href="<?php echo ADMINURL; ?>agreement/agreementdetails.php?agr=<?php echo base64_encode($overdue[$i]['agreement_no']); ?>" target="_blank"><?php echo $overdue[$i]['agreement_no']; ?></a></td>
                                        <td><?php echo $user[0]['u_fname']." ".$user[0]['u_lname']; ?> </td>
                                        <td><?php echo $user[0]['u_mobile']; ?></td>
                                        <td><?php echo date("d M Y h:i a",strtotime($overdue[$i]['biometric_appointement_date'])); ?></td>
                                        <td><i class="fa fa-inr"></i> <?php echo $overdue[$i]['total_charges']; ?></td>
                                        <td>
                                        <?php if($overdue[$i]['payment_mode']==""){ ?>
                                        <span class="text-danger">NOT PROCEED</span>
                                        <? } else{
                                        echo $overdue[$i]['payment_mode'];
                                        if($overdue[$i]['isPaid']=="1"){ ?>
                                        <span class="text-success">(Paid)</span>
                                        <? } else{ ?>
                                        <span class="text-success">(Pending)</span>
                                        <? } } ?>
                                        </td>
                                        <td><?php echo $overdue[$i]['agreement_status']; ?></td>
                                    </tr>
                                    <? }
                                    } else{ ?><tr><td colspan="8" style="text-align:center">No Appointment </td></tr>
                                    <? } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php for($k=1;$k<=8;$k++){ $var1=${"date" . $k}; $var2=${"dayapp".$k}; ?>
                    <div id="day<?php echo $k; ?>" class="tab-pane">
                        <h6 class="mb-3"><?php echo date("d M",strtotime($var1)); ?> Appointments</h6>
                        <div class="table-responsive">
                            <table class="today example table table-bordered">
                                <thead><tr><th>#</th><th>Agreement No</th><th>Client Name</th><th>Mobile No.</th><th>Time</th><th>Charges</th><th>Payment</th><th>Status</th></tr></thead>
                                <tbody>
                                <?php if(count($var2)){
                                    for($i=0;$i<count($var2);$i++){
                                    $user = selectQuery(WEB_USER,"*","u_id=".$var2[$i]['agree_by']); ?>
                                    <tr>
                                        <td><?php echo $i+1; ?></td>
                                        <td><a href="<?php echo ADMINURL; ?>agreement/agreementdetails.php?agr=<?php echo base64_encode($var2[$i]['agreement_no']); ?>" target="_blank"><?php echo $var2[$i]['agreement_no']; ?></a></td>
                                        <td><?php echo $user[0]['u_fname']." ".$user[0]['u_lname']; ?> </td>
                                        <td><?php echo $user[0]['u_mobile']; ?></td>
                                        <td><?php echo date("h:i a",strtotime($var2[$i]['biometric_appointement_date'])); ?></td>
                                        <td><i class="fa fa-inr"></i> <?php echo $var2[$i]['total_charges']; ?></td>
                                        <td>
                                        <?php if($var2[$i]['payment_mode']==""){ ?>
                                        <span class="text-danger">NOT PROCEED</span>
                                        <? } else{ echo $var2[$i]['payment_mode'];
                                        if($var2[$i]['isPaid']=="1"){ ?>
                                        <span class="text-success">(Paid)</span>
                                        <? } else { ?>
                                        <span class="text-success">(Pending)</span>
                                        <? } } ?>
                                        </td>
                                        <td><?php echo $var2[$i]['agreement_status']; ?></td>
                                    </tr>
                                    <? }
                                    } else{ ?> <tr><td colspan="8" class="text-center">No Appointment</td></tr><? } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <? } ?>
                </div>
            </div>
        </div>
        <div class="card mb-0">
            <div class="card-header sec-card-head justify-content-between align-items-center"><div><h2 class="card-head-title">Agreement Expiry</h2></div></div>
                <div class="card-body">
                    <?php $date11=date("d-m-Y"); $date21=date('d-m-Y', strtotime("+1 days")); $date31=date('d-m-Y', strtotime("+2 days")); $date41=date('d-m-Y', strtotime("+3 days")); $date51=date('d-m-Y', strtotime("+4 days")); $date61=date('d-m-Y', strtotime("+5 days")); $date71=date('d-m-Y', strtotime("+6 days")); $date81=date('d-m-Y', strtotime("+7 days"));
                    $dayapp11=selectQuery(AGR,"*","end_to='".$date11."' and isDel='0'");
                    $dayapp21=selectQuery(AGR,"*","end_to='".$date21."' and isDel='0'");
                    $dayapp31=selectQuery(AGR,"*","end_to='".$date31."' and isDel='0'");
                    $dayapp41=selectQuery(AGR,"*","end_to='".$date41."' and isDel='0'");
                    $dayapp51=selectQuery(AGR,"*","end_to='".$date51."' and isDel='0'");
                    $dayapp61=selectQuery(AGR,"*","end_to='".$date61."' and isDel='0'");
                    $dayapp71=selectQuery(AGR,"*","end_to='".$date71."' and isDel='0'");
                    $dayapp81=selectQuery(AGR,"*","end_to='".$date81."' and isDel='0'"); ?>
                    <ul class="nav nav-tabs mb-3" id="tabs">
                    <?php for($i=1;$i<=8;$i++){
                    $var1 = ${"date" . $i."1"}; $var2 = ${"dayapp".$i."1"}; ?>
                    <li class="nav-item"><a class="nav-link <? if($i==1){echo "active";} ?>" data-toggle="tab" href="#day1<?php echo $i; ?>"><?php echo date("d M",strtotime($var1)); ?> (<?php echo count($var2); ?>)</a></li>
                    <? } ?>
                    </ul>
                    <div class="tab-content">
                        <?php for($k=1;$k<=8;$k++){
                        $var1 = ${"date" . $k."1"}; $var2 = ${"dayapp".$k."1"}; ?>
                        <div id="day1<?php echo $k; ?>" class="tab-pane <? if($k==1){echo "active";} ?>">
                            <h6 class="mb-3"><?php echo date("d M",strtotime($var1)); ?> Agreement Expiry</h6>
                            <div class="table-responsive">
                                <table class="today example table table-bordered mb-0">
                                    <thead><tr><th>#</th><th>Agreement No</th><th>Client Name</th><th>Mobile No.</th><!--<th>Time</th><th>Charges</th><th>Payment</th><th>Status</th>--></tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($var2)){
                                    for($i=0;$i<count($var2);$i++){
                                    $user = selectQuery(WEB_USER,"*","u_id=".$var2[$i]['agree_by']); ?>
                                    <tr>
                                        <td><?php echo $i+1; ?></td>
                                        <td><a href="<?php echo ADMINURL; ?>agreement/agreementdetails.php?agr=<?php echo base64_encode($var2[$i]['agreement_no']); ?>" target="_blank"><?php echo $var2[$i]['agreement_no']; ?></a></td>
                                        <td><?php echo $user[0]['u_fname']." ".$user[0]['u_lname']; ?></td>
                                        <td><?php echo $user[0]['u_mobile']; ?></td>
                                        <!--<td><?php echo date("h:i a",strtotime($var2[$i]['biometric_appointement_date'])); ?></td>
                                        <td><i class="fa fa-inr"></i> <?php echo $var2[$i]['total_charges']; ?></td>-->
                                        <!--<td>
                                        <?php if($var2[$i]['payment_mode']==""){ ?>
                                        <span class="text-danger">NOT PROCEED</span>
                                        <? } else{
                                        echo $var2[$i]['payment_mode'];
                                        if($var2[$i]['isPaid']=="1"){ ?>
                                        <span class="text-success">(Paid)</span>
                                        <? } else{ ?>
                                        <span class="text-success">(Pending)</span>
                                        <? } } ?>
                                        </td>
                                        <td><?php echo $var2[$i]['agreement_status']; ?></td>-->
                                    </tr>
                                     <? }
                                    } else{ ?>
                                    <tr><td colspan="4" class="text-center">No Appointment Expiry</td></tr>
                                     <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php');?>
    </div>
</div>
<script src="<?php echo SITEURL; ?>/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script>
  $("#search").on("keyup", function() {
     
        var search = $("#search").val();
        var info = {search: search,action:"search"};
        $.ajax({
            type: "POST",url: "searchdata.php",data: info,
            success: function(response) {
                $(".searchresult").html(response);
                $("#hidedata").show();
            }
        });
    });
    $("#hidedata").click(function(){ $(".searchresult").html(""); });

 $('.example').DataTable(); 

  

</script>
</body>
</html>