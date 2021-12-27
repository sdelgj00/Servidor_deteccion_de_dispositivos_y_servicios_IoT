<html>
 
<head>
    <title>mDNS</title>  
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
    <h1>mDNS - IP:<?php echo $_GET['IP'] ;?> - Port:<?php echo $_GET['Port'] ;?></h1>
    <h2>Services</h2>
	<table>
		<tr>
			<th>ID</th><th>Name</th><th>Type</th><th>Weight</th><th>Priority</th><th>Server</th><th>Interface Index</th>
		</tr>
        <?php
        require("accesoSql.php");
        $accesosql=new accesoSql();
        $servicios=$accesosql->sql("SELECT * FROM service_mdns WHERE ID_APP_MDNS= '".$_GET['id']."'");
        foreach($servicios as $i){
            $tituloVul="mDNS_IP:".$_GET["IP"]."_Port:".$_GET["Port"]."_ID:".$i["Name"];
            $tituloVul=str_replace(" ","",$tituloVul);
            $funTodo="'".$tituloVul."','".$i["ID"]."', 'mDNS'";
            $funTodo=str_replace(" ","",$funTodo);

            echo "<tr onclick=irServMDNS(".$funTodo.")>
                <td>".$i["ID"]."</td><td>".$i["Name"]."</td><td>".$i["Type"]."</td><td>".$i["Weight"]."</td><td>".$i["Priority"]."</td><td>".$i["Server"]."</td><td>".$i["InterfaceIndex"]."</td>
            </tr>";
        }
    ?>
    </table>
	
 
</body>
</html>