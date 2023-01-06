<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> home </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
        .imgbox 
        {
            display: grid;
            height: 100%;
        }   
        .center-fit 
        {
            max-width: 100%;
            max-height: 100vh;
            margin: auto;
        }
      
    </style>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row bg-secondary">
            <div class="col-sm-1 col-md-1 col-lg-1 text-center">
                <Form action="index.php" method="POST">
                    <button type="submit" class="btn btn-primary border border-dark text-center">Home</button>
                </Form>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1 text-center">
                <Form action="AllSpells.php" method="POST">
                    <button type="submit" class="btn btn-primary border border-dark text-center">All spells</button>
                </Form>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1 text-center">
                <Form action="index.php" method="POST">
                    <button type="submit" class="btn btn-primary border border-dark text-center">Staristics</button>
                </Form>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1 offset-7 text-center">
                <Form action="login.php" method="POST">
                    <button type="submit" class="btn btn-primary border border-dark">Login</button> 
                </Form>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1 text-center">
                <Form action="signup.php" method="POST">
                    <button type="submit" class="btn btn-primary border border-dark">Sign up</button> 
                </Form>               
            </div>
        </div>

        <div class="imgbox">
            <img class="center-fit" src='DnD-Logo.png'>
        </div>

    </div>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>