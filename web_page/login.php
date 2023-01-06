<!DOCTYPE html>   
<html>   
    <head>  
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <title> Login </title>  
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <style>   
            Body 
            {  
                font-family: Calibri, Helvetica, sans-serif;  
                background-color: #CD9C8A;  
            }  
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
                    
            input[type=text], input[type=password] 
            {   
                width: 100%;   
                margin: 8px 0;  
                padding: 12px 20px;   
                display: inline-block;   
                border: 2px solid green;   
                box-sizing: border-box;   
            }  
            button:hover 
            {   
                opacity: 0.7;   
            }   
            .cancelbtn 
            {   
                width: auto;   
                padding: 10px 18px;  
                margin: 10px 5px;  
            }     
            .container 
            {   
                padding: 25px;   
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
                <div class="col-sm-1 col-md-1 col-lg-1 offset-9 text-center">
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
        </div>   
        <center> <h1> Login </h1> </center>   
        <form action="./login.php" method="POST">  
            
            <div class="container bg-secondary">   
                <label>Username : </label>   
                <input type="text" placeholder="Enter Username" name="username" required>  
                <label>Password : </label>   
                <input type="password" placeholder="Enter Password" name="password" required>  
                <button type="submit" class="btn btn-primary border border-dark" style="width:50%">Login</button>     
                <button type="button" class="btn btn-primary border border-dark" style="width:50%"> Cancel</button>   
            </div>   
        </form> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>    
    </body>     
</html> 