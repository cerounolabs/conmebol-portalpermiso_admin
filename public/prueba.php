<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Validación en servidor LDAP con PHP</title>
</head>
<body>

<?php
  //desactivamos los erroes por seguridad
  error_reporting(0);
  //error_reporting(E_ALL); //activar los errores (en modo depuración)

  $servidor_LDAP = "172.16.50.1";
  $servidor_dominio = "conmebol.com";
  $ldap_dn = "dc=conmebol,dc=com";
  $usuario_LDAP = "czelaya";
  $contrasena_LDAP = "T3mporal.";

  echo "<h3>Validar en servidor LDAP desde PHP</h3>";
  echo "Conectando con servidor LDAP desde PHP...";

  $conectado_LDAP = ldap_connect($servidor_LDAP);
  ldap_set_option($conectado_LDAP, LDAP_OPT_PROTOCOL_VERSION, 3);
  ldap_set_option($conectado_LDAP, LDAP_OPT_REFERRALS, 0);

  if ($conectado_LDAP) 
  {
    echo "<br>Conectado correctamente al servidor LDAP " . $servidor_LDAP;

	   echo "<br><br>Comprobando usuario y contraseña en Servidor LDAP";
    $autenticado_LDAP = ldap_bind($conectado_LDAP, 
	       $usuario_LDAP . "@" . $servidor_dominio, $contrasena_LDAP);
    if ($autenticado_LDAP)
    {
	     echo "<br>Autenticación en servidor LDAP desde Apache y PHP correcta.";
	   }
    else
    {
      echo "<br><br>No se ha podido autenticar con el servidor LDAP: " . 
	      $servidor_LDAP .
	      ", verifique el usuario y la contraseña introducidos";
    }
  }
  else 
  {
    echo "<br><br>No se ha podido realizar la conexión con el servidor LDAP: " .
        $servidor_LDAP;
  }
?>

</body>
</html>