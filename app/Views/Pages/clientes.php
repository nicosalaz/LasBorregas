<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>

<div class="twoHeader">
    <h4>Tabla Clientes</h4>
    <a href="<?php echo base_url('/vistas/addClientes'); ?>"><button class="btn btn-primary">Agregar Cliente</button></a>
</div>
<table class="table table-hover" id="tablaClientes" name="tablaClientes">
    <thead>
        <tr>
            <th scope="col">ID CLIENTE</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">APELLIDOS</th>
            <th scope="col">TELEFONO</th>
            <th scope="col">USUARIO</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody id="resultClientes" name="resultClientes">
        <?php
        foreach ($clientes->getResult() as $row) {
        ?>
            <tr>
                <td> <?php echo $row->id_cliente ?></td>
                <td> <?php echo $row->cl_nombre ?></td>
                <td> <?php echo $row->cl_apaterno . ' ' . $row->cl_amaterno  ?></td>
                <td> <?php echo $row->cl_telefono ?></td>
                <td> <?php echo $row->nombre_usuario ?></td>
                <td>
                    <a href="<?php echo base_url('/clientes/eliminar/' . $row->id_cliente); ?>"><button class="btn btn-danger">Eliminar</button></a>
                    <a href="<?php echo base_url('/clientes/editar/' . $row->id_cliente); ?>"><button class="btn btn-warning">Editar</button></a>
                    <a href="<?php echo base_url('/clientes/getVentaCliente/' . $row->id_cliente); ?>"><button class="btn btn-info">Mostrar</button></a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>


<?php echo $this->endSection(); ?>