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