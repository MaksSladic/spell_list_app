function allSpellsOfCharacter()
{
	var xmlhttp = new XMLHttpRequest();										// ustvarimo HTTP zahtevo
	var urlParams = new URLSearchParams(window.location.search);

    var CharacterName = urlParams.get('CharacterName');
    
    var UserName = urlParams.get('UserName');
    

	xmlhttp.onreadystatechange = function()									// določimo odziv v primeru različnih razpletov komunikacije
	{
		if (this.readyState == 4 && this.status == 200)						// zahteva je bila uspešno poslana, prišel je odgovor 201
		{
            try{
                console.log(this.responseText);
                odgovor = JSON.parse(this.responseText);
                console.log(odgovor);
                SpellsOfCharacter = odgovor[1];
                IDofCharacter = odgovor[0];
                console.log("ID: ",IDofCharacter);
                UpdateAction();
            }
            catch(e){
                console.log("Napaka pri razčlenjevanju podatkov");
            }		
		}
	};
	 
	xmlhttp.open("GET", "http://localhost/spell_list_app/characters/"+CharacterName+"/"+UserName, true);							// določimo metodo in URL zahteve, izberemo asinhrono zahtevo (true)
	xmlhttp.send();													// priložimo podatke in izvedemo zahtevo
}

function allSpells(level)
{
	var xmlhttp = new XMLHttpRequest();										
	 
	xmlhttp.onreadystatechange = function()									
	{
		if (this.readyState == 4 && this.status == 200)						
		{
            try{
                var SpellList = [];
                var podatki = JSON.parse(this.responseText);
                for(let i=0;i<podatki.length;i++)
                {
                    if(SpellsOfCharacter.includes(podatki[i].SpellName))
                    {
                        SpellList.push(podatki[i]);
                        console.log(podatki[i]);
                    }    
                }
                if(SpellList.length==0)
                {
                    const spell = 
                    {
                        SpellName: "No spells of this level.",
                        SpellCastingTime: "",
                        SpellComponents: "",
                        SpellConcentration: "",
                        SpellCuration: "",
                        SpellRange: "",
                        SpellRitual: "",
                        SpellSchool: ""
                    };
                    SpellList.push(spell);
                }
                prikaziPodatke(SpellList);   
            }
            catch(e){
                console.log("Napaka pri razčlenjevanju podatkov");
            }		
		}
	};
	 
	xmlhttp.open("GET", "http://localhost/spell_list_app/spells/"+level, true);						
	xmlhttp.send();													
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
                a.href = "../spell.php/?SpellName="+spellName;
                td.appendChild(a);
                tr.appendChild(td);	
            }
            else
            {
                td.innerHTML = odgovorJSON[i][stolpec];
                tr.appendChild(td);	
            }
            							
        }
        if(odgovorJSON[i]["SpellName"] != "No spells of this level.")
        {
            var buttonTd = document.createElement("td");
            var button = document.createElement("button");
            button.innerHTML = "Delete";
            button.value = odgovorJSON[i]["SpellName"];
            button.style.color = "red";
            button.style.backgroundColor = "transparent";
            button.style.border = "none";
            button.style.padding = "0";
            button.style.margin = "0";
            button.addEventListener("click", function(event) {
                RemoveSpell(event.target.value);
              });
            buttonTd.appendChild(button);
            tr.appendChild(buttonTd);
        }
        else
        {
            var buttonTd = document.createElement("td");
            var button = document.createElement("button");
            button.style.color = "transparent";
            button.style.backgroundColor = "transparent";
            button.style.border = "none";
            button.style.padding = "0";
            button.style.margin = "0";
            buttonTd.appendChild(button);
            tr.appendChild(buttonTd);
        }
        
        fragment.appendChild(tr);		       					// Vrstico tabele dodamo v fragment.
    }
    document.getElementById("Tableofspells").innerHTML="";
    document.getElementById("Tableofspells").appendChild(fragment);	// Fragment dodamo v obstoječo tabelo.
} 

function CharacterName()
{
    var urlParams = new URLSearchParams(window.location.search);

    var CharacterName = urlParams.get('CharacterName');

    document.getElementById("CharacterName").innerHTML=""+CharacterName;
}

function UpdateAction()
{
    var urlParams = new URLSearchParams(window.location.search);
    var edit = document.getElementById("EditCharacterButton");
    var newActionEdit = "../EditCharacter.php/?CharacterID="+IDofCharacter+"&CharacterName="+urlParams.get('CharacterName');
    edit.action = newActionEdit;

    var addspells = document.getElementById("AddspellsButton");
    var newActionAdd = "../AllSpellsAdd.php/?UserName="+urlParams.get('UserName')+"&CharacterName="+urlParams.get('CharacterName');
    addspells.action = newActionAdd;
}

function RemoveSpell(SpellName)
{
    var xmlhttp = new XMLHttpRequest();										
        
    xmlhttp.onreadystatechange = function()									
    {
        if (this.readyState == 4 && this.status == 204)						
        {
            location.reload(true);
        }
    };
    xmlhttp.open("DELETE", "http://localhost/spell_list_app/characters/"+IDofCharacter+"/"+SpellName, true);						
    xmlhttp.send();	
}

function DeleteCharacter()
{
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function()									
    {
        if (this.readyState == 4 && this.status == 204)						
        {
            console.log("Character deleted");
        }
        else
        {
            console.log("Nekej ne dela.");
        }
    };
    xmlhttp.open("DELETE", "http://localhost/spell_list_app/characters/"+IDofCharacter+"/DELETE", true);						
    xmlhttp.send();	
}