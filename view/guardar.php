<?php require_once("view/index.php");?>

<div class="formCreate">

<form method="POST" action="index.php?op=create">

  <div class="mb-1">
    <label for="exampleInputEmail1" class="form-label">NOMBRE PRODUCTO</label>
    <input type="text" name="nom_pro" class="form-control" id="inputUpdate"  aria-describedby="emailHelp">
    
  </div>

  <div class="mb-1">
    <label for="exampleInputEmail1" class="form-label">PRECIO</label>
    <input type="text" name="precio" class="form-control" id="inputUpdate"  aria-describedby="emailHelp">
    
  </div>

  <div class="mb-1">
    <label for="exampleInputEmail1" class="form-label">CANTIDAD</label>
    <input type="text" name="cantidad" class="form-control" id="inputUpdate"  aria-describedby="emailHelp">
    
  </div>

  <div class="input-group mb-1">
    <input type="file" name="imagen"  class="form-control" id="inputUpdate">
  </div>

  <button type="submit" class="btn btn-primary" id="buttonUpdate">Submit</button>
</form>

</div>