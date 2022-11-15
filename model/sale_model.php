
<?php
    require_once("conexion.php");

    class saleModel{

        private $conexion;
        public function __construct()
        {
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion ->connect();
            
        }

        public function getSales(){
            $sql = "SELECT COUNT(id_venta) AS cantidadVentas, SUM(total) AS total FROM venta";
            $ejecutar = $this->conexion->prepare($sql);
            //$ejecutar->execute();
            //$numRegistros = $ejecutar->rowCount();
           // return $numRegistros;
            $ejecutar->execute();
            $filas[] = $ejecutar->fetchAll();
            $resultado = $filas;
            return $arrayRespuesta = array("datos" => $resultado);
        }
    }
?>