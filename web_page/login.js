/**
 * Pridobi podatke iz obrazca in jih vrne v obliki JSON objekta.
 * @param  {HTMLFormControlsCollection} elements  Elementi obrazca
 * @return {Object}                               Object literal
 */
const formToJSON = elements => [].reduce.call(elements, (data, element) => 
{
	if(element.name!="")
	{
		data[element.name] = element.value;
	}
  return data;
}, {});
 
function login()
{
	const data = formToJSON(document.getElementById("form").elements);	// vsebino obrazca pretvorimo v objekt
	var JSONdata = JSON.stringify(data, null, "  ");						// objekt pretvorimo v znakovni niz v formatu JSON
	
	var xmlhttp = new XMLHttpRequest();										// ustvarimo HTTP zahtevo
	 
	xmlhttp.onreadystatechange = function()									// določimo odziv v primeru različnih razpletov komunikacije
	{
		if (this.readyState == 4 && this.status == 200)						// zahteva je bila uspešno poslana, prišel je odgovor 201
		{
			document.getElementById("response").innerHTML="Logiranje uspelo!";
		}
		if(this.readyState == 4 && this.status == 409)						// zahteva je bila uspešno poslana, prišel je odgovor, ki ni 201
		{
			document.getElementById("response").innerHTML="Username or password don't match!: "+this.status;
		}
        if(this.readyState == 4 && this.status != 409 && this.status != 200)
		{
			document.getElementById("response").innerHTML="Napaka: "+this.status;
		}
	};
	 
	xmlhttp.open("POST", "http://localhost/spell_list_app/login", true);							// določimo metodo in URL zahteve, izberemo asinhrono zahtevo (true)
	xmlhttp.send(JSONdata);													// priložimo podatke in izvedemo zahtevo
}