<?php
if(isset($_SESSION['MANAGER'])){
?>
	<h1 id="container_title">Add Title:</h1>
		<fieldset id="authenticate">
			<?php if(isset($_SESSION["name"]) or isset($_SESSION["year"]) or isset($_SESSION["desc"]) or isset($_SESSION["copies"]) or isset($_SESSION["genre"])){ echo'<div style="color:red; font-size:11px; font-weight:lighter; text-align:left; margin-left: 47px; font-family:monospace;"> Wrong credentials !</div>';}?>
				
			<form class="form" method="post" action="?page=title_add2">
				<input type="text" onclick="if(this.value=='Title Name'){this.value=''; this.style.color='#014366';}$(this).toggleClass('click');" onblur="if(this.value==''){this.value='Title Name';this.style.color='#7BAECC';} $(this).toggleClass('click');" <?php if(isset($_SESSION["name2"])) echo"value='".$_SESSION["name2"]."'"; else echo"value='Title Name'";?> name="name" <?php if(isset($_SESSION["name"])) echo 'class="txt err"'; else echo'class="txt"';?>>
				
				<input type="text" onclick="if(this.value=='Year'){this.value=''; this.style.color='#014366';} $(this).toggleClass('click');" onblur="if(this.value==''){this.value='Year';this.style.color='#7BAECC';}$(this).toggleClass('click');" <?php if (isset($_SESSION["year2"])) echo"value='".$_SESSION["year2"]."'"; else echo"value='Year'";?> name="year" <?php if (isset($_SESSION["year"])) echo'class="txt err"'; else echo'class="txt"'?>>
				
				<input type="text" onclick="if(this.value=='Description'){this.value=''; this.style.color='#014366';} $(this).toggleClass('click');" onblur="if(this.value==''){this.value='Description';this.style.color='#7BAECC';}$(this).toggleClass('click');" <?php if (isset($_SESSION["desc2"])) echo"value='".$_SESSION["desc2"]."'"; else echo"value='Description'";?>  name="desc" <?php if (isset($_SESSION["desc"]))echo 'class="txt err"'; else echo'class="txt"'?>>
				
				<input type="text" onclick="if(this.value=='Number of copies'){this.value=''; this.style.color='#014366';} $(this).toggleClass('click');" onblur="if(this.value==''){this.value='Number of copies';this.style.color='#7BAECC';}$(this).toggleClass('click');" <?php if (isset($_SESSION["copies2"])) echo"value='".$_SESSION["copies2"]."'"; else echo"value='Number of copies'";?> name="copies"  <?php if (isset($_SESSION["copies"])) echo'class="txt err"'; else echo'class="txt"';?>>
				
				
				<?php $g=0; if (isset($_SESSION["genre2"])) $g=$_SESSION["genre2"];?>
				<select <?php if (isset($_SESSION["genre"])) echo 'class="txt err"'; else echo'class="txt"';?>id="sel" name="genre" onclick="this.style.color='#014366'; $(this).toggleClass('click');" onblur="this.style.color='#7BAECC'; $(this).toggleClass('click');">
					<option value="genre" <?php if (isset($_SESSION["genre2"])){if($g=="genre") echo"Selected";}?>>---Genre---</option>
					<option value="Sport" <?php if (isset($_SESSION["genre2"])){ if($g=="Sport") echo"Selected";}?>>Sport</option>
					<option value="Action" <?php if (isset($_SESSION["genre2"])){ if($g=="Action") echo"Selected";}?>>Action</option>
					<option value="Adventure" <?php if (isset($_SESSION["genre2"])){ if($g=="Adventure") echo"Selected";}?>>Adventure</option>
					<option value="Comedy" <?php if (isset($_SESSION["genre2"])){if($g=="Comedy") echo"Selected";}?>>Comedy</option>
					<option value="Crime" <?php if (isset($_SESSION["genre2"])){ if($g=="Crime") echo"Selected";}?>>Crime</option>
					<option value="Drama" <?php if (isset($_SESSION["genre2"])){if($g=="Drama") echo"Selected";}?>>Drama</option>
					<option value="Horror" <?php if (isset($_SESSION["genre2"])){if($g=="Horror") echo"Selected";}?>>Horror</option>
					<option value="Musical" <?php if (isset($_SESSION["genre2"])){if($g=="Musical") echo"Selected";}?>>Musical</option>
					<option value="Science Fiction" <?php if (isset($_SESSION["genre2"])){if($g=="Science Fiction") echo"Selected";}?>>Science Fiction</option>
					<option value="War" <?php if (isset($_SESSION["genre2"])){if($g=="War") echo"Selected";}?>>War</option>
				</select>
				
				<input type="text" onclick="if(this.value=='Price'){this.value=''; this.style.color='#014366';} $(this).toggleClass('click');" onblur="if(this.value==''){this.value='Price';this.style.color='#7BAECC';}$(this).toggleClass('click');" <?php if (isset($_SESSION["price"])){if($_SESSION["price"]==-1) echo"value='".$_SESSION["price2"]."'";} elseif(isset($_SESSION["price2"])) echo"value='".$_SESSION["price2"]."'";else echo"value='Price'";?> name="price"  <?php if (isset($_SESSION["price"])){if($_SESSION["price"]=="Price") echo'class="txt err"';else echo'class="txt"';} else echo'class="txt"';?>>
				
				<?php $type=0; if (isset($_SESSION["type"])) $type=$_SESSION["type"];?>
				<select <?php if (isset($_SESSION["type"])){if($_SESSION["type"]==-1)echo 'class="txt err"';else echo'class="txt"';} else echo'class="txt"';?>id="sel" name="type" onclick="this.style.color='#014366'; $(this).toggleClass('click');" onblur="this.style.color='#7BAECC'; $(this).toggleClass('click');">
					<option value="type" <?php if($type==-1) echo"Selected";?>>---Type---</option>
					<option value="game" <?php if($type=="game") echo"Selected";?>>Game</option>
					<option value="DVD" <?php if($type=="DVD") echo"Selected";?>>DVD</option>
				</select>
				
				<input type="submit" value="Validate" class="bt">
				<input type="reset" value="Cancel" class="bt">
			</form>
			<?php 
			if (isset($_SESSION["name"]))
				unset($_SESSION["name"]);
			if (isset($_SESSION["year"]))
				unset($_SESSION["year"]);
			if (isset($_SESSION["desc"]))
				unset($_SESSION["desc"]);
				
			if (isset($_SESSION["copies"]))
				unset($_SESSION["copies"]);
			if (isset($_SESSION["genre"]))
				unset($_SESSION["genre"]);
			
			if (isset($_SESSION["name2"]))
				unset($_SESSION["name2"]);
			if (isset($_SESSION["year2"]))
				unset($_SESSION["year2"]);
			if (isset($_SESSION["desc2"]))
				unset($_SESSION["desc2"]);
			if (isset($_SESSION["copies2"]))
				unset($_SESSION["copies2"]);
			if (isset($_SESSION["genre2"]))
				unset($_SESSION["genre2"]);
			
			if (isset($_SESSION["type"]))
				unset($_SESSION["type"]);
			if (isset($_SESSION["price"]))
				unset($_SESSION["price"]);
				
			?>
		</fieldset>
<?php
}
else
	header("Location: ./");
?>