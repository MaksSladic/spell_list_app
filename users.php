<?php
$DEBUG = true;							
include("tools.php"); 
					

$zbirka = dbConnect();					

header('Content-Type: application/json');	

switch($_SERVER["REQUEST_METHOD"])		
{
	case 'GET':
		if(!empty($_GET["UserName"]))
		{
			get_user($_GET["UserName"]);		
		}
		else
		{
			get_all_users();					
		}
		break;
	
    case 'POST':
        add_user();
        break;

	case 'PUT':
		if(!empty($_GET["UserName"]))
		{
			update_user($_GET["UserName"]);
		}
		else
		{
			http_response_code(400);	
		}
		break;

	case 'DELETE':
		if(!empty($_GET["UserName"]))
		{
			delete_user($_GET["UserName"]);
		}
		else
		{
			http_response_code(400);	
		}
		break;

		
	default:
		http_response_code(405);		
		break;
}

mysqli_close($zbirka);


function get_all_users()
{
    global $zbirka;
    $odgovor = array();

    $poizvedba = "SELECT UserName FROM users";
    $rezultat = mysqli_query($zbirka, $poizvedba);

    while($vrstica=mysqli_fetch_assoc($rezultat))
    {
        $odgovor[]=$vrstica;
    }

    http_response_code(200);	
	echo json_encode($odgovor);
}


function get_user($UserName)
{
    global $zbirka;
    $odgovor = array();

    $poizvedba = "SELECT UserName FROM users WHERE UserName = '$UserName'";
    
    $rezultat = mysqli_query($zbirka, $poizvedba);
    

    if(user_exists($UserName))
    {
        $IDofUser = get_user_ID($UserName);
        $characters = get_characters($IDofUser);
        $odgovor[]=mysqli_fetch_assoc($rezultat);
        if(gettype($characters)=='string')
        {
            $odgovor[]=$characters;
        }
        else
        {
            while($vrstica=mysqli_fetch_assoc($characters))
            {
                $odgovor[]=$vrstica;
            }   
        }
        http_response_code(200);
        echo json_encode($odgovor);
    }
    else							
	{
		http_response_code(404);		
	}
}


function add_user()
{
	global $zbirka, $DEBUG;
	
	$data = json_decode(file_get_contents('php://input'), true);
	// parse_str(file_get_contents('php://input'),$data);
	
	echo $data, "\n";
	
	if(isset($data["UserName"], $data["Password"]))
	{
		$UserName = mysqli_escape_string($zbirka, $data["UserName"]);
		$password = password_hash(mysqli_escape_string($zbirka, $data["Password"]), PASSWORD_DEFAULT);
			
		if(!user_exists($UserName))
		{	
			$poizvedba="INSERT INTO users (UserName, password) VALUES ('$UserName', '$password')";
			
			if(mysqli_query($zbirka, $poizvedba))
			{
				http_response_code(201);	
				$odgovor=URL_vira($UserName);
				echo json_encode($odgovor);
			}
			else
			{
				http_response_code(500);	
				
				if($DEBUG)	
				{
					pripravi_odgovor_napaka(mysqli_error($zbirka));
				}
			}
		}
		else
		{
			http_response_code(409);	
			error_message("Igralec že obstaja!");
		}
	}
	else
	{
		http_response_code(400);	
		
	}
}


function update_user($UserName_old)
{
	global $zbirka, $DEBUG;
	
	$data = json_decode(file_get_contents('php://input'), true);
	
	if(user_exists($UserName_old))
	{			
		if(isset($data["UserName"], $data["password"]))
		{	
			$UserName = mysqli_escape_string($zbirka, $data["UserName"]);
			$password = password_hash(mysqli_escape_string($zbirka, $data["password"]), PASSWORD_DEFAULT);

			$poizvedba="UPDATE users SET UserName = '$UserName', password = '$password' WHERE UserName = '$UserName_old'";
			
			if(mysqli_query($zbirka, $poizvedba))
			{
				http_response_code(204);	
			}
			else
			{
				http_response_code(500);	
				
				if($DEBUG)	
				{
					error_message(mysqli_error($zbirka));
				}
			}
		}
		else
		{
			http_response_code(400);	
			
		}
	}
	else
	{
		http_response_code(400);	
		
	}
}

function delete_user($UserName)
{
	global $zbirka;

	$IDofUser = get_user_ID($UserName);

	$IDofUser = mysqli_escape_string($zbirka, $IDofUser);

	delete_all_char_of_user($IDofUser);

	$poizvedba = "DELETE FROM users WHERE IDofUser = '$IDofUser'";

	mysqli_query($zbirka, $poizvedba);
}

?>