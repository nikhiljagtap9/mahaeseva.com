<?php
   include("../includes/configuration.php");
  $email=$_REQUEST['email'];
  $logintype=$_REQUEST['logintype'];
   $pwd=$_REQUEST['pwd'];
     $checkuser=selectQuery(SUPPORTLOGIN,"*","email='".$email."'");
    if(count($checkuser))
    {
          if($logintype=="otp")
            {
                  $sessotp=$_SESSION['otp'];

                      $sessotptime=$_SESSION['otptime'];
                      $currtime=date('YmdHis');
                      $diff=$currtime-$sessotptime;
                      if($diff>1500)
                      {
                           echo 3;   /* otp expired */
                      }
                      else
                      {
                          if($sessotp!=$pwd)
                          {
                              echo 2;  /* invalid otp */
                          }
                          else
                          {
                              echo 1;     /* otp validate */
                              $_SESSION['otp']="";
                                $_SESSION['otptime']="";
                              $_SESSION['supportuserid']=$checkuser[0]['client_id'];
                          }
                       }
            }
            else
            {
                  $pass=md5($pwd);
                    $checkmail=selectQuery(SUPPORTLOGIN,"*","email='".$email."' and pwd='".$pass."'");
                    if(count($checkmail))
                    {
                        echo 1;    /* success */
                        $_SESSION['supportuserid']=$checkuser[0]['client_id'];
                    }
                    else
                    {
                        echo 4;   /* invalid credentials */
                    }
            }
    }
    else
    {
        echo 5;   /* invalid user */
    }


?>