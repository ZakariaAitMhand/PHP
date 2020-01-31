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
   function __construct() {
       $this->host = "localhost";
       $this->db = "rentalsys";
       $this->user = "root";
       $this->pass = "";
       $this->link = mysqli_connect($this->host, $this->user, $this->pass);
       mysqli_select_db($this->link, $this->db);
       //register_shutdown_function($this->close);
   }
   function reconnect(){
   	   $this->link = mysqli_connect($this->host, $this->user, $this->pass);
       mysqli_select_db($this->link, $this->db);
   }
   // Méthodes de la classe
   function query($query) {
       $this->result = mysqli_query($this->link, $query) or die (mysqli_error($this->link));
   }
   function nbre_lignes() {
       return mysqli_num_rows($this->result );
       //print_r($this->result);
   }
   function fetch() {
       return mysqli_fetch_array ($this->result );
       //print_r($this->result);
   }
   function close() {
       mysqli_close($this->link);
   }
}

?> 
