<!doctype html>
<?php
  include("../../includes/configuration.php");
$searchby = $_REQUEST['searchby'];
$searchstring1 = $_REQUEST['searchfld'];

/*echo $orddata=selectQuery(AGR." as a INNER JOIN ".AGR_LANDLORD." as al ON a.agreement_no=al.agreement_no INNER JOIN ".AGR_TENENT." as at ON a.agreement_no=at.agreement_no","*","a.govt_token_no LIKE '%17080199901302%' OR al.landlord_name LIKE '%GULCHAND BHIMRAO GAIKWAD%' OR at.tenent_name LIKE '%Bodhale Rutika Dinanath%' ",1);
break;*/

/*echo $select = selectQuery("'".AGR."'.agree_by, '".AGR."'.agreement_no, '".AGR."'.govt_token_no, '".AGR_LANDLORD."'.landlord_name, '".AGR_TENENT."'.tenent_name FROM (('".AGR."'
INNER JOIN '".AGR_LANDLORD."' ON '".AGR."'.agreement_no = '".AGR_LANDLORD."'.agreement_no)
INNER JOIN '".AGR_TENENT."' ON '".AGR."'.agreement_no = '".AGR_TENENT."'.agreement_no)",1);

break;*/
if($searchby=='Tenant')
{
    $q1 = selectQuery(AGR_TENENT,"*","tenent_name LIKE '%".$searchstring1."%'  ");
}

if($searchby=='Owner')
{
    $q1 = selectQuery(AGR_LANDLORD,"*","landlord_name LIKE '%".$searchstring1."%'  ");
}

if($searchby=='Token')
{
    $q1 = selectQuery(AGR,"*","govt_token_no LIKE '%".$searchstring1."%'  ");
}

?>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> Admin</title>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo METAKEYWORDS; ?>"  >
    <meta name="description" content ="<?php echo METADESCRIPTION; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>/css/jquery.dataTables.min.css">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITEURL; ?>/img/projectimage/favicon1.png">
</head>
<body>
<div class="dashcontainer">
 <?php include('../header.php') ?>
 <div class="col-md-3 left_col">
<?php include('../cssmenu.php') ?>
</div>

    <div class="right_col">
        <div class="dashbody">
            <div class="card">
                <div class="panel-body">

                        <div class="panel-title">Search
                                <?php include("search.php");?>
                        </div>

                </div>
            </div>

            <div class="table-responsive">
                <table class="example display table table-striped" width="100%" id="search">
                    <?php if(count($q1)){ ?>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Agreement ID </th>
                                <th>Token No</th>
                                <th>Posted By</th>
                                <th>Entry Date</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <?php } ?>
                        <tbody class="mute-text">
                            <?php
                            $cnt = 1;
                            for($i=0;$i<count($q1);$i++)
                            {
                                $gettoken = selectQuery(AGR,"*","agreement_no='".$q1[$i]['agreement_no']."' ");
                                $client=selectQuery(WEB_USER,"u_fname,u_lname","u_id=".$gettoken[0]['agree_by']);
                                $cname=$client[0]['u_fname']." ".$client[0]['u_lname'];

                                if($gettoken[0]['payment_mode']!="")
                                {
                                    $mode=$gettoken[0]['payment_mode'];
                                    if($gettoken[0]['isPaid']=="1")
                                    {
                                        $paystatus="<span class='text-success'>(Paid)</span>";
                                    }
                                    else
                                    {
                                        $paystatus="<span class='text-danger'>(Pending)</span>";
                                    }
                                }
                                else
                                {
                                   $mode="<span class='text-danger'>Not Processed</span>";
                                    $paystatus="";
                                }

                                $delfunc="del('del_agreement','".$gettoken[0]['agreement_no']."')";
                                $action=' <button type="button" class="btn btn-default btn-sm" onclick="'.$delfunc.'"><i class="fa fa-trash text-danger" ></i> </button>';
                            ?>
                                <tr>
                                    <td><?php echo $cnt++;?></td>
                                    <td><?php echo $q1[$i]['agreement_no'];?></td>
                                    <td><?php echo $gettoken[0]['govt_token_no']; ?></td>
                                    <td><?php echo $cname; ?></td>
                                    <td><?php echo date("d M Y",strtotime($gettoken[0]['entry_on']))."<br>".date("h:i a",strtotime($gettoken[0]['entry_on']))?></td>
                                    <td><?php echo $mode." ".$paystatus;?></td>
                                    <td><?php echo $gettoken[0]['agreement_status']; ?></td>
                                    <td><?php echo $action; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                </table>
                     <?php if(count($q1)<=0){?> <p><h3>Records Not Found</h3></p><?php } ?>
            </div>
        </div>
            <?php include '../footer.php'?>
    </div>

</div>
<script type="text/javascript" src="<?php echo SITEURL; ?>/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('.example').DataTable({
            "lengthMenu": [10, 25, 50, 75, 100]
        });
    });
</script>

    </body>
</html>
