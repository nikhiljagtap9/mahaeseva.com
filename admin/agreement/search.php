<div class="msg"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 searchGuest">
        <form class="form-inline" action="searchresult.php" onsubmit="return check()" method="post">
            <div class="form-group mr-3"><input type="text" class="form-control" id="searchfld" name="searchfld"  placeholder="Enter"></div>
            <div class="form-group mr-3"><select class="form-control" id="searchby" name="searchby" onchange="show();"><option value="">Select </option><option value="Landlord">Landlord</option><option value="Tenant">Tenant</option><option value="Token">Token</option></select></div>
            <div class="checkbox plr"></div>
            <div class="form-group"><button type="submit" class="btn btn-primary">Search</button></div>
            <span id="error"></span>
        </form>
    </div>
</div>
<script>
function check(){
    var box = document.getElementById('error'); var searchby = $("#searchby").val(); var searchfld = $("#searchfld").val();
    if(searchby == ""){ box.innerHTML="Please provide the text"; }
    else if(searchfld == ""){ box.innerHTML="Please select the type"; }
    else{ return true; }
}
</script>