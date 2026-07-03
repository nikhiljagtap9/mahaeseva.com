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
   .tktform .form-group
   {
      margin-bottom:20px;
   }
   label
   {
      margin-bottom: 8px;
   }

   .tktform .form-control {

    border: 1px solid #e6e6e6;
    border-radius: 0px;}

</style>
</head>
<body class="mainbody">
<?php include('menu.php');

  $lead=base64_decode($_REQUEST['lead']);
  $ticketdetails=selectQuery(CONTACT,"*","contact_request_id=".$lead);
?>

<div class="content">
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="panel-body">
                <div class="pull-left reply"><h4>Ticket # - <span id="leadno" class="text-info"><a href="requestdetails.php?req=<?php echo base64_encode($lead); ?>" style="cursor:pointer"><?php echo $lead; ?></a></span> </h4></div>
                     <div class="pull-right"><button type="button" class="btn btnPrimary rightBtn pull-right" onclick="goBack()"> BACK </button></div>
                </div>
            </div>
                <form class="form tktform">
                    <div class="card">
                        <div class="panel-body">
                          <div class="col-md-12">
                            <div class="row">
                               <div class="form-group">
                                 <div class="input-group">
                                    <span  class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i><span class="text-danger">*</span></span>
                                     <input type="text" maxlength="50" minlength="3" onblur="firstcapital('name1')" onkyeup="namechk1('name1')" class="form-control newattr" name="name" placeholder="Enter Name" id="name1" value="<?php echo $ticketdetails[0]['Name']; ?>"/>
                                     <input type="hidden" id="encleadno" value="<?php echo base64_encode($lead); ?>"/>
                                </div>
                            </div>
                             </div>
                            <div class="row">
                            <div class="form-group">
                            <div class="input-group">
                              <span  class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i><span class="text-danger">*</span></span>
                               <input  type="text" class="form-control" maxlength="70" minlength="7" name="email"  placeholder="Enter Email Address." id="cemail" onblur="mailchk('cemail')" value="<?php echo $ticketdetails[0]['Email']; ?>"/>
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group">
                            <div class="input-group">
                                <span  class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i><span class="text-danger">*</span></span>
                                <input type="text"  class="form-control" name="tele" id="tele"  onkeyup="mobnumbercheck('tele')" placeholder="Enter Mobile Number" maxlength="10" value="<?php echo $ticketdetails[0]['Telephone']; ?>"/>
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group marginbot15">
                            <div class="input-group">
                               <span  class="input-group-addon"><i class="fa fa-comment" aria-hidden="true"></i><span class="text-danger">*</span></span>
                                <textarea name="cmnt" placeholder="Enter Comment" class="form-control" id="textareas" cols="5" rows="4" maxlength="400"><?php echo $ticketdetails[0]['Comment']; ?></textarea>
                            </div>
                            </div>
                            </div>
                           </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                    <label for="overduedate">Overdue Date<span style="color:red;">*</span></label>
                                        <input type='text' class="form-control" id='overduedate' placeholder="Overdue Date" value="<?php if($ticketdetails[0]['overdue_date']!=""){echo date('d-m-Y H:i:s', strtotime($ticketdetails[0]['overdue_date']));}  ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="assign">Reason to update<span style="color:red;">*</span></label>
                                        <textarea class="form-control" id="Reason" onkeyup="checkreason();" placeholder="Reason to update" maxlength="500" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="panel-body">
                            <div class="form-group">
                                <button type="button" class="btn btn-success submit" onclick="saveentry()">Update Ticket</button>
                                <button type="button" class="btn btn-danger" onclick="goBack()">Cancel</button>
                            </div>
                            <div class="msg"></div>
                        </div>
                    </div>
                </form>
        </div>
    </div>
     </div>
 </div>
 <?php include 'footer.php';?>
   <script type="text/javascript" src="<?php echo SITEURL; ?>/js/moment.js"></script>
  <script type="text/javascript" src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>

   <script type="text/javascript">
            $(function () {
                $('#dateoftravel').datetimepicker({
                ignoreReadonly: true,
                 minDate:moment(),
                format: 'DD-MM-YYYY',
                disabledTimeIntervals:false
            });
            });

              $(function () {
                $('#overduedate').datetimepicker({
                format: 'DD-MM-YYYY HH:mm:ss',
                disabledTimeIntervals:false
            });
            });

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
                if(!alphanumers.test(name)){
                     var newstr = name.slice(0, -1);
                    $("#"+id).val(newstr);
                }

        }
        function namechk1(id)
        {
            var name =  $('#'+id).val();

            var alphanumers = /^[a-zA-Z ]+$/;
                if(!alphanumers.test(name)){
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
            var overduedate=$("#overduedate").val().trim();
            var Reason=$("#Reason").val().trim();
            var leadno = "<?php echo $lead;?>";
             var  encleadno = $("#encleadno").val();
              if(name.length==0||email.length==0||tele.length==0||cmnt.length==0||overduedate.length==0||Reason.length==0)
              {
                     $(".msg").fadeIn().html("Please Select Mandatory Fields").addClass("alert alert-danger").delay(5000).fadeOut()
              }
              else
              {
                      var loader="<?php echo LOADER; ?>";
                      var loadimg="<img src='"+loader+"' style='width:20%'>";
                      $(".submit").attr("disabled",true);
                      $(".submit").append(" "+loadimg);

                        var form_data = new FormData();

                        form_data.append('leadno', leadno);
                        form_data.append('name', name);
                        form_data.append('email', email);
                        form_data.append('tele', tele);
                        form_data.append('cmnt', cmnt);
                        form_data.append('overduedate', overduedate);
                        form_data.append('Reason', Reason);

                        form_data.append('action',"update_lead");
                        $.ajax({
                            type:"POST",
                            url:"ajax/createticket.php",
                            data:form_data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success:function(response){

                                $(".submit").attr("disabled",false);
                                $(".submit img").remove();
                                if(response)
                                {
                                      if(response==0)
                                      {
                                           $(".msg").fadeIn().html("Error While Ticket Update").addClass("alert alert-danger").delay(5000).fadeOut();
                                      }
                                      else if(response==1)
                                      {
                                        $(".msg").fadeIn().html("Ticket Updated Successfully").addClass("alert alert-success").delay(5000).fadeOut();

                                        setTimeout(function(){ window.location="requestdetails.php?req= "+encleadno }, 3000);
                                      }
                                      else
                                      {

                                      }
                                  }

                                }
                            });
              }
         }
        </script>
</body>
</html>