<?php
require_once "model/sale_model.php";
require_once "model/product_model.php";

    class saleController{

        public static function getSales(){
             
            $salesModel = new saleModel();
            $sales = $salesModel->getSales();
            
            $getProducts = new ProductModel();
            $getprod = $getProducts->countProduct();
            //return $sales;
            require_once "view/index.php";
        }
    }
?>