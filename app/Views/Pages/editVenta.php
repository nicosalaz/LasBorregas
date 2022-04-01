<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="add">
    <?php foreach ($ventas as $row) { ?>
        <div class="add-form">
            <form action="<?php echo base_url('/venta/editarVenta/' . $row->id_venta); ?>" method="post">
                <h3>Ingresar Datos de la Venta</h3>
                <hr>
                <div class="row g-3">
                    <div class="col-md-5">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" value="<?php echo $row->fecha ?>" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <div class="col-md-5">
                        <label for="tipo_venta" class="form-label">Tipo de venta</label>
                        <Select class="form-select" name="tipo_venta" id="tipo_venta" required>
                            <option value="<?php echo $row->tipo_venta; ?>" selected><?php echo $row->tipo_venta ?></option>
                            <?php if ($row->tipo_venta == "Mostrador") { ?>
                                <option value="Linea">En linea</option>
                            <?php } else { ?>
                                <option value="Mostrador">Mostrador</option>
                            <?php } ?>
                        </Select>
                    </div>
                    <div class="col-md-5">
                        <label for="fk_id_cliente" class="form-label">Cliente</label>
                        <select class="form-select" name="fk_id_cliente" id="fk_id_cliente" required>
                            <?php
                            foreach ($clientes->getResult() as $rowC) {
                                if ($rowC->id_cliente != $row->fk_id_cliente) {
                            ?>
                                    <option value="<?php echo $rowC->id_cliente; ?>"><?php echo  $rowC->cl_nombre . ' ' . $rowC->cl_apaterno . ' ' . $rowC->cl_amaterno; ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?php echo $rowC->id_cliente; ?>" selected><?php echo  $rowC->cl_nombre . ' ' . $rowC->cl_apaterno . ' ' . $rowC->cl_amaterno; ?></option>

                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div style="margin-top: 20px;">
                    <button type="submit" id="btn-addVentas" class="btn btn-primary">Editar Venta</button>
                </div>
            </form>
        <?php } ?>
        </div>
</div>
<?php echo $this->endSection(); ?>