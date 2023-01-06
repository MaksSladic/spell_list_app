
function spellName()
{
    const queryString = window.location.search;
    console.log(queryString); 
    
    const urlParams = new URLSearchParams(queryString);

    const SpellName = urlParams.get('SpellName');
    console.log("Spell Name is = ", SpellName);
    spellinfo(SpellName);
}

function spellinfo(SpellName)
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
	 
	xmlhttp.open("GET", "http://localhost/spell_list_app/spells/"+SpellName, true);							// določimo metodo in URL zahteve, izberemo asinhrono zahtevo (true)
	xmlhttp.send();	
}

function prikaziPodatke(odgovorJSON)
{
    
    var fragment = document.createDocumentFragment();	
    
    for(var stolpec in odgovorJSON[0])
    {
        var div = document.createElement("div");
        div.class = "col";
        console.log(stolpec);
        if(stolpec == "SpellName")
        {
            spellname = '<strong style=font-size:2.5em>' + odgovorJSON[0][stolpec] + '</strong>';
            div.innerHTML = spellname;
        }
        else if(stolpec == "SpellSchool")
        {
            div.innerHTML = "lvl" + odgovorJSON[0]["SpellLevel"] + " " + odgovorJSON[0][stolpec] + " spell";	
        }
        else if(stolpec == "SpellCastingTime")
        {
            output = '<strong>' + "Casting Time: " + '</strong>';
            if(odgovorJSON[0]["SpellRitual"] == "R")
            {
                ritual = '<sub>'+"(ritual)"+'</sub>';
                div.innerHTML = output + odgovorJSON[0][stolpec] + ritual;
            }
            else
            {
                div.innerHTML = output + odgovorJSON[0][stolpec];
            }

        }
        else if(stolpec == "SpellRange")
        {
            output = '<strong>' + "Range: " + '</strong>';
            div.innerHTML = output + odgovorJSON[0][stolpec];
        }
        else if(stolpec == "SpellComponents")
        {
            output = '<strong>' + "Components: " + '</strong>';
            div.innerHTML = output + odgovorJSON[0][stolpec];
        }
        else if(stolpec == "SpellDuration")
        {
            output = '<strong>' + "Duration: " + '</strong>';
            if(odgovorJSON[0]["SpellConcentration"] == "C")
            {
                div.innerHTML =output + "Concentration, up to " + odgovorJSON[0][stolpec];
            }
            else
            {
                div.innerHTML = output + odgovorJSON[0][stolpec];
            }
        }
        else if(stolpec == "SpellDescription")
        {
            div.innerHTML = odgovorJSON[0][stolpec];
        }
        else
        {
            
        }
        fragment.appendChild(div);
        var div1 = document.createElement("div");
        div1.class = "w-100";
        fragment.appendChild(div1);
        

    }
    
    document.getElementById("Table").innerHTML="";
    document.getElementById("Table").appendChild(fragment);
}




// {
//     for (var i = 0; i < odgovorJSON.length; i++) {			
        					
 
//         for(var stolpec in odgovorJSON[i])
//         {	
//             var tr = document.createElement("tr");				
//             var td = document.createElement("td");

//             if(stolpec == "SpellSchool")
//             {
//                 td.innerHTML = "lvl" + odgovorJSON[i]["SpellLevel"] + " " + odgovorJSON[i][stolpec] + " spell";
//                 tr.appendChild(td);	
//             }
//             else if(stolpec == "SpellCastingTime" && odgovorJSON[i]["SpellRitual"] == "R")
//             {
//                 ritual = '<sub>'+"(ritual)"+'</sub>';
//                 td.innerHTML = odgovorJSON[i][stolpec] + ritual;
//                 tr.appendChild(td);	
//             }
//             else if(stolpec == "SpellRange")
//             {
//                 td.innerHTML = odgovorJSON[i][stolpec];
//                 tr.appendChild(td);       
//             }
//             else if(stolpec == "SpellComponents")
//             {
//                 td.innerHTML = odgovorJSON[i][stolpec];
//                 tr.appendChild(td);	
//             }
//             else if(stolpec == "SpellDuration")
//             {
//                 td.innerHTML = odgovorJSON[i][stolpec];
//                 tr.appendChild(td);	
//             }
//             else if(stolpec == "SpellDescription")
//             {
//                 td.innerHTML = odgovorJSON[i][stolpec];
//                 tr.appendChild(td);	
//             }
//             else
//             {
//                 break;
//             }
            							
//         }
//         fragment.appendChild(tr);		       					// Vrstico tabele dodamo v fragment.
//     }
//     document.getElementById("Table").innerHTML="";
//     document.getElementById("Table").appendChild(fragment);
// }