
var element = document.getElementById("brojIgraca");

var elementi = document.getElementsByClassName("igrac");

for(var i = 0; i < elementi.length; i++){

	elementi[i].onblur = validatePlayers;
}

function validateInput(){


	var valid = true;

	if(element.value == "")
		valid = false;
	if(element.value > 6 || element.value < 2)
		valid = false;

	var regexNumbers = /^-?\d*\.?\d*$/;

	if(!regexNumbers.test(element.value))
		valid = false;

	if(!valid){

		element.classList.add("error");		
		return false;
	}
	else{

		element.classList.remove("error");
		return true;
	}
}	

function validatePlayers(e){

	var element = e.target;

	if(element == null)
		element = e;

	var valid = true;

	if(element.value == ""){
		element.classList.add("error");
		valid = false;
	}

	else{
		element.classList.remove("error");
		valid = true;	
	}

	return valid;
}

function buttonValidate(id){

	validateInput(); //onClick validacija

	var valid = validateInput();

	for(var i = 0; i <elementi.length; i++){

		elementi[i].classList.remove("error");
	}

	if(valid){
		
		var inputFields = document.getElementsByClassName("igrac");
		var dugme = document.getElementById("pocetak");

		for(var i = 0; i < element.value; i++){
			
			inputFields[i].type = "text";
		}

		for(var i = element.value; i < 6; i++){

			inputFields[i].type = "hidden";
		}

		dugme.type = "submit";
	}
}

function buttonValidatePlayers(){

	var valid = false;

	for(var i = 0; i < elementi.length; i++){

		if(validatePlayers(elementi[i]))
			valid = true;
			
	}
	if(valid){

		storage();
        //console.log("uslo");
		location.href = "../html/runda.html";
	}
}

function storage(){

	var kljuc = "Igrac ";

	for(var i = 0; i < element.value; i++){
		window.sessionStorage.setItem(kljuc+(i+1), elementi[i].value);
        console.log(elementi[i]); 
	}
}