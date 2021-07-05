<?php

require_once 'class/respuestas.class.php';
require_once 'class/pacientes.class.php';

$method = $_SERVER['REQUEST_METHOD'];
$_respuestas = new respuestas;
$_pacientes = new Pacientes;
$postBody = file_get_contents("php://input"); //Los datos que se envían
header("Content-Type: application/json");

if($method == 'GET')
{
    if(isset($_GET['id'])){
        $result = $_pacientes->getPaciente($_GET['id']);
    }
    else { $result = $_pacientes->getPacientes('usuarios'); }

    echo json_encode((array) $result);
    http_response_code(200);    
    exit;
}


if($method == 'POST') { $datosArray = $_pacientes->post($postBody); }
if($method == 'PUT') { $datosArray = $_pacientes->put($postBody); }
if($method == 'DELETE') { $datosArray = $_pacientes->delete_row($postBody); }

if(in_array($method, ['POST', 'PUT', 'DELETE']))
{
     if(isset($datosArray["result"]["error_id"]))
     {
         $responseCode = $datosArray['result']['error_id'];
         http_response_code($responseCode);
     }
     else{
         http_response_code(200);
     }

     echo json_encode($datosArray); 
}

