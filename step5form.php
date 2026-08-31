<div class="section-title mr-20"><h4 class="mb-3 fw-6">Additional Services</h4></div>

<div class="col-md-12 pt-2 pl-0" style="display:none">
    <div class="row">
        <div class="col-12">
            <div class="form-group"><input type='checkbox' name="policeintimation" class="policeintimation" id='policeintimation' value="1" checked> Police Inimation Required ?</div>
        </div>
        <div class="col-12">
            <div class="form-group"><input type='checkbox' name="extravisit" class="extravisit" id='extravisit' value="1" checked> Extra Visit Required (Landlord and Tenant staying at different place) ?</div>
        </div>
    </div>
</div>
<form id="additionalServicesForm" class="form-horizontal">
    <!-- Additional Services Section -->
    <div class="row">   
        <div class="col-md-12 col-sm-12 policeblock" style="display:none">
            <div class="toggle-header">
                Police Intimation Required?
                <span class="toggle-icon fa fa-plus"></span>
            </div>
            <div class="toggle-content">
                <div class="form-group col-md-12 col-sm-12">
                    <label class="control-label"><b>Select a Package:</b></label>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="package-card card p-3 text-center selected-package" data-value="0">
                                <input type="checkbox" class="package-check"  disabled checked>
                                <label for="package1">
                                    <strong><del>₹300</del> ₹0 </strong>
                                    <p>Police Intimation (Provided Free)</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="policeintimation">
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 biometric" style="display:none">
            <div class="toggle-header">
                Select Biometric Appointment Type
                <span class="toggle-icon fa fa-plus"></span>
            </div>
            <div class="toggle-content">
                <div class="col-12">
                    <input type="radio" name="biometric" value="same_place" id="same_place" checked>
                    <label for="same_place">Landlord and tenant are present at the same location for the biometric appointment.</label>
                </div>
                <div class="col-12">
                    <input type="radio" name="biometric" value="different_place" id="different_place">
                    <label for="different_place">Landlord and tenant are present at different locations for the biometric appointment.</label>
                </div>

              <!-- Package Selection -->
                <div class="form-group col-md-12 col-sm-12" id="packageSection">
                    <label class="control-label"><b>Select a Package:</b></label>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="package-card card p-3 text-center blurred" data-value="301">
                              <!--  <input type="checkbox" class="package-check" id="package1">  -->
                               <!-- <h6>Same City</h6>
                                <p>Both parties in the same city</p>
                                <strong>₹301</strong> -->
                                <input type="checkbox" class="package-check" id="package1">
                                <label for="package1">
                                    <strong>₹301/-</strong>
                                    <p>Both parties are located at different places within the same city.</p>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="package-card card p-3 text-center blurred" data-value="693">
                            <!--    <h6>In Maharashtra</h6>
                                <p>One party in property city, other in Maharashtra</p>
                                <strong>₹693</strong> -->
                                <input type="checkbox" class="package-check" id="package2">
                                <label for="package2">
                                    <strong>₹693/-</strong>
                                    <p>One party is located in the property city, while the other is located within the state of Maharashtra.</p>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="package-card card p-3 text-center blurred" data-value="1889">
                              <!-- <h6>Outside Maharashtra</h6>
                                <p>One party in property city, other outside Maharashtra but in India</p>
                                <strong>₹1889</strong>-->
                                <input type="checkbox" class="package-check" id="package3">
                                <label for="package3">
                                    <strong>1889/-</strong>
                                    <p>One party is located in the property city, while the other is located in another state within India.</p>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="package-card card p-3 text-center blurred" data-value="3000">
                              <!-- <h6>International</h6>
                                <p>One party in property city, other outside India</p>
                                <strong>Contact for Price</strong> -->
                                <input type="checkbox" class="package-check" id="package4">
                                <label for="package4">
                                    <strong>3000/-</strong>
                                    <p>One party is located in the property city, while the other is located outside India.</p>
                                </label> 
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="packageSelect">
                </div>

                <div class="col-12" id="partytype">
                    <div class="form-group mb-2">
                        <label for="Parties" class="cc-mandatary-field">Please Select the Party for extra visit</label>
                        <select class="form-control partytype blurred">
                            <option value="">Select</option>
                            <option value="landlord">Landlord</option>
                            <option value="tenant">Tenant</option></select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Extra Visit Cost -->
        <div class="form-group row" id="extraVisit1111" style="display:none">
            <label class="col-sm-6 col-md-6 col-lg-6 control-label"><b>Extra Visit Cost:</b></label>
            <div class="alert alert-info">
                ₹<span id="visitCost">300</span>
            </div>
        </div>

        

        <div class="form-group row" style="display:none">
            <label class="col-sm-6 col-md-6 col-lg-6 control-label"><b>Total Cost:</b></label>
            <div class="alert alert-info">
                ₹<span id="totalCost"></span>
            </div>
        </div>

        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center col-12"><div><h2 class="card-head-title">Fees</h2></div></div>
                <div class="card-body">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
                        <table class="table table-bordered mb-0">
                            <tr><td class="py-2"><b>Reg. Fee</b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <span class="reg_fee"></span> </td></tr>
                            <tr><td class="py-2"><b>Stamp Duty</b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <span class="stamp_duty"></span> </td></tr>
                            <tr><td class="py-2"><b>DHC Charges </b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <span class="dhc_charges"></span> </td></tr>
                            <tr><td class="py-2"><b>Service Charges</b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <span class="service_charges"></span></td></tr>
                            <tr><td class="py-2"><b>Visit Charges </b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <span class="visit_charges"></span> </td></tr>
                            <tr><td class="py-2"><b>Extra Visit Charges </b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <span class="extra_visit_charges">0</span></td></tr>
                            <tr><td class="py-2"><b>Police Intimation Charges </b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <del>300</del> <i class="fa fa-inr"></i> <span class="police_initimation_charges">0</span></td></tr>
                            <tr class="bg-light"><td class="py-2"><b>Total Charges</b></td><td class="py-2 text-right"><i class="fa fa-inr"></i> <span class="total_charges"></span></td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 newxt23btn pt-2 pl-0"> 
       <input type="hidden" class="loaderimg" value="<?php echo LOADER; ?>"> <button class="btn btn-secondary prev3" type="button" onclick="previousstep3('Step5','Step4','agrmstep7','agrmstep6')">Previous</button>     
       <button class="btn btn-primary  submit" type="button" onclick="finalproceed('<?php echo SITEURL; ?>')">Proceed Next</button>   
    </div>
</form>

<!-- CSS for Card Styling -->
<style>
.package-card {
   /* cursor: pointer;
    border: 2px solid #ccc;
    transition: 0.3s;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    background-color: #fff;
    transition: all 0.3s ease-in-out; */

    border: 2px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    background: #fff;
    transition: all 0.3s ease-in-out;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    height: 100%;
    justify-content: space-between;
}

/* Yellow & Red Strip */
.package-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, #FFD700, #FF0000);
    clip-path: polygon(0 0, 100% 0, 0 100%);
}

.package-card:hover {
    border-color: #263544;
    transform: scale(1.05);
}
.selected-package {
    background: #263544;
    color: #fff;
    border-color: #263544;
}

.package-card input[type="checkbox"] {
    position: absolute;
    top: 10px;
    right: 10px;
    transform: scale(1.5);
    cursor: pointer;
}

.blurred {
    opacity: 0.5;
    pointer-events: none; /* Prevent clicks */
    filter: grayscale(100%); /* Optional: Make it gray */
}

/* for Toggle */
.toggle-header {
    cursor: pointer;
    background-color: #263544; /* Dark Blue */
    color: #b7c0cd;
    padding: 12px;
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;   
    transition: background-color 0.3s ease-in-out;
    margin-bottom: 5px; /* Space below header */
    margin-top: 5px; /* Space below header */
}

.toggle-header:hover {
    background-color: #1e2b3a; /* Slightly darker on hover */
    color: #fff;
}

.toggle-icon {
    font-size: 14px;
}

.toggle-content {
    background-color: #f8f9fa; /* Light Background */
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-top: 5px;
    display: none; /* Initially hidden */
}
</style>
 