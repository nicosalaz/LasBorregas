<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="add">
    <div class="add-form">
        <form action="<?php echo base_url('/bloque/agregar'); ?>" method="post" class="needs-validation" novalidate>
            <h3>Ingresar Datos del Bloque</h3>
            <hr>
            <div class="row g-3">
                <div class="col-md-5">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" oninput="validarAddBloque()" class="form-control" id="nombre" name="nombre" value="tabicon" pattern="[a-zA-Z]+" readonly>
                </div>
                <div class="col-md-3">
                    <label for="pUnitario" class="form-label">Precio Unitario</label>
                    <input type="text" oninput="validarAddBloque()" class="form-control" pattern="[0-9]+" min="0" id="pUnitario" name="pUnitario" required>
                </div>
                <div class="col-md-3">
                    <label for="pVenta" class="form-label">Precio Venta</label>
                    <input type="text" oninput="validarAddBloque()" class="form-control" pattern="[0-9]+" min="0" id="pVenta" name="pVenta" required>
                </div>
                <div class="col-md-3">
                    <label for="dimension" class="form-label">Dimensiones</label>
                    <input type="text" oninput="validarAddBloque()" class="form-control" id="dimension" name="dimension" required>
                </div>
                <div class="col-md-3">
                    <label for="existencia" class="form-label">Existencia</label>
                    <input type="text" oninput="validarAddBloque()" class="form-control" pattern="[0-9]+" min="0" id="existencia" name="existencia" required>
                </div>
            </div>
            <div style="margin-top: 20px;">
                <button type="submit" id="btn-addBloque" class="btn btn-primary" disabled="off">Registrar Bloque</button>
            </div>
        </form>
    </div>
</div>
<?php echo $this->endSection(); ?>