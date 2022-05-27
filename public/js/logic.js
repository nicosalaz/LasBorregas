let precio_total = 0;
let precios = [];
let cantidad_producto = [];
let arrayProductos = [];
let posTabla = 0;
let estadoCantidad = false;
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
    console.log(arraySeleccionado);
    const msj = arraySeleccionado[1] + " de "+arraySeleccionado[2];
    const id = arraySeleccionado[0];
    //trae informacion de un campo segun el id del html
    const tableBody = document.getElementById('tableBody');
    const total = document.getElementById('total');
    const btnAdd = document.getElementById('btn-addContenido');
    const p_unit = arraySeleccionado[3];
    let item = "";
    if (cantidad.value < parseInt(arraySeleccionado[4])) {
        precios.push(parseFloat(cantidad.value) * parseFloat(arraySeleccionado[3]));
        cantidad_producto.push(cantidad.value);
        item = "<td> <input type='text' class='form-control' id='pro"+posTabla+"' name='productos[]' value='"+ msj +"' readonly></td>" +
                '<input type="text" class="form-control"name="id_prod[]" id="input' + id + '" value="'+ id +'" hidden>' +
                '<input type="text" class="form-control"name="" id="p_unit'+posTabla+'" value="'+ p_unit +'" hidden>'+
                "<td><input type='text' class='form-control' id='canti"+posTabla+"' name='cantidades[]' value='' readonly></td>"
                + "<td><input type='text' class='form-control sm-2' id='price"+posTabla+"' name='precios[]' value='' readonly></td>" +
                "<td> <div class='d-grid gap-2 d-md-block'> "+
                "<button type='button' onclick='editar("+posTabla+")' class='bd-example btn btn-warning'><i class='fa-solid fa-pen-to-square'></i></button>"+
                "<button type='button' onclick='eliminar("+posTabla+")' class='btn btn-danger'><i class='fa-solid fa-trash-can'></i></button></div></td></tr>";
        posTabla++;
        arrayProductos.push(item);
        imprimirCarrito();
        llenarCampos();
        calcularTotal();
        listaProductos.selectedIndex = 0;
        cantidad.value= "";
        btnAdd.disabled = true;
        btnValidarCompra();
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

function imprimirCarrito() {
    const tableBody = document.getElementById('tableBody');
    const total = document.getElementById('total');
    tableBody.innerHTML = "";
    for (let index = 0; index < arrayProductos.length; index++) {
        tableBody.innerHTML += arrayProductos[index].toString();
    }
    llenarCampos();
    calcularTotal();
    
}

function eliminar(x) {
    const precioEliminar = document.getElementById("price"+x.toString());
    console.log(precioEliminar.value);
    precios.pop(x);
    cantidad_producto.pop(x);
    arrayProductos.pop(x);
    console.log(precios + cantidad_producto + arrayProductos);
    imprimirCarrito();
    btnValidarCompra();

}

function editar(x) {
    const cantidadEditar = document.getElementById("canti"+x.toString());
    const precioNuevo = document.getElementById("price"+x.toString())
    const precioUni = document.getElementById("p_unit"+x.toString())
    const total = document.getElementById('total');
    if (!estadoCantidad) {
        cantidadEditar.readOnly = false;
        estadoCantidad = true;
    }else{
        cantidadEditar.readOnly = true;
        estadoCantidad = false;
        /*console.log(precioUni.value);*/
        precioNuevo.value = parseFloat(cantidadEditar.value) * parseFloat(precioUni.value);
        precios[x] = precioNuevo.value;
        cantidad_producto[x] = cantidadEditar.value;
        console.log(precios);
        calcularTotal();
        console.log(precio_total);
        
    }
}

function calcularTotal() {
    const total = document.getElementById('total');
    precio_total = 0;
    for (let index = 0; index < precios.length; index++) {
        precio_total += parseFloat(precios[index]);
    }
    total.value = precio_total;
}

function llenarCampos() {
    for (let index = 0; index < precios.length; index++) {
        const precio = document.getElementById("price"+index,toString());
        const canti = document.getElementById("canti"+index.toString())
        precio.value = parseFloat(precios[index]);
        canti.value = parseFloat(cantidad_producto[index]);
    }
}
function btnValidarCompra() {
    const btnComprar = document.getElementById('btn-addVentas');
    if (arrayProductos.length > 0) {
        btnComprar.disabled = false;
    }else{
        btnComprar.disabled = true;
    }
}
/*
###################################### REPORTES ######################################
*/

function leerArray() {
    const arregloVentas = document.getElementById("arreglo").value;
    const arr = arregloVentas.split("/");
    for (let index = 0; index < arr.length; index++) {
        arr[index] = arr[index].split(",");
    }
    return arr;
}

function buscarFecha() {
    const arreglo = leerArray();
    const fecha = document.getElementById("fecha").value;
    let mensaje = "";
    const arregloHtml = [];
    for (let index = 0; index < arreglo.length; index++) {
        if (arreglo[index][2] == fecha) {
            mensaje = "<tr><td>"+arreglo[index][0]+"</td>"
                        +"<td>"+arreglo[index][1]+"</td>"
                        +"<td>"+arreglo[index][2]+"</td>"
                        +"<td>"+arreglo[index][3]+"</td>"
                        +"<td>"+arreglo[index][4]+"</td></tr>";
            arregloHtml.push(mensaje);
        }
    }
    if (arregloHtml.length == 0) {
        arregloHtml.push("<tr><h1>NO HAY VENTAS EN ESTA FECHA</h1></tr>");
    }
    imprimirVentasPorFecha(arregloHtml);
}

function imprimirVentasPorFecha(arreglo) {
    const tabla = document.getElementById('resultVentasPorFecha');
    tabla.innerHTML = "";
    for (let index = 0; index < arreglo.length; index++) {
        tabla.innerHTML += arreglo[index];
    }
}

function buscarPorCliente() {
    const arreglo = leerArray();
    const listaCliente = document.getElementById("clienteSelect");
    const idCliente = listaCliente.options[listaCliente.selectedIndex].value;
    const nombreCliente = document.getElementById("nombreCliente");
    nombreCliente.innerHTML = listaCliente.options[listaCliente.selectedIndex].text.toUpperCase();
    let mensaje = "";
    const arregloHtml = [];
    if (listaCliente.selectedIndex != 0) {
        for (let index = 0; index < arreglo.length; index++) {
            if (arreglo[index][1] == idCliente) {
                mensaje = "<tr><td>"+arreglo[index][0]+"</td>"
                            +"<td>"+arreglo[index][3]+"</td>"
                            +"<td>"+arreglo[index][4]+"</td>"
                            +"<td>$ "+arreglo[index][5]+"</td></tr>";
                arregloHtml.push(mensaje);
            }
        }
        if (arregloHtml.length == 0) {
            arregloHtml.push("<tr><h2>EL CLIENTE NO TIENE VENTAS HASTA LA FECHA</h2></tr>");
        }
        imprimirVentasPorFecha(arregloHtml);
    } else {
        alert("Debes seleccionar un cliente");
    }
    
    listaCliente.selectedIndex = 0;
}

function validarFecha(x){
    const fecha = document.getElementById(x);
    const fechaActual = new Date();
    const fechaM = new Date(fecha.value);
    if (fechaM.toLocaleDateString("es-MX") >= fechaActual.toLocaleDateString("es-MX")) {
        alert("Recuerda que la fecha debe ser menor o igual a la actual.");
        fecha.value = "";
    }

}

function validarTipoVenta() {
    const listaTipoVenta = document.getElementById("t_venta");
    const tipoVenta = listaTipoVenta.options[listaTipoVenta.selectedIndex].value;
    const listaEmpleados = document.getElementById("fk_id_empleado");
    if (tipoVenta == "Linea") {
        listaEmpleados.disabled = true;
    }else{
        listaEmpleados.disabled = false;
    }
}
