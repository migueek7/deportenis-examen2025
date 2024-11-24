<?php
$menus = new menusControllers();
$menus = $menus->getMenu(null);
// pre($menus);
?>
<nav class="menu">
    <section class="menu__container">
        <h1 class="menu__logo">Navbar.</h1>

        <ul class="menu__links">
            <li class="menu__item">
                <a href="<?= base_url() ?>" class="menu__link">Inicio</a>
            </li>
            <?php
            $menu_padre = "";
            $processed_parents = [];
            foreach ($menus as $key => $value1) {
                if (!$value1["sn_padre"] && $value1["id_menupadre"] == null) {
            ?>
                    <li class="menu__item">
                        <a href="<?= base_url() . "/detalle/" . $value1["id_menu"]; ?>" class="menu__link"><?= $value1["nombre_menu"] ?></a>
                    </li>
                    <?php
                } else {
                    if (!in_array($value1["id_menupadre"], $processed_parents) && $value1["nombre_menu_padre"] != "") {
                        $processed_parents[] = $value1["id_menupadre"];
                    ?>
                        <li class="menu__item menu__item--show">
                            <a href="#" class="menu__link">
                                <?= $value1["nombre_menu_padre"] ?>
                                <img src="<?= images_url() ?>/arrow.svg" class="menu__arrow" />
                            </a>

                            <ul class="menu__nesting">
                                <?php foreach ($menus as $key => $value2) { ?>
                                    <?php if ($value1["id_menupadre"] == $value2["id_menupadre"]) { ?>
                                        <li class="menu__inside">
                                            <a href="<?= base_url() . "/detalle/" . $value2["id_menu"]; ?>" class="menu__link menu__link--inside"><?= $value2["nombre_menu"] ?></a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php
                    } else if ($value1["id_menupadre"] != null && !in_array($value1["id_menupadre"], $processed_parents)) {
                        // Handle menus without a parent menu
                    ?>
                        <li class="menu__item">
                            <a href="<?= base_url() . "/detalle/" . $value1["id_menu"]; ?>" class="menu__link"><?= $value1["nombre_menu"] ?></a>
                        </li>
            <?php
                    }
                }
            }
            ?>
        </ul>
    </section>
</nav>