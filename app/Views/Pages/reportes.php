<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>

<center>
    <h1>REPORTES</h1>
</center>
<hr>
<div class="reportes">
    <div class="reporte-card">
        <a href="<?php echo base_url('/reportes/bloques_vendidos_ordenados') ?>">
            <button class="btn btn-secondary">Los bloques mas vendidos (ordenados del mayor al menor).</button>
        </a>
    </div>
    <div class="reporte-card">
        <a href="<?php echo base_url('/reportes/clientes_ventas_ordenadas') ?>">
            <button class="btn btn-secondary">Los clientes con mas ventas, de mayor a menor.</button>
        </a>

    </div>
    <div class="reporte-card">
        <a href="<?php echo base_url('/reportes/ventas_por_fecha') ?>">
            <button class="btn btn-secondary">Ventas por fecha especifica.</button>
        </a>

    </div>
    <div class="reporte-card">
        <a href="<?php echo base_url('/reportes/ventas_por_cliente') ?>">
            <button class="btn btn-secondary">Ventas por cliente especifico.</button>
        </a>
    </div>
    <!--<div class="reporte-card">
        <button class="btn btn-secondary">Mostrar el histórico de ventas a cierto cliente</button>
    </div>-->
</div>

<?php echo $this->endSection(); ?>