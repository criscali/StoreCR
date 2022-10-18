<?php

    require_once ("../model/product_model.php");
    $pModel = new ProductModel();

    $productos = $pModel->getProducts();
    $respuesta = $productos;

?>

<table border="1">
    <tr>
        <td>CODIGO</td>
        <td>NOMBRE PRODUCTO</td>
        <td>PRECIO</td>
        <td>CANTIDAD</td>
        <td>IMAGEN</td>
        <td>OPCIONES</td>
    </tr>
    <tbody id="tblProductos">
        
    </tbody>
</table>

<footer>
    <?php 
        require_once "footer.php"; ?>
</footer>
