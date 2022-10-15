<?php

class Conexion{

    
    public $usuario = "root";
    public $password = "";
    public $conexion;

    public function __construct()
    {
        
        try {
                $this->conexion = new PDO('mysql:host=localhost;dbname=productos', $this->usuario, $this->password);      
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Conexión realizada Satisfactoriamente";
            }
    
        catch(PDOException $e)
            {
                echo "La conexión ha fallado: " . $e->getMessage();
            }
    
        
            
    }

    public function connect(){
        return $this->conexion;
    }
    
}


?>