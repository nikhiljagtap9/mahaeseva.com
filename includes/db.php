<?php
//Constants defined in variables.php
$host_name = HOST;
$database = DATABASE; // Change your database nae
$username = USERNM; // Your database user id
$password = PASSWRD; // Your password
$db = new PDO("mysql:host=$host_name; dbname=$database", $username, $password);   //PDO connection to database
$db->exec("SET CHARACTER SET utf8"); // Sets encoding UTF-8
function selectQuery($table_name,$fields,$where="",$show = 0){
    ini_set("memory_limit",-1);
    global $db;
    $i =0;
    if($where == "")
    $sql = "SELECT  ".$fields." FROM ".$table_name;
    else
    $sql = "SELECT  ".$fields." FROM ".$table_name." WHERE ".$where;
    //PDO Select Query
    if($show == 1)
    return $sql;
    $results =$db->query($sql);
    $result=array();
    foreach($results as $row){ $result[$i++]= $row; }
    return $result;
}
function insertQuery($table_name,$form_data){
    global $db;

    // Apply addslashes to all values in form_data
    foreach ($form_data as $key => $value) {
        $form_data[$key] = addslashes($value);
    }

    $fields = array_keys($form_data);
    //$form_data['message'] = addslashes($form_data['message']); //added new line for message tamplete
    $sql = "INSERT INTO ".$table_name."(`".implode('`,`', $fields)."`)VALUES('".implode("','", $form_data)."')";
    $results =$db->query($sql);
    return $db->lastInsertId();
}
function updateQuery($table_name, $form_data, $where_clause=''){
    global $db;
    $whereSQL = '';
    if(!empty($where_clause)){
        //check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
            //not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else{
            $whereSQL = " ".trim($where_clause);
        }
    }
    //start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";
    //loop and build the column /
    $sets = array();
  //  foreach($form_data as $column => $value){ $sets[] = "`".$column."` = '".$value."'"; }
    foreach($form_data as $column => $value){ 
        $value = addslashes($value); 
        $sets[] = "`".$column."` = '".$value."'"; 
    }
    $sql .= implode(', ', $sets);
    //append the where statement
    $sql .= $whereSQL; 
    $results = $db->query($sql);
    return ($results);
}
function deleteQuery($table_name,$id){
    global $db;
    $sql = "DELETE FROM ".$table_name." WHERE ".$id;
    $results = $db->query($sql);
    return $results;
}
function showQuery($table_name,$where){
    global $db;
    $i =0;
    if($where == "")
    $sql = "SHOW COLUMNS FROM ".$table_name;
    else
    $sql = "SHOW COLUMNS FROM ".$table_name." WHERE ".$where;
    $results =$db->query($sql);
    $result=array();
    foreach($results as $row){ $result[$i++]= $row; }
    return $result;
}
function alterQuery($table_name,$cond){
	   global $db;
       $sql = "ALTER TABLE ".$table_name." ".$cond;
       $results = $db->query($sql);
       return $results;
}
function createQuery($query){
    global $db;
    $sql = $query;
    $results = $db->query($sql);   
    return ($results);
}
//////////////////////////////send email/////////////////////////
function sendemail($to,$subject,$from,$message){
    $email_to = $to;
    $email_subject = $subject;
    /*$email_from ="info@rojgaronline.com";*/
    $email_message = $message;
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" ."\r\n" ;
    $headers .= 'From: '.$email_from."\r\n";
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    $retval = @mail($email_to, $email_subject, $email_message, $headers);
    return $retval;
}
///////////////////////////send sms////////////////////////
function pagination($table,$where="",$per_page=10,$page=1,$url='?',$post=""){
    if($where == "")
    $row = selectQuery($table,"COUNT(*) as num");
    else
    $row = selectQuery($table,"COUNT(*) as num",$where);
    $total = $row[0]['num'];
    $adjacents = "2";
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $lastlabel = "Last &rsaquo;&rsaquo;";
    $page = ($page == 0 ? 1 : $page);
    $start = ($page - 1) * $per_page;
    $prev = $page - 1;
    $next = $page + 1;
    $lastpage = ceil($total/$per_page);
    $lpm1 = $lastpage - 1; // //last page minus 1
    $pagination = "";
    if($lastpage > 1){
    $pagination .= "<ul class='pagination' style='float:right'>";
    $pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";
    if($page > 1) $pagination.= "<li><a href='{ $url }page={$prev}{$post}'>{$prevlabel}</a></li>";
    if($lastpage < 7 + ($adjacents * 2)){
        for($counter = 1; $counter <= $lastpage; $counter++){
            if($counter == $page)
            $pagination.= "<li><a class='current'>{$counter}</a></li>";
            else
            $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
        }
    } elseif($lastpage > 5 + ($adjacents * 2)){
        if($page < 1 + ($adjacents * 2)){
            for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                if($counter == $page)
                $pagination.= "<li><a class='current'>{$counter}</a></li>";
                else
                $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
            }
            $pagination.= "<li class='dot'>...</li>";
            $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
            $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";
        } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)){
            $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
            $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
            $pagination.= "<li class='dot'>...</li>";
            for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++){
                if($counter == $page)
                $pagination.= "<li><a class='current'>{$counter}</a></li>";
                else
                $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
            }
            $pagination.= "<li class='dot'>..</li>";
            $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
            $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";
        } else{
            $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
            $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
            $pagination.= "<li class='dot'>..</li>";
            for($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
            if($counter == $page)
            $pagination.= "<li><a class='current'>{$counter}</a></li>";
            else
            $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
            }
        }
    }
    if($page < $counter - 1){
        $pagination.= "<li><a href='{$url}page={$next}{$post}'>{$nextlabel}</a></li>";
        $pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
    }
    $pagination.= "</ul>";
    }
    return $pagination;
} ?>