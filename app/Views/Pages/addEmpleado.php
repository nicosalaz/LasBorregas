<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="add">
    <div class="add-form">
        <form action="<?php echo base_url('/empleados/add'); ?>" method="post" autocomplete="off" class="needs-validation" novalidate>
            <h3>Datos Personales</h3>
            <hr>
            <div class="row g-3">
                <div class="col-md-5">
                    <label for="nombre" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombre_empleado" name="nombre_empleado" pattern="[a-zA-Z]+" required>
                </div>
                <div class="col-md-5">
                    <label for="apaterno" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellido_empleado" name="apellido_empleado" pattern="[a-zA-Z]+" required>
                </div>
                <div class="col-md-5">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" pattern="[0-9]{10}" min="0" maxlength="10" required>
                </div>
            </div>
            <br>
            <h3>Ingreso</h3>
            <hr>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="municipio" class="form-label">Fecha de Ingreso</label>
                    <input type="date" class="form-control" onchange="validarFecha(id)" id="fecha_ingreso" name="fecha_ingreso" pattern="[a-zA-Z]+" required>
                </div>
                <div class="col-md-6">
                    <label for="municipio" class="form-label">Rol del empleado</label>
                    <select name="fkidrol" id="fkidrol" class="form-control form-select" required>
                        <option value="" selected></option>
                        <?php foreach ($roles as $row) {
                        ?>
                            <option value="<?php echo $row->id_rol ?>"><?php echo $row->nombre_rol ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <br>
            <h3>Cuenta</h3>
            <hr>
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>

                </div>
                <div class="col-md-5">
                    <label for="contrasena" class="form-label">Clave</label>
                    <input type="password" oninput="validar()" class="form-control" id="contrasena" name="contrasena" required>
                </div>
                <div class="col-md-5">
                    <label for="ReContrasena" class="form-label">Clave nuevamente</label>
                    <input type="password" required class="form-control" id="ReContrasena" name="ReContrasena" oninput="validar()">
                </div>
            </div>
            <p id="resultado"></p>
            <div style="margin-top: 20px;">
                <button type="submit" id="btn-addCliente" class="btn btn-primary" disabled="off">Registrar Empleado</button>
            </div>
        </form>
    </div>
</div>

<?php echo $this->endSection(); ?>