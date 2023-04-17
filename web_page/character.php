<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> character </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="../header_for_spells.js"></script>
        <script src="../redirect.js"></script>
        <script src="../spellsOfCharacter.js"></script>
        <script>isloggedin()</script>
        <style>
        button 
        {   
            background-color: #4CAF50;   
            width: 100%;  
            color: orange;   
            padding: 15px;   
            margin: 10px 0px;   
            border: none;   
            cursor: pointer;   
        }  
        Body
        {
            font-family: Calibri, Helvetica, sans-serif;  
            background-color: #CD9C8A;  
        }
        .nav-tabs .nav-item .nav-link 
        {
            background-color: #fff;
            color: #000000;
            border-color: #000000;
        }

        .nav-tabs .nav-item .nav-link.active 
        {
            background-color: #6c757d;
            color: #000000;
        }
        a
        {
            text-decoration: none;
            color: black;
        }
        </style>
    </head>
    <body  onload="allSpellsOfCharacter();allSpells(0);">
        <script>cookiesExist()</script>
        <!-- <script>allSpellsOfCharacter()</script> -->
        <div class="container-fluid">
            <div class="row bg-secondary" id="header">
                
            </div>
        </div>  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <div class="row mb-4"></div>
        
        <div class="container">
            
            <div class="card">
                <!-- <img class="card-img-top"  alt="Card image cap"> -->
                <div class="card-body">
                    <p class="card-text text-center" id="CharacterName"></p>
                </div>
            </div>
            <script>CharacterName()</script> 
            <Form id="EditCharacterButton" action="" method="POST">
                <button type="submit" class="btn btn-primary border border-dark text-center">Edit character</button>
            </Form>
            <Form id="AddspellsButton" action="" method="POST">
                <button type="submit" class="btn btn-primary border border-dark text-center">Add spells</button>
            </Form>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link active" 
                        id="cantrips-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#cantrips-tab-pane" 
                        type="button" 
                        role="tab" 
                        aria-controls="cantrips-tab-pane" 
                        aria-selected="true"
                        onclick="allSpells(0)">
                        Cantrips
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link" 
                        id="Level-1-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#Level-1-tab-pane" 
                        type="button" 
                        role="tab" 
                        aria-controls="Level-1-tab-pane" 
                        aria-selected="false"
                        onclick="allSpells(1)">
                        1st. Level
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link" 
                        id="Level-2-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#Level-2-tab-pane" 
                        type="button" 
                        role="tab" 
                        aria-controls="Level-2-tab-pane" 
                        aria-selected="false"
                        onclick="allSpells(2)">
                        2nd. Level
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link" 
                        id="Level-3-tab" 
                        data-bs-toggle="tab"
                        data-bs-target="#Level-3-tab-pane" 
                        type="button" 
                        role="tab" 
                        aria-controls="Level-3-tab-pane" 
                        aria-selected="false"
                        onclick="allSpells(3)">
                        3rd. Level
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link" 
                        id="Level-4-tab" 
                        data-bs-toggle="tab"
                        data-bs-target="#Level-4-tab-pane" 
                        type="button" 
                        role="tab" 
                        aria-controls="Level-4-tab-pane" 
                        aria-selected="false"
                        onclick="allSpells(4)">
                        4th. Level
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link" 
                        id="Level-5-tab" 
                        data-bs-toggle="tab"
                        data-bs-target="#Level-5-tab-pane" 
                        type="button" 
                        role="tab" 
                        aria-controls="Level-5-tab-pane" 
                        aria-selected="false"
                        onclick="allSpells(5)">
                        5th. Level
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link" 
                        id="Level-6-tab" 
                        data-bs-toggle="tab"
                        data-bs-target="#Level-6-tab-pane" 
                        type="button" 
                        role="tab" 
                        aria-controls="Level-6-tab-pane" 
                        aria-selected="false"
                        onclick="allSpells(6)">
                        6th. Level
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link" 
                        id="Level-7-tab" 
                        data-bs-toggle="tab"
                        data-bs-target="#Level-7-tab-pane" 
                        type="button" 
                        role="tab" 
                        aria-controls="Level-7-tab-pane" 
                        aria-selected="false"
                        onclick="allSpells(7)">
                        7th. Level
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link" 
                        id="Level-8-tab" 
                        data-bs-toggle="tab"
                        data-bs-target="#Level-8-tab-pane" 
                        type="button" 
                        role="tab" 
                        aria-controls="Level-8-tab-pane" 
                        aria-selected="false"
                        onclick="allSpells(8)">
                        8th. Level
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link" 
                        id="Level-9-tab" 
                        data-bs-toggle="tab"
                        data-bs-target="#Level-9-tab-pane" 
                        type="button" 
                        role="tab" 
                        aria-controls="Level-9-tab-pane" 
                        aria-selected="false"
                        onclick="allSpells(9)">
                        9th. Level
                    </button>
                </li>
            </ul>

            <table class="table">
                <thead class="bg-secondary" style="Width:100%">
                    <tr>
                    <th scope="col"  style="Width:25%">Spell Name</th>
                    <th scope="col" style="Width:10%">School</th>
                    <th scope="col" style="Width:10%">Casting time</th>
                    <th scope="col" style="Width:10%">Range</th>
                    <th scope="col" style="Width:30%">Duration</th>
                    <th scope="col" style="Width:10%">Components</th>
                    <th scope="col" style="Width:5%"></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider bg-light" id="Tableofspells">
                
                </tbody>
            </table>
            <Form id="DeleteButton" action="../characters.php">
                <button type="submit" class="btn btn-danger border border-dark text-center" onclick="DeleteCharacter()">Delete character !</button>
            </Form>
        </div>
    </body>
</html>