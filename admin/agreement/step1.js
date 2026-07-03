  function addnewlandlord()
    {
     if($(".landlordform").css('display') == 'none')
     {
            $(".landlordform").show();
             var str= '<li class="landlord current"> ' +
                       ' Name: <span class="name text-bold"></span>  <br> ' +
                       ' Gender : <span class="gender gendershow text-bold"></span> ' +
                       ' <span class="dob text-bold"  style="display:none"></span> ' +
                       ' Age About: <span class="age text-bold"></span> Years, ' +
                       ' Occupation:<span class="occupation text-bold"></span>  <br> ' +
                       ' having Contact Number :<span class="mobile text-bold"></span> ' +
                       ' PAN:<span class="pan text-bold"></span> ' +
                       ' Aadhaar:<span class="aadhaar text-bold"></span>  ' +
                       ' Email-Id:<span class="email text-bold"></span>  <br>  ' +
                       ' Residing at:<span class="address text-bold"></span> ' +
                       ' Pincode: <span class="pincode text-bold"></span> ' +
                       '</li> ';
                $(".landlorddetails").append(str);
                 $(".landlord1").val("");
                 $(".gender").prop('selectedIndex', 0);
                 $(".landlord1dob").val("");
                 $(".landlord1age").val("");
                 $(".occupation").prop('selectedIndex', 0);
                 $(".landlord1contact").val("");
                 $(".landlord1pan").val("");
                 $(".landlord1addhar").val("");
                 $(".landlord1email").val("");
                 $(".landlord1addr").val("");
                 $(".landlord1pin").val("");
     }
     else
     {
             landlord1=$(".landlord1").val();
             gender=$(".gender option:selected").val();
             landlord1dob=$(".landlord1dob").val();
             landlord1age=$(".landlord1age").val();
             occupation=$(".occupation option:selected").val();
             landlord1contact=$(".landlord1contact").val();
             landlord1pan=$(".landlord1pan").val();
             landlord1addhar=$(".landlord1addhar").val();
             landlord1email=$(".landlord1email").val();
             landlord1addr=$(".landlord1addr").val();
             landlord1pin=$(".landlord1pin").val();
             if(landlord1==""||gender==""||landlord1dob==""||landlord1age==""||occupation==""||landlord1contact==""||landlord1pan==""||landlord1addhar==""||landlord1addr==""||landlord1pin=="")
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
                funxc="removelandlord('"+nemclas+"','landlord"+nemclas+"')";
                editfunct="editlandlord('"+nemclas+"','landlordform','editlandlordetails','addnewbtn1','newxt12btn')";
                newstr='<div class="mb-2 form-group border rounded d-flex justify-content-between align-items-center pl-3 landlord'+nemclas+'"><div class="name">'+landlord1+'</div><div><button type="button" class="btn btn-link border-left border-right rounded-0" onclick="'+editfunct+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button type="button" class="btn btn-link removebtn" onclick="'+funxc+'"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button></div></div>';
                $(".landlordlist").append(newstr);
                $(".current").addClass(nemclas);
                $(".landlord").removeClass("current");
                var str= '<li class="landlord current"> ' +
                       ' Name: <span class="name text-bold"></span>  <br> ' +
                       ' Gender : <span class="gender gendershow text-bold"></span> ' +
                       ' <span class="dob text-bold"  style="display:none"></span> ' +
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
                 $(".landlord1").val("");
                 $(".gender").prop('selectedIndex', 0);
                 $(".landlord1dob").val("");
                 $(".landlord1age").val("");
                 $(".occupation").prop('selectedIndex', 0);
                 $(".landlord1contact").val("");
                 $(".landlord1pan").val("");
                 $(".landlord1addhar").val("");
                 $(".landlord1email").val("");
                 $(".landlord1addr").val("");
                 $(".landlord1pin").val("");
            }
     }
 }
 function removelandlord(detailclass,listclass)
 {
     if(confirm("Are you sure to delete?"))
     {
         $("."+detailclass).remove();
         $("."+listclass).remove();
     }
 }
  function nextstep1(hideclass,showclass,removecurrent,addcrrent,listclass,formclass,pillact,pillnew)
 {
      flag=0;
       landlord1=$(".landlord1").val();
         gender=$(".gender option:selected").val();
         landlord1dob=$(".landlord1dob").val();
         landlord1age=$(".landlord1age").val();
         occupation=$(".occupation option:selected").val();
         landlord1contact=$(".landlord1contact").val();
         landlord1pan=$(".landlord1pan").val();
         landlord1addhar=$(".landlord1addhar").val();
         landlord1email=$(".landlord1email").val();
         landlord1addr=$(".landlord1addr").val();
         landlord1pin=$(".landlord1pin").val();
         listitem=$("."+listclass).html().trim();
          if((landlord1==""&&gender==""&&landlord1dob==""&&landlord1age==""&&occupation==""&&landlord1contact==""&&landlord1pan==""&&landlord1addhar==""&&landlord1email==""&&landlord1addr==""&&landlord1pin=="")&&listitem!="")
         {
              flag=1;
         }
         else if((landlord1==""&&gender==""&&landlord1dob==""&&landlord1age==""&&occupation==""&&landlord1contact==""&&landlord1pan==""&&landlord1addhar==""&&landlord1email==""&&landlord1addr==""&&landlord1pin=="")&&listitem=="")
         {
               $('.msgs').fadeIn();
                       $('.msgs').removeClass('alert alert-success');
                      $('.msgs').addClass('alert alert-danger');
                      $('.msgs').html('Please Add Atleast One Landlord To Proceed Next');
                      $('.msgs').delay(5000).fadeOut();
              flag=0;
         }
         else
         {
             if(landlord1==""||gender==""||landlord1dob==""||landlord1age==""||occupation==""||landlord1contact==""||landlord1pan==""||landlord1addhar==""||landlord1addr==""||landlord1pin=="")
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
                    funxc="removelandlord('"+nemclas+"','landlord"+nemclas+"')";
                      editfunct="editlandlord('"+nemclas+"','landlordform','editlandlordetails','addnewbtn1','newxt12btn')";
                    newstr='<div class="mb-2 form-group border rounded d-flex justify-content-between align-items-center pl-3 landlord'+nemclas+'"><div class="name">'+landlord1+'</div><div><button type="button" class="btn btn-link border-left border-right rounded-0" onclick="'+editfunct+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button class="btn btn-link removebtn" type="button" onclick="'+funxc+'"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button></div></div>';
                    $(".landlordlist").append(newstr);
                    $(".current").addClass(nemclas);
                    $(".landlord").removeClass("current");
                     flag=1;
             }
         }
         if(flag==1)
         {
            $("."+formclass).hide();
            $(".current").remove();
            $("#"+hideclass).removeClass("show active");
             $("#"+showclass).addClass("show active");
              $(".tenentdetails .tenent:last-child").addClass("current");
              $("."+pillact).removeClass("active");
             $("."+pillnew).addClass("active");
             $(".landlord1").val("");
             $(".gender").prop('selectedIndex', 0);
             $(".landlord1dob").val("");
             $(".landlord1age").val("");
             $(".occupation").prop('selectedIndex', 0);
             $(".landlord1contact").val("");
             $(".landlord1pan").val("");
             $(".landlord1addhar").val("");
             $(".landlord1email").val("");
             $(".landlord1addr").val("");
             $(".landlord1pin").val("");
         }
     }
         function editlandlord(getdetailsclass,hidediv,showdiv,btn1,btn2)
         {
            $("."+hidediv+",."+btn1+",."+btn2).hide();
            $("."+showdiv).show();
            var name=$("."+getdetailsclass+" .name").html();
            var gender=$("."+getdetailsclass+" .gender").html();
            var dob=$("."+getdetailsclass+" .dob").html();
            var age=$("."+getdetailsclass+" .age").html();
            var occupation=$("."+getdetailsclass+" .occupation").html();
            var mobile=$("."+getdetailsclass+" .mobile").html();
            var pan=$("."+getdetailsclass+" .pan").html();
             var aadhaar=$("."+getdetailsclass+" .aadhaar").html();
             var email=$("."+getdetailsclass+" .email").html();
             var address=$("."+getdetailsclass+" .address").html();
             var pincode=$("."+getdetailsclass+" .pincode").html();
             $(".updateclassname").val(getdetailsclass);
             $(".editlandlordname").val(name);
             $('.editgender option[value="'+gender+'"]').attr("selected", "selected")
             $(".editlandlord1dob").val(dob);
             $(".editlandlord1age").val(age);
             $('.editoccupation option[value="'+occupation+'"]').attr("selected", "selected");
             $(".editlandlord1contact").val(mobile);
             $(".editlandlord1pan").val(pan);
             $(".editlandlord1addhar").val(aadhaar);
             $(".editlandlord1email").val(email);
             $(".editlandlord1addr").val(address);
             $(".editlandlord1pin").val(pincode);
         }
        function updatelandlord(show1,show2)
        {
            updateclassname=$(".updateclassname").val();
            editlandlordname= $(".editlandlordname").val();
            editgender= $('.editgender option:selected').val();
            editlandlord1dob= $(".editlandlord1dob").val();
            editlandlord1age= $(".editlandlord1age").val();
            editoccupation= $('.editoccupation option:selected').val();
            editlandlord1contact= $(".editlandlord1contact").val();
            editlandlord1pan= $(".editlandlord1pan").val();
            editlandlord1addhar= $(".editlandlord1addhar").val();
            editlandlord1email= $(".editlandlord1email").val();
            editlandlord1addr= $(".editlandlord1addr").val();
            editlandlord1pin= $(".editlandlord1pin").val();
            if(updateclassname!="")
            {
                   $("."+updateclassname+" .name").html(editlandlordname);
                   $("."+updateclassname+" .gender").html(editgender);
                   $("."+updateclassname+" .dob").html(editlandlord1dob);
                    $("."+updateclassname+" .age").html(editlandlord1age);
                    $("."+updateclassname+" .occupation").html(editoccupation);
                    $("."+updateclassname+" .mobile").html(editlandlord1contact);
                    $("."+updateclassname+" .pan").html(editlandlord1pan);
                    $("."+updateclassname+" .aadhaar").html(editlandlord1addhar);
                    $("."+updateclassname+" .email").html(editlandlord1email);
                    $("."+updateclassname+" .address").html(editlandlord1addr);
                    $("."+updateclassname+" .pincode").html(editlandlord1pin);
                $(".landlord"+updateclassname+" .name").html(editlandlordname);
                $(".editlandlordetails").slideToggle();
                $("."+show1+",."+show2).show();
                  $(".current").remove();
            }
        }
         function cencelupdatelandlord(hideclass,show1,show2)
         {
             $("."+hideclass).hide();
             $("."+show1+",."+show2).show();
         }