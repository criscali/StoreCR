
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
            $sql = "SELECT * FROM Producto WHERE oculto=0";
            $ejecutar = $this->conexion->query($sql);
            $filas = $ejecutar->fetchAll();
            $respuestaJson = json_encode($filas);
            return $respuestaJson;
        }

        public function createProduct($nom_pro, $precio, $cantidad, $imagen){

            $ultimoCodigo = "SELECT codigo FROM producto ORDER BY CODIGO DESC LIMIT 1";
            $ejecutar = $this->conexion->query($ultimoCodigo);
            $ultimoregistro = $ejecutar->fetchAll();
            $lastCode = $ultimoregistro[0]['codigo']+=1;

            $sql = "INSERT INTO PRODUCTO (codigo, nom_pro, precio, cantidad, imagen) VALUES(?,?,?,?,?)";
            $ejecutar = $this->conexion->prepare($sql);
            $ejecutar->bindParam(1, $lastCode);
            $ejecutar->bindParam(2, $nom_pro);
            $ejecutar->bindParam(3, $precio);
            $ejecutar->bindParam(4, $cantidad);
            $ejecutar->bindParam(5, $imagen);

            //$ejecutar->execute();
            //return $this->conexion->lastInsertId();
            if($ejecutar->execute()){
                $respuestaJson = "PRODUCTO CREADO.";
            }
            else{
                $resultado = "ERROR AL CREAR EL PRODUCTO.";
            }
            //$respuestaJson = json_encode($ultimoregistro[0]['codigo']);
            return $respuestaJson;
        }

        public function updateProduct($codigo, $nom_pro, $precio, $cantidad, $imagen){

            if($nom_pro == "" || $precio == "" || $cantidad ==""){
                $actualizarSql = "UPDATE producto SET  imagen=?
                WHERE codigo = ?";

                $ejecutar = $this->conexion->prepare($actualizarSql);
                $ejecutar->bindParam(1, $imagen);
                $ejecutar->bindParam(2, $codigo);
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
        

    }



?>