<div class="footer">
<div class="col-md-12">
 <div class="row">
     <div class="col-md-6 col-sm-6 col-xs-6">
    Copyright &#169; <?php echo date("Y"); ?>  <?php echo SITENAME; ?><br>
    </div>

     <div class="col-md-6 col-sm-6 col-xs-6 text-right" >
        Website Intelligence By- <a href="https://www.surun.in/" target="_blank">Surun Infocore System</a>
     </div>
 </div>
</div>
</div>

<script>
 function goBack() {        
        var prevurl =document.referrer;
        var n = prevurl.lastIndexOf('/');
        var result = prevurl.substring(n + 1);

       if(result == "searchresult.php" )
        {
          window.history.go(-2);
        }
        else
        {
           window.history.back();
        }
}

$(function(){
    var current = location.pathname;
    $('#myNavbar .nav li a').each(function(){
        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('activeborder');
        }
    })
})

/*function check()
{
    var searchfld = $("#searchfld").val();
    if( searchfld == "" )
    {
        $(".msg").fadeIn().html("Please define search Criteria").addClass("alert alert-danger").delay(5000).fadeOut();
        return false;
    }
    else
    {
       return true;
    }
}*/

$("#search").click(function(){
       $('#search').tablesorter();
});

</script>

