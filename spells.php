<?php
$DEBUG = true;							
include("tools.php"); 					

$zbirka = dbConnect();					// Pridobitev povezave s podatkovno zbirko

header('Content-Type: application/json');	// Nastavimo MIME tip vsebine odgovora

switch($_SERVER["REQUEST_METHOD"])		// Glede na HTTP metodo v zahtevi izberemo ustrezno dejanje nad virom
{
	case 'GET':
		if(!empty($_GET["SpellVar"]) || $_GET["SpellVar"]=="0")
		{
            if(!is_numeric($_GET["SpellVar"]))
            {
                get_spell($_GET["SpellVar"]);
            }
			else #default 
            {
                get_spells_of_level($_GET["SpellVar"]);
            }	
		}
        else
        {
            get_all_spells();
        }
        break;
    case 'POST':
        add_new_spell();
		break;
	


		
	default:
		http_response_code(405);		//Če naredimo zahtevo s katero koli drugo metodo je to 'Method Not Allowed'
		break;
}




function get_all_spells()
{
    global $zbirka;
    $odgovor = array();

    $poizvedba = "SELECT SpellName, SpellLevel FROM spells ORDER BY SpellLevel, SpellName";
    $rezultat = mysqli_query($zbirka, $poizvedba);

    while($vrstica=mysqli_fetch_assoc($rezultat))
    {
        $odgovor[]=$vrstica;
    }

    http_response_code(200);	
	echo json_encode($odgovor);
}


function Get_spell($SpellName)
{
    global $zbirka;
    $odgovor = array();

    $poizvedba = "SELECT * FROM spells WHERE SpellName = '$SpellName'";
    $rezultat = mysqli_query($zbirka, $poizvedba);

    while($vrstica=mysqli_fetch_assoc($rezultat))
    {
        $odgovor[]=$vrstica;
    }

    http_response_code(200);	
	echo json_encode($odgovor);
}


function get_spells_of_level($SpellLevel)
{
    global $zbirka;
    $odgovor = array();

    $poizvedba = "SELECT SpellName, SpellSchool, SpellCastingTime, SpellRange, SpellDuration, SpellComponents, SpellRitual, SpellConcentration FROM spells WHERE SpellLevel = '$SpellLevel' ORDER BY SpellName";
    $rezultat = mysqli_query($zbirka, $poizvedba);

    while($vrstica=mysqli_fetch_assoc($rezultat))
    {
        $odgovor[]=$vrstica;
    }

    http_response_code(200);	
	echo json_encode($odgovor);
}


function add_new_spell()
{
    global $zbirka, $DEBUG;
	
	$data = json_decode(file_get_contents('php://input'), true);
	
	if(isset($data["SpellName"], $data["SpellSchool"], $data["SpellLevel"], $data["SpellCastingTime"], $data["SpellRange"], $data["SpellComponents"], $data["SpellDuration"], $data["SpellConcentration"], $data["SpellRitual"], $data["SpellDescription"]))
	{
		$SpellName = mysqli_escape_string($zbirka, $data["SpellName"]);
		$SpellSchool = mysqli_escape_string($zbirka, $data["SpellSchool"]);
		$SpellLevel = mysqli_escape_string($zbirka, $data["SpellLevel"]);
		$SpellCastingTime = mysqli_escape_string($zbirka, $data["SpellCastingTime"]);
		$SpellRange = mysqli_escape_string($zbirka, $data["SpellRange"]);
		$SpellComponents = mysqli_escape_string($zbirka, $data["SpellComponents"]);
		$SpellDuration = mysqli_escape_string($zbirka, $data["SpellDuration"]);
		$SpellConcentration = mysqli_escape_string($zbirka, $data["SpellConcentration"]);
		$SpellRitual = mysqli_escape_string($zbirka, $data["SpellRitual"]);
		$SpellDescription = mysqli_escape_string($zbirka, $data["SpellDescription"]);

			
		if(!spell_exists($SpellName))
		{	
			$poizvedba="INSERT INTO spells (SpellName, SpellSchool, SpellLevel, SpellCastingTime, SpellRange, SpellComponents, SpellDuration, SpellConcentration, SpellRitual, SpellDescription) VALUES ('$SpellName', '$SpellSchool', '$SpellLevel', '$SpellCastingTime', '$SpellRange', '$SpellComponents', '$SpellDuration', '$SpellConcentration', '$SpellRitual', '$SpellDescription')";
			
			if(mysqli_query($zbirka, $poizvedba))
			{
				http_response_code(201);	// Created
				$odgovor=URL_vira($SpellName);
				echo json_encode($odgovor);
			}
			else
			{
				http_response_code(500);	// Internal Server Error (ni nujno vedno streznik kriv!)
				
				if($DEBUG)	//Pozor: vračanje podatkov o napaki na strežniku je varnostno tveganje!
				{
					pripravi_odgovor_napaka(mysqli_error($zbirka));
				}
			}
		}
		else
		{
			http_response_code(409);	// Conflict
			error_message("Spell already exists!");
		}
	}
	else
	{
		http_response_code(400);	// Bad Request
	}

}

?>