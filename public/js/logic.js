let precio_total = 0;

function validar() {
    let pass = document.getElementById("contrasena").value;
    let passDos = document.getElementById("ReContrasena").value;
    let resultado = document.getElementById("resultado");
    let button = document.getElementById("btn-addCliente");
    if (pass.length != 0 || passDos.length != 0) {
        if (pass == passDos) {
            resultado.innerHTML = "Son iguales";
            resultado.style.color = "green";
            button.disabled = false;
        } else {
            resultado.innerHTML = "No son iguales";
            resultado.style.color = "red";
            button.disabled = true;
        }
    }
}
function validarAddBloque() {
    const nombre = document.getElementById('nombre').value;
    const pUnitario = document.getElementById('pUnitario').value;
    const pVenta = document.getElementById('pVenta').value;
    const dimension = document.getElementById('dimension').value;
    const existencia = document.getElementById('existencia').value;
    const enviar  = document.getElementById("btn-addBloque");
    if (nombre.length != 0 && pUnitario.length != 0 && pVenta.length != 0
        && dimension.length != 0 && existencia.length != 0) {
        enviar.disabled = false;
    }else{
        console.log("faltan campos por llenar");
    }
}

function addContenido() {
    const listaProductos = document.getElementById('producto');//trae informacion de un campo segun el id del html
    const cantidad = document.getElementById('cantidad');//trae informacion de un campo segun el id del html
    //trae el valor seleccionado del select del html
    const seleccionado = listaProductos.options[listaProductos.selectedIndex].value;
    // array que convierte la info de string a un arreglo
    let arraySeleccionado = seleccionado.split(",");
    const msj = arraySeleccionado[1] + " de "+arraySeleccionado[2];
    const id = arraySeleccionado[0];
    //trae informacion de un campo segun el id del html
    const tableBody = document.getElementById('tableBody');
    const total = document.getElementById('total');
    const btnAdd = document.getElementById('btn-addContenido');
    if (cantidad.value < parseInt(arraySeleccionado[4])) {
        
        tableBody.innerHTML += "<tr><td> <input type='text' name='productos[]' value='"+ msj +"' readonly></td>" +
                            '<input type="text" name="id_prod[]" value="'+ id +'" hidden>' +
                             "<td><input type='text' name='cantidades[]' value='"+ cantidad.value +"' readonly></td>"
                        + "<td><input type='text' name='precios[]' value='"+ (parseInt(cantidad.value) * parseInt(arraySeleccionado[3])) +"' readonly></td> </tr>";
        precio_total = precio_total + parseInt(cantidad.value) * parseInt(arraySeleccionado[3]);
        console.log(precio_total);
        total.value = precio_total;
       /*
        tableBody.innerHTML += '<div> <input type="text" name="id_prod[]" value="'+ id +'" hidden>'
                            + ' <input type="text" name="productos[]" value="'+ msj +'" readonly>' +
                            '<input type="text" name="cantidades[]" value="'+ cantidad +'" readonly>'
                            + '<input type="text" name="precios[]" value="'+(parseInt(cantidad) * parseInt(arraySeleccionado[3]))+'" readonly> </div> <hr>';
        */
        listaProductos.selectedIndex = 0;
        cantidad.value= "";
        btnAdd.disabled = true;
    }else{
        alert('cantidad superior a la que existente');
    }
}

function validarBtnAddContenido() {
    const listaProductos = document.getElementById('producto');
    const seleccionado = listaProductos.options[listaProductos.selectedIndex].text;
    const cantidad = document.getElementById('cantidad').value;
    const btnAdd = document.getElementById('btn-addContenido');
    if (seleccionado.length > 0 && cantidad > 0 ) {
        btnAdd.disabled = false;
    }else{
        btnAdd.disabled = true;
    }
}