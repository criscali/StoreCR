<?php

require_once ("config/config.php");
require_once ("controller/product_controller.php");
require_once ("controller/paginationController.php");

 if(isset($_GET['op']) && isset($_GET['id'])){
    if(method_exists("ProductController", $_GET['op'], $_GET['algo'])){
        ProductController::{$_GET['op']}();
    }
}
else if(isset($_GET['op'])){
    ProductController::{$_GET['op']}();
    //ProductController::index();
}
/* else if(isset($_GET['op'])  && $_GET['page']  $_GET['cod']){
    if(method_exists("ProductController", $_GET['page'])){
        ProductController::{$_GET['page']}();
    }
    
} */
else{
    ProductController::index();
}
//$verProductos = new ProductController();
//ProductController::listar();
?>