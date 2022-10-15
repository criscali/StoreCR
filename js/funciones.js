
if(document.querySelector("#frmGuardarPro")){
    let frmRegistro = document.querySelector("#frmGuardarPro");
    frmRegistro.onsubmit = function(e){
        e.preventDefault();
        fGuardar();
    }

    async function fGuardar(){
        let txtCodigo = document.querySelector("#txtCodigo").value;
        let txtPermiso = document.querySelector("#txtPermiso").value;
        let txtOculto = document.querySelector("#txtOculto").value;

        if(txtCodigo=='' || txtPermiso=='' || txtOculto==''){
            alert("debe completar el formulario");
            return;
        }

        try{
            let data = new FormData(frmRegistro);
            let respuesta = await fetch("../ajax/product.php?op=delete",{
                method:'POST',
                mode: 'cors',
                cache:'no-cache',
                body: data
            });
            //json= await respuesta.json();
            console.log(response);
        }
        catch(err){
            console.log("ocurrio un error."+err);
        }
    }
}