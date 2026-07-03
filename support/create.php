<?php include("../includes/configuration.php"); ?>
<!doctype html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo SITENAME; ?> Support</title>
<?php include 'commoncss.php';?>
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css"/>
<style>
.documentthumb{
    width: 120px;
    height: 120px;
    background: #ececec;
    overflow: hidden;
    margin-bottom: 15px;
}
.browsFile{
    margin-left: 0px;
    padding: 7px 7px;
    border-radius: 5px;
    width: 133px;
}
.splitter{
    background-color:#FFFF42;

}

</style>
</head>
<?php include('menu.php');

 $leadno=selectQuery(CONTACT,"contact_request_id","contact_request_id<>'' order by req_id DESC LIMIT 1");
 /*$leadno=selectQuery(NEWCASE,"case_id","case_id<>'' order by id DESC LIMIT 1");*/
$emp_id = $_SESSION['staff'];
$getadmin = selectQuery(SUPPORTSTAFF,"*","emp_id='".$emp_id."' ");

$getstaff = selectQuery(SUPPORTSTAFF,"*","acc_type='Staff' order by emp_name ASC");
 if($getadmin[0]['acc_type']=='Client')
 {
    $getproject = selectQuery(SUPPORTSTAFF,"*","emp_id='".$emp_id."'  and isDel='0' order by emp_name ASC");
 }
 else
 {
    $getproject = selectQuery(SUPPORTSTAFF,"*","acc_type='Client' and isDel='0' order by emp_name ASC ");
 }
// Allowed Image or Application Type
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


?>


<div class="content">
<div class="container">
    <div class="row">
    <div class="col-md-12">
    <h4 class="margin0 pull-left">Create New Ticket</h4>
    <div class="pull-right rightBtn">
     <span><b>Case ID</b> - </span> <span id="caseid" class="text-info"><?php echo getleadno($leadno[0]['contact_request_id']); ?></span>
      <span>&nbsp; <b>Date</b> - <?php echo date("d-m-Y [ H:i ]"); ?></span>
    </div>
    </div>
    </div>
    <div class="row"><div class="col-md-12"><hr></div></div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="form tktform">
                <div class="card"  style="padding-bottom: 10px;">
                    <div class="panel-heading"><div class="panel-title">Case</div></div>
                    <div class="panel-body">
                    <?php
                        if($getadmin[0]['acc_type']!='Client')
                        {
                        ?>
                        <div class="row">
                         <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                               <!-- <input type="checkbox" name="onbehalfclient" id="onbehalfclient" value="onbehalfclient" /> <label>Create Ticket on Behalf of Client</label>-->
                                <input type="checkbox" name="onbehalfclient" id="onbehalfclient" value="onbehalfclient" checked value="1"/> <label>Create Internal Ticket</label>
                            </div>
                            </div>
                        </div>
                    <?php }?>

                            <div class="form-group">
                                <label for="assign">Ticket Source<span class="text-danger">*</span></label>
                                <select class="form-control" id="tktSource">
                                     <option value="Call">Call</option>
                                     <option value="Personal Meeting">Personal Meeting</option>
                                     <option value="SMS">SMS</option>
                                     <option value="Social Media">Social Media</option>
                                     <option value="Website">Website</option>
                                     <option value="Website">Whatsapp</option> 



                                </select>
                            </div>

                       <div class="form-group">
                                 <div class="input-group">
                                    <span  class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i><span class="text-danger">*</span></span>
                                     <input type="text" maxlength="50" minlength="3" onblur="firstcapital('name1')" onkyeup="namechk1('name1')" class="form-control newattr" name="name" placeholder="Enter Name" id="name1"/>
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="input-group">
                              <span  class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i><span class="text-danger">*</span></span>
                               <input  type="text" class="form-control" maxlength="70" minlength="7" name="email"  placeholder="Enter Email Address." id="cemail" onblur="mailchk('cemail')" />
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="input-group">
                                <span  class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i><span class="text-danger">*</span></span>
                                <input type="text"  class="form-control" name="tele" id="tele"  onkeyup="mobnumbercheck('tele')" placeholder="Enter Mobile Number" maxlength="10" />
                            </div>
                            </div>
                            <div class="form-group marginbot15">
                            <div class="input-group">
                               <span  class="input-group-addon"><i class="fa fa-comment" aria-hidden="true"></i><span class="text-danger">*</span></span>
                                <textarea name="cmnt" placeholder="Enter Comment" class="form-control" id="textareas" cols="5" rows="4"></textarea>
                            </div>
                            </div>
                    <?php
                        if($getadmin[0]['acc_type']=='Admin' || $getadmin[0]['acc_type']=='Staff')
                        {
                    ?>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="assign">Assign To<span class="text-danger">*</span></label>
                                <select class="form-control" id="assign">
                                    <option value="">Select</option>
                                    <?php
                                    for($i=0;$i<count($getstaff);$i++)
                                    {
                                    ?>
                                        <option value="<?php echo $getstaff[$i]['emp_id']; ?>"><?php echo $getstaff[$i]['emp_name']; ?></option>
                                    <?
                                    }
                                    ?>
                                </select>
                            </div>
                            </div>
                        </div>
                    <?}?>


                        <div class="form-group"style="margin-top: 10px;">
                            <button type="button" class="btn btn-success" onclick="saveentry();" id="createticket">Create Ticket</button>
                            <button type="button" class="btn btn-danger" onclick="goBack()">Cancel</button>
                        </div>
                           <div class="msgs" ></div>
                    </div>

                </div>
            </form>
        </div>
    </div>
  </div>
 </div>
<?php include('footer.php'); ?>  

<script>


function mobnumbercheck(id)
{
    var inp=$("#"+id).val();
    var last=inp.charAt(0);
    if(isNaN(inp))
    {
       var newstr = inp.slice(0, -1);
       $("#"+id).val(newstr);
    }
    if(last!=7&&last!=8&&last!=9)
    {
        $("#"+id).val("");
    }
}
function numbercheck(id)
{
    var inp=$("#"+id).val();
    if(isNaN(inp))
    {
        var newstr = inp.slice(0, -1);
        $("#"+id).val(newstr);
    }
    else
    {
    }
}
function namechk(id)
{
    var name =  $('#'+id).val();
    var alphanumers = /^[a-zA-Z]+$/;
    if(!alphanumers.test(name))
    {
        var newstr = name.slice(0, -1);
        $("#"+id).val(newstr);
    }
}
function namechk1(id)
{
    var name =  $('#'+id).val();
    var alphanumers = /^[a-zA-Z ]+$/;
    if(!alphanumers.test(name))
    {
        var newstr = name.slice(0, -1);
        $("#"+id).val(newstr);
    }
}
function mailchk(id)
{
    var email = $("#"+id).val();
    var patt = new RegExp(/^[a-zA-Z0-9.\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/);
    var res = patt.test(email);
    if(res)
    {
    }
    else
    {
        $("#"+id).val("");
        $("#"+id).focus();
    }
}


function saveentry()
{
   var name = $("#name1").val();
    var email = $("#cemail").val();
    var tele =  $("#tele").val();
    var cmnt =  $("#textareas").val();
    var caseid =$("#caseid").html();
    var assign =$("#assign option:selected").val();
    var tktSource =$("#tktSource option:selected").val();
    var onbehalfclient=$("#onbehalfclient checked").val();

     if ( (name == "") || (email == "") || (tele == "") || (cmnt == "") ) {
            $('.msgs').fadeIn();
            $('.msgs').addClass("alert alert-danger");
            $(".msgs").html("Please fill all details correclty")
            $('.msgs').delay(3000).fadeOut();
            return false;
        }
    else
    {
         var load= '<?php echo LOADER; ?>';
        var loader=' <img src="'+load+'" alt="" style="width:15%"/>  ';

        $("#createticket").attr('disabled',true).append(" "+loader);
        var form_data = new FormData();

        form_data.append('onbehalfclient', onbehalfclient);
        form_data.append('caseid', caseid);
         form_data.append('name', name);
         form_data.append('email', email);
         form_data.append('tele', tele);
         form_data.append('cmnt', cmnt);
        form_data.append('assign', assign);
         form_data.append('tktSource', tktSource);
        form_data.append('action',"newcase");

        $.ajax({
                type:"POST",
                url:"ajax/createticket.php",
                data:form_data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(response){
                    $("#createticket").attr('disabled',false)
                    $("#createticket img").remove();

                       if(response==1)
                       {
                            $(".msg").fadeIn().html("Ticket Created Successfully").addClass("alert alert-success").delay(5000).fadeOut()
                            setTimeout(function(){ window.location="home.php" }, 3000);
                        }
                        else
                        {
                            $(".msg").fadeIn().html("Error While Ticket Creation").addClass("alert alert-danger").delay(5000).fadeOut()
                        }
                    }

            });
    }
}

 </script>
</body>
</html>


