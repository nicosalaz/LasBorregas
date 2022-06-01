<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="twoHeader">
    <h4>Tabla Bloques</h4>
    <a href="<?php echo base_url('/vistas/addBloque'); ?>"><button class="btn btn-primary">Agregar Bloque</button></a>
</div>
<table class="table table-hover" id="tablaBloque" name="tablaBloque">
    <thead>
        <tr>
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
                <td> <?php echo $row->blq_nombre ?></td>
                <td> <?php echo $row->blq_precio_unitario ?></td>
                <td> <?php echo $row->blq_precio_venta ?></td>
                <td> <?php echo $row->blq_tamano ?></td>
                <td> <?php echo $row->estado ?></td>
                <td> <?php echo $row->blq_existencia ?></td>
                <td>
                    <a href="<?php echo base_url('/bloque/eliminar/' . $row->id_bloque); ?>"><button class="btn btn-danger">Eliminar</button></a>
                    <a href="<?php echo base_url('/bloque/editar/' . $row->id_bloque); ?>"><button class="btn btn-warning">Editar</button></a>
                    <a href="<?php echo base_url('/bloque/plantillaAumentarExistencia/' . $row->id_bloque); ?>"><button class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                            </svg>
                        </button></a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php echo $this->endSection(); ?>