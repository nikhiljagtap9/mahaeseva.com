<?php
  include('../includes/configuration.php');

  $supportmail=selectQuery(SUPPORTEMAIL,"*");
    $allowedimgtypes=$supportmail[0]['img_types'];
   $allowedapptypes=$supportmail[0]['application_types'];


    if($allowedimgtypes!=""&&$allowedapptypes!="")
       {
           $allowed= $allowedimgtypes.",".$allowedapptypes;
       }
       else if($allowedimgtypes!=""&&$allowedapptypes=="")
       {
           $allowed= $allowedimgtypes;
       }
       else if($allowedimgtypes==""&&$allowedapptypes!="")
       {
           $allowed= $allowedapptypes;
       }
        else if($allowedimgtypes==""&&$allowedapptypes=="")
       {
           $allowed= "";
       }
        $target="../img/support_tkt_comments/";
    $filename1="";$filename2=""; $filename3="";$filename4="";$filename5="";$filename6="";

      $allowedExts = explode(",",$allowed);

  $getdetails=selectQuery(CONTACT,"*","contact_request_id=".$requestid);
  $supportmail=selectQuery(SUPPORTEMAIL,"*");
  $getdeptmgr=selectQuery(SUPPORTSTAFF,"*","department=".$getdetails[0]['dept']." and isActive='1' and post='Manager'");
  $getdeptallstaff=selectQuery(SUPPORTSTAFF,"*","department=".$getdetails[0]['dept']." and isActive='1' and post='Staff'");
  $assignedstaff=selectQuery(SUPPORTSTAFF,"*","emp_id=".$getdetails[0]['assigned_staff']);

  $staff= $_REQUEST['staff'];
  $requestid= $_REQUEST['requestid'];
  $comment= $_REQUEST['comment'];
    $attachment= $_FILES["attachment"]["name"];

  $posttype=$_REQUEST['posttype'];    /* post/transfer/assign */


  $data=array(
    "ticket_id"=>$requestid,
    "comment_by"=>$staff,
    "comment"=>$comment,
    "comment_date"=>date("d/m/Y H:i:s")
  );

  $addresponse=insertQuery(SUPPORTCOMMENT,$data);
  if($addresponse)
  {
       $getresponse=selectQuery(SUPPORTCOMMENT,"*","ticket_id<>'' order by comment_id desc LIMIT 1");
         if($_FILES['attachment']['tmp_name']!="")
       {
             $allowedimgformat=$allowedimgtypes;
            $allowedappformat=$allowedapptypes;

                $imgarr1 =explode(",",$allowedimgformat);
                $allarr=array();
                for($i = 0; $i < sizeOf($imgarr1); $i++) {
                     if($imgarr1[$i]!="")
                    {
                      $imgstr="image/".$imgarr1[$i];
                      array_push($allarr,$imgstr);

                    }
                }

                $apparr1 = explode(",",$allowedappformat);
                 for($i = 0; $i < sizeOf($apparr1); $i++) {
                    if($apparr1[$i]!="")
                    {
                       $appstr="application/".$apparr1[$i];
                      array_push($allarr,$appstr);
                    }
                }
            $extension = end(explode(".", $_FILES["attachment"]["name"]));
            if ((($_FILES["attachment"]["type"] == "image/jpeg")
                || ($_FILES["attachment"]["type"] == "image/png")
                || ($_FILES["attachment"]["type"] == "image/jpg")
                || ($_FILES["attachment"]["type"] == "image/JPG")
                 || ($_FILES["attachment"]["type"] == "application/pdf")
               )

                && in_array($extension, $allowedExts))
              {

                   $photo=$getresponse[0]['comment_id'] ."_attach.".$extension;

                    if ($_FILES["attachment"]["error"] > 0)
                    {

                    }
                  else
                    {
                      move_uploaded_file($_FILES["attachment"]["tmp_name"],$target."/".$photo);

                       $imgdata=array(
                       'img_name'=>$photo,
                        'response_id'=>$getresponse[0]['comment_id']
                       );
                       $addimg=insertQuery(SUPPORTIMG,$imgdata);
                       $filename1=$target."/".$photo;
                    }

              }
       }


     if($supportmail[0]['new_msg_alert']==1)
     {
         if($supportmail[0]['new_msg_alert_client']==1)
        {
            $emailsub =$getdetails[0]['Email'];

            $subject="Response On - ".$requestid;

            $body='<div style="font-family:calibri; background-color:#fff;;border:1px solid #e6e6e6;margin-bottom:20px;font-size: 15px;">
                    <div style="text-transform:uppercase;margin-top:0;color:#d26e03;padding:20px;line-height: 27px;border-bottom:1px solid #e6e6e6;background-color:#f2f2f2;">
                    <img src="'.SITEURL.'/img/projectimage/logo.png" alt="" />
                    </div>
                  <div style="padding:0 20px 20px 20px">
                        <p><b>Dear '.$getdetails[0]['Name'].',</b></p>
                        <p style="color:grey;">Your response as below – <br>
                          <hr style="display: block;height: 1px;border: 0;border-top: 1px solid #ccc;margin: 1em 0;padding: 0; ">
                        <div style="color:grey;">'.$comment.'</div>
                          <hr style="display: block;height: 1px;border: 0;border-top: 1px solid #ccc;margin: 1em 0;padding: 0; "><br>
                          <div><b>Thanking  You.</b></div>
                          <div style="color:grey;">With Regards,
                          Team '.SITENAME.'</div>

                       </p>
                </div>
                </div>';

             $sentmail =   mail_multiattachment($filename1,$filename2, $filename3,$filename4,$filename5,$filename6, $emailsub, EMAIL_SENDER, SITENAME, EMAIL_SENDER, $subject, $body);
         }

        if($supportmail[0]['new_msg_alert_admin']==1)
        {
             $emailadmin =EMAIL_SENDER;

            $subjectadmin="Response On - ".$requestid;

            $bodyadmin='<div style="font-family:calibri; background-color:#fff;border:1px solid #e6e6e6;margin-bottom:20px;font-size: 15px;">
                        <div style="text-transform:uppercase;margin-top:0;color:#d26e03;padding:20px;line-height: 27px;border-bottom:1px solid #e6e6e6;background-color:#f2f2f2;">
                            <img src="'.SITEURL.'/img/projectimage/logo.png" alt="" />
                        </div>
                    <div style="padding:0 20px 20px 20px">
                        <p><b>Dear Admin,</b></p>
                        <p style="color:grey;">'.$staff.' responded as below</p>
                        <hr style="display: block;height: 1px;border: 0;border-top: 1px solid #ccc;margin: 1em 0;padding: 0; ">
                        <div style="color:grey;">'.$comment.'</div>
                        <hr style="display: block;height: 1px;border: 0;border-top: 1px solid #ccc;margin: 1em 0;padding: 0; ">
                        <div><b>Thanking  You.</b></div>
                        <div style="color:grey;">With Regards,
                          Team '.SITENAME.'</div>
                    </div>
                    </div>';
               $sentmailadmin= mail_multiattachment($filename1,$filename2, $filename3,$filename4,$filename5,$filename6, $emailadmin, EMAIL_SENDER, SITENAME, EMAIL_SENDER, $subjectadmin, $bodyadmin);
            /* $sentmailadmin = mail($emailadmin, $subjectadmin, $bodyadmin, $headersadmin);    */
        }

         if($supportmail[0]['new_msg_alert_mgr']==1)
        {
                  $emailmgr =$getdeptmgr[0]['emp_email'];
                   /* $headersmgr  = 'MIME-Version: 1.0' . "\r\n";
                    $headersmgr .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headersmgr .= "From:".SITENAME."<".EMAIL_SENDER.">";*/
                    $subjectmgr="Response On - ".$requestid;

                    $bodymgr='<div style="font-family:calibri; background-color:#fff;border:1px solid #e6e6e6;margin-bottom:20px;font-size: 15px;">
                               <div style="text-transform:uppercase;margin-top:0;color:#d26e03;padding:20px;line-height: 27px;border-bottom:1px solid #e6e6e6;background-color:#f2f2f2;">
                                <img src="'.SITEURL.'/img/projectimage/logo.png" alt="" />
                               </div>
                              <div style="padding:0 20px 20px 20px">
                                <p><b>Dear '.$getdeptmgr[0]['emp_name'].',</b></p>
                                <p style="color:grey;">'.$staff.'  responded as below – </p>
                                <hr style="display: block;height: 1px;border: 0;border-top: 1px solid #ccc;margin: 1em 0;padding: 0; ">
                                <div style="color:grey;">'.$comment.'</div>
                                <hr style="display: block;height: 1px;border: 0;border-top: 1px solid #ccc;margin: 1em 0;padding: 0; ">
                                <div><b>Thanking  You.</b></div>
                                <div style="color:grey;">With Regards,
                                  Team '.SITENAME.' </div>
                            </div>
                            </div>';
                     $sentmailmgr= mail_multiattachment($filename1,$filename2, $filename3,$filename4,$filename5,$filename6, $emailmgr, EMAIL_SENDER, SITENAME, EMAIL_SENDER, $subjectmgr, $bodymgr);
                     /*$sentmailmgr = mail($emailmgr, $subjectmgr, $bodymgr, $headersmgr);     */
        }

         if($supportmail[0]['new_msg_alert_respondent']==1)
        {
                $emailresp =$assignedstaff[0]['emp_email'];
                    $headersresp  = 'MIME-Version: 1.0' . "\r\n";
                    $headersresp .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headersresp .= "From:".SITENAME."<".EMAIL_SENDER.">";
                    $subjectresp="Response On - ".$requestid;

                    $bodyresp='<div style="font-family:calibri; background-color:#fff;border:1px solid #e6e6e6;margin-bottom:20px;font-size: 15px;">
                                <div style="text-transform:uppercase;margin-top:0;color:#d26e03;padding:20px;line-height: 27px;border-bottom:1px solid #e6e6e6;background-color:#f2f2f2;">
                                    <img src="'.SITEURL.'/img/projectimage/logo.png" alt="" />
                                </div>
                                <div style="padding:0 20px 20px 20px">
                                <p><b>Dear '.$assignedstaff[0]['emp_name'].',</b></p>
                                <p>'.$staff.' responded as below - </p>
                                <hr style="display: block;height: 1px;border: 0;border-top: 1px solid #ccc;margin: 1em 0;padding: 0; ">
                                   <div style="color:grey;">'.$comment.'</div>
                                <hr style="display: block;height: 1px;border: 0;border-top: 1px solid #ccc;margin: 1em 0;padding: 0; ">
                                <div><b>Thanking  You.</b></div>
                                <div style="color:grey;">With Regards,
                                  Team '.SITENAME.'</div>
                            </div>
                            </div>';
                      $sentmailresp= mail_multiattachment($filename1,$filename2, $filename3,$filename4,$filename5,$filename6, $emailresp, EMAIL_SENDER, SITENAME, EMAIL_SENDER, $subjectresp, $bodyresp);
                  /*   $sentmailresp = mail($emailresp, $subjectresp, $bodyresp, $headersresp);      */
        }
      }
      echo 1;
  }
  else
  {
      echo 0;
  }
?>