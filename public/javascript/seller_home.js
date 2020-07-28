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
var i = 0;
function showHelp()
{
	document.getElementsByClassName('tab')[0].style.display = 'block';
	document.getElementById("gonext-btn").style.display = 'block';
	document.getElementById("top-pad").style.display = 'none';
	document.getElementById("help-written").style.display = 'block';
	document.getElementsByClassName("help-button")[0].style.display = 'none';
}
function goNext()
{
	if(i!=8)
	{
	i++;
	document.getElementsByClassName('tab')[i-1].style.display = 'none';
	document.getElementsByClassName('tab')[i].style.display = 'block';
	document.getElementById('goback-icon').style.display = 'block';
	if(i==8)
		document.getElementById('gonext-btn').style.display = 'none';
	}
	
}
function goBack()
{
	if(i!=0)
	{
	document.getElementsByClassName('tab')[i].style.display = 'none';
	document.getElementsByClassName('tab')[i-1].style.display = 'block';
	document.getElementById('gonext-btn').style.display = 'block';
	if(i==1)
		document.getElementById('goback-icon').style.display = 'none';
	i--;
	}
}