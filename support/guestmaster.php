<?php include('menu.php');
   $lead=base64_decode($_REQUEST['lead']);
  $docs=selectQuery(DOCS,"*","isActive='1' order by document_name ASC");
  $meal=selectQuery(MEAL,"*","isActive='1' order by meal_type ASC");
?>
<link rel="stylesheet" href="<?php echo SITEURL; ?>/css/datepicker/bootstrap-datetimepicker.min.css"/>

<style>
.addGuestForm{display: none;}
</style>

<div class="content">
    <div class="container">
        <div class="row form-group">
            <div class="col-md-8 col-md-offset-2">
                 <a href="guestmasterindex.php?lead=<?php echo base64_encode($lead); ?>" class="pull-right btn btnPrimary">Back</a>
                 </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 addNewGuest">
                <ul id="newGuest" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                    <a href="#" id="serexit"><i class="fa fa-search" aria-hidden="true"></i> Search In Existing</a></li>
                    <? if($loginstaff[0]['create_guest']=="1"){ ?>
                    <li role="presentation">
                     <a href="#" id="addNew" ><i class="fa fa-user" aria-hidden="true"></i> Add New</a></li>
                    <?php
                      }
                    ?>
                  </ul>

                <div class="tab-content">
                    <div class="serInExit">
                        <div class="catdata searchdiv">
                <div class="card  panel-body paddbottom">
                            <div class="form-group">
                             <div class="input-group">
                               <input type="search" placeholder="Search Guest" list="languages" class="form-control" name="model" autocomplete="off" id="model" maxlength="1000"  onkeyup='showHint( event, this.value,"<? echo $lead; ?>" )'>
                                 <span class="input-group-addon searchbtn" onclick="prodentry()">Search In Existing</span>
                                </div>
                                </div>
                   <div class="row">
                    <div class="col-md-12 searchdata">
                  </div>
                 </div>
                </div>
                </div>
                    </div>
                    <div class="addGuestForm">
                    <form class="newguestform">
                        <div class="card">
                        <div class="panel-heading"><div class="panel-title">Profile</div></div>
                            <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Name<span style="color:red">*</span></label>
                                   <div class="row">
                                    <div class="col-md-2">
                                    <div class="form-group">
                                    <input type="hidden" id="lead" value="<?php echo $lead; ?>">
                                        <select class="form-control nametitle" id="nametitle">
                                          <option value="Mr">Mr</option>
                                          <option value="Mrs">Mrs</option>
                                          <option value="Master">Master</option>
                                          <option value="Miss">Miss</option>
                                          <option value="Ms">Ms</option>
                                          <option value="Dr">Dr</option>
                                          <option value="Mx">Mx</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4"><div class="form-group"> <input type="text" class="form-control" id="firstame" onkeyup="namechk('firstame')" maxlength="20" placeholder="First Name"> </div> </div>
                                    <div class="col-md-4 col-sm-4"><div class="form-group"> <input type="text" class="form-control" id="middleame" onkeyup="namechk('middleame')" maxlength="20" placeholder="Middle Name(Optional)"> </div></div>
                                    <div class="col-md-3 col-sm-4"><div class="form-group"> <input type="text" class="form-control" id="lastame" onkeyup="namechk('lastame')" maxlength="20" placeholder="Last Name"> </div></div>
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Company / Group Name</label>
                                    <input type="text" class="form-control" id="company" placeholder="Company / Group Name">
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>Mobile<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="mobile" maxlength="10" onkeyup="mobnumbercheck('mobile')" placeholder="Mobile">
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" id="email" onblur="mailchk('email')" maxlength="70" placeholder="Email">
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>Nationality</label>
                                    <input type="text" class="form-control" id="nationality" onkeyup="namechk('nationality')" maxlength="30" placeholder="Nationality">
                                  </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>Date of Birth</label>
                                     <div class="input-group">
                                    <input type="text" class="form-control" id="dob" placeholder="Date of Birth">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label style="margin-bottom: 16px;">Marrital Status</label> <br>
                                    <label class="radio-inline">
                                      <input type="radio" name="inlineRadioOptions" id="marriatal" value="Married" onclick="married();">Married
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="inlineRadioOptions" id="marriatal" value="Unmarried" onclick="unmarried();">Unmarried
                                    </label>
                                  </div>
                                </div>
                            </div>
                            <div class="row" id="marriageDate">
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>Marriage Date</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="marriage" placeholder="Aniversary Date">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            </div>
                            </div>
                             <div class="card">
                             <div class="panel-heading"><div class="panel-title">Passport Details</div></div>
                            <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>Passport No</label>
                                        <input type="text" class="form-control pasPortNo"  id="passportno" maxlength="15" placeholder="Passport no" data-target=".paddPortDetails">
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-6 paddPortDetails dispassdetails">
                                  <div class="form-group">
                                    <label>Date of Passport Issue</label>
                                     <div class="input-group">
                                    <input type="text" class="form-control" id="issue" placeholder="Passport Issue">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="row paddPortDetails dispassdetails">
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>Date of Passport Expiry</label>
                                    <div class="input-group">
                                    <input type="text" class="form-control" id="expiry" placeholder="Passport Expiry">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>Place of Passport Issue</label>
                                    <input type="text" class="form-control" id="passport_palce" maxlength="40" onkeyup="namechk('passport_palce')" placeholder="Place of Passport Issue">
                                  </div>
                                </div>
                            </div>
                              <div class="row paddPortDetails dispassdetails">
                                 <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>No of empty Passport pages</label>
                                    <input type="text" class="form-control" id="passport_pages" onkeyup="numbercheck('passport_pages')" maxlength="2" placeholder="No of empty pages">
                                  </div>
                                </div>
                            </div>
                            </div>
                            </div>
                            <div class="card">
                            <div class="panel-heading"><div class="panel-title">Visa Details</div></div>
                            <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>Valid visa1</label>
                                    <input type="text" class="form-control" id="validvisa1"  maxlength="15" placeholder="Valid visa1">
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>Valid visa2</label>
                                    <input type="text" class="form-control" id="validvisa2"  maxlength="15" placeholder="Valid visa2">
                                  </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>FFN</label>
                                    <input type="text" class="form-control" id="ffn" maxlength="200" placeholder="FFN">
                                  </div>
                                </div>
                            </div>
                             </div>
                            </div>
                            <div class="card">
                            <div class="panel-heading"><div class="panel-title">Travel Preference</div></div>
                            <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>Meal Preference</label>
                                    <select class="form-control" id="meal">
                                     <option value=""> - Select Meal Type -</option>
                                      <?php
                                            for($i=0;$i<count($meal);$i++)
                                            {
                                                ?>
                                                  <option value="<?php echo $meal[$i]['meal_type']; ?>"><?php echo $meal[$i]['meal_type']; ?></option>
                                                <?
                                            }
                                             ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label>Insurance Nominee</label>
                                    <input type="text" class="form-control" id="insurance" onkeyup="namechk('insurance')"  maxlength="50" placeholder="Insurance Nominee">
                                  </div>
                                </div>
                            </div>
                            </div>
                            </div>
                            <div class="card">
                            <div class="panel-heading"><div class="panel-title">Important Identification</div></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" id="docs">
                                            <option value=""> - Select Document -</option>
                                            <?php
                                            for($i=0;$i<count($docs);$i++)
                                            {
                                                ?>
                                                  <option value="<?php echo $docs[$i]['document_name']; ?>"><?php echo $docs[$i]['document_name']; ?></option>
                                                <?
                                            }
                                             ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3"><div class="form-group"> <button type="button" class="btn btnPrimary" onclick="adddoc('docs')">Add</button></div></div>
                                    </div>
                                <div class="documentlist">
                                      <input type="hidden" name="doclist" id="doclist">
                                </div>
                                </div>
                            </div>
                        <div class="msg"></div>
                        <div class="clearfix"></div>
                          <button type="button" onclick="saveguest()" class="btn btn-success pull-right submit">Submit</button>
                        </form>
                    </div>
                  </div>
            </div>
            </div>
        </div>
    </div>

<?php include('footer.php'); ?>

<script type="text/javascript" src="<?php echo SITEURL; ?>/js/moment.js"></script> <!--required for date picker-->
<script type="text/javascript" src="<?php echo SITEURL; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>
<script>
    $(function () {
        $('#dob').datetimepicker({
        useCurrent: false,
        ignoreReadonly: true,
         maxDate:moment(),
        format: 'DD-MM-YYYY',
        disabledTimeIntervals:false
        });
         $('#issue').datetimepicker({
         useCurrent: false,
        ignoreReadonly: true,
         maxDate:moment(),
        format: 'DD-MM-YYYY',
        disabledTimeIntervals:false
        });
         $('#expiry').datetimepicker({
         useCurrent: false,
        ignoreReadonly: true,
         minDate:moment(),
        format: 'DD-MM-YYYY',
        disabledTimeIntervals:false
        });
        $("#marriage").datetimepicker({
        ignoreReadonly: true,
         maxDate:moment(),
        format: 'DD-MM-YYYY',
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
         function adddoc(id)
         {
             var docoption=$("#"+id+" option:selected").val();
             var doclist=$("#doclist").val();
             if(doclist!="")
             {
                 var docarr=doclist.split(",");
             }
             else
             {
                var docarr=[];
             }

             if(docoption!="")
             {
                  classname = docoption.replace(/\s/g, '');
                  var removefunction="removedoc('"+classname+"div','"+docoption+"')";
                  var readurl="readURL('"+classname+"doc','"+classname+"' , '"+classname+"error');"
                /* var str=' <div class="form-group '+classname+'div"><div class="form-inline"><div class="form-group" style="width:100%;"><label style="width:20%;">'+docoption+'</label><input type="text" class="form-control" id="'+classname+'" placeholder="'+docoption+' Number"> <input type="file" name="'+classname+'doc" id="'+classname+'doc" class="form-control inputfile inputfile-5 fileAttach" onchange="'+readurl+'" tabindex="13"/><label for="'+classname+'doc" class="browsFile"><svg class="pull-left" width="20" height="20" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg><span>Attach File</span><span id="'+classname+'file" style="width: 100px;overflow: hidden;display: block;"></span></label><button type="button" class="btn btn-default" style="margin-left:20px;" onclick="'+removefunction+'"><i class="fa fa-times"></i></button><span id="'+classname+'error"></span></div></div></div>';*/
                 var str=' <div class="form-group '+classname+'div"><div class="form-inline"><div class="form-group" style="width:100%;"><label style="width:20%;">'+docoption+'</label> <input type="file" name="'+classname+'doc" id="'+classname+'doc" class="form-control inputfile inputfile-5 fileAttach" onchange="'+readurl+'" tabindex="13"/><label for="'+classname+'doc" class="browsFile"><svg class="pull-left" width="20" height="20" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg><span>Attach File</span><span id="'+classname+'file" style="width: 100px;overflow: hidden;display: block;"></span></label><button type="button" class="btn btn-default" style="margin-left:20px;" onclick="'+removefunction+'"><i class="fa fa-times"></i></button><span id="'+classname+'error"></span></div></div></div>';
                 $(".documentlist").append(str);
                 $("#"+id+" option:contains('" + docoption + "')").attr("disabled","disabled");
                  docarr.push(docoption);
                  docstr=docarr.toString();
                  $("#doclist").val(docstr);
             }
         }
         function removedoc(divclass,doc_name)
         {
             $(".documentlist ."+divclass).remove();
             var doclist=$("#doclist").val();
              var newarr=[];
                 var docarr=doclist.split(",");
                 for(i=0;i<docarr.length;i++)
                 {
                     if(docarr[i]==doc_name)
                     {
                           $("#docs option[value='" + doc_name + "']").attr("disabled", false);
                     }
                     else
                     {
                        newarr.push(docarr[i]);
                     }
                 }
               docstr=newarr.toString();
               $("#doclist").val(docstr);

         }

         function saveguest()
         {
              var loader="<?php echo LOADER; ?>";
                      var loadimg="<img src='"+loader+"' style='width:20%'>";

              lead=$("#lead").val();
              nametitle=$("#nametitle option:selected").val();
              firstame=$("#firstame").val();
              middleame=$("#middleame").val();
              lastame=$("#lastame").val();
              company=$("#company").val();
              mobile=$("#mobile").val();
              email=$("#email").val();
              nationality=$("#nationality").val();
              dob=$("#dob").val();
              marriatal=$('input[name="inlineRadioOptions"]:checked').val();
              marriage=$("#marriage").val();
              passportno=$("#passportno").val();
              issue=$("#issue").val();
              expiry=$("#expiry").val();
              passport_palce=$("#passport_palce").val();
              passport_pages=$("#passport_pages").val();
              validvisa1=$("#validvisa1").val();
              validvisa2=$("#validvisa2").val();
              ffn=$("#ffn").val();
              meal=$("#meal option:selected").val();
              insurance=$("#insurance").val();
              doclist=$("#doclist").val(); 
              var form_data = new FormData();

             form_data.append('lead', lead);
            form_data.append('nametitle', nametitle);
            form_data.append('firstame', firstame);
            form_data.append('middleame', middleame);
            form_data.append('lastame', lastame);
             form_data.append('company', company);
            form_data.append('mobile', mobile);
            form_data.append('email', email);

            form_data.append('nationality', nationality);
            form_data.append('dob', dob);
            form_data.append('marriatal', marriatal);
            form_data.append('marriage', marriage);

            form_data.append('passportno', passportno);
            form_data.append('issue', issue);
            form_data.append('expiry', expiry);
            form_data.append('passport_palce', passport_palce);
            form_data.append('passport_pages', passport_pages);
            form_data.append('validvisa1', validvisa1);
            form_data.append('validvisa2', validvisa2);
            form_data.append('ffn', ffn);
            form_data.append('meal', meal);
            form_data.append('insurance', insurance);
            form_data.append('doclist', doclist);
            form_data.append('action',"add_guest");
              if(doclist!="")
             {
                 var docarr=doclist.split(",");
             }
             else
             {
                var docarr=[];
             }
             for(i=0;i<docarr.length;i++)
             {
                   classname = docarr[i].replace(/\s/g, '');
                  /* value12=$("#"+classname).val();
                   form_data.append(classname, value12);*/

                     var named  =  classname+"doc";
                     if ($("#"+named)[0].files.length > 0) {
                         var doc = $("#"+named).prop('files')[0];
                         var size = $("#"+named)[0].files[0].size;
                         var type = $("#"+named)[0].files[0].type;
                         var name = $("#"+named)[0].files[0].name;

                         } else
                         {
                        var doc = "";
                        }

                form_data.append(named, doc);
            }
             if(firstame.length==0||lastame.length==0||mobile.length==0)
            {
                   $(".msg").fadeIn().html("Name and Mobile Number mandatory").addClass("alert alert-danger").delay(5000).fadeOut()
            }
            else
            {
                   $(".submit").attr("disabled",true);
                      $(".submit").append(" "+loadimg);
                         $.ajax({
                            type:"POST",
                            url:"guest_entry.php",
                            data:form_data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success:function(response){
                                 $(".submit").attr("disabled",false);
                                    $(".submit img").remove();
                               if(response)
                                  {
                                      if(response==3)
                                      {
                                          $(".msg").fadeIn().html("Guest Added Successfully").addClass("alert alert-success").delay(5000).fadeOut()
                                          $("input[type=text], textarea,.doclist").val("");

                                      }
                                      else if(response==0)
                                      {
                                          $(".msg").fadeIn().html("Error While Guest Add").addClass("alert alert-danger").delay(5000).fadeOut()
                                      }
                                      else if(response==1)
                                      {
                                          $(".msg").fadeIn().html("Guest Already Availalve With Same Name And Mobile Number").addClass("alert alert-danger").delay(5000).fadeOut()
                                      }
                                      else if(response==2)
                                      {
                                          $(".msg").fadeIn().html("All Required Fields Are Missing").addClass("alert alert-danger").delay(5000).fadeOut()
                                      }
                                  }

                                }
                            });
            }
         }

         function showHint(event, str,lead) {
                if(event.keyCode==13)
                {
                    prodentry();
                }
                else if( event.keyCode==40 || event.keyCode==38)
                  {

                  }
                 else {
                      if( str.length == 0 ) {
                           $(".searchdata").html("").hide();
                      }
                      else {

                           var info={searchstr:str,lead:lead,action:"showsearchhint"};
                          $.ajax({
                                type:"POST",
                                url:"guest_entry.php",
                                data:info,
                                success:function(response){
                                      $(".searchdata").html(response).show().removeClass("hinttext");
                               }
                          });

                      }
                }
            }

            function addleadtouser(lead,leadtd)
            {
                    var info={guestid:leadtd,lead:lead,action:"addtolead"};
                      $.ajax({
                            type:"POST",
                            url:"guest_entry.php",
                            data:info,
                            success:function(response){
                                if(response==1)
                                {
                                     $("."+leadtd).html("Added");
                                }
                                else
                                {

                                }

                           }
                      });
            }


</script>

<script>


$("#serexit").click(function(){
    $("#addNew").parent().removeClass("active");
    $(this).parent().addClass("active");
      $(".serInExit").fadeIn();
      $(".addGuestForm").hide();

})

$("#addNew").click(function(){
    $("#serexit").parent().removeClass("active");
    $(this).parent().addClass("active");
     $(".addGuestForm").fadeIn();
      $(".serInExit").hide();

})





    function readURL(val1,val2,error)

     {

       var inp = $('#'+val1).prop('files')[0];


        if(($('#'+val1))[0].files.length > 0)

        {

            var filedoc=($('#'+val1)).prop('files')[0];

            var filesize =($('#'+val1))[0].files[0].size;

            var filetype = ($('#'+val1))[0].files[0].type;

            var filename = ($('#'+val1))[0].files[0].name;


        }

        else

        {

            var filedoc="";

        }



           var allowedFiles = ["image/jpg", "image/jpeg", "image/png"];

           var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");





        if ((filedoc!=""&&allowedFiles.indexOf(filetype)==-1) )

        {

            $("#"+error).fadeIn()

            $("#"+error).html("Only JPG / JPEG / PNG").css("color","red").delay(5000).fadeOut();

            return false;

            $("#"+error).html('');

        }

        else{}



        var ss = filesize/1024;



        if(ss>1024)

        {

           $("#"+error).fadeIn();

           $("#"+error).html("Max Image Size - 1MB").addClass("text-danger").delay(5000).fadeOut();

        }

        else

        {

            /*$('#'+val2).attr('src',URL.createObjectURL(filedoc)); */
          $("#"+error).fadeIn();

           $("#"+error).html("File Attached").css("margin-left","17px").addClass("text-success");

        }

     }

$("#marriageDate").hide();

function unmarried(){
  document.getElementById('marriageDate').style.display ='none';
}
function married(){
  document.getElementById('marriageDate').style.display = 'block';
}

/*$(function () {
    var $contents = $('.dispassdetails').hide();
    $('.pasPortNo').change(function () {
        $contents.hide();
        $($(this).data('target')).show();
        var $passNo = $('#passportno');
        if ($passNo.val() == "") {
		    $contents.hide();
		}
    });
});*/

</script>