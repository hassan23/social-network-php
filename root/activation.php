<?php
if (isset($_GET['id']) && isset($_GET['u']) && isset($_GET['e']) && isset($_GET['p'])) {
    include_once("php_includes/db_conx.php");
    $id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
	$e = mysqli_real_escape_string($db_conx, $_GET['e']);
	$p = mysqli_real_escape_string($db_conx, $_GET['p']);
	if($id == "" || strlen($u) < 3 || strlen($e) < 5 || $p== ""){
		header("location: message.php?msg=activation_string_length_issues_REFILL_FORM");
    	exit(); 
	}
	$sql = "SELECT * FROM users WHERE id='$id' AND username='$u' AND email='$e' AND password='$p' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
	$numrows = mysqli_num_rows($query);
		if($numrows == 0){
		header("location: message.php?msg=Your credentials are not matching anything in our system");
    	exit();
	}
	$sql = "UPDATE users SET activated='1' WHERE id='$id' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
	$sql = "SELECT * FROM users WHERE id='$id' AND activated='1' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
	$numrows = mysqli_num_rows($query);
    if($numrows == 0){
        header("location: message.php?msg=activation_failure");
    	exit();
    } else if($numrows == 1) {
        header("location: message.php?msg=activation_success");
    	exit();
    }
} else {
	header("location: message.php?msg=missing_GET_variables");
    exit(); 
}
?>