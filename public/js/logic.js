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
    const listaProductos = document.getElementById('productos');
    const cantidad = document.getElementById('cantidad').value;
    const seleccionado = listaProductos.options[listaProductos.selectedIndex].value;
    let arraySeleccionado = seleccionado.split(",");
    const msj = arraySeleccionado[0] + " de "+arraySeleccionado[1]
    //const cantidadTotal = document.getElementById('cantidadTotal').value;
    //const valorUnidad = document.getElementById('valorUnidad').value
    const tableBody = document.getElementById('tableBody');
    console.log(arraySeleccionado);
    //console.log(cantidad);
    //console.log(cantidadTotal);
    if (cantidad < parseInt(arraySeleccionado[3])) {
        tableBody.innerHTML += "<tr><td>" + msj +"</td>" + "<td>" + cantidad +"</td>"
                        + "<td>" + parseInt(cantidad) * parseInt(arraySeleccionado[2]) +"</td> </tr>";
        listaProductos.selectedIndex = 0;
    }else{
        alert('cantidad superior a la que existente');
    }
    
}

function validarBtnAddContenido() {
    const listaProductos = document.getElementById('productos');
    const seleccionado = listaProductos.options[listaProductos.selectedIndex].text;
    const cantidad = document.getElementById('cantidad').value;
    const btnAdd = document.getElementById('btn-addContenido');
    if (seleccionado.length > 0 && cantidad > 0 ) {
        btnAdd.disabled = false;
    }else{
        btnAdd.disabled = true;
    }
}