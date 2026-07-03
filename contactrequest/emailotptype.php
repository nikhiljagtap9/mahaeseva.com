<?php
  include("../includes/configuration.php");
  $email=$_REQUEST['email'];
  $logintype=$_REQUEST['logintype'];

   $checkmail=selectQuery(CONTACT,"*","Email='".$email."' order by req_id DESC LIMIT 1");

  if(count($checkmail))
  {

       ?>
         <form class="dialog-form">
                <div class="form-group">
                   <input type="hidden" placeholder="Please Enter Your Email Adress *" class="form-control loginu" value="<?php echo $email; ?>" readonly>
                     <input type="hidden" class="form-control logintype" value="<?php echo $logintype; ?>" readonly>
                </div>
                <?php
                  if($logintype=="otp")
                  {
                      $contactNop=$checkmail[0]['Telephone'];
                      $last2mob=substr($contactNop, 8,2);
                       $emaillen=strlen($email);
                        $first2email=substr($email, 0,2);
                        $starstring="";
                        $pos = strrpos($email, "@");

                        $lst2email=substr($email,$pos);

                        $lastlen=strlen($lst2email);
                        $star= $emaillen-(2+$lastlen);
                         for($i=0;$i<$star;$i++)
                         {
                                $starstring= $starstring."*";
                         }
                     ?>
                      <div class="col-md-12 text-center">
                     <!--  <input type="radio" name="otptype" class="otptype" value="mobile" checked style="display:none"/> Get Verification Code on Mobile No.<br>  ********<?php echo $last2mob; ?>  <br>     -->
                        <input type="radio" name="otptype" class="otptype" value="email" checked style="display:none"/>
                        <h4><b>Send Verification Code On Email</b></h4>
                        <h4><?php echo $first2email.$starstring.$lst2email; ?></h4>
                      </div>
                   <?
                  }
                  else
                  {

                  }
                ?>
                <div class="form-group text-center">
                    <input type="button" value="Get Verification" class="btn btnPrimary"  onclick="checklogintype()" >
                </div>
                <div class="form-group text-center">
                    <input type="button" value="Try Another Option" class="btn btn-danger"  onclick="contactsysyemoption()" >
                </div>

                  <div class="col-md-3 col-xs-3" id="otploader" > </div>
            </form>
       <?
  }
  else
  {
      echo 0;
  }
  ?>