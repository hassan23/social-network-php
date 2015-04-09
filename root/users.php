<?php
include_once("php_includes/check_login_status.php");
// Initialize any variables that the page might echo
$u = "";
$sex = "Male";
$userlevel = "";
$profile_pic = "";
$profile_pic_btn = "";
$avatar_form = "";
$country = "";
$joindate = "";
$lastsession = "";
// Make sure the _GET username is set, and sanitize it
if(isset($_GET["u"])){
	$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
} else {
    header("location:aaaaaaaaaa");
    exit();	
}
// Select the member from the users table
$sql = "SELECT * FROM users WHERE username='$u' AND activated='1' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
// Now make sure that user exists in the table
$numrows = mysqli_num_rows($user_query);
if($numrows < 1){
	echo "That user does not exist or is not yet activated, press back";
    exit();	
}
// Check to see if the viewer is the account owner
$isOwner = "no";
if($u == $log_username && $user_ok == true){
	$isOwner = "yes";
$avatar_form  = '<form id="avatar_form" enctype="multipart/form-data" method="post" action="php_parser/photo_system.php">';
$avatar_form .=   '<div id="change">Change your picture</div>';
$avatar_form .=   '<input id="pchoose" type="file" name="avatar" required>';
$avatar_form .=   '<p><input id="pupload" type="submit" value="Upload"></p>';
$avatar_form .= '</form>';
}

// Fetch the user row from the query above
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
	$profile_id = $row["id"];
	$gender = $row["gender"];
	$country = $row["country"];
	$userlevel = $row["userlevel"];
	$avatar = $row["avatar"];
	$signup = $row["signup"];
	$lastlogin = $row["lastlogin"];
	$joindate = strftime("%b %d, %Y", strtotime($signup));
	$lastsession = strftime("%b %d, %Y", strtotime($lastlogin));
	if($gender == "f"){
		$sex = "Female";
	}
	$profile_pic = '<div id="propic"><img src="user/'.$u.'/'.$avatar.'" alt="'.$u.'"></div>';
if($avatar == NULL){
$profile_pic = '<div id="propic"><img src="images/default.png" alt="'.$u.'"></div>';
}
}
?>
<?php
$isFriend = false;
$ownerBlockViewer = false;
$viewerBlockOwner = false;
if($u != $log_username && $user_ok == true){
$friend_check = "SELECT id FROM friends WHERE user1='$log_username' AND user2='$u' AND accepted='1' OR user1='$u' AND user2='$log_username' AND accepted='1' LIMIT 1";
if(mysqli_num_rows(mysqli_query($db_conx, $friend_check)) > 0){
        $isFriend = true;
    }
    }
?>
<?php 
$friend_button = '';
if($isFriend == true){
$friend_button = '<button id="friendBtn" onclick="friendToggle(\'unfriend\',\''.$u.'\',\'friendBtn\')">Unfriend</button>';
} else if($user_ok == true && $u != $log_username && $ownerBlockViewer == false){
$friend_button = '<button id="friendBtn" onclick="friendToggle(\'friend\',\''.$u.'\',\'friendBtn\')">Request As Friend</button>';
}
?>
<?php
$friendsHTML = '';
$friends_view_all_link = '';
$sql = "SELECT COUNT(id) FROM friends WHERE user1='$u' AND accepted='1' OR user2='$u' AND accepted='1'";
$query = mysqli_query($db_conx, $sql);
$query_count = mysqli_fetch_row($query);
$friend_count = $query_count[0];
if($friend_count < 1){
$friendsHTML = $u." has no friends yet";
} else {
$max = 18;
$all_friends = array();
$sql = "SELECT user1 FROM friends WHERE user2='$u' AND accepted='1' ORDER BY RAND() LIMIT $max";
$query = mysqli_query($db_conx, $sql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
array_push($all_friends, $row["user1"]);
}
$sql = "SELECT user2 FROM friends WHERE user1='$u' AND accepted='1' ORDER BY RAND() LIMIT $max";
$query = mysqli_query($db_conx, $sql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
array_push($all_friends, $row["user2"]);
}
$friendArrayCount = count($all_friends);
if($friendArrayCount > $max){
array_splice($all_friends, $max);
}
if($friend_count > $max){
$friends_view_all_link = '<a href="view_friends.php?u='.$u.'">view all</a>';
}
$orLogic = '';
foreach($all_friends as $key => $user){
$orLogic .= "username='$user' OR ";
}
$orLogic = chop($orLogic, "OR ");
$sql = "SELECT username, avatar FROM users WHERE $orLogic";
$query = mysqli_query($db_conx, $sql);
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
$friend_username = $row["username"];
$friend_avatar = $row["avatar"];
if($friend_avatar != ""){
$friend_pic = 'user/'.$friend_username.'/'.$friend_avatar.'';
} else {
$friend_pic = 'images/default.png';
}
$friendsHTML .= '<a href="users.php?u='.$friend_username.'"><img class="friendpics" src="'.$friend_pic.'" alt="'.$friend_username.'" title="'.$friend_username.'"></a>';
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<title><?php echo $u; ?></title>
<link rel="stylesheet" type="text/css" href="styles/style2.css">
<script src="java_script/main.js"></script>
<script src="java_script/ajax.js"></script>
<script src="java_script/jquery.js"></script>
<script>
$(document).ready(function(){
$('#friends').hide();
$('#pupload').hide();
$('#pchoose').hide();
$('#bbtn').click(function(){
	$('#friends').fadeOut();
	$('#bio').fadeIn();
	});
	$('#fbtn').click(function(){
	$('#friends').fadeIn();
	$('#bio').fadeOut();
	});
	$('#change').click(function(){
	$('#pupload').fadeToggle();
    $('#pchoose').fadeToggle();
	});
});
</script>

<script>
function to_user(){
	var user = _("ser").value;
	var ajax = ajaxObj("POST", "search_user.php");
	ajax.onreadystatechange = function() {
	if(ajaxReturn(ajax) == true) {
if(ajax.responseText == "ok") {
	_("ser").value="sorry user doesn't exist";
}
if(ajax.responseText != "ok") {

window.location='users.php?u='+user;
}
}

}
ajax.send("user="+user);
}

function friendToggle(type,user,elem){
	
var conf = confirm("Press OK to confirm the '"+type+"' action for user <?php echo $u; ?>.");
if(conf != true){
return false;
}
_(elem).innerHTML = 'please wait ...';
var ajax = ajaxObj("POST", "php_parser/friend_system.php");
ajax.onreadystatechange = function() {
if(ajaxReturn(ajax) == true) {
if(ajax.responseText == "friend_request_sent"){
_(elem).innerHTML = 'OK Friend Request Sent';
} else if(ajax.responseText == "unfriend_ok"){
_(elem).innerHTML = '<button onclick="friendToggle(\'friend\',\'<?php echo $u; ?>\',\'friendBtn\')">Request As Friend</button>';
} else {
alert(ajax.responseText);
_(elem).innerHTML = 'Try again later';
}
}
}
ajax.send("type="+type+"&user="+user);
}
</script>
</head>
<body>

<div id="pageMiddle">
<div id="profile_pic_box"><?php echo $profile_pic_btn; ?><?php echo $avatar_form; ?><?php echo $profile_pic; ?></div>
  <div><h3 id="user_name"><?php echo $u; ?><input type="button" value="Friends" id="fbtn" class="list"><input type="button" id="bbtn" value="Bio" class="list"></h3></div>
 <div id="bio">
  <p>Gender: <?php echo $sex; ?></p>
  <p>Country: <?php echo $country; ?></p>
  <p>User Level: <?php echo $userlevel; ?></p>
  <p>Join Date: <?php echo $joindate; ?></p>
  <p>Last Session: <?php echo $lastsession; ?></p></div>
<div id="friends"><p><span><?php echo $friend_button; ?></span> <span id="count"><?php echo $u." has ".$friend_count." friends"; ?> <?php echo $friends_view_all_link; ?></p></p></span>
<hr />
  <p><?php echo $friendsHTML; ?></p></div>
    <div  id="statusd"><?php include_once("template_status.php"); ?></div></div>
<?php include_once("template_pageTop.php"); ?>
</body>
</html>
