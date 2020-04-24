<?php 
require "../../system/start.php";

Models(["asistencia/test"]);

switch ($obj['action']) {
	case 'saludo':
		res([
			"message"=>$Model['test']->getSaludo()
		]);
		break; 
}