<?php

      include("../includes/configuration.php");
       /*
        session_unset();*/
        unset($_SESSION["supportuserid"]);
       /* session_destroy();    */
        echo '<script> window.location="'.SITEURL.'/contactrequest";</script>';

?>