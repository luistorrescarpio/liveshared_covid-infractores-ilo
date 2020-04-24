<?php 
require "../../system/start.php";

// Models(["asistencia/test"]);

switch ($obj['action']) {
	case 'close_session':
		sess_destroy();
		header("Location: {$view}/login.php");
		break;
	case 'logear':
		$r = query("SELECT * FROM usuario WHERE us_login='{$obj['login']}' AND us_pass='{$obj['pass']}'");
		if(count($r)>0){
			sess("user", $r[0]);
			sess($r[0]["us_agent"], 1);
			sess("user_dir", $view."/".$r[0]["us_agent"]);

			res([
				"success"=>1,
				"message"=>"Acceso correcto",
				"rdr"=>sess("user_dir")."/index.php"
			]);
		}else{
			res([
				"success"=>0,
				"message"=>"Acceso Incorrecto",
				"error"=>@$r["error"]
			]);
		}
		break;
}