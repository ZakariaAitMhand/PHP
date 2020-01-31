<?php
// fonction de verification de session.
function identifier(){
	session_name('SIL_PARC');
	session_start();
	
	if(!isset($_SESSION['ValidateSIL_PARC'])){
		session_name("SIL_PARC");
		session_unset();
		session_destroy();
		header("location:psw/error.php");
		//header('HTTP/1.0 401 Unauthorized');
		exit;
				}
	}

//Fonction de reception des parametes de recherche.

function requset_params($champ, $champDb, $operator, $URL, $Query, $conc="and"){
	 
	 if ($operator=="like "){ $quote1=" '%"; $quote2="%' ";}
	 else { $quote1=" "; $quote2=" ";}
	 
	 if ($operator==" >=" || $operator==" <="){ $quote1=" '"; $quote2="' ";} // pour le type date avec seulement l'année en paramètre.
		 
	 if(isset($_REQUEST[$champ])&&$_REQUEST[$champ]!="")
	     {
	  $ReqPlus=" ".$conc." ".$champDb." ".$operator.$quote1.addslashes($_REQUEST[$champ]).$quote2;
	  $URL=$URL."&".$champ."=".$_REQUEST[$champ];
	  $Query=$Query.$ReqPlus;
	     }		
		 
	 return array($Query, $URL);
	 }



	
	
//  Fonction pour inverser l'ordre de tri des resultat des requete MySQL.

function ContreORS($Ordre){
		if ($Ordre=='Asc') {
				echo'Desc';
			}else{
				echo'Asc';
			}
		}
  
//*******************************   Fonctions d'Ajout/Modification Dans la base de données*****************************
  function tep_db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link') {
    global $$link;


  if (USE_PCONNECT == 'true') {
      $$link = mysql_pconnect($server, $username, $password);
    } else {
      $$link = mysql_connect($server, $username, $password);
	  echo $$link;
    }
    if ($$link) mysql_select_db($database);

    return $$link;
  }

  function tep_db_close($link = 'db_link') {
    global $$link;

    return mysql_close($$link);
  }

  function tep_db_error($query, $errno, $error) { 
    die('<font color="#000000"><b>' . $errno . ' - ' . $error . '<br><br>' . $query . '<br><br><small><font color="#ff0000">[TEP STOP]</font></small><br><br></b></font>');
  }
  
  function tep_db_query($query, $link = 'db_link') {
    global $$link;

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
      error_log('QUERY ' . $query . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }
    $result = mysql_query($query) or tep_db_error($query, "erreur", "erreur");

    //$result = mysql_query($query, $$link) or tep_db_error($query, "erreur", "erreur");

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
       $result_error = mysql_error();
       error_log('RESULT ' . $result . ' ' . $result_error . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    return $result;
  }

  function tep_db_perform($table, $data, $action = 'insert', $parameters = '', $link = 'db_link') {
    reset($data);
    if ($action == 'insert') {
      $query = 'insert into ' . $table . ' (';
      while (list($columns, ) = each($data)) {
        $query .= $columns . ', ';
      }
      $query = substr($query, 0, -2) . ') values (';
      reset($data);
      while (list(, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= 'now(), ';
            break;
          case 'null':
            $query .= 'null, ';
            break;
          default:
            $query .= '\'' . tep_db_input($value) . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ')';
    } elseif ($action == 'update') {
      $query = 'update ' . $table . ' set ';
      while (list($columns, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= $columns . ' = now(), ';
            break;
          case 'null':
            $query .= $columns .= ' = null, ';
            break;
          default:
            $query .= $columns . ' = \'' . tep_db_input($value) . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ' where ' . $parameters;
    }

    return tep_db_query($query, $link);
  }

  function tep_db_fetch_array($db_query) {
    return mysql_fetch_array($db_query, MYSQL_ASSOC);
  }

  function tep_db_num_rows($db_query) {
    return mysql_num_rows($db_query);
  }

  function tep_db_data_seek($db_query, $row_number) {
    return mysql_data_seek($db_query, $row_number);
  }

  function tep_db_insert_id() {
    return mysql_insert_id();
  }

  function tep_db_free_result($db_query) {
    return mysql_free_result($db_query);
  }

  function tep_db_fetch_fields($db_query) {
    return mysql_fetch_field($db_query);
  }

  function tep_db_output($string) {
    return htmlspecialchars($string);
  }

  function tep_db_input($string) {
    return addslashes($string);
  }

  function tep_db_prepare_input($string) {
    if (is_string($string)) {
      return trim(tep_sanitize_string(stripslashes($string)));
    } elseif (is_array($string)) {
      reset($string);
      while (list($key, $value) = each($string)) {
        $string[$key] = tep_db_prepare_input($value);
      }
      return $string;
    } else {
      return $string;
    }
  }
  
  // Converi une date du Format JJ/MM/AAAA au format AAAA-MM-JJ	
	function MysqlDate($date){
		$tab=explode("/",$date);
		return $tab[2]."-".$tab[1]."-".$tab[0];
		}	
	
// Converti une date du Format AAAA-MM-JJ au format JJ/MM/AAAA	
	function FromMysqlDate($date){
		$tab=explode("-",$date);
		return $tab[2]."/".$tab[1]."/".$tab[0];
	}
?>
