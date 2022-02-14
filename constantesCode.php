<?php

define("INICIO","<link rel='stylesheet' href='../css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>
    <link href='../css/estilo.css' rel='stylesheet' type='text/css' />

    <script src='../js/jquery-3.5.1.slim.min.js' integrity='sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj' crossorigin='anonymous'></script>
    <script src='../js/popper.min.js' integrity='sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN' crossorigin='anonymous'></script>
    <script src='../js/bootstrap.min.js' integrity='sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV' crossorigin='anonymous'></script>
    <script src='../js/scriptPags.js' type='text/javascript'></script>");
define("NAV","<nav class='navbar navbar-expand-lg navbar-dark bg-info navegador'>
    <title class='navbar-brand'>Exploracion IoT</title>
  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>

  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
    <ul class='navbar-nav mr-auto'>
      <li class='nav-item active'>
        <a class='nav-link' href='../page/Dispositivos.php'>Ir a inicio</a>
      </li>
      <li class='nav-item active dropdown'>
        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
          Protocolos
        </a>
        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
          <a class='dropdown-item' href='../page/UPnPs.php'>UPnP</a>
          <a class='dropdown-item' href='../page/mDNSs.php'>mDNS</a>
          <a class='dropdown-item' href='../page/WS-Discoverys.php'>WS-Discovery</a>

        </div>
      </li>
    </ul>
    <ul class='navbar-nav'>
    <li class='nav-item active dropdown'>
        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown2' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
          Recursos
        </a>
        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>             
            <a class='dropdown-item' href='https://github.com/sdelgj00/Detecci-n-de-dispositivos-y-servicios-IoT'><img src='../images/githubIcon.png' class='icon'></img> Detector IoT</a>
          <a class='dropdown-item' href='https://github.com/sdelgj00/Servidor_deteccion_de_dispositivos_y_servicios_IoT'><img src='../images/githubIcon.png' class='icon'></img> Servidor</a>
          <a class='dropdown-item' href='mailto:sdelgj00@estudiantes.unileon.es'><img src='../images/gmail.png' class='icon'></img> Contacto</a>
        </div>
      </li>
    <ul>
</nav>");