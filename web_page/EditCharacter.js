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


function createCharacter() 
{
    var newName = document.getElementById("form12").value;
    var input = document.getElementById("cahracterimage");
    var file = input.files[0];
    var data = {
        UserName: getCookieValue("UserName"),
        Image: null,
    };
  
    if (file) 
    {
        var reader = new FileReader();
        reader.addEventListener("load", function () {
            var blob = new Blob([reader.result], { type: file.type });
            data.Image = blob;
            console.log("new name: " + newName);
            console.log("new name: " + blob);
            var xmlhttp = new XMLHttpRequest();
    
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 201) 
                {
                    // window.location.href = "character.php/?CharacterName="+newName+"&UserName="+getCookieValue("UserName");
                }
            };
        // xmlhttp.open("POST", "http://localhost/spell_list_app/characters/"+newName, true);
        // xmlhttp.send(JSON.stringify(data));
        });
        reader.readAsArrayBuffer(file);
    } 
    else 
    {
        console.log("new name: " + newName);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () 
        {
            if (this.readyState == 4 && this.status == 201) 
            {
                // window.location.href = "character.php/?CharacterName="+newName+"&UserName="+getCookieValue("UserName");
            }
        };
        // xmlhttp.open("POST", "http://localhost/spell_list_app/characters/"+newName, true);
        // xmlhttp.send(JSON.stringify(data));
    }
}


// function createCharacter()
// {
//     var newName = document.getElementById("form12").value;
//     var input = document.getElementById('cahracterimage');
//     const file = input.files[0];
//     const reader = new FileReader();
//     const blob = new Blob([reader.result], { type: file.type });
//     console.log(blob);
//     console.log("new name: "+newName);
//     var xmlhttp = new XMLHttpRequest();	
//     var data = {
//         "UserName":getCookieValue("UserName")
//     };		
	 
// 	xmlhttp.onreadystatechange = function()									
// 	{
// 		if (this.readyState == 4 && this.status == 201)						
// 		{
//             // window.location.href = "character.php/?CharacterName="+newName+"&UserName="+getCookieValue("UserName");
//         }
//     };
//     // xmlhttp.open("POST", "http://localhost/spell_list_app/characters/"+newName, true);						
// 	// xmlhttp.send(JSON.stringify(data));
// }