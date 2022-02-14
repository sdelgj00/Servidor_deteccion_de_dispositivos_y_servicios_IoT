<!DOCTYPE html>

<html>
 
<head>
    <title>mDNSs</title>  
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
        <h1 class="h1 titulo">Servicios mDNS</h1>
        <hr>
    </div>
    <br>

    <table class="text-center table-striped table-responsive-sm table-w contentTable">
    <tr class="bg-warning flex-column">
			<th>IP</th><th>Port</th><th>ID App</th><th>ID App mDNS</th>
		</tr>
        <tbody  class='table-dark bg-dark flex-column '>
        <?php
        require("../accesoSql.php");
        $accesosql=new accesoSql();
        $apps=$accesosql->sql("SELECT * FROM app");
        $existeAppMDNS=$accesosql->sql("SELECT * FROM app_mdns");
        foreach($apps as $i){
            foreach($existeAppMDNS as $j){
                if($i["ID"]==$j["ID_APP"]){
                    echo "<tr onclick=irMDNS(".$j["ID"].",'".$i["IP"]."',".$i["Port"].")>
                        <td>".$i["IP"]."</td><td>".$i["Port"]."</td><td>".$i["ID"]."</td><td>".$j["ID"]."</td>
                    </tr>";       
                }
            }
        }
    ?>
 	</tbody></table><br>
 
</body>
</html>