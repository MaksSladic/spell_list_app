function allCharacters()
{
	var xmlhttp = new XMLHttpRequest();
	
	var user = getCookieValue("UserName");
	 
	xmlhttp.onreadystatechange = function()									// določimo odziv v primeru različnih razpletov komunikacije
	{
		if (this.readyState == 4 && this.status == 200)						// zahteva je bila uspešno poslana, prišel je odgovor 201
		{
            try{
                var podatki = JSON.parse(this.responseText);
                console.log(podatki);
				displayCharacters(podatki);  
            }
            catch(e){
                console.log("Napaka pri razčlenjevanju podatkov");
            }		
		}
	};
	 
	xmlhttp.open("GET", "http://localhost/spell_list_app/users/"+user, true);							// določimo metodo in URL zahteve, izberemo asinhrono zahtevo (true)
	xmlhttp.send();													// priložimo podatke in izvedemo zahtevo
}

function displayCharacters(podatki)
{
	var charactersNUM = podatki.length;

	if(charactersNUM > 1)
	{
		for(let i = 1; i < charactersNUM; i++)
		{
			pos = "pos"+i;
			var fragment = document.createDocumentFragment();
			
			// create the elements
			const div = document.createElement("div");
			const img = document.createElement("img");
			const divCardBody = document.createElement("div");
			const p = document.createElement("p");

			// set the attributes
			div.setAttribute("class", "card");
			img.setAttribute("class", "card-img-top");
			img.setAttribute("alt", "Card image cap");
			p.setAttribute("class", "card-text");
			p.innerHTML = podatki[i].CharacterName;

			// append the elements
			div.appendChild(img);
			div.appendChild(divCardBody);
			divCardBody.appendChild(p);

			fragment.appendChild(div);

			document.getElementById(pos).appendChild(fragment);
			
		}
	}
}