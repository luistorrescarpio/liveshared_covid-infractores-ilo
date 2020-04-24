<?php 
require "../../system/start.php";

Models(["individuo/ind_tool"]);

switch ($obj['action']) {
	case 'ind_getdata':
		$ind = $Model["ind_tool"]->getData($obj['idind']);
		res($ind);
		break;
}
