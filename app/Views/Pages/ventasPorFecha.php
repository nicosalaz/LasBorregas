<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<?php
$aux = "";
foreach ($ventasPorFecha->getResult() as $row) {
    //$aux = array($row->id_venta, $row->cl_nombre, $row->fecha, $row->tipo_venta, $row->total);
    $aux = $aux . $row->id_venta . ',' . $row->cl_nombre . ',' . $row->fecha . ',' . $row->tipo_venta . ',' . $row->total . '/';
}
?>
<input type="hidden" id="arreglo" value="<?php echo $aux; ?>">
<center>
    <div class="ventasPorFechaContenido">
        <h4>Tabla Ventas por Fecha</h4>
        <div class="form-fecha">
            <input type="date" class="form-control" id="fecha" name="fecha">
            <button onclick="buscarFecha()" type="button" class="btn btn-primary">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <table class="table table-hover" id="tablaVentasPorFecha" name="tablaVentasPorFecha">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">TIPO DE VENTA</th>
                    <th scope="col">TOTAL</th>
                </tr>
            </thead>
            <tbody id="resultVentasPorFecha" name="resultVentasPorFecha">

            </tbody>
        </table>
        <a href="<?php echo base_url('/reportes'); ?>"><button class="btn btn-outline-secondary">Volver</button></a>
    </div>
</center>



<?php echo $this->endSection(); ?>