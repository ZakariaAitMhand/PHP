/*
	AthenaWeb 
	CREATEUR : Lahcen ELMOHIB
	DATE DE CREATION : 11-SEP-2007
	(c) WWW.SOUSSWEB.COM
	
*/

/** tableau zebra **/
function foo(couleur1, couleur2){
	var tables = document.getElementsByTagName("table");
	var len = tables.length;
	for (var i = 0; i < len; i++){
		surligne(tables[i], couleur1, couleur2);
	}
}

function surligne(elm, couleur1, couleur2){
	var blen = elm.tBodies.length;
	for (var k = 0; k < blen; k++){
		var n = elm.tBodies[k].rows.length;
		for (var i = 0; i < n; i++){
			var len = elm.tBodies[k].rows[i].cells.length;
			elm.tBodies[k].rows[i].className = i % 2 ? couleur1  :   couleur2 ;
		}
	}	
}


/** function selectionner tout (checkbox) **/
function selectAll(form, champ){
  cases = document.forms[form].elements[champ];
  nbr= cases.length;
  for (i=1; i< nbr; i++) {
	document.forms[form].elements[champ][i].checked = document.forms[form].elements[champ][0].checked;
  }
}

/** div cachées **/
function AfficherDiv(div)
{
divtitre = document.getElementsByClassName('display_title');
divcontent = document.getElementsByClassName('display_content');
var nbr = divtitre.length;
	var i=0;
	var etat= divcontent[div].style.display;

	if(etat=="block"){
		divcontent[div].style.display="none";
		return false;
	}
	
	for(i=0;i<nbr;i++){
		divcontent[i].style.display="none";
	}
	divcontent[div].style.display="block";
}


/** **/
function Select_Value_Set(SelectName, Value) {
  eval('SelectObject = document.' + 
    SelectName + ';');
  for(index = 0; 
    index < SelectObject.length; 
    index++) {
   if(SelectObject[index].value == Value)
     SelectObject.selectedIndex = index;
   }
}

function pop_it(the_form, h, w) {
   my_form = eval(the_form)
   window.open("img/wait.php", "popup", "height="+h+",width="+w+",menubar='no',toolbar='no',location='no',status='no',scrollbars='no'");
   my_form.target = "popup";
   my_form.submit();
}


function limiteur(champ, indic, indicateur, maximum){
    if (champ.value.length > maximum)
      champ.value = champ.value.substring(0, maximum);
    else
      indic.value = maximum - champ.value.length;
	  document.getElementById(indicateur).innerHTML = (maximum - champ.value.length);
}

// Fonction pour empecher la saisie que des caractère numérique
function numerique(event) {
	// Compatibilité IE / Firefox
	if(!event&&window.event) {
		event=window.event;
	}
		caractereNonAutorise = new Array(33,34,35,36,37,38,39,40,41,42,43,44,45,47,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126);

		var i=0;
		var j=0;
		
		for (i=0; i < caractereNonAutorise.length ; i++){
			if(event.keyCode==caractereNonAutorise[i])
			{
			event.returnValue = false;
			event.cancelBubble = true;
			}
		}
	// DOM
	for (i=0; i < caractereNonAutorise.length ; i++){
		if(event.which==caractereNonAutorise[i])
		{
		event.preventDefault();
		event.stopPropagation();
		}
	}
	
}