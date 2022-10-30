<?php 
require_once("view/index.php");
//require_once("view/header.php");
?>

<div class="listar">
<table class="styled-table">
        
<thead>
    <tr class="table-primary">
        <td>CODIGO</td>
        <td>NOMBRE</td>
        <td>PRECIO</td>
        <td>CANTIDAD</td>
        <td>IMAGEN</td>
        <td>OPCION </td>
    </tr>

</thead>

    
    <?php
            
            foreach($arreglo = $pages['datos'][0] as $datos):

            ?>
    <tbody>
        <tr>
            <td><?php echo $datos['codigo'];?></td>
            <td><?php echo $datos['nom_pro'];?></td>
            <td><?php echo $datos['precio'];?></td>
            <td><?php echo $datos['cantidad'];?></td>
            <td> <img src="<?php echo rutaImagenes.$datos['imagen'];?>" alt="" width="50px" height="50px"></td>
            <td>
                <a href="index.php?op=verId&cod=<?php echo $datos['codigo'];?>"><i class="fa-solid fa-pen-to-square"></i></a>    
                <a href="index.php?op=eliminar&cod=<?php echo $datos['codigo'];?>"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
    </tbody>

            <?php
            endforeach;
            ?>    



</table>


<nav aria-label="...">

<?php

for($i=1; $i<=$pages['total_paginas'];$i++):
?>
    <ul class="pagination pagination-sm">

        <li class="page-item "><a class="page-link" href="index.php?op=listar&pagina=<?php echo $i;?>"><?php echo $i;?></a></li>
        <?php
endfor;

?>
    </ul>

</nav>

</div>



<?php require_once("view/footer.php"); ?>