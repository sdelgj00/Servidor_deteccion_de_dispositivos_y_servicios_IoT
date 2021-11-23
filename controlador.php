<?php
require("accesoSql.php");

$json=file_get_contents('php://input');
echo $json;


$jsonDecoded=json_decode($json,true);
echo "jsond: ".$jsonDecoded."\n\n";
$clave=$jsonDecoded["Peticion"];
$info=$jsonDecoded["info"];
$AccesoSql=new accesoSql();

if($clave=="UPnP"||$clave=="mDNS"){
	$r=$AccesoSql->anyadirBase($info);
	echo $r;
}



