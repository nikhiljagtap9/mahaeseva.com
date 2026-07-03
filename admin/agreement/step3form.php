<h4 class="mb-3">Property Details</h4>
<form class="propertyform mb-0" method="POST">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="row">
                <div class="form-group">
                    <label class="cc-mandatary-field col-12">Area of Property</label>
                    <div class="col-12">
                    <label class="radio-inline"><input type='radio' name="arealoc" class="arealoc" id='arealocrular' value="<?php echo RURALCHRG; ?>"/> Rural(ग्रामीण)</label>
                    <label class="radio-inline"><input type='radio' name="arealoc" class="arealoc" id='arealocurban' value="<?php echo URBANCHRG; ?>" checked/> Urban(शहरी)</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Property Type</label>
                <select class="form-control propertytype" onchange="othershowval('propertytype','propertytypeshow')">
                    <option value="">Select Type</option>
                    <?php for($i=0;$i<count($proparr);$i++){ ?>
                    <option value="<?php echo $proparr[$i]; ?>"><?php echo $proparr[$i]; ?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Built Up Area in Sq. Ft.</label>
                <input type='text' name="builtarea" class="form-control builtarea" id='builtarea' onkeyup="numbercheck('builtarea');othershowvalinput('builtarea','builtareashow')" maxlength="5" placeholder="" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Gallery Area in Sq. Ft.</label>
                <input type='text' name="gallery" class="form-control gallery" id='gallery' onkeyup="numbercheck('gallery');othershowvalinput('gallery','galleryshow')" maxlength="5" placeholder="" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Parking Area in Sq. Ft.</label>
                <input type='text' name="parking" class="form-control parking" id='parking' onkeyup="numbercheck('parking');othershowvalinput('parking','parkingshow')" maxlength="5" placeholder="" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Use</label>
                <select class="form-control propertyuse" onchange="othershowval('propertyuse','propertyuseshow')">
                    <option value="">Select</option>
                    <option value="Residential">Residential</option>
                    <option value="Non-Residential">Non-Residential</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Building Name</label>
                <input type='text' name="buildingname" class="form-control buildingname" id='buildingname' onkeyup="othershowvalinput('buildingname','buildingnameshow')" maxlength="30" placeholder="" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Flat/Office/Shop/House No</label>
                <input type='text' name="flat" class="form-control flat" id='flat' onkeyup="othershowvalinput('flat','flatshow')" maxlength="30" placeholder="" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Floor No</label>
                <input type='text' name="floor" class="form-control floor" id='floor' onkeyup="othershowvalinput('floor','floorshow')" maxlength="10" placeholder="" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Road</label>
                <input type='text' name="road" class="form-control road" id='road' onkeyup="othershowvalinput('road','roadshow')" maxlength="30" placeholder="" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Locality</label>
                <input type='text' name="locality" class="form-control locality" id='locality' onkeyup="othershowvalinput('locality','localityshow')" maxlength="30" placeholder="" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Survey Number</label>
                <input type='text' name="propno" class="form-control propno" id='propno' onkeyup="othershowvalinput('propno','propnoshow')" maxlength="30" placeholder="" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Village/Area</label>
                <input type='text' name="village" class="form-control village" id='village' onkeyup="namechk1('village');othershowvalinput('village','villageshow')" maxlength="30" placeholder="" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Tahsil</label>
                <input type='text' name="tahsil" class="form-control tahsil" id='tahsil' onkeyup="namechk1('tahsil');othershowvalinput('tahsil','tahsilshow')" maxlength="30" placeholder="" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="cc-mandatary-field">Dist</label>
                <input type='text' name="dist" class="form-control dist" id='dist' onkeyup="namechk1('dist');othershowvalinput('dist','distshow')" maxlength="30" placeholder="" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Pincode</label>
                <input type='text' name="proppin" class="form-control proppin" id='proppin' onkeyup="numbercheck('proppin');othershowvalinput('proppin','proppinshow')" minlength="6" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-12"><h4><b>Fitment Details</b></h4><hr></div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Fan</label>
                <input type='text' name="fan" class="form-control fan" id='fan' onkeyup="othershowvalinput('fan','fanshow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Tubelight</label>
                <input type='text' name="tbelight" class="form-control tbelight" id='tbelight' onkeyup="othershowvalinput('tbelight','tbelightshow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Bulb</label>
                <input type='text' name="bulb" class="form-control bulb" id='bulb' onkeyup="othershowvalinput('bulb','bulbshow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Bed</label>
                <input type='text' name="bed" class="form-control bed" id='bed' onkeyup="othershowvalinput('bed','bedshow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Sofa</label>
                <input type='text' name="sofa" class="form-control sofa" id='sofa' onkeyup="othershowvalinput('sofa','sofashow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Table</label>
                <input type='text' name="table" class="form-control table" id='table' onkeyup="othershowvalinput('table','tableshow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Chair</label>
                <input type='text' name="chair" class="form-control chair" id='chair' onkeyup="othershowvalinput('chair','chairshow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Cupboard</label>
                <input type='text' name="cupboard" class="form-control cupboard" id='cupboard' onkeyup="othershowvalinput('cupboard','cupboardshow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Air conditioner</label>
                <input type='text' name="ac" class="form-control ac" id='ac' onkeyup="othershowvalinput('ac','acshow')"  maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Electric Geezer</label>
                <input type='text' name="elegeezer" class="form-control elegeezer" id='elegeezer' onkeyup="othershowvalinput('elegeezer','elegeezershow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Gas Geezer</label>
                <input type='text' name="gasgeezer" class="form-control gasgeezer" id='gasgeezer' onkeyup="othershowvalinput('gasgeezer','gasgeezershow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Air Cooler</label>
                <input type='text' name="cooler" class="form-control cooler" id='cooler' onkeyup="othershowvalinput('cooler','coolershow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Water Cooler</label>
                <input type='text' name="watercooler" class="form-control watercooler" id='watercooler' onkeyup="othershowvalinput('watercooler','watercoolershow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>Curtains</label>
                <input type='text' name="curtains" class="form-control curtains" id='curtains' onkeyup="othershowvalinput('curtains','curtainsshow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>VDO Door Phone</label>
                <input type='text' name="VDO" class="form-control VDO" id='VDO' onkeyup="othershowvalinput('VDO','VDOshow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Water Purifier</label>
                <input type='text' name="purifier" class="form-control purifier" id='purifier' onkeyup="othershowvalinput('purifier','purifiershow')" maxlength="6" placeholder="Water Purifier" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Mod Kitchen With Trolleys</label>
                <input type='text' name="kitchen" class="form-control kitchen" id='kitchen' onkeyup="othershowvalinput('kitchen','kitchenshow')" maxlength="6" placeholder="" />
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <label>Other</label>
                <textarea name="other" class="form-control other" id='other' onkeyup="othershowvalinput('other','othershow')" maxlength="50"></textarea>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 newxt23btn d-flex justify-content-between"> <button class="btn btn-secondary" type="button" onclick="previousstep2('Step3','Stepn','agrmstep5','agrmstep4')">Previous</button> <button class="btn btn-primary" type="button" onclick="nextstep34('Step3','Step4','agrmstep5','agrmstep6')">Next</button>
        </div>
    </div>
 </form>