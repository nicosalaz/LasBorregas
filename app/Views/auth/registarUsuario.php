<?php echo $this->extend('auth/plantillaLogin'); ?>

<?php echo $this->section('contenidoForm'); ?>

<form action="<?php echo base_url('/auth/login'); ?>" method="post" autocomplete="off">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="usuario" name="usuario" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Clave</label>
        <input type="password" class="form-control" id="clave" name="clave">
    </div>
    <button type="submit" class="btn btn-primary">Ingresar</button>
</form>

<?php echo $this->endSection(); ?>