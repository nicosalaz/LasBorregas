<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="add">
    <div class="add-form">
        <?php foreach ($empleado as $rowEmpleado) { ?>
            <form action="<?php echo base_url('/empleados/edit-empleado/' . $rowEmpleado->id_empleado); ?>" method="post" autocomplete="off" class="needs-validation" novalidate>
                <h3>Datos Personales</h3>
                <hr>
                <div class="row g-3">
                    <div class="col-md-5">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" value="<?php echo $rowEmpleado->nombre_empleado ?>" class="form-control" id="nombre_empleado" name="nombre_empleado" pattern="[a-zA-Z]+" required>
                    </div>
                    <div class="col-md-5">
                        <label for="apaterno" class="form-label">Apellidos</label>
                        <input type="text" value="<?php echo $rowEmpleado->apellido_empleado ?>" class="form-control" id="apellido_empleado" name="apellido_empleado" pattern="[a-zA-Z]+" required>
                    </div>
                    <div class="col-md-5">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" value="<?php echo $rowEmpleado->telefono ?>" class="form-control" id="telefono" name="telefono" pattern="[0-9]{10}" min="0" maxlength="10" required>
                    </div>
                </div>
                <br>
                <h3>Ingreso</h3>
                <hr>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="municipio" class="form-label">Fecha de Ingreso</label>
                        <input type="date" value="<?php echo $rowEmpleado->fecha_ingreso ?>" class="form-control" onchange="validarFecha(id)" id="fecha_ingreso" name="fecha_ingreso" pattern="[a-zA-Z]+" required>
                    </div>
                    <div class="col-md-6">
                        <label for="municipio" class="form-label">Rol del empleado</label>
                        <select name="fkidrol" id="fkidrol" class="form-control form-select" required>
                            <option value="<?php echo $rowEmpleado->id_rol ?>" selected><?php echo $rowEmpleado->nombre_rol ?></option>
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
                        <input type="text" value="<?php echo $rowEmpleado->nombre_usuario ?>" class="form-control" id="nombre_usuario" name="nombre_usuario" required>

                    </div>
                    <div class="col-md-5">
                        <label for="contrasena" class="form-label">Clave</label>
                        <input type="password" value="<?php echo $rowEmpleado->clave ?>" oninput="validar()" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <div class="col-md-5">
                        <label for="ReContrasena" class="form-label">Clave nuevamente</label>
                        <input type="password" value="<?php echo $rowEmpleado->clave ?>" required class="form-control" id="ReContrasena" name="ReContrasena" oninput="validar()">
                    </div>
                </div>
            <?php } ?>
            <p id="resultado"></p>
            <div style="margin-top: 20px;">
                <button type="submit" id="btn-addCliente" onmouseover="validar()" class="btn btn-primary">Registrar Empleado</button>
            </div>
            </form>
    </div>
</div>

<?php echo $this->endSection(); ?>