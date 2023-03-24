<?php
$DEBUG = true;
include("tools.php");


$zbirka = dbConnect();					// Pridobitev povezave s podatkovno zbirko

header('Content-Type: application/json');	// Nastavimo MIME tip vsebine odgovora

switch($_SERVER["REQUEST_METHOD"])		// Glede na HTTP metodo v zahtevi izberemo ustrezno dejanje nad virom
{
	case 'GET':
		if(!empty($_GET["CharacterName"]) && !empty($_GET["Var2"]))
		{
			get_character_info($_GET["CharacterName"],$_GET["Var2"]);		//  characters/CharName/Spells
		}
		else
        {
            echo "wrong page";
            http_response_code(400);
        }
        break;
	case 'POST':
        if(!empty($_GET["CharacterName"]) && !empty($_GET["Var2"]))
        {
            add_spell_to_character($_GET["CharacterName"], $_GET["Var2"]);
        }
        elseif(!empty($_GET["CharacterName"]) && empty($_GET["Var2"]))
        {
            add_character($_GET["CharacterName"]);
        }
        else
        {
            http_response_code(400);
        }
        break;
    case 'PUT':
        if(!empty($_GET["CharacterName"]))
        {
            change_character($_GET["CharacterName"]);
        }
        else
        {
            http_response_code(400);
        }
        break;
    case 'DELETE':
        if(!empty($_GET["CharacterName"]) && ($_GET["Var2"] == "DELETE"))
        {
            delete_character($_GET["CharacterName"]);
        }
        elseif(!empty($_GET["CharacterName"]) && !empty($_GET["Var2"]))
        {
            delete_spell_from_character($_GET["CharacterName"],$_GET["Var2"]);
        }
        else
        {
            http_response_code(400);
        }
        break;
    
        



	default:
		http_response_code(405);		//Če naredimo zahtevo s katero koli drugo metodo je to 'Method Not Allowed'
		break;
}

mysqli_close($zbirka);






function get_character_info($CharacterName, $UserName)
{
   
    global $zbirka;
    $odgovor = array();
    $spells = array();

    if(character_exists($CharacterName, $UserName))
    {
        $IDchar = get_character_ID($CharacterName, $UserName);

        $odgovor[0] = $IDchar;
        
        $poizvedba = "SELECT IDspell FROM spelllist WHERE IDchar = '$IDchar'";

        $IDofSpells = mysqli_query($zbirka, $poizvedba);
        
        if(mysqli_num_rows($IDofSpells)>0)
        {
            while($singleSpell=mysqli_fetch_row($IDofSpells))
            {
                $SpellName = get_spell_name($singleSpell[0]);
                $spells[] = $SpellName;
                
            }
            $odgovor[1] = $spells;
        }
        else
        {
            $odgovor[1] = "Character has no spells.";
        }

        http_response_code(200);
        echo json_encode($odgovor);   
    }
    else
    {
        http_response_code(404);
        echo "no character by that name";
    }

    


}


function add_character($CharacterName)
{
	global $zbirka, $DEBUG;
	
	$data = json_decode(file_get_contents('php://input'), true);
	
	if(isset($data["UserName"]))
	{
		// $CharacterName = mysqli_escape_string($zbirka, $data["CharacterName"]);
		//----------------------------------------------	
		$UserName = mysqli_escape_string($zbirka, $data["UserName"]); //TUKEJ POL PRIDE DINAMIČNO SPREMINJANJE GLEDE NA TO V KATEREGA UPORABNIKA SMO PRIJAVLJENI
        //----------------------------------------------
        if(user_exists($UserName))
        {
            if(!character_exists($CharacterName, $UserName))
            {
                $IDofUser = get_user_ID($UserName);

                $poizvedba="INSERT INTO characters (CharacterName, IDofUser) VALUES ('$CharacterName', '$IDofUser')";
            
                if(mysqli_query($zbirka, $poizvedba))
                {
                    http_response_code(201);	
                    $odgovor=URL_vira($CharacterName);
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
                http_response_code(409);	// Conflict
			    error_message("Character že obstaja!");
            }
            
        }
        else
        {
            http_response_code(400);	// Bad Request
        }

        
	}
	else
	{
        http_response_code(400);	// Bad Request
	}
}


function add_spell_to_character($CharacterName, $SpellName)
{
    global $zbirka, $DEBUG;
	$data = json_decode(file_get_contents('php://input'), true);
	
			
    if(isset($data["UserName"]))
    {	
        $UserName = mysqli_escape_string($zbirka, $data["UserName"]);

        if(character_exists($CharacterName, $UserName))
        {
            if(spell_exists($SpellName))
            {
                $IDchar = get_character_ID($CharacterName,$UserName);
                $IDspell = get_spell_ID($SpellName);

                $poizvedba="INSERT INTO spelllist (IDspell, IDchar) VALUES ('$IDspell', '$IDchar')";
                
                if(mysqli_query($zbirka, $poizvedba))
                {
                    http_response_code(201);	
                    $odgovor=URL_vira($CharacterName);
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
                echo "No spell with that name exists";
            }
        }
        else
        {
            echo "No such character exists.";
        }
    } 
    else
    {
        http_response_code(400);	
        
    }
    
    
	
}



function change_character($CharacterID)
{
	global $zbirka, $DEBUG;
	
	$data = json_decode(file_get_contents('php://input'), true);
	
				
    if(isset($data["CharacterName"]))
    {	
        $CharacterName = mysqli_escape_string($zbirka, $data["CharacterName"]);
        
        $poizvedba="UPDATE characters SET CharacterName = '$CharacterName' WHERE IDchar = '$CharacterID'";
        
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

function delete_spell_from_character($IDchar, $SpellName)
{
    global $zbirka, $DEBUG;

    if(spell_exists($SpellName))
    {
        $IDspell = get_spell_ID($SpellName);
        
        $poizvedba = "DELETE FROM spelllist WHERE IDchar = '$IDchar' AND IDspell = '$IDspell'";
        if(mysqli_query($zbirka, $poizvedba))
        {
            http_response_code(204);
            echo "Spell deleted!";	
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
        echo "No spell by that name.";
    }

}


function delete_character($CharacterName)
{
    global $zbirka, $DEBUG;

    if(character_exists($CharacterName))
	{			
        $IDchar = get_character_ID($CharacterName);
        
        delete_all_spells_of_char($IDchar);

        $IDchar = mysqli_escape_string($zbirka, $IDchar);

        $poizvedba = "DELETE FROM characters WHERE IDchar = '$IDchar'";

        if(mysqli_query($zbirka, $poizvedba))
        {
            http_response_code(204);
            echo "Character deleted!";	
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
        echo "No character by that name.";	
		
	}
}

?>