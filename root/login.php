<?php
session_start();
// If user is logged in, header them away
if(isset($_SESSION["username"])){
	header("location: users.php?u=".$_SESSION["username"]);
    exit();
}
?>
<html>
<head>
<meta content="utf/8"/>
<title>my network</title>
<link rel="stylesheet" type="text/css" href="styles/style1.css">
<script type="text/javascript" src="java_script/main.js" ></script>
<script type="text/javascript" src="java_script/ajax.js" ></script>
<script type="text/javascript" src="java_script/sign_check.js" ></script>
<script type="text/javascript" src="java_script/expand.js" ></script>
<script type="text/javascript" src="java_script/log_in.js" ></script>

</head>
<body>
<div id="head">
<div id="logobox">
<span class="logo" id="a">S</span><span class="logo" id="b">o</span><span id="c" class="logo">c</span><span id="d" class="logo">i</span><span id="e"  class="logo">a</span><span id="f" class="logo">l  </span><span id="g" class="logo">B</span><span id="h" class="logo">o</span><span id="i" class="logo">o</span><span id="j" class="logo">k</span>
</div>
<div id="logindiv"/>
 <form id="loginform" onSubmit="return false;">
<ul id="list"><li><input id="user" name="user" type="text" onFocus="emptyElement('status')" placeholder="email"/></li>
<li><input id="password" name="password" type="password" onFocus="emptyElement('status')" placeholder="password"/></li>
<li><input type="submit" id="loginbtn" name="loginbtn" onClick="login()" value="login"/><p id="lstatus"></p></li>
</ul>
</form>
</div>
</div>
<div id="pageMiddle">
<div id="signhead">Sign Up<br/>Now</div>

<form name="signupform" id="signupform" onSubmit="return false;">
<span class="g" id="gen">Gender:</span>
     
     
     <select class="g" id="gender" onFocus="emptyElement('status')">
       <option value=""></option>
       <option value="m">Male</option>
      <option value="f">Female</option>
    </select>
	 <span class="g" id="con">Country:</span>
     <select class="g" id="country" onFocus="emptyElement('status')">
	 <option value=""></option>
       <option value="india">india</option>
      <option value="australia">australia</option>
          </select>
  <ul id="signup">
  
    <li class="uname">Username:</li> 
    <li><input id="username" type="text" onBlur="checkusername()" onKeyUp="restrict('username')" maxlength="16">
    <span id="unamestatus"></span></li>
	<li id="mail" class="uname">Email Address:</li>
<li><input id="email" type="text" onFocus="emptyElement('status')" onKeyUp="restrict('email')" maxlength="88"></li>
	 
     <li class="passw">Create Password:</li> 
     <li><input id="pass1" type="password" onFocus="emptyElement('status')" maxlength="16"></li>
	 <li class="passw">Confirm Password:</li>
     <li><input id="pass2" type="password" onFocus="emptyElement('status')" maxlength="16"></li></ul> 
     
     
     <button id="signupbtn" onClick="signup()">sign up</button>
     <span id="status"></span>
  </form>
 </div>
</body>
</html>
