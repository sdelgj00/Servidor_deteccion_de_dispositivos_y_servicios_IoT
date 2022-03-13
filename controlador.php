<?php
error_reporting(0);

require("accesoSql.php");

$json=file_get_contents('php://input');
echo "---SERVIDOR---\n";
echo $json."\n";

$jsonDecoded=json_decode($json,true);
$clave=$jsonDecoded["Peticion"];
$info=$jsonDecoded["info"];
$AccesoSql=new accesoSql();
echo "\nProcesando peticion: ".$clave."\n";
//Faltaría conseguir json para enviar de forma rapida desde el rest client
//cosas capadas de ejecución
if($clave=="UPnP"||$clave=="mDNS"||$clave=="WS-Discovery"||$clave=="Nmap"){
    $r=$AccesoSql->anyadirBase($info,$clave);
	echo $r;
}else if($clave="All"){
    foreach ($info as $k => $v){
        echo "--".$k."\n\n";
        $r = $AccesoSql->anyadirBase($v, $k);
        echo $r;

    }
}