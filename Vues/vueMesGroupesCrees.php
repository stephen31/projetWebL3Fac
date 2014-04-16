<?php $this->titre = "Groupes Crees"; ?>
<div id="bloc_contents">
	<h3> MES GROUPES CREES</h3>
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