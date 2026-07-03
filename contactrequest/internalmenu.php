<?php
  if($_SESSION["supportuserid"]=="")
  {
       echo '<script> window.location="'.SITEURL.'/contactrequest";</script>';
  }
  $supportuser=$_SESSION["supportuserid"];
  $getdeta=selectQuery(SUPPORTLOGIN,"*","client_id=".$supportuser);

  $openrequest=selectQuery(CONTACT,"*","Email='".$getdeta[0]['email']."' and isClosed='0'");
   $closerequest=selectQuery(CONTACT,"*","Email='".$getdeta[0]['email']."' and isClosed='1'");
?>
 <?php
  if(($getdeta[0]['pwd'] == "") )
           {?> 
                  <div class="modal fade" id="setpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                             <div class="modal-content">
                             <div class="modal-header"><h4 class="modal-title">Please Set Your Account Password</h4></div>

                           <div class="cmpmsgs text-center red"></div>
                                 <form action="#" method="post" id="dealerform" class="form-horizontal" enctype="multipart/form-data">
                                     <div class="modal-body">
                                               <div class="setpwdmsg"></div>
                                                <input type="hidden"  value="<?php echo $getdeta[0]['client_id']; ?>" id="clientid"/>
                                       <div class="form-group">
                                                    <label class="col-md-4 control-label text-left p0"> Enter Password <span class="red">*</span></label>
                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <input type="password" name="password1" id="password1" class="form-control"  maxlength="30" tabindex="1"/>
                                                    </div>
                                              </div>


                                               <div class="form-group">
                                                    <label class="col-md-4  control-label text-left p0">Confirm Password <span class="red">*</span></label>
                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <input type="password" name="password2" id="password2" class="form-control"  maxlength="50" tabindex="2"/>
                                                    </div>
                                              </div>
                                      </div>
                                      <div class="modal-footer">
                                               <input type="button" value="Submit" class="btn greenBtn setpwd">
                                                <div class="col-md-3 col-xs-3 setpwdloader"></div>
                                                </div>
                                         </form>

                               </div>
                         </div>
                 </div>
                 <script>
                     $('#setpassword').modal('show');
                 </script>
           <?
           }
         ?>

<div class="clearfix"></div>
<div class="container">
    <div class="row">
            <div class="collapse navbar-collapse supportnav" id="myNavbar">
                <ul class="nav navbar-nav"  data-breakpoint="800" >
                 <li><a href="home.php">Running Tickets (<?php echo count($openrequest); ?>)</a>        </li>
                  <li><a href="closed.php">Closed Tickets (<?php echo count($closerequest); ?>)</a>        </li>
              </ul>
            </div>
    </div>
</div>
