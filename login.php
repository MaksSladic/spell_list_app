<?php
$DEBUG = true;							
include("tools.php"); 					

$zbirka = dbConnect();					

header('Content-Type: application/json');	

switch($_SERVER["REQUEST_METHOD"])		
{
	case 'POST':
		login_user();
        break;
		
	default:
		http_response_code(405);		
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
			// echo "You have loged in.";
			$headers = array("alg"=>"HS256","typ"=>"JWT");

			$poizvedba = "SELECT * FROM users WHERE UserName='$UserName'";

        	$payload = mysqli_query($zbirka, $poizvedba);

			$JWT = generate_jwt($headers, $payload);
			
			echo $JWT;
		}
		else
		{
			http_response_code(409);	
			error_message("Username or password don't match!");
		}

	}
	else
	{
		http_response_code(400);	
	}
}