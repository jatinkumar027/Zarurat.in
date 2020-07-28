var toggle4=1;
function show_profile_menu()
{
	if (toggle4) 
	{
		document.getElementsByClassName('profile-menu')[0].style.display='block';
		toggle4=0;
	}
	else
	{
		document.getElementsByClassName('profile-menu')[0].style.display='none';
		toggle4 = 1;
	}
}
function show_change_password_popup()
{
	document.getElementsByClassName('change-password-popup')[0].style.display='block';
}	
function hide_change_password_popup()
{
	document.getElementsByClassName('change-password-popup')[0].style.display='none';
}	