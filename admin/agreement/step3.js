function previousstep2(Step3,Step2,pill3,pill2)
{
    $("#"+Step3).removeClass("show active");
    $("#"+Step2).addClass("show active");

    $("."+pill3).removeClass("active");
    $("."+pill2).addClass("active");
}

function nextstep34(Step3,Step4,pill3,pill4)
{
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

     if(arealoc==""||propertytype==""||propertyarea==""||propertyuse==""||buildingname==""||flatno==""||road==""||locality==""||village==""||tahsil==""||dist=="")
         {
               $('.msgs').fadeIn();
               $('.msgs').removeClass('alert alert-success');
                $('.msgs').addClass('alert alert-danger');
                $('.msgs').html('Please Fill All Required Details');
                $('.msgs').delay(5000).fadeOut();
                flag=0;
         }
         else
         {
               $("#"+Step3).removeClass("show active");
                 $("#"+Step4).addClass("show active");
                 $("."+pill3).removeClass("active");
                 $("."+pill4).addClass("active");
         }


}