var options = new Array();
function showOnlyOneOption()
{
	var x = document.getElementsByClassName("options");
	var i=0;
	var j=0;
	for(i=0;i<x.length;i+=4)
	{
		x[i].style.display="block";
		options[j] = 1;
		j++;
	}
}
function addOption(index)
{
	if(options[index]!=4)
	{

		document.getElementsByClassName("options")[index*4+options[index]].style.display="block";
		document.getElementsByClassName("minus-icon")[index].style.display="block";
		options[index]++;
		if(options[index]==4)
			document.getElementsByClassName("add-icon")[index].style.display="none";
	}
	
}
function hideOption(index)
{
	var mrp = document.getElementsByClassName("mrp");
	var sp = document.getElementsByClassName("sp");
	var quantity = document.getElementsByClassName("quantity"); 
	if(options[index]!=1)
	{
		options[index]--;
		document.getElementsByClassName("options")[index*4+options[index]].style.display="none";
		mrp[index*4+options[index]].value = "";
		sp[index*4+options[index]].value = "";
		quantity[index*4+options[index]].value = "";
		document.getElementsByClassName("add-icon")[index].style.display="block";
		if(options[index]==1)
			document.getElementsByClassName("minus-icon")[index].style.display="none";
	}
}

function onChecboxSelected(index)
{
	var x = document.getElementsByClassName("product");
	var y = document.getElementsByClassName("select-item");

	if(y[index].checked)
		{
			x[index].style.border="1.5px solid #2ecc71";
			x[index].style.boxShadow="0px 0px 3px 0px #2ecc71";
		}
	else {
		x[index].style.border="1.5px solid black";
		x[index].style.boxShadow="0px 0px 0px 0px black";
	}
}
function countSelectedItems()
{
	var x = document.getElementsByClassName("product");
	var count = 0;
	var y = document.getElementsByClassName("select-item");
	var i;
	for(i=0;i<y.length;i++)
	{
		if(y[i].checked)
		{	
			count++;
			x[i].style.border="1.5px solid #2ecc71";
			x[i].style.boxShadow="0px 0px 3px 0px #2ecc71";
		}

	}
	document.getElementById("count-selected-items").innerHTML = count;
}

function enableDisable(index)
{
	var x = document.getElementsByClassName("option-input-style");
	var s = document.getElementsByClassName("select-field");
	var i=0;
	var y = document.getElementsByClassName("select-item");
	if(y[index].checked)
	{
		for(i=0;i<12;i++)
		{
			x[12*index + i].disabled = false;
		}
		for(i=0;i<8;i++)
		{
			s[8*index + i].disabled = false;
		}
	}
	else{
		for(i=0;i<12;i++)
		{
			x[12*index + i].disabled = true;
		}
		for(i=0;i<8;i++)
		{
			s[8*index + i].disabled = true;
		}
	}
}
