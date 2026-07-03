<div class="addlandlordetails">
    <h4 class="mb-3">Landlord Details</h4>
    <div class="landlordlist pb-2"></div>
    <form class="landlordform mb-0" method="POST">
        <div class="row">
            <div class="form-group row mx-0 col-12">
                <label class="cc-mandatary-field">Landlord Name (As Per Aadhaar Card)</label>
                <input type='text' name="landlord1" class="form-control landlord1" id='landlord1' onkeyup="namechk1('landlord1');showvalinput('landlord1','name');" maxlength="50" placeholder="Landlord Name" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">Gender</label>
                <select class="form-control gender" onchange="showval('gender','gender')" id="gender"><option value="">Select Gender</option><option value="Male">Male</option><option value="Female">Female</option></select>
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">DOB</label>
                <input type="text" name="landlord1dob" placeholder="Date of Birth" class="form-control landlord1dob" id="datepicker">
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">Age</label>
                <input type='text' name="landlord1age" class="form-control landlord1age" id='landlord1age' onkeyup="numbercheck('landlord1age');showvalinput('landlord1age','age')" maxlength="2" placeholder="Age" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">Occupation</label>
                <select class="form-control occupation" id="occupation" onchange="showval('occupation','occupation')">
                    <option value="">Select Occupation</option>
                    <?php for($i=0;$i<count($occuarr);$i++){ ?>
                    <option value="<?php echo $occuarr[$i]; ?>"><?php echo $occuarr[$i]; ?></option>
                    <? } ?>
                </select>
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">Contact Number</label>
                <input type='text' name="landlord1contact" class="form-control landlord1contact" id='landlord1contact' onkeyup="mobnumbercheck('landlord1contact');showvalinput('landlord1contact','mobile')" minlength="10" maxlength="10" placeholder="Mobile Number" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">PAN Number</label>
                <input type='text' name="landlord1pan" class="form-control landlord1pan" id='landlord1pan' onkeyup="UpperCase('landlord1pan')" onblur="pan('landlord1pan');showvalinput('landlord1pan','pan')"   minlength="10" maxlength="10" placeholder="PAN Number" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">Aadhaar Number</label>
                <input type='text' name="landlord1addhar" class="form-control landlord1addhar" id='landlord1addhar' onkeyup="numbercheck('landlord1addhar');showvalinput('landlord1addhar','aadhaar')" minlength="12" maxlength="12" placeholder="Aadhaar Number" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label>Email</label>
                <input type='text' name="landlord1email" class="form-control landlord1email" id='landlord1email' onblur="mailchk('landlord1email');showvalinput('landlord1email','email')" maxlength="70" placeholder="Email" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">Pincode</label>
                <input type='text' name="landlord1pin" class="form-control landlord1pin" id='landlord1pin' onkeyup="numbercheck('landlord1pin');showvalinput('landlord1pin','pincode')" maxlength="6" placeholder="Pincode" />
            </div>
            <div class="form-group row col-12 mx-0">
                <label class="cc-mandatary-field">Landlord's Detailed Permanent Postal Address</label>
                <textarea name="landlord1addr" class="form-control landlord1addr" id='landlord1addr' onkeyup="showvalinput('landlord1addr','address')" maxlength="500"></textarea>
            </div>
        </div>
    </form>
    <div class="addnewbtn1"><button class="btn btn-primary" type="button" onclick="addnewlandlord()">Add One More Landlord</button></div>
    <div class="newxt12btn text-right"><button class="btn btn-primary" type="button" onclick="nextstep1('Step1','Step2','landlord','tenent','landlordlist','landlordform','agrmstep2','agrmstep3')">Next</button></div>
</div>
<div class="editlandlordetails mt-3 cc-display-none">
    <h4 class="mb-3">Update Details</h4>
    <form class="updatelandlordform inputBorder" method="POST">
        <div class="row">
            <div class="form-group row col-12 mx-0">
                <label class="cc-mandatary-field">Landlord Name (As Per Aadhaar Card)</label>
                <input type='hidden' name="updateclassname" class="form-control updateclassname" id='updateclassname' />
                <input type='text' name="editlandlordname" class="form-control editlandlordname" id='editlandlordname' onkeyup="namechk1('editlandlordname');" maxlength="50" placeholder="Landlord Name" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">Gender</label>
                <select class="form-control editgender"><option value="">Select Gender</option><option value="Male">Male</option><option value="Female">Female</option></select>
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">DOB</label>
                <input type="text" name="editlandlord1dob" placeholder="Date of Birth" class="form-control editlandlord1dob" id="datepicker">
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">Age</label>
                <input type='text' name="editlandlord1age" class="form-control editlandlord1age" id='editlandlord1age' maxlength="2" placeholder="Age" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0" >
                <label class="cc-mandatary-field">Occupation</label>
                <select class="form-control editoccupation">
                    <option value="">Select Occupation</option>
                    <?php for($i=0;$i<count($occuarr);$i++){ ?>
                    <option value="<?php echo $occuarr[$i]; ?>"><?php echo $occuarr[$i]; ?></option>
                    <? } ?>
                </select>
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">Contact Number</label>
                <input type='text' name="editlandlord1contact" class="form-control editlandlord1contact" id='editlandlord1contact' onkeyup="mobnumbercheck('editlandlord1contact');" minlength="10" maxlength="10" placeholder="Mobile Number" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">PAN Number</label>
                <input type='text' name="editlandlord1pan" class="form-control editlandlord1pan" id='editlandlord1pan' onkeyup="UpperCase('editlandlord1pan')" onblur="pan('editlandlord1pan');" minlength="10"  maxlength="10" placeholder="PAN Number" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">Aadhaar Number</label>
                <input type='text' name="editlandlord1addhar" class="form-control editlandlord1addhar" id='editlandlord1addhar' onkeyup="numbercheck('editlandlord1addhar');" minlength="12" maxlength="12" placeholder="Aadhaar Number" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">Email</label>
                <input type='text' name="editlandlord1email" class="form-control editlandlord1email" id='editlandlord1email' onblur="mailchk('editlandlord1email');" maxlength="70" placeholder="Email" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label class="cc-mandatary-field">Pincode</label>
                <input type='text' name="editlandlord1pin" class="form-control editlandlord1pin" id='editlandlord1pin' onkeyup="numbercheck('editlandlord1pin');" maxlength="6" placeholder="Pincode" />
            </div>
            <div class="form-group row col-12 mx-0">
                <label class="cc-mandatary-field">Landlord's Detailed Permanent Postal Address</label>
                <textarea name="editlandlord1addr" class="form-control editlandlord1addr" id='editlandlord1addr'  maxlength="500"></textarea>
            </div>
            <div class="col-md-12 col-sm-12 text-right"><button class="btn btn-primary" type="button" onclick="updatelandlord('addnewbtn1','newxt12btn')">Update</button> <button class="btn btn-secondary" type="button" onclick="cencelupdatelandlord('editlandlordetails','addnewbtn1','newxt12btn')">Cancel</button></div>
        </div>
    </form>
</div>
