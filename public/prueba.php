<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Validación en servidor LDAP con PHP</title>
</head>
<body>

<?php
  error_reporting(0);

  $servidor_LDAP    = "172.16.50.1";
  $dominio_LDAP     = "conmebol.com";
  $dn_LDAP          = "dc=conmebol,dc=com";
  $usuario_LDAP     = "czelaya";
  $contrasena_LDAP  = "T3mporal.";
  $filtro_LDAP      = '(&(objectClass=user)(objectCategory=person)(cn='.$usuario_LDAP.'))';
  $atributo_LDAP    = array('givenname', 'userprincipalname', 'samaccountname', 'sn' , 'postalcode');
  $conectado_LDAP   = ldap_connect($servidor_LDAP);

  ldap_set_option($conectado_LDAP, LDAP_OPT_PROTOCOL_VERSION, 3);
  ldap_set_option($conectado_LDAP, LDAP_OPT_REFERRALS, 0);

  if ($conectado_LDAP) {
    $autenticado_LDAP = ldap_bind($conectado_LDAP, $usuario_LDAP."@".$dominio_LDAP, $contrasena_LDAP);

    if ($autenticado_LDAP) {
      $resultado_LDAP = ldap_search($conectado_LDAP, $dn_LDAP, $filtro_LDAP);
      $numero_LDAP    = ldap_count_entries($conectado_LDAP, $resultado_LDAP);
      $entrada_LDAP   = ldap_get_entries($conectado_LDAP, $resultado_LDAP);

      foreach($entrada_LDAP as $i){
        foreach($atributo_LDAP as $j){
          if(isset($i[$j])){
            switch ($j) {
              case 'givenname':
                echo 'givenname => '.strtoupper(htmlspecialchars($i[$j][0]));
                break;

              case 'userprincipalname':
                echo 'userprincipalname => '.strtolower(htmlspecialchars($i[$j][0]));
                break;

              case 'samaccountname':
                echo 'samaccountname => '.strtoupper(htmlspecialchars($i[$j][0]));
                break;

              case 'sn':
                echo 'sn => '.strtoupper(htmlspecialchars($i[$j][0]));
                break;

              case 'postalcode':
                echo 'postalcode => '.strtoupper(htmlspecialchars($i[$j][0]));
                break;
            }
          }
        }
      }

      ldap_close($conectado_LDAP);
	  } else {
      echo "<br><br>No se ha podido autenticar con el servidor LDAP: ".$servidor_LDAP.", verifique el usuario y la contraseña introducidos";
    }
  } else {
    echo "<br><br>No se ha podido realizar la conexión con el servidor LDAP: ".$servidor_LDAP;
  }
?>

</body>
</html>