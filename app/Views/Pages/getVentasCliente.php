<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="ventas">
    <?php
    if ($ventas) {
        foreach ($ventas as $row) {
    ?>
            <div class="ventaCliente">
                <h3>Venta <?php echo $row->fecha ?></h3>
                <hr>
                <p>
                <h4>Id venta: </h4><?php echo $row->id_venta; ?>
                </p>
                <p>
                <h4>Tipo de venta: </h4> <?php echo $row->tipo_venta; ?>
                </p>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="ventaCliente">
            <h2>No Tiene Ventas</h2>
        </div>
    <?php
    }
    ?>
</div>
<?php echo $this->endSection(); ?>