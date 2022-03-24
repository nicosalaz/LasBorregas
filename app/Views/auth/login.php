<?php echo $this->extend('auth/plantillaLogin'); ?>

<?php echo $this->section('contenidoForm'); ?>
<?php echo $this->include('componentes/alerta'); ?>
<form action="<?php echo base_url('/auth/login'); ?>" method="post" autocomplete="off">
    <div class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
    </div>
    <div class="mb-3">
        <label for="clave" class="form-label">Clave</label>
        <input type="password" class="form-control" id="clave" name="clave" placeholder="Clave">
    </div>
    <button type="submit" class="btn btn-primary">Ingresar</button>
</form>

<?php echo $this->endSection(); ?>