<div class="addlandlordetails">
    <h4 class="mb-3">Client Details</h4>
    <div class="landlordlist"></div>
    <form class="landlordform inputBorder" method="POST">
    <div class="row">
        <div class="form-group row col-md-6 col-sm-6 mx-0">
            <label class="cc-mandatary-field">Mobile Number</label>
            <input type='text' name="mobno" class="form-control mobno" id='mobno' onkeyup="mobnumbercheck('mobno');" onblur="chkclient('mobno')" minlength="10" maxlength="10" placeholder="Mobile Number" />
        </div>
        <div class="form-group row col-md-6 col-sm-6 mx-0">
            <label class="cc-mandatary-field">First Name</label>
            <input type='hidden' name="uid" class="form-control uid" id='uid' />
            <input type='text' name="fname" class="form-control fname" id='fname' onkeyup="namechk('fname');" maxlength="15" placeholder="First Name" />
        </div>
        <div class="form-group row col-md-6 col-sm-6 mx-0">
            <label class="cc-mandatary-field">Last Name</label>
            <input type='text' name="lname" class="form-control lname" id='lname' onkeyup="namechk('lname');"  maxlength="15" placeholder="Last Name" />
        </div>
        <div class="form-group row col-md-6 col-sm-6 mx-0">
            <label>Email</label>
            <input type='text' name="emailid" class="form-control emailid" id='emailid' onblur="mailchk('emailid');" maxlength="70" placeholder="Email" />
        </div>
        <div class="form-group row col-12 mx-0">
            <label>Govt. Token No.</label>
            <input type='text' name="tokenno" class="form-control tokenno" id='tokenno' maxlength="70" placeholder="Govt. Token No." />
        </div>
        <div class="form-group row col-12 mx-0">
            <div class="custom-control custom-checkbox">
                <input type='checkbox' name="tempdata" class="tempdata custom-control-input" id='tempdata' onchange="storagechng('tempdata')">
                <label class="custom-control-label" for="tempdata">Want To Store In Temporary Storage ?</label>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 showtemp">
            <div class="form-group">
            <label>Any Other Info</label>
            <textarea class="summernote" id="editor1" name="text_details" rows="4"></textarea>
            </div>
        </div>
        <div class="savebtn showtemp col-12"><button class="btn btn-primary" type="button" onclick="storetempdata('<?php echo ADMINURL; ?>')">Save Temporary</button></div>
    </div>
    </form>
    <div class="newxt12btn text-right"><button class="btn btn-primary" type="button" onclick="chkclientdata()">Next</button></div>
</div>