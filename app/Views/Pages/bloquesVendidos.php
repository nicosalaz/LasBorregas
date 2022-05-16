<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>

<div class="bloquesVendidosContenido">
    <h4>Tabla Bloques más Vendidos</h4>
    <table class="table table-hover" id="tablaBloquesVendidos" name="tablaBloquesVendidos">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">SUMATORIO</th>
            </tr>
        </thead>
        <tbody id="resultClientes" name="resultClientes">
            <?php
            foreach ($bloquesVendidos->getResult() as $row) {
            ?>
                <tr>
                    <td> <?php echo $row->id ?></td>
                    <td> <?php echo $row->nombre . " " . $row->tamano  ?></td>
                    <td> <?php echo $row->sumatoria ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <a href="<?php echo base_url('/reportes'); ?>"><button class="btn btn-outline-secondary">Volver</button></a>
</div>


<?php echo $this->endSection(); ?>