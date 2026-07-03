    function addnewtenent()
    {
        if($(".tenentform").css('display') == 'none')
        {
                  $(".tenentform").show();
                    var str= '<li class="tenent current"> ' +
                           ' Name: <span class="name text-bold"></span>  <br> ' +
                           ' Gender : <span class="gender gendershow text-bold"></span> ' +
                           ' Age About: <span class="age text-bold"></span> Years, ' +
                           ' Occupation:<span class="occupation text-bold"></span>  <br> ' +
                           ' having Contact Number :<span class="mobile text-bold"></span> ' +
                           ' PAN:<span class="pan text-bold"></span> ' +
                           ' Aadhaar:<span class="aadhaar text-bold"></span>  ' +
                           ' Email-Id:<span class="email text-bold"></span>  <br>  ' +
                           ' Residing at:<span class="address text-bold"></span> ' +
                           ' Pincode: <span class="pincode text-bold"></span> ' +
                           '</li> ';
                    $(".tenentdetails").append(str);
                     $(".tenent1").val("");
                     $(".tenentgender").prop('selectedIndex', 0);
                     $(".tenent1age").val("");
                     $(".tenentoccupation").prop('selectedIndex', 0);
                     $(".tenent1contact").val("");
                     $(".tenent1pan").val("");
                     $(".tenent1addhar").val("");
                     $(".tenent1email").val("");
                     $(".tenent1addr").val("");
                     $(".tenent1pin").val("");
        }
        else
        {
                landlord1=$(".tenent1").val();
                 gender=$(".tenentgender option:selected").val();
                 landlord1age=$(".tenent1age").val();
                 occupation=$(".tenentoccupation option:selected").val();
                 landlord1contact=$(".tenent1contact").val();
                 landlord1pan=$(".tenent1pan").val();
                 landlord1addhar=$(".tenent1addhar").val();
                 landlord1email=$(".tenent1email").val();
                 landlord1addr=$(".tenent1addr").val();
                 landlord1pin=$(".tenent1pin").val();
                 if(landlord1==""||gender==""||landlord1age==""||occupation==""||landlord1contact==""||landlord1pan==""||landlord1addhar==""||landlord1addr==""||landlord1pin=="")
                 {
                          $('.msgs').fadeIn();
                           $('.msgs').removeClass('alert alert-success');
                          $('.msgs').addClass('alert alert-danger');
                          $('.msgs').html('Please Fill All Details');
                          $('.msgs').delay(5000).fadeOut();
                 }
                 else
                 {

                    var nemclas=landlord1.replace(/\s/g, '');
                    funxc="removetenent('"+nemclas+"','tenent"+nemclas+"')";
                    editfunct="edittenent('"+nemclas+"','tenentform','edittenentdetails','addnewbtn2','newxt23btn')";
                    newstr='<div class="mb-2 form-group border rounded d-flex justify-content-between align-items-center pl-3 tenent'+nemclas+'"><div class="name text-info">'+landlord1+'</div><div><button type="button" class="btn btn-link border-left border-right rounded-0" onclick="'+editfunct+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button type="button" class="btn btn-link removebtn" onclick="'+funxc+'"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button></div></div>';
                    $(".tenentlist").append(newstr);
                    $(".current").addClass(nemclas);
                    $(".tenent").removeClass("current");
                    var str= '<li class="tenent current"> ' +
                           ' Name: <span class="name text-bold"></span>  <br> ' +
                           ' Gender : <span class="gender gendershow text-bold"></span> ' +
                           ' Age About: <span class="age text-bold"></span> Years, ' +
                           ' Occupation:<span class="occupation text-bold"></span>  <br> ' +
                           ' having Contact Number :<span class="mobile text-bold"></span> ' +
                           ' PAN:<span class="pan text-bold"></span> ' +
                           ' Aadhaar:<span class="aadhaar text-bold"></span>  ' +
                           ' Email-Id:<span class="email text-bold"></span>  <br>  ' +
                           ' Residing at:<span class="address text-bold"></span> ' +
                           ' Pincode: <span class="pincode text-bold"></span> ' +
                           '</li> ';
                    $("."+nemclas).after(str);
                     $(".tenent1").val("");
                     $(".tenentgender").prop('selectedIndex', 0);
                     $(".tenent1age").val("");
                     $(".tenentoccupation").prop('selectedIndex', 0);
                     $(".tenent1contact").val("");
                     $(".tenent1pan").val("");
                     $(".tenent1addhar").val("");
                     $(".tenent1email").val("");
                     $(".tenent1addr").val("");
                     $(".tenent1pin").val("");
                 }
        }
    }

     function removetenent(detailclass,listclass)
     {
         if(confirm("Are you sure to delete?"))
         {
             $("."+detailclass).remove();
             $("."+listclass).remove();
         }
     }

    function previousstep1(Step2,Step1,pill2,pill1)
    {
         landlord1=$(".tenent1").val();
         gender=$(".tenentgender option:selected").val();
         landlord1age=$(".tenent1age").val();
         occupation=$(".tenentoccupation option:selected").val();
         landlord1contact=$(".tenent1contact").val();
         landlord1pan=$(".tenent1pan").val();
         landlord1addhar=$(".tenent1addhar").val();
         landlord1email=$(".tenent1email").val();
         landlord1addr=$(".tenent1addr").val();
         landlord1pin=$(".tenent1pin").val();
         if(landlord1==""&&gender==""&&landlord1age==""&&occupation==""&&landlord1contact==""&&landlord1pan==""&&landlord1addhar==""&&landlord1email==""&&landlord1addr==""&&landlord1pin=="")
         {
             $("#"+Step2).removeClass("show active");
             $("#"+Step1).addClass("show active");
              $(".tenent").removeClass("current");
              $("."+pill2).removeClass("active");
             $("."+pill1).addClass("active");
         }
         else
         {
               if(landlord1==""||gender==""||landlord1age==""||occupation==""||landlord1contact==""||landlord1pan==""||landlord1addhar==""||landlord1addr==""||landlord1pin=="")
                 {
                        $('.msgs').fadeIn();
                           $('.msgs').removeClass('alert alert-success');
                          $('.msgs').addClass('alert alert-danger');
                          $('.msgs').html('Please Fill All Details');
                          $('.msgs').delay(5000).fadeOut();
                       flag=0;
                 }
                 else
                 {
                        var nemclas=landlord1.replace(/\s/g, '');
                            funxc="removetenent('"+nemclas+"','tenent"+nemclas+"')";
                             editfunct="edittenent('"+nemclas+"','tenentform','edittenentdetails','addnewbtn2','newxt23btn')";
                             newstr='<div class="mb-2 form-group border rounded d-flex justify-content-between align-items-center pl-3 tenent'+nemclas+'"><div class="name">'+landlord1+'</div><div><button type="button" class="btn btn-link border-left border-right rounded-0" onclick="'+editfunct+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button type="button" class="btn btn-link removebtn" onclick="'+funxc+'"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button></div></div>';
                            $(".tenentlist").append(newstr);
                            $(".current").addClass(nemclas);
                            $(".tenent").removeClass("current");
                            var str= '<li class="tenent"> ' +
                                   ' Name: <span class="name text-bold"></span>  <br> ' +
                                   ' Gender : <span class="gender gendershow text-bold"></span> ' +
                                   ' Age About: <span class="age text-bold"></span> Years, ' +
                                   ' Occupation:<span class="occupation text-bold"></span>  <br> ' +
                                   ' having Contact Number :<span class="mobile text-bold"></span> ' +
                                   ' PAN:<span class="pan text-bold"></span> ' +
                                   ' Aadhaar:<span class="aadhaar text-bold"></span>  ' +
                                   ' Email-Id:<span class="email text-bold"></span>  <br>  ' +
                                   ' Residing at:<span class="address text-bold"></span> ' +
                                   ' Pincode: <span class="pincode text-bold"></span> ' +
                                   '</li> ';
                            $("."+nemclas).after(str);
                             $(".tenent1").val("");
                             $(".tenentgender").prop('selectedIndex', 0);
                             $(".tenent1age").val("");
                             $(".tenentoccupation").prop('selectedIndex', 0);
                             $(".tenent1contact").val("");
                             $(".tenent1pan").val("");
                             $(".tenent1addhar").val("");
                             $(".tenent1email").val("");
                             $(".tenent1addr").val("");
                             $(".tenent1pin").val("");

                             $("#"+Step2).removeClass("show active");
                             $("#"+Step1).addClass("show active");
                              $(".tenent").removeClass("current");
                              $("."+pill2).removeClass("active");
                             $("."+pill1).addClass("active");

                 }
         }
    }

    function nextstep23(hideclass,showclass,removecurrent,addcrrent,listclass,formclass,pillact,pillnew)
    {
      flag=0;
        landlord1=$(".tenent1").val();
         gender=$(".tenentgender option:selected").val();
         landlord1age=$(".tenent1age").val();
         occupation=$(".tenentoccupation option:selected").val();
         landlord1contact=$(".tenent1contact").val();
         landlord1pan=$(".tenent1pan").val();
         landlord1addhar=$(".tenent1addhar").val();
         landlord1email=$(".tenent1email").val();
         landlord1addr=$(".tenent1addr").val();
         landlord1pin=$(".tenent1pin").val();
         listitem=$("."+listclass).html().trim();
          if((landlord1==""&&gender==""&&landlord1age==""&&occupation==""&&landlord1contact==""&&landlord1pan==""&&landlord1addhar==""&&landlord1email==""&&landlord1addr==""&&landlord1pin=="")&&listitem!="")
         {
              flag=1;
              $(".tenent").removeClass("current");
         }
         else if((landlord1==""&&gender==""&&landlord1age==""&&occupation==""&&landlord1contact==""&&landlord1pan==""&&landlord1addhar==""&&landlord1email==""&&landlord1addr==""&&landlord1pin=="")&&listitem=="")
         {
               $('.msgs').fadeIn();
                       $('.msgs').removeClass('alert alert-success');
                      $('.msgs').addClass('alert alert-danger');
                      $('.msgs').html('Please Add Atleast One Tenent To Proceed Next');
                      $('.msgs').delay(5000).fadeOut();
              flag=0;
         }
         else
         {
             if(landlord1==""||gender==""||landlord1age==""||occupation==""||landlord1contact==""||landlord1pan==""||landlord1addhar==""||landlord1addr==""||landlord1pin=="")
             {
                    $('.msgs').fadeIn();
                       $('.msgs').removeClass('alert alert-success');
                      $('.msgs').addClass('alert alert-danger');
                      $('.msgs').html('Please Fill All Details');
                      $('.msgs').delay(5000).fadeOut();
                   flag=0;
             }
             else
             {
                     var nemclas=landlord1.replace(/\s/g, '');
                       funxc="removetenent('"+nemclas+"','tenent"+nemclas+"')";
                    editfunct="edittenent('"+nemclas+"','tenentform','edittenentdetails','addnewbtn2','newxt23btn')";
                    newstr='<div class="mb-2 form-group border rounded d-flex justify-content-between align-items-center pl-3 tenent'+nemclas+'"><div class="name">'+landlord1+'</div><div><button type="button" class="btn btn-link border-left border-right rounded-0" onclick="'+editfunct+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button type="button" class="btn btn-link removebtn" onclick="'+funxc+'"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button></div></div>';
                    $(".tenentlist").append(newstr);
                    $(".current").addClass(nemclas);
                    $(".tenent").removeClass("current");
                    //$("."+addcrrent).addClass("current");
                    $(".vitness_s").addClass("current");
                     flag=1;

             }
         }

         if(flag==1)
         {
            $("."+formclass).hide();
             $('.tenent').each(function()
             {
                var name=$(this).children('.name').html();
                if(name=="")
                {
                    $(this).remove();
                }
            })

            //$(".current").remove();
            $("#"+hideclass).removeClass("show active");
             $("#"+showclass).addClass("show active");
            $(".vitnessdetailsinlicence li:last-child").addClass("current");       //sneahl update       
              $("."+pillact).removeClass("active");
             $("."+pillnew).addClass("active");
               $(".tenent1").val("");
                 $(".tenentgender").prop('selectedIndex', 0);
                 $(".tenent1age").val("");
                 $(".tenentoccupation").prop('selectedIndex', 0);
                 $(".tenent1contact").val("");
                 $(".tenent1pan").val("");
                 $(".tenent1addhar").val("");
                 $(".tenent1email").val("");
                 $(".tenent1addr").val("");
                 $(".tenent1pin").val("");
         }
 }


  function edittenent(getdetailsclass,hidediv,showdiv,btn1,btn2)
         {

            $("."+hidediv+",."+btn1+",."+btn2).hide();
            $("."+showdiv).show();
            var name=$("."+getdetailsclass+" .name").html();
            var gender=$("."+getdetailsclass+" .gender").html();
            var age=$("."+getdetailsclass+" .age").html();
            var occupation=$("."+getdetailsclass+" .occupation").html();
            var mobile=$("."+getdetailsclass+" .mobile").html();
            var pan=$("."+getdetailsclass+" .pan").html();
             var aadhaar=$("."+getdetailsclass+" .aadhaar").html();
             var email=$("."+getdetailsclass+" .email").html();
             var address=$("."+getdetailsclass+" .address").html();
             var pincode=$("."+getdetailsclass+" .pincode").html();

             $(".updateclassname1").val(getdetailsclass);
             $(".edittenent1").val(name);
             $('.edittenentgender option[value="'+gender+'"]').attr("selected", "selected")

             $(".edittenent1age").val(age);
             $('.edittenentoccupation option[value="'+occupation+'"]').attr("selected", "selected");
             $(".edittenent1contact").val(mobile);
             $(".edittenent1pan").val(pan);
             $(".edittenent1addhar").val(aadhaar);
             $(".edittenent1email").val(email);
             $(".edittenent1addr").val(address);
             $(".edittenent1pin").val(pincode);
         }

        function updatetenent(show1,show2)
        {
            updateclassname1=$(".updateclassname1").val();
            edittenent1= $(".edittenent1").val();
            edittenentgender= $('.edittenentgender option:selected').val();

            edittenent1age= $(".edittenent1age").val();
            edittenentoccupation= $('.edittenentoccupation option:selected').val();
            edittenent1contacts= $(".edittenent1contact").val();
            edittenent1pan= $(".edittenent1pan").val();
            edittenent1addhar= $(".edittenent1addhar").val();
            edittenent1email= $(".edittenent1email").val();
            edittenent1addr= $(".edittenent1addr").val();
            edittenent1pins= $(".edittenent1pin").val();

            if(updateclassname1!="")
            {
                   $("."+updateclassname1+" .name").html(edittenent1);
                   $("."+updateclassname1+" .gender").html(edittenentgender);
                    $("."+updateclassname1+" .age").html(edittenent1age);
                    $("."+updateclassname1+" .occupation").html(edittenentoccupation);
                    $("."+updateclassname1+" .mobile").html(edittenent1contacts);
                    $("."+updateclassname1+" .pan").html(edittenent1pan);
                    $("."+updateclassname1+" .aadhaar").html(edittenent1addhar);
                    $("."+updateclassname1+" .email").html(edittenent1email);
                    $("."+updateclassname1+" .address").html(edittenent1addr);
                    $("."+updateclassname1+" .pincode").html(edittenent1pins);

                $(".tenent"+updateclassname1+" .name").html(edittenent1);
                $(".edittenentdetails").hide();
                $("."+show1+",."+show2).show();
                  $(".current").remove();
            }

        }

         function cencelupdatetenent(hideclass,show1,show2)
         {
             $("."+hideclass).hide();
             $("."+show1+",."+show2).show();
         }