<?php

class DB {

   // Attributs de la classe
   protected $host;
   protected $db;
   protected $user;
   protected $pass;
   protected $link;
   protected $result;

   // Constructeur par défaut de la classe
   function DB() {
       $this->host = "localhost";
       $this->db = "sgpci";
       $this->user = "root";
       $this->pass = "";
       $this->link = mysql_connect($this->host, $this->user, $this->pass);
       mysql_select_db($this->db);
       //register_shutdown_function($this->close);
   }
   function reconnect(){
   	   $this->link = mysql_connect($this->host, $this->user, $this->pass);
       mysql_select_db($this->db);
   }
   // Méthodes de la classe
   function query($query) {
       $this->result = mysql_query( $query) or die (mysql_error());
   }
   function nbre_lignes() {
       return mysql_num_rows( $this->result );
       //print_r($this->result);
   }
   function fetch() {
       return mysql_fetch_array( $this->result );
       //print_r($this->result);
   }
   function close() {
       mysql_close($this->link);
   }
}

?> 
