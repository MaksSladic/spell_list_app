<?php
$DEBUG = true;							
include("tools.php"); 					

$zbirka = dbConnect();					// Pridobitev povezave s podatkovno zbirko

header('Content-Type: application/json');	// Nastavimo MIME tip vsebine odgovora

switch($_SERVER["REQUEST_METHOD"])		// Glede na HTTP metodo v zahtevi izberemo ustrezno dejanje nad virom
{
	case 'POST':
		login_user();
        break;
		
	default:
		http_response_code(405);		//Če naredimo zahtevo s katero koli drugo metodo je to 'Method Not Allowed'
		break;
}

function login_user()
{
    global $zbirka, $DEBUG;
	
	$data = json_decode(file_get_contents('php://input'), true);
	
	if(isset($data["Username"], $data["password"]))
	{
		$UserName = mysqli_escape_string($zbirka, $data["Username"]);
		$password = mysqli_escape_string($zbirka, $data["password"]);
			
		if(login_ok($UserName, $password))
		{	
			echo "You have loged in.";
		}
		else
		{
			http_response_code(409);	// Conflict
			error_message("Username or password don't match!");
		}
	}
	else
	{
		http_response_code(400);	// Bad Request
	}
}