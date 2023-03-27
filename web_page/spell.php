<!doctype html>
<html lang="en">
    <head>
        <script src="../getspellinfo.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> spell </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="../header_for_spells.js"></script>
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
        
        </style>
    </head>
    <body>
    <script>cookiesExist()</script>
        <div class="container-fluid">
            
            <div class="row bg-secondary" id="header">
                
            </div>
        </div> 
        <div class="container">
            <div class="row mb-4"></div>
            <div class="row">
                <div class="col-sm-1 col-md-1 col-lg-1 text-center">
                    <button onclick="history.back()" class="btn btn-primary border border-dark text-center">Back</button>
                </div>
            </div>
            

            <div class="container bg-light" >  
                <div class="row" id="Table">

                </div>

            </div>  

            <script>
                spellName()
            </script>
        </div>
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>