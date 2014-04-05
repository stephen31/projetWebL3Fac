<!doctype html>
<html lang="fr">
<head>	
	<meta charset="utf8">
	<link rel="stylesheet" href="public/css/reset.css">
	<link rel="stylesheet" href="public/css/style.css">
	<script src="../public/js/jquery-1.9.0rc1.js"></script>
	<script src="../public/js/slide_menu.js"></script>
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
			<div id="bloc_contents">
				<h3> MES GROUPES CREES</h3>
				<table id="tab_groupes">
					<tbody>
						<tr>
							<td>
								<div id="bloc_images">
									<img src="public/images/groupe-icone.png">
									<a href="">
										<div class="btn_etat">
											Voir <br/>Groupe
										</div>
									</a>
								</div>


								<div class="desc_groupe">
									<p class="desc_titre">GROUPE 1</p>
									<br/>
									<p class="desc_txt">Description du Groupe et Lorem ipsum dolor sit amet, 
										consectetur adipisicing elit.
										Ad minima temporibus corporis soluta quia. Commodi, alias voluptate assumenda eveniet perferendis
										magnam dolores cum iusto expedita.
									</p>
									<br/>
									<p class="desc_nombres_user">34 personnes</p>
								</div>
							</td>

							<td>
								<div id="bloc_images">
									<img src="public/images/groupe-icone.png">
									<a href="">
										<div class="btn_etat">
											Voir <br/>Groupe
										</div>
									</a>
								</div>


								<div class="desc_groupe">
									<p class="desc_titre">GROUPE 1</p>
									<br/>
									<p class="desc_txt">Description du Groupe et Lorem ipsum dolor sit amet, 
										consectetur adipisicing elit.
										Ad minima temporibus corporis soluta quia. Commodi, alias voluptate assumenda eveniet perferendis
										magnam dolores cum iusto expedita.
									</p>
									<br/>
									<p class="desc_nombres_user">34 personnes</p>
								</div>
							</td>

							<td>
								<div id="bloc_images">
									<img src="public/images/groupe-icone.png">
									<a href="">
										<div class="btn_etat">
											Voir <br/>Groupe
										</div>
									</a>
								</div>


								<div class="desc_groupe">
									<p class="desc_titre">GROUPE 1</p>
									<br/>
									<p class="desc_txt">Description du Groupe et Lorem ipsum dolor sit amet, 
										consectetur adipisicing elit.
										Ad minima temporibus corporis soluta quia. Commodi, alias voluptate assumenda eveniet perferendis
										magnam dolores cum iusto expedita.
									</p>
									<br/>
									<p class="desc_nombres_user">34 personnes</p>
								</div>
							</td>
						</tr>




						<tr>
							<td>
								<div id="bloc_images">
									<img src="public/images/groupe-icone.png">
									<a href="">
										<div class="btn_etat">
											Voir <br/>Groupe
										</div>
									</a>
								</div>


								<div class="desc_groupe">
									<p class="desc_titre">GROUPE 1</p>
									<br/>
									<p class="desc_txt">Description du Groupe et Lorem ipsum dolor sit amet, 
										consectetur adipisicing elit.
										Ad minima temporibus corporis soluta quia. Commodi, alias voluptate assumenda eveniet perferendis
										magnam dolores cum iusto expedita.
									</p>
									<br/>
									<p class="desc_nombres_user">34 personnes</p>
								</div>
							</td>

							<td>
								<div id="bloc_images">
									<img src="public/images/groupe-icone.png">
									<a href="">
										<div class="btn_etat">
											Voir <br/>Groupe
										</div>
									</a>
								</div>


								<div class="desc_groupe">
									<p class="desc_titre">GROUPE 1</p>
									<br/>
									<p class="desc_txt">Description du Groupe et Lorem ipsum dolor sit amet, 
										consectetur adipisicing elit.
										Ad minima temporibus corporis soluta quia. Commodi, alias voluptate assumenda eveniet perferendis
										magnam dolores cum iusto expedita.
									</p>
									<br/>
									<p class="desc_nombres_user">34 personnes</p>
								</div>
							</td>

							<td>
								<div id="bloc_images">
									<img src="public/images/groupe-icone.png">
									<a href="">
										<div class="btn_etat">
											Voir <br/>Groupe
										</div>
									</a>
								</div>


								<div class="desc_groupe">
									<p class="desc_titre">GROUPE 1</p>
									<br/>
									<p class="desc_txt">Description du Groupe et Lorem ipsum dolor sit amet, 
										consectetur adipisicing elit.
										Ad minima temporibus corporis soluta quia. Commodi, alias voluptate assumenda eveniet perferendis
										magnam dolores cum iusto expedita.
									</p>
									<br/>
									<p class="desc_nombres_user">34 personnes</p>
								</div>
							</td>
						</tr>


					</tbody>
				</table>
			</div>
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
		</div>
	</section>


	<!-- le footer -->

	<footer>
		<p>Copyright © 2014-2015  Sondagax.  design and development by Baroan Zahiri et Abdoul Sy</p>
	</footer>




</body>
</html>