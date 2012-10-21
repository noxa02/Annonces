<li class="<?php if(isset($_page) && $_page == 'index.php'): print 'active'; endif; ?>"><a href="index.php"><span>Accueil</span></a></li>

<?php if(!isset($_SESSION['user'])): ?>
		<li class="<?php if(isset($_page) && $_page == 'register.php'): print 'active'; endif; ?>">
			<a href="index.php?p=account&a=register"><span>Inscription</span></a>
		</li>
<?php endif; ?>

<?php if(isset($_SESSION['user'])): ?>
		<li class="<?php if(isset($_page) && $_page == 'account.php'): print 'active'; endif; ?>">
			<a href="index.php?p=account&a=show"><span>Mon Compte</span></a>
		</li>
		<li>
			<a href="index.php?p=account&a=logout"><span>Deconnexion</span></a>
		</li>
<?php endif; ?>