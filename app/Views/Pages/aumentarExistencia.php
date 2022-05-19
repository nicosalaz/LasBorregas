<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<?php foreach ($bloques->getResult() as $row) { ?>
    <center>
        <div class="form-aumentar">
            <form action="<?php echo base_url('/bloque/aumentarExistencia/' . $row->id_bloque); ?>" method="post" class="needs-validation" novalidate>
                <?php foreach ($bloques->getResult() as $row) { ?>

                    <h3>Existencia Actual: <?php echo $row->blq_existencia; ?></h3>
                <?php } ?>
                <hr>
                <div class="row g-3">
                    <div class="col-md-5">
                        <label for="adicion" class="form-label">¿Cuanto deseas agregar?</label>
                        <input type="text" class="form-control" pattern="[0-9]+" min="1" id="adicion" name="adicion" required>
                    </div>
                    <div style="margin-top: 20px;">
                        <button type="submit" id="btn-aumentar" class="btn btn-primary">Aumentar existencia</button>
                    </div>
            </form>
        </div>
    </center>


<?php } ?>
<?php echo $this->endSection(); ?>