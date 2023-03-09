// /**
//  * Pridobi podatke iz obrazca in jih vrne v obliki JSON objekta.
//  * @param  {HTMLFormControlsCollection} elements  Elementi obrazca
//  * @return {Object}                               Object literal
//  */
// const formToJSON = elements => [].reduce.call(elements, (data, element) => 
// {
// 	if(element.name!="")
// 	{
// 		data[element.name] = element.value;
// 	}
//   return data;
// }, {});

function getCookieValue(cookieName){

    var cookies = document.cookie.split(';');


    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        
        
        while (cookie.charAt(0) == ' ') {
        cookie = cookie.substring(1);
        }
        
        
        if (cookie.indexOf(cookieName + '=') == 0) {
        
        return cookie.substring(cookieName.length + 1);
        }
    }


    return null;
}
  

function isloggedin(){
    var jwt = getCookieValue("User");

    var xmlhttp = new XMLHttpRequest();										// ustvarimo HTTP zahtevo
    
    xmlhttp.onreadystatechange = function()									// določimo odziv v primeru različnih razpletov komunikacije
    {
        if (this.readyState == 4 && this.status == 200)						// zahteva je bila uspešno poslana, prišel je odgovor 201
        {
                       
        }
        if(this.readyState == 4 && this.status == 409)						// zahteva je bila uspešno poslana, prišel je odgovor, ki ni 201
        {
            console.log("409");
            window.location.href = "login.php";
        }
    };
    
    xmlhttp.open("POST", "http://localhost/spell_list_app/cookies/"+jwt, true);							
    xmlhttp.send();											
}