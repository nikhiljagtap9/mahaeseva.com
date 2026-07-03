<div class="section-title mr-20"><h4 class="mb-3 fw-6">Tenant Details</h4></div>
<div class="tenentlist"></div>
<form class="tenentform inputBorder" method="POST">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-2">
                <label for="land1" class="cc-mandatary-field">Tenant Name (As Per Aadhaar Card)</label>
                <input type='text' name="tenent1" class="form-control tenent1" id='tenent1' onkeyup="namechk1('tenent1');showvalinput('tenent1','name');" maxlength="50" placeholder="Tenent Name" />
            </div>
        </div>
        <div class="col-6 col-md-6 pr-0">
            <div class="form-group mb-2">
                <label for="gender" class="cc-mandatary-field">Gender</label>
                <select class="form-control tenentgender" onchange="showval('tenentgender','gender')"><option value="">Select Gender</option><option value="Male">Male</option><option value="Female">Female</option></select>
            </div>
        </div>
        <div class="form-group row col-md-6 col-sm-6 mx-0">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">DOB</label>
                <input type="text" name="tenent1dob" placeholder="Date of Birth" class="form-control tenent1dob" id="datepicker1">
            </div>
        </div>
        <div class="col-6 col-md-6">
            <div class="form-group mb-2">
                <label for="landlord1age" class="cc-mandatary-field">Age</label>
                <input type='text' name="tenent1age"  class="form-control tenent1age" id='tenent1age' onkeyup="numbercheck('tenent1age');showvalinput('tenent1age','age')" maxlength="2" placeholder="Age" />
            </div>
        </div>
        <div class="col-6 col-md-6 pr-0">
            <div class="form-group mb-2">
                <label for="Occupation" class="cc-mandatary-field">Occupation</label>
                <select class="form-control tenentoccupation" onchange="showval('tenentoccupation','occupation')">
                    <option value="">Select Occupation</option>
                    <?php for($i=0;$i<count($occuarr);$i++){ ?>
                    <option value="<?php echo $occuarr[$i]; ?>"><?php echo $occuarr[$i]; ?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-6 col-md-6">
            <div class="form-group mb-2">
                <label for="landlord1age" class="cc-mandatary-field">Contact Number</label>
                <input type='text' name="tenent1contact" class="form-control tenent1contact" id='tenent1contact' onkeyup="mobnumbercheck('tenent1contact');showvalinput('tenent1contact','mobile')" minlength="10" maxlength="10" placeholder="Mobile Number" />
            </div>
        </div>
        <div class="col-6 col-md-6 pr-0">
            <div class="form-group mb-2">
                <label for="landlord1age" class="cc-mandatary-field">PAN Number</label>
                <input type='text' name="tenent1pan" class="form-control tenent1pan" id='tenent1pan' onkeyup="UpperCase('tenent1pan')" onblur="pan('tenent1pan');showvalinput('tenent1pan','pan')" minlength="10" maxlength="10" placeholder="PAN Number" />
            </div>
        </div>
        <div class="col-6 col-md-6">
            <div class="form-group mb-2">
                <label for="landlord1age" class="cc-mandatary-field">Aadhaar Number</label>
                <input type='text' name="tenent1addhar" class="form-control tenent1addhar" id='tenent1addhar' onkeyup="numbercheck('tenent1addhar');showvalinput('tenent1addhar','aadhaar')" minlength="12" maxlength="12" placeholder="Aadhaar Number" />
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group mb-2">
                <label for="landlord1age">Email</label>
                <input type='text' name="tenent1email" class="form-control tenent1email" id='tenent1email' onblur="mailchk('tenent1email');showvalinput('tenent1email','email')" maxlength="70" placeholder="Email" />
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group mb-2">
                <label for="landlord1age" class="cc-mandatary-field">Tenant's Detailed Permanent Postal Address</label>
                <textarea name="tenent1addr" class="form-control tenent1addr" id='tenent1addr' onkeyup="showvalinput('tenent1addr','address')" maxlength="500"></textarea>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label for="landlord1age" class="cc-mandatary-field">Pincode</label>
                <input type='text' name="tenent1pin" class="form-control tenent1pin" id='tenent1pin' onkeyup="numbercheck('tenent1pin');showvalinput('tenent1pin','pincode')" maxlength="6" placeholder="Pincode" />
            </div>
        </div>
    </div>
</form>
<div class="addnewbtn2 form-group mb-3"><button class="btn btn-primary btn-sm" onclick="addnewtenent()">Add One More Tenant</button></div>
<div class="newxt23btn d-flex justify-content-between"><button class="btn btn-dark btn-sm px-3" type="button" onclick="previousstep1('Step2','Step1','pill2','pill1')">Previous</button> <button class="btn btn-primary btn-sm px-3" type="button" onclick="nextstep23('Step2','Step3','tenent','tenent','tenentlist','tenentform','pill2','pill3')">Next</button></div>
<div class="edittenentdetails pt-2">
     <div class="col-md-12"><h4>Update Details</h4></div>
     <form class="updatelandlordform" method="POST">
        <div class="col-md-12">
            <div class="form-group mb-2">
                <label for="land1" class="cc-mandatary-field">Tenant Name (As Per Aadhaar Card)</label>
                <input type='hidden' name="updateclassname1" class="form-control updateclassname1" id='updateclassname1' />
                <input type='text' name="edittenent1" class="form-control edittenent1" id='edittenent1' onkeyup="namechk1('edittenent1');" maxlength="50" placeholder="Tenent Name" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6 pr-0">
            <div class="form-group mb-2">
                <label for="gender" class="cc-mandatary-field">Gender</label>
                <select class="form-control edittenentgender"><option value="">Select Gender</option><option value="Male">Male</option><option value="Female">Female</option></select>
            </div>
        </div>
        <div class="form-group row col-md-6 col-sm-6 mx-0">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">DOB</label>
                <input type="text" name="edittenent1dob" placeholder="Date of Birth" class="form-control edittenent1dob" id="datepicker1">
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group mb-2">
                <label for="landlord1age" class="cc-mandatary-field">Age</label>
                <input type='text' name="edittenent1age" class="form-control edittenent1age" id='edittenent1age' onkeyup="numbercheck('edittenent1age');" maxlength="2" placeholder="Age" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6 pr-0">
            <div class="form-group mb-2">
                <label for="Occupation" class="cc-mandatary-field">Occupation</label>
                <select class="form-control edittenentoccupation">
                    <option value="">Select Occupation</option>
                    <?php for($i=0;$i<count($occuarr);$i++){ ?>
                    <option value="<?php echo $occuarr[$i]; ?>"><?php echo $occuarr[$i]; ?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group mb-2">
                <label for="landlord1age" class="cc-mandatary-field">Contact Number</label>
                <input type='text' name="edittenent1contact" class="form-control edittenent1contact" id='vtenent1contact' onkeyup="editmobnumbercheck('tenent1contact');" minlength="10" maxlength="10" placeholder="Mobile Number" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6 pr-0">
            <div class="form-group mb-2">
                <label for="landlord1age" class="cc-mandatary-field">PAN Number</label>
                <input type='text' name="edittenent1pan" class="form-control edittenent1pan" id='edittenent1pan' onkeyup="UpperCase('edittenent1pan')" onblur="pan('edittenent1pan');" minlength="10"  maxlength="10" placeholder="PAN Number" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group mb-2">
                <label for="landlord1age" class="cc-mandatary-field">Aadhaar Number</label>
                <input type='text' name="edittenent1addhar" class="form-control edittenent1addhar" id='edittenent1addhar' onkeyup="numbercheck('edittenent1addhar');" minlength="12" maxlength="12" placeholder="Aadhaar Number" />
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group mb-2">
                <label for="landlord1age">Email</label>
                <input type='text' name="edittenent1email" class="form-control edittenent1email" id='edittenent1email' onblur="mailchk('edittenent1email');" maxlength="70" placeholder="Email" />
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group mb-2">
                <label for="landlord1age" class="cc-mandatary-field">Tenant's Detailed Permanent Postal Address</label>
                <textarea name="edittenent1addr" class="form-control edittenent1addr" id='edittenent1addr' maxlength="500"></textarea>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group mb-2">
                <label for="landlord1age" class="cc-mandatary-field">Pincode</label>
                <input type='text' name="edittenent1pin" class="form-control edittenent1pin" id='edittenent1pin'  maxlength="6" placeholder="Pincode" />
            </div>
        </div>
        <div class="col-12"><button class="btn btn-primary btn-sm" type="button" onclick="updatetenent('addnewbtn2','newxt23btn')">Update</button> <button class="btn btn-dark btn-sm" type="button" onclick="cencelupdatetenent('edittenentdetails','addnewbtn2','newxt23btn')">Cancel</button></div>
    </form>
</div>