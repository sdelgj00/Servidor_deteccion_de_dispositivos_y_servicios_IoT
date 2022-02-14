<html>
 
<head>
    <title>UPnP</title>  
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    require("../constantesCode.php");
    echo constant("INICIO");
    ?>
    
</head>
 
<body>
<?php
echo constant("NAV");
?>
    <br>
    <div class="page-header">
        <h1 class="h1 titulo">UPnP - IP:<?php echo $_GET['IP'] ;?> - Port:<?php echo $_GET['Port'] ;?></h1>
        <hr>
    </div>
    <br>
    <h2 class="titulo">Services</h2>
    <hr>
    <br>

    <table class="text-center table-striped table-responsive-sm table-w contentTable">
    <tr class="bg-warning flex-column">
			<th>ID</th><th>Name</th><th>ID Name</th><th>SCPD</th><th>Control URL</th><th>Event URL</th><th>Base URL</th>
		</tr>
        <tbody  class='table-dark bg-dark flex-column '>
        <?php
        require("../accesoSql.php");
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
 	</tbody></table><br>
	
 
</body>
</html>