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
    deleteAllCookies();
	const data = formToJSON(document.getElementById("form").elements);	
	var JSONdata = JSON.stringify(data, null, "  ");						
	
	var xmlhttp = new XMLHttpRequest();										
	 
	xmlhttp.onreadystatechange = function()									
	{
        
		if (this.readyState == 4 && this.status == 200)		
        {				
			document.getElementById("response").innerHTML="Logiranje uspelo!";
            document.getElementById("test").innerHTML=document.cookie;
            CookieName = document.getElementById("name").value;
            document.cookie = CookieName + "=" + xmlhttp.responseText;
		}
		if(this.readyState == 4 && this.status == 409)						
		{
			document.getElementById("response").innerHTML="Username or password don't match!: "+this.status;
		}
        if(this.readyState == 4 && this.status != 409 && this.status != 200)
		{
			document.getElementById("response").innerHTML="Napaka: "+this.status;
		}
	};
	 
	xmlhttp.open("POST", "http://localhost/spell_list_app/login", true);						
	xmlhttp.send(JSONdata);													
}


function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substring(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    }
}