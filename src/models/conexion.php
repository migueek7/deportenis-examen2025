<?php
class Conexion
{
    public static function conectar()
    {
        $servername = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_NAME'];
        $charset = $_ENV['DB_CHARSET'];

        try {
            $opt = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
            $link = new PDO('mysql:host=' . $servername . ';port=' . $port . ';dbname=' . $dbname . ';charset=' . $charset, $username, $password, $opt);
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $link;
        } catch (\PDOException $e) {
            die(json_encode('Error de conexion'));
            exit();
        }
    }
}
