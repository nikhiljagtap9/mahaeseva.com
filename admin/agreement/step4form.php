 <h4 class="mb-3"><b>Agreed Terms & Conditions</b></h4>
<form class="propertyform inputBorder" method="POST">
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Total duration(in months)</label>
                <input type='text' name="duration" class="form-control duration" id='duration' onkeyup="numbercheck('duration');othershowvalinput('duration','durationshow')" maxlength="2" onblur="changedate('duration','startdate')"/>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Starting From</label>
                <input type='text' class="form-control startdate" id='startdate'/>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Deposite</label>
                <!--<input type="hidden" class="entryby" value="<?php echo $_SESSION['reguser']; ?>">-->
                <input type='text' name="deposite" class="form-control deposite" id='deposite' onkeyup="numbercheck('deposite');othershowvalinput('deposite','depositeshow')"  maxlength="6"/>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Rent Type</label>
                <div class="py-2">
                <input type='radio' name="renttype" class="renttype" onchange="showrent('fixed','fixedrentdiv','variable','variablerentdiv')" value="Fixed" checked> Fixed
                <input type='radio' name="renttype" class="renttype"  onchange="showrent('variable','variablerentdiv','fixed','fixedrentdiv')" value="Variable"> Variable</div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 fixedrentdiv">
            <div class="form-group">
                <label class="cc-mandatary-field">Rent</label>
                <input type='text' name="fixedrent" class="form-control fixedrent" id='fixedrent' onkeyup="checkabovedata();numbercheck('fixedrent');othershowvalinput('fixedrent','fixedrentshow');"   maxlength="6"/>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 variablerentdiv form-group cc-display-none">
            <div class="form-group">
                <label class="cc-mandatary-field mb-0">Rent</label>
                <!-- <button type="button" class="btn btn-danger btn-sm pull-right resetbtn" onclick="resetvartab('vartable','monthto1','varrent1','varrentshow','varrentshow1','varrentmonthshow1')">Reset</button> -->
            </div>
            <table class="vartable table table-bordered">
                <thead><tr><th>From (Month No.)</th><th>To (Month No.)</th><th>Rent</th></tr></thead>
                <tbody>
                <tr class="varrow1" data-id="1" id="current">
                <td><input type='text' name="monthfrom1" class="form-control monthfrom1" id='monthfrom1' onkeyup="numbercheck('monthfrom1');" maxlength="1" disabled value="1"/>  </td>
                <td> <input type='text' name="monthto1" class="form-control monthto1" id='monthto1' onkeyup="numbercheck('monthto1')" onblur="addtr('monthto1','monthfrom1','varrow1','vartable','varrentdetails1','varrentmonthshow1','varrent1')" maxlength="2"/>  </td>
                <!--  <td> <input type='text' name="varrent1" class="form-control varrent1" id='varrent1' onkeyup="numbercheck('varrent1');chkprev('monthto1','varrent1','varrentshow1');othershowvalinput('varrent1','varrentshow1')" onblur="disableinp('varrent1');"  maxlength="6"/>  </td>            -->
                <td> <input type='text' name="varrent1" class="form-control varrent1" id='varrent1' onkeyup="numbercheck('varrent1');chkprev('monthto1','varrent1','varrentshow1');othershowvalinput('varrent1','varrentshow1')" maxlength="6"/>  </td>
                </tr>
                </tbody>
            </table>
        </div>
       <!-- <div class="col-md-12">
            <div class="row">
                <div class="col-12">
                    <div class="form-group"><input type='checkbox' name="extravisit" class="extravisit" id='extravisitdsdsds' value="1"> Extra Visit Required (Landlord and Tenant staying at different place) ?</div>
                </div>
                <div class="col-12">
                    <div class="form-group"><input type='checkbox' name="policeintimation" class="policeintimation" id='policeintimationsdsd' value="1"> Police Inimation Required ?</div>
                </div>
            </div>
        </div> -->
        <div class="col-md-12 col-sm-12 "><button type="button" class="btn btn-success btn-sm calcbtn" onclick="calculatechrges()">Calculate Charges</button> <button type="button" class="btn btn-danger btn-sm pull-right resetbtn" onclick="resetvartab('vartable','monthto1','varrent1','varrentshow','varrentshow1','varrentmonthshow1')">Reset</button> </div>
    </div>
    <div class="row calc mt-4">
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
            <label class="cc-mandatary-field">Reg Fee</label>
            <input type='text' name="regfee" class="form-control regfee" id='regfee' readonly maxlength="6"/>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Stamp Duty</label>
                <input type='text' name="stamp" class="form-control stamp" id='stamp' readonly maxlength="6"/>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Service Charges</label>
                <input type='text' name="service" class="form-control service" id='service' value="<?php echo SERVICECHRG; ?>" readonly maxlength="6"/>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Visit Charges</label>
                <input type='text' name="visit_charge" class="form-control visit_charge" id='visit_charge' value="<?php echo VISITCHRG; ?>" readonly maxlength="6"/>
            </div>
        </div>
    <!--   <div class="col-md-6 col-sm-6 xtravisitbox">
            <div class="form-group">
                <label class="cc-mandatary-field">Extra Visit Charges</label>
                <input type='text' name="xtra_visit_charge" class="form-control xtra_visit_charge" id='xtra_visit_charge' value="<?php echo XTRAVISITCHRG; ?>" readonly  maxlength="6"/>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 policebox">
            <div class="form-group">
            <label class="cc-mandatary-field">Police Intimation Charges</label>
            <input type='text' name="police_charge" class="form-control police_charge" id='police_charge' value="<?php echo POLICECHRG; ?>" readonly maxlength="6"/>
            </div>
        </div> -->
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">DHC</label>
                <input type='text' name="dhc" class="form-control dhc" id='dhc' value="<?php echo DHC; ?>" readonly maxlength="6"/>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Total Charges</label>
                <input type='text' name="total" class="form-control total" id='total' readonly maxlength="6"/>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <label>Miscellaneous</label>
                <input type='text' name="misc" class="form-control misc" id='misc' maxlength="1000" onkeyup="othershowvalinput('misc','miscshow')"/>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 newxt23btn"> <input type="hidden" class="loaderimg" value="<?php echo LOADER; ?>"> <button class="btn btn-secondary prev3" type="button" onclick="previousstep3('Step4','Step3','agrmstep6','agrmstep5')">Previous</button> 
        <button class="btn btn-primary" type="button" onclick="nextstep45('Step4','Step5','agrmstep6','agrmstep7')">Next</button>
      <!--  <button class="btn btn-primary  submit" type="button" onclick="finalproceed('<?php echo ADMINURL; ?>')">Proceed Next</button> -->
        
    </div>
    </div>
</form>