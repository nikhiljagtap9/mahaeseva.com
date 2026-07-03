<?php
//***************************** API Details ************************************************//
define("apikey",""); //api key for checking validation 5d35a6b2aed3f 6 june 2020
//***************************** Website Details ************************************************//
define("SITE_TITLE","Maha-E-Seva - Online Rent Agreements"); //Title Of website
define("SITENAME","Maha-E-Seva"); //Name Of website used in emails
define("SITEURL","https://".$_SERVER['SERVER_NAME']); //url website
//************************* CartAdmin Subscription Details ************************************//
define("subscription_start_date","2017-07-07"); // Support url YYYY-MM-DD
define("subscription_end_date","2018-07-07");  // Support url  YYYY-MM-DD
//***************************** All Invoices Abrevations ************************************//
define("FINALORD","AG"); //invoice id start with
define("PAYMENTID","AGPAY"); //payment id start with
//***************************** SMS Gateway ************************************************//
$smssender="MHSEVA";
$workingkey="A272c2c1d506c3bddd0eda43b27fe4c44";
define("SMS_SITE_NAME","Mahaeseva.com");
//***************************** Payment Gateway ************************************************//
$mrkey ="5pL0OJxs"; //MERCHANT KEY
$slt = "JIGZfJGhKq"; //SALT
$payurl = "https://secure.payu.in"; //PAYU MONEY LIVE URL (TEST URL = https://test.payu.in) https://secure.payu.in
//***************************** Contact Details ************************************************//
define("CONTACTNO","7559671555");
define("ADDRESS","Maha E-Seva Kendra, Opp. Bhalerao Hospital, Shitole Nagar, Old Sangavi, Pune - 411027");
define("MAP","https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15127.664727519848!2d73.81249834787506!3d18.577817196018973!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2b9cea4bd0e49%3A0x79004e5bbd1912ca!2sMaha-E-Seva.com!5e0!3m2!1sen!2sin!4v1536418744835");
//***************************** Email Settings ************************************************//
define("MAIN_ADMIN","mahaeseva.com@gmail.com");
define("email_footer","mahaeseva.com@gmail.com"); //email for footer and contact page
define("EMAIL_SENDER","mahaeseva.com@gmail.com"); //email for sender email in mail
# define("EMAIL_REG","omi.mahesh@gmail.com"); //email for registration releted emails
define("EMAIL_ORDER","mahaeseva.com@gmail.com"); //email for order related emails
define("EMAIL_CONTACT","mahaeseva.com@gmail.com"); //email for contact related emails
define("ADMINNO","9604141516");
define("ADMINMOB","9604141516");
//***************************** Login With Social Media ****************************************//
/* Facebook App Details */
define("FB_APPID","");
define("FB_SECRETEKEY","");
define("FB_CALLBACKURL","");
/* GP+ App Details */
define("GP_appname","");
define("GP_CLIENTID","");
define("GP_SECRETEKEY","");
define("GP_CALLBACKURL","");
//*********************************************************************************************//
//**************************** Home Page Social Media Icon Links ******************************//
define("FBLINK","https://www.facebook.com/mahaeseva.comrentagreement"); 
define("TWITTERLINK","https://www.twitter.com/rentagreement");     
define("INSTAGRAMLINK","http://www.instagram.com/online_rent_agreement");
//*******************************************************************************************//
//***************************** Client ids (Added by Lalit)************************************************//
define('CLIENTGROUPID',"17"); //Important: Set value from database
define('CLIENTDEPTID',"7"); //Important: Set value from database
//*********************************************************************************************//
//**************************** Analyitic IDs ***********************************************//
define("GOOGLEANAYTICSID","UA-104095168-1"); //Google Analytics ID
//*******************************************************************************************//
//***************************** Meta Data Details ************************************************//
define('METADESCRIPTION',"Leading provider of Online Rent Agreement Registration in Pune and Pimpri, We provide Online Rent Agreement at your doorstep. Minimum fees and
convenient process, Most preferred online platform for generating online rent registration agreements, Tenant rent agreement online at your doorstep in easy steps,
Instantly");
define('METAKEYWORDS',"");
//********************************** Variables ************************************************//
define("SERVICECHRG","700");
define("RURALCHRG","500");
define("URBANCHRG","1000");
define("VISITCHRG","300");
define("DHC","300");
define("XTRAVISITCHRG","300");
define("POLICECHRG","300");
define ("cityarr", serialize (array ("Pune","Nashik","Aurangabad","Ahmednagar","Jalgaon","Nagpur","Mumbai","Nanded","Akola")));
define ("occuarr", serialize (array ("Service","Business","Student","Housewife","Agriculture","Retired Govt Officer","Other")));
define ("proparr", serialize (array ("Apartment/Flat","Godown","Land Bldg/Shed","Shop","Office")));
//*********************************************************************************************//
define("REVIEWCNTPAGE",8); //used for pagination
define("BLOGCNTPAGE",8); //used for pagination
//**********************************Whats app Message**********************************************//
$appkey="90b0d2ff-1153-40ef-93c8-62a79b3b5537";
$authkey="kFHWcagqY5d39qjD8z1vKTH9k8LnofUU8UP8TN741K4fqMQQWK";
?>
