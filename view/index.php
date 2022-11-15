<?php  

    require_once ("header.php");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    
    foreach($sales['datos'][0] as $datos):?>
<div class="card" style="width: 20rem;">
        <div class="card-body">
            <h5 class="card-title"><i class="fa-solid fa-cash-register">: <?php echo $datos['cantidadVentas']; ?></i></h5>
            <p class="card-text"><i class="fa-solid fa-dollar-sign">: <?php echo number_format($datos['total']); ?></i></p>
            <a href="#" class="btn btn-primary">VENTAS<i class="fa-solid fa-badge-dollar"></i></a>
            
        </div>
</div>
<?php
endforeach;
?>

<?php foreach($getprod['CantProducts'][0] as $datos1):?>
<div class="card" style="width: 20rem;">
        <div class="card-body">
            <h5 class="card-title"><i class="fa-solid fa-robot"></i>: <?php echo $datos1['cantidadProducto']; ?></i></h5>
            <p class="card-text"><i class="fa-solid fa-dollar-sign">: <?php echo number_format($datos1['precioTodo']); ?></i></p>
            <a href="#" class="btn btn-primary">PRODUCTOS<i class="fa-solid fa-badge-dollar"></i></a>
        </div>
</div>
<?php
endforeach;
?>

<div>
    <?php require_once ("footer.php");?>
</div>

<i class="fa-solid fa-badge-dollar"></i>

</body>
</html>



