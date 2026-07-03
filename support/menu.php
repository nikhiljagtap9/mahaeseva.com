<?php
 if($_SESSION['staff']==""||$_SESSION['dept']==""||$_SESSION['staffname']=="")
 {
      echo '<script> window.location="'.SUPPORTURL.'/logout.php";</script>';
 }

    $loginstaff=selectQuery(SUPPORTSTAFF." as s LEFT JOIN ".SUPPORTDEPT." as d on s.department=d.dept_id LEFT JOIN ".SUPPORTSTAFFGROUP." as g on s.emp_group=g.group_id","*","s.emp_id=".$_SESSION['staff']);
    $menusupportsetting=selectQuery(SUPPORTEMAIL,"*");
    $staffdept=$loginstaff[0]['department'];
    $staffgroup=$loginstaff[0]['emp_group'];
    $accesstodept=$loginstaff[0]['access_to_dept'];
     $accesstoadminpanel=$loginstaff[0]['admin_panel_access'];
   /* $accesstodept=CLIENTDEPTID;*/
    if($loginstaff[0]['group_name']!='Admins'&&$loginstaff[0]['group_name']!='Client')
    {
            if($menusupportsetting[0]['department_issolation']=='0')
            {
                if($accesstodept!="")
                {
                  $wheredept=" and dept IN (".$accesstodept.")";
                }
                else
                {
                   $wheredept=" and dept IN ('')";
                }
            }
            else
            {
                $wheredept=" and entry_by=".$_SESSION['staff'];
            }
    }
    else
    {
        if($loginstaff[0]['group_name']=='Client')
        {
            $wheredept=" and entry_by=".$_SESSION['staff'];
        }
        else
        {
            $wheredept="";
        }

    }


    $getdept=selectQuery(SUPPORTDEPT,"*","dept_id=".$loginstaff[0]['department']);
    $deptstaff=selectQuery(SUPPORTSTAFF,"*","department=".$loginstaff[0]['department']." and isActive='1' and isDel='0'");

    $allstaff=selectQuery(SUPPORTSTAFF,"*","isActive='1' and isDel='0' order by emp_name ASC");


   $attachmentmax=$menusupportsetting[0]['attachment_size'];
   $allowedimgtypes=$menusupportsetting[0]['img_types'];
   $allowedapptypes=$menusupportsetting[0]['application_types'];
   $menuallowimgarr1= explode(",",$allowedimgtypes);

   if($staffdept=="0"||$staffgroup=="0")
   {
       $error="Dear ".$loginstaff[0]['username'].",<br> You dont have Staff Group OR Department Access.<br> For more details, please contact system administrator";
   }
   else
   {
        if($_SESSION['acc_type']=="Admin" || $_SESSION['acc_type']=="Staff")
        {
            $openwhere="isOpen='1' and isClosed='0' and isDel='0' ".$wheredept;
        }
        else
        {
             $openwhere="isClosed='0' and isDel='0' ".$wheredept;
        }

        $getopen=selectQuery(CONTACT,"*",$openwhere);

        $getans=selectQuery(CONTACT,"*","isAnswered='1' and isDel='0'".$wheredept);
        $answeredwhere="isAnswered='1' and isDel='0' ".$wheredept;

        $getmytkt=selectQuery(CONTACT,"*","assign_to='".$_SESSION['staff']."'  and isDel='0' and isClosed='0' ".$wheredept);    //Addded:  and isClosed='0'
        $mytktwhere="assign_to='".$_SESSION['staff']."' and isDel='0' and isClosed='0' ".$wheredept;             //Addded:  and isClosed='0'

        $getclosed=selectQuery(CONTACT,"*","isClosed='1' and isDel='0'".$wheredept);

        $closewhere="isClosed='1' and isDel='0' ".$wheredept;

        $getoverdue=selectQuery(CONTACT,"*","isOverdue='1' and isDel='0'".$wheredept);
        $overduewhere="isOverdue='1' and isDel='0' ".$wheredept;
   }

  /* for($k=0;$k<sizeOf($menuallowimgarr1);$k++)
   {

   }*/
?>

<div class="fillHeader">
<div class="container">
<div class="header">

      <div class="row">
        <div class="col-md-4 col-sm-4 logo">
            <div class="navbar-header pull-left">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <i class="fa fa-bars"></i>
              </button>
            </div>
            <a href="home.php"> <img src=" <?php echo SITEURL ?>/img/projectimage/logo.png" alt=""/> </a>
        </div>
        <div class="col-md-8 col-sm-8">
            <ul class="nav nav-pills paddLift pull-right headerRight">
                <li>
                    <?php
                            if($accesstoadminpanel=="1")
                            {

                                ?>
                                     <a href="<?php echo ADMINURL; ?>home.php">Admin Panel</a>
                                <?
                            }
                         ?>
                </li>
                <li class="dropdown logoutbtn">
                    <a class="dropdown-toggle" id="menu1"  data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span><?php echo $loginstaff[0]['username']; ?><small> </small></span>
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                    <?php
                     if($accesstoadminpanel!="1")
                     {
                    ?>
                        <li><a href="<?php echo SITEURL ;?>/support/settings.php" class="logout"><i class="fa fa-lock" aria-hidden="true"></i> Settings</a></li>
                      <?php
                     }
                    ?>
                        <li><a href="<?php echo SITEURL ;?>/support/logout.php" class="logout"><i class="fa fa-lock" aria-hidden="true"></i> Logout</a></li>

                    </ul>
                </li>
            </ul>
        </div>
        </div>
  </div>
 </div>

<div class="navigation">
  <div class="container">

    <div class="row">
    <div class="col-md-12">
		    <div id="myNavbar" class="navbar-collapse collapse pull-right paddRight">
                   <ul class="nav navbar-nav overline" data-breakpoint="800" >
                        <?php
                         if($loginstaff[0]['Create']=="1")
                         {
                             ?>
                              <li><a href="<?php echo SUPPORTURL."create.php";; ?>" id="create">Create Ticket</a></li>
                             <?
                         }
                        ?>

                     <?php
                        if($_SESSION['acc_type']!="Client")
                        {
                        ?>
                        <li><a href="<?php echo SUPPORTURL."home.php"; ?>" id="home">Open (<?php echo count($getopen); ?>)</a></li>
                        <li><a href="<?php echo SUPPORTURL."answered.php"; ?>" id="Answered">Answered (<?php echo count($getans); ?>)</a></li>
                        <li><a href="<?php echo SUPPORTURL."mytickets.php"; ?>" id="My">My Tickets (<?php echo count($getmytkt); ?>)</a></li>
                        <li><a href="<?php echo SUPPORTURL."overdue.php";; ?>" id="overdue">Overdue (<?php echo count($getoverdue); ?>)</a></li>
                        <li><a href="<?php echo SUPPORTURL."closed.php";; ?>" id="closed">Closed (<?php echo count($getclosed); ?>)</a></li>
                    <!--<li><a href="<?php echo SUPPORTURL."guestlist.php";; ?>" id="guestlist">Guest Master</a></li> -->
                    <?php } ?>

                   </ul>
            </div>
        </div>
      </div>
  </div>
 </div>
 </div>
