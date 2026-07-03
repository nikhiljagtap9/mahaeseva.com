<div class="section-title mr-20"><h4 class="mb-3 fw-6">Agreed Terms & Conditions</h4></div>
<form class="propertyform inputBorder" method="POST">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 pr-sm-0">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Total duration(in months)</label>
                <input type='text' name="duration" class="form-control duration" id='duration' onkeyup="numbercheck('duration');othershowvalinput('duration','durationshow')" maxlength="2" onblur="changedate('duration','startdate')"/>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 pr-0 pr-sm-3">
            <div class="form-group mb-2">
                <label>Starting From</label>
                <input type='text' class="form-control startdate" id='startdate'/>
            </div>
        </div>
        <div class="col-6 col-md-6 pr-sm-0">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Deposite</label>
                <input type="hidden" class="entryby" value="<?php echo $_SESSION['reguser']; ?>">
                <input type='text' name="deposite" class="form-control deposite" id='deposite' onkeyup="numbercheck('deposite');othershowvalinput('deposite','depositeshow')" maxlength="6"/>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Rent Type</label>
                <div class="py-2">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type='radio' name="renttype" class="renttype custom-control-input" onchange="showrent('fixed','fixedrentdiv','variable','variablerentdiv')" value="Fixed" checked id="renttypefixed"><label class="custom-control-label" for="renttypefixed">Fixed</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type='radio' name="renttype" class="renttype custom-control-input" onchange="showrent('variable','variablerentdiv','fixed','fixedrentdiv')" value="Variable" id="renttypeariable"><label class="custom-control-label" for="renttypeariable">Variable</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-6 fixedrentdiv">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Rent</label>
                <input type='text' name="fixedrent" class="form-control fixedrent" id='fixedrent' onkeyup="checkabovedata();numbercheck('fixedrent');othershowvalinput('fixedrent','fixedrentshow');"   maxlength="6"/>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 variablerentdiv form-group mb-2">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Rent</label>
                <!--<button type="button" class="btn btn-danger btn-sm pull-right resetbtn" onclick="resetvartab('vartable','monthto1','varrent1','varrentshow','varrentshow1','varrentmonthshow1')">Reset</button>-->
            </div>
            <table class="vartable table table-bordered bg-white">
                <thead><tr><th>From (Month No.)</th><th>To (Month No.)</th><th>Rent</th></tr></thead>
                <tbody>
                    <tr class="varrow1" data-id="1" id="current">
                    <td><input type='text' name="monthfrom1" class="form-control monthfrom1" id='monthfrom1' onkeyup="numbercheck('monthfrom1');" maxlength="1" disabled value="1"/></td>
                    <td><input type='text' name="monthto1" class="form-control monthto1" id='monthto1' onkeyup="numbercheck('monthto1')" onblur="addtr('monthto1','monthfrom1','varrow1','vartable','varrentdetails1','varrentmonthshow1','varrent1')" maxlength="2"/></td>
                    <!--<td><input type='text' name="varrent1" class="form-control varrent1" id='varrent1' onkeyup="numbercheck('varrent1');chkprev('monthto1','varrent1','varrentshow1');othershowvalinput('varrent1','varrentshow1')" onblur="disableinp('varrent1');"  maxlength="6"/></td>-->
                    <td><input type='text' name="varrent1" class="form-control varrent1" id='varrent1' onkeyup="numbercheck('varrent1');chkprev('monthto1','varrent1','varrentshow1');othershowvalinput('varrent1','varrentshow1')" maxlength="6"/></td>
                    </tr>
                </tbody>
            </table>
        </div>
      <!--  <div class="row mx-0">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type='checkbox' name="extravisit" class="custom-control-input extravisit" id='extravisit' value="1">
                        <label class="custom-control-label" for="extravisit">Extra Visit (Landlord and Tenant staying at different place) ?</label>
                    </div> 
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type='checkbox' name="policeintimation" class="custom-control-input policeintimation" id='policeintimation' value="1">
                        <label class="custom-control-label" for="policeintimation">Police Inimation Required ?</label>
                    </div> 
                </div>
            </div>
        </div> -->
        <div class="col-12 mb-3"><button type="button" class="btn btn-primary btn-sm px-3 calcbtn" onclick="calculatechrges()">Calculate Charges</button> <button type="button" class="btn btn-dark btn-sm px-3 resetbtn" onclick="resetvartab('vartable','monthto1','varrent1','varrentshow','varrentshow1','varrentmonthshow1')">Reset</button></div>
        <div class="col-md-12 calc">
            <div class="calculateRent">
                <div class="row">
                    <div class="col-6 col-sm-4 col-md-6 pr-0">
                        <div class="form-group mb-2">
                            <label class="cc-mandatary-field">Reg Fee</label>
                            <input type='text' name="regfee" class="form-control regfee" id='regfee' readonly  maxlength="6"/>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-md-6">
                        <div class="form-group mb-2">
                            <label class="cc-mandatary-field">Stamp Duty</label>
                            <input type='text' name="stamp" class="form-control stamp" id='stamp' readonly  maxlength="6"/>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-md-6 pr-0">
                        <div class="form-group mb-2">
                            <label class="cc-mandatary-field">Service Charges</label>
                            <input type='text' name="service" class="form-control service" id='service' value="<?php echo SERVICECHRG; ?>" readonly maxlength="6"/>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-md-6">
                        <div class="form-group mb-2">
                            <label class="cc-mandatary-field">Visit Charges</label>
                            <input type='text' name="visit_charge" class="form-control visit_charge" id='visit_charge' value="<?php echo VISITCHRG; ?>" readonly  maxlength="6"/>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-md-6 pr-0 xtravisitbox">
                        <div class="form-group mb-2">
                            <label class="cc-mandatary-field">Extra Visit Charges</label>
                            <input type='text' name="xtra_visit_charge" class="form-control xtra_visit_charge" id='xtra_visit_charge' value="<?php echo XTRAVISITCHRG; ?>" readonly  maxlength="6"/>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-md-6 policebox">
                        <div class="form-group mb-2">
                            <label class="cc-mandatary-field">Police Intimation Charges</label>
                            <input type='text' name="police_charge" class="form-control police_charge" id='police_charge' value="<?php echo POLICECHRG; ?>" readonly  maxlength="6"/>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-md-6 ">
                        <div class="form-group mb-2">
                            <label class="cc-mandatary-field">DHC</label>
                            <input type='text' name="dhc" class="form-control dhc" id='dhc' value="<?php echo DHC; ?>" readonly  maxlength="6"/>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group mb-2">
                            <label class="cc-mandatary-field">Total Charges</label>
                            <input type='text' name="total" class="form-control total" id='total' readonly  maxlength="6"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Miscellaneous</label>
                        <input type='textarea' name="misc" class="form-control misc" id='misc' onkeyup="othershowvalinput('misc','miscshow')" maxlength="1000"/>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 newxt23btn d-flex justify-content-between">
                    <input type="hidden" class="loaderimg" value="<?php echo LOADER; ?>">
                    <button class="btn btn-dark px-3 btn-sm prev3" type="button" onclick="previousstep3('Step4','Step3','pill4','pill3')">Previous</button>
                    <button class="btn btn-primary" type="button" onclick="nextstep45('Step4','Step5','pill4','pill5')">Next</button>
                    <!--<button class="btn btn-primary px-3 btn-sm submit" type="button" onclick="finalproceed('<?php echo SITEURL; ?>')">Proceed Next</button> -->
                </div>
            </div>
        </div>
    </div>
</form>