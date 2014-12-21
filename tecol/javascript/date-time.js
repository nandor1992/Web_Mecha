// JavaScript Document
<!--
var dateCell = document.getElementById("dateCell");

var months = new Array(
	"Jan", "Feb", "Mar", 
	"Apr", "May", "Jun", 
	"Jul", "Aug", "Sep", 
	"Oct", "Nov", "Dec");

function lZero(value)
{
	if (value < 10)
	{
		return "0" + value;
	}

	return value;
}

function tick()
{
	var date = new Date();

	dateCell.innerHTML = 
		lZero(date.getDate()) + " " +
		months[date.getMonth()] + " " + 
		date.getFullYear() + " / "+
		lZero(date.getHours()) + ":" + 
		lZero(date.getMinutes()) + ":" + 
		lZero(date.getSeconds());

		

	setTimeout("tick()", 1000);
}

tick();
			//-->