<?php include("../includes/configuration.php");
  $user=$_SESSION['reguser'];
  $agree=base64_decode($_REQUEST['age']);
  $orders=selectQuery(AGR,"*","agreement_no='".$agree."' and agree_by=".$user);
  $landlord=selectQuery(AGR_LANDLORD,"*","agreement_no='".$agree."'");
  $tenents=selectQuery(AGR_TENENT,"*","agreement_no='".$agree."'");
  $rent=selectQuery(AGR_RENT,"*","agreement_no='".$agree."'");
  $fitments=selectQuery(AGR_FITMENT,"*","agreement_no='".$agree."'");
  ini_set('memory_limit','128M');
  require_once "includes/mpdf/vendor/autoload.php";
  $path =   SITEURL;

  $header ='<div>
  <div class="header">
    <div class="head">
      <table width="100%" border="0">
        <tr><td style="width:77%"></td><td>  <img src="'.SITEURL.'/img/projectimage/logo.png"/> </td></tr>
        </table>
      </div>
    </div>
  </div>';

  $footer = '<div style="background-color:#373737;color:white;" class="add"><div>Address:&nbsp;'.ADDRESS.'</div></div>';

  $ldstr="";
  $tnstr="";
  $rentstr="";
  for($i=0;$i<count($landlord);$i++){
  $ldstr.=' <li class="landlord current">
    Name : <span class="name text-bold">'.$landlord[$i]['landlord_name'].'</span>,
    Gender : <span class="gender gendershow text-bold">'.$landlord[$i]['landlord_gender'].'</span>,
    Age About : <span class="age text-bold">'.$landlord[$i]['landlord_age'].'</span> Years,
    Occupation : <span class="occupation text-bold">'.$landlord[$i]['landlord_occupation'].'</span>,
    having Contact Number : <span class="mobile text-bold">'.$landlord[$i]['landlord_contact_no'].'</span>,
    PAN : <span class="pan text-bold">'.$landlord[$i]['landlord_pan_no'].'</span>,
    Aadhaar : <span class="aadhaar text-bold">'.$landlord[$i]['landlord_aadhaar_no'].'</span>,
    Email-Id : <span class="email text-bold">'.$landlord[$i]['landlord_email'].'</span>,
    Residing at : <span class="address text-bold">'.$landlord[$i]['landlord_address'].'</span>,
    Pincode : <span class="pincode text-bold">'.$landlord[$i]['landlord_address_pin'].'</span>
    </li>';
  }

  for($i=0;$i<count($tenents);$i++){
    $tnstr=$tnstr.'<li class="tenent">
    Name : <span class="name text-bold">'.$tenents[$i]['tenent_name'].'</span>,
    Gender : <span class="gender gendershow text-bold">'.$tenents[$i]['tenent_gender'].'</span>,
    Age About : <span class="age text-bold">'.$tenents[$i]['tenent_age'].'</span> Years,
    Occupation : <span class="occupation text-bold">'.$tenents[$i]['tenent_occupation'].'</span>,
    having Contact Number : <span class="mobile text-bold">'.$tenents[$i]['tenent_contact_no'].'</span>,
    PAN : <span class="pan text-bold">'.$tenents[$i]['tenent_pan_no'].'</span>,
    Aadhaar : <span class="aadhaar text-bold">'.$tenents[$i]['tenent_aadhaar_no'].'</span>,
    Email-Id : <span class="email text-bold">'.$tenents[$i]['tenent_email'].'</span>,
    Residing at : <span class="address text-bold">'.$tenents[$i]['tenent_address'].'</span>,
    Pincode : <span class="pincode text-bold">'.$tenents[$i]['tenent_address_pin'].'</span>
    </li>';
  }

  if($orders[0]['rent_type']=="Variable"){
    $varrent="";
    for($i=0;$i<count($rent);$i++){
      $varrent='   <li class="varrentdetails1">
      Rs. <span class="text-bold varrent varrentshow1">'.$rent[$i]['rent'].'</span> /- per month for the  <span class="text-bold dura varrentmonthshow1">'.$rent[$i]['duration'].'</span> months
      </li> ';
    }
    $rentstr='<div class="variable">
    <ol class="varrentshow">'.$varrent.'</ol>
    </div>';
    } else{
    $rentstr='<div class="fixed">Rs. <span class="text-bold fixedrentshow">'.$rent[0]['rent'].'</span>  /- per month</div>';
  }

  $content='
    <div class="bordert">
      <div style="text-align:center"><h2 class="mt-0">LEAVE AND LICENSE AGREEMENT</h2></div><br>
      This agreement is made BETWEEN<br>
      <ol class="landlorddetails">'.$ldstr.'</ol>
      <p>HEREINAFTER called the \'LICENSOR\' (which expression shall mean and include the Licensor above named and also his respective heirs, successors, assigns, executors and administrators)</p>

      <div class="text-center">AND</div>

      <ol class="tenentdetails">'.$tnstr.'</ol>
      <p>HEREINAFTER called the \'Licensee\' (which expression shall mean and include only Licensee above named).</p>
      <p>WHEREAS the Licensor is absolutely seized and possessed of and/or otherwise well and sufficiently entitled to all that constructed
      portion being unit described in Schedule I hereunder written and are hereafter for the sake of brevity called or referred to as Licensed
      Premises and is/are desirous of giving the said premises on Leave and License basis under Section 24 of the Maharashtra Rent Control Act, 1999.</p>

      <p>AND WHEREAS the Licensee herein is/are in need of temporary premises for his/her/their <span class="text-bold propertyuseshow">'.$orders[0]['prop_use'].'</span>
      use has/have approached the Licensor with a request to allow the Licensee/s herein to use and occupy the said premises on Leave and License basis for a period of <span class="text-bold durationshow">'.$orders[0]['duration'].'</span>
      Months commencing from <span class="text-bold startdateshow">'.$orders[0]['starting_from'].'</span>
      and ending on <span class="text-bold enddateshow">'.$orders[0]['end_to'].'</span>
      on terms and subject to conditions hereafter appearing.</p>

      <p>AND WHEREAS the Licensor have agreed to allow the Licensee herein to use and occupy the said Licensed premises for his aforesaid <span class="text-bold propertyuseshow">'.$orders[0]['prop_use'].'</span>
      purposes only, on Leave and License basis for above mentioned period, on terms and subject to conditions hereafter appearing;</p>

      <p>NOW THEREFORE IT IS HEREBY AGREED TO, DECLARED AND RECORDED BY AND BETWEEN THE PARTIES HERETO AS FOLLOWS :-</p>
      <p>1) <b>Period</b> : That the Licensor hereby grants to the Licensee herein a revocable leave and license, to occupy the Licensed Premises, described in Schedule I hereunder written without creating any tenancy rights or any other rights, title and interest in favour of the Licensee for a period of  <span class="text-bold durationshow">'.$orders[0]['duration'].'</span>
      Months commencing from  <span class="text-bold startdateshow">'.$orders[0]['starting_from'].'</span>
      and ending on <span class="text-bold enddateshow">'.$orders[0]['end_to'].'</span>.</p>
      <p>2) <b>License Fee & Deposit</b> : That the Licensee shall pay to the Licensor the following amount per month towards the compensation for the use of the said Licensed premises.  <br>
      '.$rentstr.'
      </p>
      <p>The amount of monthly compensation License fee shall be payable within first five days of the concerned month of Leave and License. Licensees shall also pay to the Licensor Rs.<span class="text-bold"></span>
      /- interest free refundable deposit, for the use of the said Licensed premises. </p>
      <p>3) <b>Payment of Deposit</b> : That the Licensee have paid / shall pay the above mentioned deposit/premium as mentioned above by Cash. Amount Rs.<span class="text-bold depositeshow">'.$orders[0]['deposite'].'/-</span></p>
      <p>4) <b>Maintenance Charges</b> : That the Licensor herein shall bear and pay all the maintenance charges in respect of the said Licensed Premises, and other outgoings including all rates, taxes, levies, assessment, non occupancy charges, etc. in respect of the said premises.</p>
      <p>5) <b>Electricity Charges</b> : The licensee herein shall pay the electricity bills directly for energy consumed on the licensed premises and should submit original receipts to licensor indicating that the electricity bills are paid.</p>
      <p>6) <b>Use</b>: That the Licensed premises shall only be used by the Licensee for <span class="text-bold propertyuseshow">'.$orders[0]['prop_use'].'</span>
      purpose. The Licensee shall maintain the said premises in its existing condition and damage, if any, caused to the said premises, the same shall be repaired by the Licensee at its own cost subject to normal wear and tear. The Licensee shall not do anything in the said premises which is or is likely to cause a nuisance to the other occupants of the said building or to the prejudice in any manner to the rights of Licensor in respect of said premises or shall not do any unlawful activities prohibited by State or Central Government.</p>
      <p>7) <b>Alteration</b> : That the Licensee shall not make or permit to do any alteration or addition to the construction or arrangements (internal or external) to the Licensed premises without previous consent in writing from the Licensor.</p>
      <p>8)<b> No Tenancy</b> : That the Licensee shall not claim any tenancy right and shall not have any right to transfer, assign, and sublet or grant any license or sub-license in respect of the Licensed Premises or any part thereof and also shall not mortgage or raise any loan against the said premises.</p>
      <p> 9) <b>Inspection</b> : That, the Licensor shall on reasonable notice given by the Licensor to the Licensee shall have a right of access either by himself or through authorized representative to enter, view and inspect the Licensed premises at reasonable intervals.</p>
      <p>10) <b>Cancellation</b> : That, Subject to the condition of lock in period (if any), if the Licensee commits default in regular and punctual payments of monthly compensation as herein before mentioned or commit/s breach of any of the terms, covenants and conditions of this agreement or if any legislation prohibiting the Leave and License is imposed, the Licensor shall be entitled to revoke and / or cancel the License hereby granted, by giving notice in writing of one month and the Licensee too will have the right to vacate the said premises by giving a notice in writing of one month to the Licensor as mentioned earlier.</p>
      <p>11) <b>Possession</b> : That the immediately at on the expiration or termination or cancellation of this agreement the Licensee shall vacate the said premises without delay with all his goods and belongings. In the event of the Licensee failing and / or neglecting to remove himself and / or his articles from the said premises on expiry or sooner determination of this Agreement, the Licensor shall be entitled to recover damages at the rate of double the daily amount of compensation per day and or alternatively the Licensor shall be entitled to remove the Licensee and his belongings from the Licensed premises, without recourse to the Court of Law.</p>
      <p>12) <b>Furniture and Appliances</b>: The said premises is having the Furniture and Appliances mentioned in the Schedule II. The licensee shall maintain the said Furniture and Appliances in the said premises in its existing condition and damage, if any, caused to the said Furniture and Appliances, the same shall be repaired by the Licensee/s at its own cost subject to normal wear and tear.</p>
      <p>13) <b>Miscellaneous</b> :  <span class="text-bold miscshow">'.$orders[0]['miscellaneous'].'</span> </p>

      14) <b>Registration</b>: This Agreement is to be registered and the expenditure of Stamp duty and registration fees and incidental charges, if any, shall be borne by the <br>

      <div class="col-md-12 text-center" style="text-align:center"><h3 class="sub-title">SCHEDULE I</h3></div>

      <p>premises (Being the correct description of <span class="text-bold propertytypeshow">'.$orders[0]['prop_type'].'</span>
      which is the subject matter of these presents)
      All that constructed portion being residential unit bearing <span class="text-bold propertyuseshow">'.$orders[0]['prop_use'].'</span>
      No. <span class="text-bold floorshow">'.$orders[0]['prop_floor_no'].'</span>
      Built-up : <span class="text-bold builtareashow">'.$orders[0]['prop_area'].'</span>
      Square Ft, situated on the <span class="text-bold floorshow">'.$orders[0]['prop_floor_no'].'</span>
      Floor of a Building known as \'<span class="text-bold buildingnameshow">'.$orders[0]['prop_building_name'].'</span>
      \' standing on the plot of land bearing Number <span class="text-bold propnoshow">'.$orders[0]['prop_no'].'</span>
      ,<span class="text-bold roadshow">'.$orders[0]['prop_road'].'</span>   Road
      , Locality - <span class="text-bold localityshow">'.$orders[0]['prop_locality'].'</span>
      of Village - <span class="text-bold villageshow">'.$orders[0]['prop_village'].'</span>
      , situated within the revenue limits of Tehsil - <span class="text-bold tahsilshow">'.$orders[0]['prop_tahsil'].'</span> and Dist - <span class="text-bold distshow">'.$orders[0]['prop_dist'].'</span>
      </p>

      <p>IN WITNESS WHEREOF the parties hereto have set and subscribed their respective signatures by way of putting thumb impression electronic signature hereto in the presence of witness, who are identifying the executants, on the day, month and year first above written.</p>

      <div class="col-md-12 text-center" style="text-align:center"><h3 class="sub-title">SCHEDULE II</h3></div>
      <p>(Being the correct description of Furniture and Appliances in the premise)</p>
      <table class="table table-striped" style="width:100%">
        <thead><tr><th>Sr No.</th><th>Item </th><th>Number of Units. </th><th>Sr No.</th><th>Item </th><th>Number of Units. </th></tr></thead>
        <tbody class="mute-texted">
          <tr>
            <td>1</td>
            <td>Fan</td>
            <td> <span class="text-bold fanshow">'.$fitments[0]['fan'].'</span>  </td>
            <td>10</td>
            <td>Electric Geezer</td>
            <td> <span class="text-bold elegeezershow">'.$fitments[0]['electric_geezer'].'</span>  </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Tube light</td>
            <td> <span class="text-bold tbelightshow">'.$fitments[0]['tubelight'].'</span>  </td>
            <td>11</td>
            <td>Gas Geezer</td>
            <td> <span class="text-bold gasgeezershow ">'.$fitments[0]['gas_geezer'].'</span>  </td>
          </tr>
          <tr>
            <td>3</td>
            <td>Bulb</td>
            <td> <span class="text-bold bulbshow">'.$fitments[0]['bulb'].'</span>  </td>
            <td>12</td>
            <td>Air Cooler</td>
            <td> <span class="text-bold coolershow">'.$fitments[0]['air_cooler'].'</span>  </td>
          </tr>
          <tr>
            <td>4</td>
            <td>Bed</td>
            <td> <span class="text-bold bedshow">'.$fitments[0]['bed'].'</span>  </td>
            <td>13</td>
            <td>Water Cooler</td>
            <td> <span class="text-bold watercoolershow">'.$fitments[0]['water_cooler'].'</span>  </td>
          </tr>
          <tr>
            <td>5</td>
            <td>Sofa</td>
            <td> <span class="text-bold sofashow">'.$fitments[0]['sofa'].'</span>  </td>
            <td>14</td>
            <td>Curtains</td>
            <td> <span class="text-bold curtainsshow">'.$fitments[0]['curtains'].'</span>  </td>
          </tr>
          <tr>
            <td>6</td>
            <td>Table</td>
            <td> <span class="text-bold tableshow">'.$fitments[0]['table'].'</span>  </td>
            <td>15</td>
            <td>VDO Door Phone</td>
            <td> <span class="text-bold VDOshow">'.$fitments[0]['VDO_door_phone'].'</span>  </td>
          </tr>
          <tr>
          <td>7</td>
            <td>Chair</td>
            <td> <span class="text-bold chairshow">'.$fitments[0]['chair'].'</span>  </td>
            <td>16</td>
            <td>Water Purifier </td>
            <td><span class="text-bold purifiershow">'.$fitments[0]['purifier'].'</span>  </td>
          </tr>
          <tr>
          <td>8</td>
            <td>Cupboard</td>
            <td> <span class="text-bold cupboardshow">'.$fitments[0]['cupboard'].'</span>  </td>
            <td>17</td>
            <td>Mod Kitchen with trolleys</td>
            <td> <span class="text-bold kitchenshow">'.$fitments[0]['kitchen'].'</span>  </td>
          </tr>
          <tr>
            <td>9</td>
            <td>Air Conditioner</td>
            <td> <span class="text-bold acshow">'.$fitments[0]['ac'].'</span>  </td>
            <td>18</td>
            <td>Other</td>
            <td> <span class="text-bold othershow">'.$fitments[0]['other'].'</span>  </td>
          </tr>
        </tbody>
      </table>
      <p>IN WITNESS WHEREOF the parties hereto have set and subscribed their respective signatures by way of putting thumb impression electronic signature hereto in the presence of witness, who are identifying the executants, on the day, month and year first above written.</p>
  </div>';
  $mpdf = new \Mpdf\Mpdf(["mode" => "utf-8"]);
  $stylesheet = file_get_contents('pdf.css');
  $mpdf->setAutoTopMargin = "stretch";
  $mpdf->setAutoBottomMargin = "stretch";
  $mpdf->WriteHTML($stylesheet,1);
  $mpdf->WriteHTML($content);
  $mpdf->Output();
exit; ?>