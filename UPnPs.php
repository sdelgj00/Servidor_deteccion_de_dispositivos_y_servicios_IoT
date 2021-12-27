<!DOCTYPE html>

<html>
 
<head>
    <title>UPnPs</title>  
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
    <h1>Servicios UPnP</h1>

	<table>
		<tr>
			<th>IP</th><th>Port</th><th>ID App</th><th>ID App UPnP</th><th>Name</th>
		</tr>
        <?php
        require("accesoSql.php");
        $accesosql=new accesoSql();
        $apps=$accesosql->sql("SELECT * FROM app");
        $existeAppUPnP=$accesosql->sql("SELECT * FROM app_upnp");
        foreach($apps as $i){
            foreach($existeAppUPnP as $j){
                if($i["ID"]==$j["ID_APP"]){
                    echo "<tr onclick=irUPnP(".$j["ID"].",'".$i["IP"]."',".$i["Port"].")>
                        <td>".$i["IP"]."</td><td>".$i["Port"]."</td><td>".$i["ID"]."</td><td>".$j["ID"]."</td><td>".$j["Name"]."</td>
                    </tr>";       
                }
            }
        }
    ?>
 	</table>
 
</body>
</html>