function DefaultValue()
{
    var urlParams = new URLSearchParams(window.location.search);
    var form = document.getElementById("form12");
    var newValue = ""+urlParams.get('CharacterName');
    form.value = newValue;
}

function UpdateCharacter()
{
    var urlParams = new URLSearchParams(window.location.search);
    var newName = document.getElementById("form12").value;
    console.log("new name: "+newName);
    var xmlhttp = new XMLHttpRequest();	
    var data = {
        "CharacterName":newName
    };		
	 
	xmlhttp.onreadystatechange = function()									
	{
		if (this.readyState == 4 && this.status == 204)						
		{
            window.location.href = "../character.php/?CharacterName="+newName+"&UserName="+getCookieValue("UserName");
        }
    };
    xmlhttp.open("PUT", "http://localhost/spell_list_app/characters/"+urlParams.get('CharacterID'), true);						
	xmlhttp.send(JSON.stringify(data));
}