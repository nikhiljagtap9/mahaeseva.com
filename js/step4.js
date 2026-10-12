 $(function(){
    $("input#startdate").datetimepicker({
        format: 'DD-MM-YYYY',
    }).on('dp.change', function(ev){
        startdate = $(this).val(); duration = $("#duration").val();
        if(duration==""){
            $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Please Select Duration First').delay(5000).fadeOut();
            $("#startdate").val(""); $(".startdateshow").html("");
        } else{
            $(".startdateshow").html(startdate);
            info = { startdate:startdate, duration:duration };
            $.ajax({
                type: "POST", url: "getduration1.php", data:info,
                success: function(response){ $(".enddateshow").html(response); }
            });
        }
    });
});
function changedate(duration,startdate){
    startdateval = $("."+startdate).val(); durationval = $("."+duration).val();
    if(startdateval!=""){
        info = { startdate:startdateval, duration:durationval };
        $.ajax({
            type: "POST", url: "getduration1.php", data:info,
            success: function(response){ $(".enddateshow").html(response); }
        });
    }
}
function checkabovedata(){
    var duration = $("#duration").val(); start = $("#startdate").val(); deposite = $("#deposite").val();
    if(deposite==""||start==""||duration==""){
        $(".fixedrent").val("");
        $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Please Enter Duration, Start Date, deposite to proceed next').delay(5000).fadeOut();
    }
}
function showrent(fixedrent,fixddiv,variablerent,variablediv){
    var duration = $("#duration").val(); start = $("#startdate").val(); deposite = $("#deposite").val();
    if(deposite==""||start==""||duration==""){
        $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Please Enter Duration, Start Date, deposite to proceed next').delay(5000).fadeOut();
    } else{
        $("."+fixedrent+",."+fixddiv).show(); $("."+variablerent+",."+variablediv).hide(); $(".fixedrent").val(""); $(".fixedrentshow").html(""); $(".stamp").val("");
        resetvartab('vartable','monthto1','varrent1','varrentshow','varrentshow1','varrentmonthshow1');
    }
}
function addtr(currinp,preinp,rowclass,tableclass,liclass,lispan2,rent){
    var currval = $("."+currinp).val(); var preval = $("."+preinp).val(); var rentval = $("."+rent).val();
    var rowclassid = $("."+rowclass).attr("data-id"); var rowid = $("."+rowclass).attr("id"); var duration = $("#duration").val(); var incr = parseInt(rowclassid)+1; var nextinpval = parseInt(currval)+1;
    $("."+rent).attr("disabled",false);
    if(rowid=="current"){
        if(duration==""){
            $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Please Enter Duration First').delay(5000).fadeOut();
            $("."+currinp).val("");
        } else if(currval.length=="0"){
            $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Please Enter Month').delay(5000).fadeOut();
        } else if(parseInt(preval) > parseInt(currval)||parseInt(duration) < parseInt(currval)){
            $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Please Enter valid month').delay(5000).fadeOut();
            $("."+currinp).val("");
        } else{
            if(duration==currval){
                var minus = incr-1;
                $("."+lispan2).html(preval+" To "+currval);
                var nmfunc21 = "numbercheck('varrent1"+minus+"')";
                var other21 = "othershowvalinput('varrent1"+minus+"','varrentshow1"+minus+"')";
            } else{
                if(rowclassid=="1"){ $(".varrow1").removeAttr("id"); }
                else{ $(".varrow1"+rowclassid).removeAttr("id"); }
                $("."+lispan2).html(preval+" To "+currval);
                var nmfunc1 = "numbercheck('monthfrom1"+incr+"')";
                var nmfunc2 = "numbercheck('monthto1"+incr+"')";
                var nmfunc3 = "numbercheck('varrent1"+incr+"')";
                var other3 = "othershowvalinput('varrent1"+incr+"','varrentshow1"+incr+"')";
                chkfunc="chkprev('monthto1"+incr+"','varrent1"+incr+"','varrentshow1"+incr+"')";
                var aadtr = "addtr('monthto1"+incr+"','monthfrom1"+incr+"','varrow1"+incr+"','vartable','varrentdetails1"+incr+"','varrentmonthshow1"+incr+"','varrent1"+incr+"')";
                str = '<tr class="varrow1'+incr+'" data-id="'+incr+'" id="current"> '+
                '<td><input type="text" name="monthfrom1'+incr+'" class="form-control monthfrom1'+incr+'" id="monthfrom1'+incr+'" onkeyup="'+nmfunc1+'" maxlength="1" disabled value="'+nextinpval+'"/>  </td>'+
                '<td><input type="text" name="monthto1'+incr+'" class="form-control monthto1'+incr+'" id="monthto1'+incr+'" onkeyup="'+nmfunc2+'" onblur="'+aadtr+'" maxlength="2"/></td>'+
                '<td><input type="text" name="varrent1'+incr+'" class="form-control varrent1'+incr+'" id="varrent1'+incr+'" onkeyup="'+nmfunc3+';'+chkfunc+';'+other3+';" maxlength="6"/></td>'+
                '</tr>';
                str1 ='<li class="varrentdetails1'+incr+'">'+
                ' Rs. <span class="text-bold varrent varrentshow1'+incr+'"></span> /- per month for the  <span class="text-bold dura varrentmonthshow1'+incr+'"></span> months  '+
                '</li>';
                $(".varrentshow").append(str1);
                $("."+tableclass+" tbody").append(str);
            }
        }
    } else{
        from1 = $("#monthfrom1"+incr).val(); var less = parseInt(from1)-1;
        if(currval!=less){
            $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Only '+less+" is valid for this place").delay(5000).fadeOut();
            $("."+currinp).val(less);
        }
    }
}
function safeFloat(value)
{
    value = parseFloat(value);
    return isNaN(value) ? 0 : value;
}
function chkprev(monthto1,currval,showclass){
    var duration = $("#duration").val();
    toval = $("#"+monthto1).val();
    if(toval==""){
        $("."+currval).val(""); $("."+monthto1).focus();
        $(".msgs").removeClass("alert alert-success").addClass("alert alert-danger").fadeIn().html("Please select rent duration months").delay(5000).fadeOut();
    } else if(duration==toval){ }
}
function disableinp(inp){ $("."+inp).attr("disabled",true); }
function resetvartab(vartable,inpto,inprent,showclassol,span1,span2){
    $("."+vartable+" tr:not(:first-child)").remove(); $("."+showclassol+" li:not(:first-child)").remove(); $("."+inpto+",."+inprent).val(""); $("#regfee,#stamp,#total").val(""); $("."+span1+",."+span2).html(""); $("."+inpto+",."+inprent).attr("disabled",false); $(".varrow1").attr("id","current"); $(".calc").hide(); $(".fixedrent").attr("disabled",false); $(".calcbtn").attr("disabled",false); $(".duration").attr("disabled",false); $(".deposite").attr("disabled",false); $(".renttype").attr("disabled",false);
}
function calculatefixed(fixedrent,duration,deposite){
    durationval = $("."+duration).val(); depositeval = $("."+deposite).val(); fixedrentval = $("."+fixedrent).val(); arealoc = $(".arealoc:checked").val();
    service = $(".service").val(); visit_charge = $("#visit_charge").val(); dhc = $("#dhc").val(); extravisit = $(".extravisit:checked").val(); policeintimation = $(".policeintimation:checked").val();
    if(extravisit==1){
        $(".xtravisitbox").show(); xtra_visit_charge=$(".xtra_visit_charge").val();
    }else{
        $(".xtravisitbox").hide(); xtra_visit_charge=0;
    }
    if(policeintimation==1){
        $(".policebox").show(); police_charge=$(".police_charge").val();
    }else{
        $(".policebox").hide(); police_charge=0;
    }
    if(durationval!=""&&depositeval!=""&&fixedrentval!=""){
        totalinamt= safeFloat(fixedrentval)* safeFloat(durationval);
        depo10=(safeFloat(depositeval)/100)*10;
        tax=safeFloat(totalinamt)+safeFloat(depo10);
        stamp= ((tax*0.25)/100).toFixed(2);
        totalchrgs= (safeFloat(stamp)+safeFloat(service)+safeFloat(arealoc)+safeFloat(visit_charge)+safeFloat(xtra_visit_charge)+safeFloat(police_charge)+safeFloat(dhc)).toFixed(2);
        $(".stamp").val(stamp); $(".regfee").val(arealoc); $(".total").val(totalchrgs); $("."+duration).attr("disabled",true); $("."+deposite).attr("disabled",true); $("."+fixedrent).attr("disabled",true); $(".renttype").attr("disabled",true);
    }
}
function calculatevar(duration,deposite,olclass,liclass,spanrent,spandura){
    finalval = 0; durationval = $("."+duration).val(); depositeval = $("."+deposite).val(); arealoc = $(".arealoc:checked").val(); service = $(".service").val(); visit_charge = $("#visit_charge").val(); dhc = $("#dhc").val();  extravisit = $(".extravisit:checked").val(); policeintimation = $(".policeintimation:checked").val();
    if(extravisit==1){
        $(".xtravisitbox").show(); xtra_visit_charge = $(".xtra_visit_charge").val();
    }else{
        $(".xtravisitbox").hide(); xtra_visit_charge = 0;
    }
    if(policeintimation==1){
        $(".policebox").show(); police_charge = $(".police_charge").val();
    } else{
        $(".policebox").hide();  police_charge = 0;
    }
    $('.'+olclass+' li').each(function(){
        duracnt = 0;
        var rent = $(this).children('.'+spanrent).html(); var dura = $(this).children('.'+spandura).html(); var res = dura.split(" To "); startfrom = res[0].trim();
        endon = res[1].trim(); dura = parseInt(endon)-(parseInt(startfrom)-1); finalval = parseInt(finalval)+(parseInt(rent)*parseInt(dura));
    });
    totalinamt = finalval;
    depo10=(safeFloat(depositeval)/100)*10;
    tax=safeFloat(totalinamt)+safeFloat(depo10);
    stamp= ((tax*0.25)/100).toFixed(2);
    totalchrgs= (safeFloat(stamp)+safeFloat(service)+safeFloat(arealoc)+safeFloat(visit_charge)+safeFloat(xtra_visit_charge)+safeFloat(police_charge)+safeFloat(dhc)).toFixed(2);
    $(".stamp").val(stamp); $(".regfee").val(arealoc); $(".total").val(totalchrgs); $("."+duration).attr("disabled",true); $("."+deposite).attr("disabled",true); $(".renttype").attr("disabled",true);
}
function roundUp(value){ return (~~((value + 99) / 100) * 100); }
function previousstep3(Step3,Step2,pill3,pill2){
    $("#"+Step3).removeClass("in active"); $("#"+Step2).addClass("in active"); $("."+pill3).removeClass("active"); $("."+pill2).addClass("active");
}
function finalproceedold(siteurl){
    duration = $(".duration").val(); renttype = $(".renttype:checked").val(); start = $(".startdate").val(); end = $(".enddateshow").html(); deposite = $(".deposite").val(); regfee = $(".regfee").val();
    stamp = $(".stamp").val(); service = $(".service").val(); visit_charge = $("#visit_charge").val(); dhc = $("#dhc").val(); extravisit = $(".extravisit:checked").val(); policeintimation = $(".policeintimation:checked").val();
    xtra_visit_charge = $(".xtra_visit_charge").val(); police_charge = $(".police_charge").val(); total = $(".total").val(); misc = $(".misc").val(); entryby = $(".entryby").val();
    if(duration!=""&&start!=""&&deposite!=""&&regfee!=""&&service!=""&&total!=""){
        $(".submit,.prev3,.resetbtn").attr("disabled",true); /* $(".submit").append(" "+loadimg); */ arealoc = $(".arealoc:checked").val(); propertytype = $(".propertytype option:selected").val(); propertyarea = $(".builtarea").val(); galleryarea = $(".gallery").val(); parkingarea = $(".parking").val(); propertyuse = $(".propertyuse option:selected").val(); buildingname = $(".buildingname").val(); flatno = $(".flat").val(); floorno = $(".floor").val(); road = $(".road").val(); locality = $(".locality").val(); propno = $(".propno").val(); village = $(".village").val(); tahsil = $(".tahsil").val(); dist = $(".dist").val(); proppin = $(".proppin").val(); content = $(".agricontent").html(); var form_data = new FormData();
        form_data.append('arealoc',arealoc); form_data.append('propertytype',propertytype); form_data.append('propertyarea',propertyarea); form_data.append('galleryarea',galleryarea); form_data.append('parkingarea',parkingarea); form_data.append('propertyuse',propertyuse); form_data.append('buildingname',buildingname); form_data.append('flatno',flatno); form_data.append('floorno',floorno); form_data.append('road',road); form_data.append('locality',locality); form_data.append('propno',propno); form_data.append('village',village); form_data.append('tahsil',tahsil); form_data.append('dist',dist);
        form_data.append('proppin',proppin); form_data.append('content',content); form_data.append('entry_by',entryby); form_data.append('duration',duration); form_data.append('renttype',renttype); form_data.append('start',start); form_data.append('end',end);
        form_data.append('deposite',deposite); form_data.append('regfee',regfee); form_data.append('service',service); form_data.append('visit_charge',visit_charge); form_data.append('dhc',dhc); form_data.append('extravisit',extravisit); form_data.append('policeintimation',policeintimation);
        form_data.append('xtra_visit_charge',xtra_visit_charge); form_data.append('police_charge',police_charge);
        form_data.append('stamp',stamp); form_data.append('total',total); form_data.append('misc',misc); form_data.append('action',"addbasic");
        $.ajax({
            type:"POST", url:"save_agreement.php", data:form_data, cache: false, contentType: false, processData: false,
            success:function(response){
                if(response==0){
                    $(".submit,.prev3").attr("disabled",false);
                    $(".submit img").remove();
                    $(".msg").fadeIn().html("Error While Lead Creation").addClass("alert alert-danger").delay(5000).fadeOut();
                } else{
                    agrrement_no = response;
                    /************* insert landlord ******************************/
                    $('.landlord').each(function(){
                        var name = $(this).children('.name').html(); var gender = $(this).children('.gender').html(); 
                        var dob=$(this).children('.dob').html(); var age = $(this).children('.age').html(); var occupation = $(this).children('.occupation').html(); var mobile = $(this).children('.mobile').html(); var pan = $(this).children('.pan').html(); var email = $(this).children('.email').html(); var aadhaar = $(this).children('.aadhaar').html(); var address = $(this).children('.address').html(); var pincode = $(this).children('.pincode').html(); var form_data1 = new FormData();
                        form_data1.append('name',name);
                        form_data1.append('gender',gender);
                        form_data1.append('dob',dob);
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
                            type:"POST", url:"save_agreement.php", data:form_data1, cache: false, contentType: false, processData: false, success:function(response){ }
                        });
                    });
                    /********************** Insert Tenent *************************************/
                    $('.tenent').each(function(){
                        var name = $(this).children('.name').html(); var gender = $(this).children('.gender').html(); 
                        var dob=$(this).children('.dob').html(); var age = $(this).children('.age').html(); var occupation = $(this).children('.occupation').html(); var mobile = $(this).children('.mobile').html(); var pan = $(this).children('.pan').html(); var email = $(this).children('.email').html(); var aadhaar = $(this).children('.aadhaar').html(); var address = $(this).children('.address').html(); var pincode = $(this).children('.pincode').html(); var form_data2 = new FormData();
                        form_data2.append('name',name); form_data2.append('gender',gender); form_data2.append('dob',dob); form_data2.append('age',age); form_data2.append('occupation',occupation); form_data2.append('mobile',mobile); form_data2.append('pan',pan); form_data2.append('aadhaar',aadhaar); form_data2.append('email',email); form_data2.append('address',address); form_data2.append('pincode',pincode); form_data2.append('action',"add_tenent"); form_data2.append('agrrementno',agrrement_no);
                        $.ajax({
                            type:"POST", url:"save_agreement.php", data:form_data2, cache: false, contentType: false, processData: false, success:function(response){ }
                        });
                    });
                    /********************** Insert Rent *************************************/
                    if(renttype=="Fixed"){
                        fixedduration = "1 To ".duration; fixedrent = $(".fixedrentshow").html();
                        var form_data3 = new FormData();
                        form_data3.append('rentduration',fixedduration);
                        form_data3.append('rent',fixedrent);
                        form_data3.append('agrrementno',agrrement_no);
                        form_data3.append('action',"add_rent");
                        $.ajax({
                        type:"POST", url:"save_agreement.php", data:form_data3, cache: false, contentType: false, processData: false, success:function(response){ }
                        });
                    } else if(renttype=="Variable"){
                        $('.varrentshow li').each(function(){
                            var rent = $(this).children('.varrent').html(); var dura = $(this).children('.dura').html(); var form_data3 = new FormData();
                            form_data3.append('rentduration',dura); form_data3.append('rent',rent);
                            form_data3.append('agrrementno',agrrement_no);
                            form_data3.append('action',"add_rent");
                            $.ajax({
                                type:"POST", url:"save_agreement.php", data:form_data3, cache: false, contentType: false, processData: false,
                                success:function(response){ }
                            });
                        });
                    }
                    /********************** Insert Fitment Details *************************************/
                    fan = $(".fanshow").html(); ele_geezer = $(".elegeezershow").html(); tubelight = $(".tbelightshow").html(); ges_geezer = $(".gasgeezershow").html(); bulb = $(".bulbshow").html(); cooler = $(".coolershow").html(); bed = $(".bedshow").html();
                    watercooler = $(".watercoolershow").html(); sofa = $(".sofashow").html(); curtain = $(".curtainsshow").html(); table = $(".tableshow").html(); vdo = $(".VDOshow").html(); chair = $(".chairshow").html(); purifier = $(".purifiershow").html(); cupboard = $(".cupboardshow").html(); kitchen = $(".kitchenshow").html(); ac = $(".acshow").html();
                    other = $(".othershow").html(); var form_data4 = new FormData();
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
                        type:"POST", url:"save_agreement.php", data:form_data4, cache: false, contentType: false, processData: false,
                        success:function(response){ }
                    });
                    setTimeout(function(){ window.location = siteurl+"/appointment/"+agrrement_no }, 3000);
                }
            }
        });
    } else{
        $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('All Required Details Not Getting.. Please Correct All Data').delay(3000).fadeOut();
    }
}
function calculatechrges(){
    renttype =  $(".renttype:checked").val(); durationval = $(".duration").val(); depositeval = $(".deposite").val();
    if(durationval.length!="0"&&depositeval.length!="0"){
        if(renttype=="Variable"){
            var cntchk= $('.vartable tr:last').attr("data-id");
            lastmonth = $("#monthto1"+cntchk).val();
            flag = 0;
            for(i=1;i< parseInt(cntchk);i++){
                cntrv = parseInt(i)+1; rentvar = "";
                if(i=="1"){ rentvar = $("#varrent1").val(); }
                else{ rentvar = $("#varrent1"+cntrv).val(); }
                if(rentvar.length=="0"){ flag = 1; }
            }
            if(durationval!=lastmonth){
                $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Duration and Last month not matching..Please complete till last month').delay(3000).fadeOut();
            } else if(flag=="1"){
                $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Please Enter Rent For All Span').delay(3000).fadeOut();
            } else{
                $(".calcbtn").attr("disabled",true); $(".vartable input").attr("disabled",true);
                $(".calc").show(); calculatevar('duration','deposite','varrentshow','varrentdetails1','varrent','dura');
            }
        } else{
            fixedrentval = $(".fixedrent").val();
            if(fixedrentval.length!="0"){
                $(".calcbtn").attr("disabled",true); $(".calc").show();
                calculatefixed('fixedrent','duration','deposite');
            } else{
                $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Rent Not Be Blank').delay(3000).fadeOut();
            }

        }
    } else{
        $('.msgs').fadeIn().removeClass('alert alert-success').addClass('alert alert-danger').html('Duration and Deposite Not Be Blank').delay(3000).fadeOut();
    }
}

function nextstep45(Step4,Step5,pill4,pill5)
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
          $("#"+Step4).removeClass("show active");
          $("#"+Step5).addClass("show active");
          $("."+pill4).removeClass("active");
          $("."+pill5).addClass("active");

          // changes for additional services
          $('#licencedata').addClass("d-none");
          $("#licenceform").removeClass("col-md-5").addClass("col-lg-12");
          $(".reg_fee").text(regfee);$(".stamp_duty").text(stamp);$(".service_charges").text(service);$(".visit_charges").text(visit_charge);
          $(".dhc_charges").text(dhc);$(".police_charges").text(police_charge);$(".total_charges").text(total);
          
      }
      else   
      {
          $('.msgs').fadeIn();
          $('.msgs').removeClass('alert alert-success');
          $('.msgs').addClass('alert alert-danger');
          $('.msgs').html('Please Fill All Required Details');
          $('.msgs').delay(5000).fadeOut();
      }
    }