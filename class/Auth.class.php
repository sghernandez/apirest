<?php

require_once 'conexion/DB.php';
require_once 'respuestas.class.php';


class Auth extends DB{

    public function login($json)
    {      
        $_respustas = new respuestas;        
        $datos = json_decode($json, true);

        if(isset($datos['usuario']) && isset($datos['password']))
        {
            $usuario = $datos['usuario'];
            $password = $datos['password'];
            $password = md5($password); 

            $user = parent::getRow('Usuario', ['Usuario_usuario' => $usuario]);

            if(isset($user->Usuario_usuario))
            {
                    // verificar si la contraseña es igual
                    if($password == $user->Usuario_password)
                    {
                            if($user->Usuario_estado == 'Activo')
                            {
                                // Guardar el token
                                if($token = $this->insertToken($user->id_Usuario))
                                {
                                        $result = $_respustas->response;
                                        $result["result"] = ['token' => $token];

                                        return $result;
                                }
                                                                
                                // No se guardó el token
                                return $_respustas->error_500("Error interno, No hemos podido guardar");                            
                            }
                            
                            // Usuario Inactivo
                            return $_respustas->error_200("El usuario esta inactivo");                            
                    }
                  
                    // la contraseña no es igual
                    return $_respustas->error_200("El password es invalido");                    
            }
            
            //no existe el usuario
             return $_respustas->error_200("El usuario $usuario  no existe.");            
        }

        return $_respustas->error_400();
    }


    private function insertToken($id_usuario)
    {
        $val = true;
        $token = bin2hex( openssl_random_pseudo_bytes(16, $val) );

        $insert = parent::insert('Usuario_token', [
            'Usuario_id' => $id_usuario,
            'Usuario_token_token' => $token,
            'Usuario_token_estado' => 'Activo',
            'Usuario_token_fecha' => date('Y-m-d H:i')
        ]);

        return $insert ? $token : FALSE;
    }

}

