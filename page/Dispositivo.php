<html>
 
<head>
    <title>Dispositivo</title>  
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
        <h1 class="h1 titulo">Dispositivo <?php echo $_GET['ip'];?></h1>
        <hr>
    </div>

    <br>
    <h2 class="titulo">Puertos</h2>
    <hr>
    <br>

    <table class="text-center table-striped table-responsive-sm table-w contentTable">
        <tr class="bg-warning flex-column">
			<th>ID</th><th>Port</th><th>Type</th><th>State</th><th>Name</th><th>Product</th><th>Version</th><th>Extra Info</th><th>Conf</th><th>CPE</th>
		</tr>
        <tbody  class='table-dark bg-dark flex-column '>
        <?php
        require("../accesoSql.php");
        $accesosql=new accesoSql();
        $puertos=$accesosql->sql("SELECT * FROM port WHERE IP= '".$_GET['ip']."'");
        foreach($puertos as $i){
            echo "<tr onclick=irPort(".$i["Port"].",".$i["ID"].")>
                <td>".$i["ID"]."</td><td>".$i["Port"]."</td><td>".$i["Type"]."</td><td>".$i["State"]."</td><td>".$i["Name"]."</td><td>".$i["Product"]."</td><td>".$i["Version"]."</td><td>".$i["ExtraInfor"]."</td><td>".$i["Conf"]."</td><td>".$i["Cpe"]."</td>
            </tr>";
        }
    ?>
      </tbody></table>

    <br>
    <h2 class="titulo">OS</h2>
    <hr>
    <br>

    <table class="text-center table-striped table-responsive-sm table-w contentTable">
        <tr class="bg-warning flex-column">
			<th>ID</th><th>Name</th><th>Accuracy</th><th>Line</th>
		</tr>
        <tbody  class='table-dark bg-dark flex-column '>
        <?php
        $accesosql=new accesoSql();
        $os_script=$accesosql->sql("SELECT * FROM os_script WHERE IP= '".$_GET['ip']."'");
        foreach($os_script as $i){
            echo "<tr onclick=irOS(".$i["ID"].")>
                <td>".$i["ID"]."</td><td>".$i["Name"]."</td><td>".$i["Accuracy"]."</td><td>".$i["Line"]."</td>
            </tr>";
        }
    ?>
 	</tbody></table>
     
     <br>
     <h2 class="titulo">UPnP</h2>
     <hr>
     <br>

     <table class="text-center table-striped table-responsive-sm table-w contentTable">
     <tr class="bg-warning flex-column">
			<th>ID App</th><th>ID App UPnP</th><th>Port</th><th>Name</th>
		</tr>
        <tbody  class='table-dark bg-dark flex-column '>
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
 	</tbody></table>
          
     <br>
     <h2 class="titulo">mDNS</h2>
     <hr>
     <br>

     <table class="text-center table-striped table-responsive-sm table-w contentTable">
     <tr class="bg-warning flex-column">
			<th>ID App</th><th>ID App mDNS</th><th>Port</th>
		</tr>
        <tbody  class='table-dark bg-dark flex-column '>
        <?php
        $accesosql=new accesoSql();
        foreach($apps as $i){
            $existeAppMDNS=$accesosql->sql("SELECT * FROM app_mdns WHERE ID_APP ='".$i["ID"]."'");
            if(count($existeAppMDNS)>0){
                echo "<tr onclick=irMDNS(".$existeAppMDNS[0]["ID"].",'".$_GET["ip"]."',".$i["Port"].")>
                    <td>".$i["ID"]."</td><td>".$existeAppMDNS[0]["ID"]."</td><td>".$i["Port"]."</td>
                </tr>";
            }
        }
    ?>
 	</tbody></table>
             
     <br>
     <h2 class="titulo">WS-Discovery</h2>
     <hr>
     <br>

     <table class="text-center table-striped table-responsive-sm table-w contentTable">
     <tr class="bg-warning flex-column">
			<th>ID app</th><th>ID app WS-Discovery</th><th>Port</th>
		</tr>
        <tbody  class='table-dark bg-dark flex-column '>
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
                    <td>".$i["ID"]."</td><td>".$existeAppWSDiscovery[0]["ID"]."</td><td>".$i["Port"]."</td>
                </tr>";
            }
        }
    ?>
 	</tbody></table><br>

</body>
</html>