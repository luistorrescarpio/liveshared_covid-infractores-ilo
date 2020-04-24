<?php 
class ind_tool_model{
	public function checkExistDocument($TIPO_DOC, $NRO_DOC){
		$r = @query("SELECT id_individuo FROM individuo WHERE ind_nro_doc='".$NRO_DOC."' AND ind_tipo_doc='".$TIPO_DOC."'")[0]["id_individuo"];
		return $r;
	}
	public function getData($idind){
		$r = @query("SELECT * FROM individuo WHERE id_individuo='{$idind}' ")[0];
		return $r;
	}
}
 ?>