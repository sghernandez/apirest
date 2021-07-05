<?php

require_once 'conexion/DB.php';
require_once 'respuestas.class.php';


class Pacientes extends DB {

    private $table = 'Paciente';
    private $token;

    public function post($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);

        if(! isset($datos['token'])){ return $_respuestas->error_401(); }
        $this->token = $datos['token'];

        if($this->buscarToken())
        {
                if(! isset($datos['nombre']) || ! isset($datos['documento'])){
                    return $_respuestas->error_400();
                }

                $documento = $datos['documento'];
                $paciente = [
                    $this->table. '_documento' => $documento,
                    $this->table. '_nombre' => $datos['nombre'],
                ];

                $exists = parent::getRow('Paciente', [$this->table. '_documento' => $documento]);
                if($exists){ return $_respuestas->error_401("El Paciente con el Documento: $documento ya se encuentra registrado"); }
         
                if($id = parent::insert('Paciente', $paciente))
                {
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "id" => $id // retorna el id del paciente ingresado
                        );

                        return $respuesta;
                }
                                        
                 return $_respuestas->error_500();
            }
                
            return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            
        }


        public function put($json)
        {
            $_respuestas = new respuestas;
            $datos = json_decode($json, true);
    
            if(! isset($datos['token'])){ return $_respuestas->error_401(); }
         
                $this->token = $datos['token'];

                if($this->buscarToken())
                {
                    if(! isset($datos['id'])){ return $_respuestas->error_400(); }
                   
                        $id = intval($datos['id']);
                        $documento = $datos['documento'];

                        $pacienteData = [
                            $this->table. '_documento' => $documento,
                            $this->table. '_nombre' => $datos['nombre'],
                        ];    
                        
                        $sql = "SELECT id_Paciente FROM Paciente WHERE Paciente_documento = $documento AND id_Paciente != $id LIMIT 1";
                        $newDni = parent::setQuery($sql);

                        if(isset($newDni->PacienteId)){
                             return $_respuestas->error_401("El Documento: $documento ya se encuentra registrado"); 
                        }

                        if(parent::updateWhere('Paciente', $pacienteData, ['id_Paciente' => $id]))
                        {
                            $respuesta = $_respuestas->response;
                            $respuesta["result"] = array(
                                "id" => $id
                            );

                            return $respuesta;
                        }
                                                
                        return $_respuestas->error_500();                                                
                }
                    
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");                    
        }
    

        public function delete_row($json)
        {
            $_respuestas = new respuestas;
            $datos = json_decode($json, true);
    
            if(! isset($datos['token'])){ return $_respuestas->error_401(); }
         
                $this->token = $datos['token'];

                if($this->buscarToken())
                {
                    if(! isset($datos['id'])){ return $_respuestas->error_400(); }
                   
                        $id = intval($datos['id']);

                        if(parent::setQuery("DELETE FROM Paciente WHERE id_Paciente = $id", FALSE))
                        {
                            $respuesta = $_respuestas->response;
                            $respuesta["result"] = array(
                                "id" => $id .' se borró correctamente.'
                            );

                            return $respuesta;
                        }
                                                
                        return $_respuestas->error_500();                                                
                }
                    
                return $_respuestas->error_401('El token no es válido. Por favor logueese nuevamente.');                    
        }
    

        private function buscarToken() {
           return parent::getRow('Usuario_token', ['Usuario_token_token' => $this->token]); // and estado = 'Activo'
        }


        public function getPacientes() {
           return parent::getRows($this->table);
        }
    
    
        public function getPaciente($id) {
            return parent::getRow($this->table, ['id_Paciente' => $id]);
        }
    
           

}


