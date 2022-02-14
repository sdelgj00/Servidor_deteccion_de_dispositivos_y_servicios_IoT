<!DOCTYPE html>

<html>
 
<head>
    <title>Dispositivos</title>  
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
        <h1 class="h1 titulo">Dispositivos</h1>
        <hr>
    </div>
    <br>
    
      <table class="text-center table-striped table-responsive-sm table-w contentTable">
      <tr class="bg-warning flex-column">
        <th>IP</th><th>Host Name</th><th>Type</th><th>Mac</th><th>Vendor</th><th>Uptime</th><th>State</th>
      </tr>
      <tbody  class='table-dark bg-dark flex-column '>
          <?php
          require("../accesoSql.php");
          $accesosql=new accesoSql();
          $dispositivos=$accesosql->sql("SELECT * FROM dispositivo");
          foreach($dispositivos as $i){
              echo "<tr onclick=irDispositivo('".$i["IP"]."')>
                  <td class='IP'>".$i["IP"]."</td><td>".$i["HostName"]."</td><td>".$i["Type"]."</td><td>".$i["Mac"]."</td><td>".$i["Vendor"]."</td><td>".$i["Uptime"]."</td><td>".$i["State"]."</td>
              </tr>";
          }
      ?>
 	</tbody></table><br>
 
</body>
</html>