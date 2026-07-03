 $(function () {
        $("#startdate").datetimepicker({
        format: 'DD-MM-YYYY HH:mm',
        })
        .on('dp.change', function(ev){
            startdate=$(this).val();
            duration=$("#duration").val();
            if(duration=="")
            {
                  $('.msgs').fadeIn();
                   $('.msgs').removeClass('alert alert-success');
                  $('.msgs').addClass('alert alert-danger');
                  $('.msgs').html('Please Select Duration First');
                  $('.msgs').delay(5000).fadeOut();
                  $("#startdate").val("");
                   $(".startdateshow").html("");
            }
            else
            {
                 $(".startdateshow").html(startdate);
                   info={startdate:startdate,duration:duration};
                         $.ajax({
                          type: "POST",
                          url: "getduration1.php",
                          data:info,
                          success: function(response){
                              $(".enddateshow").html(response);
                        }
                    });
            }
        });
    });
    function changedate(duration,startdate)
    {
        startdateval=$("."+startdate).val();
        durationval=$("."+duration).val();
        if(startdateval!="")
        {
             info={startdate:startdateval,duration:durationval};
                 $.ajax({
                  type: "POST",
                  url: "getduration1.php",
                  data:info,
                  success: function(response){
                      $(".enddateshow").html(response);
                }
            });
        }
    }
    function checkabovedata()
    {
         var duration=$("#duration").val();
        start=$("#startdate").val();
        deposite=$("#deposite").val();
        if(deposite==""||start==""||duration=="")
        {
             $(".fixedrent").val("");
              $('.msgs').fadeIn();
               $('.msgs').removeClass('alert alert-success');
              $('.msgs').addClass('alert alert-danger');
              $('.msgs').html('Please Enter Duration, Start Date, deposite to proceed next');
              $('.msgs').delay(5000).fadeOut();
        }
    }
    function showrent(fixedrent,fixddiv,variablerent,variablediv)
    {
        var duration=$("#duration").val();
        start=$("#startdate").val();
        deposite=$("#deposite").val();
        if(deposite==""||start==""||duration=="")
        {
              $('.msgs').fadeIn();
               $('.msgs').removeClass('alert alert-success');
              $('.msgs').addClass('alert alert-danger');
              $('.msgs').html('Please Enter Duration, Start Date, deposite to proceed next');
              $('.msgs').delay(5000).fadeOut();
        }
        else
        {
              /* $("."+fixedrent+",."+fixddiv).show();
               $("."+variablerent+",."+variablediv).hide();*/
                $("."+fixddiv).show();
               $("."+variablediv).hide();
               $(".fixedrent").val("");
               $(".fixedrentshow").html("");
                 $(".stamp").val("");
               resetvartab('vartable','monthto1','varrent1','varrentshow','varrentshow1','varrentmonthshow1');
        }
    }
    function addtr(currinp,preinp,rowclass,tableclass,liclass,lispan2,rent)
    {
        var currval= $("."+currinp).val();
        var preval= $("."+preinp).val();
        var rentval= $("."+rent).val();
        var rowclassid= $("."+rowclass).attr("data-id");
         var rowid= $("."+rowclass).attr("id");
        var duration=$("#duration").val();
        var incr=parseInt(rowclassid)+1;
        var nextinpval=parseInt(currval)+1;
        $("."+rent).attr("disabled",false);
        if(rowid=="current")
        {
              if(duration=="")
            {
                  $('.msgs').fadeIn();
                   $('.msgs').removeClass('alert alert-success');
                  $('.msgs').addClass('alert alert-danger');
                  $('.msgs').html('Please Enter Duration First');
                  $('.msgs').delay(5000).fadeOut();
                  $("."+currinp).val("");
            }
            else if(currval.length=="0")
            {
                  $('.msgs').fadeIn();
                   $('.msgs').removeClass('alert alert-success');
                  $('.msgs').addClass('alert alert-danger');
                  $('.msgs').html('Please Enter Month');
                  $('.msgs').delay(5000).fadeOut();
            }
            else if(parseInt(preval) > parseInt(currval)||parseInt(duration) < parseInt(currval))
            {
                $('.msgs').fadeIn();
               $('.msgs').removeClass('alert alert-success');
              $('.msgs').addClass('alert alert-danger');
              $('.msgs').html('Please Enter valid month');
              $('.msgs').delay(5000).fadeOut();
              $("."+currinp).val("");
            }
            else
            {
                if(duration==currval)
                {
                    var minus=incr-1;
                     $("."+lispan2).html(preval+" To "+currval);
                    var nmfunc21="numbercheck('varrent1"+minus+"')";
                    var other21="othershowvalinput('varrent1"+minus+"','varrentshow1"+minus+"')";
                  /*   func="calculatevar('duration','deposite','varrentshow','varrentdetails1','varrent','dura')";         */
                     /*  discfunc="disableinp('varrent1"+incr+"')";     */
                     /*$("."+rent).attr("onblur",discfunc+";"+func+";");    */
                     /* $("."+currinp).attr("disabled","disabled");              */
                }
                else
                {
                  if(rowclassid=="1")
                  {
                        $(".varrow1").removeAttr("id");
                  }
                  else
                  {
                        $(".varrow1"+rowclassid).removeAttr("id");
                  }
                    $("."+lispan2).html(preval+" To "+currval);
                   /* $("."+currinp).attr("disabled","disabled");   */
                    var nmfunc1="numbercheck('monthfrom1"+incr+"')";
                    var nmfunc2="numbercheck('monthto1"+incr+"')";
                    var nmfunc3="numbercheck('varrent1"+incr+"')";
                    var other3="othershowvalinput('varrent1"+incr+"','varrentshow1"+incr+"')";
                   /* discfunc="disableinp('varrent1"+incr+"')";  */
                    chkfunc="chkprev('monthto1"+incr+"','varrent1"+incr+"','varrentshow1"+incr+"')";
                    var aadtr="addtr('monthto1"+incr+"','monthfrom1"+incr+"','varrow1"+incr+"','vartable','varrentdetails1"+incr+"','varrentmonthshow1"+incr+"','varrent1"+incr+"')";
                    str='  <tr class="varrow1'+incr+'" data-id="'+incr+'" id="current"> '+
                   '<td> <input type="text" name="monthfrom1'+incr+'" class="form-control monthfrom1'+incr+'" id="monthfrom1'+incr+'" onkeyup="'+nmfunc1+'"  maxlength="1" disabled value="'+nextinpval+'"/>  </td>   '+
                   '<td> <input type="text" name="monthto1'+incr+'" class="form-control monthto1'+incr+'" id="monthto1'+incr+'" onkeyup="'+nmfunc2+'" onblur="'+aadtr+'" maxlength="2"/>  </td>  '+
                   '<td> <input type="text" name="varrent1'+incr+'" class="form-control varrent1'+incr+'" id="varrent1'+incr+'" onkeyup="'+nmfunc3+';'+chkfunc+';'+other3+';"   maxlength="6"/>  </td>  '+
                 '</tr>';
                 str1 =' <li class="varrentdetails1'+incr+'"> '+
                 ' Rs. <span class="text-bold varrent varrentshow1'+incr+'"></span> /- per month for the  <span class="text-bold dura varrentmonthshow1'+incr+'"></span> months  '+
                 ' </li>  ';
                  $(".varrentshow").append(str1);
                 $("."+tableclass+" tbody").append(str);
                }
            }
        }
        else
        {
            from1= $("#monthfrom1"+incr).val();
             var less=parseInt(from1)-1;
            if(currval!=less)
            {
                  $('.msgs').fadeIn();
                   $('.msgs').removeClass('alert alert-success');
                  $('.msgs').addClass('alert alert-danger');
                  $('.msgs').html('Only '+less+" is valid for this place");
                  $('.msgs').delay(5000).fadeOut();
                   $("."+currinp).val(less);
            }
        }
    }
    function chkprev(monthto1,currval,showclass)
    {
        var duration=$("#duration").val();
       toval=$("#"+monthto1).val();
       if(toval=="")
       {
          $("."+currval).val("");
          $("."+monthto1).focus();
          $(".msgs").removeClass("alert alert-success").addClass("alert alert-danger").fadeIn().html("Please select rent duration months").delay(5000).fadeOut();
       }
       else if(duration==toval)
       {
          /*  discfunc="disableinp('"+currval+"')";   */
          /* func="calculatevar('duration','deposite','varrentshow','varrentdetails1','varrent','dura')"      */
         /*  $("."+currval).attr("onblur",discfunc+";"+func+";");         */
       }
    }
    /*function disc(inp)
    {
        $("."+inp).attr("disabled",true);
    }*/
    function disableinp(inp)
    {
          $("."+inp).attr("disabled",true);
    }
    function resetvartab(vartable,inpto,inprent,showclassol,span1,span2)
    {
         $("."+vartable+" tr:not(:first-child)").remove();
         $("."+showclassol+" li:not(:first-child)").remove();
         $("."+inpto+",."+inprent).val("");
         $("#regfee,#stamp,#total").val("");
         $("."+span1+",."+span2).html("");
         $("."+inpto+",."+inprent).attr("disabled",false);
          $(".varrow1").attr("id","current");
         $(".calc").hide();
          $(".fixedrent").attr("disabled",false);
         $(".calcbtn").attr("disabled",false);
          $(".duration").attr("disabled",false);
          $(".deposite").attr("disabled",false);
          $(".renttype").attr("disabled",false);
    }
    function calculatefixed(fixedrent,duration,deposite)
    {
          durationval=$("."+duration).val();
          depositeval=$("."+deposite).val();
          fixedrentval=$("."+fixedrent).val();
         arealoc=$(".arealoc:checked").val();
         service=$(".service").val();
         extravisit=$(".extravisit:checked").val();
         policeintimation=$(".policeintimation:checked").val();
         if(extravisit==1){
          $(".xtravisitbox").show();
          xtra_visit_charge=$(".xtra_visit_charge").val();
         }else{
           $(".xtravisitbox").hide();
           xtra_visit_charge=0;
         }
          if(policeintimation==1){
          $(".policebox").show();
          police_charge=$(".police_charge").val();
         }else{
           $(".policebox").hide();
           police_charge=0;
         }
         visit_charge = $("#visit_charge").val();
         dhc = $("#dhc").val();
          if(durationval!=""&&depositeval!=""&&fixedrentval!="")
          {
              totalinamt= fixedrentval* durationval;
              depo10=(depositeval/100)*10;
              tax=parseInt(totalinamt)+parseInt(depo10);
              stamp= (tax*0.25)/100;
               rval=Math.round(stamp);
              roundup= roundUp(rval);
               totalchrgs= parseInt(roundup)+parseInt(service)+parseInt(arealoc)+parseInt(visit_charge)+parseInt(xtra_visit_charge)+parseInt(police_charge)+parseInt(dhc);
              $(".stamp").val(roundup);
              $(".regfee").val(arealoc);
              $(".total").val(totalchrgs);
              $("."+duration).attr("disabled",true);
              $("."+deposite).attr("disabled",true);
              $("."+fixedrent).attr("disabled",true);
               $(".renttype").attr("disabled",true);
          }
    }
    function calculatevar(duration,deposite,olclass,liclass,spanrent,spandura)
    {
        finalval=0;
        durationval=$("."+duration).val();
        depositeval=$("."+deposite).val();
        arealoc=$(".arealoc:checked").val();
        service=$(".service").val();
        visit_charge = $("#visit_charge").val();
        dhc = $("#dhc").val();
          extravisit=$(".extravisit:checked").val();
         policeintimation=$(".policeintimation:checked").val();
         if(extravisit==1){
          $(".xtravisitbox").show();  xtra_visit_charge=$(".xtra_visit_charge").val();
         }else{
           $(".xtravisitbox").hide();  xtra_visit_charge=0;
         }
          if(policeintimation==1){
          $(".policebox").show();    police_charge=$(".police_charge").val();
         }else{
           $(".policebox").hide();  police_charge=0;
         }
        $('.'+olclass+' li').each(function()
        {
            duracnt=0;
          var rent=$(this).children('.'+spanrent).html(); // This is your rel value
          var dura= $(this).children('.'+spandura).html();
          var res = dura.split(" To ");
          startfrom=res[0].trim();
          endon=res[1].trim();
          dura=parseInt(endon)-(parseInt(startfrom)-1);
          finalval=parseInt(finalval)+(parseInt(rent)*parseInt(dura));
        });
           totalinamt= finalval;
              depo10=(depositeval/100)*10;
              tax=parseInt(totalinamt)+parseInt(depo10);
              stamp= (tax*0.25)/100;
               rval=Math.round(stamp);
              roundup= roundUp(rval);
             totalchrgs= parseInt(roundup)+parseInt(service)+parseInt(arealoc)+parseInt(visit_charge)+parseInt(xtra_visit_charge)+parseInt(police_charge)+parseInt(dhc);
             /* $(".regfee").val(stamp);   */
              $(".stamp").val(roundup);
              $(".regfee").val(arealoc);
              $(".total").val(totalchrgs);
              $("."+duration).attr("disabled",true);
              $("."+deposite).attr("disabled",true);
              $(".renttype").attr("disabled",true);
    }
    function roundUp(value) {
            return (~~((value + 99) / 100) * 100);
    }
    function previousstep3(Step3,Step2,pill3,pill2)
    {
        $("#"+Step3).removeClass("show active");
        $("#"+Step2).addClass("show active");
        $("."+pill3).removeClass("active");
        $("."+pill2).addClass("active");
    }
    function finalproceed(siteurl)
    {
         duration=$(".duration").val();
         renttype=$(".renttype:checked").val();
         start=$(".startdate").val();
         end=$(".enddateshow").html();
         deposite=$(".deposite").val();
         regfee=$(".regfee").val();
         stamp=$(".stamp").val();
         service=$(".service").val();
         visit_charge = $("#visit_charge").val();
         dhc = $("#dhc").val();
         total=$(".total").val();
         misc=$(".misc").val();
         entryby=$("#uid").val();
         tokenno=$(".tokenno").val();
          extravisit=$(".extravisit:checked").val();
         policeintimation=$(".policeintimation:checked").val();
         xtra_visit_charge=$(".xtra_visit_charge").val();
         police_charge=$(".police_charge").val();
        if(duration!=""&&start!=""&&deposite!=""&&regfee!=""&&service!=""&&total!="")
        {
             var loader=$(".loaderimg").val();
              var loadimg="<img src='"+loader+"' style='width:20%'>";
              $(".submit,.prev3").attr("disabled",true);
              $(".submit").append(" "+loadimg);
             arealoc=$(".arealoc:checked").val();
             propertytype=$(".propertytype option:selected").val();
             propertyarea=$(".builtarea").val();
             galleryarea=$(".gallery").val();
             parkingarea=$(".parking").val();
             propertyuse=$(".propertyuse option:selected").val();
             buildingname=$(".buildingname").val();
             flatno=$(".flat").val();
             floorno=$(".floor").val();
             road=$(".road").val();
             locality=$(".locality").val();
             propno=$(".propno").val();
             village=$(".village").val();
             tahsil=$(".tahsil").val();
             dist=$(".dist").val();
             proppin=$(".proppin").val();
             content=$(".agricontent").html();
              var form_data = new FormData();
               form_data.append('uid',entryby);
              form_data.append('arealoc',arealoc);
              form_data.append('propertytype',propertytype);
              form_data.append('propertyarea',propertyarea);
              form_data.append('galleryarea',galleryarea);
              form_data.append('parkingarea',parkingarea);
              form_data.append('propertyuse',propertyuse);
              form_data.append('buildingname',buildingname);
              form_data.append('flatno',flatno);
              form_data.append('floorno',floorno);
              form_data.append('road',road);
              form_data.append('locality',locality);
              form_data.append('propno',propno);
              form_data.append('village',village);
              form_data.append('tahsil',tahsil);
              form_data.append('dist',dist);
              form_data.append('proppin',proppin);
              form_data.append('content',content);
              form_data.append('entry_by',entryby);
              form_data.append('duration',duration);
              form_data.append('renttype',renttype);
              form_data.append('start',start);
              form_data.append('end',end);
              form_data.append('deposite',deposite);
              form_data.append('regfee',regfee);
              form_data.append('service',service);
              form_data.append('visit_charge',visit_charge);
              form_data.append('dhc',dhc);
              form_data.append('extravisit',extravisit);
              form_data.append('policeintimation',policeintimation);
              form_data.append('xtra_visit_charge',xtra_visit_charge);
              form_data.append('police_charge',police_charge);
              form_data.append('stamp',stamp);
              form_data.append('total',total);
              form_data.append('misc',misc);
              form_data.append('tokenno',tokenno);
               form_data.append('action',"addbasic");
               $.ajax({
                type:"POST",
                url:"save_agreement.php",
                data:form_data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(response){
                  if(response.trim()==0)
                  {
                       $(".submit,.prev3").attr("disabled",false);
                     $(".submit img").remove();
                       $(".msg").fadeIn().html("Error While Creation").addClass("alert alert-danger").delay(5000).fadeOut()
                  }
                  else
                  {
                      agrrement_no=response;
                      /************* insert landlord ******************************/
                      $('.landlord').each(function()
                        {
                          var name=$(this).children('.name').html();
                          var gender=$(this).children('.gender').html();
                          var age=$(this).children('.age').html();
                          var occupation=$(this).children('.occupation').html();
                          var mobile=$(this).children('.mobile').html();
                          var pan=$(this).children('.pan').html();
                          var email=$(this).children('.email').html();
                          var aadhaar=$(this).children('.aadhaar').html();
                          var address=$(this).children('.address').html();
                          var pincode=$(this).children('.pincode').html();
                             var form_data1 = new FormData();
                              form_data1.append('name',name);
                              form_data1.append('gender',gender);
                              form_data1.append('age',age);
                              form_data1.append('occupation',occupation);
                              form_data1.append('mobile',mobile);
                              form_data1.append('pan',pan);
                              form_data1.append('aadhaar',aadhaar);
                               form_data1.append('email',email);
                              form_data1.append('address',address);
                              form_data1.append('pincode',pincode);
                              form_data1.append('action',"add_landlord");
                              form_data1.append('agrrementno',agrrement_no);
                          $.ajax({
                                type:"POST",
                                url:"save_agreement.php",
                                data:form_data1,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success:function(response){
                                }
                             });
                        });
                        /********************** Insert Tenent *************************************/
                        $('.tenent').each(function()
                        {
                          var name=$(this).children('.name').html();
                          var gender=$(this).children('.gender').html();
                          var age=$(this).children('.age').html();
                          var occupation=$(this).children('.occupation').html();
                          var mobile=$(this).children('.mobile').html();
                          var pan=$(this).children('.pan').html();
                          var email=$(this).children('.email').html();
                          var aadhaar=$(this).children('.aadhaar').html();
                          var address=$(this).children('.address').html();
                          var pincode=$(this).children('.pincode').html();
                             var form_data2 = new FormData();
                              form_data2.append('name',name);
                              form_data2.append('gender',gender);
                              form_data2.append('age',age);
                              form_data2.append('occupation',occupation);
                              form_data2.append('mobile',mobile);
                              form_data2.append('pan',pan);
                              form_data2.append('aadhaar',aadhaar);
                               form_data2.append('email',email);
                              form_data2.append('address',address);
                              form_data2.append('pincode',pincode);
                              form_data2.append('action',"add_tenent");
                              form_data2.append('agrrementno',agrrement_no);
                          $.ajax({
                                type:"POST",
                                url:"save_agreement.php",
                                data:form_data2,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success:function(response){
                                }
                             });
                        });
                        
                        
                         /**********************  Insert Vitness *************************************/
                         
                         
                        $('.vitness_s').each(function()
                        {
                            var vitness_name=$(this).children('.vitness_name').html();
                            var vitness_lname=$(this).children('.vitness_lname').html();
                            var vitness_mbl=$(this).children('.vitness_mbl').html();
                            var vitness_email=$(this).children('.vitness_email').html();
                            var vitness_address=$(this).children('.vitness_address').html();
                            var form_datan = new FormData();
                            form_datan.append('vitness_name',vitness_name);
                            form_datan.append('vitness_lname',vitness_lname);
                            form_datan.append('vitness_mbl',vitness_mbl);
                            form_datan.append('vitness_email',vitness_email);
                            form_datan.append('vitness_address',vitness_address);
                            form_datan.append('action',"add_vitness");
                            form_datan.append('agrrementno',agrrement_no);
                            $.ajax({
                                type:"POST",
                                url:"save_agreement.php",
                                data:form_datan,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success:function(response){
                                }
                             });
                        });    
                        
                        /********************** Insert Rent *************************************/
                         if(renttype=="Fixed")
                         {
                             fixedduration="1 To ".duration;
                             fixedrent=$(".fixedrentshow").html();
                             var form_data3 = new FormData();
                              form_data3.append('rentduration',fixedduration);
                              form_data3.append('rent',fixedrent);
                              form_data3.append('agrrementno',agrrement_no);
                              form_data3.append('action',"add_rent");
                               $.ajax({
                                type:"POST",
                                url:"save_agreement.php",
                                data:form_data3,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success:function(response){
                                }
                             });
                         }
                         else if(renttype=="Variable")
                         {
                             $('.varrentshow li').each(function()
                            {
                              var rent=$(this).children('.varrent').html(); // This is your rel value
                              var dura= $(this).children('.dura').html();
                              var form_data3 = new FormData();
                              form_data3.append('rentduration',dura);
                              form_data3.append('rent',rent);
                              form_data3.append('agrrementno',agrrement_no);
                              form_data3.append('action',"add_rent");
                               $.ajax({
                                type:"POST",
                                url:"save_agreement.php",
                                data:form_data3,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success:function(response){
                                }
                             });
                            });
                         }
                         /********************** Insert Fitment Details *************************************/
                         fan=$(".fanshow").html();
                         ele_geezer=$(".elegeezershow").html();
                         tubelight=$(".tbelightshow").html();
                         ges_geezer=$(".gasgeezershow").html();
                         bulb=$(".bulbshow").html();
                         cooler=$(".coolershow").html();
                         bed=$(".bedshow").html();
                         watercooler=$(".watercoolershow").html();
                         sofa=$(".sofashow").html();
                         curtain=$(".curtainsshow").html();
                         table=$(".tableshow").html();
                         vdo=$(".VDOshow").html();
                         chair=$(".chairshow").html();
                         purifier=$(".purifiershow").html();
                         cupboard=$(".cupboardshow").html();
                         kitchen=$(".kitchenshow").html();
                         ac=$(".acshow").html();
                         other=$(".othershow").html();
                         var form_data4 = new FormData();
                              form_data4.append('fan',fan);
                              form_data4.append('ele_geezer',ele_geezer);
                              form_data4.append('tubelight',tubelight);
                              form_data4.append('ges_geezer',ges_geezer);
                              form_data4.append('bulb',bulb);
                              form_data4.append('cooler',cooler);
                              form_data4.append('bed',bed);
                              form_data4.append('watercooler',watercooler);
                              form_data4.append('sofa',sofa);
                              form_data4.append('curtain',curtain);
                              form_data4.append('table',table);
                              form_data4.append('vdo',vdo);
                              form_data4.append('chair',chair);
                              form_data4.append('cupboard',cupboard);
                              form_data4.append('kitchen',kitchen);
                              form_data4.append('ac',ac);
                              form_data4.append('other',other);
                              form_data4.append('purifier',purifier);
                              form_data4.append('agrrementno',agrrement_no);
                              form_data4.append('action',"add_fitment");
                               $.ajax({
                                type:"POST",
                                url:"save_agreement.php",
                                data:form_data4,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success:function(response){
                                }
                         });
                        
                      setTimeout(function(){ window.location=siteurl+"agreement/bookappointment.php?agr="+agrrement_no }, 3000);
                  }
                }
             });
        }
        else   
        {
             $('.msgs').fadeIn();
                $('.msgs').removeClass('alert alert-success');
                $('.msgs').addClass('alert alert-danger');
                $('.msgs').html('All Required Details Not Getting.. Please Correct All Data');
                $('.msgs').delay(5000).fadeOut();
        }
    }
    function calculatechrges()
    {
         renttype =  $(".renttype:checked").val();
         durationval=$(".duration").val();
         depositeval=$(".deposite").val();
        if(durationval.length!="0"&&depositeval.length!="0")
        {
         if(renttype=="Variable")
         {
            var cntchk= $('.vartable tr:last').attr("data-id");
            lastmonth=$("#monthto1"+cntchk).val();
            flag=0;
            for(i=1;i< parseInt(cntchk);i++)
            {
                cntrv=parseInt(i)+1;
               rentvar="";
              if(i=="1")
              {
                  rentvar=$("#varrent1").val();
              }
              else
              {
                  rentvar=$("#varrent1"+cntrv).val();    
              }
              if(rentvar.length=="0")
              {
                  flag=1;
              }
            }
            if(durationval!=lastmonth)
            {
                $('.msgs').fadeIn();
                $('.msgs').removeClass('alert alert-success');
                $('.msgs').addClass('alert alert-danger');
                $('.msgs').html('Duration and Last month not matching..Please complete till last month');
                $('.msgs').delay(5000).fadeOut();
            }
            else if(flag=="1")
            {
                    $('.msgs').fadeIn();
                    $('.msgs').removeClass('alert alert-success');
                    $('.msgs').addClass('alert alert-danger');
                    $('.msgs').html('Please Enter Rent For All Span');
                    $('.msgs').delay(5000).fadeOut();
            }
            else
            {
                 $(".calcbtn").attr("disabled",true)
                $(".vartable input").attr("disabled",true)
                $(".calc").show();
                calculatevar('duration','deposite','varrentshow','varrentdetails1','varrent','dura')
            }
         }
         else
         {
              fixedrentval=$(".fixedrent").val();
              if(fixedrentval.length!="0")
              {
                   $(".calcbtn").attr("disabled",true)
                      $(".calc").show();
                     calculatefixed('fixedrent','duration','deposite')
              }
              else
              {
                     $('.msgs').fadeIn();
                    $('.msgs').removeClass('alert alert-success');
                    $('.msgs').addClass('alert alert-danger');
                    $('.msgs').html('Rent Not Be Blank');
                    $('.msgs').delay(5000).fadeOut();
              }
         }
       }
       else
       {
          $('.msgs').fadeIn();
            $('.msgs').removeClass('alert alert-success');
            $('.msgs').addClass('alert alert-danger');
            $('.msgs').html('Duration and Deposite Not Be Blank');
            $('.msgs').delay(5000).fadeOut();
       }
        /*onblur="calculatefixed('fixedrent','duration','deposite')"  */
        /* func="calculatevar('duration','deposite','varrentshow','varrentdetails1','varrent','dura')"; */
    }