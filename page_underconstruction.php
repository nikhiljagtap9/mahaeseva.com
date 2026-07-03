<?php
   include("includes/configuration.php");
?>
<html>
 <head>
  <title>Page Under Construction</title>
  <meta charset='UTF-8'>
   <?php include 'commoncss.php' ?>

  <style>

    h1{
        font-size: 50px;
        color:#000;
    }

    img{
        margin:auto;
    }

    .middleBox {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-74%);
    -ms-transform: translate(-50%,-74%);
}

p{
    font-weight: 300;
}

.highlightText{
    color: #d8721c;
}

  </style>
 </head>
 <body>

 <div class="container">
     <div class="row">
     <div class="col-md-12 text-center middleBox">
     <img src="<?php echo SITEURL; ?>/img/projectimage/logo.png" alt="logo" title="<?php echo SITE_TITLE; ?>"   itemprop="logo" class="img-responsive" />
  <h1><b>Website Is Under Maintenance</b></h1>
  <p class="lead">If you are admin of this website then contact us on <br><span class="highlightText"><b>support@surun.in</b></span> Or Call on <span class="highlightText"><b>9762007003</b></span></p>
  </div>
    </div>
  </div>
 <script src="<?php echo SITEURL; ?>/js/bootstrap.min.js"></script>
 </body>

</html>