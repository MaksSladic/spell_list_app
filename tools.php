<?php



function dbConnect()
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "spell_list_app";


	$conn = mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($conn,"utf8");
	
	
	if (mysqli_connect_errno())
	{
		printf("Povezovanje s podatkovnim strežnikom ni uspelo: %s\n", mysqli_connect_error());
		exit();
	} 	
	return $conn;
}


function error_message($vsebina) #pripravi_odgovor_napaka
{
	$odgovor=array(
		'status' => 0,
		'error_message'=>$vsebina
	);
	echo json_encode($odgovor);
}



function get_password($UserName)
{
	global $zbirka;
	$poizvedba="SELECT password FROM users WHERE UserName='$UserName'";

	$rezultat = mysqli_query($zbirka,$poizvedba);

	$row = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);

	echo $row["password"], "\n";

	return $row["password"];
}



function login_ok($UserName, $password)
{
	global $zbirka;
	// password_check($password);
	echo $password,"\n";

	// $poizvedba="SELECT * FROM users WHERE UserName='$UserName' AND password = '$password'";

	$DATABASEpassword = get_password($UserName);

	// if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	if(password_verify($password, $DATABASEpassword))
	{
		echo "ok","\n";
		return true;
	}
	else
	{
		echo "not ok","\n";
		return false;
	}
}



function user_exists($UserName) #igralec_obstaja
{	
	global $zbirka;
	$UserName=mysqli_escape_string($zbirka, $UserName);
	
	$poizvedba="SELECT * FROM users WHERE UserName='$UserName'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}

function character_exists($CharacterName) #igralec_obstaja
{	
	global $zbirka;
	$CharacterName=mysqli_escape_string($zbirka, $CharacterName);
	
	$poizvedba="SELECT * FROM characters WHERE CharacterName='$CharacterName'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}


function URL_vira($vir)
{
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
	{
		$url = "https"; 
	}
	else
	{
		$url = "http"; 
	}
	$url .= "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $vir;
	
	return $url; 
}


function get_characters($IDofUser)
{
    global $zbirka;
    // $odgovor = array();

    $CharacterName = "SELECT CharacterName FROM characters WHERE IDofUser = '$IDofUser'";
    
    $rezultat = mysqli_query($zbirka, $CharacterName);

    if(mysqli_num_rows($rezultat)>0)
    {
        $odgovor=$rezultat;
    }
    else
    {
        $odgovor = "No characters have been created";
    }
    return $odgovor;
}


function get_character_ID($CharacterName)
{
    global $zbirka;

    $IDofUser = "SELECT IDchar FROM characters WHERE CharacterName = '$CharacterName'";

    $rezultat = mysqli_query($zbirka, $IDofUser);

    $rezultat = mysqli_fetch_row($rezultat);
	
    return $rezultat[0];
}



function get_spell_name($IDofSpell)
{
    global $zbirka;

    $SpellName = "SELECT SpellName FROM spells WHERE IDSpell = '$IDofSpell'";
    
    $rezultat = mysqli_query($zbirka, $SpellName);
	
    if(mysqli_num_rows($rezultat)>0)
    {
		$rezultat = mysqli_fetch_row($rezultat);
        $odgovor=$rezultat[0];
    }
    else
    {
        $odgovor = "No spell by that ID exists.";
    }
    return $odgovor;
}


function get_user_ID($UserName)
{
    global $zbirka;

    $IDofUser = "SELECT IDofUser FROM users WHERE UserName = '$UserName'";

    $rezultat = mysqli_query($zbirka, $IDofUser);

    $rezultat = mysqli_fetch_row($rezultat);

    return $rezultat[0];

}


function get_spell_ID($SpellName)
{
	global $zbirka;

	$IDspell = "SELECT IDspell FROM spells WHERE SpellName = '$SpellName'";

	$rezultat = mysqli_query($zbirka, $IDspell);

    $rezultat = mysqli_fetch_row($rezultat);

    return $rezultat[0];
}


function spell_exists($SpellName) 
{	
	global $zbirka;
	$SpellName=mysqli_escape_string($zbirka, $SpellName);
	
	$poizvedba="SELECT * FROM spells WHERE SpellName='$SpellName'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}

function character_has_spell($SpellName, $CharacterName)
{
	global $zbirka;
	$SpellName=mysqli_escape_string($zbirka, $SpellName);
	$CharacterName=mysqli_escape_string($zbirka, $CharacterName);

	$IDspell = get_spell_ID($SpellName);
	$IDchar = get_character_ID($CharacterName);

	$poizvedba = "SELECT * FROM spelllist WHERE IDspell = '$IDspell' AND IDchar = '$IDchar'";

	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function delete_all_spells_of_char($IDchar)
{
	global $zbirka;

	$IDchar = mysqli_escape_string($zbirka, $IDchar);

	$poizvedba = "DELETE FROM spelllist WHERE IDchar = '$IDchar'";

	mysqli_query($zbirka, $poizvedba);
}

function delete_all_char_of_user($IDofUser)
{
	global $zbirka;

	$IDofUser = mysqli_escape_string($zbirka, $IDofUser);

	$poizvedba = "SELECT IDchar FROM characters WHERE IDofUser = '$IDofUser'";
	
	$characters = mysqli_query($zbirka, $poizvedba);

	while($character = mysqli_fetch_row($characters))
	{
		delete_all_spells_of_char($character[0]);
	}

	$poizvedba = "DELETE FROM characters WHERE IDofUser = '$IDofUser'";

	mysqli_query($zbirka, $poizvedba);
}

// --------------------------------------------------------------------
// JWT

function generate_jwt($headers, $payload, $secret = 'd4d6d8d10d12d20') {
	$headers_encoded = base64url_encode(json_encode($headers));
	
	$payload_encoded = base64url_encode(json_encode($payload));
	
	$signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
	$signature_encoded = base64url_encode($signature);
	
	$jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
	
	return $jwt;
}


function base64url_encode($str) {
    return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
}


function is_jwt_valid($jwt, $secret = 'd4d6d8d10d12d20') {
	// split the jwt
	$tokenParts = explode('.', $jwt);
	$header = base64_decode($tokenParts[0]);
	$payload = base64_decode($tokenParts[1]);
	$signature_provided = $tokenParts[2];

	// check the expiration time - note this will cause an error if there is no 'exp' claim in the jwt
	$expiration = json_decode($payload)->exp;
	$is_token_expired = ($expiration - time()) < 0;

	// build a signature based on the header and payload using the secret
	$base64_url_header = base64url_encode($header);
	$base64_url_payload = base64url_encode($payload);
	$signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
	$base64_url_signature = base64url_encode($signature);

	// verify it matches the signature provided in the jwt
	$is_signature_valid = ($base64_url_signature === $signature_provided);
	
	if ($is_token_expired || !$is_signature_valid) {
		return FALSE;
	} else {
		return TRUE;
	}
}

?>