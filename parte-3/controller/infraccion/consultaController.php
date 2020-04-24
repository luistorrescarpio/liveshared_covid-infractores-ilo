<?php 
require "../../system/start.php";

// Models(["asistencia/test"]);
Models(["individuo/ind_tool"]);

switch ($obj['action']) {
	case 'infraccion_checkXid':
		$inf = @query("SELECT * FROM infraccion WHERE id_infraccion='{$obj['idinf']}'")[0];
		res($inf);
		break;
	case 'individuo_record':
		$ind = $Model["ind_tool"]->getData($obj['idind']);
		// print_r($ind);
		if(!$ind) //Si no exite
			res([
				"success"=>0
				,"message"=>"No se encontro individuo"
			]);

		$infs = query("SELECT inf.* FROM individuo AS ind 
					INNER JOIN infraccion AS inf ON ind.id_individuo = inf.id_individuo
					WHERE ind.id_individuo=".$ind["id_individuo"]." ORDER BY inf_regis_dtime DESC");
		res([
			"success"=>1
			,"ind"=>$ind //info individuo
			,"infs"=>$infs //offenses list
		]);

		break;
	case 'search_fast':
		$r = query("SELECT ind.id_individuo, ind.ind_nro_doc, ind.ind_nombres, ind.ind_apellidos, COUNT(inf.id_infraccion) AS nro_infracciones FROM individuo AS ind
			LEFT JOIN infraccion AS inf ON ind.id_individuo=inf.id_individuo
			WHERE 1=1 AND ( CONCAT(ind.ind_nombres,' ', ind.ind_apellidos) LIKE '%".$obj['word']."%' OR ind.ind_nro_doc LIKE '%".$obj['word']."%' )
			GROUP BY ind.ind_nro_doc, ind.ind_nombres, ind.ind_apellidos");

		res($r);
		break; 
}