<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<?php
$aux = "";
foreach ($ventasPorCliente->getResult() as $row) {
    //$aux = array($row->id_venta, $row->cl_nombre, $row->fecha, $row->tipo_venta, $row->total);
    $aux = $aux . $row->id_venta . ',' . $row->id_cliente . ',' . $row->cl_nombre . ',' . $row->fecha . ',' . $row->tipo_venta . ',' . $row->total . '/';
}
?>
<input type="hidden" id="arreglo" value="<?php echo $aux; ?>">
<center>
    <div class="ventasPorFechaContenido">
        <h4>Tabla Ventas por Fecha</h4>
        <div class="form-cliente">
            <label for="clienteSelect">Cliente:</label>
            <select class="form-select" name="clienteSelect" id="clienteSelect">
                <option value=""></option>
                <?php foreach ($clientes as $row) { ?>
                    <option value="<?php echo $row->id_cliente ?>"><?php echo $row->cl_nombre . " " . $row->cl_apaterno ?></option>
                <?php } ?>
            </select>
            <button onclick="buscarPorCliente()" type="button" class="btn btn-primary">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <div class="infoCliente">
            <h2 id="nombreCliente"></h2>

        </div>
        <table class="table table-hover" id="tablaVentasPorFecha" name="tablaVentasPorFecha">
            <thead>
                <tr>
                    <th scope="col">ID VENTA</th>
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