<?php require_once("view/index.php");

    foreach($productos as $proAct):
?>

<div class="cardUpdate">
  <div class="card" style="width: 18rem;">
    <img src="<?php echo rutaImagenes.$proAct['imagen'];?>" class="card-img-top" alt="..." width="150px" height="200px">
    <div class="card-body">
      <p class="card-text"></p>
    </div>
  </div>
</div>

<div class="formActualizar">

<form method="POST" action="index.php?op=actualizar">
<input type="hidden" name="codigo" value="<?php echo $proAct['codigo'];?>" class="form-control" aria-describedby="emailHelp">
  <div class="mb-1">
    <label for="exampleInputEmail1" class="form-label">NOMBRE PRODUCTO</label>
    <input type="text" name="nom_pro" value="<?php echo $proAct['nom_pro'];?>" class="form-control" id="inputUpdate"  aria-describedby="emailHelp">
    
  </div>

  <div class="mb-1">
    <label for="exampleInputEmail1" class="form-label">PRECIO</label>
    <input type="text" name="precio" value="<?php echo $proAct['precio'];?>" class="form-control" id="inputUpdate"  aria-describedby="emailHelp">
    
  </div>

  <div class="mb-1">
    <label for="exampleInputEmail1" class="form-label">CANTIDAD</label>
    <input type="text" name="cantidad" value="<?php echo $proAct['cantidad'];?>" class="form-control" id="inputUpdate"  aria-describedby="emailHelp">
    
  </div>

  <div class="input-group mb-1">
  <input type="file" name="imagen"  class="form-control" id="inputUpdate">
</div>



  <button type="submit" class="btn btn-primary" id="buttonUpdate">Submit</button>
</form>

</div>

<?php endforeach;?>


