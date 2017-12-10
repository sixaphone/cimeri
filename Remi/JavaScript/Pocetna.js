var elementi = document.getElementsByClassName("tekstovi");

for(var i = 0; i < elementi.length; i++){

	if(elementi[i].id == "divUvod")
		elementi[i].style.display = "block";
	else
		elementi[i].style.display = "none";
}

function dugme(textID, divID){

	for(var i = 0; i < elementi.length; i++){

		if(elementi[i].id == divID)
			elementi[i].style.display = "block";
		else
			elementi[i].style.display = "none";
	}
}