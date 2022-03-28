<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="twoHeader">
    <h4>Tabla Bloque</h4>
    <a href="<?php echo base_url('/vistas/addBloque'); ?>"><button class="btn btn-primary">Agregar Bloque</button></a>
</div>
<table class="table table-hover" id="tablaBloque" name="tablaBloque">
    <thead>
        <tr>
            <th scope="col">ID BLOQUE</th>
            <th scope="col">BLQ nombre</th>
            <th scope="col">PRECIO UNITARIO</th>
            <th scope="col">PRECIO VENTA</th>
            <th scope="col">TAMANO</th>
            <th scope="col">ESTADO</th>
            <th scope="col">EXISTENCIAS</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody id="resultBloque" name="resultBloque">
        <?php
        foreach ($bloque->getResult() as $row) {
        ?>
            <tr>
                <td> <?php echo $row->id_bloque ?></td>
                <td> <?php echo $row->blq_nombre ?></td>
                <td> <?php echo $row->blq_precio_unitario ?></td>
                <td> <?php echo $row->blq_precio_venta ?></td>
                <td> <?php echo $row->blq_tamano ?></td>
                <td> <?php echo $row->estado ?></td>
                <td> <?php echo $row->blq_existencia ?></td>
                <td>
                    <a href="<?php echo base_url('/bloque/eliminar/' . $row->id_bloque); ?>"><button class="btn btn-danger">Eliminar</button></a>
                    <button class="btn btn-warning">Editar</button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php echo $this->endSection(); ?>