<html>
 
<head>
    <title>WS-Discovery</title>  
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
        <h1 class="h1 titulo">WS-Discovery - IP:<?php echo $_GET['IP'] ;?> - Port:<?php echo $_GET['Port'] ;?></h1>
        <hr>
    </div>
    <br>
    <h2 class="titulo">Services</h2>
    <hr>
    <br>

    <table class="text-center table-striped table-responsive-sm table-w contentTable">
    <tr class="bg-warning flex-column">
            <th>ID</th><th>EPR</th><th>Instance ID</th><th>Message Number</th><th>Metadata Version</th><th>XAddrs</th>
		</tr>
        <tbody  class='table-dark bg-dark flex-column '>

        <?php
        require("../accesoSql.php");
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
 	</tbody></table><br>
 
</body>
</html>