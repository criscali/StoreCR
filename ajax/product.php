<?php

require_once "../model/product_model.php";

$pModel = new ProductModel();




/* $nom_pro = $_POST['nom_pro'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];
$imagen = $_POST['imagen']; */


if($_GET['op'] == 'guardar'){
    $respuestaCrear = $pModel->createProduct($_POST['nom_pro'], $_POST['precio'], $_POST['cantidad'], $_POST['imagen']);
   /*  if($respuestaCrear){
        echo $respuestaCrear;
        $respuestaListar = $pModel->getProducts();
    }
    else{
        echo $respuestaCrear;   
    } */

    $arrayRespuesta = array('status'=> false, 'data' => "");
    if(!empty($respuestaCrear)){
        $arrayRespuesta['status'] = true;
        $arrayRespuesta['data'] = $respuestaCrear;
    }
    echo json_encode($arrayRespuesta);
}

if($_GET['op'] == 'actualizar'){
    $respuestaActualizar = $pModel->updateProduct($_POST['codigo'] ,$_POST['nom_pro'], $_POST['precio'], $_POST['cantidad'], $_POST['imagen']);
    if($respuestaActualizar){
        echo "PRODUCTO ACTUALIZADO ".$respuestaActualizar;
    }
    else{
        echo "NO SE PUDO ACTUALIZAR EL PRODUCTO";   
    }
}

if($_GET['op'] == 'delete'){
    $respuestaBorrar = $pModel->deleteProduct($_POST['codigo'], $_POST['permiso'], $_POST['oculto']);
    if($respuestaBorrar){
        echo $respuestaBorrar;
    }
    else{
        echo $respuestaBorrar;   
    }
}

/*$respuestaJson = json_decode($pModel->getProducts());
 if($_GET['op'] == 'listar'){

    foreach($respuestaJson as $r){
        echo "codigo producto: ".$r->codigo."<br>";
        echo "nombre producto: ".$r->nom_pro."<br>";
        echo "precio producto: ".$r->precio."<br>";
        echo "cantidad producto: ".$r->cantidad."<br><br>";
        
    }
    echo "TOTAL DE PRODUCTOS: ". count($respuesta);
    $respuestaListar = $pModel->getProducts();
     if($respuestaListar){
        echo $respuestaListar;
     }  

    
    } */

    if($_GET['op'] == 'listar'){
        $respuestaListar = (array) $pModel->getProducts();
        $arrayRespuesta = array('status'=> false, 'data' => "");
        if(!empty($respuestaListar)){
            $arrayRespuesta['status'] = true;
            $arrayRespuesta['data'] = $respuestaListar;
        }
        echo json_encode($arrayRespuesta);
        
    }


?>