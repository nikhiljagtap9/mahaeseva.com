
<div class="fillHeader">
<?php include 'menu.php';?>
<?php include 'internalmenu.php';?>
</div>

<div class="content">
 <div class="container">
    <h4 class="pageHead">Closed Tickets</h4>
        <table class="example display table table-striped" width="100%">
        <thead>
            <th>#</th>
             <th>Ticket ID</th>
              <th>Department</th>
             <th>Created Date</th>
             <th>Last Response On</th>
          </thead>
          <tbody class="mute-text">
            <?php
              for($i=0;$i<count($closerequest);$i++)
              {
                   $getdeptname=selectQuery(SUPPORTDEPT,"*","dept_id=".$closerequest[$i]['dept']);
                     $comments=selectQuery(SUPPORTCOMMENT,"*","ticket_id=".$closerequest[$i]['contact_request_id']." order by comment_id DESC LIMIT 1");
                  ?>
                    <tr>
                       <td>
                       <?php echo $i+1; ?>
                       </td>
                       <td><a href="requestdetails.php?req=<?php echo base64_encode($closerequest[$i]['contact_request_id']); ?>"><?php echo $closerequest[$i]['contact_request_id']; ?></a></td>
                        <td><?php echo $getdeptname[0]['dept_name']; ?></td>
                        <td><?php echo $closerequest[$i]['date']; ?></td>
                        <td><?php echo $comments[0]['comment_date']; ?></td>

                    </tr>
                  <?
              }
            ?>
          </tbody>
       </table>
 </div>
 </div>
<?php include 'footer.php';?>