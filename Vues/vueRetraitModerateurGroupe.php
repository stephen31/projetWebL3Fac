<?php $this->titre="Retrait Moderateur Groupe"; ?>
<section id="bloc_global">
	<table id="table_connexion">
		<tr>

			<td>

				<fieldset>
					<legend>

						RETIRER MODERATEUR DU GROUPE : <?php echo "".$groupe[0]['groupe_nom'];?>

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
								<td class="deleteUser"><a href="<?php echo ABSOLUTE_ROOT ."/controleurs/ControleurGroupe.php?action=validerRetraitModerateurGroupe&donnee={$groupe[0]['groupe_id']}&donnee2={$info['ut_id']}"; ?>"><img src="<?php echo ABSOLUTE_ROOT."/public/images/delete.png"?>"></a></td>
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

