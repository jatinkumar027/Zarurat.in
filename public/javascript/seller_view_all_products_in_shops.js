function optionDeletionConfirmation()
{
	var x = confirm("Are you sure option will be permanently deleted.");
	if(x)
		return true;
	else return false;
}
function productDeletionConfirmation()
{
	var x = confirm("Are you sure Product will be permanently deleted.");
	if(x)
		return true;
	else return false;
}
function submitOptionForm(num)
{
	
	var id = 'option-form'+num;
	var x = document.getElementById(id).getElementsByClassName("input-style");
	var i = 0;
	var control = 1;
	for(i=0;i<x.length;i++)
	{
		if(x[i].value == '')
		{
			control = 0;
			alert('input field can not be empty !');
			return false;
		}
		
	}
	if(control == 1)
	{
		document.getElementById(id).submit();
		return true;
	}
	
}

var interval;
var top_value = 50;
function timer_on()
{
	interval=setInterval(Timer,100);
}
function Timer()
{     
	document.getElementsByClassName("success-pop-up")[0].style.transition="background 3000ms linear";
	document.getElementsByClassName("success-pop-up")[0].style.background="transparent";
				
	top_value = top_value+1;
	var temp = top_value+"%";
	document.getElementsByClassName("success-pop-up")[0].style.top=temp;

	if(top_value == 70)
	{
	clearTimeout(interval);
	document.getElementsByClassName("success-pop-up")[0].style.display="none";
	}

	
} 
function show_success(color)
{
	var x = document.getElementsByClassName("success-pop-up");
	x[0].style.display="block";
	x[0].style.background = color;
}
function enableInputField(index)
{
	document.getElementsByClassName("edit-icon")[index-1].style.display = "none";
	var id = 'option-form'+index;
	var x = document.getElementById(id).getElementsByClassName("input-style");
	document.getElementById(id).getElementsByClassName("unit-picker")[0].disabled = false;
	document.getElementById(id).getElementsByClassName("unit-picker")[0].style.cursor = "default";
	var i = 0;
	for(i=0;i<x.length;i++)
	{
		x[i].disabled = false;
		x[i].style.border = "1px solid blue";
		x[i].style.cursor = "default";
	}
	document.getElementsByClassName("update-icon")[index-1].style.display = "block";
}