<?php include("includes/configuration.php");
$hitfrom = "";
if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
    //check for ip from share internet
    $ip = $_SERVER["HTTP_CLIENT_IP"];
} elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
    // Check for the Proxy User
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
    $ip = $_SERVER["REMOTE_ADDR"];
}
/*$agent = $_SERVER['HTTP_USER_AGENT']; */
if (!isset($_SERVER['HTTP_USER_AGENT'])) {
    $agent = "none";
} else {
    $agent = $_SERVER['HTTP_USER_AGENT'];
}
$browser = 'NA';
if ((preg_match('/MSIE/i', $agent) || preg_match('/Trident/i', $agent) || (preg_match('/Trident/i', $agent) && stristr($_SERVER['HTTP_USER_AGENT'], 'Windows Phone'))) && !preg_match('/Opera/i', $agent)) {
    $browser = 'Internet Explorer';
    $ub = "MSIE";
} elseif (preg_match('/Windows NT 10/i', $agent) && preg_match('/Edge/i', $agent)) {
    $browser = 'Microsoft Edge';
    $ub = "Edge";
} elseif (preg_match('/Firefox/i', $agent) && !preg_match('/Iceweasel/i', $agent)) {
    $browser = 'Mozilla Firefox';
    $ub = "Firefox";
} elseif (preg_match('/Chrome/i', $agent)) {
    $browser = 'Google Chrome';
    $ub = "Chrome";
} elseif (preg_match('/Safari/i', $agent)) {
    $browser = 'Apple Safari';
    $ub = "Safari";
} elseif (preg_match('/Opera/i', $agent)) {
    $browser = 'Opera';
    $ub = "Opera";
} elseif (preg_match('/Netscape/i', $agent)) {
    $browser = 'Netscape';
    $ub = "Netscape";
} elseif (preg_match('/Iceweasel/i', $agent) && preg_match('/Firefox/i', $agent)) {
    $browser = 'Iceweasel';
    $ub = "Iceweasel";
}
$device = '';
if (stristr($_SERVER['HTTP_USER_AGENT'], 'ipad')) {
    $device = "ipad";
} else if ((stristr($_SERVER['HTTP_USER_AGENT'], 'iphone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iphone')) && stristr($_SERVER['HTTP_USER_AGENT'], 'Windows Phone') === FALSE) {
    $device = "iphone";
} else if (stristr($_SERVER['HTTP_USER_AGENT'], 'Windows Phone')) {
    $device = "Windows Phone";
} else if (stristr($_SERVER['HTTP_USER_AGENT'], 'blackberry')) {
    $device = "blackberry";
} else if (stristr($_SERVER['HTTP_USER_AGENT'], 'android')) {
    $device = "android";
} else if (stristr($_SERVER['HTTP_USER_AGENT'], 'Windows NT 10.0')) {
    $device = "Windows 10";
} else if (stristr($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6.1')) {
    $device = "Windows 7";
} else if (preg_match('/linux/i', $_SERVER['HTTP_USER_AGENT'])) {
    $device  = "Linux";
}
if (stristr($_SERVER['HTTP_USER_AGENT'], 'Twitterbot')) {
    $hitfrom = "Twitter";
} else if (stristr($_SERVER['HTTP_USER_AGENT'], 'facebookexternalhit')) {
    $hitfrom = "Facebook";
}
$cookie_name = 'visit';
$cookie_value = '1111';
setcookie($cookie_name, $cookie_value, time() + 600); // 86400 = 1 day
if (!isset($_COOKIE[$cookie_name])) {
    /* print 'Cookie with name "' . $cookie_name . '" does not exist...';*/
    $datalog = array('ip' => $ip, 'device' => $device, 'browser' => $browser, 'details' => $agent, 'time' => date('d/m/Y H:i:s'),);
    $s = insertQuery(VLIST, $datalog);
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo SITE_TITLE; ?></title>
    <?php include 'commoncss.php' ?>
    <link rel="stylesheet" href="css/thumb-slider/owl.carousel.min.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-726761326"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'AW-726761326');
    </script>
</head>

<body>
    <div class="preLoader"></div>
    <?php include 'menu.php' ?>
    <section class="position-relative py-5 bg-light">
        <div id="particles_js"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-6">
                    <div class="banner-content text-center text-md-left">
                        <p class="lead mb-2">Get Fastest Rent Agreement At Your Doorstep</p>
                        <h1 class="mb-4 h2">Simplest + Quick + Safe <br><span class="fw-7">Online Rent Agreement Registration</span></h1>
                        <div>
                            <?php if ($loginuserid == "") { ?>
                                <button class="logbtn btn btn-primary px-3 mr-2 mb-2 mb-lg-0" data-toggle="modal" data-target="#loginmod">Create Rent Agreement</button>
                            <? } else { ?>
                                <a class="btn btn-primary logbtn px-3 mr-2 mb-2 mb-lg-0" href="<?php echo SITEURL; ?>/agreement">Create Rent Agreement</a>
                            <? } ?>
                            <a href="#sentenq" class="btn btn-primary sentbtn px-3 mb-2 mb-lg-0">Request Call back</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 d-none d-md-block">
                    <div class="banner-image"><img src="img/projectimage/slide.png" alt="slide" width="570" height="482" class="img-fluid"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 write-about-us">
        <div class="container">
            <div class="section-title text-center pb-md-3">
                <h2 class="h4 fw-7 mb-0 text-uppercase">About Us</h2>
                <p class="lead mb-md-0 mb-lg-4">MahaEseva.com is a most preferred online platform for generating <br>online rent registration agreements.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 pr-md-5">
                    <p class="text-muted">Our platform is trusted as most efficient and easiest panel by more than 3000+ satisfied customers. We are committed to provides quick, easy and hassle free services to all citizens and deliver the best in class customer satisfaction</p>
                    <p class="text-muted mb-0">We are working towards solving one key problem of the Rental market in India - To build trust and transparency between tenants, landlords and Property managers. Today we handle Property Rent payments and collections worth millions every month, helping thousands of tenants to save on their Rent payments and Deposits while enabling Landlords and property managers to earn better on rentals.</p>
                    <hr>
                    <div class="mt-3 row mb-4 mb-lg-0">
                        <div class="col-6 col-md-6">
                            <div class="media work-count-col">
                                <img src="img/projectimage/satisfied-customer.png" alt="satisfied-customer" class="img-fluid mr-3" width="40">
                                <div class="media-body">
                                    <h4 class="h2 fw-6 m-0 text-primary">3000+</h4>
                                    <div>Satisfied Customers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 pl-0">
                            <div class="media work-count-col">
                                <img src="img/projectimage/contract-with-pen.png" alt="satisfied-customer" class="img-fluid mr-3" width="40">
                                <div class="media-body">
                                    <h4 class="h2 fw-6 m-0 text-primary">3500+</h4>
                                    <div>Agreements registered</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="videoview"><iframe height="330" src="https://www.youtube.com/embed/dF0I9Xk8GU8" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center pb-3">
                <h2 class="h4 fw-7 mb-0 text-uppercase">Online Rent Agreement</h2>
                <p class="lead mb-0 mb-md-4">Quick 3 Easy Steps</p>
            </div>
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0"><img src="img/projectimage/rent-agreement-step.png" alt="rent-agreement-step" class="img-fluid mt-2" width="400"></div>
                <div class="col-md-6">
                    <div class="single-feature">
                        <div class="media mb-3">
                            <img src="img/projectimage/booking-online.png" alt="booking-online" class="svg mr-4" width="55">
                            <div class="media-body">
                                <h4 class="h5 mb-1">Enter Rent Details Online</h4>
                                <p class="text-muted mb-0">Enter the all the information about rent agreement, system will calculate the stamp duty charges immediately which you can pay online as well as avail cash on delivery option too</p>
                            </div>
                        </div>
                    </div>
                    <div class="single-feature">
                        <div class="media mb-3">
                            <img src="img/projectimage/biometric.png" alt="biometric" class="svg mr-4" width="55">
                            <div class="media-body">
                                <h4 class="h5 mb-1">Home Service For Bio-metric Verification</h4>
                                <p class="text-muted mb-0">Book appointment for Bio-Metric Verification, and our executives will provide you doorstep service for bio-metric verification for both landlord and tenant (All 365 days you can book appointments)</p>
                            </div>
                        </div>
                    </div>
                    <div class="single-feature">
                        <div class="media">
                            <img src="img/projectimage/delivery-truck.png" alt="delivery-truck" class="svg mr-4" width="55">
                            <div class="media-body">
                                <h4 class="h5 mb-1">Get Home Delivery</h4>
                                <p class="text-muted mb-0">Within 3-4 working days get the soft copy of e-stamped rental agreement will be delivered to your email, totally hassle free service</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <? $getblog = selectQuery(BLOG, "id,title,category,posted_by,url_title", "isActive='1'"); /*and showonhomepage ='1'*/
    if (count($getblog) != 0) { ?>
        <section class="py-5 hm-blog-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center pb-md-3">
                            <h2 class="h4 fw-7 mb-4 text-uppercase">BlOG</h2>
                        </div>
                        <div class="owl-carousel owl-theme owlblog">
                            <?php for ($i = 0; $i < count($getblog); $i++) {
                                $blogidimg = selectQuery(BLOGIMG, "img_name", "blogid='" . $getblog[$i]['id'] . "'");
                                $cat_name = selectQuery(BLOGCAT, "category_name", "cat_id='" . $getblog[$i]['category'] . "'"); ?>
                                <div class="item">
                                    <div class="blog-box card card-3">
                                        <div class="blog-thumb mb-3">
                                            <a href="<?= SITEURL ?>/blog/<?php echo $getblog[$i]['url_title']; ?>" class="d-block">
                                                <img class="img-fluid m-auto rounded" src="<?= SITEURL; ?>/<?php if ($blogidimg[0]['img_name'] != "") {
                                                                                                                echo "img/blogimg/" . $blogidimg[0]['img_name'];
                                                                                                            } else {
                                                                                                                echo "img/projectimage/No_image_available.png";
                                                                                                            } ?>" alt="<?= $getblog[$i]['title']; ?>">
                                            </a>
                                        </div>
                                        <div class="blog-body px-3 pb-3">
                                            <div class="small text-primary mb-1 text-uppercase">Category - <?= $cat_name[0]['category_name']; ?></div>
                                            <h3 class="blog-title h6" title="<?= $getblog[$i]['title']; ?>">
                                                <?= (strlen($getblog[$i]['title']) > 44 ? substr($getblog[$i]['title'], 0, 45) . ".." : $getblog[$i]['title']); ?></h3>
                                            <div class="blog-writer mb-3 text-muted"><i class="fa fa-user mr-1"></i> By <span><?php if ($getblog[$i]['posted_by'] == "") {
                                                                                                                                    echo "NA";
                                                                                                                                } else {
                                                                                                                                    echo $getblog[$i]['posted_by'];
                                                                                                                                } ?></span></div>
                                            <a href="<?= SITEURL ?>/blog/<?php echo $getblog[$i]['url_title']; ?>" class="d-block">Read More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <? } ?>
    <section class="services-title bg-light position-relative py-5 bg-light">
        <div class="container">
            <div class="section-title text-center pb-3">
                <h2 class="h4 fw-7 mb-0 text-uppercase">Why You Need Our Service</h2>
                <p class="lead mb-4">We are committed to provides quick, easy and hassle free services to all citizens </p>
            </div>
            <div class="row ourservices">
                <div class="col-sm-6 col-md-6 col-lg-3 text-center">
                    <div class="single-feature service-box mb-4 mb-lg-0">
                        <img src="img/projectimage/online-support.png" alt="booking-online" data-no-retina class="svg" width="45" height="45">
                        <h3 class="h5 mt-3">Offline Support</h3>
                        <p class="text-muted mb-0">Enjoy our Special service with Offline Support. Our executives will help you to complete the agreement, get the appointments, offline payments (Cash On Delivery) </p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 text-center">
                    <div class="single-feature service-box mb-4 mb-lg-0">
                        <img src="img/projectimage/reliability.png" alt="biometric" class="svg" width="45" height="45">
                        <h3 class="h5 mt-3">Trust & Safety </h3>
                        <p class="text-muted mb-0">Our all executives are handpicked trained resources and all can be easily identified by the Uniform & ID Cards which assures 100% Trust and Safety</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 text-center">
                    <div class="single-feature service-box mb-4 mb-lg-0">
                        <img src="img/projectimage/gdpr.png" alt="delivery-truck" class="svg" width="45" height="45">
                        <h3 class="h5 mt-3">Police Verification</h3>
                        <p class="text-muted mb-0">We help all customers in completing the end-to-end police verification process and making entire process completely hassle and worry free</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 text-center">
                    <div class="single-feature service-box mb-4 mb-lg-0">
                        <img src="img/projectimage/remote-control.png" alt="delivery-truck" class="svg" width="45" height="45">
                        <h3 class="h5 mt-3">Remote Registration</h3>
                        <p class="text-muted mb-0">Make rent agreement from any part of the world, we are expert in remote e-rent agreement registration services</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="position-relative pt-5 pb-5 text-center">
        <div class="container">
            <div class="section-title text-center pb-2">
                <h2 class="h4 fw-7 mb-4 text-uppercase">Our Speciality</h2>
            </div>
            <div class="row mr-0">
                <div class="col-lg-3 col-md-4 col-sm-6 pr-0 mb-3">
                    <div class="card p-4 spe-features h-100">
                        <img src="img/projectimage/icons/security.svg" alt="security" height="40">
                        <h5 class="mt-3">Ensure Privacy & Security</h5>
                        <p class="text-muted mb-0">All data is kept safe and your data is not shared with any third party</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pr-0 mb-3">
                    <div class="card p-4 spe-features h-100">
                        <img src="img/projectimage/icons/cybersec.svg" alt="cybersec" height="40">
                        <h5 class="mt-3">Cyber Security Audits</h5>
                        <p class="text-muted mb-0">To give safest platform, we perform bi-monthly cyber security audits making sure about cyber safety of data</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pr-0 mb-3">
                    <div class="card p-4 spe-features h-100">
                        <img src="img/projectimage/icons/employee.svg" alt="employee" height="40">
                        <h5 class="mt-3">Trained Employees</h5>
                        <p class="text-muted mb-0">We have made 3000+ agreements and we assure every client about completely error free service</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pr-0 mb-3">
                    <div class="card p-4 spe-features h-100">
                        <img src="img/projectimage/icons/internet.svg" alt="internet" height="40">
                        <h5 class="mt-3">Safety Policy</h5>
                        <p class="text-muted mb-0">Clients safety is prime concern to us, all home visit appointments are carried by executives in Uniform and ID Cards with pre and post intimated SMS alerts</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pr-0 mb-3">
                    <div class="card p-4 spe-features h-100">
                        <img src="img/projectimage/icons/radar.svg" alt="radar" height="40">
                        <h5 class="mt-3">Multiple Area Support</h5>
                        <p class="text-muted mb-0">We provide multi agreement with multi area support, making task easier for multi property owners</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pr-0 mb-3">
                    <div class="card p-4 spe-features h-100">
                        <img src="img/projectimage/icons/promotion.svg" alt="promotion" height="40">
                        <h5 class="mt-3">Legal Experts</h5>
                        <p class="text-muted mb-0">We have in-house team of legal advisors, so forget all legal trouble in rent agreement if you have any</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pr-0 mb-3">
                    <div class="card p-4 spe-features h-100">
                        <img src="img/projectimage/icons/clipboard.svg" alt="clipboard" height="40">
                        <h5 class="mt-3">Keep a track of the Status</h5>
                        <p class="text-muted mb-0">Get alerts and notifications of application status and agreement expiry reminders to tenants and property owners</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pr-0 mb-3">
                    <div class="card p-4 spe-features h-100">
                        <img src="img/projectimage/icons/pay.svg" alt="pay" height="40">
                        <h5 class="mt-3">Offline Payments</h5>
                        <p class="text-muted mb-0">We accept payments through online and offline (Cash On Delivery) making easy and convenient payment options</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="servers calcu bg-primary text-white" id="rentagrementcal">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 text-right d-none d-md-block"><img src="img/projectimage/man-calculet-agreement.png" alt="man-calculet-agreement" class="img-fluid rent-agree-cal-man" width="224"></div>
                <div class="col-12 col-md-7 offset-md-1 py-5">
                    <div class="section-title mr-20">
                        <h2 class="h4 fw-7 mb-1 text-uppercase">Rent Agreement Registration Cost Calculator</h2>
                        <p class="lead mb-4">You can calculate the tentative cost of Rent Agreement Registration here</p>
                    </div>
                    <div class="row mr-0">
                        <div class="col-6 col-md-6 col-lg-4 pr-0">
                            <div class="form-group">
                                <label class="small">Property In Area</label>
                                <select class="form-control calpropertytype border-0">
                                    <option value="<?php echo URBANCHRG; ?>">Urban (शहरी)</option>
                                    <option value="<?php echo RURALCHRG; ?>">Rural (ग्रामीण)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4 pr-0">
                            <div class="form-group">
                                <label class="small">Number Of Month</label>
                                <input type='text' name="calduration" class="form-control calduration border-0" id='calduration' onkeyup="numbercheck('calduration');" maxlength="2" placeholder="Enter Month" />
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4 pr-0">
                            <div class="form-group">
                                <label class="small">Deposite Amount</label>
                                <input type='text' name="caldeposite" class="form-control caldeposite border-0" id='caldeposite' onkeyup="numbercheck('caldeposite');" maxlength="6" placeholder="Enter Deposite Amount" />
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4 pr-0">
                            <div class="form-group">
                                <label class="small">Monthly Average Rent</label>
                                <input type='text' name="calrent" class="form-control calrent border-0" id='calrent' onkeyup="numbercheck('calrent');" maxlength="6" placeholder="Enter Monthly Average Rent" />
                            </div>
                        </div>
                        <div class="col-md-8 pr-0"><label class="small d-none d-lg-block">&nbsp;</label>
                            <div><button class="btn btn-dark" type="button" onclick="calculate()">Calculate Agreement</button></div>
                        </div>
                    </div>
                    <div class="calcimsgs"></div>
                    <div class="calculate-result"></div>
                </div>
            </div>
        </div>
    </section>
    <?php $gettestimonials = selectQuery(TESTIMONIALS, "*", "isActive='1' and isDel='0' ");
    if (count($gettestimonials)) { ?>
        <section class="pt-5 pb-5">
            <div class="container">
                <div class="section-title text-center pb-2">
                    <h2 class="h4 fw-7 mb-1 text-uppercase">What Client's Say About Us</h2>
                </div>
                <div class="swiper-container review-slider mb-md-5">
                    <div class="owl-carousel owl-theme owl-testimonial">
                        <?php for ($i = 0; $i < count($gettestimonials); $i++) { ?>
                            <div class="swiper-slide single-review-slide text-center">
                                <div class="p-3 testim-col mb-1">
                                    <?php if (strlen($gettestimonials[$i]['testimonials']) > 290) {
                                        $arr = str_split($gettestimonials[$i]['testimonials']);
                                        $str = "";
                                        for ($j = 0; $j < 285; $j++) {
                                            $str = $str . "" . $arr[$j];
                                        }
                                        echo $str . "...";
                                    } else {
                                        echo $gettestimonials[$i]['testimonials'];
                                    } ?>
                                </div>
                                <div class="media d-inline-flex">
                                    <img src="img/projectimage/testim-icon.png" alt="testim-icon" width="38" class="mr-2">
                                    <div class="media-body text-left">
                                        <div class="small text-warning"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                        <h6 class="mb-0 text-primary"><?= $gettestimonials[$i]['client_name']; ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="swiper-pagination review-pagination position-static"></div>
            </div>
        </section>
    <? } ?>
    <section class="pb-5 pt-5 pt-md-0 bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-10 m-auto">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-5 d-none d-md-block">
                            <div class="text-center mob-app-thumb"><img src="<?php echo SITEURL; ?>/img/projectimage/mobile.png" alt="mobile" width="220" height="455" class="img-fluid"></div>
                        </div>
                        <div class="col-lg-6 col-md-7">
                            <div class="app-info mt-md-4 mt-lg-0">
                                <h2 class="h3 fw-7 text-white text-uppercase">Download MahaEseva Application</h2>
                                <p class="mb-4 text-white">Maha Eseva App enables you to create a residential and commercial rent agreements on your phone, anywhere, anytime. Verified by lawyers and delivered to your doorstep, this is convenience redefined!</p>
                                <div><a href="#"><img src="img/projectimage/play-store.png" alt="play-store" height="55"></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="js/thumb-slider/owl.carousel.min.js"></script>
    <script src="js/particles.js/particles.min.js"></script>
    <script src="js/particles.js/particles.settings.js"></script>
    <script>
        $(".sentbtn").click(function() {
            $(".sentEnquiry .panel-body").slideToggle();
        });
    </script>
    <script>
        var owlblog = $('.owlblog');
        owlblog.owlCarousel({
            loop: false,
            nav: true,
            margin: 15,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                500: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });
        $("#cal").click(function() {
            $('html, body').animate({
                scrollTop: $(".calcu").offset().top
            }, 2000);
        });
        $(document).ready(function() {
            $(".navigation a").on('click', function(event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function() {
                        window.location.hash = hash;
                    });
                }
            });
        });
        var owl = $('.owl-testimonial');
        owl.owlCarousel({
            loop: true,
            nav: false,
            margin: 20,
            dots: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });
    </script>
</body>

</html>