<?php
include("../includes/configuration.php");   
 if($action == "addnewreason")

 {
       $newreason=trim($_REQUEST['newreason']);
    $check=selectQuery(lost_reason,"*","lost_reason='".$newreason."'");
    if(count($check))
    {
        echo 0;
    }
    else
    {
     $data = array("lost_reason" => ucfirst($newreason),"isActive" =>'1');
    $insert = insertQuery(lost_reason, $data);
       if($insert)
       {  ?>
             <select name="lostreason" id="lostreason" class="form-control" onchange="checkreason()"  >
                                             <option value="">- Select Lost Reason -</option>
                                          <option value="addnewreason">- Add new Reason -</option>
                               <?php
                                $lostreason=selectQuery(lost_reason,"*","isActive = '1' and isDel = '0'");
                                   for($i=0;$i<count($lostreason);$i++)
                                {
                                   ?>
                                        <option value="<?php echo $lostreason[$i]['id']; ?>"><?php echo $lostreason[$i]['lost_reason']; ?> </option>
                                   <?
                                }
                               ?>
                              </select>
     <?php  }
       else
       {
         echo 2;
       }
    }

 } ?>