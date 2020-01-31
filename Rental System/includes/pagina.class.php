<?php

class Pagina {
	
	var $sql;
	var $result;
	
	var $get_var = QS_VAR;
	var $rows_on_page = 16;
	
	var $str_forward = STR_FWD;
	var $str_backward = STR_BWD;
	var $str_first = STR_FST;
	var $str_last = STR_LST;
	// pour le cas des button inactive
	var $str_forwardNA = STR_FWD_NA;
	var $str_backwardNA = STR_BWD_NA;
	var $str_firstNA = STR_FST_NA;
	var $str_lastNA = STR_LST_NA;
	
	var $navig_str;
	var $all_rows;
	var $num_rows;
	
	var $page;
	var $number_pages;
	
	// constructor
	function Pagina() {
		//$this->connect_db();
	}
	// sets the current page number
	function set_page() {
		$this->page = (isset($_REQUEST[$this->get_var]) && $_REQUEST[$this->get_var] != "") ? $_REQUEST[$this->get_var] : 0;
		return $this->page;
	}
	// gets the total number of records 
	function get_total_rows($db) {
		$tmp_result = mysql_query($this->sql, $db);
		$this->all_rows = mysql_num_rows($tmp_result);
		mysql_free_result($tmp_result);
		return $this->all_rows;
	}
	// database connection
	function connect_db() {
		//$conn_str = mysqli_connect(hostname, username, password, database );
		//mysql_select_db($conn_str, );
	}
	// get the totale number of result pages
	function get_num_pages($db) {
		$this->number_pages = ceil($this->get_total_rows($db) / $this->rows_on_page);
		return $this->number_pages;
	}
	// returns the records for the current page
	function get_page_result($db) {
		$start = $this->set_page() * $this->rows_on_page;
		$page_sql = sprintf("%s LIMIT %s, %s", $this->sql, $start, $this->rows_on_page);
		$this->result = mysql_query($page_sql, $db);
		return $this->result;
	}
	// get the number of rows on the current page
	function get_page_num_rows($result) {
		$this->num_rows = mysql_num_rows($result);
		return $this->num_rows;
	}
	// free the database result
	function free_page_result($result) {
		mysql_free_result($result);
	}
	// fonction pour traiter l'ordre et le parametre d'ordre
	function Sort_order($DefChamp) {
		
		$ord = (isset($_GET['ord']) && $_GET['ord']!='') ? $_GET['ord'] : 'Desc';
	  	$srt = (isset($_GET['srt']) && $_GET['srt']!='') ? $_GET['srt'] : $DefChamp;
	 	return array($srt, $ord);
	  	}
		
	// fonction pour traiter l'ordre et le parametre d'ordre
	function Contre_order() {
		
		$ord = (isset($_GET['ord']) && $_GET['ord']!='') ? (($_GET['ord']=='Asc') ? 'Desc' : 'Asc' ) : 'Desc';
	  	return $ord;
	  	}
	// fonction pour recuperer les variable transmis via la methode POST.
	function rebuild_qsp() {
		$qsp='';
		if(count($_POST) != 0){
			$cles=array_keys($_POST);
			$qsp=array();
 			foreach ($cles as $val) {
				if ($_POST[$val] != ""){
				array_push($qsp, $val."=".$_POST[$val]);
				}
			}
			$qsp = "&".implode("&", $qsp);
			}
			$qsp = ($qsp == "&") ? "" : $qsp;
	   return $qsp;	
	}
	
	// function to handle other querystring than the page variable
	function rebuild_qs($curr_var) {
		if (!empty($_SERVER['QUERY_STRING'])) {
			$parts = explode("&", $_SERVER['QUERY_STRING']);
			$newParts = array();
			foreach ($parts as $val) {
				if ((stristr($val, $curr_var) == false) && (stristr($val, "srt") == false) && (stristr($val, "ord") == false))  {
					array_push($newParts, $val);
				}
			} 
			if (count($newParts) != 0) {
				$qs = "&".implode("&", $newParts);
			} else {
				return false;
			}
			return $qs; // this is your new created query string
		} else {
			return false;
		}
	} 
	
	// this method will return the navigation links for the conplete recordset
	function navigation($separator = " | ", $css_current = "", $srt_ord, $db, $back_forward = false) {
		$ord = $srt_ord[1];
		$srt = $srt_ord[0];
		$ord = "&ord=$ord";
		$srt = "&srt=$srt";
		
		
		$max_links = NUM_LINKS;
		$curr_pages = $this->set_page(); 
		$all_pages = $this->get_num_pages($db) - 1;
		$var = $this->get_var;
		$navi_string = "";
		
		$nav_str = $srt.$ord.$this->rebuild_qs($var).$this->rebuild_qsp();
		$navig_str = $this->rebuild_qs($var).$this->rebuild_qsp();
		
		if (!$back_forward) {
			$max_links = ($max_links < 2) ? 2 : $max_links;
		}
		if ($curr_pages <= $all_pages && $curr_pages >= 0) {
			if ($curr_pages > ceil($max_links/2)) {
				$start = ($curr_pages - ceil($max_links/2) > 0) ? $curr_pages - ceil($max_links/2) : 1;
				$end = $curr_pages + ceil($max_links/2);
				if ($end >= $all_pages) {
					$end = $all_pages + 1;
					$start = ($all_pages - ($max_links - 1) > 0) ? $all_pages  - ($max_links - 1) : 1;
				}
			} else {
				$start = 0;
				$end = ($all_pages >= $max_links) ? $max_links : $all_pages + 1;
			}
			if($all_pages >= 1) {
				$forward = $curr_pages + 1;
				$backward = $curr_pages - 1;
				$first = 0;
				$last = $all_pages;
				$navi_string .= ($curr_pages > 0) ? "<a href=\"".$_SERVER['PHP_SELF']."?".$var."=".$first.$nav_str."\">".$this->str_first."</a>" : $this->str_firstNA;
				
				$navi_string .= ($curr_pages > 0) ? "<a href=\"".$_SERVER['PHP_SELF']."?".$var."=".$backward.$nav_str."\">".$this->str_backward."</a>" : $this->str_backwardNA;
				$navi_string .= "<span>";
				if (!$back_forward) {
					for($a = $start + 1; $a <= $end; $a++){
						$theNext = $a - 1; // because a array start with 0
						if ($theNext != $curr_pages) {
							$navi_string .= "<a href=\"".$_SERVER['PHP_SELF']."?".$var."=".$theNext.$nav_str."\">";
							$navi_string .= $a."</a>";
							$navi_string .= ($theNext < ($end - 1)) ? "".$separator."" : "";
						} else {
							$navi_string .= ($css_current != "") ? "<font>".$a."</font>" : "<font>".$a."</font>";
							$navi_string .= ($theNext < ($end - 1)) ? "".$separator."" : "";
						}
					}
				}
				$navi_string .= "</span>";
				$navi_string .= ($curr_pages < $all_pages) ? "<a href=\"".$_SERVER['PHP_SELF']."?".$var."=".$forward.$nav_str."\">".$this->str_forward."</a>" : $this->str_forwardNA;
				
				$navi_string .= ($curr_pages < $all_pages) ? "<a href=\"".$_SERVER['PHP_SELF']."?".$var."=".$all_pages.$nav_str."\">".$this->str_last."</a>" : $this->str_lastNA;
				
			}
		}	
		$this->navig_str= $navig_str;
		return $navi_string;
	}
	
	// fonction pour recupérer les params d'url a mettre dans les liens de tris.
	function navig_tri($srt){
		$var = $this->get_var;
		$page = $this->page;
		$navig_str="?$var=$page&ord=".$this->Contre_order()."&srt=$srt".$this->navig_str;
		return $navig_str;
	}
	
	// fonction pour recuperer les params d'url a mettre dans les liens "Retour".
	function navig_return($srt){
		$var = $this->get_var;
		$page = $this->page;
		$ord=(isset($_GET['ord']) && $_GET['ord']!='') ? (($_GET['ord']=='Asc') ? 'Asc' : 'Desc' ) : 'Desc';
		$srt = (isset($_GET['srt']) && $_GET['srt']!='') ? $_GET['srt'] : $srt;
		$navig_str="?$var=$page&ord=$ord&srt=$srt".$this->navig_str;
		$navig_str = str_replace("&", "|", $navig_str);
		
		return $navig_str;
	}
	
	// fonction pour recuperer les params d'url a mettre dans les liens "modifier".
	function navig_modif($str){
		$params = "";
		$param = explode ("|", substr($str, 1));
		foreach ($param as $prm){
			$params .=((substr($prm, 0, 5) != "page=") && (substr($prm, 0, 5) != "code="))  ? "&".$prm : ""; 
		}
		return $params;
	}
	
	
	// this info will tell the visitor which number of records are shown on the current page
	function page_info($to = "-", $db) {
		$first_rec_no = ($this->set_page() * $this->rows_on_page) + 1;
		$last_rec_no = $first_rec_no + $this->rows_on_page - 1;
		$last_rec_no = ($last_rec_no > $this->get_total_rows($db)) ? $this->get_total_rows($db) : $last_rec_no;
		$to = trim($to);
		$info = $first_rec_no." ".$to." ".$last_rec_no;
		return $info;
	}
	// simple method to show only the page back and forward link.
	function back_forward_link($srt_ord, $db) {
		$simple_links = $this->navigation(" ", "", $srt_ord, $db, true);
		return $simple_links;
	}
	// fonction pour former la requête a aprtir des données passées en paramètres
	function request_params($champ, $champDb, $operator, $Query, $conc="and"){
	 if ($operator=="like "){ $quote1=" '%"; $quote2="%' ";}
	 else { $quote1=" "; $quote2=" ";}
	 //la ligne suivante est ajouté seluement pr un type de tri qui permet d'afficher les resultat commencant par un caractere donnée
	 if ($champ == "char"){$quote1=" '"; $quote2="%' ";}
	 
	 if ($operator==">= " || $operator=="<= " || $operator=="= "){ $quote1="'"; $quote2="' ";} // pour le type date et chaine avec valeur exact.
		 
	 if(isset($_REQUEST[$champ])&&$_REQUEST[$champ]!="")
	     {
	  $ReqPlus=" ".$conc." ".$champDb." ".$operator.$quote1.addslashes($_REQUEST[$champ]).$quote2;
	  //$URL=$URL."&".$champ."=".$_REQUEST[$champ];

	  $Query=$Query.$ReqPlus;
	     }		
		 
	 return $Query;
	 }
	// fonction pour recuperer les données a partir d'une deuxieme table a prtir d'un identificateur passé en param.
	function get_data($db, $table, $id, $val, $champs){
		if ($val != ''){
			$query = sprintf("SELECT %s from %s where %s='%s'", $champs, $table, $id, $val);
			//echo $query;
			$result = mysql_query($query, $db);
			$line = mysql_fetch_assoc($result);
			if (mysql_num_rows($result) != 1) { return ""; }
			return $line;
		} else { return ""; }
	}
	
	function CreateFolder($dir,$dirmode=0775)
   {
       if (!empty($dir))
       {
           if (!file_exists($dir))
           {
               preg_match_all('/([^\/]*)\/?/i', $dir,$atmp);
               $base="";
               foreach ($atmp[0] as $key=>$val)
               {
                   $base=$base.$val;
                   if(!file_exists($base))
                       if (!mkdir($base,$dirmode))
                       {
                               echo "Error: Impossible to create the folder: ".$base;
                           return -1;
                       }
               }
           }
           else
               if (!is_dir($dir))
               {
                       echo "Error: ".$dir." exists and is not a folder.";
                   return -2;
               }
       }

       return 0;

   } 
// Flesh de sortie
function tri($ord,$champ1="",$champ2){
    $ch1 = (isset($_REQUEST[$champ1]))? $_REQUEST[$champ1]: '';
	$ord = (isset($_REQUEST[$ord]))? $_REQUEST[$ord]: 'Asc';
	
  	if($ch1 ==$champ2){
	  	if($ord=='Desc'){
	  	   $tri='_down';
	  	}else if($ord=='Asc'){
	  	   $tri='_up';
		}
	  }else{
	  	$tri='';
	  }
	  return $tri;
  }


function db_search($champ,$array){
if (!isset($_REQUEST[$champ])){
$_REQUEST[$champ]="";
}
  $mots = trim($_REQUEST[$champ]);
  $mots = split(" ",$mots);
  if(count($mots)>0){
	for ($z=0; $z<count($mots); $z++){
	   if($mots[$z][0] == "-"){
		  $prefixe = "Not ";
		  $mots[$z] = substr($mots[$z],1);
	   }else{
		  $prefixe = "";
	   }  	
       for($i=1; $i<count($prm['champ']); $i++ ){
	   if(in_array($i,$array)){
	       $conc = ($prefixe == "Not " && $prm['conc'][$i] == "or ")? "and " : $prm['conc'][$i];
           $liste->sql=$liste->request_params($mots[$z],$prm['champDb'][$i], $prm['operator'][$i], $liste->sql, $conc, 1, $prefixe);
		   if ($i==max($array)){$liste->sql = $liste->sql.")";}
		   }else{
		   $liste->sql=$liste->request_params($prm['champ'][$i],$prm['champDb'][$i], $prm['operator'][$i], $liste->sql, $prm['conc'][$i]);
		   }
       }
       
	}
  }
  return true;
}

	function request_params2($champ, $champDb, $operator, $Query, $conc="and", $rechValue = "POST", $prefixe = ""){
	 if ($operator=="like "){ $quote1=" '%"; $quote2="%' ";}
	 else { $quote1=" "; $quote2=" ";}
	 //la ligne suivante est ajouté seluement pr un type de tri qui permet d'afficher les resultat commencant par un caractere donnée
	 if ($champ == "char"){$quote1=" '"; $quote2="%' ";}
	 
	 if ($operator==">= " || $operator=="<= " || $operator=="= "){ $quote1="'"; $quote2="' ";} // pour le type date et chaine avec valeur exact.
     //$request_session = (isset($_REQUEST[$champ]))? $_REQUEST[$champ]: $_SESSION[$champ];
	 //echo "<br>HERE".$$request_session;
	 //$req_ses = $$request_session;
	 $Search = ($rechValue == 1)? $champ: ((isset($_REQUEST[$champ]))? $_REQUEST[$champ]: $_SESSION[$champ]);
	 //echo "<br>HH".$Search;
	 if(isset($Search)&&$Search!="")
	     {
	  $ReqPlus=" ".$conc." ".$champDb." ".$prefixe.$operator.$quote1.htmlentities($Search).$quote2;
	  //$URL=$URL."&".$champ."=".$Search;
	  $Query=$Query.$ReqPlus;
	     }		
		 
	 return $Query;
	 }

}
?>