<?php

require_once 'PDO_Value_Binder.php';

class DB extends PDO_Value_Binder{ 

	 public static $pdo;
     private $host;
     private $user;
     private $pass;
     private $dbname;
     private $engine = 'sqlserver'; // mysql ó sqlserver 
     
     public function __construct()
     {
        $this->set_values();

        $dns = $this->engine === 'sqlserver' ? 'sqlsrv:server='. $this->host. ';database='. $this->dbname
               : 'mysql:host='. $this->host. ';dbname='. $this->dbname. ';charset=utf8';
        
        self::$pdo = new \PDO($dns, $this->user, $this->pass);	 
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);               
     }


     private function set_values()
     {
        $direccion = dirname(__FILE__);
        $jsondata = file_get_contents($direccion . '/config_'. $this->engine);        
        $data = (object) json_decode($jsondata, true)['conexion'];   
        
         $this->host = $data->server;
         $this->user = $data->user;
         $this->pass = $data->password;
         $this->dbname = $data->database;        
    
     }

    /* insert - ingresa un registro en la tabla*/
    public static function insert($table, $dataInsert)
    {   
        $fields = implode(', ', array_keys($dataInsert));   
        $binds = ':'. implode(', :', array_keys($dataInsert)); 

        try 
        {
            $stm = self::$pdo->prepare("INSERT INTO $table ($fields) VALUES($binds)");    
            self::bindValues($stm, $dataInsert);            
            $stm->execute();    
            
            return self::$pdo->lastInsertId();
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }        

    }   


    /* setQuery: ejecuta la consulta Sql que recibe como parametro
       $fetch: positivo para que retorne los resultados de la consulta       
       Ej. obterner los resultados de la tabla

       debe ser negativo cuando por ej. se borra una fila ya que no se
       está consultando sino eliminando...
    */
    public static function setQuery($query, $fetch=TRUE) 
    {		       
        try 
        {            
            $stmt = self::$pdo->query($query);
            return $fetch ? $stmt->fetch() : TRUE;     
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
    }	


    /* updateWhere: actualiza con una o múltiples condiciones */
    public static function updateWhere($table, $dataInsert, $where)
    {   
        $j = 1;
        $ssql = ''; 
        foreach($dataInsert as $key => $value) { $ssql .= "$key=:$key,"; }        
        $ssql = rtrim($ssql, ',');

        foreach($where as $key => $value)
        {
            $dataInsert[$key] = $value;

            if($j == 1) { $ssql .= " WHERE $key=:$key"; }
            else { $ssql .= " AND $key=:$key"; }    
            $j++;        
        }           

        $sql = "UPDATE $table SET $ssql";

        try 
        {            
            $stm = self::$pdo->prepare($sql);                
            $stm->execute($dataInsert);                
            return TRUE;
        } 
        catch (\PDOException $e) 
        {   return $sql;
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }           

    }       

        
    /* update => actualiza un registro */
    public static function update($table, $array, $index) 
    {
        $cols = $binds = '';    
        foreach ($array as $key => $data)
        {
		   if($key != $index){ $cols .= $key. '=?,';  }           
           $update[] = $data;
        }
        
        try 
        {            
            $sql = "UPDATE  `$table` SET " . rtrim($cols, ',') . " WHERE $index=?";
            self::$pdo->prepare($sql)->execute($update); 
            return TRUE;
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
       
    }
	
    /* delete - borra un registro de la tabla: "$table" con el id: "$id"
       retorna: boolean  */
    public static function delete($table, $idArray) 
    {		
		foreach ($idArray as $key => $id){
			$field_id = $key;
		}
		
        try 
        {
            $stm = self::$pdo->prepare("DELETE FROM $table WHERE idArray = ?");
            $stm->execute([$id]);
            return TRUE;
        } 
        catch (\PDOException $e) 
        {  
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
    }
	
	
    /* getRow - retornas un registro de la tabla: "$table"
       retorna: resultados de la consulta */
    public static function getRow($table, $idArray) 
    {		
		foreach ($idArray as $key => $id){ $field = $key; }		

        try 
        {            
            $stm = self::$pdo->prepare("SELECT * FROM $table WHERE $field = ?");
            $stm->execute([$id]);
			
			return $stm->fetch();  // return $stm->fetchObject();
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
    }	


    /* getRows - retornas los registros de la tabla: "$table"
       retorna: resultados de la consulta */
       public static function getRows($table, $idArray=[]) 
       {		
           try 
           {            
               $stm = self::$pdo->prepare("SELECT * FROM $table");  
               $stm->execute();             
               return $stm->fetchAll();
           } 
           catch (\PDOException $e) 
           {
              self::setErrorPDO($e->getMessage());
              return FALSE;  
           }
       }	    

       
     public static function sp()
     {
        $published_year = 2010;
        $sql = 'CALL get_books(:published_year)';
        
        try {

            $statement = self::$pdo->prepare($sql);        
            $statement->bindParam(':published_year', $published_year, \PDO::PARAM_INT);        
            $statement->execute();
        
            return $statement->fetchAll(\PDO::FETCH_ASSOC);        
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }

     }


    /* guarda en sesión el último error: Solo para ambiente de desarrollo */
    public static function setErrorPDO($error)
    {
        //if(ENVIROMENT == 'development'){
            $_SESSION['pdo_error'] = $error;
       // }       
    }     

    	
} // End of class




    /* insert - ingresa un registro en la tabla*/
    /*
    public static function insert($table, $array)
    {   
        $cols = $binds = '';    
        foreach ($array as $key => $data){
            $cols .= $table.'_'.$key.',';
            $binds .= '?,';
            $insert[] = $data;
        }               

        try 
        {
            $sql = "INSERT INTO `$table` (" . rtrim($cols, ',') . ") VALUES (" . rtrim($binds, ',') .")";     
            return self::$pdo->prepare($sql)->execute($insert);             
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
    }   */
    