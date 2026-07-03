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
    // total=$(".total").val();
     total = $(".total_charges").text();
     misc=$(".misc").val();
     entryby=$("#uid").val();
     tokenno=$(".tokenno").val();
     extravisit=$(".extravisit:checked").val();
     policeintimation=$(".policeintimation:checked").val();
     xtra_visit_charge=$(".extra_visit_charges").text();
     police_charge=$(".police_initimation_charges").text();

     // Add for extra service abd party type 
     partytype=$(".partytype").val();
     if(xtra_visit_charge != 0 && partytype == '')   
     {
         $('.msgs').fadeIn();
         $('.msgs').removeClass('alert alert-success');
         $('.msgs').addClass('alert alert-danger');
         $('.msgs').html('Please Select the Party for extra visit');
         $('.msgs').delay(5000).fadeOut();
         return;
     }
     // Add for extra service abd party type 

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
          form_data.append('partytype',partytype);
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
                      var dob=$(this).children('.dob').html();
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
                      var dob=$(this).children('.dob').html();
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
                          form_data2.append('dob',dob);
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

$("input[name='biometric']").change(function(){
    $(".biometric .package-card").removeClass("selected-package");
    if ($("#different_place").is(":checked")) {
        $(".biometric .package-card").removeClass("blurred"); // Remove blur when different_place is selected
        $(".biometric .partytype").removeClass("blurred"); // Remove Blur when same_place is selected
        $(".biometric .partytype").removeAttr("required"); // Remove required when different_place is selected
    } else {
       $("#packageSelect").val(""); // Reset selection
       $(".extra_visit_charges").text(0);
       $(".biometric .package-card").addClass("blurred"); // Blur packages when same_place is selected
       $(".biometric .package-check").prop("checked", false); // Uncheck all checkboxes 
       $(".biometric .partytype").addClass("blurred"); // Blur parties when same_place is selected
    }
});

// Package card selection
$(".biometric .package-card").click(function(){

    var reg_fee = parseInt($(".reg_fee").text());
    var stamp_duty = parseInt($(".stamp_duty").text());
    var service_charges = parseInt($(".service_charges").text());
    var visit_charges = parseInt($(".visit_charges").text());
    var dhc_charges = parseInt($(".dhc_charges").text());
    var police_charges = 0;//parseInt($("#police_charges").text());

    // Remove selection from all packages
    $(".biometric .package-card").removeClass("selected-package");
    $(".biometric .package-check").prop("checked", false); // Uncheck all checkboxes

    // Add selection to the clicked package
    $(this).addClass("selected-package");
    $(this).find(".package-check").prop("checked", true); // Check the checkbox

    // Update hidden input
    var selectedValue = $(this).data("value");
    $("#packageSelect").val(selectedValue);
    

    if(selectedValue !== "custom") {
      //  $("#extraVisit").removeClass("d-none");
        $("#visitCost").text(selectedValue);
        $(".extra_visit_charges").text(selectedValue);
        
        var total_charges =  reg_fee + stamp_duty + service_charges + visit_charges +  dhc_charges + police_charges + parseInt(selectedValue);
        console.log("total_charges" + total_charges);
        $(".total_charges").text(total_charges);
        
    } else {
       // $("#extraVisit").addClass("d-none");
        selectedValue = 0;
        $(".extra_visit_charges").text(selectedValue);
        var total_charges =  reg_fee + stamp_duty + service_charges + visit_charges +  dhc_charges + police_charges + parseInt(selectedValue);
        $(".total_charges").text(total_charges);
    }
});

 // Function to show/hide sections based on checkboxes
 function toggleSections() {
    
    if ($("#policeintimation").is(":checked")) {
        $(".policeblock").css('display','block');
    } else {
        $(".policeblock").css('display','none');
    }

    if ($("#extravisit").is(":checked")) {
        $(".biometric").css('display','block');
    } else {
        $(".biometric").css('display','none');
    }
}

// Initial check on page load
toggleSections();

// Attach change event listeners
$("#policeintimation, #extravisit").change(toggleSections);

// checkbox click
/*$(".package-check").click(function (event) {
    event.stopPropagation(); // Prevent triggering the card click event
}); */
 
// for Toggle
$(".toggle-header").click(function () {
    $(this).next(".toggle-content").slideToggle(); // Toggle content
    $(this).find(".toggle-icon").toggleClass("fa-plus fa-minus"); // Toggle icon
});

$(".toggle-content").hide(); // Hide content by default

