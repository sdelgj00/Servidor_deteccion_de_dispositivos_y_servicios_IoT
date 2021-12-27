<html>
 
<head>
    <title>Clases OS</title>  
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
    <h1>Clases OS - <?php
    require("accesoSql.php");
    $accesosql=new accesoSql();
    $claseOs=$accesosql->sql("SELECT * FROM os_script WHERE ID='".$_GET["id"]."'");
    echo $claseOs[0]["Name"] ;
    ?></h1>
	<table>
		<tr>
			<th>ID</th><th>Type</th><th>Vendor</th><th>OS Family</th><th>OS Generation</th><th>Accuracy</th><th>CPE</th>
		</tr>
        <?php
        
        $puertos=$accesosql->sql("SELECT * FROM os_class WHERE ID_os_script= '".$_GET['id']."'");
        foreach($puertos as $i){
            echo "<tr>
                <td>".$i["ID"]."</td><td>".$i["Type"]."</td><td>".$i["Vendor"]."</td><td>".$i["Osfamily"]."</td><td>".$i["Osgen"]."</td><td>".$i["Accuracy"]."</td><td>".$i["Cpe"]."</td>
            </tr>";
        }
    ?>
	</table>
 
</body>
</html>