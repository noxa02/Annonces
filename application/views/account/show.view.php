<?php $user = $_SESSION['user'] ?>
<div id="main">
	<div id="content">
		<h2>Mon compte</h2>
			<ul class="account">
				<li> <p class="label"> Identifiant : </p> <p> <?php print $_user->getLogin(); 	  ?> 	</p> </li>
				<li> <p class="label"> Nom : 		 </p> <p> <?php print $_user->getName(); 	  ?>  	</p> </li>
				<li> <p class="label"> Prénom : 	 </p> <p> <?php print $_user->getFirstname(); ?> 	</p> </li>
			</ul>
			<form action="?" method="get">
				<input type="hidden" name="p" value="account">
				<input type="hidden" name="a" value="modify">
				<input type="submit" value="Modifier">
			</form>
	</div>
	<div id="sidebar">
		<h2>Votre Pub</h2> 
	</div>
</div>