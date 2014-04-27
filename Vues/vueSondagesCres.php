<?php $this->titre="Mes Sondages Cres" ;?>
<div id="bloc_contents">
	<h3> MES SONDAGES CRES </h3>
	<?php $previousValue = null;?>
	<?php foreach($sondages as $sondage): ?>
		<?php if($sondage['sondage_id'] != $previousValue): ?>
		<div class="sondage">
			<h4><a href="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=afficherInfosSondage&donnee={$sondage['sondage_id']}"; ?>">
				<?php echo $sondage['titre']; ?></a>
			</h4>
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
				<br/>
				<a href="<?php echo ABSOLUTE_ROOT ."/controleurs/ControleurSondage.php?action=afficherAjoutModerateurSondage&donnee={$sondage['sondage_id']}";?>">
					<div class='btn_modif'>
						Ajout<br/>Moderateur
					</div>
				</a>
				<br/>
				<?php 
				if(isset($sondage['idModerateur']))
				{
					echo ("<a href=".ABSOLUTE_ROOT ."/controleurs/ControleurSondage.php?action=afficherRetraitModerateur&donnee={$sondage['sondage_id']}>".
							"<div class='btn_modif'>
								Retrait<br/>Moderateur
							</div>
						</a><br/>");
				}
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
		<?php $previousValue = $sondage['sondage_id'];?>
		<?php endif;?>
	<?php endforeach; ?>
</div>