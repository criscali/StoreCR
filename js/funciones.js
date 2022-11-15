/* 




if(document.querySelector("#frmGuardarPro")){
    let frmRegistro = document.querySelector("#frmGuardarPro");
    frmRegistro.onsubmit = function(e){
        e.preventDefault();
        fGuardar();
        listarProducts();
    }

    async function fGuardar(){
        let txtNomPro = document.querySelector("#txtNomPro").value;
        let txtPrecio = document.querySelector("#txtPrecio").value;
        let txtCantidad = document.querySelector("#txtCantidad").value;
        let txtImagen = document.querySelector("#txtImagen").value;
        

        if(txtNomPro=='' || txtPrecio=='' || txtCantidad==''){
            alert("debe completar el formulario");
            return;
        }

        try{
            let data = new FormData(frmRegistro);
            let respuesta = await fetch("../ajax/product.php?op=guardar",{
                method:'POST',
                mode: 'cors',
                cache:'no-cache',
                body: data
            });
            json = await respuesta.json();
            console.log(data);
        }
        catch(err){
            console.log("ocurrio un error."+err);
        }
    }

    
 
}

async function listarProducts(){
    try{
        let respuesta = await fetch("../ajax/product.php?op=listar");
        json = await respuesta.json();
        
        if(json.status){
            let data = json.data;
            data.forEach((item) =>{
                let  newtr = document.createElement("tr");
                newtr.id = "row_"+item.codigo;
                newtr.innerHTML = `<tr> 
                                    <th scope="row">${item.codigo}</th>
                                    <td>${item.nom_pro}</td>   
                                    <td>${item.precio}</td>   
                                    <td>${item.cantidad}</td> 
                                    <td><img src='../img/${item.imagen}' width='50 px' height='50'></td>
                                    </td>`;
                document.querySelector("#tblProductos").appendChild(newtr);
            }); 
            
        }
        console.log(json); 
    }
    catch(err){
        console.log("ocurrio un error."+err);
    } 


}


listarProducts();
 */





/* let verDatos  = async () =>{
    try{
        let url = "../ajax/product.php?op=listar";
        //let url = "../view/product_view.php";
        let resultado = await fetch(url);
        if(resultado.ok){
            let datos = await resultado.json();
            console.log(datos);
        }
        else{
            console.log(resultado.status);
        }

    }catch(err){
        console.log(err);
    }
}

verDatos(); */


/* async function listarProducts(){
    try{
        let respuesta = await fetch("../ajax/product.php");
        //let respuesta = await fetch("../view/product_view.php");
        json = await respuesta.json();
        
        if(json.status){
            let data = json.data;
            data.forEach((item) =>{
                let  newtr = document.createElement("tr");
                newtr.id = "row_"+item.codigo;
                newtr.innerHTML = `<tr> 
                                    <th scope="row">${item.codigo}</th>
                                    <td>${item.nom_pro}</td>   
                                    <td>${item.precio}</td>   
                                    <td>${item.cantidad}</td> 
                                    <td><img src='../img/${item.imagen}' width='50 px' height='50'></td>
                                    </td>`;
                document.querySelector("#tblProductos").appendChild(newtr);
            }); 
            
        }
        console.log(json); 
    }
    catch(err){
        console.log("ocurrio un error."+err);
    } 


}

listarProducts(); */



if(document.querySelector("#frmGuardarPro")){
    let frmRegistro = document.querySelector("#frmGuardarPro");
    frmRegistro.onsubmit = function(e){
        e.preventDefault();
        fGuardar();
    }

    async function fGuardar(){
        let txtNomPro = document.querySelector(".nom_pro").value;
        let txtPrecio = document.querySelector(".precio").value;
        let txtCantidad = document.querySelector(".cantidad").value;
        let txtImagen = document.querySelector(".imagen").value;

        

        if(txtNomPro=='' || txtPrecio =='' || txtCantidad== ''){
            alert("debe completar el formulario");
            return;
        }
        else{
            alert(txtImagen);
        }

        try{
            let data = new FormData(frmRegistro);
            let respuesta = await fetch("index.php?op=create",{
                method:'POST',
                mode: 'cors',
                cache:'no-cache',
                body: data
            });
            json = await respuesta.json();
            console.log(data);
        }
        catch(err){
            console.log("ocurrio un error."+err);
        }
    }

    
 
}