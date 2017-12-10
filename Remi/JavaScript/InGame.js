	var redImena = document.getElementById("prviRed");
	var redBodova = document.getElementById("drugiRed");
	var celija1;
	var celija2;
	var kljuc = "Igrac ";
	var brojac = 0;
	var celijaRunda = redBodova.insertCell(0);
	celijaRunda.innerHTML = brojac;

	for(var i = 0; i < sessionStorage.length; i++){

		celija1 = redImena.insertCell(i+1);
		celija2 = redBodova.insertCell(i+1);

		celija1.innerHTML = sessionStorage.getItem(kljuc+(i+1));
		celija2.innerHTML = 0;
	}

	var duzinaSkladista = sessionStorage.length;

	var players = document.getElementsByClassName("igrac");

	var kljuc = "Igrac ";

	for(var i = 0; i < sessionStorage.length; i++){

		players[i].type = "text";
		players[i].placeholder = sessionStorage.getItem(kljuc + (i+1));
	}

	for(var i = 0; i < sessionStorage.length; i++){

		players[i].onblur = validateBodovi;
	}

function validateBodovi(e){

	var element = e.target;
	var valid = true;

	if(element == null){

		element = e;
	}
	var regexNumbers = /^-?\d*\.?\d*$/;

	if(!regexNumbers.test(element.value))
		valid = false;

	if(element.value == "")
		valid = false;	

	if(!valid)
		element.classList.add("error");
	else
		element.classList.remove("error");


	return valid;
}

function onclickValidateBodovi(){

	for(var i = 0; i < sessionStorage.length; i++){

		var valid = true;

		if(!validateBodovi(players[i]))
			valid = false;
	}

	if(valid){

		dodavaljeBodova();
	}
}


function dodavaljeBodova(){
		brojac++;

	for(var i = 0; i < sessionStorage.length; i++){

		redBodova.cells[i+1].innerHTML = parseInt(players[i].value) + parseInt(redBodova.cells[i+1].innerHTML);
		redBodova.cells[0].innerHTML = brojac;

		players[i].value = "";
	}
}

function buttonExit(){

	for(var i = 0; i < duzinaSkladista; i++){

		sessionStorage.removeItem(kljuc+(i+1));
	}

	location.href="index.html";
}
