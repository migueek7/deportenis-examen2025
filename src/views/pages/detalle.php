<?php
$detalle = new menusControllers();
$rutas = rutas();
$data = $detalle->getMenu($rutas[1]);
?>
<div class="container mt-4">
    <!-- <h1>Detalles</h1> -->
    <div class="card p-4">
        <?= $data[0]["descripcion"] ?>
    </div>
</div>