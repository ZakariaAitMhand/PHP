<?php

function db_db_connect($server = DB_DB_SERVER, $username = DB_DB_SERVER_USERNAME, $password = DB_DB_SERVER_PASSWORD, $database = DB_DB_DATABASE, $link = 'db_link') {
    global $$link;
	if (DB_USE_PCONNECT == 'true') {
      $$link = mysql_pconnect($server, $username, $password);
    } else {
      $$link = mysql_connect($server, $username, $password);
    }
    if ($$link) mysql_select_db($database);

    return $$link;
}

// define our database connection
  define('DB_SERVER', 'mysql5-5'); // eg, localhost - should not be empty for productive servers
  define('DB_SERVER_USERNAME', 'soussweb');
  define('DB_SERVER_PASSWORD', 'wnkycEfw');
  define('DB_DATABASE', 'soussweb');
  define('USE_PCONNECT', 'false'); // use persisstent connections?
  define('STORE_SESSIONS', ''); // leave empty '' for default handler or set to 'mysql'

  $db_link=db_db_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, 'db_link');

  //define('IMG_MGK','/usr/bin/'); // chemin image magic
  define('IMG_MGK','/usr/bin/'); // chemin image magic
  define('REP_AB','/homez.13/soussweb/www/parc/'); // chemin absolue 
  define('REP_RE','http://www.soussweb.com/parc/'); // chemin absolue 
?>
<?php
define("QS_VAR", "load"); // le nom de variable dans le script de pagination(� ne pas utiliser dans d'autres variable)
define("NUM_ROWS", 10); // le nombre d'enregistrement sur chaque page.
define("NUM_LINKS", 7); // le nombre maximale de liens de navigation.

define("STR_FWD", " Suivant"); // la chaine/l'image utilis� pr lien "suivant" de pagination (page suivante)
define("STR_BWD", "Pr�c�dent "); // la chaine/l'image utilis� pr lien "precedent" de pagination (page precedente)
define("STR_FST", ""); // la chaine ou l'image utilis� pr le lien "debut" de pagination (page suivante)
define("STR_LST", ""); // la chaine ou l'image utilis� pr le lien "fin" de pagination (page precedente)

define("STR_FWD_NA", " Suivant"); // la chaine ou l'image utilis� pr lien "suivant inactive"
define("STR_BWD_NA", "Pr�c�dent "); // la chaine ou l'image utilis� pr lien "precedent inactive" 
define("STR_FST_NA", ""); // la chaine ou l'image utilis� pr lien "debut inactive"
define("STR_LST_NA", ""); // la chaine ou l'image utilis� pr lien "fin inactive" 
?>