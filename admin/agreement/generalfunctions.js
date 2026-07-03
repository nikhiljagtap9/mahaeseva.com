    /* disabled all tabs menu */
     $(".pill0 a,.pill1 a,.pill2 a,.pill3 a,.pill4 a,.pill5 a").prop("disabled",true);
    $("#fname,#lname").attr("disabled",true);
     /* To append execution city value */
      /*function showvalbefore(selectclass,showdiv)
       {
           valsel=$("."+selectclass+" option:selected").val();
           $("."+showdiv).html(valsel);
       }*/
       /* To append select boxes value */
       function showval(selectclass,showdiv)
       {  
           valsel=$("."+selectclass+" option:selected").val();
           $(".current ."+showdiv).html(valsel);
       }
         /* To append input boxes value */
       function showvalinput(inputclass,showclass)
       {
            valsel=$("."+inputclass).val();
           $(".current ."+showclass).html(valsel);
       }
       function othershowvalinput(inputclass,showclass)
       {
            valsel=$("."+inputclass).val();
           $("."+showclass).html(valsel);
       }
      function othershowval(selectclass,showclass)
      {
          valsel=$("."+selectclass+" option:selected").val();
           $("."+showclass).html(valsel);
      }
        /* To check name */
      function namechk1(id)
     {
        var name =  $('#'+id).val();
        var alphanumers = /^[a-zA-Z ]+$/;
            if(!alphanumers.test(name)){
                 var newstr = name.slice(0, -1);
                $("#"+id).val(newstr);
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
      /* To convert in upper case */
      function UpperCase(ctrlID) {
        var PANNo = document.getElementById(ctrlID).value;
        if (PANNo != "") {
        document.getElementById(ctrlID).value = PANNo.toUpperCase();
        }
        }
         /* To validate PAN */
      function pan(id)
     {
        var name =  $('#'+id).val();
        var alphanumers = /^([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})$/;
            if(!alphanumers.test(name)){
                $("#"+id).val("");
                $("#"+id).css("border","1px solid red");
             /*    $("#"+id).focus();  */
            }
            else
            {
                $("#"+id).css("border","");
            }
     }
       /* To check number */
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
     /* To check mobile number */
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
      /* To check email */
      function mailchk(id)
     {
          var email = $("#"+id).val();
        var patt = new RegExp(/^[a-zA-Z0-9.\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/);
        if(email!="")
        {
             var res = patt.test(email);
            if(res)
            {
                $("#"+id).css("border","");
            }
            else
            {
                 $("#"+id).val("");
                /*  $("#"+id).focus();       */
                $("#"+id).css("border","1px solid red");
            }
        }
     }
     function chkclient(mobno)
     {
         mob=$("#"+mobno).val();
          info={action:"chkclient",mob:mob}
          $.ajax({
            type:"POST",
            url:"ajax.php",
            data:info,
            success:function(response){
               if(response.trim()!="0")
              {
                  var arr=response.split("***");
                  $("#uid").val(arr[0].trim())
                  $("#fname").val(arr[1]);
                  $("#lname").val(arr[2]);
                  $("#emailid").val(arr[3]);
                   $("#fname,#lname").attr("disabled",true);
              }
              else
              {
                  $("#fname,#lname").attr("disabled",false);
                    $("#fname,#lname,#emailid").val("");
                  $("#fname").focus();
              }
            }
         });
     }
     function chkclientdata()
     {
            uid=$("#uid").val();
            mob=$("#mobno").val();
            fname=$("#fname").val();
            lname=$("#lname").val();
            email=$("#emailid").val();
            if(mobno==""||fname==""||lname=="")
            {
                $(".msgs").fadeIn().removeClass("alert alert-success").addClass("alert alert-danger").html("Enter Data Of All Required Fields").delay(5000).fadeOut();
            }
            else
            {
                 if(uid=="")
                 {
                      info={action:"addclient",mob:mob,fname:fname,lname:lname,email:email}
                      $.ajax({
                        type:"POST",
                        url:"ajax.php",
                        data:info,
                        success:function(response){
                           if(response.trim()!="0")
                          {
                              $("#uid").val(response.trim());
                              $("#Step0").removeClass("show active");
                            $("#Step1").addClass("show active");
                            $(".agrmstep1").removeClass("active");
                            $(".agrmstep2").addClass("active");
                          }
                          else
                          {
                              $(".msgs").fadeIn().removeClass("alert alert-success").removeClass("alert alert-danger").html("Error While Adding Client Data").delay(5000).fadeOut();
                          }
                        }
                     });
                 }
                 else
                 {
                    $("#Step0").removeClass("show active");
                    $("#Step1").addClass("show active");
                    $(".agrmstep1").removeClass("active");
                    $(".agrmstep2").addClass("active");
                 }
            }
     }
     function storagechng(tempdata)
     {
         chkval=$("."+tempdata+":checked").val();
         if(chkval=="on")
         {
             $(".showtemp").show();
             $(".newxt12btn").hide();
         }
         else
         {
             $(".showtemp").hide();
             $(".newxt12btn").show();
         }
     }
     function storetempdata(adminurl)
     {
            mob=$("#mobno").val();
            fname=$("#fname").val();
            lname=$("#lname").val();
            email=$("#emailid").val();
            tokenno=$("#tokenno").val();
            var textareaValue = $('.summernote').summernote('code');
            var cleanText = $(".summernote").summernote('code').replace(/<\/?[^>]+(>|$)/g, "");
            if(mobno==""||fname==""||lname=="")
            {
                $(".msgs").fadeIn().removeClass("alert alert-success").addClass("alert alert-danger").html("Enter Data Of All Required Fields").delay(5000).fadeOut();
            }
            else
            {
                   info={action:"temp_store",mob:mob,fname:fname,lname:lname,email:email,tokenno:tokenno,otherinfo:textareaValue}
                      $.ajax({
                        type:"POST",
                        url:"ajax.php",
                        data:info,
                        success:function(response){
                           if(response.trim()!="0")
                          {
                              $(".msgs").fadeIn().removeClass("alert alert-danger").addClass("alert alert-success").html("Data Successfully Stored In Temporary Storage").delay(5000).fadeOut();
                              setTimeout(function(){ window.location=adminurl+'agreement/tempstorage.php'; }, 3000);
                          }
                          else
                          {
                              $(".msgs").fadeIn().removeClass("alert alert-success").addClass("alert alert-danger").html("Error While Storing Data").delay(5000).fadeOut();
                          }
                        }
                     });
            }
     }