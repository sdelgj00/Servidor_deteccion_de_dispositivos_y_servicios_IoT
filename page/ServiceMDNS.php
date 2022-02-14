<html>
 
<head>
    <title>Servicio mDNS</title>  
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
        <h1 class="h1 titulo"><?php echo str_replace("_"," - ",$_GET["Title"]);?></h1>
        <hr>
    </div>

    <br>
    <h2 class="titulo">Vulnerabilities</h2>
    <hr>
    <br>

     <table class="text-center table-striped table-responsive-sm table-w contentTable">
        <tr class="bg-warning flex-column">
			<th>ID</th><th>Publish Date</th><th>Last Modified Date</th><th>Lang</th>
            <th>CVE</th><th>CWE description</th><th>CWE</th>
		</tr>
        <tbody  class='table-dark bg-dark flex-column '>
        <?php
        require("../accesoSql.php");
        $accesosql=new accesoSql();
        $vuls;
        if($_GET["Prot"]=="UPnP"){
            $vuls=$accesosql->sql("SELECT * FROM vulnerability_upnp WHERE ID_SERVICE= '".$_GET['id']."'");
        }else if($_GET["Prot"]=="mDNS"){
            $vuls=$accesosql->sql("SELECT * FROM vulnerability_mdns WHERE ID_SERVICE= '".$_GET['id']."'");
        }else if($_GET["Prot"]=="WS-Discovery"){
            $vuls=$accesosql->sql("SELECT * FROM vulnerability_wsdiscovery WHERE ID_SERVICE= '".$_GET['id']."'");
        }
        foreach($vuls as $i){
            echo "<tr>
                <td>".$i["ID"]."</td><td>".$i["PublishDate"]."</td><td>".$i["LastModifiedDate"]."</td><td>".$i["Lang"]."</td><td><a href='".$i["CVEurl"]."'>".$i["CVE"]."</a></td>
                <td>".$i["CWEdescr"]."<td><a href='".$i["CWEurl"]."'>".$i["CWE"]."</a></td>
            </tr>";
        }
    ?>
      </tbody></table>
    <br>
    <h2 class="titulo">Properties</h2>
    <hr>
    <br>
    <table class="text-center table-striped table-responsive-sm table-w contentTable">
        <tr class="bg-warning flex-column">
			<th>ID</th><th>Key</th><th>Value</th>
		</tr>
        <tbody  class='table-dark bg-dark flex-column '>
    <?php
    $prop=$accesosql->sql("SELECT * FROM property_mdns WHERE ID_SERVICE_MDNS= '".$_GET['id']."'");
    foreach($prop as $i){
        echo "<tr>
            <td>".$i["ID"]."</td><td>".$i["Llave"]."</td><td>".$i["Valor"]."</td>
        </tr>";
    }   
    ?>
 	</tbody></table><br>
 
</body>
</html>