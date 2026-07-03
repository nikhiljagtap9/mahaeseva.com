<div class="section-title mr-20"><h4 class="mb-3 fw-6">Property Details</h4></div>
<form class="propertyform inputBorder" method="POST">
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Area of Property</label>
                <div>
                    <div class="custom-control custom-radio custom-control-inline"><input type='radio' name="arealoc" class="arealoc custom-control-input" id='arealoc' value="<?php echo RURALCHRG; ?>"/><label class="custom-control-label" for="arealoc">Rural (ग्रामीण)</label></div>
                    <div class="custom-control custom-radio custom-control-inline"><input type='radio' name="arealoc" class="arealoc custom-control-input" id='areaurban' value="<?php echo URBANCHRG; ?>" checked/><label class="custom-control-label" for="areaurban">Urban (शहरी)</label></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 pr-sm-0">
            <div class="form-group mb-2">
                <label for="Occupation" class="cc-mandatary-field">Property Type</label>
                <select class="form-control propertytype" onchange="othershowval('propertytype','propertytypeshow')">
                    <option value="">Select Type</option>
                    <?php for($i=0;$i<count($proparr);$i++){ ?>
                    <option value="<?php echo $proparr[$i]; ?>"><?php echo $proparr[$i]; ?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Built Up Area in Sq. Ft.</label>
                <input type='text' name="builtarea" class="form-control builtarea" id='builtarea' onkeyup="numbercheck('builtarea');othershowvalinput('builtarea','builtareashow')" maxlength="5" placeholder="Built Up Area" />
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 pr-sm-0">
            <div class="form-group mb-2">
                <label>Gallery Area in Sq. Ft.</label>
                <input type='text' name="gallery" class="form-control gallery" id='gallery' onkeyup="numbercheck('gallery');othershowvalinput('gallery','galleryshow')" maxlength="5" placeholder="Gallery Area" />
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6">
            <div class="form-group mb-2">
                <label for="">Parking Area in Sq. Ft.</label>
                <input type='text' name="parking" class="form-control parking" id='parking' onkeyup="numbercheck('parking');othershowvalinput('parking','parkingshow')" maxlength="5" placeholder="Parking Area" />
            </div>
        </div>
        <div class="col-6 col-md-6 pr-0">
            <div class="form-group mb-2">
                <label for="Occupation" class="cc-mandatary-field">Use</label>
                <select class="form-control propertyuse" onchange="othershowval('propertyuse','propertyuseshow')"><option value="">Select</option><option value="Residential">Residential</option><option value="Non-Residential">Non-Residential</option></select>
            </div>
        </div>
        <div class="col-6 col-md-6">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Building Name</label>
                <input type='text' name="buildingname" class="form-control buildingname" id='buildingname' onkeyup="othershowvalinput('buildingname','buildingnameshow')" maxlength="30" placeholder="Building Name" />
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 pr-sm-0">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Flat/Office/Shop/House No</label>
                <input type='text' name="flat" class="form-control flat" id='flat' onkeyup="othershowvalinput('flat','flatshow')" maxlength="30" placeholder="Flat/Office/Shop/House No" />
            </div>
        </div>
        <div class="col-6 col-md-6 pr-0 pr-sm-3">
            <div class="form-group mb-2">
                <label>Floor No</label>
                <input type='text' name="floor" class="form-control floor" id='floor' onkeyup="othershowvalinput('floor','floorshow')" maxlength="10" placeholder="Floor No" />
            </div>
        </div>
        <div class="col-6 col-md-6 pr-sm-0">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Road</label>
                <input type='text' name="road" class="form-control road" id='road' onkeyup="othershowvalinput('road','roadshow')" maxlength="30" placeholder="Enter Road" />
            </div>
        </div>
        <div class="col-6 col-md-6 pr-0 pr-sm-3">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Locality</label>
                <input type='text' name="locality" class="form-control locality" id='locality' onkeyup="othershowvalinput('locality','localityshow')" maxlength="30" placeholder="Enter Locality" />
            </div>
        </div>
        <div class="col-6 col-md-6 pr-sm-0">
            <div class="form-group mb-2">
                <label>Survey Number</label>
                <input type='text' name="propno" class="form-control propno" id='propno' onkeyup="othershowvalinput('propno','propnoshow')" maxlength="30" placeholder="Survey Number" />
            </div>
        </div>
        <div class="col-6 col-md-6 pr-0 pr-sm-3">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Village/Area</label>
                <input type='text' name="village" class="form-control village" id='village' onkeyup="namechk1('village');othershowvalinput('village','villageshow')" maxlength="30" placeholder="Enter Village/Area" />
            </div>
        </div>
        <div class="col-6 col-md-6 pr-sm-0">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Tahsil</label>
                <input type='text' name="tahsil" class="form-control tahsil" id='tahsil' onkeyup="namechk1('tahsil');othershowvalinput('tahsil','tahsilshow')" maxlength="30" placeholder="Enter Tahsil" />
            </div>
        </div>
        <div class="col-6 col-md-6 pr-0 pr-sm-0">
            <div class="form-group mb-2">
                <label class="cc-mandatary-field">Dist</label>
                <input type='text' name="dist" class="form-control dist" id='dist' onkeyup="namechk1('dist');othershowvalinput('dist','distshow')" maxlength="30" placeholder="Enter Dist" />
            </div>
        </div>
        <div class="col-6 col-md-6 pr-sm-0">
            <div class="form-group mb-2">
                <label>Pincode</label>
                <input type='text' name="proppin" class="form-control proppin" id='proppin' onkeyup="numbercheck('proppin');othershowvalinput('proppin','proppinshow')" minlength="6" maxlength="6" placeholder="Enter Pincode" />
            </div>
        </div>
        <div class="col-md-12 mt-3"><h5 class="mb-3">Fitment Details</h5></div>
        <div class="col-6 col-sm-4 col-md-4 pr-0">
            <div class="form-group mb-2">
                <label>Fan</label>
                <input type='text' name="fan" class="form-control fan" id='fan' onkeyup="othershowvalinput('fan','fanshow')" maxlength="6" placeholder="Fitment Details" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4 pr-sm-0">
            <div class="form-group mb-2">
                <label>Tubelight</label>
                <input type='text' name="tbelight" class="form-control tbelight" id='tbelight' onkeyup="othershowvalinput('tbelight','tbelightshow')" maxlength="6" placeholder="Tubelight" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4 pr-0 pr-sm-3">
            <div class="form-group mb-2">
                <label>Bulb</label>
                <input type='text' name="bulb" class="form-control bulb" id='bulb' onkeyup="othershowvalinput('bulb','bulbshow')" maxlength="6" placeholder="Bulb" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4 pr-sm-0">
            <div class="form-group mb-2">
                <label>Bed</label>
                <input type='text' name="bed" class="form-control bed" id='bed' onkeyup="othershowvalinput('bed','bedshow')" maxlength="6" placeholder="Bed" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4 pr-0">
            <div class="form-group mb-2">
                <label>Sofa</label>
                <input type='text' name="sofa" class="form-control sofa" id='sofa' onkeyup="othershowvalinput('sofa','sofashow')" maxlength="6" placeholder="Sofa" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4">
            <div class="form-group mb-2">
                <label>Table</label>
                <input type='text' name="table" class="form-control table" id='table' onkeyup="othershowvalinput('table','tableshow')" maxlength="6" placeholder="Table" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4 pr-0">
            <div class="form-group mb-2">
                <label>Chair</label>
                <input type='text' name="chair" class="form-control chair" id='chair' onkeyup="othershowvalinput('chair','chairshow')" maxlength="6" placeholder="Chair" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4 pr-sm-0">
            <div class="form-group mb-2">
                <label>Cupboard</label>
                <input type='text' name="cupboard" class="form-control cupboard" id='cupboard' onkeyup="othershowvalinput('cupboard','cupboardshow')" maxlength="6" placeholder="Cupboard" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4 pr-0 pr-sm-3">
            <div class="form-group mb-2">
                <label>Air conditioner</label>
                <input type='text' name="ac" class="form-control ac" id='ac' onkeyup="othershowvalinput('ac','acshow')" maxlength="6" placeholder="Air conditioner" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4 pr-sm-0">
            <div class="form-group mb-2">
                <label>Electric Geezer</label>
                <input type='text' name="elegeezer" class="form-control elegeezer" id='elegeezer' onkeyup="othershowvalinput('elegeezer','elegeezershow')" maxlength="6" placeholder="Electric Geezer" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4 pr-0">
            <div class="form-group mb-2">
                <label>Gas Geezer</label>
                <input type='text' name="gasgeezer" class="form-control gasgeezer" id='gasgeezer' onkeyup="othershowvalinput('gasgeezer','gasgeezershow')" maxlength="6" placeholder="Gas Geezer" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4">
            <div class="form-group mb-2">
                <label>Air Cooler</label>
                <input type='text' name="cooler" class="form-control cooler" id='cooler' onkeyup="othershowvalinput('cooler','coolershow')" maxlength="6" placeholder="Air Cooler" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4 pr-0">
            <div class="form-group mb-2">
                <label>Water Cooler</label>
                <input type='text' name="watercooler" class="form-control watercooler" id='watercooler' onkeyup="othershowvalinput('watercooler','watercoolershow')" maxlength="6" placeholder="Water Cooler" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4 pr-sm-0">
            <div class="form-group mb-2">
                <label>Curtains</label>
                <input type='text' name="curtains" class="form-control curtains" id='curtains' onkeyup="othershowvalinput('curtains','curtainsshow')" maxlength="6" placeholder="Curtains" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4 pr-0 pr-sm-3">
            <div class="form-group mb-2">
                <label>VDO Door Phone</label>
                <input type='text' name="VDO" class="form-control VDO" id='VDO' onkeyup="othershowvalinput('VDO','VDOshow')" maxlength="6" placeholder="VDO Door Phone" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4 pr-0">
            <div class="form-group mb-2">
                <label>Water Purifier</label>
                <input type='text' name="purifier" class="form-control purifier" id='purifier' onkeyup="othershowvalinput('purifier','purifiershow')" maxlength="6" placeholder="Water Purifier" />
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-4">
            <div class="form-group mb-2">
                <label>Mod Kitchen With Trolleys</label>
                <input type='text' name="kitchen" class="form-control kitchen" id='kitchen' onkeyup="othershowvalinput('kitchen','kitchenshow')" maxlength="6" placeholder="Mod Kitchen With Trolleys" />
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <label>Other</label>
                <textarea name="other" class="form-control other" id='other' onkeyup="othershowvalinput('other','othershow')" maxlength="50" placeholder="Other"></textarea>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 newxt23btn d-flex justify-content-between"><button class="btn btn-dark btn-sm px-3" type="button" onclick="previousstep2('Step3','Step2','pill3','pill2')">Previous</button> <button class="btn btn-primary btn-sm px-3" type="button" onclick="nextstep34('Step3','Step4','pill3','pill4')">Next</button></div>
    </div>
</form>