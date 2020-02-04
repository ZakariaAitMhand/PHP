</div>
        <div class="s-menu">
            <fieldset class="member">
            	<legend >Espace Administration</legend>
                    <form action="admin_verif2.php" method="post" class="form">
                        <input class="txt" type="password" name="pass" value="password" onblur="if(this.value=='') this.value='password';" onclick="if(this.value=='password') this.value='';" />
                     	<input class="bt" type="submit" value="valider" />
                        <input class="bt" type="reset" value="Annuler" />
                    </form>
	        </fieldset>
        	<fieldset class="member">
            	<legend >Espace membre</legend>
                    <form action="connexion2.php" method="post" class="form">
                        <input class="txt" type="text" name="cin" value="Login" onblur="if(this.value=='') this.value='Login';" onclick="if(this.value=='Login') this.value='';" />
                        <input class="txt" type="password" name="pass" value="password" onblur="if(this.value=='') this.value='password';" onclick="if(this.value=='password') this.value='';" />
                     	<input class="bt" type="submit" value="valider" />
                        <input class="bt" type="reset" value="Annuler" />
                    </form>
	        </fieldset>
            <p class="right-menu" id="inscription">Inscription</p>
            <a href="http://www.fs-umi.ac.ma" class="right-menu">Faculté de Méknes</a>
            <?php
			
			if(!empty($_COOKIE['Admin_pass']))
			echo'<a href="Admin.php" class="right-menu">Mon compte</a>';
			if(!empty($_COOKIE['cin']) || !empty($_COOKIE['pass']))
			echo'<a href="utilisateur.php" class="right-menu">Mon compte</a>';
			if(!empty($_COOKIE['Admin_pass']) || !empty($_COOKIE['cin']) || !empty($_COOKIE['pass']))
			echo'<a href="deconnexion.php" class="right-menu">Déconnexion</a>';
			
			?>
        </div>
    </div>
    <div class="clear"></div>
    <div id="pied">
    	<span>Statistiques de la Licence Professionnelle de Meknes</span>
    </div>
    
	<noscript>Vous avez désactivé javascript. Si vous voulez quand meme voir le menu, cliquez ici. Si vous ne voulez pas, cliquez ici. Si vous voulez voir le menu en Javascript (chargement plus rapide), réactivez JavaScript</noscript>



<div id="dialog-form" title="Espace membre">
	<p class="validateTips">Rmeplir les champs</p>

	<form id="form" style="position:relative; top:2em;" action="">
	<fieldset>
		<label for="cin" id="lab">CIN</label>
		<input type="text" name="cin" id="cin" class="text ui-widget-content ui-corner-all" />
		<label for="password" id="lab">Password</label>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>
<div id="dialog-Admin-form" title="Espace Administration">
	<p class="validateTips">Saisir le mot de pass</p>

	<form id="form" style="position:relative; top:2em;" action="">
	<fieldset>
		<label for="password" id="lab">Mot de pass</label>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>

<div id="dialog-inscription-form" title="Inscription">
	<p class="validateTips" >Saisir le mot de pass</p>

	<form id="form" style="position:relative; top:2em;" >
	<fieldset>
		<label for="password" id="lab">Mot de pass</label>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div> 
 
</body>
</html>
