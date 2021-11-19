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
                //Obtenemos el ID de la app añadida/modificada en el anyadirApp()
                $idApp = $this->sql("SELECT * FROM app WHERE IP = '".$ip."' AND Port = '".$atr["port"]."'");
                $salida.=$this->anyadirAppUPnP($idApp[0]["ID"],$atr);

                //Obtenemos el ID de la app añadida/modificada en el anyadirAppUPnP()
                $idAppUPnP = $this->sql("SELECT * FROM app_UPnP WHERE ID_APP = '".$idApp[0]["ID"]."'");
                $salida.=$this->anyadirServiciosUPnP($idAppUPnP[0]["ID"],$atr["services"]);


            }
        }
        if($a["mDNS"]){
            $salida=$salida."hay mDNS\n";
        }
        return $salida;
    }
    function anyadirServiciosUPnP($idAppUPnP, $atr)
    {
        $salida="";
        foreach ($atr as $serviceName => $serviceAtr) {
            $res=$this->sql("SELECT * FROM service_UPnP WHERE ID_APP = '".$idAppUPnP."' AND Name= '".$serviceName."'");
            if(count($res)>0){
                $salida.="SERVICIO ".$serviceName." ya añadido\n";
                $res2=$this->sql("UPDATE service_UPnP SET ID_Name= '".$serviceAtr["ID"]."', SCPD= '".$serviceAtr["SCPD"]."', 
                ControlUrl= '".$serviceAtr["ControlUrl"]."', EventUrl= '".$serviceAtr["EventUrl"]."', BaseUrl= '".$serviceAtr["BaseUrl"]."' 
                WHERE ID_APP = '".$idAppUPnP."' AND Name= '".$serviceName."'");
            }else{
                $salida.= "SERVICIO ".$serviceName." no añadido\n";
                $res2=$this->sql("INSERT INTO service_UPnP (Name, ID_Name, SCPD, ControlUrl, EventUrl, BaseUrl, ID_APP) values
                ('".$serviceName."','".$serviceAtr["ID"]."','".$serviceAtr["SCPD"]."','".$serviceAtr["ControlUrl"]."','".$serviceAtr["EventUrl"]."',
                '".$serviceAtr["BaseUrl"]."','".$idAppUPnP."')");
            }
            $idServicio=$this->sql("SELECT * FROM service_UPnP WHERE ID_APP = '".$idAppUPnP."' AND Name= '".$serviceName."'");
            $salida.=$this->anyadirVulnerabilidadesUPnP($idServicio[0]["ID"],$serviceAtr["vulnerabilities"]);
        }
        return $salida;
    }

    function anyadirVulnerabilidadesUPnP($idServicio, $vulnerabilities){
        $salida="";
        if($vulnerabilities["resultsPerPage"]==0) {
            $salida .= "No hay vulnerabilidades\n";
            $res = $this->sql("DELETE FROM vulnerability_UPnP WHERE ID_SERVICE= '" . $idServicio . "'");
        }else{
            $salida.="hay ".$vulnerabilities["resultsPerPage"]." vulnerabilidades\n";
            $res=$this->sql("DELETE FROM vulnerability_UPnP WHERE ID_SERVICE= '".$idServicio."'");
            foreach($vulnerabilities["result"]["CVE_Items"] as $number => $vul){
                $salida.="vulnerabilidad ".$number."\n";
                $impactv2=$vul["impact"]["baseMetricV2"];
                $impactv3=$vul["impact"]["baseMetricV3"];
                $consulta="INSERT INTO vulnerability_UPnP (ID_SERVICE, PublishDate, LastModifiedDate, Description, Lang,bmv2severity,bmv2explitabilityScore,
	            bmv2impactScore,bmv2acInsufInfo,bmv2obtainAllPrivilege,	bmv2obtainUserPrivilege,bmv2obtainOtherPrivilege,bmv2userInteractionRequired,bmv2accessVector,
                bmv2accessComplexity,bmv2authentication,bmv2confidentialityImpact,bmv2integrityImpact,bmv2availabilityImpact,bmv2baseScore,
                bmv3exploitabilityScore,bmv3impactScore,bmv3attackVector,bmv3attackComplexity,bmv3privilegesRequired,bmv3userInteraction,bmv3scope,bmv3confidentialImpact,
                bmv3integrityImpact,bmv3availabilityImpact,bmv3baseScore,bmv3baseSeverity) values
                ('".$idServicio."','".$vul["publishedDate"]."','".$vul["lastModifiedDate"]."','".str_replace("'","`",$vul["cve"]["description"]["description_data"][0]["value"])."',
                '".$vul["cve"]["description"]["description_data"][0]["lang"]."','".$impactv2["severity"]."','".$impactv2["exploitabilityScore"]."',
                '".$impactv2["impactScore"]."','".$impactv2["acInsufInfo"]."','".$impactv2["obtainAllPrivilege"]."','".$impactv2["obtainUserPrivilege"]."','".$impactv2["obtainOtherPrivilege"]."','".$impactv2["userInteractionRequired"]."',
                '".$impactv2["cvssV2"]["accessVector"]."','".$impactv2["cvssV2"]["accessComplexity"]."','".$impactv2["cvssV2"]["authentication"]."','".$impactv2["cvssV2"]["confidentialityImpact"]."',
                '".$impactv2["cvssV2"]["integrityImpact"]."','".$impactv2["cvssV2"]["availabilityImpact"]."','".$impactv2["cvssV2"]["baseScore"]."',
                '".$impactv3["exploitabilityScore"]."','".$impactv3["impactScore"]."','".$impactv3["cvssV3"]["attackVector"]."','".$impactv3["cvssV3"]["attackComplexity"]."',
                '".$impactv3["cvssV3"]["privilegesRequired"]."','".$impactv3["cvssV3"]["userInteraction"]."','".$impactv3["cvssV3"]["scope"]."','".$impactv3["cvssV3"]["confidentialityImpact"]."',
                '".$impactv3["cvssV3"]["integrityImpact"]."','".$impactv3["cvssV3"]["availabilityImpact"]."','".$impactv3["cvssV3"]["baseScore"]."','".$impactv3["cvssV3"]["baseSeverity"]."')";
                $res2=$this->sql($consulta);
                $salida.=$res2."\n";
                //este if es por si hay algún fallo en la consulta
                if($res2==""){
                    $salida.=$consulta."\n";
                }
            }
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