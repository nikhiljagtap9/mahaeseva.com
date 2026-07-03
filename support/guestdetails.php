<?php include('menu.php');

  $guest=base64_decode($_REQUEST['guest']);

   $guestcount=selectQuery(GUEST,"*","system_guest_id ='".$guest."'");
    $guestdoc=selectQuery(GUESTDOC,"*","guest_id ='".$guest."' and del = '0'");
?>
<div class="content">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
        <div class="pull-left">
                <div class="form-group">
                      <div class="input-group">
                         <h4>Guest No - <?php echo $guest; ?></h4>
                         <h4>Connected To -
                            <?php
                                $leads = $guestcount[0]['leads'];

                                $leadlist = explode(",",$leads);

                                for($i=0;$i<count($leadlist);$i++)
                                {
                                    if($i===0)
                                    {
                                    ?>
                                        <a href="requestdetails.php?req=<?php echo base64_encode($leadlist[$i]); ?>" target="_blank"> <?php echo $leadlist[$i]; ?> </a>

                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        ,<a href="requestdetails.php?req=<?php echo base64_encode($leadlist[$i]); ?>" target="_blank"> <?php echo $leadlist[$i]; ?> </a>
                                    <?php
                                    }
                                }
                         ?></h4>
                      </div>
                </div>
            </div>
            <div class='pull-right'>
              <? if($loginstaff[0]['edit_guest']=="1"){ ?>
              <a href="editguest.php?guest=<?php echo $_REQUEST['guest']; ?>" class="btn btn-success">Edit</a>
               <?php } ?>
                 <?php
                if($loginstaff[0]['delete_guest']=="1")
                {
                 ?>
                   <button type="button" class="btn btnPrimary  " onclick="delguest('<?php echo $_REQUEST['guest']; ?>')"> Delete Guest </button>
                 <?
                }
                ?>
            </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 guestDetails">
                <div class="card">
                        <div class="panel-heading"><div class="panel-title">Profile</div></div>
                            <div class="panel-body">
                            <div class="row">
                                <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-5 list-view"> <b>Name</b> </div>
                                   <div class="col-md-7 text-muted list-view"> <?php echo $guestcount[0]['title']." ".$guestcount[0]['fname']."  ".$guestcount[0]['mname']."  ".$guestcount[0]['lname']; ?></div>
                                   </div>
                                </div>
                                <div class="col-md-5 col-sm-6">
                                <div class="row">
                                    <div class="col-md-5 list-view"><b>Company / Group Name</b></div>
                                    <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['company_or_group_name']!=""){echo $guestcount[0]['company_or_group_name'];}else{ echo "[Not Defined]"; } ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-sm-6">
                                  <div class="row">
                                    <div class="col-md-5 list-view"><b>Mobile</b></div>
                                     <div class="col-md-7 text-muted list-view"><?php  if($guestcount[0]['mobile']!=""){ echo $guestcount[0]['mobile'];}else{ echo "[Not Defined]"; } ?></div>
                                  </div>
                                </div>
                                <div class="col-md-5 col-sm-6">
                                  <div class="row">
                                    <div class="col-md-5 list-view"><b>Email</b></div>
                                     <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['email']!=""){ echo $guestcount[0]['email'];}else{ echo "[Not Defined]"; } ?></div>
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-sm-6">
                                  <div class="row">
                                    <div class="col-md-5 list-view"><b>Nationality</b></div>
                                     <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['nationality']!=""){ echo $guestcount[0]['nationality'];}else{ echo "[Not Defined]"; } ?></div>
                                  </div>
                                </div>
                                <div class="col-md-5 col-sm-6">
                                  <div class="row">
                                    <div class="col-md-5 list-view"><b>Date of Birth</b></div>
                                    <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['date_of_birth']!=""){ echo date('d-m-Y', strtotime($guestcount[0]['date_of_birth'])); ;}else{ echo "[Not Defined]"; } ?></div>
                                  </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-5 col-sm-6">
                                  <div class="row">
                                    <div class="col-md-5 list-view"><b>Marrital Status</b> </div>
                                    <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['marrital_status']!=""&&$guestcount[0]['marrital_status']!="undefined"){ echo $guestcount[0]['marrital_status'];}else{ echo "[Not Defined]"; } ?></div>
                                  </div>
                                </div>
                                <div class="col-md-5 col-sm-6">
                                  <div class="row">
                                    <div class="col-md-5 list-view"><b>Marriage Date</b> </div>
                                    <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['marriage_date']!=""){ echo date('d-m-Y', strtotime($guestcount[0]['marriage_date'])); ;}else{ echo "[Not Defined]"; } ?></div>
                                  </div>
                                </div>
                            </div>
                            </div>
                </div>
                 <div class="card">
                     <div class="panel-heading"><div class="panel-title">Passport Details</div></div>
                    <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-6">
                          <div class="row">
                            <div class="col-md-5 list-view"><b>Passport No</b></div>
                            <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['passport_no']!=""){ echo $guestcount[0]['passport_no'];}else{ echo "[Not Defined]"; } ?></div>
                          </div>
                        </div>
                        <div class="col-md-5 col-sm-6">
                          <div class="row">
                            <div class="col-md-5 list-view"><b>Date of Passport Issue</b></div>
                            <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['passport_issue_date']!=""){ echo date('d-m-Y', strtotime($guestcount[0]['passport_issue_date'])); ;}else{ echo "[Not Defined]"; } ?></div>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-sm-6">
                          <div class="row">
                            <div class="col-md-5 list-view"><b>Date of Passport Expiry</b></div>
                             <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['passport_expiry_date']!=""){ echo date('d-m-Y', strtotime($guestcount[0]['passport_expiry_date'])); ;}else{ echo "[Not Defined]"; } ?></div>
                          </div>
                        </div>
                        <div class="col-md-5 col-sm-6">
                          <div class="row">
                            <div class="col-md-5 list-view"><b>Place of Passport Issue</b></div>
                             <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['passport_issue_place']!=""){ echo $guestcount[0]['passport_issue_place'];}else{ echo "[Not Defined]"; } ?></div>
                          </div>
                        </div>
                    </div>

                      <div class="row">
                         <div class="col-md-5 col-sm-6">
                          <div class="row">
                            <div class="col-md-5 list-view"><b>No of empty Passport pages</b></div>
                            <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['passport_empty_pages']!=""){ echo $guestcount[0]['passport_empty_pages'];}else{ echo "[Not Defined]"; } ?></div>
                          </div>
                        </div>
                    </div>
                    </div>
                 </div>
                 <div class="card">
                            <div class="panel-heading"><div class="panel-title">Visa Details</div></div>
                            <div class="panel-body">
                            <div class="row">
                                <div class="col-md-5 col-sm-6">
                                  <div class="row">
                                    <div class="col-md-5 list-view"><b>Valid visa1</b></div>
                                    <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['valid_visa1']!=""){ echo $guestcount[0]['valid_visa1'];}else{ echo "[Not Defined]"; } ?></div>
                                  </div>
                                </div>
                                <div class="col-md-5 col-sm-6">
                                  <div class="row">
                                    <div class="col-md-5 list-view"><b>Valid visa2</b></div>
                                    <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['valid_visa2']!=""){ echo $guestcount[0]['valid_visa2'];}else{ echo "[Not Defined]"; } ?></div>
                                  </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-5 col-sm-6">
                                  <div class="row">
                                    <div class="col-md-5 list-view"><b>FFN</b></div>
                                    <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['ffn']!=""){ echo $guestcount[0]['ffn'];}else{ echo "[Not Defined]"; } ?></div>
                                  </div>
                                </div>
                            </div>
                             </div>
                 </div>
                 <div class="card">
                    <div class="panel-heading"><div class="panel-title">Travel Preference</div></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5 col-sm-6">
                              <div class="row">
                                <div class="col-md-5 list-view"><b>Meal Preference</b></div>
                                <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['meal_preference']!=""){ echo $guestcount[0]['meal_preference'];}else{ echo "[Not Defined]"; } ?></div>
                              </div>
                            </div>
                            <div class="col-md-5 col-sm-6">
                              <div class="row">
                                <div class="col-md-5 list-view"><b>Insurance Nominee</b></div>
                                <div class="col-md-7 text-muted list-view"><?php if($guestcount[0]['insurance_nominee']!=""){ echo $guestcount[0]['insurance_nominee'];}else{ echo "[Not Defined]"; } ?></div>
                              </div>
                            </div>
                        </div>
                    </div>
                 </div>
                  <div class="card">
                    <div class="panel-heading"><div class="panel-title">Important Identification</div></div>
                        <div class="panel-body">

                                <div class="row">
                                   <?php
                                    for($i=0;$i<count($guestdoc);$i++)
                                    {
                                    ?>
                                    <div class="col-md-2">
                                        <div class="row">
                                            <div class="col-md-12  text-center"><h5><?php echo $guestdoc[$i]['document_name']; ?></h5> </div>
                                            <div class="col-md-12 text-center"><div class="proofThumb exchimage" onclick="showmodel('<?php echo $i; ?>')"><img src="<?php echo SITEURL; ?>/img/guest_doc/<? if( $guestdoc[$i]['docimg'] != ""){ echo $guestdoc[$i]['docimg'];} else {echo "uploadimg.jpg"; } ?>" alt="" class="img img-responsive  img-thumbnail"/></div></div>
                                        </div>
                                    </div>
                                    <?
                                    }
                                    ?>
                                </div>

                            <!-- Modal -->
                            <div class="modal fade" id="thumbOpen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner" role="listbox">
                                                <?php
                                                    for($i=0;$i<count($guestdoc);$i++)
                                                    {
                                                    ?>
                                                    <div class="item item<?php echo $i; ?>">
                                                        <img src="<?php echo SITEURL; ?>/img/guest_doc/<? if( $guestdoc[$i]['docimg'] != ""){ echo $guestdoc[$i]['docimg'];} else {echo "uploadimg.jpg"; } ?>" alt="" class="img img-responsive imagepreview img-thumbnail"/>
                                                    </div>
                                                    <?
                                                    }
                                                    ?>
                                                </div>
                                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                    <span class="fa fa-arrow-circle-left icon-prev" aria-hidden="true"></span>


                                                </a>
                                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                    <i class="fa fa-arrow-circle-right icon-next" aria-hidden="true"></i>


                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script>

function delguest(guestid)
{
    info={guestid:guestid,action:"del_guest"}
    $.ajax({
        type:"POST",
        url:"guest_entry.php",
        data:info,
        success:function(response){
             if(response==1)
             {
                 window.location="<?php echo SUPPORTURL; ?>guestlist.php";
             }
             else
             {
                 alert("Error In Delete")
             }
            }
    });
}
 function showmodel(ival)
 {
       $('.item').removeClass('active');
     $('.item'+ival).addClass('active');

	 $('#thumbOpen').modal('show');
 }
/*$(function() {
        $('.item:first').addClass('active');
		$('.exchimage').on('click', function() {
			$('.imagepreview').attr('src', $(this).find('img').attr('src'));
             $(this).find('.item').addClass('active');
			$('#thumbOpen').modal('show');
		});
});*/
</script>
<?php include('footer.php'); ?>


