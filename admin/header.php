<?php if($_SESSION['user']==""){ echo '<script>window.location="'.ADMINURL.'index.php";</script>'; }
$getid = selectQuery(USER,"*","u_id=".$_SESSION['user']);
$getusertype = $getid[0]['utype']; $menusupportsetting = selectQuery(SUPPORTEMAIL,"*"); $attachmentmax = $menusupportsetting[0]['attachment_size']; $allowedimgtypes = $menusupportsetting[0]['img_types']; $allowedapptypes = $menusupportsetting[0]['application_types']; $menuallowimgarr1 = explode(",",$allowedimgtypes); ?>
<header>
    <nav class="navbar">
        <div id="hmenu" class="menubtn"><i class="fa fa-bars"></i></div>
        <div class="logo"><a href="<?php echo SITEURL ?>" target="_blank"><img src="<?php echo SITEURL; ?>/img/projectimage/logo.png" alt="Logo" class="img-fluid logo"/></a></div>
        <ul class="nav justify-content-end user-log-drop">
            <?php $chplan = curl_init();
            curl_setopt($chplan, CURLOPT_URL, "https://www.spanel.surun.in/planapi/".apikey);
            curl_setopt($chplan, CURLOPT_REFERER, SITEURL);
            curl_setopt($chplan, CURLINFO_HEADER_OUT, true);
            curl_setopt($chplan, CURLOPT_RETURNTRANSFER, 1);
            $outputplan = curl_exec($chplan);
            curl_close($outputplan);
            $plandatafromapi = unserialize($outputplan);
            $end = $plandatafromapi['hosting_end_date'];
            $from_time = date("Y-m-d");
            function dateDiff($start, $end){
                $start_ts = strtotime($start); $end_ts = strtotime($end); $diff = $end_ts - $start_ts;
                return round($diff / 86400);
            }
            $diff = dateDiff($from_time,$end);
            if($diff>0){
                echo "<li class='nav-item py-2 d-none d-md-inline-block'>Subscription Ends After <span class='label label-success subend'><a href='".ADMINURL."plandetails.php' target='_blank'>".$diff." Days</a></span></li>";
            } else if($diff<0){
                echo "<li class='nav-item py-2 d-none d-md-inline-block'>Subscription End  <a href='".ADMINURL."plandetails.php' target='_blank'><span class='label label-danger'>".$diff." </span>Days Ago</a></li>";
            } else if($diff==0){
                echo "<li class='nav-item py-2 d-none d-md-inline-block'><a href='".ADMINURL."plandetails.php' target='_blank'>Subscription Ends Today</a></li>";
            } ?>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle pr-0 text-dark" id="navbardrop" href="#" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i> <span><?php echo $getid[0]['username']; ?></span></a>
                <div class="dropdown-menu">
                    <?php if($getusertype=='Admin'){
                    if(SMS_SYSTEM=="ON"){
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://api-alerts.solutionsinfini.com/v3/?method=account.credits&api_key=".WORKINGKEY."&format=PHP");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    $arrout = (unserialize($output));
                    $credit = floor($arrout['data']['credits']); ?>
                    <a class="dropdown-item" href="<?php echo ADMINURL; ?>setting/managesms.php" <? if($credit<=200){ ?> style='color:red;' <? }else{ ?> style='' <? } ?>><i class="fa fa-envelope" aria-hidden="true"></i>Avaliable SMS<span class="badge badge-info"><?php echo $credit; ?></span></a>
                    <? } ?>
                    <a class="dropdown-item" href="<?php echo ADMINURL; ?>lastlogin.php"> <i class="fa fa-key"></i>Last 30 Login Details</a>
                    <?php } else {?>
                    <a class="dropdown-item" href="<?php echo ADMINURL; ?>subadminlastlog.php?id=<?php echo base64_encode($getid[0]['u_id']) ?>"><i class="fa fa-key"></i> Last 30 Login Details</a>
                    <?php } ?>
                    <a class="dropdown-item py-2" href="<?php echo ADMINURL; ?>presetting.php"> <i class="fa fa-cog"></i>Setting & Logs</a>
                    <a class="dropdown-item" href="<?php echo ADMINURL; ?>logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                </div>
            </li>
        </ul>
    </nav>
</header>