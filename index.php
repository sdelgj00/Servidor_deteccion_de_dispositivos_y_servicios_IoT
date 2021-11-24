<?php
require("accesoSql.php");
echo INICIO;
$AccesoSql=new accesoSql();
$r=$AccesoSql->mostrarApps();

echo "<div id=divTabla>";
echo $r;
echo "</div>";
echo FIN;