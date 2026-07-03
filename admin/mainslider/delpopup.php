 <?php  include("../../includes/configuration.php");

$delid = $_REQUEST['delid'];
  ?>

 <button type="button" data-dismiss="modal" class="btn btn-primary greenBtn" id="delete"  onclick="del('<?php echo $delid; ?>')">Delete</button>
    <button type="button" data-dismiss="modal" class="btn btnred">Cancel</button>