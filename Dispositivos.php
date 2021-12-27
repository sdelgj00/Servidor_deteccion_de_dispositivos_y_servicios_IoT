<!DOCTYPE html>

<html>
 
<head>
    <title>Dispositivos</title>  
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
    <h1>Dispositivos</h1>

	<table>
		<tr>
			<th>IP</th><th>Host Name</th><th>Type</th><th>Mac</th><th>Vendor</th><th>Uptime</th><th>State</th>
		</tr>
        <?php
        require("accesoSql.php");
        $accesosql=new accesoSql();
        $dispositivos=$accesosql->sql("SELECT * FROM dispositivo");
        foreach($dispositivos as $i){
            echo "<tr onclick=irDispositivo('".$i["IP"]."')>
                <td class='IP'>".$i["IP"]."</td><td>".$i["HostName"]."</td><td>".$i["Type"]."</td><td>".$i["Mac"]."</td><td>".$i["Vendor"]."</td><td>".$i["Uptime"]."</td><td>".$i["State"]."</td>
            </tr>";
        }
    ?>
	</table>
 
</body>
</html>