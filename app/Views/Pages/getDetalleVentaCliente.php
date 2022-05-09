<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="container_detalle_venta">
    <div class="detalle_venta">
        <h2>Detalle de la venta</h2>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>PRODUCTO</th>
                    <th>DIMENSIONES</th>
                    <th>CANTIDAD</th>
                    <th>COSTO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                $id_cliente = 0;
                foreach ($detalles->getResult() as $detalle) { ?>
                    <tr>
                        <td><?php echo $detalle->blq_nombre ?></td>
                        <td><?php echo $detalle->blq_tamano ?></td>
                        <td><?php echo $detalle->cantidad ?> UNIDADES</td>
                        <td>$<?php echo $detalle->precio_venta ?></td>
                    </tr>
                <?php
                    $total = $detalle->total;
                    $id_cliente = $detalle->fk_id_cliente;
                    $fecha = $detalle->fecha;
                    $id_venta = $detalle->id_venta;
                } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>TOTAL: $<?php echo $total; ?></th>
                    <th>FECHA: <?php echo $fecha; ?></th>
                    <th>ID VENTA: <?php echo $id_venta; ?></th>
                </tr>
            </tfoot>
        </table>
        <a href="<?php echo base_url('/clientes/getVentaCliente/' . $id_cliente); ?>">
            <button class="btn btn-outline-secondary">Volver</button>
        </a>
    </div>
</div>
<?php echo $this->endSection(); ?>