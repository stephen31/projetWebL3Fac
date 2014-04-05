<?php $this->titre="Mes Sondages Cres" ;?>
<div id="bloc_contents">
	<h3> MES SONDAGES CRES </h3>
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
			<?php 
				if($sondage['sondage_droit']==2)
				{
					echo("<div class='private_sondage'>
					</div>");
				}
			?>
			<div id="blocBouton">
				<a href="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=afficherModifSondage&donnee={$sondage['sondage_id']}"; ?>">
					<div class="btn_etat">
						Modifier<br/>sondage
					</div>
				</a>
				<a href="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=afficherInfosSondage&donnee={$sondage['sondage_id']}"; ?>">
					<div class="btn_etat">
						Etat<br/>sondage
					</div>
				</a>
				<?php 
				if($sondage['sondage_droit']==2)
				{
					echo ("<a href=".ABSOLUTE_ROOT ."/controleurs/ControleurSondage.php?action=afficherAjoutVotantSondage&donnee={$sondage['sondage_id']}>".
							"<div class='btn_participer'>
								Ajout<br/>Votant
							</div>
						</a>".
						"<a href=".ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=afficherRetraitVotantSondage&donnee={$sondage['sondage_id']}>".
							"<div class='btn_participer'>
								Retrait<br/>Votant
							</div>
						</a>"
						);

				} 
				?>
			</div>
		</div>
	<?php endforeach; ?>
</div>