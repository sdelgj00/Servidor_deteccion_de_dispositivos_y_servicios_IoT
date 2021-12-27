<html>
 
<head>
    <title>Script Puerto</title>  
    <link href="estilo.css" rel="stylesheet" type="text/css" />
    <script src="scriptPags.js" type="text/javascript"></script>
    
</head>
 
<body>
	<nav><ul>
        <li><a href="Dispositivos.html">Dispositivos</a></li>
        <li><a href="#">Quiénes somos</a></li>
        <li><a href="#">Protocolos IoT</a>
            <ul><li><a href="">UPnP</a></li>
            <li><a href="">mDNS</a></li>
            <li><a href="">WS-Discovery</a></li>
            </li>
    </ul></nav>
    <h1>Port Script - Puerto <?php echo $_GET['port'] ;?></h1>
	<table>
		<tr>
			<th>ID</th><th>ID Port</th><th>Key</th><th>Value</th>
		</tr>
        <?php
        require("accesoSql.php");
        $accesosql=new accesoSql();
        $puertos=$accesosql->sql("SELECT * FROM port_script WHERE ID_Port= '".$_GET['id']."'");
        foreach($puertos as $i){
            echo "<tr>
                <td>".$i["ID"]."</td><td>".$i["ID_Port"]."</td><td>".$i["Llave"]."</td><td>".$i["Valor"]."</td>
            </tr>";
        }
    ?>
	</table>
 
</body>
</html>