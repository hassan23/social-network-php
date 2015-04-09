<?php
include_once("php_includes/db_conx.php");
if(isset($_POST["user"])){
	$u = $_POST["user"];
} 
$sql = "SELECT * FROM users WHERE username='$u' AND activated='1' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
$numrows = mysqli_num_rows($user_query);
if($numrows < 1){
	echo 'ok';
	} 

?>




