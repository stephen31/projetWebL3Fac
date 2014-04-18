<?php $this->titre="Sondages" ;?>
<div id="bloc_contents">
	<h3> LES SONDAGES </h3>
	<?php foreach($sondages as $sondage): ?>
		<div class="sondage">
			<h4><?php echo $sondage['titre']; ?></h4>
			<div id="bloc">
				<span class="sondage_auteur"> creeé par <span class="nom_auteur"><?php echo $sondage['ut_nom'] ." ". $sondage['ut_prenom']; ?></span></span>
				<span class="sondage_heure"> le : <span style="color:#309eda;font-weight:bold"><?php echo $sondage['sondage_date_create']; ?></span></span>
				<span class="sondage_heure">fini le : <span style="color:red;font-weight:bold"><?php echo $sondage['date_fin']; ?></span></span>
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
			if($sondage['sondage_droit']==0)
			{
				echo("<div class='public_sondage'>
			</div>");
			}
			if($sondage['sondage_droit']==1)
			{
				echo("<div class='publicInscrit_sondage'>
			</div>");
			}
			if($sondage['sondage_droit']==3)
			{
				echo("<div class='groupe_sondage'>
			</div>");
			}
			?>
			<div id="blocBouton">
				<a href="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=afficherInfosSondage&donnee={$sondage['sondage_id']}"; ?>">
					<div class="btn_etat">
						Etat<br/>sondage
					</div>
				</a>
			</div>
		</div>
	<?php endforeach; ?>
</div>