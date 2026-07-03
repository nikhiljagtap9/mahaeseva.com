<?php
  include("../includes/configuration.php");
  $client=$_REQUEST['clientid'];
  $pwd=$_REQUEST['pwd1'];
  if($client==$_SESSION["supportuserid"])
  {
       if($pwd!="")
       {
           $data=array(
             'pwd'=>md5($pwd)
           );
            $upatedeta=updateQuery(SUPPORTLOGIN,$data,"client_id=".$client);
            if($upatedeta)
            {
                  echo 1;   
            }
            else
            {
                  echo 0;
            }
       }
       else
       {
             echo 0;
       }
  }
  else
  {
      echo 0;
  }

?>