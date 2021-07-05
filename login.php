<?php 

require_once 'class/Auth.class.php';
require_once 'class/respuestas.class.php';

$Login = new Auth;
$_respuestas = new respuestas;
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //recibir datos
    $postBody = file_get_contents("php://input");

    //enviamos los datos al manejador
    $datosArray = $Login->login($postBody);    

    //delvolvemos una respuesta
    if(isset($datosArray['result']['error_id']))
    {
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    }
    else
    {
        http_response_code(200);
    }

    echo json_encode($datosArray);

}
else
{
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);

}
