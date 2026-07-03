function previousstepn(Stepn,Step2,pilln,pill2)
{   listitem=$(".vitnesslist").html().trim();
    $("#"+Stepn).removeClass("show active");
    $("#"+Step2).addClass("show active");

    $("."+pilln).removeClass("active");
    $("."+pill2).addClass("active");
    
    
    /*
    vitnessname =  $(".v_name").val(); 
   vitnesslname =  $(".v_lname").val();
   vitnessemail =  $(".v_emailid").val();  
   vitnessmobile =  $(".v_mobno").val();    
    vitnessadress =  $(".vitnessaddr").val();
    
    
    if(vitnessname == "" && vitnesslname =="" && vitnessemail == ""  && vitnessmobile == "" && vitnessadress == ""  && listitem=="")
    {
       //$(".vitnessdetailsinlicence").hide();
       $(".current").remove();
    }
*/
}

function nextstep34n(Step3,Step4,pill3,pill4)
{

$("#"+Step3).removeClass("show active");
                 $("#"+Step4).addClass("show active");
                 $("."+pill3).removeClass("active");
                 $("."+pill4).addClass("active");

}


function addnewvitness(){
if($(".vitnessform").css('display') == 'none')
        {   
$(".vitnessform").show();
  var str= '<li class="vitness_s current"> ' +
        'Name : <span class="vitness_name text-bold"></span> <span class="vitness_lname text-bold"></span>  <br>'+
        'Mobile : <span class="vitness_mbl text-bold"></span>  <br>'+
        'Adress : <span class="vitness_address text-bold"></span><br>'+
        'Email : <span class="vitness_email text-bold"></span>'+
                           '</li> ';      
    $(".vitnessdetailsinlicence").append(str);   
    $(".v_name").val(""); 
    $(".v_lname").val("");
    $(".v_emailid").val("");  
    $(".v_mobno").val("");   
    $(".vitnessaddr").val("");
    
        }
        else {
           
   vitnessname =  $(".v_name").val(); 
   vitnesslname =  $(".v_lname").val();
   vitnessemail =  $(".v_emailid").val();  
   vitnessmobile =  $(".v_mobno").val();    
    vitnessadress =  $(".vitnessaddr").val();   
    if(vitnessname == "" && vitnesslname =="" && vitnessemail == ""  && vitnessmobile == "" && vitnessadress == ""){
      $('.msgs').fadeIn();
                           $('.msgs').removeClass('alert alert-success');
                          $('.msgs').addClass('alert alert-danger');
                          $('.msgs').html('Please Fill  Details');
                          $('.msgs').delay(5000).fadeOut();   
    }
    else {
     var nemclas=vitnessname.replace(/\s/g, '');
    
                    funxc="removevitness('"+nemclas+"','vitness_s"+nemclas+"')";
                    editfunct="editvitness('"+nemclas+"','vitnessform','editvitnessdetails','addnewbtnn','newxt23btnn')";
                    newstr='<div class="mb-2 form-group border rounded d-flex justify-content-between align-items-center pl-3 vitness_s'+nemclas+'"><div class="name">'+vitnessname+'</div><div><button type="button" class="btn btn-link border-left border-right rounded-0" onclick="'+editfunct+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button type="button" class="btn btn-link removebtn" onclick="'+funxc+'"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button></div></div>';
                    $(".vitnesslist").append(newstr);
                    $(".current").addClass(nemclas);
                    $(".vitness_s").removeClass("current"); 
                      
        var str= '<li class="vitness_s current"> ' +
        'Name : <span class="vitness_name text-bold"></span> <span class="vitness_lname text-bold"></span>  <br>'+
        'Mobile : <span class="vitness_mbl text-bold"></span>  <br>'+
        'Adress : <span class="vitness_address text-bold"></span><br>'+
        'Email : <span class="vitness_email text-bold"></span>'+
                           '</li> ';
                    $("."+nemclas).after(str);
        $(".v_name").val(""); 
    $(".v_lname").val("");
    $(".v_emailid").val("");  
    $(".v_mobno").val("");   
    $(".vitnessaddr").val("");
    
        }

  }
        
}


function editvitness(getdetailsclass,hidediv,showdiv,btn1,btn2){
    $("."+hidediv+",."+btn1+",."+btn2).hide();
    $("."+showdiv).show();
    var name=$("."+getdetailsclass+" .vitness_name").html();
    var lastname=$("."+getdetailsclass+" .vitness_lname").html();
    var email=$("."+getdetailsclass+" .vitness_email").html();
    var mobile=$("."+getdetailsclass+" .vitness_mbl").html();
     var adress=$("."+getdetailsclass+" .vitness_address").html();
     
      $(".updateclassnamev").val(getdetailsclass);
    $(".editvitnessname").val(name);
     $(".editvitnesslastname").val(lastname);
      $(".editvitnessemail").val(email);
       $(".editvitnessmbl").val(mobile);
        $(".editvitnessadress").val(adress);
}


function updatevitness(show1,show2){
    updateclassnamev=$(".updateclassnamev").val();
    editvitnessname = $(".editvitnessname").val();
    editvitnesslastname = $(".editvitnesslastname").val();
    editvitnessemail = $(".editvitnessemail").val();
    editvitnessmbl = $(".editvitnessmbl").val();
    editvitnessadress = $(".editvitnessadress").val(); 
    
    
    $("."+updateclassnamev+" .vitness_name").html(editvitnessname);
    $("."+updateclassnamev+" .vitness_lname").html(editvitnesslastname);
    $("."+updateclassnamev+" .vitness_email").html(editvitnessemail);
    $("."+updateclassnamev+" .vitness_mbl").html(editvitnessmbl);
    $("."+updateclassnamev+" .vitness_address").html(editvitnessadress);
    
    $(".vitness_s"+updateclassnamev+" .vitness_name").html(editvitnessname);
                $(".editvitnessdetails").hide();
                $("."+show1+",."+show2).show();
                  $(".current").remove();
   
}



 function cencelupdatevitness(hideclass,show1,show2)
         {
             $("."+hideclass).hide();
             $("."+show1+",."+show2).show();
         }

function removevitness(detailclass,listclass)
 {
     if(confirm("Are you sure to delete?"))
     {
         $("."+detailclass).remove();
         $("."+listclass).remove();
     }
 }