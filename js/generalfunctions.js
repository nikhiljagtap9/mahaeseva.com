    /* disabled all tabs menu */
     $(".pill1 a,.pill2 a,.pill3 a,.pill4 a,.pill5 a").prop("disabled",true);

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
        var patt = new RegExp(/^[a-zA-Z0-9_\-\.\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/);
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