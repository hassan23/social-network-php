<?php
$message = "";
$msg = preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);
if($msg == "activation_failure"){
	$message = '<h2>Activation Error</h2> Sorry, there seems to have been an issue activating your account.';
} else if($msg == "activation_success"){
	$message = '<h2>Activation Success</h2> Your account is now created.<br/> <a id="c_here" href="login.php">CLICK HERE </a><br/>to log in';
} else {
	$message = $msg;
}
?>
<html>
<head><title>activation message</title>
<link rel="stylesheet" type="text/css" href="styles/style1.css">

</head>
<body>
<div id="head">
<div id="logobox">
<span class="logo" id="a">S</span><span class="logo" id="b">o</span><span id="c" class="logo">c</span><span id="d" class="logo">i</span><span id="e"  class="logo">a</span><span id="f" class="logo">l  </span><span id="g" class="logo">B</span><span id="h" class="logo">o</span><span id="i" class="logo">o</span><span id="j" class="logo">k</span>
</div>
<div id="activation"><center><?php echo $message; ?></center></div>
<body>