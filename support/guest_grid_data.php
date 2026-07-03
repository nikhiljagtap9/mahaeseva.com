<?php
 include("../includes/configuration.php");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(

  	0 =>'#',
	1 => 'Guest No',
	2=> 'Guest Name',
    3=> 'Mobile Number',
    4=> 'Passport No',
    5=> 'Is Passport Valid',
    6=> 'Entry Date'
);


if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter

 $searchguest1=selectQuery(GUEST,"*","isDel='0' and (system_guest_id like '%".$requestData['search']['value']."%' OR fname like '%".$requestData['search']['value']."%' OR lname like '%".$requestData['search']['value']."%' OR mobile like '%".$requestData['search']['value']."%')");
 $totalData = count($searchguest1);
   $totalFiltered=$totalData;
     $searchguest=selectQuery(GUEST,"*","isDel='0' and (system_guest_id like '%".$requestData['search']['value']."%' OR fname like '%".$requestData['search']['value']."%' OR lname like '%".$requestData['search']['value']."%' OR mobile like '%".$requestData['search']['value']."%') order by guest_id DESC LIMIT ".$requestData['start']." ,".$requestData['length']);

      $data = array();
      $fltcnt=0;
     if(count($searchguest))
     {

        for($i=0;$i<count($searchguest);$i++)
        {

                $fltcnt+=1;

                $nestedData=array();
                 if($searchguest[$i]['passport_no']!=""){$pp=$searchguest[$i]['passport_no'];}else{ $pp="[Not Defined]";}
            if($searchguest[$i]['passport_expiry_date']!="")
            {
                $expiry=$searchguest[$i]['passport_expiry_date'];

                if($expiry<date("Y-m-d"))
                {
                   $isvalid="<span style='color:#CC1C2B'><i class='fa fa-times-circle-o'></i> Expired</span>";
                }
                else
                {
                     $date1 =time();
                    $date2 = strtotime($expiry);
                    $difference = $date2 - $date1;

                    $days = floor($difference / (60*60*24) );

                     if($days>180)
                     {
                         $isvalid="<span style='color:#1CCC4E'><i class='fa fa-check-circle-o'></i> Valid</span>";
                     }
                     else
                     {
                         $isvalid="<span style='color:#AC9C0B'><i class='fa fa-exclamation-circle'></i> Expiring Soon</span>";
                     }
                }
            }
            else
            {
                $isvalid="[Not Defined]";
            }


            	$nestedData[] = $requestData['start']+$fltcnt;
                $nestedData[] = "<a href='guestdetails.php?guest=".base64_encode($searchguest[$i]['system_guest_id'])."'>".$searchguest[$i]['system_guest_id']."</a>";
                $nestedData[] = $searchguest[$i]['title']." ".$searchguest[$i]['fname']." ".$searchguest[$i]['lname'];
                $nestedData[] = $searchguest[$i]['mobile'];
                 $nestedData[] = $pp;
                $nestedData[] = $isvalid;
                $nestedData[] = $searchguest[$i]['insert_date'];

            	$data[] = $nestedData;
        }

     }
}
else
{

     $getguest1=selectQuery(GUEST,"*","isDel='0'");
        $totalData = count($getguest1);
        $totalFiltered = $totalData;
    $getguest=selectQuery(GUEST,"*","isDel='0'  order by guest_id DESC LIMIT ".$requestData['start']." ,".$requestData['length']."");

    $data = array();

    for($i=0;$i<count($getguest);$i++)
     {  // preparing an array

        	$nestedData=array();
            if($getguest[$i]['passport_no']!=""){$pp=$getguest[$i]['passport_no'];}else{ $pp="[Not Defined]";}
            if($getguest[$i]['passport_expiry_date']!="")
            {
                $expiry=$getguest[$i]['passport_expiry_date'];

                if($expiry<date("Y-m-d"))
                {
                   $isvalid="<span style='color:#CC1C2B'><i class='fa fa-times-circle-o'></i> Expired</span>";
                }
                else
                {
                     $date1 =time();
                    $date2 = strtotime($expiry);
                    $difference = $date2 - $date1;

                    $days = floor($difference / (60*60*24) );

                     if($days>180)
                     {
                         $isvalid="<span style='color:#1CCC4E'><i class='fa fa-check-circle-o'></i> Valid</span>";
                     }
                     else
                     {
                         $isvalid="<span style='color:#AC9C0B'><i class='fa fa-exclamation-circle'></i> Expiring Soon</span>";
                     }
                }
            }
            else
            {
                $isvalid="[Not Defined]";
            }

        	$nestedData[] = $requestData['start']+$i+1;
           	$nestedData[] = "<a href='guestdetails.php?guest=".base64_encode($getguest[$i]['system_guest_id'])."'>".$getguest[$i]['system_guest_id']."</a>";
            $nestedData[] = $getguest[$i]['title']." ".$getguest[$i]['fname']." ".$getguest[$i]['lname'];
            $nestedData[] = $getguest[$i]['mobile'];
            $nestedData[] = $pp;
            $nestedData[] = $isvalid;
            $nestedData[] = $getguest[$i]['insert_date'];

        	$data[] = $nestedData;
        }
}




$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
