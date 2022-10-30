<?php 
    require_once "model/product_model.php";

    class ProductController{

        private $productoModel;
        public function __construct()
        {
            $this->productoModel = new ProductModel();
        }
        public static function index(){
            $productoModel = new ProductModel();
            $productos = $productoModel->getProducts();
            //return $productos;
            require_once "view/index.php";
        }

        public static function listar(){

                if(!isset($_GET['pagina'])){
                    $prController = new ProductModel();
                    $pages = $prController->pagination(null);
                    //return $productos;
                    require_once "view/listar.php";
                }
                else{

                    $pagina = $_GET['pagina'];
                    $prController = new ProductModel();
                    $pages = $prController->pagination($pagina);
                    require_once "view/listar.php";
           
            //$prController = new ProductModel();
            
            //$productos = $prController->getProducts();
            //return $productos;
            //require_once "view/listar.php";
            }
        }

/*         public static function page(){

            if(!isset($_GET['pagina'])){
                
            
                
                 
                 //return $productos;
                 require_once "view/listar.php";
            }
            else{
                $pagina = $_GET['pagina'];
                $prController = new ProductModel();
                $pages = $prController->pagination($pagina);
                require_once "view/listar.php";
            }
            


        } */

        public static function create(){


            if(isset($nom_pro)){
                $nom_pro = $_POST['nom_pro'];        
                $precio = $_POST['precio'];   
                $cantidad = $_POST['cantidad'];   
                $imagen = $_POST['imagen'];   
                $productoModel = new ProductModel();
                $productos = $productoModel->createProduct($nom_pro, $precio, $cantidad, $imagen);
            }
            else{
                require_once "view/guardar.php";
            }
  
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
            $productos = $productoModel->updateProduct($codigo, $nom_pro, $precio, $cantidad, $imagen);
            //require_once "view/actualizar.php";
            header("Location:".urlsite."index.php");
        }

        public static function eliminar(){
            $codigo = $_GET['cod'];
            $productoModel = new ProductModel();
            $productos = $productoModel->deleteProduct($codigo, 1, 1);
            //require_once "view/listar.php";
            header("Location:".urlsite."index.php");
            
        }


    }





?>