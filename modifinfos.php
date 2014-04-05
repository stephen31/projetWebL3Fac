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


									MODIFIER MES INFOS

								</legend>
								<div class="form registration">
									<form id="register" autocomplete="off" name="login" action="#" method="post">
										<input type="hidden" value="1" name="register" required="required"></input>
										<div class="control-group">
											<label class="control-label" for="newpseudo">


												Pseudo:


											</label>
											<div class="controls">
												<input id="newpseudo" class="input-error" type="text" autocomplete="off" maxlength="20" value="" placeholder="Pseudo" name="pseudo" required="required"></input>
												<br></br>
												<span class="inline-message">
													<span class="inline-error"></span>
												</span>
											</div>
										</div>
										<!--password -->
										<div class="control-group">
											<label class="control-label" for="password">


												Mot de passe:


											</label>
											<div class="controls">
												<input id="password" type="password" autocomplete="off" maxlength="20" value="" placeholder="Mot de passe" name="password" required="required"></input>
												<br></br>
												<span class="inline-message">
													<span class="inline-error">
													</span>
												</span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="confirm_password">


												Confirmez Mot de Passe:


											</label>
											<div class="controls">
												<input id="confirm_password" type="password" autocomplete="off" maxlength="20" value="" placeholder="Confirmez Mot de Passe" name="confirm_password" required="required"></input>
												<br></br>
												<span class="inline-message">
													<span class="inline-error">
													</span>
												</span>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="nom">


												Nom:


											</label>
											<div class="controls" style="display: inline-block; margin-left: 0;">
												<input id="nom" type="text" autocomplete="off" maxlength="100" value="" placeholder="Nom" name="nom" style="width:140px;" required="required"></input>
												<br></br>
												<span class="inline-message">
													<span class="inline-error">
													</span>
												</span>
											</div>
											<div class="controls" style="display: inline-block; margin-left: 0;">
												<input id="prenom" type="text" autocomplete="off" maxlength="100" value="" placeholder="Prenom" name="prenom" style="width:140px;" required="required"></input>
												<br></br>
												<span class="inline-message">
													<span class="inline-error">
													</span>
												</span>
											</div>
										</div>
										<!--email -->
										<div class="control-group">
											<label class="control-label" for="email">


												Email:


											</label>
											<div class="controls">
												<input id="email" type="text" autocomplete="off" maxlength="200" value="" placeholder="Email" required="required" name="email"></input>
												<br></br>
												<span class="inline-message">
													<span class="inline-error">
													</span>
												</span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="confirm_email">


												Confirmez Email:


											</label>
											<div class="controls">
												<input id="confirm_email" required="required" type="text" autocomplete="off" maxlength="200" value="" placeholder="Confirmez Email" name="confirm_email"></input>
												<br></br>
												<span class="inline-message">
													<span class="inline-error">
													</span>
												</span>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="date_of_birth">


												Date de Naissance:


											</label>
											<div class="controls">
												<input id="date_of_birth" required="required" type="text" name="date_of_birth" placeholder="Date de Naissance"></input>
												<br></br>
												<span class="inline-message">
													<span class="inline-error">
													</span>
												</span>
											</div>
										</div>
										<div class="control-group">

											<div class="controls">
												<input id="register" class="btn2" type="submit" value="VALIDER"></input>
											</div>

										</div>
									</form>
								</div>
							</fieldset>
						</td>
					</tr>
				</table>
				<div id="menu_user">
					<ul>
						<a href="#"><li class="modif_infos_user">MODIFIER MES INFOS</li></a>
						<a href="#"><li class="mes_groupes">CREER UN GROUPE</li></a>
						<a href="#"><li class="mes_groupes">MES GROUPES CREES</li></a>
						<a href="#"><li class="mes_groupes">MES GROUPES ACTIF</li></a>
						<a href="#"><li class="creer_sondage">CREER UN SONDAGE</li></a>
						<a href="#"><li class="mes_sondages">MES SONDAGES CREES</li></a>
						<a href="#"><li class="mes_sondages">MES SONDAGES REPONDUS</li></a>
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