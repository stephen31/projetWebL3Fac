<?php $this->titre="Retrait Moderateur Sondage"; ?>
<section id="bloc_global">
	<table id="table_connexion">
		<tr>

			<td>

				<fieldset>
					<legend>


						RETIRER MODERATEUR DU SONDAGE : <?php echo "".$sondage[0]['titre'];?>

					</legend>
					<table cellspacing='0'> 
						<!-- Table Header -->
						<thead>
							<tr>
								<th>Pseudo</th>
								<th>Supprimer</th>
							</tr>
						</thead>
						<!-- Table Header -->

						<!-- Table Body -->
						<tbody>
							<?php foreach($infosUser as $info): ?>
							<tr>
								<td><?php echo $info['ut_pseudo'] ?></td>
								<td class="deleteUser"><a href="<?php echo ABSOLUTE_ROOT ."/controleurs/ControleurSondage.php?action=validerRetraitModerateur&donnee={$sondage[0]['sondage_id']}&donnee2={$info['ut_id']}"; ?>"><img src="<?php echo ABSOLUTE_ROOT."/public/images/delete.png"?>"></a></td>
							</tr><!-- Table Row -->
							<?php endforeach; ?>
						</tbody>
						<!-- Table Body -->
	
					</table>
				</fieldset>
			</td>
		</tr>
	</table>
</section>

