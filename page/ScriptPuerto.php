<html>
 
<head>
    <title>Script Puerto</title>  
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
        <h1 class="h1 titulo">Port Script - Puerto <?php echo $_GET['port'] ;?></h1>
        <hr>
    </div>
    <br>

    <table class="text-center table-striped table-responsive-sm table-w contentTable">
    <tr class="bg-warning flex-column">
			<th>ID</th><th>ID Port</th><th>Key</th><th>Value</th>
		</tr>
        <tbody  class='table-dark bg-dark flex-column '>
        <?php
        require("../accesoSql.php");
        $accesosql=new accesoSql();
        $puertos=$accesosql->sql("SELECT * FROM port_script WHERE ID_Port= '".$_GET['id']."'");
        foreach($puertos as $i){
            echo "<tr>
                <td>".$i["ID"]."</td><td>".$i["ID_Port"]."</td><td>".$i["Llave"]."</td><td>".$i["Valor"]."</td>
            </tr>";
        }
    ?>
 	</tbody></table><br>
 
</body>
</html>