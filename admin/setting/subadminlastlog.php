
   <?php
     include("../includes/configuration.php");

          $id=base64_decode($_GET['id']);
        $getid=selectQuery(USER,"*","u_id=".$id);
        $getname= $getid[0]['username'];
      $s=selectQuery(ADMINLOG,"*","username='".$getname."'");
?>
<!doctype html>
<html lang=''>
<head>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo SITENAME; ?> Admin</title>
</head>
<body>
<div class="dashcontainer">
    <?php include('header.php') ?>
<div class="col-md-3 left_col">
    <?php include('cssmenu.php') ?>
</div>
<div class="right_col">
       <div  class="dashbody">
       <div class="card">
       <div class="panel-body">
       <div class="panel-heading"><div class="panel-title">Admin Login Details</div></div>
            <div class="col-md-12">
                   <table class="table table-striped">
                   <thead>
                    <tr>
                    <th>#</th>
                    <th>Username</th>
                       <th>Login Time</th>
                        <th>Device Type</th>
                         <th>Browser</th>
                  <th> IP Address </th>
                    </tr>
                    </thead>
                      <?
              for($i=0;$i<count($s);$i++)
              {
                 ?>
                  <tbody class="mute-text">
                    <tr>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $s[$i]['username'] ?></td>
                        <td>
                        <?php echo $s[$i]['login_time'];
                               $date2= str_replace("/","-",$s[$i]['login_time']);

                              $from_time = strtotime($date2);
                               $to_time1 =date("d-m-Y H:i:s");
                                $to_time = strtotime($to_time1);
                                $all = round(($to_time - $from_time) / 60);
                                   $d = floor ($all / 1440);
                                   $h = floor (($all - $d * 1440) / 60);
                                   $m = $all - ($d * 1440) - ($h * 60);
                                   if($d>0)
                                   {
                                       echo " (".$d." day ".$h.":".$m." min ago)";
                                   }
                                   else
                                   {
                                      echo " (".$h.":".$m." min ago)";
                                   }

                              /*  echo " (".round(abs($to_time - $from_time) / 60,0). " minutes ago)";  */
                        ?></td>
                         <td>
                            <?php echo $s[$i]['device_type']; ?>

                         </td>
                          <td><?php echo $s[$i]['browser_name']; ?></td>
                         <td><?php echo $s[$i]['ip_address']; ?></td>
                    </tr>
                 <?
              }
        ?>       </tbody>
                </table>
            </div>
            </div>
            </div>
       </div>
       <?php include('../footer.php');?>
</div>
</div>
  <script>
  $("#menu20").children("ul").show();
  </script>
</body>
</html>
