<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="twoHeader">
    <h4>Tabla Ventas</h4>
    <a href="<?php echo base_url('/venta/agregar'); ?>"><button class="btn btn-primary">Agregar Venta</button></a>
</div>
<table class="table table-hover" id="tablaVentas" name="tablaVentas">
    <thead>
        <tr>
            <th scope="col">ID VENTA</th>
            <th scope="col">ID CLIENTE</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">FECHA</th>
            <th scope="col">TIPO VENTA</th>
            <th scope="col">TOTAL</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody id="resultVentas" name="resultVentas">
        <?php
        foreach ($venta->getResult() as $row) {
        ?>
            <tr>
                <td> <?php echo $row->id_venta ?></td>
                <td> <?php echo $row->fk_id_cliente ?></td>
                <td> <?php echo $row->cl_nombre ?></td>
                <td> <?php echo $row->fecha ?></td>
                <td> <?php echo $row->tipo_venta ?></td>
                <td> $<?php echo $row->total ?> pesos</td>
                <td>
                    <a href="<?php echo base_url('/venta/eliminar/' . $row->id_venta); ?>"><button class="btn btn-danger">Eliminar</button></a>
                    <a href="<?php echo base_url('/venta/editar/' . $row->id_venta); ?>"><button class="btn btn-warning">Editar</button></a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php echo $this->endSection(); ?>