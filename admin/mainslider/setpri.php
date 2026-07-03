<?php
include ("../../includes/configuration.php");
$str = $_REQUEST['str'];
$img = explode(",", $str);

if ($str != "") {
  for ($i = 0; $i < count($img); $i++) {
    $data = array('priority' => $i + 1, 'isDel' => 0);
    $update = updateQuery(MAIN_SLIDER, $data, "s_img_id=" .$img[$i]);
  }
}
?>