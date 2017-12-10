
 var elementi = document.getElementsByTagName("input");
 var textBox = document.getElementById("opis");

function validate(e){

	var valid = true;

	if(e.value == "")
		valid = false;

	if(e.id == "name" || e.id == "LName"){

		var regexLetters = /[a-zA-Z]/;

		if(regexLetters.test(e.value) == false)
			valid = false;
	}

	if(e.id == "mail"){

		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		if(re.test(e.value) == false)
			valid = false;
	}

	if(!valid)
		e.classList.add("error");
	else
		e.classList.remove("error");

	return valid;
}

function onclickValidate(){

	var valid = true;

	for(var i = 0; i < elementi.length; i++){

		if(validate(elementi[i]) == false || validate(textBox) == false)
			valid = false;
	}

	return valid;
}