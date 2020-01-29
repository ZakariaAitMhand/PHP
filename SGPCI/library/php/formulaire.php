<?php
class formulaire{
	protected $name;
	protected $action;
	protected $method; 
	protected $enctype;
	
	function __construct($nom="", $act="", $meth="", $enctype="", $style=""){
		$this->name=$nom;
		$this->action=$act;
		$this->method=$meth;
		$this->enctype=$enctype;
		echo '<form name="'.$this->name.'"  enctype ="'.$this->enctype.'" action="'.$this->action.'" method="'.$this->method.'" style='.$style.'>';
	}
	function input($type,$nom,$valeur="",$style="", $checked=false, $id="",$class="", $js = ""){
		echo "<input type='".$type."' id='".$id."' class='".$class."' name='".$nom."' value='".$valeur."' style='".$style."' $js";
		if($checked)echo "checked />";
		else echo "/>";
	}
	function area($nom,$val=""){
		echo '<textarea name="'.$nom.'" >'.$val.'</textarea>';
	}
	function selelctopen($nom,$id=""){
		echo"<select name='".$nom."' id='".$id."'>";
	}
	function option($val, $value = ""){
			echo"<option value=$value>$val</option>";
	}
	function option_sel($val){
		echo "<option selected='selected'>$val</opstion>";
	}
	function selectclose(){
		echo "</select>";
	}
	function close(){
		echo"</form>";
	}
}