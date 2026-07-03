<?php include('menu.php');

 $empid = $_SESSION['staff'];

 ?>
   <style>
      .dataTables_filter {
display: none;
}
   </style>
<div class="content">
    <div class="container">
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Change Password</button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                <input type="text" id="crntpwd" name="crntpwd" class="form-control" onblur="checkpwd();" maxlength="30" placeholder="Enter Current Password">
                </div>
                <!--<div class="form-group">
                <input type="text" id="username" name="username" class="form-control" onkeyup="checkusername();" placeholder="Enter Username" disabled>
                </div>-->
                <div class="form-group">
                <input type="text" id="password" name="password" class="form-control" onkeyup="checkpassword();" maxlength="30" placeholder="Enter Password" disabled="disabled">
                </div>
                <div class="form-group">
                <input type="text" id="confpassword" name="confpassword" class="form-control" onkeyup="checkconfpassword();" maxlength="30" placeholder="Confirm Password" disabled="disabled">
                </div>
              </div>
              <div class="modal-footer">
              <span class="pull-left" id="errmsg"></span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="checksubmit();" id="savechanges">Save changes</button>
              </div>
            </div>
          </div>
        </div>

    </div>
</div>

<?php include 'footer.php';?>

<script type="text/javascript" src="<?php echo SITEURL ?>/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {

});

/*function checkusername()
{
    var username = $("#username").val();
    if(username=="")
    {

    }
}*/
function checkpassword()
{
    var password = $("#password").val();
    if(password=="")
    {
        $("#errmsg").html("Please Enter Password").css("color","red");
    }
    else if(password.length<3)
    {
        $("#errmsg").html("Please Enter Atleat 3 characters").css("color","red");
    }
    else
    {
        $("#errmsg").html("");
    }
}

function checkconfpassword()
{
    var confpassword = $("#confpassword").val();
    var password = $("#password").val();

    if(password=="")
    {
        $("#errmsg").html("Please Enter Password").css("color","red");
    }
    else if(password.length<3)
    {
        $("#errmsg").html("Please Enter Atleat 3 characters").css("color","red");
    }
    else if(confpassword=="")
    {
        $("#errmsg").html("Please Enter Confirm Password").css("color","red");
    }
    else if(password!=confpassword)
    {
        $("#errmsg").html("Password Not Matching").css("color","red");
    }
    else
    {
       $("#errmsg").html("");
    }
}

function checkpwd()
{
    var currentpwd = $("#crntpwd").val();
    var empid = "<?php echo $empid; ?>";
    if(currentpwd!="")
    {
        $.ajax({
             url : "ajax/changelogin.php",
             type : "post",
             data : {action : "changelogin", currentpwd:currentpwd, empid:empid},
             success : function(res){
                if(res==1)
                {
                    $("#password").prop('disabled', false);
                    $("#confpassword").prop('disabled', false);
                }
                else if(res==2)
                {
                     $("#errmsg").html("Password Incorrect").css("color","red");
                }
             }

        });

    }
}

function checksubmit()
{
    var password = $("#password").val();
    var confpassword = $("#confpassword").val();
    var empid = "<?php echo $empid; ?>";

    if(password=="")
    {
        $("#errmsg").html("Please Enter Password").css("color","red");
    }
    else if(password.length<3)
    {
        $("#errmsg").html("Please Enter Atleat 3 characters").css("color","red");
    }
    else if(confpassword=="")
    {
        $("#errmsg").html("Please Enter Confirm Password").css("color","red");
    }
    else if(password!=confpassword)
    {
        $("#errmsg").html("Password Not Matching").css("color","red");
    }
    else
    {
        $("#savechanges").html("Please wait...");

        $.ajax({
             url : "ajax/changelogin.php",
             type : "post",
             data : {action : "updatepassword", confpassword:confpassword, empid:empid},
             success : function(res){
                if(res==1)
                {
                   $("#errmsg").html("Password Changed Successfully!!!").css("color","green");
                   location.reload();
                }
                else if(res==2)
                {
                   $("#errmsg").html("Password Not Changed").css("color","red");
                }
             }

        });

    }
}
</script>