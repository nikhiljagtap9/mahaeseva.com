<?php

   $apikey= apikey;


        $ch = curl_init();


        curl_setopt($ch, CURLOPT_URL, "https://www.spanel.surun.in/api/$apikey/$panel");
        curl_setopt($ch, CURLOPT_REFERER, SITEURL);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);
         $id=unserialize($output);
       
       if($id['status']=="Expired")
       {
          ?>
            <script>window.location="<?php echo SITEURL; ?>/construction";</script>
          <?
       }

?>

