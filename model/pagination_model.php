<?php

require_once("conexion.php");

    class PaginationModel{
        public $conexion;
        public function __construct()
        {
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion ->connect();
            
        }

        public function pagination(){

            $tamano_paginas=3;
            $pagina = 1;
            $desde = ($pagina-1)*$tamano_paginas;
            $sql_total = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto";
            $ejecutar = $this->conexion->prepare($sql_total);
            $ejecutar->execute(array());
            $numRegistros = $ejecutar->rowCount();
            $total_paginas = ceil($numRegistros/$tamano_paginas);

            $sql_limite = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto LIMIT $desde, $tamano_paginas";
            $ejecutar = $this->conexion->prepare($sql_limite);
            $resultado = $ejecutar->execute(array());

            return $resultado;

        }


    }

?>