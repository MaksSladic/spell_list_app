function allSpells(level)
{
	var xmlhttp = new XMLHttpRequest();										// ustvarimo HTTP zahtevo
	 
	xmlhttp.onreadystatechange = function()									// določimo odziv v primeru različnih razpletov komunikacije
	{
		if (this.readyState == 4 && this.status == 200)						// zahteva je bila uspešno poslana, prišel je odgovor 201
		{
            try{
                var podatki = JSON.parse(this.responseText);
                console.log(podatki);
                prikaziPodatke(podatki);   
            }
            catch(e){
                console.log("Napaka pri razčlenjevanju podatkov");
            }		
		}
	};
	 
	xmlhttp.open("GET", "http://localhost/spell_list_app/spells/"+level, true);							// določimo metodo in URL zahteve, izberemo asinhrono zahtevo (true)
	xmlhttp.send();													// priložimo podatke in izvedemo zahtevo
}

function prikaziPodatke(odgovorJSON){
    var fragment = document.createDocumentFragment();		// Zaradi učinkovitosti uporabimo fragment.
 
    for (var i = 0; i < odgovorJSON.length; i++) {			// Za vsak objekt v JSONu ...
        var tr = document.createElement("tr");					// ... ustvarimo vrstico v tabeli (tr).
 
        for(var stolpec in odgovorJSON[i]){					
            var td = document.createElement("td");				
            if(stolpec == "SpellDuration" && odgovorJSON[i]["SpellConcentration"] == "C")
            {
                td.innerHTML = "Concentration up to " + odgovorJSON[i][stolpec];
                tr.appendChild(td);	
            }
            else if(stolpec == "SpellCastingTime" && odgovorJSON[i]["SpellRitual"] == "R")
            {
                ritual = '<sup>'+"R"+'</sup>';
                td.innerHTML = odgovorJSON[i][stolpec] + ritual;
                tr.appendChild(td);	
            }
            else if(stolpec == "SpellRitual" || stolpec == "SpellConcentration")
            {

            }
            else if(stolpec == "SpellComponents")
            {
                components = odgovorJSON[i][stolpec].split("(")[0];
                td.innerHTML = components;         
                tr.appendChild(td);	       
            }
            else if(stolpec == "SpellName")
            {
                spellName = odgovorJSON[i][stolpec];
                var a = document.createElement("a");
                var link = document.createTextNode(odgovorJSON[i][stolpec]);
                a.appendChild(link);
                a.title = spellName;
                a.href = "spell.php/?SpellName="+spellName;
                td.appendChild(a);
                tr.appendChild(td);	
            }
            else
            {
                td.innerHTML = odgovorJSON[i][stolpec];
                tr.appendChild(td);	
            }
            							
        }
        fragment.appendChild(tr);		       					// Vrstico tabele dodamo v fragment.
    }
    document.getElementById("Tableofspells").innerHTML="";
    document.getElementById("Tableofspells").appendChild(fragment);	// Fragment dodamo v obstoječo tabelo.
 } 