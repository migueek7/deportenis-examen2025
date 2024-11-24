<?php
require_once "conexion.php";

class menusModels extends conexion
{
    public function getMenu($id)
    {
        $sql = "SELECT 
            m.id_menu,
            m.id_menupadre,
            m.nb_menu AS nombre_menu,
            m.descripcion,
            m.sn_padre,
            mp.nb_menu AS nombre_menu_padre
        FROM 
            menus m
        LEFT JOIN menus mp ON m.id_menupadre = mp.id_menu
        ";
        if ($id != null) {
            $sql .= " WHERE m.id_menu = $id";
        }
        $stmt = conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
    }

    public function addMenu($datos)
    {
        $sql = "INSERT INTO menus (id_menupadre, nb_menu, descripcion, sn_padre) VALUES (:id_menupadre, :nb_menu, :descripcion, :sn_padre)";
        $stmt = conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id_menupadre", $datos["id_menupadre"], PDO::PARAM_INT);
        $stmt->bindParam(":nb_menu", $datos["nb_menu"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":sn_padre", $datos["sn_padre"], PDO::PARAM_BOOL);
        if ($stmt->execute()) {
            return "success";
        } else {
            return "error";
        }
        $stmt->close();
    }

    public function deleteMenu($id)
    {
        $sql = "DELETE FROM menus WHERE id_menu = :id";
        $stmt = conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "success";
        } else {
            return "error";
        }
        $stmt->close();
    }

    public function updateMenu($datos)
    {
        $sql = "UPDATE menus 
            SET id_menupadre = :id_menupadre, nb_menu = :nb_menu, descripcion = :descripcion, sn_padre = :sn_padre 
            WHERE id_menu = :id_menu";
        $stmt = conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id_menupadre", $datos["id_menupadre"], PDO::PARAM_INT || PDO::PARAM_NULL);
        $stmt->bindParam(":nb_menu", $datos["nb_menu"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":sn_padre", $datos["sn_padre"], PDO::PARAM_BOOL);
        $stmt->bindParam(":id_menu", $datos["id_menu"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "success";
        } else {
            return "error";
        }
        $stmt->close();
    }
}
