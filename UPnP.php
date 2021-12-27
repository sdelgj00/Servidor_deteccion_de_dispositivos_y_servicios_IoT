<html>
 
<head>
    <title>UPnP</title>  
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
    <h1>UPnP - IP:<?php echo $_GET['IP'] ;?> - Port:<?php echo $_GET['Port'] ;?></h1>
    <h2>Services</h2>
	<table>
		<tr>
			<th>ID</th><th>Name</th><th>ID Name</th><th>SCPD</th><th>Control URL</th><th>Event URL</th><th>Base URL</th>
		</tr>
        <?php
        require("accesoSql.php");
        $accesosql=new accesoSql();
        $puertos=$accesosql->sql("SELECT * FROM service_upnp WHERE ID_APP= '".$_GET['id']."'");
        foreach($puertos as $i){
            $tituloVul="UPnP_IP:".$_GET["IP"]."_Port:".$_GET["Port"]."_ID:".$i["ID_Name"];
            $tituloVul=str_replace(" ","",$tituloVul);
            $funTodo="'".$tituloVul."','".$i["ID"]."', 'UPnP'";
            $funTodo=str_replace(" ","",$funTodo);

            echo "<tr onclick=irServUPnP(".$funTodo.")>
                <td>".$i["ID"]."</td><td>".$i["Name"]."</td><td>".$i["ID_Name"]."</td><td>".$i["SCPD"]."</td><td>".$i["ControlUrl"]."</td><td>".$i["EventUrl"]."</td><td>".$i["BaseUrl"]."</td>
            </tr>";
        }
    ?>
    </table>
	
 
</body>
</html>