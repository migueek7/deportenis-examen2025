<?php
$menusController = new menusControllers();
$menus = $menusController->getMenu();
?>
<div class="container">
    <div class="row">
        <table id="tableMenus" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Menu Padre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col" class="action">Acciones</th>
                </tr>
            </thead>

            <tbody id="list" class="list"></tbody>
        </table>
        <?php
        // pre($menus);
        ?>
    </div>
</div>

<template id="menuTemplate">
    <tr class="item">
        <td class="id_menu" scope="col"></td>
        <td class="nombre_menu" scope="col"></td>
        <td class="menu_padre" scope="col"></td>
        <td class="descripcion" scope="col"></td>
        <td class="action" scope="col">
            <button type="button" class="btn btn-sm btn-primary btnEdit" number="">
                <i class="fa-solid fa-pencil disabled"></i>
            </button>
            <button type="button" class="btn btn-sm btn-danger btnDelete">
                <i class="fa-solid fa-trash disabled"></i>
            </button>
        </td>
    </tr>
</template>

<?php include "./views/modules/modalAddMenu.php"; ?>