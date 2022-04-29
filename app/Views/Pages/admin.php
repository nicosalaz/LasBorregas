<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="cards">
    <?php foreach ($bloques->getResult() as $bloque) { ?>
        <div class="card-product">
            <h2><?php echo $bloque->blq_nombre . " " . $bloque->blq_tamano; ?></h2>
            <hr>
            <p>Precio : <?php echo "$ " . $bloque->blq_precio_venta; ?></p>
            <br>
            <p>Existencia : <?php echo $bloque->blq_existencia; ?></p>
        </div>
    <?php } ?>
</div>
<?php echo $this->endSection(); ?>