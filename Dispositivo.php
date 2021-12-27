<html>
 
<head>
    <title>Dispositivo</title>  
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
    <h1>Dispositivo <?php echo $_GET['ip'];?></h1>
    <h2>Puertos</h2>
	<table>
		<tr>
			<th>ID</th><th>Port</th><th>Type</th><th>State</th><th>Name</th><th>Product</th><th>Version</th><th>Extra Info</th><th>Conf</th><th>CPE</th>
		</tr>
        <?php
        require("accesoSql.php");
        $accesosql=new accesoSql();
        $puertos=$accesosql->sql("SELECT * FROM port WHERE IP= '".$_GET['ip']."'");
        foreach($puertos as $i){
            echo "<tr onclick=irPort(".$i["Port"].",".$i["ID"].")>
                <td>".$i["ID"]."</td><td>".$i["Port"]."</td><td>".$i["Type"]."</td><td>".$i["State"]."</td><td>".$i["Name"]."</td><td>".$i["Product"]."</td><td>".$i["Version"]."</td><td>".$i["ExtraInfor"]."</td><td>".$i["Conf"]."</td><td>".$i["Cpe"]."</td>
            </tr>";
        }
    ?>
	</table>
    <h2>OS</h2>
    <table>
		<tr>
			<th>ID</th><th>Name</th><th>Accuracy</th><th>Line</th>
		</tr>
        <?php
        $accesosql=new accesoSql();
        $os_script=$accesosql->sql("SELECT * FROM os_script WHERE IP= '".$_GET['ip']."'");
        foreach($os_script as $i){
            echo "<tr onclick=irOS(".$i["ID"].")>
                <td>".$i["ID"]."</td><td>".$i["Name"]."</td><td>".$i["Accuracy"]."</td><td>".$i["Line"]."</td>
            </tr>";
        }
    ?>
 	</table>
     <h2>UPnP</h2>
    <table>
		<tr>
			<th>ID App</th><th>ID App UPnP</th><th>Port</th><th>Name</th>
		</tr>
        <?php
        $accesosql=new accesoSql();
        $apps=$accesosql->sql("SELECT * FROM app WHERE IP= '".$_GET['ip']."'");
        foreach($apps as $i){
            $existeAppUPnP=$accesosql->sql("SELECT * FROM app_upnp WHERE ID_APP ='".$i["ID"]."'");
            if(count($existeAppUPnP)>0){
                echo "<tr onclick=irUPnP(".$existeAppUPnP[0]["ID"].",'".$_GET["ip"]."',".$i["Port"].")>
                    <td>".$i["ID"]."</td><td>".$existeAppUPnP[0]["ID"]."</td><td>".$i["Port"]."</td><td>".$existeAppUPnP[0]["Name"]."</td>
                </tr>";
            }
        }
    ?>
 	</table>
     <h2>mDNS</h2>
    <table>
		<tr>
			<th>ID App</th><th>ID App mDNS</th>
		</tr>
        <?php
        $accesosql=new accesoSql();
        foreach($apps as $i){
            $existeAppMDNS=$accesosql->sql("SELECT * FROM app_mdns WHERE ID_APP ='".$i["ID"]."'");
            if(count($existeAppMDNS)>0){
                echo "<tr onclick=irMDNS(".$existeAppMDNS[0]["ID"].",'".$_GET["ip"]."',".$i["Port"].")>
                    <td>".$i["ID"]."</td><td>".$existeAppMDNS[0]["ID"]."</td>
                </tr>";
            }
        }
    ?>
 	</table>
     <h2>WS-Discovery</h2>
    <table>
		<tr>
			<th>ID app</th><th>ID app WS-Discovery</th>
		</tr>
        <?php
        $accesosql=new accesoSql();
        foreach($apps as $i){
            $existeAppWSDiscovery=$accesosql->sql("SELECT * FROM app_wsdiscovery WHERE ID_APP ='".$i["ID"]."'");
            if(count($existeAppWSDiscovery)>0){
                /*echo "<tr onclick=irMDNS(".$existeAppWSDiscovery[0]["ID"].",'".$_GET["ip"]."',".$i["Port"].")>
                    <td>".$i["ID"]."</td><td>".$existeAppWSDiscovery[0]["ID"]."</td><td>".$existeAppWSDiscovery[0]["EPR"]."</td>
                    <td>".$existeAppWSDiscovery[0]["InstanceID"]."</td><td>".$existeAppWSDiscovery[0]["MessageNumber"]."</td><td>".$existeAppWSDiscovery[0]["MetadataVersion"]."</td>
                    <td>".$existeAppWSDiscovery[0]["XAddrs"]."</td>
                </tr>";
                
                
                */
                echo "<tr onclick=irWSDiscovery(".$existeAppWSDiscovery[0]["ID"].",'".$_GET["ip"]."',".$i["Port"].")>
                    <td>".$i["ID"]."</td><td>".$existeAppWSDiscovery[0]["ID"]."</td>
                </tr>";
            }
        }
    ?>
 	</table>

</body>
</html>