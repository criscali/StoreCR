
<?php
    require_once("conexion.php");
    require_once("generador_cod_barra.php");

    class ProductModel{

        public $conexion;
        public $resultado;
        public $tamano_paginas;
        public $total_paginas;

        public function __construct()
        {
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion ->connect();
            
        }

        public function countProduct(){
            $sql = "SELECT COUNT(codigo)AS cantidadProducto, SUM(precio) AS precioTodo FROM producto";
            $ejecutar = $this->conexion->prepare($sql);
            $ejecutar->execute();
            /*$resultado = $ejecutar->rowCount(); */
            $filas[] = $ejecutar->fetchAll();
            $resultado = $filas;
            return $arrayName = array("CantProducts"=> $resultado);
        }

        public function getProducts(){
            $sql = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE oculto = ?";

            //$ejecutar = $this->conexion->query($sql);
            //$filas[] = $ejecutar->fetchAll();
            $ejecutar = $this->conexion->prepare($sql);
            $ejecutar->execute(array(0));
           
            $filas[] = $ejecutar->fetchAll();
            $resultado = $filas;
            
            //$arrayTodo = array('registros'=>$resultado);
            //return $resultado[0];
            return $arrayName = array("datos"=> $resultado);
        }


        public function getProductCod($codigo){
            $sql = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE codigo = ?";

            //$ejecutar = $this->conexion->query($sql);
            //$filas[] = $ejecutar->fetchAll();
            $ejecutar = $this->conexion->prepare($sql);
            $ejecutar->execute(array($codigo));
            $filas[] = $ejecutar->fetchAll();
            
            $respuestaJson = $filas;
            return $respuestaJson[0];
            //return $respuestaJson; 
        }


        public function createProduct($nom_pro, $precio, $cantidad, $imagen){

            $ultimoCodigo = "SELECT codigo FROM producto ORDER BY CODIGO DESC LIMIT 1";
            $ejecutar = $this->conexion->query($ultimoCodigo);
            $ultimoregistro = $ejecutar->fetchAll();
            $lastCode = $ultimoregistro[0]['codigo']+=1;
            $oculto = 0;

            $sql = "INSERT INTO PRODUCTO (codigo, nom_pro, precio, cantidad, imagen, oculto) VALUES(?,?,?,?,?,?)";
            $ejecutar = $this->conexion->prepare($sql);
            $ejecutar->bindParam(1, $lastCode);
            $ejecutar->bindParam(2, $nom_pro);
            $ejecutar->bindParam(3, $precio);
            $ejecutar->bindParam(4, $cantidad);
            $ejecutar->bindParam(5, $imagen);
            $ejecutar->bindParam(6, $oculto);

            //$ejecutar->execute();
            //return $this->conexion->lastInsertId();
            if($ejecutar->execute()){
                $respuesta = "PRODUCTO CREADO.";
/*                 $creacionCodBarra = new GeneradorCodBarra();
                $respuesta = $creacionCodBarra->barcode($lastCode);
                
                echo "<script>alert('{$respuesta}');</script>"; */
            }
            else{
                $respuesta = "ERROR AL CREAR EL PRODUCTO.";
            }
            //$respuestaJson = json_encode($ultimoregistro[0]['codigo']);
            return $respuesta;
        }


        public function updateProduct($codigo, $nom_pro, $precio, $cantidad, $imagen){

            if($imagen == ""){
                $actualizarSql = "UPDATE producto SET  nom_pro=?, precio=?, cantidad=?
                WHERE codigo = ?";

                $ejecutar = $this->conexion->prepare($actualizarSql);
                $ejecutar->bindParam(1, $nom_pro);
                $ejecutar->bindParam(2, $precio);
                $ejecutar->bindParam(3, $cantidad);
                $ejecutar->bindParam(4, $codigo);
                //$ejecutar->execute();
            }
            else{
                $actualizarSql = "UPDATE producto SET nom_pro=?, precio=?, cantidad=?, imagen=?
                WHERE codigo = ?";

                $ejecutar = $this->conexion->prepare($actualizarSql);
                $ejecutar->bindParam(1, $nom_pro);
                $ejecutar->bindParam(2, $precio);
                $ejecutar->bindParam(3, $cantidad);
                $ejecutar->bindParam(4, $imagen);
                $ejecutar->bindParam(5, $codigo);
            }

/*             $ejecutar = $this->conexion->prepare($actualizarSql);
            $ejecutar->bindParam(1, $nom_pro);
            $ejecutar->bindParam(2, $precio);
            $ejecutar->bindParam(3, $cantidad);
            $ejecutar->bindParam(4, $imagen);
            $ejecutar->bindParam(5, $codigo); */
            if($ejecutar->execute()){
                $respuesta = "PRODUCTO ACTUALIZADO.";
                $creacionCodBarra = new GeneradorCodBarra();
                $prueba = "pruebadetextopruebadetextopruebadetextopruebadetextopruebadetextopruebadetexto";
                $respuesta1 = $creacionCodBarra->barcode($prueba);
                
                //echo "<script>alert('{$respuesta}');</script>";
            }
            else{
                $respuesta = "ERROR AL ACTUALIZAR EL PRODUCTO.";
            }
                //$ejecutar->execute();
            //$resultado = $ejecutar->fetchColumn();
            return $respuestas = array("actualizado"=>$respuesta, "archivotxt"=>$respuesta1);
            

        }

        public function deleteProduct($codigo, $permiso, $oculto){
            if($permiso == 1)
            {
                if($oculto == 1){
                    $oculto=0;
                    $deleteSql = "UPDATE PRODUCTO SET oculto = ? WHERE codigo = ?";
                    $ejecutar = $this->conexion->prepare($deleteSql);
                    $ejecutar->bindParam(1, $oculto);
                    $ejecutar->bindParam(2, $codigo);
                    $ejecutar->execute();
                    $respuesta = "RESTAURADO";
                }
                else{
                    $oculto=1;
                    $deleteSql = "UPDATE PRODUCTO SET oculto = ? WHERE codigo = ?";
                    $ejecutar = $this->conexion->prepare($deleteSql);
                    $ejecutar->bindParam(1, $oculto);
                    $ejecutar->bindParam(2, $codigo);
                    $ejecutar->execute();
                    $respuesta = "ELIMINADO";
                }

            }
            else{
                $respuesta = "NO TIENE PERMISOS PARA ELIMINAR EL PRODUCTO.";
                
            }
            return $respuesta;
        }
        
        public function pagination($paginaE, $operacion){

            $tamano_paginas=6;
            if(isset($paginaE)){
                //$this->getProducts();
            //$pagina = $paginaE;
            $desde = ($paginaE-1)*$tamano_paginas;
            if($operacion == 'listar'){
                $sql_total = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE oculto = 0";
                $ejecutar = $this->conexion->prepare($sql_total);
            }
            else if($operacion == 'deletedProduct'){
                $sql_total = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE oculto = 1";
                $ejecutar = $this->conexion->prepare($sql_total);
            }
            $ejecutar->execute();
            $numRegistros = $ejecutar->rowCount();
            $total_paginas = ceil($numRegistros/$tamano_paginas);

            if($operacion == 'listar'){
                $sql_limite = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE oculto = 0 LIMIT $desde, $tamano_paginas";
                $ejecutar = $this->conexion->prepare($sql_limite);
            }
            else if($operacion == 'deletedProduct'){
                $sql_limite = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE oculto = 1 LIMIT $desde, $tamano_paginas";
                $ejecutar = $this->conexion->prepare($sql_limite);
                }
            //$resultado = $ejecutar->execute();
            $ejecutar->execute();
            $filas[] = $ejecutar->fetchAll();
            $resultado = $filas;
            
            //$arrayTodo = array('registros'=>$resultado);
            //return $resultado[0];
            return $arrayName = array("datos"=> $resultado, "tamanoPagina"=> $tamano_paginas, "total_paginas"=> $total_paginas);

            }
            else{
                
                $desde = (1-1)*$tamano_paginas;
                if($operacion == 'listar'){
                    $sql_total = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE oculto = 0";
                    $ejecutar = $this->conexion->prepare($sql_total);
                }
                else if($operacion == 'deletedProduct'){
                    $sql_total = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE oculto = 1";
                    $ejecutar = $this->conexion->prepare($sql_total);
                }
                $ejecutar->execute();
                $numRegistros = $ejecutar->rowCount();
                $total_paginas = ceil($numRegistros/$tamano_paginas);
    
                if($operacion == 'listar'){
                    $sql_limite = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE oculto = 0 LIMIT $desde, $tamano_paginas";
                    $ejecutar = $this->conexion->prepare($sql_limite);
                }
                if($operacion == 'deletedProduct'){
                    $sql_limite = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE oculto = 1 LIMIT $desde, $tamano_paginas";
                    $ejecutar = $this->conexion->prepare($sql_limite);
                }
                //$resultado = $ejecutar->execute();
                $ejecutar->execute();
                $filas[] = $ejecutar->fetchAll();
                $resultado = $filas;
                
                //$arrayTodo = array('registros'=>$resultado);
                //return $resultado[0];
                return $arrayName = array("datos"=> $resultado, "tamanoPagina"=> $tamano_paginas, "total_paginas"=> $total_paginas);
            }
                //return $arrayName = array("datos"=> $this->resultado, "tamanoPagina"=> $this->tamano_paginas, "total_paginas"=> $this->total_paginas);
            
        }

    }



?>