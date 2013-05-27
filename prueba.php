<?php
include('lib/nusoap.php');

    //Capturas de datos desde archivo html
    $user1 = $_POST['rut'];
    $user2 = $_POST['digito'];
    $rut = "$user1-$user2";
    
    // Creacion de arregloc on parametros del webservice
    $parametros=array();
    $parametros['rut']= $rut;
    $parametros['password']= $_POST['Pass'];
    
    //Uppercase de la clave y trnasformacion a SHA256 de la misma
    $parametros['password']=  strtoupper ( $parametros['password'] );
    $parametros['password']= hash( "sha256", $parametros['password'] );
    
    //Definimos el webservice a tratar y le enviamos los parametros
    $objClienteSOAP = new soapclient("http://informatica.utem.cl:8011/dirdoc-auth/ws/auth?wsdl");
    $objRespuesta = $objClienteSOAP->autenticar($parametros);

    //print_r($objRespuesta);   Nos permite ver los campos y subcampos del objeto respuesta
    if($objRespuesta->return->codigo == 1)
    {
        echo "Acceso Concedido.";
    }
    else
    {
        if($objRespuesta->return->codigo == 0)
        {
            echo "Datos Incompletos.    Ingrese Datos Faltantes";
        }
        else
        {
            echo "Contrase�a Y/O Usuario Invalidos.....";
        }
    }
 ?>
