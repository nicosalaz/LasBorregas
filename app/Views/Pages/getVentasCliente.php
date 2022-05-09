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
                <a href="<?php echo base_url('/clientes/getDetalleVenta/' . $row->id_venta) ?>">
                    <button type="button" class="btn btn-primary">Detalles</button>
                </a>
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
<center>
    <a href="<?php echo base_url('/clientes'); ?>">
        <button class="btn btn-outline-secondary">Volver</button>
    </a>
</center>
<?php echo $this->endSection(); ?>