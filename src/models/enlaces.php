<?php

class enlacesModels
{

	public static function enlaces($enlace)
	{
		if (isset($enlace[1]) && $enlace[0] == "detalle") {

			$modulo = "views/pages/detalle.php";
		} else if (
			$enlace[0] == "inicio" ||
			$enlace[0] == "contacto"
		) {
			$modulo = "views/pages/" . $enlace[0] . ".php";
		} else {
			$modulo = "views/pages/error.php";
		}

		// return $modulo;
		return [
			"modulo" => $modulo,
			"title" => $enlace[0]
		];
	}
}
