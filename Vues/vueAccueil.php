<?php $this->titre = "Accueil"; ?>
<div id="bloc_contents">
	<h3> LES DERNIERS SONDAGES CREES</h3>
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
				<a href="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=participerSondage&donnee={$sondage['sondage_id']}"; ?>">
					<div class="btn_participer">
						Participer <br/>au sondage
					</div>
				</a>
			</div>
		</div>
	<?php endforeach; ?>
</div>