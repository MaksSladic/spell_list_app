<!doctype html>
<html lang="en">
    <head>
        <script src="addCharacter.js"></script>
        <script src="redirect.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> home </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="header.js"></script>
        <script>isloggedin()</script>
        <!-- <script>allCharacters()</script> -->
        <style>
        button 
        {   
            background-color: #4CAF50;   
            width: 100%;     
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
    <body onload="allCharacters()">
        <script>cookiesExist()</script>
        <div class="container-fluid">
            <div class="row bg-secondary" id="header">
                
            </div>
        </div>  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <div class="row mb-4">
        </div>
        <div class="container">
            <div class="row">
                <div class="col" id="pos1"></div>
                <div class="col" id="pos2"></div>
                <div class="col" id="pos3"></div>
                <div class="col" id="pos4"></div>
                <div class="w-100 mb-4"></div>
                <div class="col" id="pos5"></div>
                <div class="col" id="pos6"></div>
                <div class="col" id="pos7"></div>
                <div class="col" id="pos8"></div>
                <div class="w-100 mb-4"></div>
                <div class="col" id="pos9"></div>
                <div class="col" id="pos10"></div>
                <div class="col" id="pos11"></div>
                <div class="col" id="pos12"></div>
            </div>
        </div>
        
    </body>
</html>

