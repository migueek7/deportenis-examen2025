<?php
$menusController = new menusControllers();
$menus = $menusController->getMenu();
// pre($menus);
?>
<div class="modal fade" id="modalAddMenu" tabindex="-1" aria-labelledby="modalAddMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddMenuLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAddMenu" action="POST" class="needs-validation">
                    <input type="hidden" id="id_menu" name="id_menu" value="0">

                    <!-- Select menu padre -->
                    <label for="menuPadre" class="form-label
                    ">Menu Padre</label>
                    <select id="id_menupadre" name="id_menupadre" class="form-select" required>
                        <option value="-1" selected>Ninguno</option>
                        <?php
                        $select = false;
                        foreach ($menus as $key => $value) :
                            if ($value["id_menupadre"] != null && $value["id_menupadre"] != 0) {
                                $select = true;
                            } else {
                                $select = false;
                            }
                        ?>
                            <option value="<?= $value["id_menu"] ?>" selected="<?= $select ?>"><?= $value["nombre_menu"] ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>

                    <div class="mt-3">
                        <label for="nombre_menu" class="form-label">Nombre del menu</label>
                        <input type="text" id="nombre_menu" name="nombre_menu" class="form-control" required />
                    </div>

                    <div class="mt-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <textarea type="textarea" id="descripcion" name="descripcion" class="form-control" required></textarea>
                    </div>

                    <div class="text-right mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btnSave">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>