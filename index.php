<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - Prubebas</title>
    <link rel="stylesheet" href="assets/estilo.css" type="text/css">
</head>
<body>

<div  class="container">
    <h1>Api de pruebas en PHP + PDO  con MYSQL Y SQLSERVER</h1>
    <div class="divbody">
        <h3>login</h3>
        <code>
           POST  /login - Retorna el token para hacer las consultas de: POST, PUT Y DELETE
           <br>
           {
               <br>
               "usuario" :"", 
               <br>
               "password": "" 
               <br>
               "token" : ""
               <br>
            }
        
        </code>
    </div>      
    <div class="divbody">   
        <h3>Pacientes</h3>
        <code>
           GET  /pacientes
           <br>
           GET  /pacientes?id=$id
        </code>

        <code>
           POST  /pacientes
           <br> 
           {
            <br> 
               "nombre" : "",             
               <br> 
               "documento" : "",                  
               <br>      
           }

        </code>
        <code>
           PUT  /pacientes
           <br> 
           {
            <br> 
               "nombre" : "",                                    
               <br>       
               "id" : ""  
               <br>
               "token" : ""
               <br>               
           }

        </code>
        <code>
           DELETE  /pacientes
           <br> 
           {   
               <br>    
               "token" : "",              
               <br>       
               "id" : ""  
               <br>
               "token" : ""
               <br>               
           }

        </code>
    </div>


</div>
    
</body>
</html>

