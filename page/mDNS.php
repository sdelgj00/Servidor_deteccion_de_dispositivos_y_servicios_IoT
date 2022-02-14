<html>
 
<head>
    <title>mDNS</title>  
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
        <h1 class="h1 titulo">mDNS - IP:<?php echo $_GET['IP'] ;?> - Port:<?php echo $_GET['Port'] ;?></h1>
        <hr>
    </div>
    <br>
    <h2 class="titulo">Services</h2>
    <hr>
    <br>
    <table class="text-center table-striped table-responsive-sm table-w contentTable">
    <tr class="bg-warning flex-column">
			<th>ID</th><th>Name</th><th>Type</th><th>Weight</th><th>Priority</th><th>Server</th><th>Interface Index</th>
		</tr>
        <tbody  class='table-dark bg-dark flex-column '>

        <?php
        require("../accesoSql.php");
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
 	</tbody></table><br>
	
 
</body>
</html>