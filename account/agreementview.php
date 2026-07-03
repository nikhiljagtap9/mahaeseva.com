 <?php $user = $_SESSION['reguser']; $userdata = selectQuery(WEB_USER,"*","u_id=".$user); $segment = $path_info['call_parts'][2]; $agree = base64_decode($segment); $orders = selectQuery(AGR,"*","agreement_no='".$agree."' and agree_by=".$user); ?>
<!doctype html>
<html lang="en">
<head>
    <title><?php echo SITE_TITLE; ?> | Agreement View</title>
    <?php include 'commoncss.php' ?>
</head>
<body class="bg-light">
<?php include 'menu.php' ?>
<div class="content py-4">
    <div class="container">
        <div class="row">
            <?php include('sidebar.php')?>
            <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                <?php if(count($orders)){
                $landlord = selectQuery(AGR_LANDLORD,"*","agreement_no='".$agree."'");
                $tenents = selectQuery(AGR_TENENT,"*","agreement_no='".$agree."'");
                $rent = selectQuery(AGR_RENT,"*","agreement_no='".$agree."'");
                $fitments = selectQuery(AGR_FITMENT,"*","agreement_no='".$agree."'"); ?>
                <div class="head d-md-flex justify-content-between align-items-center mb-3">
                    <h5 class="h6 mb-2 mb-md-0">Agreement - <?php echo $agree; ?> (<?php echo date("d M Y h:i a",strtotime($orders[0]['entry_on'])); ?>)</h5>
                    <div class="pb-2 pb-md-0"><a class="btn btn-primary btn-sm px-3" href="<?php echo SITEURL; ?>/account/pdfDownload.php?age=<?php echo base64_encode($agree); ?>" target="_blank">Create PDF</a> <button class="btn btn-dark btn-sm px-3" onclick="goBack()">Back</button></div>
                </div>
                <!--<div class="row"><div class="col-md-12"><a class="btn btn-primary pull-right" href="<?php echo SITEURL; ?>/account/pdfDownload.php?age=<?php echo base64_encode($agree); ?>" target="_blank">Create PDF</a></div> </div>-->            
                <div class="account_agricontent card card-body">
                    <h4 class="mb-3 text-center">LEAVE AND LICENSE AGREEMENT</h4>
                    <p>This agreement is made BETWEEN</p>
                    <div class="landlorddetails">
                        <?php for($i=0;$i<count($landlord);$i++){ ?>
                        <!--<p>Name : <span class="name fw-6 text-primary"><?php echo $landlord[$i]['landlord_name']; ?></span></p>-->
                        <p class="landlord current">Name : <span class="name fw-6 text-primary"><?php echo $landlord[$i]['landlord_name']; ?></span> Gender : <span class="gender gendershow fw-6 text-primary"><?php echo $landlord[$i]['landlord_gender']; ?></span> Age About : <span class="age fw-6 text-primary"><?php echo $landlord[$i]['landlord_age']; ?></span> Years, Occupation : <span class="occupation fw-6 text-primary"><?php echo $landlord[$i]['landlord_occupation']; ?></span> having Contact Number : <span class="mobile fw-6 text-primary"><?php echo $landlord[$i]['landlord_contact_no']; ?></span> PAN : <span class="pan fw-6 text-primary"><?php echo $landlord[$i]['landlord_pan_no']; ?></span> Aadhaar : <span class="aadhaar fw-6 text-primary"><?php echo $landlord[$i]['landlord_aadhaar_no']; ?></span> Email-Id : <span class="email fw-6 text-primary"><?php echo $landlord[$i]['landlord_email']; ?></span> Residing at : <span class="address fw-6 text-primary"><?php echo $landlord[$i]['landlord_address']; ?></span> Pincode : <span class="pincode fw-6 text-primary"><?php echo $landlord[$i]['landlord_address_pin']; ?></span></p>
                        <? } ?>
                    </div>
                    <p>HEREINAFTER called the 'LICENSOR' (which expression shall mean and include the Licensor above named and also his respective heirs, successors, assigns, executors and administrators)</p>
                    <div class="text-center"><p>AND</p></div>
                    <div class="tenentdetails">
                        <?php for($i=0;$i<count($tenents);$i++){ ?>
                        <p class="tenent">Name : <span class="name fw-6 text-primary"><?php echo $tenents[$i]['tenent_name']; ?></span> Gender : <span class="gender gendershow fw-6 text-primary"><?php echo $tenents[$i]['tenent_gender']; ?></span> Age About : <span class="age fw-6 text-primary"><?php echo $tenents[$i]['tenent_age']; ?></span> Years, Occupation : <span class="occupation fw-6 text-primary"><?php echo $tenents[$i]['tenent_occupation']; ?></span> having Contact Number : <span class="mobile fw-6 text-primary"><?php echo $tenents[$i]['tenent_contact_no']; ?></span> PAN : <span class="pan fw-6 text-primary"><?php echo $tenents[$i]['tenent_pan_no']; ?></span> Aadhaar : <span class="aadhaar fw-6 text-primary"><?php echo $tenents[$i]['tenent_aadhaar_no']; ?></span> Email-Id : <span class="email fw-6 text-primary"><?php echo $tenents[$i]['tenent_email']; ?></span> Residing at : <span class="address fw-6 text-primary"><?php echo $tenents[$i]['tenent_address']; ?></span> Pincode : <span class="pincode fw-6 text-primary"><?php echo $tenents[$i]['tenent_address_pin']; ?></span></p>
                        <? } ?>
                    </div>
                    <p>HEREINAFTER called the 'Licensee' (which expression shall mean and include only Licensee above named).</p>
                    <p>WHEREAS the Licensor is absolutely seized and possessed of and/or otherwise well and sufficiently entitled to all that constructed portion being unit described in Schedule I hereunder written and are hereafter for the sake of brevity called or referred to as Licensed Premises and is/are desirous of giving the said premises on Leave and License basis under Section 24 of the Maharashtra Rent Control Act, 1999.</p>
                    <p>AND WHEREAS the Licensee herein is/are in need of temporary premises for his/her/their <span class="fw-6 text-primary propertyuseshow"><?php echo $orders[0]['prop_use']; ?></span> use has/have approached the Licensor with a request to allow the Licensee/s herein to use and occupy the said premises on Leave and License basis for a period of <span class="fw-6 text-primary durationshow"><?php echo $orders[0]['duration']; ?></span> Months commencing from <span class="fw-6 text-primary startdateshow"><?php echo $orders[0]['starting_from']; ?></span> and ending on <span class="fw-6 text-primary enddateshow"><?php echo $orders[0]['end_to']; ?></span> on terms and subject to conditions hereafter appearing.</p>
                    <p>AND WHEREAS the Licensor have agreed to allow the Licensee herein to use and occupy the said Licensed premises for his aforesaid <span class="fw-6 text-primary propertyuseshow"><?php echo $orders[0]['prop_use']; ?></span> purposes only, on Leave and License basis for above mentioned period, on terms and subject to conditions hereafter appearing;</p>
                    <p>NOW THEREFORE IT IS HEREBY AGREED TO, DECLARED AND RECORDED BY AND BETWEEN THE PARTIES HERETO AS FOLLOWS :-</p>
                    <p><span class="fw-6">1. Period</span>: That the Licensor hereby grants to the Licensee herein a revocable leave and license, to occupy the Licensed Premises, described in Schedule I hereunder written without creating any tenancy rights or any other rights, title and interest in favour of the Licensee for a period of  <span class="fw-6 text-primary durationshow"><?php echo $orders[0]['duration']; ?></span>
                    Months commencing from  <span class="fw-6 text-primary startdateshow"><?php echo $orders[0]['starting_from']; ?></span> and ending on <span class="fw-6 text-primary enddateshow"><?php echo $orders[0]['end_to']; ?></span>.</p>
                    <p><span class="fw-6">2. License Fee & Deposit</span> : That the Licensee shall pay to the Licensor the following amount per month towards the compensation for the use of the said Licensed premises.</p>
                    <?php if($orders[0]['rent_type']=="Variable"){ ?>
                    <div class="variable">
                        <ol class="varrentshow">
                        <?php for($i=0;$i<count($rent);$i++){ ?>
                        <li class="varrentdetails1">Rs. <span class="fw-6 text-primary varrent varrentshow1"><?php echo $rent[$i]['rent']; ?></span> /- per month for the  <span class="fw-6 text-primary dura varrentmonthshow1"><?php echo $rent[$i]['duration']; ?></span> months</li>
                        <? } ?>
                        </ol>
                    </div>
                    <? } else{ ?>
                    <div class="fixed">Rs. <span class="fw-6 text-primary fixedrentshow"><?php echo $rent[0]['rent']; ?></span>  /- per month</div>
                    <? } ?>
                    <p>The amount of monthly compensation License fee shall be payable within first five days of the concerned month of Leave and License. Licensees shall also pay to the Licensor Rs.<span class="fw-6 text-primary"></span>/- interest free refundable deposit, for the use of the said Licensed premises.</p>
                    <p><span class="fw-6">3. Payment of Deposit</span> : That the Licensee have paid / shall pay the above mentioned deposit/premium as mentioned above by Cash. Amount Rs.<span class="fw-6 text-primary depositeshow"><?php echo $orders[0]['deposite']; ?></span>/-</p>
                    <p><span class="fw-6">4. Maintenance Charges</span> : That the Licensor herein shall bear and pay all the maintenance charges in respect of the said Licensed Premises, and other outgoings including all rates, taxes, levies, assessment, non occupancy charges, etc. in respect of the said premises.</p>
                    <p><span class="fw-6">5. Electricity Charges</span> : The licensee herein shall pay the electricity bills directly for energy consumed on the licensed premises and should submit original receipts to licensor indicating that the electricity bills are paid.</p>
                    <p><span class="fw-6">6. Use</span> : That the Licensed premises shall only be used by the Licensee for <span class="fw-6 text-primary propertyuseshow"><?php echo $orders[0]['prop_use']; ?></span> purpose. The Licensee shall maintain the said premises in its existing condition and damage, if any, caused to the said premises, the same shall be repaired by the Licensee at its own cost subject to normal wear and tear. The Licensee shall not do anything in the said premises which is or is likely to cause a nuisance to the other occupants of the said building or to the prejudice in any manner to the rights of Licensor in respect of said premises or shall not do any unlawful activities prohibited by State or Central Government.</p>
                    <p><span class="fw-6">7. Alteration</span> : That the Licensee shall not make or permit to do any alteration or addition to the construction or arrangements (internal or external) to the Licensed premises without previous consent in writing from the Licensor.</p>
                    <p><span class="fw-6">8. No Tenancy</span> : That the Licensee shall not claim any tenancy right and shall not have any right to transfer, assign, and sublet or grant any license or sub-license in respect of the Licensed Premises or any part thereof and also shall not mortgage or raise any loan against the said premises.</p>
                    <p><span class="fw-6">9. Inspection</span> : That, the Licensor shall on reasonable notice given by the Licensor to the Licensee shall have a right of access either by himself or through authorized representative to enter, view and inspect the Licensed premises at reasonable intervals.</p>
                    <p><span class="fw-6">10. Cancellation</span>: That, Subject to the condition of lock in period (if any), if the Licensee commits default in regular and punctual payments of monthly compensation as herein before mentioned or commit/s breach of any of the terms, covenants and conditions of this agreement or if any legislation prohibiting the Leave and License is imposed, the Licensor shall be entitled to revoke and / or cancel the License hereby granted, by giving notice in writing of one month and the Licensee too will have the right to vacate the said premises by giving a notice in writing of one month to the Licensor as mentioned earlier.</p>
                    <p><span class="fw-6">11. Possession</span>: That the immediately at on the expiration or termination or cancellation of this agreement the Licensee shall vacate the said premises without delay with all his goods and belongings. In the event of the Licensee failing and / or neglecting to remove himself and / or his articles from the said premises on expiry or sooner determination of this Agreement, the Licensor shall be entitled to recover damages at the rate of double the daily amount of compensation per day and or alternatively the Licensor shall be entitled to remove the Licensee and his belongings from the Licensed premises, without recourse to the Court of Law.</p>
                    <p><span class="fw-6">12. Furniture and Appliances</span> : The said premises is having the Furniture and Appliances mentioned in the Schedule II. The licensee shall maintain the said Furniture and Appliances in the said premises in its existing condition and damage, if any, caused to the said Furniture and Appliances, the same shall be repaired by the Licensee/s at its own cost subject to normal wear and tear.</p>
                    <p><span class="fw-6">13. Miscellaneous</span> : <span class="fw-6 text-primary miscshow"><?php echo $orders[0]['miscellaneous']; ?></span></p>
                    <p><span class="fw-6">14. Registration</span> : This Agreement is to be registered and the expenditure of Stamp duty and registration fees and incidental charges, if any, shall be borne by the</p>
                    <div class="text-center"><h4>SCHEDULE I</h4></div>
                    <p>premises (Being the correct description of <span class="fw-6 text-primary propertytypeshow"><?php echo $orders[0]['prop_type']; ?></span> which is the subject matter of these presents) All that constructed portion being residential unit bearing <span class="fw-6 text-primary propertyuseshow"><?php echo $orders[0]['prop_use']; ?></span> No. <span class="fw-6 text-primary floorshow"><?php echo $orders[0]['prop_floor_no']; ?></span> Built-up : <span class="fw-6 text-primary builtareashow"><?php echo $orders[0]['prop_area'] ?></span> Square Ft, situated on the <span class="fw-6 text-primary floorshow"><?php echo $orders[0]['prop_floor_no']; ?></span> Floor of a Building known as '<span class="fw-6 text-primary buildingnameshow"><?php echo $orders[0]['prop_building_name']; ?></span>' standing on the plot of land bearing Number <span class="fw-6 text-primary propnoshow"><?php echo $orders[0]['prop_no']; ?></span>, <span class="fw-6 text-primary roadshow"><?php echo $orders[0]['prop_road']; ?></span> Road, Locality - <span class="fw-6 text-primary localityshow"><?php echo $orders[0]['prop_locality']; ?></span> of Village - <span class="fw-6 text-primary villageshow"><?php echo $orders[0]['prop_village']; ?></span>, situated within the revenue limits of Tehsil - <span class="fw-6 text-primary tahsilshow"><?php echo $orders[0]['prop_tahsil']; ?></span> and Dist - <span class="fw-6 text-primary distshow"> <?php echo $orders[0]['prop_dist']; ?></span></p>
                    <p>IN WITNESS WHEREOF the parties hereto have set and subscribed their respective signatures by way of putting thumb impression electronic signature hereto in the presence of witness, who are identifying the executants, on the day, month and year first above written.</p>
                    <div class="text-center"><h4>SCHEDULE II</h4></div>
                    <p>(Being the correct description of Furniture and Appliances in the premise)</p>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-light"><tr><th>Sr No.</th><th>Item </th><th>Number of Units. </th><th>Sr No.</th><th>Item </th><th>Number of Units. </th></tr></thead>
                            <tbody>
                            <tr><td>1</td><td>Fan</td><td><span class="fw-6 text-primary fanshow"><?php echo $fitments[0]['fan']; ?></span></td><td>10</td><td>Electric Geezer</td><td><span class="fw-6 text-primary elegeezershow"><?php echo $fitments[0]['electric_geezer']; ?></span></td></tr>
                            <tr><td>2</td><td>Tube light</td><td><span class="fw-6 text-primary tbelightshow"><?php echo $fitments[0]['tubelight']; ?></span></td><td>11</td><td>Gas Geezer</td><td><span class="fw-6 text-primary gasgeezershow "><?php echo $fitments[0]['gas_geezer']; ?></span></td></tr>
                            <tr><td>3</td><td>Bulb</td><td><span class="fw-6 text-primary bulbshow"><?php echo $fitments[0]['bulb']; ?></span></td><td>12</td><td>Air Cooler</td><td><span class="fw-6 text-primary coolershow"><?php echo $fitments[0]['air_cooler']; ?></span></td></tr>
                            <tr><td>4</td><td>Bed</td><td><span class="fw-6 text-primary bedshow"><?php echo $fitments[0]['bed']; ?></span></td><td>13</td><td>Water Cooler</td><td><span class="fw-6 text-primary watercoolershow"><?php echo $fitments[0]['water_cooler']; ?></span></td></tr>
                            <tr><td>5</td><td>Sofa</td><td><span class="fw-6 text-primary sofashow"><?php echo $fitments[0]['sofa']; ?></span></td><td>14</td><td>Curtains</td><td><span class="fw-6 text-primary curtainsshow"><?php echo $fitments[0]['curtains']; ?></span></td></tr>
                            <tr><td>6</td><td>Table</td><td><span class="fw-6 text-primary tableshow"><?php echo $fitments[0]['table']; ?></span> </td><td>15</td><td>VDO Door Phone</td><td><span class="fw-6 text-primary VDOshow"><?php echo $fitments[0]['VDO_door_phone']; ?></span></td></tr>
                            <tr><td>7</td><td>Chair</td><td><span class="fw-6 text-primary chairshow"><?php echo $fitments[0]['chair']; ?></span> </td><td>16</td><td>Water Purifier</td><td><span class="fw-6 text-primary purifiershow"><?php echo $fitments[0]['purifier']; ?></span></td></tr>
                            <tr><td>8</td><td>Cupboard</td><td><span class="fw-6 text-primary cupboardshow"><?php echo $fitments[0]['cupboard']; ?></span></td><td>17</td><td>Mod Kitchen with trolleys</td><td><span class="fw-6 text-primary kitchenshow"><?php echo $fitments[0]['kitchen']; ?></span></td></tr>
                            <tr><td>9</td><td>Air Conditioner</td><td><span class="fw-6 text-primary acshow"><?php echo $fitments[0]['ac']; ?></span></td><td>18</td><td>Other</td><td><span class="fw-6 text-primary othershow"><?php echo $fitments[0]['other']; ?></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="mb-0">IN WITNESS WHEREOF the parties hereto have set and subscribed their respective signatures by way of putting thumb impression electronic signature hereto in the presence of witness, who are identifying the executants, on the day, month and year first above written.</p>
                </div>
            <? } else{ echo "Invalid Request"; } ?>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>
</body>
</html>