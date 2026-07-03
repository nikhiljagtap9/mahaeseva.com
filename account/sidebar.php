<?php if( $user== ""){ ?>
<script>var x ='<?php echo SITEURL; ?>'; window.location.assign(x);</script>
<?php } ?>
<div class=" col-12 col-lg-3 pr-0 d-none d-lg-block">
    <div class="sidebar card">
        <div class="acctdetails card-body">
            <i class="fa fa-user-circle mb-2"></i>
            <h5 class="h6 text-primary mb-0"><?php echo $userdata[0]['u_fname']." ".$userdata[0]['u_lname'];  ?></h5>
            <div class="text-muted"><?php echo $userdata[0]['u_email'];  ?></div>
        </div>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                <li><a href="<?php echo SITEURL; ?>/account" class="linkcolor pt-0"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a></li>
                <li><a href="<?php echo SITEURL;?>/account/myagreements" class="linkcolor pb-0"><i class="fa fa-shopping-bag" aria-hidden="true"></i> My Agreements</a></li>
                <!--<li><i class="fa fa-star" aria-hidden="true"></i><a href="<?php echo SITEURL; ?>/userratings" class="linkcolor">Rating <span class="badges">(<?php echo count($userratingtotal); ?>)</span></a> </li>
                <li><i class="fa fa-bars" aria-hidden="true"></i><a href="<?php echo SITEURL; ?>/userreviews" class="linkcolor">Review <span class="badges">(<?php echo count($userreviewstotal); ?>)</span></a></li>-->
            </ul>
        </div>
    </div>
</div>