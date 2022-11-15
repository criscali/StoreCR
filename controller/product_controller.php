<?php 
    require_once ("model/product_model.php");

    class ProductController{

        private $productoModel;
        private $operacion;
        public function __construct()
        {
            $this->productoModel = new ProductModel();
        }

        

/*         public static function index(){
            $productoModel = new ProductModel();
            $productos = $productoModel->getProducts();
            //return $productos;
            require_once "view/index.php";
        } */

        public static function listar(){

                $operacion = $_GET['op'];
                if(!isset($_GET['pagina'])){
                    if($operacion == 'listar'){

                        $prController = new ProductModel();
                        $pages = $prController->pagination(null, $operacion);
                    
                    
                        //return $productos;
                        require_once "view/listar.php";
                    }
                    else if($operacion == 'deletedProduct'){
                        $prController = new ProductModel();
                        $paginationDelete = $prController->pagination(null, $operacion);
                        return $paginationDelete;
                    
                        //return $productos;
                        //require_once "view/deletedProduct.php";
                    }
                }
                else{

                    $pagina = $_GET['pagina'];
                    
                    $prController = new ProductModel();
                    if($operacion == 'listar'){
                        $pages = $prController->pagination($pagina, $operacion);
                        require_once "view/listar.php";
                    }
                    else if($operacion == 'deletedProduct'){
                        $paginationDelete = $prController->pagination($pagina, $operacion);
                        //$paginationDelete =  self::deletedProduct($paginationDelete);
                        return $paginationDelete;
                    }

            }
        }

        public static function deletedProduct(){
            
           $paginationDelete=  self::listar();
            
            require_once "view/deletedProduct.php";
            
        }

        public static function create(){

            if(isset($_POST['nom_pro']) && isset($_POST['precio']) && isset($_POST['cantidad']) && isset($_POST['imagen'])){
                
                if(empty($_POST['nom_pro']) || empty($_POST['precio']) || empty($_POST['cantidad'])){
                    echo "<script>alert('DEBE LLENAR LOS VALORES DEL FORMULARIO.');</script>";
                    require_once "view/guardar.php";
                }
                else{
                    $nom_pro = $_POST['nom_pro'];
                    $precio = $_POST['precio'];
                    $cantidad = $_POST['cantidad'];
                    $imagen = $_POST['imagen'];
                    $productoModel = new ProductModel();
                    $respuesta = $productoModel->createProduct($nom_pro, $precio, $cantidad, $imagen);
                    //return json_encode($respuesta);
                    echo "<script>alert('{$respuesta}');</script>";
                }

            }
            
                require_once "view/guardar.php";
            
        }

        public static function verId(){
            $codigo = $_GET['cod'];

            $productoModel = new ProductModel();
            $productos = $productoModel->getProductCod($codigo);
            //$productos = $productoModel->updateProduct($codigo, $nom_pro, $precio, $cantidad, $imagen);
            require_once "view/actualizar.php";
        }

        public static function actualizar(){
            $codigo = $_POST['codigo'];
            $nom_pro = $_POST['nom_pro'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $imagen = $_POST['imagen'];
            $productoModel = new ProductModel();
            $respuesta = $productoModel->updateProduct($codigo, $nom_pro, $precio, $cantidad, $imagen);
            //require_once "view/actualizar.php";
            if($respuesta){
                //echo "<script>alert('{$respuesta}');</script>";
                var_dump($respuesta);
                
                //header("Location:".urlsite."index.php");
            }

        }

        public static function eliminar(){
            $codigo = $_GET['cod'];
            if(isset($_GET['hide'])){
                $oculto = $_GET['hide'];
            }
            else{
                $oculto = 0;
            }
            
            
            $productoModel = new ProductModel();
            $productos = $productoModel->deleteProduct($codigo, 1, $oculto);
            //require_once "view/listar.php";
            if($productos == 'RESTAURADO'){
                //echo "<script>alert('{$productos}');</script>";
                header("Location:".urlsite."index.php?op=deletedProduct");
                //echo "<script>alert('{$productos}');</script>";
            }
            else if($productos == 'ELIMINADO'){
                header("Location:".urlsite."index.php?op=listar");
                //echo "<script>alert('{$productos}');</script>";
            }
            //header("Location:".urlsite."index.php?op=listar");
            
            //echo "<script>alert('{$oculto}');</script>";
        }






    }





?>