<?php
    include("../includes/configuration.php");

    $action=$_REQUEST['action'];
        $target="../img/guest_doc/";
        $allowedExts = array("jpg", "jpeg", "png","JPG");
        $data_date1 =date("ymdhis");
    if($action=="add_guest")
    {
        $lead = $_REQUEST['lead'];
        $title=$_REQUEST['nametitle'];
        $fname = $_REQUEST['firstame'];
        $f3 = strtoupper(substr($fname, 0, 3));
        $mname = $_REQUEST['middleame'];
        $lname = $_REQUEST['lastame'];
        $l3 = strtoupper(substr($lname, 0, 3));
        $company=$_REQUEST['company'];
        $tele = $_REQUEST['mobile'];
        $email = $_REQUEST['email'];
        $nationality = $_REQUEST['nationality'];

        $dobex = $_REQUEST['dob'];
        if($dobex!="")
        {
          $dob= date('Y-m-d', strtotime($dobex));
        }
        else
        {
          $dob="";
        }


        $marriatal = $_REQUEST['marriatal'];
        $marriageex = $_REQUEST['marriage'];
        if($marriageex!="")
        {
          $marriage= date('Y-m-d', strtotime($marriageex));
        }
        else
        {
          $marriage="";
        }


        $passportno = $_REQUEST['passportno'];
        $issueex = $_REQUEST['issue'];
        if($issueex!="")
        {
             $issue= date('Y-m-d', strtotime($issueex));
        }
        else
        {
           $issue="";
        }


        $expiryex = $_REQUEST['expiry'];

         if($expiryex!="")
        {
             $expiry= date('Y-m-d', strtotime($expiryex));
        }
        else
        {
             $expiry="";
        }
        $passport_palce = $_REQUEST['passport_palce'];
        $passport_pages = $_REQUEST['passport_pages'];
        $validvisa1= $_REQUEST['validvisa1'];
        $validvisa2 = $_REQUEST['validvisa2'];
        $ffn=$_REQUEST['ffn'];
        $meal = $_REQUEST['meal'];
        $insurance = $_REQUEST['insurance'];
        $doclist= $_REQUEST['doclist'];

        $uniqueuser=$f3."".$l3.date("dmHi");

        if(strlen($fname)!=0&&strlen($lname)!=0&&strlen($tele)!=0)
        {
            $chkguest=selectQuery(GUEST,"guest_id","fname='".$fname."' and lname='".$lname."' and mobile='".$tele."'");
            if(count($chkguest)!=0)
            {
                echo 1; // guest already available
            }
            else
            {
                 $data=array(
                  "system_guest_id"=>$uniqueuser,
                  "title"=>ucfirst($title),
                  "fname"=>ucfirst($fname),
                  "mname"=>ucfirst($mname),
                  "lname"=>ucfirst($lname),
                  "company_or_group_name"=>ucfirst($company),
                  "mobile"=>$tele,
                  "email"=>$email,
                  "nationality"=>ucfirst($nationality),
                  "date_of_birth"=>$dob,
                  "marrital_status"=>ucfirst($marriatal),
                  "marriage_date"=>$marriage,
                  "passport_no"=>$passportno,
                  "passport_issue_date"=>$issue,
                  "passport_expiry_date"=>$expiry,
                  "passport_issue_place"=>$passport_palce,
                  "passport_empty_pages"=>$passport_pages,
                  "ffn"=>$ffn,
                  "meal_preference"=>ucfirst($meal),
                  "insurance_nominee"=>$insurance,
                  "valid_visa1"=>$validvisa1,
                  "valid_visa2"=>$validvisa2,
                  "insert_date"=>date("Y-m-d H:i:s"),
                  "insert_by"=>$_SESSION['staff'],
                  "leads"=>$lead
                 );



                 $insert=insertQuery(GUEST,$data);
                  if($insert)
                  {
                     if($doclist!="")
                     {
                         $exdoc=explode(",",$doclist);
                         for($i=0;$i<count($exdoc);$i++)
                         {
                             if($exdoc[$i]!="")
                             {
                                  $string = preg_replace('/\s+/', '', $exdoc[$i]);
                                  /*$docid=$_REQUEST[$string]; */

                                  $docname=$string."doc";

                                 if($_FILES[$docname]['tmp_name']!="")
                                  {
                                   $extension = end(explode(".", $_FILES[$docname]["name"]));

                                   if ((($_FILES[$docname]["type"] == "image/jpeg")
                                        || ($_FILES[$docname]["type"] == "image/png")
                                        || ($_FILES[$docname]["type"] == "image/jpg")
                                        || ($_FILES[$docname]["type"] == "image/JPG")
                                       )
                                        && in_array($extension, $allowedExts))
                                      {
                                           $photo2=$uniqueuser."_".$string."".$data_date1.".png";
                                            if ($_FILES[$docname]["error"] > 0)
                                            {
                                            }
                                          else
                                            {
                                              move_uploaded_file($_FILES[$docname]["tmp_name"],$target."/".$photo2);
                                            }
                                       }
                                 }
                                 else
                                 {
                                   $photo2="";
                                 }

                                  $data1=array(
                                    "guest_id"=>$uniqueuser,
                                    "document_name"=>$exdoc[$i],
                                  /*  "document_id"=>$docid,   */
                                    "docimg" => $photo2
                                  );
                                  $insertdoc=insertQuery(GUESTDOC,$data1);
                             }
                         }
                     }
                     echo 3; //success
                 }
                  else
                  {
                        echo 0; // error in insert
                  }
            }
        }
        else
        {
           echo 2; // all fields not filled
        }
    }

    if($action=="showsearchhint")
    {
        $srstr=trim($_REQUEST['searchstr']);
        $strarr=explode(" ",$srstr);
      
        if(sizeof($strarr)>1)
        {
            $where="isDel=='0' and (fname like '".$strarr[0]."%'||lname like '".$strarr[1]."%')";
        }
        else
        {
             $where= "isDel=='0' and (fname like '".$srstr."%'||lname like '".$srstr."%'||mobile = '".$srstr."')";
        }
         $srlead=$_REQUEST['lead'];
       $searchentry=selectQuery(GUEST,"*",$where);
        if(count($searchentry))
        {
            ?>
              <div class="form-group"> Searching Results For <b>'<?php echo $srstr; ?>'</b></div>
              <div class="table-responsive">
              <table class="table table-striped">
               <thead>
                <th>#</th>
                <th>Guest No</th>
                <th>Guest Name</th>
                <th>Mobile Number</th>
                <th>Add To Lead</th>
               </thead>
               <tbody>
                   <?php
                    for($i=0;$i<count($searchentry);$i++)
                    {
                        $found=0;
                        $lead=$searchentry[$i]['leads'];
                        if($lead!="")
                        {
                           $leadarr=explode(",",$lead);
                           for($m=0;$m<sizeof($leadarr);$m++)
                           {
                                if($srlead==$leadarr[$m])
                                {
                                    $found=1;
                                }
                           }
                        }

                       ?>
                         <tr>
                           <td><?php echo $i+1; ?></td>
                           <td><a href="guestdetails.php?guest=<?php echo base64_encode($searchentry[$i]['system_guest_id']) ?>" target="_blank"><?php echo $searchentry[$i]['system_guest_id']; ?></a></td>
                           <td><?php echo $searchentry[$i]['fname']." ".$searchentry[$i]['lname']; ?></td>
                            <td><?php echo $searchentry[$i]['mobile']; ?></td>
                           <td class="<?php echo $searchentry[$i]['system_guest_id']; ?>">
                             <?php
                              if($found==1)
                              {
                                  echo "Added";
                              }
                              else
                              {
                                  ?>
                                   <input type="checkbox" onclick="addleadtouser('<?php echo $srlead; ?>','<?php echo $searchentry[$i]['system_guest_id']; ?>')">
                                  <?
                              }
                             ?>
                            </td>
                         </tr>
                       <?
                    }

                   ?>
               </tbody>
              </table>
              </div>
            <?

        }
         else
            {
               ?>
                 <div class="col-md-12">No Searching Results Found For <b>'<?php echo $srstr; ?>'</b></div>
               <?
            }
    }

    if($action=="addtolead")
    {
        $addlead=$_REQUEST['lead'];
        $guestid=$_REQUEST['guestid'];
         $adlead=selectQuery(GUEST,"*","system_guest_id='".$guestid."'");
          $leaduser=$adlead[0]['leads'];
           if($leaduser!="")
        {
           $leadarr=explode(",",$leaduser);
        }
        else
        {
            $leadarr=array();
        }
          array_push($leadarr,$addlead);
        $newlead=implode(",",$leadarr);
        $leaddata=array(
         "leads"=>$newlead
        );
        $updateleads=updateQuery(GUEST,$leaddata,"system_guest_id='".$guestid."'");
        if($updateleads)
        {echo 1;
        }
        else
        {
            echo 0;
        }
    }

    if($action=="removefromlead")
    {
        $removelead=$_REQUEST['lead'];
        $guestid=$_REQUEST['guestid'];
         $adlead=selectQuery(GUEST,"*","system_guest_id='".$guestid."'");
          $leaduser=$adlead[0]['leads'];

           $leadarr=explode(",",$leaduser);
           $newleadarr=array();
          for($i=0;$i<sizeof($leadarr);$i++)
          {
              if($leadarr[$i]==$removelead)
              {

              }
              else
              {
                   array_push($newleadarr,$leadarr[$i]);
              }
          }

        $newlead=implode(",",$newleadarr);
        $leaddata=array(
         "leads"=>$newlead
        );
        $updateleads=updateQuery(GUEST,$leaddata,"system_guest_id='".$guestid."'");
        if($updateleads)
        {echo 1;
        }
        else
        {
            echo 0;
        }
    }


    if($action=="update_guest")
    {
         $guest=$_REQUEST['guest'];
        $title=$_REQUEST['nametitle'];
        $fname = $_REQUEST['firstame'];
        $f3 = strtoupper(substr($fname, 0, 3));
        $mname = $_REQUEST['middleame'];
        $lname = $_REQUEST['lastame'];
        $l3 = strtoupper(substr($lname, 0, 3));
        $company=$_REQUEST['company'];
        $tele = $_REQUEST['mobile'];
        $email = $_REQUEST['email'];
        $nationality = $_REQUEST['nationality'];

        $dobex = $_REQUEST['dob'];
        if($dobex!="")
        {
          $dob= date('Y-m-d', strtotime($dobex));
        }
        else
        {
          $dob="";
        }


        $marriatal = $_REQUEST['marriatal'];
        $marriageex = $_REQUEST['marriage'];
        if($marriageex!=""&&$marriatal=="Married")
        {
          $marriage= date('Y-m-d', strtotime($marriageex));
        }
        else
        {
          $marriage="";
        }


        $passportno = $_REQUEST['passportno'];
        $issueex = $_REQUEST['issue'];
        if($issueex!="")
        {
             $issue= date('Y-m-d', strtotime($issueex));
        }
        else
        {
           $issue="";
        }


        $expiryex = $_REQUEST['expiry'];

         if($expiryex!="")
        {
             $expiry= date('Y-m-d', strtotime($expiryex));
        }
        else
        {
             $expiry="";
        }
        $passport_palce = $_REQUEST['passport_palce'];
        $passport_pages = $_REQUEST['passport_pages'];
        $validvisa1= $_REQUEST['validvisa1'];
        $validvisa2 = $_REQUEST['validvisa2'];
        $ffn=$_REQUEST['ffn'];
        $meal = $_REQUEST['meal'];
        $insurance = $_REQUEST['insurance'];
        $doclist= $_REQUEST['doclist'];
        $Reason = $_REQUEST['Reason'];

        $uniqueuser=$f3."".$l3.date("dmHi");

        if(strlen($fname)!=0&&strlen($lname)!=0&&strlen($tele)!=0)
        {

                 $data=array(

                  "title"=>ucfirst($title),
                  "fname"=>ucfirst($fname),
                  "mname"=>ucfirst($mname),
                  "lname"=>ucfirst($lname),
                  "company_or_group_name"=>ucfirst($company),
                  "mobile"=>$tele,
                  "email"=>$email,
                  "nationality"=>ucfirst($nationality),
                  "date_of_birth"=>$dob,
                  "marrital_status"=>ucfirst($marriatal),
                  "marriage_date"=>$marriage,
                  "passport_no"=>$passportno,
                  "passport_issue_date"=>$issue,
                  "passport_expiry_date"=>$expiry,
                  "passport_issue_place"=>$passport_palce,
                  "passport_empty_pages"=>$passport_pages,
                  "ffn"=>$ffn,
                  "meal_preference"=>ucfirst($meal),
                  "insurance_nominee"=>$insurance,
                  "valid_visa1"=>$validvisa1,
                  "valid_visa2"=>$validvisa2,
                  "insert_date"=>date("Y-m-d H:i:s"),
                  "last_updated"=>$_SESSION['staff'],
                  "reason_to_update" => $Reason,

                 );

                  $insert=updateQuery(GUEST,$data,"system_guest_id='" . $guest."'");
                  if($insert)
                  {

                     if($doclist!="")
                     {
                         $exdoc=explode(",",$doclist);
                         for($i=0;$i<count($exdoc);$i++)
                         {
                             if($exdoc[$i]!="")
                             {
                                  $string = preg_replace('/\s+/', '', $exdoc[$i]);
                                  $gdid=$string."gdid";
                                  $getgdid=$_REQUEST[$gdid];
                                  if($getgdid=="")
                                  {
                                        /* $doc=$_REQUEST[$string];  */
                                        $doc="";
                                          $docname=$string."doc";

                                             if($_FILES[$docname]['tmp_name']!="")
                                              {
                                               $extension = end(explode(".", $_FILES[$docname]["name"]));

                                               if ((($_FILES[$docname]["type"] == "image/jpeg")
                                                    || ($_FILES[$docname]["type"] == "image/png")
                                                    || ($_FILES[$docname]["type"] == "image/jpg")
                                                    || ($_FILES[$docname]["type"] == "image/JPG")
                                                   )
                                                    && in_array($extension, $allowedExts))
                                                  {
                                                       $photo2=$uniqueuser."_".$string."".$data_date1.".png";
                                                        if ($_FILES[$docname]["error"] > 0)
                                                        {
                                                        }
                                                      else
                                                        {
                                                          move_uploaded_file($_FILES[$docname]["tmp_name"],$target."/".$photo2);
                                                        }
                                                   }
                                             }
                                             else
                                             {
                                               $photo2="";
                                             }

                                          $data1=array(
                                            "guest_id"=>$guest,
                                            "document_name"=>$exdoc[$i],
                                          /*  "document_id"=>$doc,       */
                                             "docimg" => $photo2
                                          );
                                          $insertdoc=insertQuery(GUESTDOC,$data1);
                                  }

                             }
                         }
                     }
                     echo 3; //success          
                  }
                  else
                  {
                        echo 0; // error in insert
                  }

        }
        else
        {
           echo 2; // all fields not filled
        }
    }

    if($action=="del_doc")
    {
          $data3 =array(
            "del" => "1"
          );
          $update=updateQuery(GUESTDOC,$data3,"gd_id=".$_REQUEST['dbid']);
         /* if($update){  */
              echo 4;
        /*  }  */
    }


if($action=="del_guest")
{
    $guest=$_REQUEST['guestid'];
     $data=array(
         "isDel"=>"1",
         );
         $del=updateQuery(GUEST,$data,"system_guest_id='".$guest."'");

      if($del)
      {
          echo 1;
      }
      else
      {
          echo 0;
      }
}
?>