<?php $this->titre = "Groupes"; ?>
<div id="bloc_contents">
	<h3> LES GROUPES PUBLIC ET PUBLIC PRIVE</h3>
	<table id="tab_groupes">
		<tbody>
		<?php $k=0;?>
		<?php 
			echo '<tr>';
			foreach ($groupes as $groupe) 
			{
				if($k<3)
				{
					echo '<td>
							<div id="bloc_images">
								<img src="../public/images/groupe-icone.png">
								<a href="'.ABSOLUTE_ROOT . "/controleurs/ControleurGroupe.php?action=afficherInfosGroupe&donnee={$groupe['groupe_id']}".'">
									<div class="btn_etat">
										Voir <br/>Groupe
									</div>
								</a>';
								switch(intval($groupe['groupe_droit']))
								{
									case 0:
										echo '<a href="'.ABSOLUTE_ROOT . "/controleurs/ControleurGroupe.php?action=validerAjoutUserGroupe&donnee={$groupe['groupe_id']}".'">
										<div class="btn_participer">
											Sinscrire <br/>au Groupe
										</div>
										</a>';
										break;
									case 1:
										echo '<a href="'.ABSOLUTE_ROOT . "/controleurs/ControleurGroupe.php?action=DemandeAjoutUserGroupe&donnee={$groupe['groupe_id']}".'">
										<div class="btn_participer">
											Demander <br/>ajout
										</div>
										</a>';
										break;
									default:
										echo '<a href="'.ABSOLUTE_ROOT . "/controleurs/ControleurGroupe.php?action=DemandeAjoutUserGroupe&donnee={$groupe['groupe_id']}".'">
										<div class="btn_participer">
											Demander <br/>ajout
										</div>
										</a>';
										break;
								};

							echo '</div>

							<div class="desc_groupe">
								<p class="desc_titre">'.$groupe['groupe_nom'].'</p>
								<br/>
								<p class="desc_txt">'.$groupe['groupe_desc'].'
								</p>
								<br/>
							</div>
						</td>';
						$k++;
				}
				else
				{
					echo '</tr>';
					echo '<tr>';
										echo '<td>
							<div id="bloc_images">
								<img src="../public/images/groupe-icone.png">
								<a href="'.ABSOLUTE_ROOT . "/controleurs/ControleurGroupe.php?action=afficherInfosGroupe&donnee={$groupe['groupe_id']}".'">
									<div class="btn_etat">
										Voir <br/>Groupe
									</div>
								</a>';
								switch(intval($groupe['groupe_droit']))
								{
									case 0:
										echo '<a href="'.ABSOLUTE_ROOT . "/controleurs/ControleurGroupe.php?action=validerAjoutUserGroupe&donnee={$groupe['groupe_id']}".'">
										<div class="btn_participer">
											Sinscrire <br/>au Groupe
										</div>
										</a>';
										break;
									case 1:
										echo '<a href="'.ABSOLUTE_ROOT . "/controleurs/ControleurGroupe.php?action=DemandeAjoutUserGroupe&donnee={$groupe['groupe_id']}".'">
										<div class="btn_participer">
											Demander <br/>ajout
										</div>
										</a>';
										break;
									default:
										echo '<a href="'.ABSOLUTE_ROOT . "/controleurs/ControleurGroupe.php?action=DemandeAjoutUserGroupe&donnee={$groupe['groupe_id']}".'">
										<div class="btn_participer">
											Demander <br/>ajout
										</div>
										</a>';
										break;
								};

							echo '</div>

							<div class="desc_groupe">
								<p class="desc_titre">'.$groupe['groupe_nom'].'</p>
								<br/>
								<p class="desc_txt">'.$groupe['groupe_desc'].'
								</p>
								<br/>
							</div>
						</td>';
					$k=1;
				}
			}
		?>
		</tbody>
	</table>
</div>