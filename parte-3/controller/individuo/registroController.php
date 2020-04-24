<?php 
require "../../system/start.php";

Models(["individuo/ind_tool"]);

switch ($obj['action']) {
	case 'add':
		$dtime_now = date("Y-m-d H:i:s");

		// $obj['ind_tipo_doc'] = "DNI"; // default
		
		// Check DOCUMENT exist
		$exist = $Model['ind_tool']->checkExistDocument($obj['ind_tipo_doc'], $obj['ind_nro_doc']);

		if($exist)
			res([
				"success"=>0
				,"message"=>"[ERROR] DNI ya existente!"
				,"diag"=>"dni_exist"
			]);

		$id = query("INSERT INTO individuo (ind_nro_doc,ind_nombres,ind_apellidos,ind_sexo,ind_edad,id_usuario,ind_regis,ind_tipo_doc)VALUES('{$obj['ind_nro_doc']}','{$obj['ind_nombres']}','{$obj['ind_apellidos']}','{$obj['ind_sexo']}','{$obj['ind_edad']}','".sess("user")["id_usuario"]."','".$dtime_now."','{$obj['ind_tipo_doc']}')");
		if($id>0)
			res([
				"success"=>1
				,"message"=>"Registro exitoso"
				,"id"=>$id
			]);
		else
			res([
				"success"=>0
				,"message"=>"Error al registrar"
				,"error"=>@$id["error"]
			]);
		break;
}
