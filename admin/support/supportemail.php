<?php include("../../includes/configuration.php"); $support = selectQuery(SUPPORTEMAIL,"*"); ?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> : Configuration</title>
    <?php include('../commoncss.php'); ?>
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php'); ?>
    <?php include('../cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="card mb-0">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title">Configuration</h2></div><div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                <div class="card-body pb-2">
                    <div class="msgs"></div>
                    <div class="row">
                        <div class="col-md-12 col-lg-3 col-xl-2 mb-2 mb-lg-0"><b>Department Isolation</b></div>
                        <div class="col-md-12 col-lg-9 col-xl-10">
                            <div class="custom-control custom-radio custom-control-inline"><input type="radio" name="dept_iso" id="detisoeneb" class="dept_iso custom-control-input" <? if($support[0]['department_issolation']==1){echo "checked";}else{} ?> value="1"/> <label class="custom-control-label" for="detisoeneb">Enable</label></div>
                            <div class="custom-control custom-radio custom-control-inline"><input type="radio" name="dept_iso" id="detisoedisneb" class="dept_iso custom-control-input" <? if($support[0]['department_issolation']==0){echo "checked";}else{} ?> value="0"/> <label class="custom-control-label" for="detisoedisneb">Disable</label></div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 col-lg-3 col-xl-2 mb-2 mb-lg-0"><b>New Ticket Alert</b></div>
                        <div class="col-md-12 col-lg-9 col-xl-10">
                            <div class="mb-2">
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" name="new_tkt" id="tickalrtenb" class="new_tkt custom-control-input" <? if($support[0]['new_tkt_alert']==1){echo "checked";}else{} ?> value="1"/> <label class="custom-control-label" for="tickalrtenb">Enable</label></div>
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" name="new_tkt" id="tickalrtdisenb" class="new_tkt custom-control-input" <? if($support[0]['new_tkt_alert']==0){echo "checked";}else{} ?> value="0"/> <label class="custom-control-label" for="tickalrtdisenb">Disable</label></div>
                            </div>
                            <div>
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="checkbox" name="new_tkt_alerts[]" id="tickalertclient" class="new_tkt_alerts custom-control-input" <? if($support[0]['new_tkt_alert_client']==1){echo "checked";}else{} ?> value="Client"/> <label class="custom-control-label" for="tickalertclient">Client</label></div>
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="checkbox" name="new_tkt_alerts[]" id="tickalertadmin" class="new_tkt_alerts custom-control-input" <? if($support[0]['new_tkt_alert_admin']==1){echo "checked";}else{} ?> value="Admin"/> <label class="custom-control-label" for="tickalertadmin">Admin</label></div>
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="checkbox" name="new_tkt_alerts[]" id="ticalertdetman" class="new_tkt_alerts custom-control-input" <? if($support[0]['new_tkt_alert_mgr']==1){echo "checked";}else{} ?> value="Manager"/> <label class="custom-control-label" for="ticalertdetman">Dept Manager</label></div>
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="checkbox" name="new_tkt_alerts[]" id="tickalertdifstaff" class="new_tkt_alerts custom-control-input" <? if($support[0]['new_tkt_alert_members']==1){echo "checked";}else{} ?> value="Staff"/> <label class="custom-control-label" for="tickalertdifstaff">Dept Staff</label></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 col-lg-3 col-xl-2 mb-2 mb-lg-0"><b>New Message Alert</b></div>
                        <div class="col-md-12 col-lg-9 col-xl-10">
                            <div class="mb-2">
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" name="new_msg" id="messalertenb" class="new_msg custom-control-input" <? if($support[0]['new_msg_alert']==1){echo "checked";}else{} ?> value="1"/> <label class="custom-control-label" for="messalertenb">Enable</label></div>
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" name="new_msg" id="messalertdisable" class="new_msg custom-control-input" <? if($support[0]['new_msg_alert']==0){echo "checked";}else{} ?> value="0"/> <label class="custom-control-label" for="messalertdisable">Disable</label></div>
                             </div>
                             <div>
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="checkbox" name="new_msg_alerts[]" id="messalertclient" class="new_msg_alerts custom-control-input" <? if($support[0]['new_msg_alert_client']==1){echo "checked";}else{} ?> value="Client"/> <label class="custom-control-label" for="messalertclient">Client</label></div>
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="checkbox" name="new_msg_alerts[]" id="messalertadmin" class="new_msg_alerts custom-control-input" <? if($support[0]['new_msg_alert_admin']==1){echo "checked";}else{} ?> value="Admin"/> <label class="custom-control-label" for="messalertadmin">Admin</label></div>
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="checkbox" name="new_msg_alerts[]" id="messalertdetmanager" class="new_msg_alerts custom-control-input" <? if($support[0]['new_msg_alert_mgr']==1){echo "checked";}else{} ?> value="Manager"/> <label class="custom-control-label" for="messalertdetmanager">Dept Manager</label></div>
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="checkbox" name="new_msg_alerts[]" id="messalertres" class="new_msg_alerts custom-control-input" <? if($support[0]['new_msg_alert_respondent']==1){echo "checked";}else{} ?> value="Respondent"/> <label class="custom-control-label" for="messalertres">Respondent</label></div>
                             </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 col-lg-3 col-xl-2 mb-2 mb-lg-0"><b>Overdue Ticket Alert</b></div>
                        <div class="col-md-12 col-lg-9 col-xl-10">
                            <div class="mb-2">
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" name="overdue_tkt" id="overtickkalertemb" class="overdue_tkt custom-control-input" <? if($support[0]['overdue_tkt']==1){echo "checked";}else{} ?> value="1"/> <label class="custom-control-label" for="overtickkalertemb">Enable</label></div>
                                <div class="custom-control custom-radio custom-control-inline"><input type="radio" name="overdue_tkt" id="overtickkalertdisable" class="overdue_tkt custom-control-input" <? if($support[0]['overdue_tkt']==0){echo "checked";}else{} ?> value="0"/> <label class="custom-control-label" for="overtickkalertdisable">Disable</label></div>
                             </div>
                             <div>
                                 <div class="custom-control custom-radio custom-control-inline"><input type="checkbox" name="overdue_alerts[]" id="tickalertadmin" class="overdue_alerts custom-control-input" <? if($support[0]['overdue_tkt_admin']==1){echo "checked";}else{} ?> value="Admin"/> <label class="custom-control-label" for="tickalertadmin">Admin</label></div>
                                  <div class="custom-control custom-radio custom-control-inline"><input type="checkbox" name="overdue_alerts[]" id="tickalertdetmanager" class="overdue_alerts custom-control-input" <? if($support[0]['overdue_tkt_mgr']==1){echo "checked";}else{} ?> value="Manager"/> <label class="custom-control-label" for="tickalertdetmanager">Dept Manager</label></div>
                                  <div class="custom-control custom-radio custom-control-inline"><input type="checkbox" name="overdue_alerts[]" id="ticalertdetstaff" class="overdue_alerts custom-control-input" <? if($support[0]['overdue_tkt_staff']==1){echo "checked";}else{} ?> value="Staff"/> <label class="custom-control-label" for="ticalertdetstaff">Dept Staff</label></div>
                             </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row pb-3">
                        <div class="col-md-12 col-lg-3 col-xl-2 mb-2 mb-lg-0"><b>Allowed Attachment File Format & size</b></div>
                        <div class="col-md-12 col-lg-9 col-xl-10">
                            <div class="mb-3">
                                <h6 class="mb-3"><b>Attachment Max Size</b></h6>
                                <div class="row">
                                    <div class="input-group col-md-5 col-lg-3">
                                        <input type="text" name="maxsize" class="form-control" id="maxsize" maxlength="1" onkeyup="numbercheck('maxsize')" value="<?php echo ($support[0]['attachment_size']/1024)/1024; ?>"/> <div class="input-group-append"><span class="input-group-text">MB</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h6 class="mb-2"><b>Image File Format</b></h6>
                                <?php for($m=0;$m<sizeOf($imgtypes);$m++){ ?>
                                <div class="custom-control custom-checkbox custom-control-inline"><input type="checkbox" name="img_format[]" id="imgformat<?php echo $imgtypes[$m]; ?>" class="img_format custom-control-input" value="<?php echo $imgtypes[$m]; ?>" <? if (strpos($support[0]['img_types'], $imgtypes[$m]) !== false) {echo 'checked';}else{} ?>/> <label class="custom-control-label" for="imgformat<?php echo $imgtypes[$m]; ?>"><?php echo $imgtypes[$m]; ?></label></div>
                                <? } ?>
                            </div>
                            <div>
                                <h6 class="mb-3"><b>Application File Format </b></h6>
                                <div>
                                    <?php for($m=0;$m<sizeOf($applicationtype);$m++){ ?>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="application_format[]" id="fileformat<?php echo $applicationtype[$m]; ?>" class="application_format custom-control-input"  value="<?php echo $applicationtype[$m]; ?>" <? if (strpos($support[0]['application_types'], $applicationtype[$m]) !== false) {echo 'checked';}else{} ?>/> <label class="custom-control-label" for="fileformat<?php echo $applicationtype[$m]; ?>"><?php echo $applicationtype[$m]; ?></label>
                                    </div>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row border-top">
                        <div class="col-md-12 pt-2 text-right"><button type="button" class="btn btn-primary" id="updatedata" onclick="updatedate()">Update</button></div>
                    </div>
                    <table class="table example mb-0">
                        <!--<tr><td class="heading">New Ticket Sequence</td>
                        <td><div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="radio" name="new_tkt_sequence" class="new_tkt_sequence" <? if($support[0]['new_tkt_sequence']=="Sequentially"){echo "checked";}else{} ?> value="Sequentially"/> Sequentially
                        <input type="radio" name="new_tkt_sequence" class="new_tkt_sequence" <? if($support[0]['new_tkt_sequence']=="Randomly"){echo "checked";}else{} ?> value="Randomly"/> Randomly
                        </div></td></tr>-->
                    </table>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
    </div>
</div>
<script>
function numbercheck(id){
    var entered = $("#"+id).val();
    if(isNaN(entered)){ $("#"+id).val(""); }
    else{ }
}
function updatedate(){
    var dept_iso = $(".dept_iso:checked").val(); var new_tkt = $(".new_tkt:checked").val(); var new_msg = $(".new_msg:checked").val(); var overdue_tkt = $(".overdue_tkt:checked").val(); var new_tkt_alerts1 = new Array();
    $(".new_tkt_alerts:checked").each(function(){ new_tkt_alerts1.push($(this).val()); });
    var new_tkt_alerts=new_tkt_alerts1.toString();
    var new_msg_alerts1=new Array();
    $(".new_msg_alerts:checked").each(function(){ new_msg_alerts1.push($(this).val()); });
    var new_msg_alerts=new_msg_alerts1.toString();
    var overdue_alerts1=new Array();
    $(".overdue_alerts:checked").each(function(){ overdue_alerts1.push($(this).val()); });
    var overdue_alerts=overdue_alerts1.toString();
    var attachmax = $("#maxsize").val();
    var imgallowedarr = new Array();
    var appallowedarr = new Array();
    $(".img_format:checked").each(function(){ imgallowedarr.push($(this).val()); });
    $(".application_format:checked").each(function(){ appallowedarr.push($(this).val()); });
    var imgallowed = imgallowedarr.toString();
    var appallowed = appallowedarr.toString();
    var info = { dept_iso:dept_iso, new_tkt:new_tkt, new_msg:new_msg, overdue_tkt:overdue_tkt, new_tkt_alerts:new_tkt_alerts, new_msg_alerts:new_msg_alerts, overdue_alerts:overdue_alerts, imgallowed:imgallowed, appallowed:appallowed, attachmax:attachmax };
    $.ajax({ type:"POST", url:"updateemailsetting.php", data:info,
        success:function(msg){
            if(msg==1){ $('.msgs').fadeIn().addClass("alert alert-success").html("Updatede Successfully").delay(5000).fadeOut(); setTimeout(function() { window.location=window.location;},3000); }
        }
    });
}
</script>
</body>
</html>