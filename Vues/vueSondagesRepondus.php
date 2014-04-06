<?php $this->titre="Mes Sondages repondus" ;?>
<div id="bloc_contents">
	<h3> MES SONDAGES REPONDUS </h3>
	<?php foreach($sondages as $sondage): ?>
		<div class="sondage">
			<h4><?php echo $sondage['titre']; ?></h4>
			<div id="bloc">
				<span class="sondage_auteur"> creeé par <span class="nom_auteur"><?php echo $sondage['ut_nom'] ." ". $sondage['ut_prenom']; ?></span></span>
				<span class="sondage_heure"> <?php echo "fini le ". $sondage['date_fin']; ?></span>
				<div class="sondage_nb_coms">12 commantaires</div>
			</div>
			<div class="desc_sondage">
				<?php echo $sondage['texte_desc']; ?>
			</div>
			<div id="blocBouton">
				<a>
					<div class="btn_participer">
						Voir<br/>Resultat du sondage
					</div>
				</a>
			</div>
		</div>
	<?php endforeach; ?>
</div>