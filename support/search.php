<?php
  $getactivedept=selectQuery(SUPPORTDEPT,"dept_name","isActive='1' and isDel='0' order by dept_name ASC");
?>
<div class="msg"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 searchGuest">
        <form class="form-inline margin0" action ="searchresult.php"  onsubmit=" return check()"  method="post" width="100%">
            <div class="form-group">
               <input type="text" class="form-control" id="searchfld" name="searchfld"  placeholder="Query">
            </div>
            <div class="form-group">
                <select class="form-control" id="dept" name="dept" style="width: 180;">
                    <option value="">Select Department</option>
                    <?php
                     for($i=0;$i<count($getactivedept);$i++)
                     {
                         ?>
                          <option value="<?php echo $getactivedept[$i]['dept_name']; ?>"><?php echo $getactivedept[$i]['dept_name']; ?></option>
                         <?
                     }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" id="sts" name="sts" style="width: 180;">
                    <option value="">Select Status</option>
                    <option>Open</option>
                    <option>Answered</option>
                    <option>Overdue</option>
                    <option>Closed</option>
                </select>
            </div>
          <div class="checkbox plr"></div>
          <button type="submit" class="btn btn-success ">Search</button>
        </form>
    </div>
</div>
