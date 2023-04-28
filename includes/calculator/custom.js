function setpicimage(l,w)
{
	document.getElementById("xlength").innerText = l + ' Ft';
	document.getElementById("ylength").innerText = w + ' Ft';
}
	
function calculate()
{
	var SLength=document.getElementById("SLength").value;
	var SWidth=document.getElementById("SWidth").value;

	setpicimage(SLength,SWidth);

	document.getElementById("ar_feet").value = parseFloat(SLength)*parseFloat(SWidth);

	var ar_mtr = parseFloat((parseFloat(SLength)*parseFloat(SWidth))/(3.28*3.28),3);
	var ar_mtr = ar_mtr.toFixed(2);
	document.getElementById("ar_mtr").value = ar_mtr;
	
	var tileSize = document.getElementById("sizes").value;
	var tilesinbox;

	tilesinbox = document.getElementById("sizes").options[document.getElementById("sizes").selectedIndex].dataset.picperbox;
	
	if (tileSize.indexOf("mm")>0) tileSize = tileSize.substr(0,tileSize.indexOf("mm"));
	tileCoords=tileSize.split("x");
	sLength=SLength*304.8;
	sWidth=SWidth*304.8;
	var doorSize, winSize;
	var TileArea = (parseFloat(sLength)*parseFloat(sWidth));

	xVal=tileCoords[0];
	yVal=tileCoords[1];

	var tileSize = (parseFloat(xVal) * parseFloat(yVal));
	var TotalTilesRequired = TileArea/tileSize;
	if ((TotalTilesRequired-Math.round(TotalTilesRequired))>0) 
		TotalTilesRequired=Math.round(TotalTilesRequired)+1;
	else
		TotalTilesRequired=Math.round(TotalTilesRequired,0);
	document.getElementById("TotalTiles").value = TotalTilesRequired;
	
	var boxcount = parseFloat(TotalTilesRequired/ tilesinbox );
	
	if ((boxcount-Math.round(boxcount))>0) 
	{
		boxcount=Math.round(boxcount)+1;
	}
	else
	{
		boxcount=Math.round(boxcount,0);
	}
	document.getElementById("TotalBoxes").value = boxcount;
}