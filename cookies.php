<?php
$DEBUG = true;							
include("tools.php"); 					

$zbirka = dbConnect();					// Pridobitev povezave s podatkovno zbirko

header('Content-Type: application/json');	// Nastavimo MIME tip vsebine odgovora

switch($_SERVER["REQUEST_METHOD"])		
{
	case 'POST':
		JWT($_GET["JWT"]);
        break;
		
	default:
		http_response_code(405);		//Če naredimo zahtevo s katero koli drugo metodo je to 'Method Not Allowed'
		break;
}

function JWT($JWT){
    if(is_jwt_valid($JWT)){
        http_response_code(200);
    }
    else{
        http_response_code(409);
    }
}
?>