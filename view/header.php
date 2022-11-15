<?php
require_once ("config/config.php");

?>
<head>
  <link rel="stylesheet" href="css/nav.css">
  <link href="<?php urlsite?>bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/6432954c0d.js" crossorigin="anonymous"></script>

</head>



<ul class="navegador">
  <li><a class="active" href="index.php"><i class="fa-solid fa-house"></i>Home</a></li>
  <div class="navProduct">
    <li><a href="index.php?op=listar">LISTADO</a></li>
    <li><a href="index.php?op=create">CREAR</a></li>
    <li><a href="index.php?op=deletedProduct">ELIMINADOS</a></li>
  </div>  
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
</ul>


<div class="contenedorMain">
        <!--<?php require_once ("header.php");?>-->
        
        <div class="buscador">
            <input type="text">
            <button>buscar</button>
        </div>
</div>