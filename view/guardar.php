<form id="frmGuardarPro">
    <input type="text"name="nom_pro" placeholder="NOMBRE PRODUCTO" id="txtNomPro">
    <input type="text"name="precio" placeholder="PRECIO PRODUCTO" id="txtPrecio">
    <input type="text"name="cantidad" placeholder="CANTIDAD" id="txtCantidad">
    <input type="file" name="imagen" placeholder="IMAGEN PRODUCTO" id="txtImagen">
    <button type="submit">guardar</button>

</form>


<!-- <form id="frmGuardarPro">     
    <input type="text"name="codigo" id="txtCodigo" placeholder="CODIGO PRODUCTO">
    <input type="number"name="permiso" id="txtPermiso" placeholder="PERMISO">
    <input type="number"name="oculto" id="txtOculto" placeholder="BORRAR">
    <button type="submit">Guardar</button>
</form>  -->


<table border="1">
    <tr>
        <td>CODIGO</td>
        <td>NOMBRE PRODUCTO</td>
        <td>PRECIO</td>
        <td>CANTIDAD</td>
        <td>IMAGEN</td>
        <td>Opciones</td>
    </tr>
    <tbody id="tblProductos">

    </tbody>
</table>

<footer>
    <?php 
        require_once "footer.php"; ?>
</footer>
