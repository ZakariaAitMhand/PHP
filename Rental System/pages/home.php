<?php
if(isset($_SESSION['MANAGER'])){
	if($_SESSION['MANAGER']!=-1){
?>
	<h1 id="container_title">Home:</h1>
	<?php if (isset($_SESSION['MANAGER'])){
			if ($_SESSION['MANAGER']==1){
	?>
	<a id="account" href="?page=creat_acount">Create Account</a>
	<?php }}?>
	<fieldset id="description">


	<p>
	The software to be developed is to be used by the manager and clerks of a store that rents both movies and video games.</p><br>
	<p>Some functions will be available only to the manager. The system must provide some suitable mechanism to ensure that only the manager can access such functions.</p><br>
	<p>To be able to rent from the store, a customer must provide his/her name, address, and phone number. A clerk enters this information into the system, and then gives the customer a card which contains a unique customer ID. The customer must present this card to be able to rent anything.</p><br>
	<p>
	Movie DVDs are rented for a specified rental period for a specified rental charge, and game disks are rented for a specified rental period for a specified rental charge. If a movie DVD is returned late, it is charged an extra rental charge for each rental period (or fraction thereof) it is late; likewise, if a game disk is returned late it is charged an extra rental charge for each rental period (or fraction thereof) it is late. (The rental periods and prices charged are established by management, and can be different for movies than for games.)</p><br>
	<p>
	DVDs and game disks available for rental are displayed in the store in their boxes. Each has a unique ID number. To rent one or more items, the customer brings it/them to a clerk, who enters the customer ID number from the customer card, and the DVD/disk ID number(s) from the box(es). When all have been entered, the system will calculate the total charge owed and the clerk will collect it from the customer. (A future improvement may use a bar code scanner to scan customer cards and DVD/disk ID numbers, but for now the system depends on the clerk typing the appropriate ID numbers.)</p><br>
	<p>
	DVDs and disks being returned can either be handed to a clerk, or they can be placed in a returns box in the store, or they can be inserted into a returns slot in the wall of the store if the store is closed. In any case, a clerk must enter the ID number of each DVD/disk that has been returned into the system. Of course, the clerk does not need to enter a customer id for returns - in fact, the customer may not even be present it the items are left in the return slot at night.</p><br>

	</fieldset>
<?php
}
}
?>