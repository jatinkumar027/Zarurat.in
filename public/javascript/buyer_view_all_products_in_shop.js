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
