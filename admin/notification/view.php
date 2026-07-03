<?php include("../../includes/configuration.php");
$n_id = base64_decode($_REQUEST['n_id']); echo $n_id; $getdata = selectQuery(NOTIFICATION,"*","id=".$n_id); 
$statusmaster = selectQuery(STATUS,"*","isDel='0' and isActive='1'");
// Get category value
$category = $getdata[0]['category'];
// Fetch status options for dropdown if category is "status"
$statusOptions = '';
if ($category == 'status') {
    foreach ($statusmaster as $value) {
        $selected = ($value['status'] == $getdata[0]['name']) ? 'selected' : '';
        $statusOptions .= "<option value='{$value['status']}' $selected>{$value['status']}</option>";
    }
}    


?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITE_TITLE; ?> | Notification Settings</title>
    <?php include('../commoncss.php'); ?>
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php'); ?>
    <?php include('../cssmenu.php'); ?>
    <div class="main-panel">
        <div class="dashbody">
            <div class="tech-dept">
                <div class="card mb-0">
                    <div class="card-header sec-card-head justify-content-between align-items-center py-2"><div><h2 class="card-head-title"><?php echo $getdata[0]['name']; ?> Configuration</h2></div><div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div></div>
                    <div class="card-body pb-2">
                        <div class="updateslatime">
                            <div class="msgs"></div>
                            <div class="innerupdateslatime">
                                <form>
                                <input type="hidden" id="n_id" value="<?php echo $n_id; ?>"/>
                                <!-- Category Selection -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-md-4 col-lg-3 cc-mandatary-field col-form-label">Category</label>
                                    <div class="col-sm-7 col-md-6 col-lg-4">
                                        <select name="category" id="category" class="form-control">
                                            <option value="general" <?php echo ($category == 'general') ? 'selected' : ''; ?>>General</option>
                                            <option value="status" <?php echo ($category == 'status') ? 'selected' : ''; ?>>Status</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Notification Name (Textbox / Dropdown) -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-md-4 col-lg-3 cc-mandatary-field col-form-label">Notification Name</label>
                                    <div class="col-sm-7 col-md-6 col-lg-4">
                                        <input type="text" name="name" id="name" class="form-control text-capitalize <?php echo ($category == 'status') ? 'd-none' : ''; ?>" value="<?php echo $getdata[0]['name']; ?>" maxlength="80" placeholder="Notification Name"/>
                                        
                                        <select name="status_name" id="status_name" class="form-control <?php echo ($category == 'status') ? '' : 'd-none'; ?>">
                                            <option value="">Select Status</option>
                                            <?php echo $statusOptions; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-md-4 col-lg-3 cc-mandatary-field col-form-label">Message</label>
                                    <div class="col-sm-7 col-md-6 col-lg-4"><textarea  name="message" id="message" class="form-control" rows="3" placeholder="Enter Message"><?php echo $getdata[0]['message']; ?></textarea></div>
                                </div>
                                <div class="row border-top"><div class="col-12 pt-2 text-right"><button type="button" class="btn btn-primary" id="update">UPDATE</button> <a href="<?php echo ADMINURL?>notification" id="cancel" class="btn btn-secondary">Cancel</a></div></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
    </div>
</div>
<script>
$("#update").click(function(){
    var n_id = $("#n_id").val(); 
    var category = $("#category").val();
    var message = $("#message").val();
    var name = (category === "status") ? $("#status_name").val() : $("#name").val(); // Get value based on category
    if (name === "" || message === "" || category === "") {
        $(".msgs").fadeIn().addClass("alert alert-danger").html("Please fill all required fields").delay(5000).fadeOut();
        return;
    }
    else{
        var info={n_id:n_id, name:name,message:message, category: category};
        $.ajax({
            type:"POST", url:"update.php", data:info,
            success:function(response){
                if(response==1){ $('.msgs').fadeIn().addClass("alert alert-success").html("Updated Successfully").delay(5000).fadeOut();
                location.reload(); }
                else{ $('.msgs').fadeIn().addClass("alert alert-success").html("Not Updated").delay(5000).fadeOut(); }
            }
        });
    }
})

// Toggle between Textbox and Dropdown based on Category Selection
$("#category").change(function() {
        var categoryValue = $(this).val();
        
        if (categoryValue === "status") {
            $("#name").addClass("d-none"); // Hide Textbox
            $("#status_name").removeClass("d-none"); // Show Dropdown
        } else {
            $("#name").removeClass("d-none"); // Show Textbox
            $("#status_name").addClass("d-none"); // Hide Dropdown
        }
    });
</script>
</body>
</html>