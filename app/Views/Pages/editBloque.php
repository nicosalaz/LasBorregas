<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="add">
    <div class="add-form">
        <?php foreach ($bloques->getResult() as $row) { ?>
            <form action="<?php echo base_url('/bloque/editarBloque/' . $row->id_bloque); ?>" method="post">
                <h3>Ingresar Datos del Bloque</h3>
                <hr>
                <div class="row g-3">
                    <div class="col-md-5">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" value="<?php echo $row->blq_nombre; ?>" oninput="validarAddBloque()" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="col-md-3">
                        <label for="pUnitario" class="form-label">Precio Unitario</label>
                        <input type="text" value="<?php echo $row->blq_precio_unitario; ?>" oninput="validarAddBloque()" class="form-control" id="pUnitario" name="pUnitario" required>
                    </div>
                    <div class="col-md-3">
                        <label for="pVenta" class="form-label">Precio Venta</label>
                        <input type="text" value="<?php echo $row->blq_precio_venta; ?>" oninput="validarAddBloque()" class="form-control" id="pVenta" name="pVenta" required>
                    </div>
                    <div class="col-md-3">
                        <label for="dimension" class="form-label">Dimensiones</label>
                        <input type="text" value="<?php echo $row->blq_tamano; ?>" oninput="validarAddBloque()" class="form-control" id="dimension" name="dimension" required>
                    </div>
                    <div class="col-md-3">
                        <label for="existencia" class="form-label">Existencia</label>
                        <input type="text" value="<?php echo $row->blq_existencia; ?>" oninput="validarAddBloque()" class="form-control" id="existencia" name="existencia" required>
                    </div>
                </div>
                <div style="margin-top: 20px;">
                    <button type="submit" id="btn-addBloque" class="btn btn-primary">Actualizar Bloque</button>
                </div>
            </form>
        <?php } ?>
    </div>
</div>
<?php echo $this->endSection(); ?>