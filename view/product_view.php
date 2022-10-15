<?php

    require_once ("../model/product_model.php");
    $pModel = new ProductModel();

    $productos = $pModel->getProducts();
    $respuesta = json_decode($productos);
    
    


    foreach($respuesta as $r){?>
        <img src="../../img/<?php echo $r->imagen; ?>" alt="">
        
    <?php
    }
    ?>


<a href="../ajax/product.php?op=listar" >ver Productos</a>