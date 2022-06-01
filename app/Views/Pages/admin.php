<?php echo $this->extend('Pages/plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="cards-cliente">
    <?php foreach ($bloques->getResult() as $bloque) {
        $valor = $bloque->id_bloque . ',' . $bloque->blq_nombre . " " . $bloque->blq_tamano . ',' .
            $bloque->blq_precio_venta . ',' . $bloque->blq_existencia . ',' . $bloque->blq_precio_venta;
    ?>
        <div class="card-product-cliente">
            <h2><?php echo $bloque->blq_nombre . " " . $bloque->blq_tamano; ?></h2>
            <p>Precio : <?php echo "$ " . $bloque->blq_precio_venta; ?></p>
            <p>Existencia : <?php echo $bloque->blq_existencia; ?></p>
            <?php if (session("usuario")->fkidrol == 3) { ?>
                <button type="button" value="<?php echo $valor; ?>" id="<?php echo $bloque->id_bloque; ?>" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="carritoDeCompra(id);">
                    <i class="fa-solid fa-cart-shopping"></i>
                </button>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Carrito De Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalExample">
                <form action="<?php echo base_url('/clientes/venta-cliente'); ?>" method="POST" id="formCarrito">
                    <table class="table">
                        <thead>
                            <th>NOMBRE</th>
                            <th>PRECIO UNITARIO</th>
                            <th>PRECIO</th>
                            <th>CANTIDAD</th>
                            <th>ACCIONES</th>
                        </thead>
                        <tbody id="tableClienteBody">
                            <tr>
                                <th>CARRITO VACIO</th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    Total:
                                    <input class="form-control" type="text" name="total" id="total" value="0" readonly>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="btn-comprar" form="formCarrito" class="btn btn-primary" disabled>Comprar</button>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>