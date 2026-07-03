<div class="fillHeader">
<?php include 'menu.php';?>
 <link rel="stylesheet" href="<?php echo SITEURL; ?>/summernote/summernote.css">
<?php include 'internalmenu.php';?>
</div>
  <?php
     $req=base64_decode($_REQUEST['req']);

      $ticketdetails=selectQuery(CONTACT,"*","contact_request_id=".$req);
     $comments=selectQuery(SUPPORTCOMMENT,"*","ticket_id=".$req." order by comment_id ASC");
      $getdeptname=selectQuery(SUPPORTDEPT,"*","dept_id=".$ticketdetails[0]['dept']);
      $lastresponse=selectQuery(SUPPORTCOMMENT,"*","ticket_id=".$req." order by comment_id DESC LIMIT 1");
        $assignedstaff=selectQuery(SUPPORTSTAFF,"*","emp_id=".$ticketdetails[0]['assigned_to']);

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
     ?>

     <div class="content">
     <div class="container">
             <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">

             <div class="card">
             <div class="panel-body">
               <div class="col-md-10 col-sm-10 col-xs-10 reply"><h4>Ticket - #<?php echo $req; ?> <!--(<?php echo $ticketdetails[0]['status']; ?>)--></h4></div>
                <div class="col-md-2 col-sm-2 col-xs-12 text-right"><button type="button" class="btn btn-default" onclick="goBack()"> BACK </button></div>
            </div>
            </div>

             <div class="card">
                <div class="panel-body">
                <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                     <table class="table ticketStatus">
                         <tr>
                            <td class="detail borderTop0"><b>Status</b></td>
                            <td class="detail borderTop0 mute-text">

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
                               <td class="detail"><b>Department</b></td>
                              <td class="detail mute-text"> <?php echo $getdeptname[0]['dept_name']; ?></td>

                          </tr>
                          <tr>
                              <td class="detail"><b>Created Date</b></td>
                            <td class="detail mute-text"><?php echo date("d/m/Y H:i:s",strtotime($ticketdetails[0]['date'])); ?></td>
                          </tr>
                           <tr>
                              <td class="detail"><b>Last Response</b></td>
                            <td class="detail mute-text"><?php echo $lastresponse[0]['comment_date']; ?></td>
                          </tr>
                     </table>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                       <table class="table ticketStatus">
                           <tr>
                               <td class="detail borderTop0"><b>Email</b></td>
                              <td class="detail borderTop0 mute-text"> <?php echo $ticketdetails[0]['Email']; ?></td>
                           </tr>
                           <tr>
                                 <td class="detail"><b>Mobile</b></td>
                              <td class="detail mute-text"><?php echo $ticketdetails[0]['Telephone']; ?></td>
                           </tr>
                            <tr>
                                 <td class="detail"><b>Assigned Staff</b></td>
                              <td class="detail mute-text"><?php echo $assignedstaff[0]['emp_name']; ?></td>
                           </tr>
                       </table>
                </div>
                  </div>
                 </div>
             </div>

              <div class="card">
                <div class="panel-body">
                    <div class="row"><div class="panel-heading"><div class="panel-title">Ticket Thread</div></div></div>
                     <div class="list-view">
                          <div class="bg-success text-success">
                            <?php echo date("d/m/Y H:i:s",strtotime($ticketdetails[0]['date']))." - ".$ticketdetails[0]['Name']; ?>
                          </div>
                          <div class="commentbox mute-text">
                            <?php echo $ticketdetails[0]['Comment']; ?>
                          </div>
                    </div>
                    <?php
                      for($i=0;$i<count($comments);$i++)
                      {
                          $attachment=selectQuery(SUPPORTIMG,"*","response_id=".$comments[$i]['comment_id']);
                         if($comments[$i]['comment_by']!="client")
                          {
                              if($comments[$i]['comment_by']=="Admin")
                              {
                                  /*  $commentby=selectQuery(SUPPORTSTAFF,"*","emp_id=".$comments[$i]['comment_by']);  */
                                $commenter="Admin";
                              }
                              else
                              {
                                  $commentby=selectQuery(SUPPORTSTAFF,"*","emp_id=".$comments[$i]['comment_by']);
                                 $commenter=$commentby[0]['emp_name'];
                              }

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
                                     <div class="bg-info text-ingo">
                                 <?
                              }
                              else
                              {
                                 ?>
                                     <div class="bg-success text-success">
                                 <?
                              }
                            ?>

                                    <?php echo $comments[$i]['comment_date']." - ".$commenter; ?>
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
                                  <div class="commentbox mute-text">
                                    <?php echo $comments[$i]['comment']; ?>
                                  </div>
                            </div>
                        <?
                      }
                    ?>
             </div>
             <div class="panel-heading"><div class="panel-title">Post Your Reply</div></div>
             <div class="row">
             <div class="col-md-12">
               <form action="" name="reply" method="post" enctype="multipart/form-data" class="col-md-12">
              <div class="form-group reply" style="display:none">
              <label class="radio-inline"><input type="radio" name="postoption" class="postoption" value="Post Reply" checked/> Post Reply</label>
              <label class="radio-inline"><input type="radio" name="postoption" class="postoption" value="Transfer Ticket" /> Transfer Ticket</label>
              <label class="radio-inline"><input type="radio" name="postoption" class="postoption" value="Reassign Ticket" /> Reassign Ticket </label>
             </div>
             <div class="form-group">
                    <input type="hidden" name="staff"  id="staff" value="client"/>
                     <input type="hidden" name="requestid"  id="requestid" value="<?php echo $req; ?>"/>
                     <input type="hidden" name="allowedimgformat"  id="allowedimgformat" value="<?php echo $allowedimgtypes; ?>"/>
                       <input type="hidden" name="allowedappformat"  id="allowedappformat" value="<?php echo $allowedapptypes; ?>"/>
                       <input type="hidden" name="allowedmaxsize"  id="allowedmaxsize" value="<?php echo $attachmentmax; ?>"/>
                     <textarea class="summernote" id="editor1"  name="text_details" style="width:100%;min-height:200px !important"></textarea>
             </div>
             <div class="form-group">
              <span>Attach File (Allowed Type:<?php echo $allowed; ?> || Max File Size : <?php echo ($attachmentmax/1024)/1024; ?> MB)</span>
              <input type="file" name="attach" id="attach" onchange="validateimg('attach')"/>
             </div>
             <div class="imgloader"></div>
              <div class="clearfix"></div>
                <div class="form-group" ><button type="button"  class="btn btn-primary postreply btnPrimary" name="postreply">POST REPLY</button>  </div>

            <!--   <div class="loader"></div>  -->
            <div class="msgs"></div>
         </form>
         </div>
          </div>
         </div>
     </div>
      </div>
  </div>
  </div>
     <?php include('footer.php'); ?>

      <script type="text/javascript" src="<?php echo SITEURL; ?>/summernote/summernote.js"></script>
       <script>
         $(function() {
          $('.summernote').summernote({
          //fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather'],
            height: 200
         });
      });
       </script>
     <script>
      $('.summernote,#attach').val("");
       $(document).ready(function(){
          $(".postreply").click(function(){
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

                var sel= $(".postoption:checked").val();
              var staff=$("#staff").val();
              var requestid=$("#requestid").val();
              var textareaValue = $('.summernote').summernote('code');
              var cleanText = $(".summernote").summernote('code').replace(/<\/?[^>]+(>|$)/g, "");
                 if($('#attach').val()!="")
                 {
                       var attachment=$('#attach').prop('files')[0];
                        var attachmentsize = ($('#attach'))[0].files[0].size;
                        var attachmenttype = ($('#attach'))[0].files[0].type;
                        var attachmentname = ($('#attach'))[0].files[0].name;
                 }


            /*  var isclose=$(".closetkt:checked").val();        */

            if(cleanText=="")
            {
                 $(".msgs").fadeIn().html("Please enter comment to submit your post").addClass("alert alert-danger").delay(5000).fadeOut();
            }
           else if($('#attach').val()!=""&&(attachmentsize>allowedmaxsize))
                    {
                         $(".msgs").fadeIn().html("Attachment Size is not in limit").addClass("alert alert-danger").delay(5000).fadeOut();
                    }

                    else if($('#attach').val()!=""&&allowarr.indexOf(attachmenttype)==-1)
                    {

                         $(".msgs").fadeIn().html("Invalid Attachment").addClass("alert alert-danger").delay(5000).fadeOut();
                    }
            else
            {

                   var load= '<?php echo LOADER; ?>';
                        var loader=' <img src="'+load+'" alt="" style="width:20%"/>  ';
                          $(".postreply").append(" "+loader).attr("disabled",true);
                  var form_data = new FormData();

                           form_data.append('staff', staff);
                         form_data.append('requestid', requestid);
                         form_data.append('comment', textareaValue);
                         form_data.append('posttype', sel);
                         form_data.append('attachment', attachment);

               /* var info={staff:staff,requestid:requestid,comment:textareaValue,posttype:sel,attachment:attachment}; */
                $.ajax({
                    type:"POST",
                    url:"savecomments.php",
                    data:form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(response){
                         $(".postreply").remove().attr("disabled",false);

                              if(response==1)
                              {
                                  location.reload();
                              }
                              else
                              {
                                  $(".msgs").fadeIn().html('Error while insert.. try again later').addClass("alert alert-danger").delay(5000).fadeOut();
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
                            url:"<?php echo SITEURL; ?>/support/validateattachment.php",
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

       function goBack() {
    window.history.back();
}
     </script>
