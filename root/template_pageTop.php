<div id="head">
<div id="searchu"><input type="text" id="ser" name="ser" list="datalist1" />
<input type="submit" value="search" id="srch" onclick="to_user()" /></div>

<a id="out" href="logout.php">logout</a>
<a id="note" href="notification.php">notification</a>
<a id="name" href="users.php?u=<?php if(isset($_SESSION['username'])){ echo $_SESSION['username']; }else{echo $u;}?>">
<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}else{echo $u;}?></a>

<div id="logo">
<a id="l" href="login.php"><span id="s">s </span><span id="b">b</span></a>

</div>

</div>
<!--<div id="bottom">
Copyright &copy; social book.inc
</div>-->

