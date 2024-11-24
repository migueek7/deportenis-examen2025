<?php

namespace App\Controllers;

class Routes
{
    function getRoutes()
    {
        $arrayRutas = [
            'Pages' => [
                ["method" => "GET", "ruta" => "/menus", "function" => "getMenu"],
            ],
        ];

        return $arrayRutas;
    }
}
