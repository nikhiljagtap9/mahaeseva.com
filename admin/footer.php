<footer class="footer"><div class="col-md-12"><div class="row"><div class="col-md-6 col-sm-6 col-6">Copyright &#169; <?php echo date("Y"); ?> <?php echo SITENAME; ?></div><div class="col-md-6 col-sm-6 col-6 text-right">Website Intelligence By <a href="https://www.surun.in/" target="_blank">Surun Infocore System</a></div></div></div></footer>
<!--Delete Popup-->
<div class="modal delete-modal" id="del_popup"><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-body"><p class="cc-margin-bottom-0" id="del_message"></p></div><div class="modal-footer"><button type="button" class="btn btn-primary btn-sm" id="popup_ok">Ok</button><button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button></div></div></div></div>
<script src="<?php echo SITEURL; ?>/js/jquery.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/popper.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/bootstrap.min.js"></script>
<script>
//Open related dropdown click on sidebar links
$(document).ready(function(){
    var path = window.location.href; 
    var target = $(".sidebar ul li a[href='"+path+"']");
    target.addClass('menuactive');
    target.parents("ul").show();
});
//Add is-collapsed class to body for sidebar(navigation) collaps on click of Menu Button in header
$(".menubtn").click(function(){ $("body").toggleClass("is-collapsed");$('.drop-menu').slideUp(); });
function goBack(){ window.history.back();}
//to capital all word capital
function firstcapital(id){
    if(str!=""){
        var str = $("#"+id).val();
        var str1 = str.replace(/\S+/g, str => str.charAt(0).toUpperCase() + str.substr(1).toLowerCase());
        $("#"+id).val(str1);
    }
}
//to capital all string capital
function allcapital(id){ if(str!=""){ var str = $("#"+id).val(); var str1 = str.toUpperCase(); $("#"+id).val(str1); } }
//to capital first letter of string
function onlyfirstcapital(id){ if(str!=""){ var str = $("#"+id).val(); var str1 = str.charAt(0).toUpperCase(); $("#"+id).val(str1); } }
//to capital string sentence first letter
function sentencecap(id){
    if(str!=""){ var str = $("#"+id).val(); var str1 = ststr.split("."); var newstr=[];
    for(var i = 0; i < str1.length; i++){
        var substri = str1[i].trim(); var cap=substri.charAt(0).toUpperCase(); newstr.push(cap);
    }
    var newstring=newstr.toString(); $("#"+id).val(newstring); }
}
/* To check email */
function mailchk(id){
    var email = $("#"+id).val();
    //var patt = new RegExp(/^[a-zA-Z0-9.\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{1,4}$/);
    var patt = new RegExp(/^([\w\-\.]+)@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([\w\-]+\.)+)([a-zA-Z]{2,4}))$/);
    if(email!=""){
        var res = patt.test(email);
        if(res){ $("#"+id).css("border",""); }else { $("#"+id).val(""); $("#"+id).css("border","1px solid red"); }
    }
}
//Toogle dropdown menu on click of a link in sidebar
$('.sidebar li:has(ul)').addClass('dropdown');
$(".sidebar li a").on("click", function(){
    var sdlinkt = $(this);
    if(!sdlinkt.parent().hasClass("open")){
        sdlinkt.parent().parent().children("li.open").children(".dropdownMenu").slideUp(200),
        sdlinkt.parent().parent().children("li.open").removeClass("open"),
        sdlinkt.parent().children(".dropdownMenu").slideDown(200),
        sdlinkt.parent().addClass("open");
    } else{
        sdlinkt.parent().children(".dropdownMenu").slideUp(200);
        sdlinkt.parent().removeClass("open");
    }
});
function del_alertbox(msg,i,funct,type){
    $("#del_popup").modal("show"); 
    $("#del_message").html(msg);
    $("#popup_ok").attr("onclick", funct+"('" + i + "','" + type + "')");
}
</script>