<?php
   $desktop=selectQuery(VLIST,"*","device<>'android' AND device<>'Windows Phone' AND device<>''");
   $mobile=selectQuery(VLIST,"*","(device='android' OR device='Windows Phone') AND device<>''");

?>

<div class="footer">
<div class="col-md-12">
 <div class="row">
     <div class="col-md-6 col-sm-6 col-xs-6">
    Copyright &#169; <?php echo date("Y"); ?>  <?php echo SITENAME; ?><br>
    </div>
     <div class="col-md-6 col-sm-6 col-xs-6 text-right" >
        Website Intelligence By- <a href="https://www.surun.in/" target="_blank">Surun Infocore System</a>
     </div>
 </div>

</div>
</div>

<!--<script src="<?php echo SITEURL; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo SITEURL; ?>/js/jquery-1.12.0.min.js" charset="UTF-8"></script>-->
<script type="text/javascript" src="<?php echo SITEURL; ?>/js/jquery.dataTables.min.js"></script>



       <script>
       $(document).ready(function(){
                  $('.example').DataTable( {
         "lengthMenu": [ 10, 25, 50, 75, 100 ],
        } );
    } );
            </script>
    <!-- <script type = "text/javascript" src = "<?php echo SITEURL; ?>/js/jquery-ui.min.js"></script> -->

   <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "url": "<?php echo SITEURL; ?>/",
      "logo": "<?php echo SITEURL; ?>/img/projectimage/logo.png"
    }
    </script>
   <!-- <script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'cabin::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>-->
<script>


$(".open-nav").click(function(){
    $(".nav").show();
    $(".transperback").show();
 });

 $(".close-nav").click(function(){
    $(".nav").hide();
    $(".transperback").hide();
 });


</script>

<script>

$(document).ready(function(){
 /*   var elementPosition = $('.menuupline').offset();
    $(window).scroll(function(){
            if($(window).scrollTop() > elementPosition.top){
                  $('.menuupline').css({'position':'fixed','top':'0','width':'100%'});

            } else {
                $('.menuupline').css('position','relative');
            }
    });*/

 $(".setpwd").click(function(){
     var clientid=$("#clientid").val();
     var pwd1=$("#password1").val();
     var pwd2=$("#password2").val();
     if(pwd1==""||pwd2=="")
     {

      $(".setpwdmsg").fadeIn().html("Password And Confirm Password Fields Are Required").addClass("alert alert-danger").delay(3000).fadeOut();
     }
     else if(pwd1!==pwd2)
     {
          $(".setpwdmsg").fadeIn().html("Password And Confirm Password Fields Are Not Matched").addClass("alert alert-danger").delay(3000).fadeOut();
     }
     else
     {

     var info={clientid:clientid,pwd1:pwd1};
         $.ajax({
                        type:"POST",
                        url:"setpassword.php",
                        data:info,
                        success:function(response){
                           if(response)
                              {
                                  if(response==1)
                                  {
                                      location.reload();
                                  }
                                  else
                                  {

                                       $(".setpwdmsg").fadeIn().html("Error while insert.. try again later").addClass("alert alert-danger").delay(3000).fadeOut();
                                  }
                              }

                        }
                  });
     }
 });
})
</script>

</body>
</html>