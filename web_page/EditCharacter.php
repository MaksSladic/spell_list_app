<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> character edit </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="../header_for_spells.js"></script>
        <script src="../redirect.js"></script>
        <script src="../EditCharacter.js"></script>
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
        .font-weight-bold 
        {
            font-weight: bold;
        }
        </style>
    </head>
    <body onload="DefaultValue()">
        <script>cookiesExist()</script>
        <div class="container-fluid">
            <div class="row bg-secondary" id="header"></div>
        </div>  
        <div class="row mb-4"></div>
        <div class="container">
            <p class="text-center font-weight-bold">Edit your character</p>
            <div class="form-outline">
            <label class="form-label" for="form12">Character name</label>
            <input type="text" id="form12" class="form-control" value=""/>
            </div>
            <!-- <br>
            <div class="form-outline">
                <label class="form-label" for="cahracterimage">Character image</label>
                <br>
                <input id="cahracterimage" type="file" accept="image/*"/>
            </div>
            <br>
            <img id="image-preview">
            <br> -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-1 col-md-1 col-lg-1 text-center">
                        <button onclick="history.back()" class="btn btn-primary border border-dark text-center">Cancle</button>
                    </div>
                    <div class="col-sm-1 col-md-1 col-lg-1 text-center">
                        <button onclick="UpdateCharacter()" class="btn btn-primary border border-dark text-center">Save</button>
                    </div>
                </div>
            </div>
        </div>
        
        
    </body>
</html>
