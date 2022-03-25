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