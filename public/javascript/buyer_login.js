function showSigninForm()
{
		var x=document.getElementsByClassName("hide");
		x[0].style.display="none";
		x[1].style.display="none";
		x[2].style.display="none";
		document.getElementById("back-icon-container").style.display="block";
		document.getElementById("signin-form").style.display="block";
		document.getElementById("signup-form").style.display="none";
		document.getElementById("message").innerHTML='';

}
function showSignupForm()
{
		var x=document.getElementsByClassName("hide");
		x[0].style.display="none";
		x[1].style.display="none";
		x[2].style.display="none";
		document.getElementById("signin-form").style.display="none";
		document.getElementById("signup-form").style.display="block";
		document.getElementById("back-icon-container").style.display="block";
		document.getElementById("message").innerHTML='';
}
function hideBackIcon()
{
	document.getElementById("back-icon-container").style.display="none";
	var x=document.getElementsByClassName("hide");
		x[0].style.display="block";
		x[1].style.display="block";
		x[2].style.display="block";
		document.getElementById("signin-form").style.display="none";
		document.getElementById("signup-form").style.display="none";
}
