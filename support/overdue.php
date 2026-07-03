<?php include("../includes/configuration.php"); ?>
<!doctype html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo SITENAME; ?> Support</title>
<?php include 'commoncss.php';?>
<style>
      .dataTables_filter {
display: none;
}
   </style>
</head>
<body class="mainbody">
<?php include('menu.php');  ?>
<div class="content">
     <div class="container">
            <h4 class="pageHead">Overdue Tickets (<?php echo count($getoverdue); ?>)</h4>
              <?php  include 'search.php'; ?>
              <hr>
            <div class="table-responsive">
                <table class="display table table-striped" id="guest-grid">
                            <thead>
                            <tr>
                                <th>#</th>
                            <th >Ticket #</th>
                            <th>Client Details</th>
                            <th>Status</th>
                            <th >Assigned Staff</th>
                            <th >Department</th>
                            <th >Created On</th>
                            </tr>
                            </thead>

                </table>
             </div>
     </div>
 </div>
<?php include('footer.php'); ?>
 <script src="<?php echo SITEURL ?>/js/jquery.dataTables.min.js"></script>

           <script>
           	$(document).ready(function() {
                var dataTable = $('#guest-grid').DataTable( {
                	"processing": true,
                                "bFilter": false,
                                "paging": true,
                	"serverSide": true,
                                "searching": { "regex": false },
                                "pageLength": 10,
                                "lengthMenu": [ [10, 25, 50, 100,], [10, 25, 50, 100] ],
                	"ajax":{
                		url :"opnlead_grid_data.php",
                		type: "post",
                                    data : {wherecond:"<?php echo $overduewhere; ?>"},
                		error: function(){
                			$(".guest-grid-error").html("");
                			$("#guest-grid").append('<tbody class="guest-grid-error text-muted"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                			$("#guest-grid_processing").css("display","none");

                		}
                	}
                } );
                } );
       </script>
</body>
</html>