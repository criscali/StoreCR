
<?php
    require_once("conexion.php");

    class ProductModel{

        public $conexion;
        public function __construct()
        {
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion ->connect();
            
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
                $respuestaJson = "PRODUCTO CREADO.";
            }
            else{
                $respuestaJson = "ERROR AL CREAR EL PRODUCTO.";
            }
            //$respuestaJson = json_encode($ultimoregistro[0]['codigo']);
            return $respuestaJson;
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
                $resultado = true;
            }
            else{
                $resultado = false;
            }
                //$ejecutar->execute();
            //$resultado = $ejecutar->fetchColumn();
            return json_encode($resultado);
            //return $respuestaJson = "";

        }

        public function deleteProduct($codigo, $permiso, $oculto){
            if($permiso == 1)
            {
                $deleteSql = "UPDATE PRODUCTO SET oculto = ? WHERE codigo = ?";
                $ejecutar = $this->conexion->prepare($deleteSql);
                $ejecutar->bindParam(1, $oculto);
                $ejecutar->bindParam(2, $codigo);
                $ejecutar->execute();
                $respuestaJson = "PRODUCTO ELIMINADO.";
            }
            else{
                $respuestaJson = "NO TIENE PERMISOS PARA ELIMINAR EL PRODUCTO.";
                
            }
            return json_encode($respuestaJson);
        }
        



        public function pagination($paginaE){

            $tamano_paginas=6;
            if(isset($paginaE)){
                //$this->getProducts();
            
            
            //$pagina = $paginaE;
            $desde = ($paginaE-1)*$tamano_paginas;
            $sql_total = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE oculto = 0";
            $ejecutar = $this->conexion->prepare($sql_total);
            $ejecutar->execute();
            $numRegistros = $ejecutar->rowCount();
            $total_paginas = ceil($numRegistros/$tamano_paginas);

            $sql_limite = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE oculto = 0 LIMIT $desde, $tamano_paginas";
            $ejecutar = $this->conexion->prepare($sql_limite);
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
                $sql_total = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE oculto = 0";
                $ejecutar = $this->conexion->prepare($sql_total);
                $ejecutar->execute();
                $numRegistros = $ejecutar->rowCount();
                $total_paginas = ceil($numRegistros/$tamano_paginas);

                $sql_limite = "SELECT codigo, nom_pro, precio, cantidad, imagen, oculto FROM Producto WHERE oculto = 0 LIMIT $desde, $tamano_paginas";
                $ejecutar = $this->conexion->prepare($sql_limite);
            

                $ejecutar->execute();
                $filas[] = $ejecutar->fetchAll();
                $resultado = $filas;
                return $arrayName = array("datos"=> $resultado, "tamanoPagina"=> $tamano_paginas, "total_paginas"=> $total_paginas);
            }
                        
                        
            
        }

    }



?>