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
  

function cookiesExist(){
    var jwt = getCookieValue("User");

    var xmlhttp = new XMLHttpRequest();										// ustvarimo HTTP zahtevo
    
    xmlhttp.onreadystatechange = function()									// določimo odziv v primeru različnih razpletov komunikacije
    {
        if (this.readyState == 4 && this.status == 200)						// zahteva je bila uspešno poslana, prišel je odgovor 201
        {
            console.log("200");
            document.getElementById("header").innerHTML=`
            <div class="col-sm-1 col-md-1 col-lg-1 text-center">
                <Form action="../index.php" method="POST">
                    <button type="submit" class="btn btn-primary border border-dark text-center">Home</button>
                </Form>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1 text-center">
                <Form action="../AllSpells.php" method="POST">
                    <button type="submit" class="btn btn-primary border border-dark text-center">All spells</button>
                </Form>
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 text-center">
                <Form action="../characters.php" method="POST">
                    <button type="submit" class="btn btn-primary border border-dark text-center">My characters</button>
                </Form>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1 offset-7 text-center">
                <button type="button" class="btn btn-primary border border-dark" onclick="logout()">Logout</button>                
            </div>
            `;
        }
        if(this.readyState == 4 && this.status == 409)					
        {
            console.log("409");
            document.getElementById("header").innerHTML=`
            <div class="col-sm-1 col-md-1 col-lg-1 text-center">
                <Form action="../index.php" method="POST">
                    <button type="submit" class="btn btn-primary border border-dark text-center">Home</button>
                </Form>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1 text-center">
                <Form action="../AllSpells.php" method="POST">
                    <button type="submit" class="btn btn-primary border border-dark text-center">All spells</button>
                </Form>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1 offset-8 text-center">
                <Form action="../login.php" method="POST">
                    <button type="submit" class="btn btn-primary border border-dark">Login</button> 
                </Form>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1 text-center">
                <Form action="../signup.php" method="POST">
                    <button type="submit" class="btn btn-primary border border-dark">Sign up</button> 
                </Form>               
            </div>
            `;
        }
    };
    
    xmlhttp.open("POST", "http://localhost/spell_list_app/cookies/"+jwt, true);							
    xmlhttp.send();											
}

function logout(){
	deleteAllCookies();
	window.location.href = "../index.php";
}

function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substring(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/";
    }
}