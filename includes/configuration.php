<?php error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
session_start();
ini_set('display_errors', 'Off');
include "variables.php";
include "db.php";
include "function.php";
include "customconfig.php";
//***************************** Projects Paths ************************************************//
define("DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]);
define("ADMINURL", SITEURL . "/admin/"); // admin url
define("SELLERURL", SITEURL . "/seller/"); // seller url
define("SUPPORTURL", SITEURL . "/support/"); // support url
define("LOADER", SITEURL . "/img/projectimage/loader.gif"); // loader
//***************************** Functionalities ************************************************//
define("SMS_SYSTEM", "ON"); //enable OR disable sms functionality
define("FULLSLIDER", "ON");
define("SOCIALLOGIN", "OFF"); // login with social medial functionality
setlocale(LC_MONETARY, 'en_IN'); // Comma seperation country identifier
//***************************** Variable Declarations  ************************************************//
define("WORKINGKEY", $workingkey);
define("SMS_SENDER", $smssender);
define("AUTHKEY", $authkey);  // whatsapp
define("APPKEY", $appkey);  // whatsapp
define("MARCHANTKEY", $mrkey);
define("SALT", $slt);
define("PAYURL", $payurl);
define("RAZORENV", "test");
define("RAZORAPIKEY", "rzp_live_fozX1Kc1LBNYSj");
define("RAZORSECRETE", "QB9xWI1gAri8ssKHApHAobYl");
$displayCurrency = 'INR';
//***************************** Function Declarations ************************************************//
extract($_POST);
extract($_GET);
//***************************** File Types Declarations ************************************************//
$imgtypes = array('jpg', 'jpeg', 'gif', 'png');
$applicationtype = array('cad', 'doc', 'docx', 'mp3', 'm4a', 'mp4', 'm4v', 'mov', 'odt', 'ogg', 'pdf', 'ppt', 'pptx', 'pps', 'ppsx', 'wav', 'wmv', 'xls', 'xlsx', 'zip');
//*********************************************************************************************//
date_default_timezone_set('Asia/Kolkata'); ?>