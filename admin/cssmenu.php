<?php $id =$_SESSION['user'];
$result = selectQuery(USER,"*" ,"u_id= '$id'"); $id = $result[0]['u_id']; $uname = $result[0]['username']; $type = $result[0]['utype']; $menuid = $result[0]['allocatemenu']; $new = explode(",",$menuid); $arro = array();
for($i=0;$i<sizeof($new);$i++){ $arro[]="menu_id=".$new[$i]; }
$ids = implode(" OR ",$arro); $decidemenu = selectQuery(menu,"*",$ids); $menuname = array();
for($i=0;$i<count($decidemenu);$i++){
    $menud = $decidemenu[$i]['menu_name']; array_push($menuname, $menud);
} ?>
<?php $usermenu = selectQuery(WEB_USER,"*","isActive='1' and isDel='0'");
$totalusermenu = selectQuery(WEB_USER,"*","isDel='0'"); $totalagr = selectQuery(AGR,"*","isDel='0'"); $totalpayments = selectQuery(AGR,"SUM(total_charges) AS payment","isPaid='1' and isDel='0'"); $slidecnt = selectQuery(MAIN_SLIDER,"*","isDel='0'"); $getvlistcnt = selectQuery(VLIST,"*","time like '%".date('d/m/Y')."%' "); $getdeptcnt = selectQuery(SUPPORTDEPT,"*","isdel='0'"); $supportlists = selectQuery(SUPPORTDEPT,"*","isDel='0' and isActive='1'"); $getopenofalldetpt = selectQuery(CONTACT,"*","isOpen='1' and isClosed='0'"); $getsmsenquiry = selectQuery(SMS,"*","isUser='1' order by sms_id DESC"); 
$monthpayments = selectQuery(AGR,"SUM(total_charges) AS payment","isPaid='1' and isDel='0' and (MONTH(entry_on)=MONTH(now()) and YEAR(entry_on)=YEAR(now()))");?>
<nav class="sidebar" id="sidebar">
    <ul class="nav flex-column">
        <?php if (in_array(" Dashboard", $menuname)){ ?>
        <li class="nav-item nav-list-0"><a class="nav-link" href='<?php echo ADMINURL; ?>home.php'><span class="fa fa-dashboard"></span><span class="title">Dashboard</span></a></li>
        <?php } else{ ?>
        <li class="nav-item nav-list-1"><a class="nav-link" href='javascript:void(0);'><span class="fa fa-dashboard"></span><span class="title">Menu</span></a></li>
        <?php } ?>
        <?php if(in_array("Main Slider Management", $menuname)){ ?>
        <li class="nav-item nav-list-2"><a class="nav-link" href='<?php echo ADMINURL; ?>mainslider/'><i class="fa fa-picture-o" aria-hidden="true"></i><span class="title">Main Slider Management (<?php echo count($slidecnt); ?>)</span></a></li>
        <?php } ?>
        <?php if(in_array("Agreement", $menuname)){ ?>
        <li class="nav-item nav-list-3 dropdown"><a class="nav-link" href="javascript:void(0);"><span class="fa fa-file-text"></span><span class="title">Manage Agreements</span></a>
            <ul class="dropdownMenu list-unstyled">
                <li class="nav-item nav-list-0"><a class="nav-link" href='<?php echo ADMINURL; ?>agreement/create_agreement.php'><span class="title">Create New Agreement</span></a></li>
                <li class="nav-item nav-list-1"><a class="nav-link" href='<?php echo ADMINURL; ?>agreement/index.php' ><span class="title">Rent Agreements (<?php echo count($totalagr); ?>)</span></a></li>
                <li class="nav-item nav-list-2"><a class="nav-link" href='<?php echo ADMINURL; ?>agreement/tempstorage.php' target="_blank"><span class="title">Temporary Storage</span></a></li>
            </ul>
        </li>
        <?php } ?>
        <?php if(in_array("User Management", $menuname)){ ?>
        <li class="nav-item nav-list-0 users"><a class="nav-link" href='<?php echo ADMINURL; ?>users'><span class="fa fa-user"></span> <span class="title">Users Management (<?php echo count($usermenu); ?>)</span></a></li>
        <?php } ?>
        <?php if(in_array("Visitors List", $menuname)){ ?>
        <li class="nav-item"><a class="nav-link" href="<?php echo ADMINURL; ?>visitor.php"><span class="fa fa-user"></span> <span class="title">Visitors List (<?php echo count($getvlistcnt) ?>)</span></a></li>
        <?php } ?>
        <?php if(in_array("Testimonials", $menuname)){ ?>
        <li class="nav-item"><a class="nav-link" href='<?php echo ADMINURL; ?>testimonial/'><span class="fa fa-list-alt"></span> <span class="title">Testimonials</span></a></li>
        <?php } ?>
        <?php if(in_array("Blog", $menuname)){ ?>
        <li class="nav-item"><a class="nav-link" href='<?php echo ADMINURL; ?>blog/viewlist.php'><span class="fa fa-list-alt"></span> <span class="title">Blog</span></a></li>
        <li class="nav-item"><a class="nav-link" href='<?php echo ADMINURL; ?>blog/comment.php'><span class="fa fa-list-alt"></span> <span class="title">Blog Comments</span></a></li>
        <?php } ?>
        <?php if(in_array("Support", $menuname)){
        $supportstafflists = selectQuery(SUPPORTSTAFF,"*","isDel='0' and emp_group<>".CLIENTGROUPID);
        $getopenofalldetpt = selectQuery(CONTACT,"*","isOpen='1' and isClosed='0'"); ?>
        <li class='dropdown support'>
            <a class="nav-link" href='javascript:void(0);'><span class="fa fa-ticket"></span> <span class="title">Support Ticketing System (<?php echo count($getopenofalldetpt) ?>)</span></a>
            <ul class="dropdownMenu list-unstyled">
                <li class="nav-item"><a class="nav-link" href='<?php echo ADMINURL; ?>support/' id="menu26submenu1"><span class="title">Manage Departments (<?php echo count($getdeptcnt) ?>)</span></a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo ADMINURL; ?>support/staffgrouplist.php"><span class="title">Staff Group</span></a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo ADMINURL; ?>support/staff.php"><span class="title">Staff Members (<?php echo count($supportstafflists);?>)</span></a></li>
                <!--<li><a href='<?php echo ADMINURL; ?>support/' id="menu26submenu1"><span>Manage Departments(<?php echo count($getdeptcnt) ?>)</span></a></li>
                <?php for($m=0;$m<count($supportlists);$m++){
                $submenucnt = $m+2; $dep = $supportlists[$m]['dept_id'];
                $getopencnt = selectQuery(CONTACT,"*","dept=".$supportlists[$m]['dept_id']." and isOpen='1' and isClosed='0'"); ?>
                <li><a href='<?php echo ADMINURL; ?>support/supportrequest.php?dept=<?php echo base64_encode($supportlists[$m]['dept_id']); ?>' id="menu26submenu<?php echo $submenucnt; ?>"><span><?php echo $supportlists[$m]['dept_name']; ?> (<?php echo count($getopencnt)?>)</span></a></li>
                <? } ?>-->
            </ul>
        </li>
        <?php } ?>
        <li class="nav-item"><a class="nav-link" href="<?php echo SUPPORTURL; ?>home.php"><span class="fa fa-sitemap"></span> <span class="title">CRM</span></a></li>      
        <?php if(in_array("SMS Report", $menuname)){ ?>
        <li class="nav-item"><a class="nav-link" href='<?php echo ADMINURL; ?>setting/showenquirysms.php'><span class="fa fa-pencil"></span> <span class="title">SMS Enquiry (<?php echo count($getsmsenquiry);?>)</span></a></li>
        <?php } if($getusertype=='Admin'){?>
        <li class="nav-item"><a class="nav-link" href="<?php echo ADMINURL; ?>status/index.php"><span class="fa fa-sitemap"></span> <span class="title">Manage Status</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo ADMINURL; ?>notification/index.php"><span class="fa fa-sitemap"></span> <span class="title">Manage Messages</span></a></li>            
        <?php } ?>
    </ul>
</nav>