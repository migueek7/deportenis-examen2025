<?php

class menusControllers
{
    public function getMenu($id = null)
    {
        $menusModel = new menusModels();
        $respuesta = $menusModel->getMenu($id);
        return $respuesta;
    }
    public function addMenu()
    {
        $sn_padre = $_POST["id_menupadre"] == "-1" ? false : true;
        $datos = array(
            "id_menupadre" => $_POST["id_menupadre"] == "-1" ? null : $_POST["id_menupadre"],
            "nb_menu" => $_POST["nombre_menu"],
            "descripcion" => $_POST["descripcion"],
            "sn_padre" => $sn_padre
        );
        $menusModel = new menusModels();
        $respuesta = $menusModel->addMenu($datos);
        return $respuesta;
    }

    public function deleteMenu()
    {
        $id = $_POST["id_menu"];
        $menusModel = new menusModels();
        $respuesta = $menusModel->deleteMenu($id);
        return $respuesta;
    }

    public function updateMenu()
    {
        $sn_padre = $_POST["id_menupadre"] == "-1" ? false : true;
        $datos = array(
            "id_menupadre" => $_POST["id_menupadre"] == "-1" ? null : $_POST["id_menupadre"],
            "id_menu" => $_POST["id_menu"],
            "nb_menu" => $_POST["nombre_menu"],
            "descripcion" => $_POST["descripcion"],
            "sn_padre" => $sn_padre
        );
        $menusModel = new menusModels();
        $respuesta = $menusModel->updateMenu($datos);
        return $respuesta;
    }
}
