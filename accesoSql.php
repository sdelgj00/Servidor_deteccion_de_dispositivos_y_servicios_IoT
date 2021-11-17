<?php
require("constantes.php");
class accesoSql {
    private $conexion;

    private function sql($sql) {

        // Comprobamos que no hemos abierto ya la conexión
        if (!$this->conexion)  {
            //Abrimos conexión con la base de datos. Los valores están definidos en config.php
            $this->conexion = @new mysqli(
                constant("DB_HOST"), constant("DB_USER"), constant("DB_PASSWORD"), constant("DB_NAME"));

            // Comprobamos si hay algún error de conexión
            if ($this->conexion->connect_errno) {
                printf("Error: %s\n", $this->conexion->connect_error);   die();
            }
        }

        //Ejecutamos el SQL
        $res=$this->conexion->query($sql);
        if(is_bool($res)){
            return $res;
        }
        else if ($res) {
            // Esta función devuelve todas las filas en formato array de PHP.
            return (array)$res->fetch_all(MYSQLI_ASSOC);
        }
        else {
            return false;
        }
    }
    function anyadirBase($a){
        $salida="";
        if($a["UPnP"]){
            $salida=$salida."Hay UPnP\n";
            foreach ($a["UPnP"] as $ipPuerto => $atr){
                $partesIPPuerto=explode(":",$ipPuerto);
                $ip=$partesIPPuerto[0];
                $salida.=$this->anyadirBaseDispositivo($ip);
                $salida.=$this->anyadirApp($ip,$atr);
                $idApp = $this->sql("SELECT MAX(ID) AS ID FROM app");
                $salida.=$this->anyadirAppUPnP($idApp[0]["ID"],$atr);
            }
        }
        if($a["mDNS"]){
            $salida=$salida."hay mDNS\n";
        }
        return $salida;
    }
    function anyadirApp($ip,$atr){
        $salida="";
        $res=$this->sql("SELECT * FROM app WHERE IP = '".$ip."' AND Port = '".$atr["port"]."'");
        if(count($res)>0){
            $salida.="existe ".$ip." ".$atr['port']."\n";
        }else{
            $salida.="no existe ".$ip." ".$atr['port']."\n";
            $res2=$this->sql("INSERT INTO app(IP,Port) values ('".$ip."','".$atr["port"]."')");
        }
        return $salida;
    }
    //comprobamos que no se ha añadido previamente la AppUPnP, si no la anyadimos o la actualizamos
    function anyadirAppUPnP($idApp,$atr){
        $salida="";
        $res=$this->sql("SELECT * FROM app_UPnP WHERE ID_APP = '".$idApp."' ");
        if(count($res)>0){
            $salida.="existe UPnP ".$idApp." ".$atr['port']."\n";
            $res2=$this->sql("UPDATE app_UPnP SET Name = '".$atr["Name"]."' WHERE ID = '".$res[0]["ID"]."'");
        }else{
            $salida.="no existe UPnP ".$idApp." ".$atr['port']."\n";
            $res2=$this->sql("INSERT INTO app_UPnP(ID_APP,Name) values ('".$idApp."','".$atr["Name"]."')");
        }
        return $salida;
    }
    //Comprobamos que el dispositivo está en la base, y si no lo esta, lo anyadimos
    function anyadirBaseDispositivo($ip){
        $salida="";
        $salida.=$ip."\n";
        //Si no existe el dispositivo, lo creamos
        if($this->existeDispositivo($ip)){
            $salida.="existe ".$ip."\n";
        }else{
            $salida.="no existe ".$ip."\n";
            $this->crearDispositivo($ip);
            $salida.="creado\n";
        }
        return $salida;
    }
    //Devuelve si existe el dispositivo
    function existeDispositivo($ip){
        $res=$this->sql("SELECT * FROM dispositivo WHERE IP= '".$ip."'");
        if(count($res)>0){
            return true;
        }else{
            return false;
        }

    }
    //Anyade el dispositivo que recibe a la base de datos
    function crearDispositivo($ip){
        $res=$this->sql("INSERT INTO dispositivo(IP) VALUES ('".$ip."')");
    }
}