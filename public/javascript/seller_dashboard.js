function showShopTypes()
{
	
	document.getElementsByClassName("register-shop-btn")[0].style.display="none";
	document.getElementsByClassName("wrapper")[0].style.height="100%";
	document.getElementsByClassName("shop-type-container")[0].style.display="block";
}
function showShopDetails()
{
	document.getElementsByClassName("shop-details")[0].style.display="block";
	document.getElementsByClassName("shop-type-container")[0].style.display="none";
}
function goBackToShopType()
{
	document.getElementsByClassName("shop-details")[0].style.display="none";
	document.getElementsByClassName("shop-type-container")[0].style.display="block";
}
function goBackToShopDetails()
{
	document.getElementsByClassName("shop-details")[0].style.display="block";
	document.getElementsByClassName("bank-details")[0].style.display="none";
}
function showBankDetails()
{
	document.getElementsByClassName("shop-details")[0].style.display="none";
	document.getElementsByClassName("bank-details")[0].style.display="block";
}

function enableField()
{
	document.getElementById("country-field").disabled=false;
}
function disableField()
{
	document.getElementById("country-field").disabled=true;
}