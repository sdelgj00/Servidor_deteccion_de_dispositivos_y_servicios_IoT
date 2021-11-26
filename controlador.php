<?php
error_reporting(0);

require("accesoSql.php");

$json=file_get_contents('php://input');
echo $json;


$jsonDecoded=json_decode($json,true);
$clave=$jsonDecoded["Peticion"];
$info=$jsonDecoded["info"];
$AccesoSql=new accesoSql();

if($clave=="UPnP"||$clave=="mDNS"){
    echo "jsond: ".$jsonDecoded."\n\n";
    $r=$AccesoSql->anyadirBase($info);
	echo $r;
}
if($_GET["APP"]){
    $r=$AccesoSql->mostrarApp($_GET["APP"]);
    echo $r;
}



