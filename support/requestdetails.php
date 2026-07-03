<?php include("../includes/configuration.php"); ?>
<!doctype html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo SITENAME; ?> Support</title>
<?php include 'commoncss.php';?>
<style>
      .fa-check-circle
      {
          color:green;
      }
       .fa-exclamation-circle
       {
          color:red;
       }
       .externalthreads
       {
           display:none;
       }
       .headex
       {
          background:#7ECC51 !important;
          cursor:pointer;
       }
       .headinternal
       {
           background:#4697CC !important;
           cursor:pointer;
       }
       .closestatusdiv, .displaynone{
           display: none;
       }

     </style>
</head>
<body class="mainbody">
<?php include('menu.php');

     $req=base64_decode($_REQUEST['req']);

      $ticketdetails=selectQuery(CONTACT,"*","contact_request_id=".$req);

      $comments=selectQuery(SUPPORTCOMMENT,"*","ticket_id=".$req." and comment_type='Internal' order by comment_id ASC");
      $externalcomments=selectQuery(SUPPORTCOMMENT,"*","ticket_id=".$req." and comment_type='External' order by comment_id ASC");
      $lastresponse=selectQuery(SUPPORTCOMMENT,"*","ticket_id=".$req." order by comment_id DESC LIMIT 1");
      $getdeptname=selectQuery(SUPPORTDEPT,"*","dept_id=".$ticketdetails[0]['dept']);
      $assignedstaff=selectQuery(SUPPORTSTAFF,"*","emp_id=".$ticketdetails[0]['assign_to']);
      if($ticketdetails[0]['entry_by']!="Client")
      {
           $entry_by=selectQuery(SUPPORTSTAFF,"*","emp_id=".$ticketdetails[0]['entry_by']);
           $creator_name=$entry_by[0]['emp_name'];
      }
      else
      {
         $creator_name="Client";
      }


    $supportstaffgroup = selectQuery(SUPPORTSTAFFGROUP,"*");

       if($allowedimgtypes!=""&&$allowedapptypes!="")
       {
           $allowed= $allowedimgtypes.",".$allowedapptypes;
       }
       else if($allowedimgtypes!=""&&$allowedapptypes=="")
       {
           $allowed= $allowedimgtypes;
       }
       else if($allowedimgtypes==""&&$allowedapptypes!="")
       {
           $allowed= $allowedapptypes;
       }
        else if($allowedimgtypes==""&&$allowedapptypes=="")
       {
           $allowed= "";
       }
       $transfer=$loginstaff[0]['Transfer'];

     ?>

<div class="content">
     <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1  col-sm-12 col-xs-12">
              <div class="card">
                <div class="panel-body">
                <div class="pull-left reply"><h4>
                <?php

                    $getacctype = selectQuery(SUPPORTSTAFF,"*","emp_id='".$ticketdetails[0]['entry_by']."' ");

                  if($ticketdetails[0]['request_type']=="External")
                    {
                        $fontawesome ="<i class='fa fa-copyright' aria-hidden='true' style='color:#CC0066;'></i>";
                    }
                    else
                    {
                       $fontawesome='<i class="fa fa-info-circle" aria-hidden="true" style="color:#30CC36;"></i>';
                    }
                ?>

                Case #  <?php echo $fontawesome." ".$req; ?> </h4>

                </div>
                <div class="pull-right">
                     <?php
                            if($loginstaff[0]['Delete1']=="1")
                            {
                             ?>
                               <button type="button" class="btn btnPrimary rightBtn " onclick="dellead('<?php echo $req; ?>')"> Delete Case </button>
                             <?
                            }
                            ?>
                    <?php  if($loginstaff[0]['Edit']=="1") {?>
                    <a href="lead_update.php?lead=<?php echo base64_encode($req); ?>" class="btn btnPrimary rightBtn" > EDIT </a>
                    <?php }?>
                    <button type="button" class="btn btnPrimary rightBtn" onclick="goBack()"> BACK  </button>

                </div>
                 </div>
                 </div>

               </div>

            <div class="col-md-10 col-md-offset-1  col-sm-12 col-xs-12">
              <?php
                if($ticketdetails[0]['isOverdue']==1)
                {
                   ?>

                       <div class="overduebox alert alert-danger">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Ticket Marked As Overdue
                     </div>


                   <?
                }
                 ?>
            <div class="card">
            <div class="panel-body">
            <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                     <table class="table ticketStatus">
                        <!--<tr>
                           <td class="detail borderTop0"><b>Client Name</b></td>
                           <td class="detail mute-text borderTop0"><?php if($ticketdetails[0]['client_name']){echo $ticketdetails[0]['client_name'];}else{ echo "-"; } ?></td>
                        </tr>-->
                        <tr>
                           <td class="detail borderTop0"><b>Creator Name</b></td>
                           <td class="detail mute-text borderTop0"><?php echo $creator_name; ?></td>
                        </tr>
                        <tr>
                            <td class="detail " style="width:44%;"><b>Status</b></td>
                            <td class="detail mute-text ">
                            <?php
                                if($ticketdetails[0]['isOpen']=="1")
                                {
                                    echo "Open";
                                }
                                else if($ticketdetails[0]['isAnswered']=="1")
                                {
                                    echo "Answered";
                                }
                                 else if($ticketdetails[0]['isClosed']=="1")
                                {
                                    echo "Closed";
                                }
                                 else if($ticketdetails[0]['isConfirmed']=="1")
                                {
                                    echo "Confirm";
                                }
                                 else if($ticketdetails[0]['isTerminated']=="1")
                                {
                                    echo "Terminated";
                                }
                                else if($ticketdetails[0]['isReopen']=="1")
                                {
                                    echo "Reopen";
                                }
                            ?>
                            </td>
                         </tr>

                          <tr>
                              <td class="detail"><b>Created Date</b></td>
                            <td class="detail mute-text"><?php echo date('d/m/Y H:i:s', strtotime($ticketdetails[0]['date'])); ?></td>
                          </tr>

                           <tr>
                              <td class="detail"><b>Last Response</b></td>
                            <td class="detail mute-text"><?php if($lastresponse[0]['comment_date']){echo $lastresponse[0]['comment_date'];}else{ echo "-"; } ?></td>
                          </tr>
                          <?php
                           if($ticketdetails[0]['isClosed']=="1")
                           {
                                ?>
                                <tr>
                                  <td class="detail"><b>Closed On</b></td>
                                <td class="detail mute-text"><?php echo date('d/m/Y H:i:s', strtotime($ticketdetails[0]['closedDate'])); ?></td>
                              </tr>
                                <?
                           }
                           ?>
                           <?php
                                if($_SESSION['acc_type']=="Admin" || $_SESSION['acc_type']=="Staff")
                                {
                            ?>
                                <tr>
                                    <td class="detail"><b>Assigned Staff</b></td>
                                    <td class="detail mute-text"><?php echo $assignedstaff[0]['emp_name']; ?></td>
                                </tr>
                                <tr>
                                    <td class="detail"><b>Department</b></td>
                                    <td class="detail mute-text"><?php echo $getdeptname[0]['dept_name']; ?></td>
                                </tr>

                            <?}?>
                     </table>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                        <table class="table ticketStatus">
                            <tr>
                                <td class="detail borderTop0" style="width:44%;"><b>Name</b></td>
                                <td class="detail mute-text borderTop0"><?php if($ticketdetails[0]['Name']!=""){ echo $ticketdetails[0]['Name'];}else{ echo "Not Defined"; }  ?></td>
                            </tr>
                            <tr>
                               <td class="detail"><b>Email</b></td>
                               <td class="detail mute-text"> <?php if($ticketdetails[0]['Email']!=""){ echo $ticketdetails[0]['Email'];}else{ echo "Not Defined"; } ?></td>
                            </tr>
                            <tr>
                                <td class="detail"><b>Mobile</b></td>
                                <td class="detail mute-text"><?php if($ticketdetails[0]['Telephone']!=""){ echo $ticketdetails[0]['Telephone'];}else{ echo "Not Defined"; } ?></td>
                            </tr>
                            <tr>
                                <td class="detail"><b>Comment</b></td>
                                <td class="detail mute-text"><?php if($ticketdetails[0]['Comment']!=""){ echo $ticketdetails[0]['Comment'];}else{ echo "Not Defined"; } ?></td>
                            </tr>

                        </table>
                </div>
                </div>
                </div>
    </div>


        <!--************************ ************************************Internal comments start************************* ************************************-->
       <?php
        if($_SESSION['acc_type']=="Admin" || $_SESSION['acc_type']=="Staff")
        {
            ?>

        <div class="card">
            <div class="panel-heading headinternal">
                <div class="panel-title" onclick="showthreads('internalthreads','externalthreads')">Internal Communication (<?php echo count($comments); ?>)</div>
            </div>
             <div class="panel-body internalthreads" >

                <!--<div class="row">
                    <button class="btn btn-link" onclick="showthreads('internalthreads','externalthreads')"><b><i class="fa fa-sticky-note-o" aria-hidden="true"></i> Internal Communication (<?php echo count($comments); ?>)</b> </button>
                </div>-->

                <div class="">


                        <?php
                      for($i=0;$i<count($comments);$i++)
                      {
                           $attachment=selectQuery(SUPPORTIMG,"*","response_id=".$comments[$i]['comment_id']);
                           if($comments[$i]['comment_by']!="client")
                          {
                              $commentby=selectQuery(SUPPORTSTAFF,"*","emp_id=".$comments[$i]['comment_by']);
                              $commenter=$commentby[0]['emp_name'];

                          }
                          else
                          {
                              $commenter= $ticketdetails[0]['Name'];
                          }
                        ?>

                            <div class="list-view">
                                   <?php
                                      if($comments[$i]['comment_by']!="client")
                                      {
                                         ?>
                                        <div class="bg-success">
                                         <?
                                      }
                                      else
                                      {
                                        ?>
                                            <div class="bg-info">
                                        <?
                                        }
                                        ?>
                                        <?php echo $comments[$i]['comment_date']." - ".$commenter. " - ".$comments[$i]['extra']; ?>
                                            </div>
                                        <?php

                                            if(count($attachment))
                                            {
                                            ?>
                                                <div class="attachbox">
                                                    <?php
                                                      for($a=0;$a<count($attachment);$a++)
                                                      {
                                                          ?>
                                                          <span><a href="<?php echo SITEURL; ?>/img/support_tkt_comments/<?php echo $attachment[$a]['img_name']; ?>" target="_blank">
                                                           Attachment-<?php echo $a+1; ?>
                                                          </a>
                                                          </span>
                                                          <?
                                                      }
                                                    ?>
                                                     </div>
                                                   <?
                                            }
                                            ?>
                                              <div class="commentbox">
                                                <?php echo $comments[$i]['comment']; ?>
                                              </div>
                                        </div>
                                    <?
                                  }
                                ?>
                            </div>

             </div>
       </div>
     </div>

      <?php }?>
     <!-- **************************************************************************************************************************************** -->

     <!--****************************************** External communication start ********************************************************-->

     <div class="col-md-10 col-md-offset-1  col-sm-12 col-xs-12">
        <div class="card">
            <div class="panel-heading headex">
                <div class="panel-title" onclick="showthreads('externalthreads','internalthreads')">Client Communication (<?php echo count($externalcomments); ?>)</div>
            </div>
             <div class="panel-body externalthreads" >

                <!--<div class="row">
                    <button class="btn btn-link" onclick="showthreads('internalthreads','externalthreads')"><b><i class="fa fa-sticky-note-o" aria-hidden="true"></i> Internal Communication (<?php echo count($comments); ?>)</b> </button>
                </div>-->
                <div class="">

                      <!-- ************************************External comments start************************* -->
                          <?php
                      for($i=0;$i<count($externalcomments);$i++)
                      {
                           $attachment=selectQuery(SUPPORTIMG,"*","response_id=".$externalcomments[$i]['comment_id']);
                           if($externalcomments[$i]['comment_by']!="client")
                          {
                              $commentby=selectQuery(SUPPORTSTAFF,"*","emp_id=".$externalcomments[$i]['comment_by']);
                              $commenter=$commentby[0]['emp_name'];

                          }
                          else
                          {
                              $commenter= $ticketdetails[0]['Name'];
                          }
                        ?>

                            <div class="list-view">
                                   <?php
                                      if($externalcomments[$i]['comment_by']!="client")
                                      {
                                         ?>
                                             <div class="bg-success">
                                         <?
                                      }
                                      else
                                      {
                                         ?>
                                             <div class="bg-info">
                                         <?
                                      }
                                    ?>
                                         <?php echo $externalcomments[$i]['comment_date']." - ".$commenter. " - ".$externalcomments[$i]['extra']; ?>
                                        </div>
                                   <?php

                                    if(count($attachment))
                                    {
                                       ?>
                                         <div class="attachbox">


                                                 <?php
                                                  for($a=0;$a<count($attachment);$a++)
                                                  {
                                                      ?>
                                                      <span><a href="<?php echo SITEURL; ?>/img/support_tkt_comments/<?php echo $attachment[$a]['img_name']; ?>" target="_blank">
                                                       Attachment-<?php echo $a+1; ?>
                                                      </a>
                                                      </span>
                                                      <?
                                                  }
                                                ?>


                                         </div>
                                       <?
                                    }
                                  ?>
                                  <div class="commentbox">
                                    <?php echo $externalcomments[$i]['comment']; ?>
                                  </div>
                            </div>
                        <?
                      }
                    ?>
                    </div>
                </div>
       </div>
     </div>
     </div>

     <!-- ********************************************************************************************************************************************************* -->
    <div class="row">
    <div class="col-md-10 col-md-offset-1  col-sm-12 col-xs-12">
     <div class="card">
        <div class="panel-heading"><div class="panel-title">Post Your Reply</div></div>
         <div class="panel-body">
             <div>
             <div class="clearfix"></div>
             <div class="errormsg col-md-12"></div>
             </div>
             <div>
               <form action="" name="reply" method="post" enctype="multipart/form-data">
              <div class="form-group">
            <?php
                if($_SESSION['acc_type']=="Client")
                {
            ?>
              <div class="hideoption" style="display:none;">
              <input type="radio" name="postoption" class="postoption" value="Internal" /> Internal Reply&nbsp;&nbsp;
              <input type="radio" name="postoption" class="postoption" value="Post Reply" checked/> Post Reply To Client&nbsp;&nbsp;
              </div>
            <?}
              else
              {
            ?>
              <input type="radio" name="postoption" class="postoption" value="Internal" checked/> Internal Reply&nbsp;&nbsp;
              <input type="radio" name="postoption" class="postoption" value="Post Reply" /> Post Reply To Client&nbsp;&nbsp;
            <?php } ?>
              <span <? if($transfer=="0"){ ?> style="display:none" <? } ?>><input type="radio" name="postoption" class="postoption" value="Transfer Ticket" /> Transfer Ticket</span>&nbsp;&nbsp;
              <span <? if($transfer=="0"){ ?> style="display:none" <? } ?>><input type="radio" name="postoption" class="postoption" value="Reassign Ticket"/> Reassign Ticket</span>
             </div>
              <div class="form-group transfertodept">
                <?php
                  $dept=selectQuery(SUPPORTDEPT,"*","isDel='0' and isActive='1' and dept_id<>".$ticketdetails[0]['dept']);
                ?>
                  Transfer To -
                  <select name="chngdept" class="chngdept">
                    <option value=""> - Transfer to department - </option>
                    <?php
                       for($i=0;$i<count($dept);$i++)
                       {
                          ?>
                           <option value="<?php echo $dept[$i]['dept_id']; ?>"><?php echo $dept[$i]['dept_name']; ?> </option>
                          <?
                       }
                    ?>
                  </select>
              </div>
                <div class="form-group reassigntkt">
                <?php
                  $staff=selectQuery(SUPPORTSTAFF,"*","acc_type='Admin' || acc_type='Staff' and isActive='1' order by emp_name ASC");
                ?>
                  Assign To -
                  <select name="assignto" class="assignto">
                    <option value=""> - Reassign - </option>
                     <?php
                       for($i=0;$i<count($staff);$i++)
                       {
                           if($assignedstaff[0]['emp_id']!=$staff[$i]['emp_id'])
                           {
                               ?>
                                    <option value="<?php echo $staff[$i]['emp_id']; ?>"><?php echo $staff[$i]['emp_name']; ?> </option>
                               <?
                           }
                          ?>

                          <?
                       }
                    ?>
                  </select>
              </div>

             <div class="form-group">
                    <input type="hidden" name="staff"  id="staff" value="<?php echo  $_SESSION['staff']; ?>"/>
                     <input type="hidden" name="requestid"  id="requestid" value="<?php echo $req; ?>"/>
                      <input type="hidden" name="allowedimgformat"  id="allowedimgformat" value="<?php echo $allowedimgtypes; ?>"/>
                       <input type="hidden" name="allowedappformat"  id="allowedappformat" value="<?php echo $allowedapptypes; ?>"/>
                       <input type="hidden" name="allowedmaxsize"  id="allowedmaxsize" value="<?php echo $attachmentmax; ?>"/>
                     <textarea class="summernote" id="editor1"  name="text_details" style="width:100%;min-height:200px !important"></textarea>
             </div>
              <div class="form-group">
              <span>Attach File (Allowed Type: <?php echo $allowed; ?> || Max File Size : <?php echo ($attachmentmax/1024)/1024; ?> MB)</span>
              <input type="file" name="attach" id="attach" onchange="validateimg('attach')"/>
             </div>
              <div class="imgloader"></div>
          <!--   <?php
              if($ticketdetails[0]['isClosed']=="1")
               {
                      ?>-->
                        <div class="form-group">
                         <input type="checkbox" name="reopentkt" class="reopentkt" <? if($ticketdetails[0]['isClosed']=="0"){?> style="display:none;" <?} ?> <? if($loginstaff[0]['Close']=="0"){?> style="display:none"; <? } ?>/> <? if($loginstaff[0]['Close']=="1"){?> Re-open On Reply <?php } ?>
                     </div>
                   <!--   <?
               }
               else
               {
                   ?>-->
                   <div class="row">
                    <div class="col-md-12 col-sm-6 form-horizontal">
                     <div class="form-group col-sm-3" >
                         <input type="checkbox" name="closetkt" class="closetkt" <? if($ticketdetails[0]['isClosed']=="1"){?> style="display:none;" <?} ?> <? if($loginstaff[0]['Close']=="0"){?> style="display:none"; <? } ?>/> <? if($loginstaff[0]['Close']=="1"){?> Close On Reply <?php } ?>
                     </div>

                                    <div class=" closestatusdiv col-sm-9">

                                    <input type="radio" name="closesatus"  class="closesatus" value="Dead" > Dead  &nbsp;&nbsp;

                                    <input type="radio" name="closesatus" class="closesatus" value="Converted"> Converted <br>

                                    </div>
                  </div>

                         <div class="col-md-12 col-sm-12 form-horizontal displaynone">

                                    <div class="form-group">

                                    <label class=" control-label lb1  col-sm-3">Lost Reason</label>

                                     <div class="col-sm-9">

                                          <select name="lostreason" id="lostreason" class="form-control" onchange="checkreason('lostreason')"  >

                                             <option value="">- Select Lost Reason -</option>

                                          <option value="addnewreason">- Add new Reason -</option>

                               <?php

                                $lostreason=selectQuery(lost_reason,"*","isActive = '1' and isDel = '0'");

                                   for($i=0;$i<count($lostreason);$i++)

                                {

                                   ?>

                                        <option value="<?php echo $lostreason[$i]['id']; ?>"><?php echo $lostreason[$i]['lost_reason']; ?> </option>

                                   <?

                                }

                               ?>

                              </select>

                              </div>

                              </div>

                              </div>  </div>
               <!--    <?
               }
             ?>-->

             <div class="form-group margin0">
                 <button type="button"  class="btn btnPrimary postreply" name="postreply">POST REPLY</button>
                 <div class="loader"></div>
             </div>
        </form>
        </div>
        </div>
        </div>
        </div>
        </div>
      </div>  
</div>
</div>
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >

  <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >

                  <span aria-hidden="true">&times;</span>

                </button>

                <h4 class="modal-title" id="myModalLabel">Add Reason</h4>

              </div>

              <div class="modal-body">

                       <div class="msgsn"></div>

                    <form  method="post" id=reasonform" name="reasonform" class="form row">

                        <div class="col-md-12">

                        <div class="form-group" >

                              <input type="text" name="newreason"  id="newreason"  class="form-control text-capitalize" placeholder="Enter New Reason"/>

                        </div>

                        </div>

                        <div class="form-group" >

                        <div class="col-md-12">

                        <input type="button" class="btn btn-primary next button greenBtn" data-toggle="modal" name="next" id="next" value="ADD" onclick="addnewreason()"  >

                        </div>

                        </div>

                    </form>

              <div class="clearfix"></div>

              </div>

            </div>

          </div>

</div>
     <?php include('footer.php'); ?>


 <!-- <script type="text/javascript" src="<?php echo SITEURL; ?>/js/bootstrap.min.js"></script>   -->

      <link rel="stylesheet" href="../summernote/summernote.css">
      <script type="text/javascript" src="../summernote/summernote.js"></script>
       <script>
         $(function() {
          $('.summernote').summernote({
          //fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather'],
            height: 200
         });
      });
       </script>
     <script>  $('.summernote').val("");
     $('.summernote').val("");
     $('#attach').val("");
        $(document).ready(function(){
            $(".postreply").click(function(){
                 var load= '<?php echo LOADER; ?>';
                 var loader=' <img src="'+load+'" alt="" style="width:20%"/>  ';

              var dept=$(".transfertodept option:selected").val();
               /* var staff=$(".reassigntkt option:selected").val();  */
                var assignto=$(".assignto option:selected").val();
                var chngdept=$(".chngdept option:selected").val();
                var sel= $(".postoption:checked").val();
                  var staff=$("#staff").val();
                  var requestid=$("#requestid").val();
                  var textareaValue = $('.summernote').summernote('code');
                  var cleanText = $(".summernote").summernote('code').replace(/<\/?[^>]+(>|$)/g, "");
                  var isclose=$(".closetkt:checked").val();
                  var isreopen=$(".reopentkt:checked").val();

                if(isclose=="on")
                     {
                        var closed=1;
                     }
                     else
                     {
                         var closed=0;
                     }

                      if(isreopen=="on")
                     {
                        var reopen=1;
                     }
                     else
                     {
                         var reopen=0;
                     }
                   var closesatus = $(".closesatus:checked").val();
                    lostreason = $("#lostreason").val();
              if($('#attach').val()!="")
              {
                    var attachment=$('#attach').prop('files')[0];
                    var attachmentname = ($('#attach'))[0].files[0].name;
              }
              else
              {
                  var attachment="";
              }

                     var form_data = new FormData();
                    form_data.append('staff', staff);
                    form_data.append('requestid', requestid);
                    form_data.append('comment', textareaValue);
                    form_data.append('closed', closed);
                     form_data.append('reopen', reopen);
                    form_data.append('dept', dept);
                    form_data.append('posttype', sel);
                    form_data.append('assignto', assignto);
                    form_data.append('chngdept', chngdept);
                    form_data.append('attachment',attachment);
                     form_data.append('closesatus', closesatus);
                      form_data.append('lostreason', lostreason);

                    if(cleanText=="")
                        {
                             $(".errormsg").fadeIn().html("Please enter comment to submit your post").addClass("alert alert-danger").delay(3000).fadeOut();
                        }

                        else if(sel=="Transfer Ticket" && chngdept=="")
                        {
                             $(".errormsg").fadeIn().html("Please Select Department To Transfer Lead").addClass("alert alert-danger").delay(3000).fadeOut();
                        }
                        else if(sel=="Reassign Ticket" && assignto=="")
                        {
                             $(".errormsg").fadeIn().html("Please Select Staff To Reassign Lead").addClass("alert alert-danger").delay(3000).fadeOut();
                        }
                         else if(closed == 1  && closesatus == undefined){
                             $(".errormsg").fadeIn().html("Please select Close Reason").addClass("alert alert-danger").delay(3000).fadeOut();
                              }

                        else
                        {
                            $(".postreply").append(" "+loader);
                            $(".postreply").attr("disabled",true);
                            $.ajax({
                                type:"POST",
                                url:"savecomments.php",
                                data:form_data,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success:function(response){
                                    $(".postreply img").remove();
                                    $(".postreply").attr("disabled",false);
                                    if(response)
                                    {
                                        if(response==1)
                                        {
                                            location.reload();
                                        }
                                        else
                                        {
                                            $(".loader").html('Error while insert.. try again later');
                                        }
                                    }
                                }
                            });
                        }


            });
        });

        function validateimg(id)
        {
                var load= '<?php echo LOADER; ?>';
                var loader=' <img src="'+load+'" alt="" style="width:40px"/>  ';
               var allowedimgformat=$("#allowedimgformat").val();
               var allowedappformat=$("#allowedappformat").val();
               var allowedmaxsize=$("#allowedmaxsize").val();
                 allowarr=[];
               var imgarr1 = allowedimgformat.split(",");

                for(var i = 0; i < imgarr1.length; i++) {
                     if(imgarr1[i]!="")
                    {
                      var imgstr='image/'+imgarr1[i];
                      allowarr.push(imgstr);
                    }
                }
                var apparr1 = allowedappformat.split(",");

                for(var i = 0; i < apparr1.length; i++) {
                    if(apparr1[i]!="")
                    {
                       var appstr='application/'+apparr1[i];
                      allowarr.push(appstr);
                    }
                }
                var allowstr= allowarr.toString();

              if($('#'+id).val()!="")
              {
                   $(".imgloader").fadeIn().removeClass("alert alert-success").html(loader+" Please Wait While We Are Validating Your Attachment").addClass("alert alert-danger");
                   $(".postreply").attr("disabled",true);
                    var attachment=$('#'+id).prop('files')[0];

                    var form_data1 = new FormData();
                    form_data1.append('attachment', attachment);
                    form_data1.append('allowformat', allowstr);
                    form_data1.append('maxsize', allowedmaxsize);
                     $.ajax({
                            type:"POST",
                            url:"validateattachment.php",
                            data:form_data1,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success:function(response){
                              if(response=="1")
                              {
                                    $(".imgloader").fadeIn().removeClass("alert alert-danger").html("<i class='fa fa-check'></i> Valid Attachment").addClass("alert alert-success").delay(5000).fadeOut();
                                    $(".postreply").attr("disabled",false);
                              }
                              else
                              {
                                  $(".imgloader").fadeIn().removeClass("alert alert-success").html(response).addClass("alert alert-danger").delay(5000).fadeOut();
                              }
                            }
                          });
              }
        }

        function showthreads(class1,class2)
        {
            $("."+class1).toggle();
          /*  $("."+class2).hide();  */
        }

        function dellead(leadid)
        {
            if(confirm("Are You Sure To Delete This Lead"))
            {
                info={leadid:leadid,action:"del_lead"}
                $.ajax({
                   type:"POST",
                    url:"leadentry.php",
                    data:info,
                    success:function(response){
                        if(response=="1")
                        {
                            window.location="<?php echo SUPPORTURL; ?>home.php";
                        }
                        else
                        {
                            alert("Error In Delete")
                        }
                    }
                });
            }
        }
     </script>
     <script>
      $(".transfertodept").hide();
      $(".reassigntkt").hide();
               $(".postoption").on("change",function(){
                    $(".transfertodept").hide();
                      $(".reassigntkt").hide();
                 var sel= $(".postoption:checked").val();
                if(sel=="Transfer Ticket")
                {
                    $(".transfertodept").show();
                     $(".reassigntkt").val("");
                }
                else if(sel=="Reassign Ticket")
                {
                    $(".reassigntkt").show();
                    $(".transfertodept").val("");
                }
                else
                {
                      $(".transfertodept").hide();
                      $(".reassigntkt").hide();
                       $(".transfertodept").val("");
                        $(".reassigntkt").val("");
                }
               });


               $('.closetkt').click(function() {

  if ($(this).is(':checked')) {

 $(".closestatusdiv").show();

  }

  else

  {

   $(".closestatusdiv").hide();
    $(".displaynone").hide();           

  }

});


function checkreason(idname){

     lostreason = $("#"+idname).val();

     if(lostreason == "addnewreason"){

           $("#myModal2").modal('show');

            $('#lostreason').prop('selectedIndex', 0);

     }

     else

     {

         $("#myModal2").modal('hide');

     }

}
$(".closesatus").click(function(){

      var closesatus = $(".closesatus:checked").val();

      if(closesatus == "Dead"){

           $(".displaynone").show();

      }

      else{

           $(".displaynone").hide();

           $("#lostreason").prop('selectedIndex', 0);

      }

})


function addnewreason(){

   var newreason = $("#newreason").val();



        var info = {

            action: "addnewreason",

            newreason: newreason,

        };

        if (newreason == "") {

            $('.msgsn').fadeIn().addClass('alert alert-danger').html('Please Enter Reason').delay(5000).fadeOut();

        } else {

            $.ajax({

                type: "POST",

                url: "ajaxdata.php",

                data: info,

                success: function(response) {

                    if (response == 0) {

                        $('.msgsn').fadeIn().addClass("alert alert-danger").html("This Action already exist.").delay(5000).fadeOut();

                    } else if (response == 1) {

                          $('.msgsn').fadeIn().removeClass("alert alert-danger").addClass("alert alert-success").html("Reason added successfully, please wait till page refreshes");

                             setTimeout(function(){ location.reload(); }, 3000);

                     } else if (response == 2) {

                        $('.msgsn').fadeIn().addClass("alert alert-danger").html("Please try after some time.").delay(5000).fadeOut();

                    }

                    else

                    {

                        $("#lostreason").replaceWith(response);

                        $('.msgsn').fadeIn().removeClass("alert alert-danger").addClass("alert alert-success").html("Reason added successfully.").delay(2000).fadeOut();

                        setTimeout(function(){  $("#myModal2").modal('hide'); }, 3000);

                    }

                }

            });

        }

}
       </script>
</body>
</html>