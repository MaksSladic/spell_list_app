<?php
$DEBUG = true;							
include("tools.php"); 					

$zbirka = dbConnect();					

header('Content-Type: application/json');	

switch($_SERVER["REQUEST_METHOD"])		
{
	case 'POST':
		JWT($_GET["JWT"]);
        break;
		
	default:
		http_response_code(405);	
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