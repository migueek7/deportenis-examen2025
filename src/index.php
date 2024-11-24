<?php
require_once "./vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once "helpers/helpers.php";
require_once "controllers/enlaces.php";
require_once "controllers/menus.php";
require_once "controllers/template.php";
require_once "models/enlaces.php";
require_once "models/menus.php";
require_once "models/conexion.php";
require_once "controllers/routes.php";

function rutas()
{
    $rutas = [];
    if (isset($_GET['ruta'])) {
        $rutas = rtrim($_GET['ruta'], '/');
        $rutas = explode('/', $rutas);
    }
    return $rutas;
}
$rutas = rutas();
// print_r($rutas);
// echo "<br>";
if (isset($rutas[0]) && $rutas[0] == "menus") {
    $menus = new menusControllers();
    if (isset($rutas[1])) {
        $menu = $menus->getMenu($rutas[1]);
    } else {
        $menu = $menus->getMenu(null);
    }
    echo json_encode($menu);
} elseif (isset($rutas[0]) && $rutas[0] == "addMenu") {
    $menus = new menusControllers();
    $menu = $menus->addMenu();
    echo json_encode($menu);
} elseif (isset($rutas[0]) && $rutas[0] == "updateMenu") {
    $menus = new menusControllers();
    $menu = $menus->updateMenu();
    echo json_encode($menu);
} elseif (isset($rutas[0]) && $rutas[0] == "deleteMenu") {
    $menus = new menusControllers();
    $menu = $menus->deleteMenu();
    echo json_encode($menu);
} else {
    $template = new templateControllers();
    $template->template();
}
