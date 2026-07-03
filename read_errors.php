<?php
 include("includes/configuration.php");
 $myfile = fopen("errorlog/error.log", "r") or die("Unable to open file!");
 $ertype=$_REQUEST['type'];

 $data=array();
 $data['errors']=array();
// Output one line until end-of-file
while(!feof($myfile)) {
    $str=fgets($myfile);
   if(strpos($str,$ertype) !== false)
   {
     $flag=0;
      $newdata=array();
      $removedate=explode("]",$str);
      $date=$removedate[0];  //error date
      $otherpart=$removedate[1] ;
      $gettype=explode(":",$otherpart);
      $type=$gettype[0];     //error type
      $deatapart="";
      if(sizeof($gettype)>1)
      {
          for($i=1;$i<count($gettype);$i++)
          {
            $deatapart=$deatapart." ".$gettype[$i];
          }
      }
    /*  echo $gettype[1]."<br>";    */
      $geterrordata=explode(" in ",$deatapart);
      $errror=$geterrordata[0];  //error details
     $getfile=explode("domains/",$geterrordata[1]);
     $getremaining=explode(" ",$getfile[1]);
     $file=$getremaining[0]; //file name
     $line=$getremaining[3]; //line no

     $newdata['type']=$type;
     $newdata['details']=$errror;
     $newdata['filename']=$file;
     $newdata['lineno']=$line;
    for($i=0;$i<count($data['errors']);$i++)
    {
       if($data['errors'][$i]['type']==$type&&$data['errors'][$i]['details']==$errror&&$data['errors'][$i]['filename']==$file&&$data['errors'][$i]['lineno']==$line)
       {
           $flag=1;
       }
    }
    if($flag==0)
    {
        array_push($data['errors'],$newdata);
    }

   }

}
fclose($myfile);
echo json_encode($data);
?>