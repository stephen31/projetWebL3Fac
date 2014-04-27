<!doctype html>
<html lang="fr">
<head>	
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo ABSOLUTE_ROOT . '/public/css/reset.css'; ?>" />
	<link rel="stylesheet" href="<?php echo ABSOLUTE_ROOT . '/public/css/style.css'; ?>" />
	<script src="<?php echo ABSOLUTE_ROOT . '/public/js/jquery-1.9.0rc1.js'; ?>"></script>
	<script src="<?php echo ABSOLUTE_ROOT . '/public/js/jquery-ui.js'; ?>"></script>
	<title><?php echo NOM_SITE . ' - '.$titre ?></title>
</head>	
<body>
	<!-- entete du site -->
	<section id="bloc_entete">
		<div id="bar_orange">
		</div>

		<div id="bloc_header">
			<div id="content_header">
				
				<header>
					<a href="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=afficherAccueil'; ?>">
						<div id="logo">
							<img src="<?php echo ABSOLUTE_ROOT . '/public/images/logo.png';?>">
							<h1>SONDAGAX</h1>
						</div>
					</a>
				</header>
				

				<nav>
					<ul>
						<li>
							<a href="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=afficherAccueil'; ?>" class="btn">Accueil</a>
						</li>
						<li>
							<a href="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurSondage.php?action=afficherSondages'; ?>" class="btn">Sondages</a>
						</li>
						<li>
							<a href="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurSondage.php?action=afficherSondagesFinis'; ?>" class="btn">Sondages finis</a>
						</li>
						<li>
							<a href="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurGroupe.php?action=afficherGroupes'; ?>" class="btn">Groupes</a>
						</li>
						<li>
							<a href="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=afficherContact'; ?>" class="btn">Contact</a>
						</li>
					</ul>
				</nav>
				<div id="search">
					<form id="search" action="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=rechercher';?>">
						<input class="search-text placeholder" type="text" value="" placeholder="Rechercher" name="recherche"></input>
					</form>
				</div>

				<ul id="bloc_session">
					<?php echo $headinfos; ?>
				</ul>
			</div>
		</div>
	</section>


	<!-- section contenu -->

	<section id="contenu">

		<?php echo $bloc_intro; ?>
		<!--- ERREUR  GENERER -->
		<div id="bloc_principal">

			<div id="erreur">
					<?php if(!empty($erreur))
						echo $erreur;
					?>
			</div>

			<!--- CONENU GENERER DYNAMIQUEMENT -->
			<?php echo $contenu; ?>

			<!-- MENU GENERER DYNAMIQUEMENT -->
			<?php echo $menu_usr; ?>
		</div>


	</section>


	<!-- le footer -->

	<footer>
		<p>Copyright © 2014-2015  Sondagax.  design and development by Baroan Zahiri et Abdoul Sy</p>
	</footer>




</body>
</html>