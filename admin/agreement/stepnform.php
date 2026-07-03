<div class="addvitnessdetails mb-4">
    <h4 class="mb-3">Witness Details</h4>
    <div class="vitnesslist"></div>
    <form class="vitnessform mb-0" method="POST">
        <div class="row">
            <div class="form-group row col-md-6 col-sm-6 mx-0"> 
                <label>First Name</label>
                <input type='text' name="v_name" class="form-control v_name" id='v_name' onkeyup="namechk('v_name');showvalinput('v_name','vitness_name')" maxlength="15" placeholder="First Name" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label>Last Name</label>
                <input type='text' name="v_lname" class="form-control v_lname" id='v_lname' onkeyup="namechk('v_lname');showvalinput('v_lname','vitness_lname')" maxlength="15" placeholder="Last Name" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label>Email</label>
                <input type='text' name="v_emailid" class="form-control v_emailid" id='v_emailid' onblur="mailchk('v_emailid');showvalinput('v_emailid','vitness_email')" maxlength="70" placeholder="Email" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label>Mobile Number</label>
                <input type='text' name="v_mobno" class="form-control v_mobno" id='v_mobno' onkeyup="mobnumbercheck('v_mobno');" onblur="chkclient('v_mobno');  showvalinput('v_mobno','vitness_mbl')" minlength="10" maxlength="10" placeholder="Mobile Number" />
            </div>
            <div class="form-group row col-12 mx-0">
                <label>Vitness Detailed Permanent Postal Address </label>
                <textarea name="vitnessaddr" class="form-control vitnessaddr" id='vitnessaddr' maxlength="500"  onkeyup="showvalinput('vitnessaddr','vitness_address')"></textarea>
            </div>
        </div>     
    </form>   
    <div class="addnewbtnn mb-3"><button class="btn btn-primary" type="button" onclick="addnewvitness()">Add One More Vitness</button></div>
    <div class="newxt23btnn d-flex justify-content-between"><button class="btn btn-secondary" type="button" onclick="previousstepn('Stepn','Step2','agrmstep4','agrmstep3')">Previous</button> <button class="btn btn-primary" type="button" onclick="nextstep34n('Stepn','Step3','agrmstep4','agrmstep5')">Next</button>
    </div>
</div> 
<div class="editvitnessdetails cc-display-none">
    <h4 class="mb-3">Update Details</h4>
    <form class="updatevitnessform" method="POST">
        <div class="row">
            <div class="form-group row col-md-6 col-sm-6 mx-0">
            <label>First Name</label>
                <input type='hidden' name="updateclassnamev" class="form-control updateclassnamev" id='updateclassnamev' />
                <input type='text' name="editvitnessname" class="form-control editvitnessname" id='editvitnessname' onkeyup="namechk1('editvitnessname');" maxlength="50" placeholder="Vitness Name" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label>Last Name</label>
                <input type='text' name="editvitnesslastname" class="form-control editvitnesslastname" id='editvitnesslastname' onkeyup="namechk1('editvitnesslastname');" maxlength="50" placeholder="Vitness Last Name" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label>Email</label>
                <input type='text' name="editvitnessemail" class="form-control editvitnessemail" id='editvitnessemail' onblur="mailchk('editlandlord1email');" maxlength="50" placeholder="VitnessE Email" />
            </div>
            <div class="form-group row col-md-6 col-sm-6 mx-0">
                <label>Mobile</label>
                <input type='text' name="editvitnessmbl" class="form-control editvitnessmbl" id='editvitnessmbl' onkeyup="mobnumbercheck('editvitnessmbl');" maxlength="50" placeholder="Vitness Mobile" />
            </div>
            <div class="form-group row col-12 mx-0">
                <label>Adress</label>
                <textarea name="editvitnessadress" class="form-control editvitnessadress" id='editvitnessadress'  maxlength="500"></textarea>
            </div>
            <div class="col-md-12 col-sm-12"><button class="btn btn-primary" type="button" onclick="updatevitness('addnewbtnn','newxt23btnn')">Update</button> <button class="btn btn-secondary" type="button" onclick="cencelupdatevitness('editvitnessdetails','addnewbtnn','newxt23btnn')">Cancel</button></div>
        </div>
    </form> 
</div>
         
