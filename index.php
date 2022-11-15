<?php

require_once ("config/config.php");
require_once ("controller/product_controller.php");
require_once ("controller/sale_controller.php");

 if(isset($_GET['op']) && isset($_GET['id'])){
    if(method_exists("ProductController", $_GET['op'], $_GET['algo'])){
        ProductController::{$_GET['op']}();
    }
}
else if(isset($_GET['op']) && isset($_GET['id'])){
    if(method_exists("ProductController", $_GET['op'], $_GET['algo'], $_GET['oculto'])){
        ProductController::{$_GET['op']}();
    }
}

else if(isset($_GET['op'])){
    if(method_exists("ProductController", $_GET['op'])){
        ProductController::{$_GET['op']}();
    }
    else{
        require_once("view/error.php");
    }
    
    //ProductController::index();

}

/* else if(isset($_GET['op'])  && $_GET['page']  $_GET['cod']){
    if(method_exists("ProductController", $_GET['page'])){
        ProductController::{$_GET['page']}();
    }
    
} */
else{
    saleController::getSales();
    //require_once("view/error.php");
}
//$verProductos = new ProductController();
//ProductController::listar();
?>