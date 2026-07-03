<?php include('menu.php');?>

<div class="content">
    <div class="container">


         <div class="card">
         <div class="panel-heading"><div class="panel-title">Guest Master</div></div>
        <div class="panel-body">


            <div class="msgs"></div>

            <div class="col-md-12">
                 <div class="row">
                      <table class="display table table-striped" id="guest-grid">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Guest No </th>
                                 <th>Guest Name</th>
                                 <th>Mobile Number</th>
                                  <th>Passport No</th>
                                   <th>Is Passport Valid</th>     
                                <th>Entry Date</th>
                            </tr>
                            </thead>
                       </table>
                        </div>
            </div>
           </div>
  </div>



    </div>
 </div>
<?php include('footer.php'); ?>

<script type="text/javascript" src="../js/bootstrap-table.js"></script>

<script src="../js/bootstrap-switch.js"></script>
<script src="../js/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="../js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../js/buttons.html5.min.js"></script>
<script type="text/javascript" src="../js/buttons.flash.min.js"></script>
<script type="text/javascript" src="../js/data_table_pdf.js"></script>
<script type="text/javascript" src="../js/data_table_jszip.js"></script>
<script type="text/javascript" src="../js/buttons.print.min.js"></script>
<script type="text/javascript" src="../js/data_table_vfsfont.js"></script>
<script type="text/javascript" src="../js/buttons.colVis.min.js"></script>
               <script>
               	$(document).ready(function() {
				var dataTable = $('#guest-grid').DataTable( {

					"processing": true,
                      "paging": true,
					"serverSide": true,
                     "searching": { "regex": true },
                     "pageLength": 10,
                       "lengthMenu": [ [10, 25, 50, 100,], [10, 25, 50, 100] ],
					"ajax":{
						url :"guest_grid_data.php",
						type: "post",
						error: function(){
							$(".guest-grid-error").html("");
							$("#guest-grid").append('<tbody class="guest-grid-error text-muted"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#guest-grid_processing").css("display","none");

						}
					}
				} );
			} );
               </script>
