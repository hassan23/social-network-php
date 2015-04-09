<?php
include_once("../php_includes/check_login_status.php");
if($user_ok != true || $log_username == "") {
exit();
}
?>
<?php
if (isset($_POST['action']) && isset($_POST['reqid']) && isset($_POST['user1'])){
$reqid = preg_replace('#[^0-9]#', '', $_POST['reqid']);
$user = preg_replace('#[^a-z0-9]#i', '', $_POST['user1']);
$sql = "SELECT COUNT(id) FROM users WHERE username='$user' AND activated='1' LIMIT 1";
$query = mysqli_query($db_conx, $sql);
$exist_count = mysqli_fetch_row($query);
if($exist_count[0] < 1){
mysqli_close($db_conx);
echo "$user does not exist.";
exit();
}
if($_POST['action'] == "accept"){
$sql = "SELECT COUNT(id) FROM friends WHERE user1='$log_username' AND user2='$user' AND accepted='1' LIMIT 1";
$query = mysqli_query($db_conx, $sql);
$row_count1 = mysqli_fetch_row($query);
$sql = "SELECT COUNT(id) FROM friends WHERE user1='$user' AND user2='$log_username' AND accepted='1' LIMIT 1";
$query = mysqli_query($db_conx, $sql);
$row_count2 = mysqli_fetch_row($query);
   if ($row_count1[0] > 0 || $row_count2[0] > 0) {
   mysqli_close($db_conx);
       echo "You are already friends with $user.";
       exit();
   } else {
$sql = "UPDATE friends SET accepted='1' WHERE id='$reqid' AND user1='$user' AND user2='$log_username' LIMIT 1";
$query = mysqli_query($db_conx, $sql);
mysqli_close($db_conx);
       echo "accept_ok";
       exit();
}
} else if($_POST['action'] == "reject"){
mysqli_query($db_conx, "DELETE FROM friends WHERE id='$reqid' AND user1='$user' AND user2='$log_username' AND accepted='0' LIMIT 1");
mysqli_close($db_conx);
echo "reject_ok";
exit();
}
echo "kdnkldnb";
}

?>