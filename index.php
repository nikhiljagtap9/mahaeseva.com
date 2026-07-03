<?php if((time() - $_SESSION['prod_enter_time'] >= 150)){ $_SESSION['orderid']=""; $_SESSION['txnid']=""; }
function parse_path(){
    $path = array();
    if (isset($_SERVER['REQUEST_URI'])){
        $request_path = explode('?', $_SERVER['REQUEST_URI']);
        $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
        $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
        $path['call'] = utf8_decode($path['call_utf8']);
        if ($path['call'] == basename($_SERVER['PHP_SELF'])){ $path['call'] = ''; }
        $path['call_parts'] = explode('/', $path['call']);
        $path['query_utf8'] = urldecode($request_path[1]);
        $path['query'] = utf8_decode(urldecode($request_path[1]));
        $vars = explode('&', $path['query']);
        foreach ($vars as $var){
            $t = explode('=', $var);
            $path['query_vars'][$t[0]] = $t[1];
        }
    }
    return $path;
}
$path_info = parse_path();
switch($path_info['call_parts'][0]){
    case 'home':
    include 'home.php';
    break;
    case 'agreement':
    include 'create_agreement.php';
    break;
    case 'appointment':
    include 'bookappointment.php';
    break;
    case 'pay':
    include 'payment_confirmation.php';
    break;
    case 'success':
    include 'success.php';
    break;
    case 'failure':
    include 'failure.php';
    break;
    case 'paymentsuccess':
    include 'paymentsuccess.php';
    break;
    case 'proceedpayment':
        include 'proceedpayment.php';
    break;
    case 'login':
    include 'login.php';
    break;
    case 'contact':
    include 'contact.php';
    break;
    case 'cod_success':
    include 'cod_success.php';
    break;
    case 'blog':
    include 'blogdetail.php';    
    break;
    case 'bloglist':
    include 'blog.php';
    break;
    case 'app-login':
    include 'app-login.php';
    break;
    case 'account':
    switch($path_info['call_parts'][1]){
        case '':
        include ("includes/configuration.php");
        include 'account/index.php';
        break;
        case 'myagreements':
        include ("includes/configuration.php");
        include 'account/myagreements.php';
        break;
        case 'agreement_view':
        include ("includes/configuration.php");
        include 'account/agreementview.php';
        break;
    }
    break;
    case 'construction':
    include 'page_underconstruction.php';
    break;
    case 'termsconditions':
    include 'termsconditions.php';
    break;
    case 'privacy-policy':
    include 'privacy-policy.php';
    break;
    case 'cancellation-refund-policy':
    include 'cancellation-refund-policy.php';
    break;
    default:
    include 'home.php';
} ?>