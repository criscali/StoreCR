<?php
require_once "model/pagination_model.php";

    class PaginationController{

        public static function pages(){
             
            $paginationModel = new PaginationModel();
            $paginas = $paginationModel->pagination();
            //return $paginas;
            require_once "view/error.php";
        }
    }
?>