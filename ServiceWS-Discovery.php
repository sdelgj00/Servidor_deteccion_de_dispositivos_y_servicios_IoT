<html>
 
<head>
    <title>Servicio WS-Discovery</title>  
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

    <h1><?php echo str_replace("_"," - ",$_GET["Title"]);?></h1>
    <h2>Vulnerabilities</h2>
    <table>
		<tr>
			<th>ID</th><th>Publish Date</th><th>Last Modified Date</th><th>Description</th><th>Lang</th><th>bmv2severity </th><th>bmv2explitabilityScore</th>
            <th>bmv2impactScore</th><th>bmv2acInsufInfo</th><th>bmv2obtainAllPrivilege</th><th>bmv2obtainUserPrivilege</th><th>bmv2obtainOtherPrivilege</th><th>bmv2userInteractionRequired</th>
            <th>bmv2accessVector</th><th>bmv2accessComplexity</th><th>bmv2authentication</th><th>bmv2confidentialityImpact</th><th>bmv2integrityImpact</th><th>bmv2availabilityImpact</th><th>bmv2baseScore</th>
            <th>bmv3exploitabilityScore</th><th>bmv3impactScore</th><th>bmv3attackVector</th><th>bmv3attackComplexity</th><th>bmv3privilegesRequired</th><th>bmv3userInteraction</th><th>bmv3scope</th>
            <th>bmv3confidentialImpact</th><th>bmv3integrityImpact</th><th>bmv3availabilityImpact</th><th>bmv3baseScore</th><th>bmv3baseSeverity</th>
		</tr>
        <?php
        require("accesoSql.php");
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
                <td>".$i["ID"]."</td><td>".$i["PublishDate"]."</td><td>".$i["LastModifiedDate"]."</td><td>".$i["Description"]."</td><td>".$i["Lang"]."</td><td>".$i["bmv2severity"]."</td><td>".$i["bmv2explitabilityScore"]."</td>
                <td>".$i["bmv2impactScore"]."</td><td>".$i["bmv2acInsufInfo"]."</td><td>".$i["bmv2obtainAllPrivilege"]."</td><td>".$i["bmv2obtainUserPrivilege"]."</td><td>".$i["bmv2obtainOtherPrivilege"]."</td>
                <td>".$i["bmv2userInteractionRequired"]."</td><td>".$i["bmv2accessVector"]."</td><td>".$i["bmv2accessComplexity"]."</td><td>".$i["bmv2authentication"]."</td><td>".$i["bmv2confidentialityImpact"]."</td>
                <td>".$i["bmv2integrityImpact"]."</td><td>".$i["bmv2availabilityImpact"]."</td><td>".$i["bmv2baseScore"]."</td><td>".$i["bmv3exploitabilityScore"]."</td><td>".$i["bmv3impactScore"]."</td><td>".$i["bmv3attackVector"]."</td>
                <td>".$i["bmv3attackComplexity"]."</td><td>".$i["bmv3privilegesRequired"]."</td><td>".$i["bmv3userInteraction"]."</td><td>".$i["bmv3scope"]."</td><td>".$i["bmv3confidentialImpact"]."</td><td>".$i["bmv3integrityImpact"]."</td>
                <td>".$i["bmv3availabilityImpact"]."</td><td>".$i["bmv3baseScore"]."</td><td>".$i["bmv3baseSeverity"]."</td>
            </tr>";
        }
    ?>
	</table>
    <h2>Types</h2>
    <table>
		<tr>
			<th>ID</th><th>Type Name</th>
		</tr>
    <?php
    $types=$accesosql->sql("SELECT * FROM type_wsdiscovery WHERE ID_SERVICE= '".$_GET['id']."'");
    foreach($types as $i){
        echo "<tr>
            <td>".$i["ID"]."</td><td>".$i["TypeName"]."</td>
        </tr>";
    }   
    ?>
	</table>

    <h2>Scopes</h2>
    <table>
		<tr>
			<th>ID</th><th>Match By</th><th>QuotedValue</th><th>Value</th>
		</tr>
    <?php
    $scopes=$accesosql->sql("SELECT * FROM scope_wsdiscovery WHERE ID_SERVICE= '".$_GET['id']."'");
    foreach($scopes as $i){
        echo "<tr>
            <td>".$i["ID"]."</td><td>".$i["MatchBy"]."</td><td>".$i["QuotedValue"]."</td><td>".$i["Value"]."</td>
        </tr>";
    }   
    ?>
	</table>
 
</body>
</html>