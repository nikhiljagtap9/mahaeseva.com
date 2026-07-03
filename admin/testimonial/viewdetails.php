<?php include("../../includes/configuration.php");
$gettestimonials = selectQuery(TESTIMONIALS,"*","test_id='".$_REQUEST['img_id']."' "); ?>
<form name="banddata">
    <div class="form-group">
        <label>Client Name</label>
        <input type="text" name="client_name" id="client_name" onblur="firstcapital('client_name')" class="brand_name form-control text-capitalize" maxlength="50" placeholder="Enter Client Name"  value="<?php echo $gettestimonials[0]['client_name']; ?>"/>
    </div>
    <div class="form-group">
        <label>Testimonials</label>
        <textarea class="form-control" id="testimonials" name="testimonials" placeholder="Enter Testimonials Description (Max.500 Characters)" cols="40" rows="5" maxlength="500"><?php echo $gettestimonials[0]['testimonials']; ?></textarea>
    </div>
    <div class="list-view">
        <div class="generatedlink"></div>
        <div class="inputurl"></div>
        <input type="hidden" name="img_id" id="img_id" required value="<?php echo $gettestimonials[0]['test_id']; ?>"/>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="chnfun"><input type="button" name="Savedata" id="savedata" class="btn btn-primary" value="Save" onclick="updatedata()" /></div>
        </div>
    </div>
</form>
<script>
function decide1(){
   $(".chnfun").replaceWith("<div class='form-group chnfun'><input type='button' name='Preview link' id='prelink' class='btn btn-default' value='Generate link' onclick='sellerlink()' /><input type='button' name='Savedata' id='savedata' class='btn greenBtn' value='Save' onclick='updatedata()' style='margin-left:20px'/></div></div>")
}
function decide(){
   $(".chnfun").replaceWith(" <div class='form-group chnfun'><input type='button' name='Preview link' id='prelink' class='btn btn-default' value='Generate link' onclick='link()' /><input type='button' name='Savedata' id='savedata' class='btn greenBtn' value='Save' onclick='updatedata()' style='margin-left:20px'/></div></div>")
}
</script>