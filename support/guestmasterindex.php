<?php include('menu.php');

  $lead=base64_decode($_REQUEST['lead']);
 /*$leadno=selectQuery(CONTACT,"internal_lead_id","internal_lead_id='."$lead".'");     */
   $guestcount=selectQuery(GUEST,"*","leads like '%".$lead."%'");
?>
<div class="content">
    <div class="container">
     <div class="row">
            <div class="col-md-12">
            <div class="pull-left">
                <div class="form-group">
                      <div class="input-group">
                         <h4>Lead No - <?php echo $lead; ?></h4>

                      </div>
                </div>
            </div>
            <div class="pull-right list-view"> <div class="form-group"><a href="<?php echo SITEURL; ?>/support/guestmaster.php?lead=<?php echo $_REQUEST['lead']; ?>" class="btn btn-success pull-right">Add New Guest</a> </div></div>
            </div> </div>
        <div class="row">
            <div class="col-md-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                      <tr>
                        <th>Guest No</th>
                        <th>Guest Name</th>
                        <th>Mobile</th>
                        <th>Passport No</th>
                         <th>Is Passport Valid</th>
                        <th>Remove From Lead</th>
                      </tr>
                    </thead>
                    <tbody class="text-muted">
                      <?php
                       if(count($guestcount))
                       {
                           for($i=0;$i<count($guestcount);$i++)
                           {

                           ?>
                             <tr class="g<?php echo $guestcount[$i]['system_guest_id']; ?>">
                               <td><a href="guestdetails.php?guest=<?php echo base64_encode($guestcount[$i]['system_guest_id']); ?>" target="_blank"><?php echo $guestcount[$i]['system_guest_id']; ?></a></td>
                               <td><?php echo $guestcount[$i]['fname']." ".$guestcount[$i]['lname']; ?></td>
                               <td><?php echo $guestcount[$i]['mobile']; ?></td>
                                <td><?php if($guestcount[$i]['passport_no']!=""){echo $guestcount[$i]['passport_no'];}else{ echo "[Not Defined]";} ?></td>
                                <td><?php
                                    if($guestcount[$i]['passport_expiry_date']!="")
                                    {
                                        $expiry=$guestcount[$i]['passport_expiry_date'];

                                        if($expiry<date("Y-m-d"))
                                        {
                                           echo "<span style='color:#CC1C2B'><i class='fa fa-times-circle-o'></i> Expired</span>";
                                        }
                                        else
                                        {
                                             $date1 =time();
                                            $date2 = strtotime($expiry);
                                            $difference = $date2 - $date1;

                                            $days = floor($difference / (60*60*24) );

                                             if($days>180)
                                             {
                                                 echo "<span style='color:#1CCC4E'><i class='fa fa-check-circle-o'></i> Valid</span>";
                                             }
                                             else
                                             {
                                                 echo "<span style='color:#AC9C0B'><i class='fa fa-exclamation-circle'></i> Expiring Soon</span>";
                                             }
                                        }
                                    }
                                    else
                                    {
                                        echo "[Not Defined]";
                                    } ?>
                                    </td>
                                <td><button class="btn btn-link" onclick="removefromlead('<?php echo $guestcount[$i]['system_guest_id']; ?>','<?php echo $lead; ?>','g<?php echo $guestcount[$i]['system_guest_id']; ?>')">Remove From Lead</button></td>
                             </tr>
                           <?

                           }
                       }
                       else
                       {
                           ?>
                              <tr>
                               <td colspan="3">No Guest Found For This Lead</td>
                             </tr>
                           <?
                       }
                      ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  function removefromlead(guest,lead,trclass)
    {
        if(confirm("Are You Really Want To Remove ?"))
        {
              var info={guestid:guest,lead:lead,action:"removefromlead"};
              $.ajax({
                    type:"POST",
                    url:"guest_entry.php",
                    data:info,
                    success:function(response){
                        if(response==1)
                        {
                             $("."+trclass).hide();
                        }
                        else
                        {

                        }

                   }
              });
        }

    }
</script>
<?php include('footer.php'); ?>