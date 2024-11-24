<?php

class enlacesControllers
{
	public function enlaces()
	{
		$enlace = [];

		if (isset($_GET["ruta"])) {
			$enlace = explode("/", $_GET["ruta"]);
		} else {
			$enlace = ["inicio"];
		}

		$respuesta = enlacesModels::enlaces($enlace);

		return $respuesta;
	}
}
