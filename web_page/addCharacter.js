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
	var i = 1;
	if(podatki[1]!="No characters have been created")
	{
		for(i = 1; i < charactersNUM && i <= 12; i++)
		{
			pos = "pos"+i;
			var fragment = document.createDocumentFragment();
			
			// create the elements
			const a = document.createElement("a");
			const div = document.createElement("div");
			// const img = document.createElement("img");
			const divCardBody = document.createElement("div");
			const p = document.createElement("p");

			// set the attributes
			div.setAttribute("class", "card");
			// img.setAttribute("class", "card-img-top");
			// img.setAttribute("alt", "Card image cap");
			divCardBody.setAttribute("class", "card-body");
			p.setAttribute("class", "card-text text-center");
			p.innerHTML = podatki[i].CharacterName;
			a.href = "character.php/?CharacterName="+podatki[i].CharacterName+"&UserName="+getCookieValue("UserName");

			// append the elements
			a.appendChild(div);
			// div.appendChild(img);
			div.appendChild(divCardBody);
			divCardBody.appendChild(p);

			fragment.appendChild(a);

			document.getElementById(pos).appendChild(fragment);
			
		}
	}

	pos = "pos"+i;
	var fragment = document.createDocumentFragment();
	
	// create the elements
	const a = document.createElement("a");
	const div = document.createElement("div");
	// const img = document.createElement("img");
	const divCardBody = document.createElement("div");
	const p = document.createElement("p");

	// set the attributes
	div.setAttribute("class", "card");
	// img.setAttribute("class", "card-img-top");
	// img.setAttribute("alt", "Card image cap");
	divCardBody.setAttribute("class", "card-body");
	p.setAttribute("class", "card-text text-center");
	p.innerHTML = "Add new";
	a.href = "NewCharacter.php";

	// append the elements
	a.appendChild(div);
	// div.appendChild(img);
	div.appendChild(divCardBody);
	divCardBody.appendChild(p);

	fragment.appendChild(a);

	document.getElementById(pos).appendChild(fragment);


}