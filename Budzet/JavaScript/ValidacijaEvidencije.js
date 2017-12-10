
var unos = document.getElementById("Potroseno");
var cim = document.getElementById("Stanar");
var artikal = document.getElementById("Artikal");
var doplata = document.getElementById("Doplata");

unos.onblur = validatePotroseno;
cim.onblur = validateDodajCimera;
artikal.onblur = validateArtikal;
doplata.onblur = validateDoplata;

function validateDoplata(e){
	var valid = true;
	var element = e.target;
	var regexNumbers = /^-?\d*\.?\d*$/;

	if(element == null)
		element = e;

	if(element.value == "")
		valid = false;

	if(regexNumbers.test(element.value) == false)
		valid = false;

	if(!valid)
		element.classList.add("error");
	else
		element.classList.remove("error");

	return valid;
}

function validatePotroseno(e){

	var unosPotroseno = e.target;

	if(unosPotroseno == null)
		unosPotroseno = e;

	var valid = true;
	var regexNumbers = /^-?\d*\.?\d*$/;

	if(unosPotroseno.value == "")
		valid = false;
	if(unosPotroseno.value <= 0)
		valid = false;
	if(regexNumbers.test(unosPotroseno.value) == false)
		valid = false;

	if(!valid)
		unosPotroseno.classList.add("error");
	else
		unosPotroseno.classList.remove("error");

	return valid;
}

function validateDodajCimera(e){
	
	var valid = true;
	var cimer = e.target;

	if(cimer == null)
		cimer = e;

	var regexLetters = /^[a-zA-Z]*$/;

	if(cimer.value == "")
		valid = false;

	if(regexLetters.test(cimer.value) == false)
		valid = false;

	if(!valid)
		cimer.classList.add("error");
	else
		cimer.classList.remove("error");

	return valid;
}

function validateArtikal(e){

	var valid = true;
	var element = e.target;

	if(element == null)
		element = e;

	if(element.value == "")
		valid = false;

	if(!valid)
		element.classList.add("error");
	else
		element.classList.remove("error");

	return valid;
}

//onclick validacija

function onclickValidateUnos(){

	var valid = true;

	if(validatePotroseno(unos) == false)
		valid = false;

	return false;
}

function onclickValidateDodaj(){


	var valid = true;

	if(validateDodajCimera(cim) == false)
		valid = false;

	return false;
}

function onclickValidateArtikal(){


	var valid = true;

	if(validateArtikal(artikal) == false)
		valid = false;

	return false;
}

function onclickPlusici(){

	var valid = true;


		if(validateDoplata(doplata) == false)
			valid = false;

	return valid;
}