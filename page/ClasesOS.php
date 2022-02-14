<html>
 
<head>
    <title>Clases OS</title>  
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
        <h1 class="h1 titulo">Clases OS - <?php
            require("../accesoSql.php");
    $accesosql=new accesoSql();
    $claseOs=$accesosql->sql("SELECT * FROM os_script WHERE ID='".$_GET["id"]."'");
    echo $claseOs[0]["Name"] ;
    ?></h1>
        <hr>
    </div>
    <br>
    <table class="text-center table-striped table-responsive-sm table-w contentTable">
    <tr class="bg-warning flex-column">
			<th>ID</th><th>Type</th><th>Vendor</th><th>OS Family</th><th>OS Generation</th><th>Accuracy</th><th>CPE</th>
		</tr>
        <tbody  class='table-dark bg-dark flex-column '>

        <?php
        
        $puertos=$accesosql->sql("SELECT * FROM os_class WHERE ID_os_script= '".$_GET['id']."'");
        foreach($puertos as $i){
            echo "<tr>
                <td>".$i["ID"]."</td><td>".$i["Type"]."</td><td>".$i["Vendor"]."</td><td>".$i["Osfamily"]."</td><td>".$i["Osgen"]."</td><td>".$i["Accuracy"]."</td><td>".$i["Cpe"]."</td>
            </tr>";
        }
    ?>
 	</tbody></table><br>
 
</body>
</html>