<?php 
require "../system/start.php";

// Models(["asistencia/test"]);

switch ($obj['action']) {
	case 'saludo':
		res([
			// "message"=>$Model['test']->getSaludo()
			"message"=>"Hola mundo"
		]);
		break;
	case 'user_list':
		$r = query("SELECT * FROM usuario");
		res($r);
		break; 
	case 'getData':
		try {
		    $doc = $client->getDoc("2020-03-08T02:46:26.604Z");
		} catch ( Exception $e ) {
		    if ( $e->getCode() == 404 ) {
		       echo "Document 2020-03-08T02:46:26.604Z does not exist !";
		        }
		    exit(1);
		}
		print_r($doc);
		res("Hola couchdb");
		break;
}