<?php

    //require_once ("../model/product_model.php");
   /*  $pModel = new ProductModel();

    $productos = $pModel->getProducts();
    $respuesta = $productos;
 */
?>

<table border="1">
    <thead>
        <tr>
            <th>CODIGO</th>
            <th>NOMBRE PRODUCTO</th>
            <th>PRECIO</th>
            <th>CANTIDAD</th>
            <th>IMAGEN</th>
            <th>OPCIONES</th>
    </tr>
    <tbody id="tblProductos">

    
            
        
    </tbody>
</table>
    

<footer>
    <?php 
        require_once "footer.php"; ?>
</footer>
