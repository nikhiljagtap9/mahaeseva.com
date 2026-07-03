<?php
 include("includes/configuration.php");

 $action=$_REQUEST['action'];

 if($action=="addbasic")
 {
      //  echo"<pre>";print_r($_REQUEST);die('herere');
        $orddata=selectQuery(AGR,"*","agreement_no<>'' order by agree_id DESC limit 1");
        if(count($orddata)==0)
        {
            $agreeno=FINALORD."-A10000";

        }
        else
        {
            $prefix=FINALORD;
            $lenght=strlen($prefix)+2;
            $lenghtlessone=$lenght-1;

            $orid=$orddata[0]['agreement_no'];

            $numcnt=substr($orid,$lenght,5);
            if($numcnt==99999)
            {
                $start=substr($orid,0,$lenghtlessone);
                $alpha=substr($orid,$lenghtlessone,1);
                $b=++$alpha;
                $agreeno= $start."".$b."10000";
            }
            else
            {
                $start=substr($orid,0,$lenght);
                $a= intval($numcnt)+1;
                $agreeno= $start."".$a;

            }
        }

          $arealoc=$_REQUEST['arealoc'];
          $propertytype=$_REQUEST['propertytype'];
          $propertyarea=$_REQUEST['propertyarea'];
          $galleryarea=$_REQUEST['galleryarea'];
          $parkingarea=$_REQUEST['parkingarea'];
          $propertyuse=$_REQUEST['propertyuse'];
          $buildingname=$_REQUEST['buildingname'];
          $flatno=$_REQUEST['flatno'];
          $floorno=$_REQUEST['floorno'];
          $road=$_REQUEST['road'];
          $locality=$_REQUEST['locality'];
          $propno=$_REQUEST['propno'];
          $village=$_REQUEST['village'];
          $tahsil=$_REQUEST['tahsil'];
          $dist=$_REQUEST['dist'];
          $proppin=$_REQUEST['proppin'];
          $content=$_REQUEST['content'];

          $entry_by=$_REQUEST['entry_by'];
          $duration=$_REQUEST['duration'];
          $renttype=$_REQUEST['renttype'];
          $start=$_REQUEST['start'];
          $end=$_REQUEST['end'];
          $deposite=$_REQUEST['deposite'];
          $regfee=$_REQUEST['regfee'];
          $service=$_REQUEST['service'];
          $visit_charge = $_REQUEST['visit_charge'];
          $dhc = $_REQUEST['dhc'];
           $extravisit = $_REQUEST['extravisit'];
          $policeintimation = $_REQUEST['policeintimation'];
          $xtra_visit_charge = $_REQUEST['xtra_visit_charge'];
          $police_charge = $_REQUEST['police_charge'];
          $stamp=$_REQUEST['stamp'];
          $total=$_REQUEST['total'];
          $misc=$_REQUEST['misc'];
          $partytype=$_REQUEST['partytype'];

        $agrrdata=array(
           "agreement_no"=>$agreeno,
           "agree_by"=>$entry_by,
           "prop_under"=>addslashes($arealoc),
           "prop_type"=>addslashes($propertytype),
           "prop_area"=>addslashes($propertyarea),
           "prop_gallery_Area"=>addslashes($galleryarea),
           "prop_parking_Area"=>addslashes($parkingarea),
           "prop_use"=>addslashes($propertyuse),
           "prop_building_name"=>ucwords(addslashes($buildingname)),
           "prop_flat_no"=>$flatno,
           "prop_floor_no"=>$floorno,
           "prop_road"=>ucwords(addslashes($road)),
           "prop_locality"=>ucwords($locality),
           "prop_no"=>$propno,
           "prop_village"=>ucwords($village),
           "prop_tahsil"=>ucwords($tahsil),
           "prop_dist"=>ucwords($dist),
           "prop_pin"=>$proppin,
            "duration"=>$duration,
            "starting_from"=>$start, 
            "end_to"=>$end,
            "deposite"=>$deposite,
            "rent_type"=>$renttype,
            "reg_fee"=>$regfee,
            "stamp_duty"=>$stamp,
            "service_charges"=>$service,
            "visit_charge" => $visit_charge,
            "is_extra_visit"=> ($extravisit==1?1:0),
            "extra_visit_charges"=>($extravisit==1?$xtra_visit_charge:0) ,
            "is_police_initimation"=>($policeintimation==1?1:0) ,
            "police_initimation_charges"=> ($policeintimation==1?$police_charge:0),
            "dhc_charges"=>$dhc,
            "party_appointement" => $partytype,
            "total_charges"=>$total,
            "miscellaneous"=>$misc,
            "agreement_content"=>"",
            "entry_on"=>date("Y-m-d H:i:s")
        );
        
        $instagree=insertQuery(AGR,$agrrdata);
        if($instagree)
        {
           echo base64_encode($agreeno);
        }
        else
        {
            echo 0;
        }
 }

  if($action=="add_landlord")
 {
       $agrrementno=base64_decode($_REQUEST['agrrementno']);

      $name=$_REQUEST['name'];
      $gender=$_REQUEST['gender'];
      $dob=$_REQUEST['dob'];
      $age=$_REQUEST['age'];
      $occupation=$_REQUEST['occupation'];
      $mobile=$_REQUEST['mobile'];
      $pan=$_REQUEST['pan'];
      $aadhaar=$_REQUEST['aadhaar'];
      $email=$_REQUEST['email'];
      $address=$_REQUEST['address'];
      $pincode=$_REQUEST['pincode'];

       $agrrdatalandlord=array(
          "agreement_no"=>$agrrementno,
          "landlord_name"=>ucwords($name),
          "landlord_gender"=>$gender,
          "landlord_dob"=>$dob,
          "landlord_age"=>$age,
          "landlord_occupation"=>$occupation,
          "landlord_contact_no"=>$mobile,
          "landlord_pan_no"=>$pan,
          "landlord_aadhaar_no"=>$aadhaar,
          "landlord_email"=>$email,
          "landlord_address"=>ucwords(addslashes($address)),
          "landlord_address_pin"=>$pincode
       );
       $instlandlord=insertQuery(AGR_LANDLORD,$agrrdatalandlord);
 }

  if($action=="add_tenent")
 {
      $agrrementno=base64_decode($_REQUEST['agrrementno']);

       $name=$_REQUEST['name'];
      $gender=$_REQUEST['gender'];
      $dob=$_REQUEST['dob'];
      $age=$_REQUEST['age'];
      $occupation=$_REQUEST['occupation'];
      $mobile=$_REQUEST['mobile'];
      $pan=$_REQUEST['pan'];
      $aadhaar=$_REQUEST['aadhaar'];
      $email=$_REQUEST['email'];
      $address=$_REQUEST['address'];
      $pincode=$_REQUEST['pincode'];

       $agrrdatalandtenent=array(
          "agreement_no"=>$agrrementno,
          "tenent_name"=>ucwords($name),
          "tenent_gender"=>$gender,
          "tenent_dob"=>$dob,
          "tenent_age"=>$age,
          "tenent_occupation"=>$occupation,
          "tenent_contact_no"=>$mobile,
          "tenent_pan_no"=>$pan,
          "tenent_aadhaar_no"=>$aadhaar,
          "tenent_email"=>$email,
          "tenent_address"=>ucwords(addslashes($address)),
          "tenent_address_pin"=>$pincode
       );
       $insttenent=insertQuery(AGR_TENENT,$agrrdatalandtenent);
 }

 if($action=="add_rent")
 {
      $agrrementno=base64_decode($_REQUEST['agrrementno']);

       $rentduration=$_REQUEST['rentduration'];
       $rent=$_REQUEST['rent'];

        $agrrdatalandrent=array(
          "agreement_no"=>$agrrementno,
          "duration"=>$rentduration,
          "rent"=>$rent
          );

        $instrent=insertQuery(AGR_RENT,$agrrdatalandrent);
 }

 if($action=="add_fitment")
 {

   $agrrementno=base64_decode($_REQUEST['agrrementno']);
     $fan=$_REQUEST['fan'];
    $ele_geezer=$_REQUEST['ele_geezer'];
    $tubelight=$_REQUEST['tubelight'];
    $ges_geezer=$_REQUEST['ges_geezer'];
    $bulb=$_REQUEST['bulb'];
    $cooler=$_REQUEST['cooler'];
    $bed=$_REQUEST['bed'];
    $watercooler=$_REQUEST['watercooler'];
    $sofa=$_REQUEST['sofa'];
    $curtain=$_REQUEST['curtain'];
    $table=$_REQUEST['table'];
    $vdo=$_REQUEST['vdo'];
    $chair=$_REQUEST['chair'];
    $cupboard=$_REQUEST['cupboard'];
    $kitchen=$_REQUEST['kitchen'];
    $ac=$_REQUEST['ac'];
    $other=$_REQUEST['other'];
    $purifier=$_REQUEST['purifier'];

     $agrrdatafitment=array(
          "agreement_no"=>$agrrementno,
          "fan"=>$fan,
          "tubelight"=>$tubelight,
          "bulb"=>$bulb,
          "bed"=>$bed,
          "sofa"=>$sofa,
          "table"=>$table,
          "chair"=>$chair,
          "cupboard"=>$cupboard,
          "ac"=>$ac,
          "electric_geezer"=>$ele_geezer,
           "gas_geezer"=>$ges_geezer,
           "air_cooler"=>$cooler,
           "water_cooler"=>$watercooler,
           "curtains"=>$curtain,
           "VDO_door_phone"=>$vdo,
           "purifier"=>$purifier,
           "kitchen"=>$kitchen,
           "other"=>$other
       );
       $instfitment=insertQuery(AGR_FITMENT,$agrrdatafitment);
 }
?>