
var elementi = document.getElementsByTagName("input");


for(var i = 0; i < elementi.length; i++){

	if(elementi[i].Type != 'submit'){
	
		elementi[i].onblur = validateInput;
	}
}

function validateInput(e){

	var element = e.target;
	var valid = true;

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

function onclickValidate(){

	var valid = true;

	for(var i = 0; i < elementi.length; i++){

		if(elementi[i].type != "submit"){

			if(!validateInput(elementi[i]))
				valid = false;
		}
	}	

	return valid;
}
