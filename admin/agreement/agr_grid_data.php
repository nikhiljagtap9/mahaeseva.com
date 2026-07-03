<?php include("../../includes/configuration.php"); $requestData = $_REQUEST;
$columns = array(0 =>'#', 1 => 'Agreement ID', 2 => 'Token No', 3 => 'Client', 4=> 'Entry Date', 5=> 'Payment Mode', 6=> 'Payment Status', 7=> 'Agreement Status', 8=> 'Action');
if(!empty($requestData['search']['value'])){
    $searchguest1 = selectQuery(AGR,"*","isDel='0' and (agreement_no like '%".$requestData['search']['value']."%' OR payment_mode like '%".$requestData['search']['value']."%' OR agreement_status like '%".$requestData['search']['value']."%' OR govt_token_no like '%".$requestData['search']['value']."%')"); 
    $totalData = count($searchguest1);
    $totalFiltered=$totalData;
    $searchguest=selectQuery(AGR,"*","isDel='0' and (agreement_no like '%".$requestData['search']['value']."%' OR payment_mode like '%".$requestData['search']['value']."%' OR agreement_status like '%".$requestData['search']['value']."%' OR govt_token_no like '%".$requestData['search']['value']."%') order by agree_id DESC LIMIT ".$requestData['start']." ,".$requestData['length']);
    $data = array(); $fltcnt = 0;
    if(count($searchguest)){
        for($i=0;$i<count($searchguest);$i++){
            $fltcnt+=1; $nestedData = array();
            if($searchguest[$i]['payment_mode']!=""){
                $mode = $searchguest[$i]['payment_mode'];
                if($searchguest[$i]['isPaid']=="1"){ $paystatus="<span class='text-success'>(Paid)</span>"; }
                else{ $paystatus="<span class='text-danger'>(Pending)</span>"; }
            } else{
                $mode = "<span class='text-danger'>Not Processed</span>";
                $paystatus="";
            } if($searchguest[$i]['govt_token_no']!=""){ $token = $searchguest[$i]['govt_token_no']; }
            else{ $token="[Not Defined]"; }
            $client = selectQuery(WEB_USER,"u_fname,u_lname","u_id=".$searchguest[$i]['agree_by']);
            $cname = $client[0]['u_fname']." ".$client[0]['u_lname'];
            $delfunc = "del('del_agreement','".$searchguest[$i]['agreement_no']."')";
            $action='<button type="button" class="btn btn-danger btn-sm" onclick="'.$delfunc.'"><i class="fa fa-trash" ></i></button>';
            $nestedData[] = $requestData['start']+$fltcnt;
            $nestedData[] = "<a href='agreementdetails.php?agr=".base64_encode($searchguest[$i]['agreement_no'])."'>".$searchguest[$i]['agreement_no']."</a>";
            $nestedData[] = $token;
            $nestedData[] = $cname;
            $nestedData[] = date("d M Y",strtotime($searchguest[$i]['entry_on']))."<br>".date("h:i a",strtotime($searchguest[$i]['entry_on']));
            $nestedData[] = $mode." ".$paystatus;
            $nestedData[] = $searchguest[$i]['agreement_status'];
            $nestedData[] = $action;
            $data[] = $nestedData;
        }
    }
} else{
    $getguest1 = selectQuery(AGR,"*","isDel='0'"); $totalData = count($getguest1); $totalFiltered = $totalData; $getguest = selectQuery(AGR,"*","isDel='0'  order by agree_id DESC LIMIT ".$requestData['start']." ,".$requestData['length'].""); $data = array();
    for($i=0;$i<count($getguest);$i++){
        if($getguest[$i]['payment_mode']!=""){
            $mode = $getguest[$i]['payment_mode'];
            if($getguest[$i]['isPaid']=="1"){ $paystatus="<span class='text-success'>(Paid)</span>"; }
            else{ $paystatus="<span class='text-danger'>(Pending)</span>"; }
        } else{
            $mode="<span class='text-danger'>Not Processed</span>";
            $paystatus="";
        }
        if($getguest[$i]['govt_token_no']!=""){ $token = $getguest[$i]['govt_token_no']; }
        else{ $token="[Not Defined]"; }
        $client = selectQuery(WEB_USER,"u_fname,u_lname","u_id=".$getguest[$i]['agree_by']);
        $cname = $client[0]['u_fname']." ".$client[0]['u_lname'];
        $delfunc = "del('del_agreement','".$getguest[$i]['agreement_no']."')";
        $action = '<button type="button" class="btn btn-danger btn-sm" onclick="'.$delfunc.'"><i class="fa fa-trash " ></i></button>';
        $nestedData = array(); $nestedData[] = $requestData['start']+$i+1; $nestedData[] = "<a href='agreementdetails.php?agr=".base64_encode($getguest[$i]['agreement_no'])."'>".$getguest[$i]['agreement_no']."</a>";
        $nestedData[] = $token; $nestedData[] = $cname;
        $nestedData[] = date("d M Y",strtotime($getguest[$i]['entry_on']))."<br>".date("h:i a",strtotime($getguest[$i]['entry_on']));
        $nestedData[] = $mode." ".$paystatus;
        $nestedData[] = $getguest[$i]['agreement_status'];
        $nestedData[] = $action;
        $data[] = $nestedData;
    }
}
$json_data = array(
"draw" => intval( $requestData['draw'] ), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
"recordsTotal" => intval( $totalData ), // total number of records
"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
"data" => $data // total data array
);
echo json_encode($json_data); ?>