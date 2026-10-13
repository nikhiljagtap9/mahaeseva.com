<?php include("../../includes/configuration.php");
$action = $_REQUEST['action'];
if($action=="edit_landlord"){?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css"/>
    <?php 
    $landlr = $_REQUEST['id'];
    $landlord = selectQuery(AGR_LANDLORD,"*","landlord_id=".$landlr);
    $occuarr = unserialize (occuarr);
    sort($occuarr); ?>
    <h5 class="mb-3">Update Landlord</h5>
    <div class="landlordupdatemsg"></div>
     <form class="landlordform inputBorder" method="POST">
     <div class="row">
       <div class="col-md-12">
         <div class="form-group mb-2">
           <label for="land1">Landlord Name (As Per Aadhaar Card) <span class="text-danger">*</span></label>
            <input type="hidden" class="landlord_id" value="<?php echo $landlr; ?>"/>
            <input type="hidden" class="landlord_action" value="<?php echo "update_landlord"; ?>"/>
            <input type='text' name="landlord1" class="form-control landlord1" id='landlord1' onkeyup="namechk1('landlord1');" maxlength="50" placeholder="Landlord Name" value="<?php echo $landlord[0]['landlord_name']; ?>"/>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="gender">Gender <span class="text-danger">*</span></label>
              <select class="form-control gender" >
                <option value="">Select Gender</option>
                    <option value="Male" <? if($landlord[0]['landlord_gender']=="Male"){echo "selected";} ?>>Male</option>
                     <option value="Female" <? if($landlord[0]['landlord_gender']=="Female"){echo "selected";} ?>>Female</option>
              </select>
        </div>
      </div>
        <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2" >
           <label for="Occupation">Occupation <span class="text-danger">*</span></label>
           <select class="form-control occupation" >
                <option value="">Select Occupation</option>
                  <?php
                   for($i=0;$i<count($occuarr);$i++)
                   {
                       ?>
                       <option value="<?php echo $occuarr[$i]; ?>" <? if($landlord[0]['landlord_occupation']==$occuarr[$i]){echo "selected";} ?>><?php echo $occuarr[$i]; ?></option>
                       <?
                   }
                   ?>
           </select>
        </div>
      </div>
       <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="landlord1age">Contact Number <span class="text-danger">*</span></label>
            <input type='text' name="landlord1contact" class="form-control landlord1contact" id='landlord1contact' onkeyup="mobnumbercheck('landlord1contact');" minlength="10" maxlength="10" placeholder="Mobile Number" value="<?php echo $landlord[0]['landlord_contact_no']; ?>"/>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="landlord1age">PAN Number <span class="text-danger">*</span></label>
            <input type='text' name="landlord1pan" class="form-control landlord1pan" id='landlord1pan' onkeyup="UpperCase('landlord1pan')" onblur="pan('landlord1pan');"   minlength="10"  maxlength="10" placeholder="PAN Number" value="<?php echo $landlord[0]['landlord_pan_no']; ?>"/>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="landlord1dob">DOB <span class="text-danger">*</span></label>
            <input type='text' name="landlord1dob"  class="form-control landlord1dob" id="datepicker" placeholder="DOB" value="<?php echo $landlord[0]['landlord_dob']; ?>"/>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="landlord1age">Age <span class="text-danger">*</span></label>
            <input type='text' name="landlord1age"  class="form-control landlord1age" id='landlord1age' onkeyup="numbercheck('landlord1age');" maxlength="2" placeholder="Age" value="<?php echo $landlord[0]['landlord_age']; ?>"/>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="landlord1age">Aadhaar Number <span class="text-danger">*</span></label>
            <input type='text' name="landlord1addhar" class="form-control landlord1addhar"  id='landlord1addhar' onkeyup="numbercheck('landlord1addhar');" minlength="12" maxlength="12" placeholder="Aadhaar Number" value="<?php echo $landlord[0]['landlord_aadhaar_no']; ?>"/>
        </div>
      </div>
      <div class="col-md-12 col-sm-12">
         <div class="form-group mb-2">
           <label for="landlord1age">Email </label>
            <input type='text' name="landlord1email" class="form-control landlord1email" id='landlord1email' onblur="mailchk('landlord1email');" maxlength="70" placeholder="Email" value="<?php echo $landlord[0]['landlord_email']; ?>"/>
        </div>
      </div>
      <div class="col-md-12 col-sm-12">
         <div class="form-group mb-2">
           <label for="landlord1age">Landlord's Detailed Permanent Postal Address <span class="text-danger">*</span></label>
           <textarea name="landlord1addr" class="form-control landlord1addr" id='landlord1addr'  maxlength="70"><?php echo $landlord[0]['landlord_address']; ?></textarea>
        </div>
      </div>
       <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="landlord1age">Pincode <span class="text-danger">*</span></label>
            <input type='text' name="landlord1pin" class="form-control landlord1pin" id='landlord1pin' onkeyup="numbercheck('landlord1pin');" maxlength="6" placeholder="Pincode" value="<?php echo $landlord[0]['landlord_address_pin']; ?>"/>
        </div>
      </div>
       <div class="col-md-12 col-sm-12  ">
            <button class="btn btn-primary" type="button" onclick="update('landlord_id','landlord_action','landlord1','gender','landlord1dob','landlord1age','occupation','landlord1contact','landlord1pan','landlord1addhar','landlord1email','landlord1addr','landlord1pin','landlordupdatemsg')">UPDATE</button>
             <button class="btn btn-dark" type="button" onclick="cancelupdate()">CANCEL</button>
         </div>
      </div>
      </form>
      <script src="<?php echo SITEURL; ?>/js/moment.js"></script>
      <script src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>
      <script>$("#datepicker").datetimepicker({ format: 'DD/MM/YYYY', })</script>
     <?
}
if($action=="update_landlord"){
   $id=$_REQUEST['id']; $name=$_REQUEST['name']; $gender=$_REQUEST['gender']; $age=$_REQUEST['age'];$dob=$_REQUEST['dob'];
    $occupation=$_REQUEST['occupation']; $contact=$_REQUEST['contact']; $panno=$_REQUEST['panno'];
    $addhar=$_REQUEST['addhar']; $email=$_REQUEST['email']; $addr=$_REQUEST['addr']; $pin=$_REQUEST['pin'];
    $data = array( "landlord_name"=>ucwords($name), "landlord_gender"=>$gender, "landlord_dob"=>$dob, "landlord_age"=>$age, "landlord_occupation"=>$occupation, "landlord_contact_no"=>$contact, "landlord_pan_no"=>$panno,
    "landlord_aadhaar_no"=>$addhar, "landlord_email"=>$email, "landlord_address"=>ucwords(addslashes($addr)), "landlord_address_pin"=>$pin);
    $landlord=updateQuery(AGR_LANDLORD,$data,"landlord_id=".$id);
    if($landlord){ echo "1"; } else{ echo "0"; }
}
if($action=="edit_tenent"){
     $landlr= $_REQUEST['id'];
     $landlord=selectQuery(AGR_TENENT,"*","tenent_no=".$landlr);
       $occuarr=unserialize (occuarr);
        sort($occuarr); ?>
       <h5 class="mb-3">Update Tenant</h5>
    <div class="landlordupdatemsg"></div>
     <form class="landlordform" method="POST">
     <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css"/>
     <div class="row">
       <div class="col-md-12">
         <div class="form-group mb-2">
           <label for="land1">Tenant Name (As Per Aadhaar Card) <span class="text-danger">*</span></label>
            <input type="hidden" class="landlord_id" value="<?php echo $landlr; ?>"/>
            <input type="hidden" class="landlord_action" value="<?php echo "update_tenent"; ?>"/>
            <input type='text' name="landlord1" class="form-control landlord1" id='landlord1' onkeyup="namechk1('landlord1');" maxlength="50" placeholder="Tenent Name" value="<?php echo $landlord[0]['tenent_name']; ?>"/>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="gender">Gender <span class="text-danger">*</span></label>
              <select class="form-control gender" >
                <option value="">Select Gender</option>
                    <option value="Male" <? if($landlord[0]['tenent_gender']=="Male"){echo "selected";} ?>>Male</option>
                     <option value="Female" <? if($landlord[0]['tenent_gender']=="Female"){echo "selected";} ?>>Female</option>
              </select>
        </div>
      </div>
        <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2" >
           <label for="Occupation">Occupation <span class="text-danger">*</span></label>
           <select class="form-control occupation" >
                <option value="">Select Occupation</option>
                  <?php
                   for($i=0;$i<count($occuarr);$i++)
                   {
                       ?>
                       <option value="<?php echo $occuarr[$i]; ?>" <? if($landlord[0]['tenent_occupation']==$occuarr[$i]){echo "selected";} ?>><?php echo $occuarr[$i]; ?></option>
                       <?
                   }
                   ?>
           </select>
        </div>
      </div>
       <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="landlord1age">Contact Number <span class="text-danger">*</span></label>
            <input type='text' name="landlord1contact" class="form-control landlord1contact" id='landlord1contact' onkeyup="mobnumbercheck('landlord1contact');" minlength="10" maxlength="10" placeholder="Mobile Number" value="<?php echo $landlord[0]['tenent_contact_no']; ?>"/>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="landlord1age">PAN Number <span class="text-danger">*</span></label>
            <input type='text' name="landlord1pan" class="form-control landlord1pan" id='landlord1pan' onkeyup="UpperCase('landlord1pan')" onblur="pan('landlord1pan');"   minlength="10"  maxlength="10" placeholder="PAN Number" value="<?php echo $landlord[0]['tenent_pan_no']; ?>"/>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="landlord1dob">DOB <span class="text-danger">*</span></label>
            <input type='text' name="landlord1dob"  class="form-control landlord1dob" id='datepicker' placeholder="DOB" value="<?php echo $landlord[0]['landlord_dob']; ?>"/>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="landlord1age">Age <span class="text-danger">*</span></label>
            <input type='text' name="landlord1age"  class="form-control landlord1age" id='landlord1age' onkeyup="numbercheck('landlord1age');" maxlength="2" placeholder="Age" value="<?php echo $landlord[0]['tenent_age']; ?>"/>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="landlord1age">Aadhaar Number <span class="text-danger">*</span></label>
            <input type='text' name="landlord1addhar" class="form-control landlord1addhar"  id='landlord1addhar' onkeyup="numbercheck('landlord1addhar');" minlength="12" maxlength="12" placeholder="Aadhaar Number" value="<?php echo $landlord[0]['tenent_aadhaar_no']; ?>"/>
        </div>
      </div>
      <div class="col-md-12 col-sm-12">
         <div class="form-group mb-2">
           <label for="landlord1age">Email </label>
            <input type='text' name="landlord1email" class="form-control landlord1email" id='landlord1email' onblur="mailchk('landlord1email');" maxlength="70" placeholder="Email" value="<?php echo $landlord[0]['tenent_email']; ?>"/>
        </div>
      </div>
      <div class="col-md-12 col-sm-12">
         <div class="form-group mb-2">
           <label for="landlord1age">Tenant's Detailed Permanent Postal Address <span class="text-danger">*</span></label>
           <textarea name="landlord1addr" class="form-control landlord1addr" id='landlord1addr'  maxlength="70"><?php echo $landlord[0]['tenent_address']; ?></textarea>
        </div>
      </div>
       <div class="col-md-6 col-sm-6">
         <div class="form-group mb-2">
           <label for="landlord1age">Pincode <span class="text-danger">*</span></label>
            <input type='text' name="landlord1pin" class="form-control landlord1pin" id='landlord1pin' onkeyup="numbercheck('landlord1pin');" maxlength="6" placeholder="Pincode" value="<?php echo $landlord[0]['tenent_address_pin']; ?>"/>
        </div>
      </div>
       <div class="col-md-12 col-sm-12  ">
            <button class="btn btn-primary" type="button" onclick="update('landlord_id','landlord_action','landlord1','gender','landlord1dob','landlord1age','occupation','landlord1contact','landlord1pan','landlord1addhar','landlord1email','landlord1addr','landlord1pin','landlordupdatemsg')">UPDATE</button>
             <button class="btn btn-dark" type="button" onclick="cancelupdate()">CANCEL</button>
         </div>
      </div>
      </form>
      <script src="<?php echo SITEURL; ?>/js/moment.js"></script>
      <script src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>
      <script>$("#datepicker").datetimepicker({ format: 'DD/MM/YYYY', })</script>
    <?
   }
     if($action=="update_tenent")
  {
      $id=$_REQUEST['id'];
        $name=$_REQUEST['name'];
        $gender=$_REQUEST['gender'];
        $dob=$_REQUEST['dob'];
        $age=$_REQUEST['age'];
        $occupation=$_REQUEST['occupation'];
        $contact=$_REQUEST['contact'];
        $panno=$_REQUEST['panno'];
        $addhar=$_REQUEST['addhar'];
        $email=$_REQUEST['email'];
        $addr=$_REQUEST['addr'];
        $pin=$_REQUEST['pin'];
        $data=array(
           "tenent_name"=>ucwords($name),
           "tenent_gender"=>$gender,
           "tenent_dob"=>$dob,
           "tenent_age"=>$age,
           "tenent_occupation"=>$occupation,
           "tenent_contact_no"=>$contact,
           "tenent_pan_no"=>$panno,
           "tenent_aadhaar_no"=>$addhar,
           "tenent_email"=>$email,
           "tenent_address"=>ucwords(addslashes($addr)),
           "tenent_address_pin"=>$pin
        );
         $tenent=updateQuery(AGR_TENENT,$data,"tenent_no=".$id);
         if($tenent)
         {
            echo "1";
        }
        else
        {
            echo "0";
        }
  }
if($action=="edit_prop"){
    $agrno = $_REQUEST['id'];
    $agreementdata = selectQuery(AGR,"*","agreement_no='".$agrno."'");
    $fitments = selectQuery(AGR_FITMENT,"*","agreement_no='".$agrno."'");
    $proparr = unserialize (proparr);
    sort($proparr); ?>
    <h5 class="mb-3">Property Details</h5>
    <div class="propupdatemsg"></div>
              <form class="propertyform" method="POST">
              <div class="row">
               <div class="col-md-12 col-sm-12">
                 <div class="form-group mb-2">
                   <label for="">Area of Property<span class="text-danger">*</span>  </label>
                    <input type='radio' name="arealoc" class="arealoc" id='arealoc' <? if($agreementdata[0]['prop_under']==RURALCHRG){echo "checked";} ?> value="<?php echo RURALCHRG; ?>"/>  Rural
                    <input type='radio' name="arealoc" class="arealoc" id='arealoc' <? if($agreementdata[0]['prop_under']==URBANCHRG){echo "checked";} ?> value="<?php echo URBANCHRG; ?>" checked/>  Urban
                </div>
              </div>
               <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2" >
                   <label for="Occupation">Property Type <span class="text-danger">*</span></label>
                   <select class="form-control propertytype" >
                        <option value="">Select Type</option>
                          <?php
                           for($i=0;$i<count($proparr);$i++)
                           {
                               ?>
                               <option value="<?php echo $proparr[$i]; ?>" <? if($agreementdata[0]['prop_type']==$proparr[$i]){echo "selected";} ?>><?php echo $proparr[$i]; ?></option>
                               <?
                           }
                           ?>
                   </select>
                </div>
              </div>
               <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Built Up Area in Sq. Ft.<span class="text-danger">*</span></label>
                    <input type='text' name="builtarea" class="form-control builtarea" id='builtarea' onkeyup="numbercheck('builtarea');"  maxlength="5" placeholder="" value="<?php echo $agreementdata[0]['prop_area']; ?>"/>
                </div>
              </div>
                <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Gallery Area in Sq. Ft.</label>
                    <input type='text' name="gallery" class="form-control gallery" id='gallery' onkeyup="numbercheck('gallery');"  maxlength="5" placeholder="" value="<?php echo $agreementdata[0]['prop_gallery_Area']; ?>"/>
                </div>
              </div>
                <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Parking Area in Sq. Ft.</label>
                    <input type='text' name="parking" class="form-control parking" id='parking' onkeyup="numbercheck('parking');"  maxlength="5" placeholder="" value="<?php echo $agreementdata[0]['prop_parking_Area']; ?>"/>
                </div>
              </div>
               <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2" >
                   <label for="Occupation">Use <span class="text-danger">*</span></label>
                   <select class="form-control propertyuse" >
                      <option value="">Select</option>
                      <option value="Residential" <? if($agreementdata[0]['prop_use']=="Residential"){echo "selected";} ?>>Residential</option>
                      <option value="Non-Residential" <? if($agreementdata[0]['prop_use']=="Non-Residential"){echo "selected";} ?>>Non-Residential</option>
                   </select>
                </div>
              </div>
               <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Building Name <span class="text-danger">*</span></label>
                    <input type='text' name="buildingname" class="form-control buildingname" id='buildingname'   maxlength="30" placeholder="" value="<?php echo $agreementdata[0]['prop_building_name']; ?>"/>
                </div>
              </div>
               <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Flat/Office/Shop/House No <span class="text-danger">*</span></label>
                    <input type='text' name="flat" class="form-control flat" id='flat'   maxlength="30" placeholder="" value="<?php echo $agreementdata[0]['prop_flat_no']; ?>"/>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Floor No </label>
                    <input type='text' name="floor" class="form-control floor" id='floor'  maxlength="10" placeholder="" value="<?php echo $agreementdata[0]['prop_floor_no']; ?>"/>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Road <span class="text-danger">*</span></label>
                    <input type='text' name="road" class="form-control road" id='road'  maxlength="30" placeholder="" value="<?php echo $agreementdata[0]['prop_road']; ?>"/>
                </div>
              </div>
               <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Locality <span class="text-danger">*</span></label>
                    <input type='text' name="locality" class="form-control locality" id='locality'   maxlength="30" placeholder="" value="<?php echo $agreementdata[0]['prop_locality']; ?>"/>
                </div>
              </div>
               <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Property No <span class="text-danger">*</span></label>
                   <input type='text' name="propno" class="form-control propno" id='propno'  maxlength="30" placeholder="" value="<?php echo $agreementdata[0]['prop_no']; ?>"/>
                </div>
              </div>
               <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Village/Area <span class="text-danger">*</span></label>
                    <input type='text' name="village" class="form-control village" id='village' onkeyup="namechk1('village');"  maxlength="30" placeholder="" value="<?php echo $agreementdata[0]['prop_village']; ?>"/>
                </div>
              </div>
               <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Tahsil <span class="text-danger">*</span></label>
                    <input type='text' name="tahsil" class="form-control tahsil" id='tahsil' onkeyup="namechk1('tahsil');"  maxlength="30" placeholder="" value="<?php echo $agreementdata[0]['prop_tahsil']; ?>"/>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Dist <span class="text-danger">*</span></label>
                    <input type='text' name="dist" class="form-control dist" id='dist' onkeyup="namechk1('dist');"  maxlength="30" placeholder="" value="<?php echo $agreementdata[0]['prop_dist']; ?>"/>
                </div>
              </div>
               <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Pincode </label>
                    <input type='text' name="proppin" class="form-control proppin" id='proppin' onkeyup="numbercheck('proppin');" minlength="6" maxlength="6" placeholder="" value="<?php echo $agreementdata[0]['prop_pin']; ?>"/>
                </div>
              </div>
              <div class="col-md-12"><h4><b>Fitment Details</b></h4><hr></div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Fan </label>
                    <input type='text' name="fan" class="form-control fan" id='fan'  maxlength="6" placeholder=""  value="<?php echo $fitments[0]['fan']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Tubelight </label>
                    <input type='text' name="tbelight" class="form-control tbelight" id='tbelight' maxlength="6" placeholder="" value="<?php echo $fitments[0]['tubelight']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Bulb </label>
                    <input type='text' name="bulb" class="form-control bulb" id='bulb'  maxlength="6" placeholder="" value="<?php echo $fitments[0]['bulb']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Bed </label>
                    <input type='text' name="bed" class="form-control bed" id='bed'   maxlength="6" placeholder="" value="<?php echo $fitments[0]['bed']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Sofa </label>
                    <input type='text' name="sofa" class="form-control sofa" id='sofa'   maxlength="6" placeholder="" value="<?php echo $fitments[0]['sofa']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Table</label>
                    <input type='text' name="table1" class="form-control table1" id='table1'   maxlength="6" placeholder="" value="<?php echo $fitments[0]['table']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Chair</label>
                    <input type='text' name="chair" class="form-control chair" id='chair'   maxlength="6" placeholder="" value="<?php echo $fitments[0]['chair']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Cupboard</label>
                    <input type='text' name="cupboard" class="form-control cupboard" id='cupboard'  maxlength="6" placeholder="" value="<?php echo $fitments[0]['cupboard']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Air conditioner</label>
                    <input type='text' name="ac" class="form-control ac" id='ac' maxlength="6" placeholder="" value="<?php echo $fitments[0]['ac']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Electric Geezer</label>
                    <input type='text' name="elegeezer" class="form-control elegeezer" id='elegeezer' maxlength="6" placeholder="" value="<?php echo $fitments[0]['electric_geezer']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Gas Geezer</label>
                    <input type='text' name="gasgeezer" class="form-control gasgeezer" id='gasgeezer'  maxlength="6" placeholder="" value="<?php echo $fitments[0]['gas_geezer']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Air Cooler</label>
                    <input type='text' name="cooler" class="form-control cooler" id='cooler'  maxlength="6" placeholder="" value="<?php echo $fitments[0]['air_cooler']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Water Cooler</label>
                    <input type='text' name="watercooler" class="form-control watercooler" id='watercooler'  maxlength="6" placeholder="" value="<?php echo $fitments[0]['water_cooler']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Curtains</label>
                    <input type='text' name="curtains" class="form-control curtains" id='curtains'  maxlength="6" placeholder="" value="<?php echo $fitments[0]['curtains']; ?>"/>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                 <div class="form-group mb-2">
                   <label for="">Washing Machine</label>
                    <input type='text' name="washing_machine" class="form-control washing_machine" id='washing_machine' maxlength="6" placeholder="" value="<?php echo $fitments[0]['washing_machine']; ?>"/>
                </div>
              </div>
              <!--  <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Water Purifier</label>
                    <input type='text' name="purifier" class="form-control purifier" id='purifier'  maxlength="6" placeholder="" value="<?php echo $fitments[0]['purifier']; ?>"/>
                </div>
              </div>

                <div class="col-md-6 col-sm-6">
                 <div class="form-group mb-2">
                   <label for="">Mod Kitchen With Trolleys</label>
                    <input type='text' name="kitchen" class="form-control kitchen" id='kitchen'  maxlength="6" placeholder="" value="<?php echo $fitments[0]['kitchen']; ?>"/>
                </div>
              </div>-->
               <div class="col-md-12 col-sm-12">
                 <div class="form-group mb-2">
                   <label for="">Other</label>
                   <textarea name="other" class="form-control other" id='other'  maxlength="50"><?php echo $fitments[0]['other']; ?></textarea>
                </div>
              </div>
               <div class="col-md-12 col-sm-12">
                <button class="btn btn-primary" type="button" onclick="updateprop('<?php echo $agrno; ?>')">UPDATE</button>
                 <button class="btn btn-dark" type="button" onclick="cancelupdate()">CANCEL</button>
             </div>
               </div>
             </form>
         <?
      }
if($action=="update_prop"){
    $id = $_REQUEST['id']; $arealoc = $_REQUEST['arealoc']; $propertytype = $_REQUEST['propertytype']; $propertyarea = $_REQUEST['builtarea']; $galleryarea = $_REQUEST['gallery']; $parkingarea = $_REQUEST['parking']; $propertyuse = $_REQUEST['propertyuse']; $buildingname = $_REQUEST['buildingname']; $flatno = $_REQUEST['flat']; $floorno = $_REQUEST['floor']; $road = $_REQUEST['road']; $locality = $_REQUEST['locality']; $propno = $_REQUEST['propno']; $village = $_REQUEST['village']; $tahsil = $_REQUEST['tahsil']; $dist = $_REQUEST['dist']; $proppin = $_REQUEST['proppin']; $agrrdata = array(
    "prop_under"=>$arealoc, "prop_type"=>$propertytype, "prop_area"=>$propertyarea, "prop_gallery_Area"=>$galleryarea, "prop_parking_Area"=>$parkingarea, "prop_use"=>$propertyuse, "prop_building_name"=>ucwords(addslashes($buildingname)), "prop_flat_no"=>$flatno, "prop_floor_no"=>$floorno, "prop_road"=>ucwords(addslashes($road)), "prop_locality"=>ucwords(addslashes($locality)), "prop_no"=>$propno, "prop_village"=>ucwords($village), "prop_tahsil"=>ucwords($tahsil), "prop_dist"=>ucwords($dist), "prop_pin"=>$proppin);
    $updateagreeprop = updateQuery(AGR,$agrrdata,"agreement_no='".$id."'"); $fan = $_REQUEST['fan']; $ele_geezer = $_REQUEST['ele_geezer']; $tubelight = $_REQUEST['tubelight']; $ges_geezer = $_REQUEST['ges_geezer']; $bulb = $_REQUEST['bulb']; $cooler = $_REQUEST['cooler']; $bed = $_REQUEST['bed']; $watercooler = $_REQUEST['watercooler']; $sofa = $_REQUEST['sofa']; $curtains = $_REQUEST['curtains']; $table = $_REQUEST['table1']; $chair = $_REQUEST['chair']; $cupboard = $_REQUEST['cupboard'];  $ac = $_REQUEST['ac']; $other = $_REQUEST['other']; $washing_machine = $_REQUEST['washing_machine'];
    $agrrdatafitment = array( "fan"=>$fan, "tubelight"=>$tubelight, "bulb"=>$bulb, "bed"=>$bed, "sofa"=>$sofa, "table"=>$table, "chair"=>$chair, "cupboard"=>$cupboard, "ac"=>$ac, "electric_geezer"=>$ele_geezer, "gas_geezer"=>$ges_geezer, "air_cooler"=>$cooler, "water_cooler"=>$watercooler, "curtains"=>$curtains, "washing_machine"=>$washing_machine, "other"=>$other );
    $instfitment=updateQuery(AGR_FITMENT,$agrrdatafitment,"agreement_no='".$id."'");
    if($updateagreeprop&&$instfitment){ echo "1"; } else{ echo "0"; }
}
if($action=='edit_appointment'){
    $agrno = $_REQUEST['id']; $agreementdata = selectQuery(AGR,"*","agreement_no='".$agrno."'"); ?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css"/>
    <h5>Update Appointment Date</h5>
    <div class="appupdatemsg"></div>
    <form class="propertyform" method="POST">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group mb-2">
                    <label class="cc-mandatary-field">Appointment Date</label>
                    <!--<input type='text' class="form-control appotdate" id='appotdate' value="<?php echo $agreementdata[0]['biometric_appointement_date'] ?>"/>-->
                    <input type='text' class="form-control appotdate" id='appotdate' value="<?php echo date("d/m/Y h:i A"); ?>"/>
                </div>
            </div>
            <div class="col-md-12 col-sm-12"><button class="btn btn-primary" type="button" onclick="updateappointment('<?php echo $agrno; ?>','appotdate')">Update</button> <button class="btn btn-dark" type="button" onclick="cancelupdate()">Cancel</button></div>
        </div>
    </form>
    <script src="<?php echo SITEURL; ?>/js/moment.js"></script>
    <script src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>
    <script>$("#appotdate").datetimepicker();</script>
<? }
if($action=="update_appointment"){
    $id = $_REQUEST['id'];
    if($_REQUEST['appdate']!=""){
        $appodate = date("Y-m-d H:i",strtotime($_REQUEST['appdate']));
        $appdata = array('biometric_appointement_date'=>$appodate);
        $updateapp = updateQuery(AGR,$appdata,"agreement_no='".$id."'");
        print_r($updateapp);exit;
        if($updateapp){ echo "1"; } else{ echo "0"; }
    } else{ echo "0"; }
}
if($action=='ex_edit_appointment'){
  $agrno = $_REQUEST['id']; $agreementdata = selectQuery(AGR,"*","agreement_no='".$agrno."'"); ?>
  <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css"/>
  <h5>Update Appointment Date</h5>
  <div class="appupdatemsg"></div>
  <form class="propertyform" method="POST">
      <div class="row">
          <div class="col-md-12 col-sm-12">
              <div class="form-group mb-2">
                  <label class="cc-mandatary-field">Appointment Date</label>
                  <input type='text' class="form-control exappotdate" id='exappotdate' value="<?php echo date("d/m/Y h:i A"); ?>"/>
              </div>
          </div>
          <div class="col-md-12 col-sm-12"><button class="btn btn-primary" type="button" onclick="exupdateappointment('<?php echo $agrno; ?>','exappotdate')">Update</button> <button class="btn btn-dark" type="button" onclick="cancelupdate()">Cancel</button></div>
      </div>
  </form>
  <script src="<?php echo SITEURL; ?>/js/moment.js"></script>
  <script src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>
  <script>$("#exappotdate").datetimepicker();</script>
<? }
if($action=="ex_update_appointment"){
  $id = $_REQUEST['id'];
  if($_REQUEST['appdate']!=""){
      $appodate = date("Y-m-d H:i",strtotime($_REQUEST['appdate']));
      $appdata = array('ex_biometric_appointement_date'=>$appodate);
      $updateapp = updateQuery(AGR,$appdata,"agreement_no='".$id."'");
      if($updateapp){ echo "1"; } else{ echo "0"; }
  } else{ echo "0"; }
}
if($action=="edit_payment"){
    $agrno = $_REQUEST['id']; ?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css"/>
    <h5 class="mb-3">Update Payment</h5>
    <div class="payupdatemsg"></div>
    <form class="propertyform inputBorder" method="POST">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group mb-2">
                    <label for="">Payment Mode<span class="text-danger">*</span></label>
                    <select class="form-control payment_mode">
                        <option value="">--Mode--</option>
                        <option value="COD">COD</option>
                        <option value="Online">ONLINE</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="">Payment Status<span class="text-danger">*</span></label>
                    <select class="form-control payment_status">
                        <option value="">--Select--</option>
                        <option value="Received">Received</option>
                        <option value="Pending">Pending</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="">Payment Received Date<span class="text-danger">*</span>  </label>
                    <input type='text' class="form-control paydate" id='paydate' />
                </div>
            </div>
            <div class="col-md-12 col-sm-12"><button class="btn btn-primary" type="button" onclick="updatepayment('<?php echo $agrno; ?>')">UPDATE</button></div>
        </div>
    </form>
    <script src="<?php echo SITEURL; ?>/js/moment.js"></script>
    <script src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>
    <script>$("#paydate").datetimepicker({ format: 'DD-MM-YYYY HH:mm', })</script>
<? }
if($action=="update_payment"){
    $id = $_REQUEST['id']; $paymode = $_REQUEST['paymode']; $payment_status = $_REQUEST['payment_status']; $paydate = $_REQUEST['paydate'];
    $paydata = array('payment_mode'=>$paymode, 'last_payment_status'=>$payment_status,);
    if($payment_status=="Received"){ $paydata['last_payment_date']= $paydate; $paydata['isPaid']='1'; }
    else{ $isPaid='0'; }
    $updatepay = updateQuery(AGR,$paydata,"agreement_no='".$id."'");
    if($updatepay){ echo "1"; }else{ echo "0"; }
}
if($action=="chng_status"){
    $agrno = $_REQUEST['id'];
    $agreementdata = selectQuery(AGR,"*","agreement_no='".$agrno."'"); 
    $statusmaster = selectQuery(STATUS,"*","isDel='0' and isActive='1'"); 
    ?>
    <h5 class="mb-3">Update Status</h5>
    <div class="statusmsg"></div>
    <form class="propertyform inputBorder" method="POST">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group mb-2">
                <label class="cc-mandatary-field">Status</label>
                <select class="form-control agrstatus">
                    <option value="">-Select Status-</option>
                    <?php foreach($statusmaster as $value){ ?>
                        <option value="<? echo $value['status'] ?>" <? if($agreementdata[0]['agreement_status']==$value['status']){echo "selected";} ?>><? echo $value['status'] ?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="form-group mb-2">
                    <label for="">Govt. Token No.</label>
                    <input type='text' name="token" class="form-control token" id='token' maxlength="20" placeholder="" value="<?php echo $agreementdata[0]['govt_token_no']; ?>"/>
                </div>
                <div class="form-group mb-2">
                    <label for="">Govt. Reg. No.</label>
                    <input type='text' name="regno" class="form-control regno" id='regno' maxlength="20" placeholder="" value="<?php echo $agreementdata[0]['govt_reg_no']; ?>"/>
                </div>
                <div class="form-group mb-2">
                    <label for="">PRN for DHC</label>
                    <input type='text' name="grnreg" class="form-control grnreg" id='grnreg' maxlength="20" placeholder="" value="<?php echo $agreementdata[0]['grn_for_reg_fee']; ?>"/>
                </div>
                <div class="form-group mb-2">
                    <label for="">GRN for Stamp Duty & Reg. fee</label>
                    <input type='text' name="grnstamp" class="form-control grnstamp" id='grnstamp' maxlength="20" placeholder="" value="<?php echo $agreementdata[0]['grn_for_stamp_duty']; ?>"/>
                </div>
            </div>
            <div class="col-md-12 col-sm-12"><button class="btn btn-primary" type="button" onclick="updatestatusdata('<?php echo $agrno; ?>')">Update</button> <button class="btn btn-dark" type="button" onclick="cancelupdate()">Cancel</button></div>
        </div>
    </form>
<? }
if($action=="update_status"){
    $id = $_REQUEST['id']; $agrstatus = $_REQUEST['agrstatus']; $token = $_REQUEST['token']; $regno = $_REQUEST['regno']; $grnreg = $_REQUEST['grnreg']; $grnstamp = $_REQUEST['grnstamp'];
    if($agrstatus!=""){
        $statdata=array( 'agreement_status'=>$agrstatus, 'govt_token_no'=>$token, 'govt_reg_no'=>$regno, 'grn_for_reg_fee'=>$grnreg ,'grn_for_stamp_duty'=>$grnstamp);
        $updatestat = updateQuery(AGR,$statdata,"agreement_no='".$id."'");
        if($updatestat){ 
          $notification = selectQuery(NOTIFICATION,"*","isActive='1' and isDel='0' and name='".$agrstatus."'");
          $landlorddata = selectQuery(AGR_LANDLORD,"landlord_contact_no","agreement_no='".$id."'");
          $tenentdata = selectQuery(AGR_TENENT,"tenent_contact_no","agreement_no='".$id."'");
          $userdata=selectQuery(WEB_USER ." as u JOIN ".AGR." as agr on u.u_id=agr.agree_by","*","agr.agreement_no='".$id."'");
          $message = $notification[0]['message'];
          if($message != ''){
            $sms = sendwhatsappsms($landlorddata[0]['landlord_contact_no'],$message); // sms to landlord
            $sms = sendwhatsappsms($tenentdata[0]['tenent_contact_no'],$message); // sms to tenent
            // Send SMS to user only if it's not already sent
              if ($landlorddata[0]['landlord_contact_no'] != $userdata[0]['u_mobile'] &&
              $tenentdata[0]['tenent_contact_no'] != $userdata[0]['u_mobile']) 
            {
              $sms = sendwhatsappsms($userdata[0]['u_mobile'], $message); // SMS to user
            }
          }
          echo "1"; 
        } else{ echo "0"; }
    }
}
if($action=="del_landlord"){
    $id = $_REQUEST['id']; ?>
    <div class="modal-body text-muted">Do you Really Want To Delete This Landlord ?</div>
    <div class="modal-footer text-left"><button type="button" class="btn btn-success" onclick="delconfirmed('delete_landlord','<?php echo $id; ?>')">Delete</button> <button type="button" class="btn btn-danger" onclick="cancelupdate1()">Close</button></div>
<? }
if($action=="del_tenent"){
    $id = $_REQUEST['id']; ?>
    <div class="modal-body text-muted">Do you Really Want To Delete This Tenant ?</div>
    <div class="modal-footer text-left"><button type="button" class="btn btn-success" onclick="delconfirmed('delete_tenent','<?php echo $id; ?>')">Delete</button> <button type="button" class="btn btn-danger"  onclick="cancelupdate1()">Close</button></div>
<? }
if($action=="delete_landlord"){
    $id = $_REQUEST['id'];
    $deltenent = deleteQuery(AGR_LANDLORD,"landlord_id=".$id);
    if($deltenent){ echo "1"; }
    else{ echo "0"; }
}
if($action=="delete_tenent"){
    $id = $_REQUEST['id'];
    $deltenent = deleteQuery(AGR_TENENT,"tenent_no=".$id);
    if($deltenent){ echo "1"; }
    else{ echo "0"; }
}
if($action=="del_agreement"){
    $id = $_REQUEST['id']; ?>
    <div class="modal-body text-muted">Do you Really Want To Delete This Agreement ?</div>
    <div class="modal-footer text-left"><button type="button" class="btn btn-success" onclick="delconfirmed('delete_agreement','<?php echo $id; ?>')">Delete</button> <button type="button" class="btn btn-danger" onclick="cancelupdate1()">Close</button></div>
<? }
if($action=="delete_agreement"){
    $id = $_REQUEST['id'];
    $updatedel = array( "isDel"=>"1");
    $delagr = updateQuery(AGR,$updatedel,"agreement_no='".$id."'");
    if($delagr){ echo "1"; }
    else{ echo "0"; }
}
if($action=="del_tempdata"){
$id = $_REQUEST['id']; ?>
<div class="modal-body text-muted">Do you Really Want To Delete This ?</div>
<div class="modal-footer text-left"><button type="button" class="btn btn-success" onclick="delconfirmed('delete_tempdata','<?php echo $id; ?>')">Delete</button> <button type="button" class="btn btn-danger"  onclick="cancelupdate1()">Close</button></div>
<? }
if($action=="delete_tempdata"){
    $id = $_REQUEST['id'];
    $delagr = deleteQuery(TEMP_STORE,"store_id=".$id);
    if($delagr){ echo "1"; } else{ echo "0"; }
}
if($action=="chkclient"){
    $mob = $_REQUEST['mob'];
    $getdata = selectQuery(WEB_USER,"u_id,u_fname,u_lname,u_email","u_mobile='".$mob."'");
    if(count($getdata)){
        $str = $getdata[0]['u_id']."***".$getdata[0]['u_fname']."***".$getdata[0]['u_lname']."***".$getdata[0]['u_email'];
        echo $str;
    } else{ echo 0; }
}
if($action=="addclient"){
    $mob=$_REQUEST['mob']; $fname=$_REQUEST['fname']; $lname=$_REQUEST['lname']; $email=$_REQUEST['email'];
    $getdata = selectQuery(WEB_USER,"u_id,u_fname,u_lname,u_email","u_mobile='".$mob."'");
    if(count($getdata)){ echo $getdata[0]['u_id']; }
    else{
        $data = array("u_mobile"=>$mob, "u_fname"=>ucfirst($fname), "u_lname"=>ucfirst($lname), "u_email"=>$email, "added_on"=>date("Y-m-d H:i:s"), "isActive"=>'1');
        $in = insertQuery(WEB_USER,$data);
        if($in){ echo $in; } else{ echo 0; }
    }
}
if($action=="temp_store"){
$mob = $_REQUEST['mob']; $fname = $_REQUEST['fname']; $lname = $_REQUEST['lname']; $email = $_REQUEST['email'];
$tokenno = $_REQUEST['tokenno']; $regno = ""; $otherinfo = $_REQUEST['otherinfo'];
$data = array("fname"=>ucfirst($fname),"lname"=>ucfirst($lname),"mobile"=>$mob,"email"=>$email,"tokenno"=>$tokenno,"regno"=>$regno,"otherinfo"=>addslashes($otherinfo),"addedon"=>date("Y-m-d H:i:s"),);
$in=insertQuery(TEMP_STORE,$data);
if($in){ echo "1"; }
else{ echo "0"; }
} ?>