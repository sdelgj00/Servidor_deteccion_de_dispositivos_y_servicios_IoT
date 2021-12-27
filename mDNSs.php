<!DOCTYPE html>

<html>
 
<head>
    <title>mDNSs</title>  
    <link href="estilo.css" rel="stylesheet" type="text/css" />
    <script src="scriptPags.js" type="text/javascript"></script>
    
</head>
 
<body>
	<nav><ul>
        <li><a href="Dispositivos.php">Dispositivos</a></li>
        <li><a href="#">Protocolos IoT</a>
            <ul><li><a href="UPnPs.php">UPnP</a></li>
            <li><a href="mDNSs.php">mDNS</a></li>
            <li><a href="WS-Discoverys.php">WS-Discovery</a></li>
            </li>
    </ul></nav>
    <h1>Servicios mDNS</h1>

	<table>
		<tr>
			<th>IP</th><th>Port</th><th>ID App</th><th>ID App mDNS</th>
		</tr>
        <?php
        require("accesoSql.php");
        $accesosql=new accesoSql();
        $apps=$accesosql->sql("SELECT * FROM app");
        $existeAppMDNS=$accesosql->sql("SELECT * FROM app_mdns");
        foreach($apps as $i){
            foreach($existeAppMDNS as $j){
                if($i["ID"]==$j["ID_APP"]){
                    echo "<tr onclick=irMDNS(".$j["ID"].",'".$i["IP"]."',".$i["Port"].")>
                        <td>".$i["IP"]."</td><td>".$i["Port"]."</td><td>".$i["ID"]."</td><td>".$j["ID"]."</td>
                    </tr>";       
                }
            }
        }
    ?>
 	</table>
 
</body>
</html>