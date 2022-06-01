let precio_total = 0;
let precios = [];
let cantidad_producto = [];
let arrayProductos = [];
let posTabla = 0;
let estadoCantidad = false;
let idsRows = [];
let stockProductos = [];
const arregloVentaCliente=[];
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
        idsRows.push(id);
        item = "<td> <input type='text' class='form-control' id='pro"+id+"' name='productos[]' value='"+ msj +"' readonly></td>" +
                '<input type="text" class="form-control"name="id_prod[]" id="input' + id + '" value="'+ id +'" hidden>' +
                '<input type="text" class="form-control"name="" id="p_unit'+id+'" value="'+ p_unit +'" hidden>'+
                "<td><input type='text' class='form-control' id='canti"+id+"' name='cantidades[]' value='' readonly></td>"
                + "<td><input type='text' class='form-control sm-2' id='price"+id+"' name='precios[]' value='' readonly></td>" +
                "<td> <div class='d-grid gap-2 d-md-block'> "+
                "<button type='button' onclick='editar("+id+")' class='bd-example btn btn-warning'><i class='fa-solid fa-pen-to-square'></i></button>"+
                "<button type='button' onclick='eliminar("+id+")' class='btn btn-danger'><i class='fa-solid fa-trash-can'></i></button></div></td></tr>";
        //posTabla++;
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
    let posicion = posId(x);
    const precioEliminar = document.getElementById("price"+x.toString());
    //console.log(precioEliminar.value);
    precios.splice(posicion,1);
    cantidad_producto.splice(posicion,1);
    arrayProductos.splice(posicion,1);
    idsRows.splice(posicion,1);
    //console.log(precios + cantidad_producto + arrayProductos);
    imprimirCarrito();
    btnValidarCompra();

}

function editar(x) {
    let posicion = posId(x);
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
        precios[posicion] = precioNuevo.value;
        cantidad_producto[posicion] = cantidadEditar.value;
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
    /*console.log(precios);
    console.log(cantidad_producto);*/
    for (let index = 0; index < idsRows.length; index++) {
        const precio = document.getElementById("price"+idsRows[index].toString());
        const canti = document.getElementById("canti"+idsRows[index].toString())
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
    alert(fechaM.toLocaleDateString("es-MX") + fechaActual.toLocaleDateString("es-MX"));
    alert(fechaM.toLocaleDateString("es-MX") < fechaActual.toLocaleDateString("es-MX"));
    if (fechaM.toLocaleDateString("es-MX") < fechaActual.toLocaleDateString("es-MX")) {
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

function carritoDeCompra(id) {
    const boton = document.getElementById(id).value;
    //modal.innerHTML = "<p>"+boton+"</p>";
    const arr = boton.split(",");
    let idRow = arr[0];
    let posicion = posId(idRow);
    if (posicion == -1) {
        let item = " <tr><td><input readonly class='form-control' type='text' name='prod[]' value='"+arr[1]+"' ></td>"+
        "<td><input readonly class='form-control' type='text' id='p_unit"+idRow+"' value='"+(arr[4])+"'></td>"+
        "<td><input readonly class='form-control' type='text'  id='price"+idRow+"' name='price[]' value='' ></td>"+
        "<input readonly class='form-control' type='hidden' name='id[]' value='"+(arr[0])+"'>"+
        "<td><input readonly class='form-control' type='text' id='canti"+idRow+"' name='canti[]' value=''></td>"+
        "<td> <div class='d-grid gap-2 d-md-block'> "+
        "<button type='button' onclick='editarCarritoCliente("+idRow+")' class='bd-example btn btn-warning'><i class='fa-solid fa-pen-to-square'></i></button>"+
        "<button type='button' id='buttonDelete"+idRow+"' onclick='eliminarVentaCliente("+idRow+")' class='btn btn-danger'><i class='fa-solid fa-trash-can'></i></button></div></td></tr>";
        precios.push(arr[2]*1);
        cantidad_producto.push(1);
        arrayProductos.push(item);
        idsRows.push(idRow);
        stockProductos.push(arr[3]);
        //console.log(precios + cantidad_producto + arrayProductos + idsRows);
        //posTabla = arrayProductos.length;
        //console.log(posTabla);
        imprimirCarritoDeCompra();
    }else{
        //alert("entro");
        let precio_prod = precios[posicion]/cantidad_producto[posicion];
        let newCantidad = parseInt(cantidad_producto[posicion]) + 1;
        cantidad_producto[posicion] = parseInt(newCantidad);
        precios[posicion] = parseFloat(precio_prod*cantidad_producto[posicion]);
        //console.log("cantidad: "+cantidad_producto+ " precios: " + precios+ " ids: " + idsRows
        //    +" prods: "+ arrayProductos);
        imprimirCarritoDeCompra();
    }
    verificarListaDeProductos();
}

function verificarListaDeProductos() {
    const botonComprar = document.getElementById("btn-comprar");
    if (arrayProductos.length > 0) {
        botonComprar.disabled = false;
    }else{
        botonComprar.disabled = true;
    }
}

function imprimirCarritoDeCompra() {
    const tableBody = document.getElementById("tableClienteBody");
    tableBody.innerHTML="";
    for (let index = 0; index < arrayProductos.length; index++) {
        tableBody.innerHTML += arrayProductos[index]
    }
    llenarCamposCliente();
    calcularTotal();
}

function editarCarritoCliente(x) {
    const posicion = posId(x);
    //console.log(posicion);
    const cantidadEditar = document.getElementById("canti"+x.toString());
    const precioNuevo = document.getElementById("price"+x.toString());
    const precioUni = document.getElementById("p_unit"+x.toString());
    const eliminarBoton = document.getElementById("buttonDelete"+x.toString());
    const total = document.getElementById('total');
    //console.log(cantidadEditar.value);
    //console.log(precioNuevo.value);
    //console.log(precioUni.value);
    if (!estadoCantidad) {
        cantidadEditar.readOnly = false;
        estadoCantidad = true;
        eliminarBoton.disabled = true;
    }else{
        //alert(parseInt(cantidadEditar.value) < 0);
        //alert(stockProductos[posicion] > parseInt(cantidadEditar.value));
        if (stockProductos[posicion] > parseInt(cantidadEditar.value) && parseInt(cantidadEditar.value) > 0) {
            cantidadEditar.readOnly = true;
            estadoCantidad = false;
            precioNuevo.value = parseFloat(cantidadEditar.value) * parseFloat(precioUni.value);
            precios[posicion] = precioNuevo.value;
            cantidad_producto[posicion] = cantidadEditar.value;
            calcularTotal();
            eliminarBoton.disabled = false;
        } else if(parseInt(cantidadEditar.value) <= 0){
            alert("la cantidad debe ser positiva");
        }else{
            alert("la cantidad supera el stock del producto");
        }
    }
}

function eliminarVentaCliente(x) {
    let posicion = posId(x);
    const precioEliminar = document.getElementById("price"+x.toString());
    //console.log(precioEliminar.value);
    precios.splice(posicion,1);
    cantidad_producto.splice(posicion,1);
    arrayProductos.splice(posicion,1);
    idsRows.splice(posicion,1);
    posTabla = arrayProductos.length;
    //console.log("debe agregar en: "+posTabla);
    //console.log(precios + cantidad_producto + arrayProductos);
    imprimirCarritoDeCompra();
    verificarListaDeProductos();
}

function posId(idRow) {
    let estado = false;
    let contador = 0;
    let posicion = -1;
    while (contador < idsRows.length && estado == false) {
        if (idRow == idsRows[contador]) {
            estado = true;
            posicion = contador;
        }
        contador++;
    }
    return posicion;
}
function llenarCamposCliente() {
    /*console.log(precios);
    console.log(cantidad_producto);*/
    for (let index = 0; index < idsRows.length; index++) {
        const precio = document.getElementById("price"+idsRows[index].toString());
        const canti = document.getElementById("canti"+idsRows[index].toString());
        precio.value = parseFloat(precios[index]).toString();
        canti.value = parseFloat(cantidad_producto[index]).toString();
    }
}

