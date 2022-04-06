<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="add">
    <div class="add-form">
        <form action="<?php echo base_url('/venta/agregarVenta'); ?>" method="post">
            <h3>Ingresar Datos de la Venta</h3>
            <hr>
            <div class="row g-3">
                <div class="col-md-5">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>
                <div class="col-md-5">
                    <label for="tipo_venta" class="form-label">Tipo de venta</label>
                    <Select class="form-select" name="tipo_venta" id="tipo_venta" required>
                        <option value="Linea">En linea</option>
                        <option value="Mostrador">Mostrador</option>
                    </Select>
                </div>
                <div class="col-md-5">
                    <label for="fk_id_cliente" class="form-label">Cliente</label>
                    <select class="form-select" name="fk_id_cliente" id="fk_id_cliente" required>
                        <?php
                        foreach ($clientes->getResult() as $row) {
                        ?>
                            <option value="<?php echo $row->id_cliente; ?>"><?php echo  $row->cl_nombre . ' ' . $row->cl_apaterno . ' ' . $row->cl_amaterno; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="tableContenido">
                <div class="seleccion">
                    <div class="cantidad">
                        <label for="productos">Producto</label>
                        <select name="productos" id="productos" onchange="validarBtnAddContenido()">
                            <option value="" selected></option>
                            <?php foreach ($bloques->getResult() as $rowBloque) {
                                $msj = "Producto: " . $rowBloque->blq_nombre .
                                    " / Tamaño: " . $rowBloque->blq_tamano .
                                    " / Precio: " . $rowBloque->blq_precio_venta;
                                $valor = $rowBloque->blq_nombre . ',' .
                                    $rowBloque->blq_tamano . ',' . $rowBloque->blq_precio_venta . ',' . $rowBloque->blq_existencia;
                            ?>
                                <option value="<?php echo $valor ?>"><?php echo $msj ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="cantidad">
                        <label for="cantidad">Cantidad de Producto</label>
                        <input type="number" name="cantidad" id="cantidad" onchange="validarBtnAddContenido()">
                    </div>
                    <button type="submit" id="btn-addContenido" class="btn btn-primary" onclick="addContenido()" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" height="25px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                        </svg>
                    </button>
                </div>
                <table class="table table-hover" id="tablaContenido" name="tablaContenido">
                    <thead>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </thead>
                    <tbody id="tableBody">
                    </tbody>
                </table>
            </div>
            <p id="resultado"></p>
            <div style="margin-top: 20px;">
                <button type="submit" id="btn-addVentas" class="btn btn-primary">Registrar Venta</button>
            </div>
        </form>
    </div>
</div>
<?php echo $this->endSection(); ?>