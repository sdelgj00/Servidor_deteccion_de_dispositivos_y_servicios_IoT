<html>
 
<head>
    <title>WS-Discovery</title>  
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
    <h1>WS-Discovery - IP:<?php echo $_GET['IP'] ;?> - Port:<?php echo $_GET['Port'] ;?></h1>
    <h2>Services</h2>
	<table>
		<tr>
            <th>ID</th><th>EPR</th><th>Instance ID</th><th>Message Number</th><th>Metadata Version</th><th>XAddrs</th>
		</tr>
        <?php
        require("accesoSql.php");
        $accesosql=new accesoSql();
        $servicios=$accesosql->sql("SELECT * FROM service_wsdiscovery WHERE ID_APP_WSDiscovery= '".$_GET['id']."'");
        foreach($servicios as $i){
            $tituloVul="WS-Discovery_IP:".$_GET["IP"]."_Port:".$_GET["Port"]."_ID:".$i["EPR"];
            $tituloVul=str_replace(" ","",$tituloVul);
            $funTodo="'".$tituloVul."','".$i["ID"]."', 'WS-Discovery'";
            $funTodo=str_replace(" ","",$funTodo);

            echo "<tr onclick=irServWSDiscovery(".$funTodo.")>
                <td>".$i["ID"]."</td><td>".$i["EPR"]."</td><td>".$i["InstanceId"]."</td><td>".$i["MessageNumber"]."</td><td>".$i["MetadataVersion"]."</td><td>".$i["XAddrs"]."</td>
            </tr>";
        }
    ?>
    </table>
	
 
</body>
</html>