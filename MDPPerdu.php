<!doctype html>
<html lang="fr">
<head>	
	<meta charset="utf8">
	<link rel="stylesheet" href="public/css/reset.css">
	<link rel="stylesheet" href="public/css/style.css">
	<script src="../public/js/jquery-1.9.0rc1.js"></script>
	<script src="../public/js/jquery-ui.js"></script>
</head>	
<body>
	<!-- entete du site -->
	<section id="bloc_entete">
		<div id="bar_orange">

		</div>

		<div id="bloc_header">
			<div id="content_header">
				
				<header>
					<a href="#">
						<div id="logo">
							<img src="public/images/logo.png">
							<h1>SONDAGAX</h1>
						</div>
					</a>
				</header>
				

				<nav>
					<ul>
						<li>
							<a href="#" class="btn">Accueil</a>
						</li>
						<li>
							<a href="#" class="btn">Sondages</a>
						</li>
						<li>
							<a href="#" class="btn">Groupes</a>
						</li>
						<li>
							<a href="#" class="btn">Contact</a>
						</li>
					</ul>
				</nav>
				<div id="search">
					<form id="search" action="#">
						<input class="search-text placeholder" type="text" value="" placeholder="Rechercher" name="recherche"></input>
					</form>
				</div>

				<ul id="bloc_session">
					<li class="btn_session_inscription">
						<a href="#" >Inscription</a>
					</li>
					<li class="btn_session_connexion">
						<a href="#" >Connexion</a>
						<div class="triangle"></div>
						<div class="login-box">
							<div class="form registration">
								<form name="login" action="#" method="post">
									<input type="hidden" value="1" name="login"></input>
									<input type="hidden" value="login" name="a"></input>
									<div class="horizontal-row">
										<label class="control-label" for="email">

											Email:

										</label>
										<div class="controls">
											<input id="email" type="text" value="" required="required" autocomplete="off" placeholder="Email" name="email"></input>
											<span class="inline-message"></span>
										</div>
									</div>
									<div class="horizontal-row">
										<label class="control-label" for="password">

											Mot de Passe:

										</label>
										<div class="controls">
											<input id="password" type="password" required="required" placeholder="Mot de Passe" name="password"></input>
										</div>
									</div>
									<div class="horizontal-row">
										<input class="btn2 black" type="submit" value="Connexion"></input>
									</div>
									<hr class="horizontal-hr"></hr>
									<div class="horizontal-row">
										<label>
											<input id="remember-email" type="checkbox" name="remember-email"></input>


											Se rappelez de mon email					

										</label>
									</div>
									<div class="horizontal-row">
										<a class="btn2 forgot" href="#">

											Mot de passe Oublié?

										</a>
									</div>
								</form>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</section>




	<!-- section contenu -->

	<section id="contenu">

		<div id="bloc_principal">
			<section id="bloc_global">
				<table id="table_connexion">
					<tr>
						<td>

							<fieldset>

								<legend>


								MOT DE PASSE OUBLIE

								</legend>
								<div class="form registration">
									<form name="forgotpassword" action="" method="post">
										<input type="hidden" value="1" name="forgotpassword"></input>
										<input type="hidden" value="forgotpassword" name="a"></input>
										<div class="control-group">
											<label class="control-label" for="email">

												Email:

											</label>
											<div class="controls">
												<input id="email" class="input-error" type="text" value="" placeholder="Email" name="email" required="required"></input>
												<br></br>
												<span class="inline-message"></span>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<input class="submit-btn btn2" type="submit" value="RENOUVELLER"></input>
											</div>
										</div>
									</form>
								</div>
							</td>
						</tr>
					</table>
					<div id="menu_user_anonyme">
						<ul>
							<a href="#"><li class="connexion_menu">CONNEXION</li></a>
							<a href="#"><li class="inscription_menu">S'INSCRIRE</li></a>
							<a href="#"><li class="mdp_menu">MOT DE PASSE OUBLIE</li></a>
						</ul>
					</div>
				</section>
			</div>


		</section>


		<!-- le footer -->

		<footer>
			<p>Copyright © 2014-2015  Sondagax.  design and development by Baroan Zahiri et Abdoul Sy</p>
		</footer>




	</body>
</script>
</html>