function emptyElement(x){
	_(x).innerHTML = "";
}
function login(){
	var e = _("user").value;
	var p = _("password").value;
	if(e == "" || p == ""){
		_("lstatus").innerHTML = "Fill out all of the form data";
	} else {
		_("loginbtn").style.display = "none";
		_("lstatus").innerHTML = 'please wait ...';
		var ajax = ajaxObj("POST", "login_check.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            if(ajax.responseText =="login_failed"){
					_("lstatus").innerHTML = "Login unsuccessful, please try again.";
					_("loginbtn").style.display = "block";
				} 
				else {
					
					window.location = "users.php?u="+ajax.responseText;
				}
	        }
        }
        ajax.send("e="+e+"&p="+p);
	}
}
