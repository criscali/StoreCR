<!-- <form action="../ajax/product.php?op=actualizar" method="POST" id="formCreate">


<input type="text"name="codigo" placeholder="CODIGO PRODUCTO">
<input type="text"name="nom_pro" placeholder="NOMBRE PRODUCTO">
<input type="text"name="precio" placeholder="PRECIO PRODUCTO">
<input type="text"name="cantidad" placeholder="CANTIDAD">
<input type="file" name="imagen" placeholder="IMAGEN PRODUCTO">
<button>guardar</button>



</form> -->


<form id="frmGuardarPro">     
    <input type="text"name="codigo" id="txtCodigo" placeholder="CODIGO PRODUCTO">
    <input type="number"name="permiso" id="txtPermiso" placeholder="PERMISO">
    <input type="number"name="oculto" id="txtOculto" placeholder="BORRAR">
    <button type="submit">Guardar</button>
</form> 

<script src="../js/funciones.js"></script>