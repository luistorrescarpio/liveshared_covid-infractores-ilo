<?php 
require "../../system/start.php";

// Models(["individuo/ind_tool"]);

switch ($obj['action']) {
	case 'addToInd': //Add Infraccion to individuo
		$id = query("INSERT INTO infraccion (inf_tipo,inf_placa,inf_razon_social,inf_propietario,inf_localizacion,inf_regis_dtime,id_usuario,inf_motivo,id_individuo)
		VALUES('{$obj['inf_tipo']}','{$obj['inf_placa']}','{$obj['inf_razon_social']}','{$obj['inf_propietario']}','{$obj['inf_localizacion']}','{$obj['inf_regis_dtime']}','".sess('user')['id_usuario']."','{$obj['inf_motivo']}','{$obj['id_individuo']}')");


		if($id>0)
			res([
				"success"=>1
				,"message"=>"Infracción registrada"
				,"id"=>$id
				,"error"=>@$id["error"]
			]);
		else
			res([
				"success"=>0
				,"message"=>"Error al registrar Infracción"
				,"error"=>@$id["error"]
			]);
		break;
}