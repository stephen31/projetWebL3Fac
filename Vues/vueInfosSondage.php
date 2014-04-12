	<?php $this->titre="Information Sondage"; ?>
	<section id="bloc_global">
		<table id="table_connexion">
			<tr>

				<td>

					<fieldset>
						<legend>


							INFORMATION SONDAGE <?php echo "".$sondage[0]['titre'];?>

						</legend>
						<div class="form registration">
							<div class="control-group">
								Titre: <?php echo "".$sondage[0]['titre'];?>
							</div>


							<div class="control-group">
								Description : <?php echo "".$sondage[0]['texte_desc'];?>
							</div>
							<!--type sondage -->
							<div class="control-group">
								Accessibilité du sondage:
								<?php

								if($sondage[0]['sondage_droit'] == 0)
								{
									echo " Public";
								}
								else if($sondage[0]['sondage_droit'] == 1)
								{
									echo " Public Inscrit";
								}
								else if($sondage[0]['sondage_droit'] == 2)
								{
									echo " Prive";
								}
								else
								{
									echo "Prive Groupe";
								}
								?>
							</div>

							<!--Groupe sondage -->
							<div class="control-group" id="groupeSondageListe">

								Groupe: 
								<?php 
								echo $groupe[0]['groupe_nom'];
								if(isset($groupe[0]['groupe_nom']))
								{

									echo $groupe[0]['groupe_nom'];
								}
								else
								{
									echo " Pas de Groupe pour ce sondage";
								}
								?>
							</div>

							<!--type Methode-->
							<div class="control-group">
								Type Mythode:
								<?php

								if($sondage[0]['type_methode'] == 0)
								{
									echo " Borda";
								}
								else if($sondage[0]['type_methode'] == 1)
								{
									echo " Condorcet";
								}
								else if($sondage[0]['type_methode'] == 2)
								{
									echo " Vote Alternatif";
								}
								else
								{
									echo "sait pas";
								}
								?>
							</div>


							<div class="control-group">
								Date Creation: <?php echo "".$sondage[0]['sondage_date_create'];?>
							</div>

							<div class="control-group">
								Date Fin: <?php echo "".$sondage[0]['date_fin'];?>
							</div>

							<div class="control-group">
								Visibilité Des votes:
								<?php

								if($sondage[0]['visibilite'] == 0)
								{
									echo " Secret";
								}
								else if($sondage[0]['visibilite'] == 1)
								{
									echo " Secret durant Scrutin";
								}
								else 
								{
									echo " Non Secret";
								}
								?>
							</div>

							<!-- options-->

							<div class="control-group">
								Liste des options:

								<?php foreach($options as $option): ?>
									<span>,<?php echo $option['titre']; ?></span>
								<?php endforeach; ?>
							</div>
						</div>
					</fieldset>
				</td>
			</tr>
			<tr>

				<td>

					<fieldset>
						<legend>

							<br/>
							<br/>
							<br/>
							RESULTAT DU SONDAGE <?php echo "".$sondage[0]['titre'];?>

						</legend>
						<div class="form registration">
							<div class="control-group">
								<?php 

								if($sondage[0]['date_fin']>$sondage[0]['sondage_date_create'])
								{
									echo " Le sondage n'est pas encore terminer";
								}
								else
								{
									echo " Choix de la methode de resolution: 
									<SELECT id='sondage_typeMethode' name='sondage_typeMethode' required='required'>
										<OPTION VALUE='0'>Borda</OPTION>
										<OPTION VALUE='1'>Condorcet</OPTION>
										<OPTION VALUE='2'>Vote Alternatif</OPTION>
									</SELECT>";
								}
								?>
							</div>
						</div>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td>

					<fieldset>
						<legend>
							<br/>
							<br/>
							<br/>

							COMMENTAIRES

						</legend>
						<div class="form registration">
							<div class="control-group">
								<div id="comment">
										<div>
											<div class="auteur">
												<a href="#">yaboyricky</a>
											</div>
											<div class="date">
												<span class="live-date">8 hours ago</span>
											</div>
											<div class="comment-controls">
												<span class="like-button">
													<em>1 J'aime</em>
												</span>
												<span class="repondre">Repondre</span>
											</div>
											<p id="comment_content">this song is old , it was in the product</p>
										</div>
								</div>
							</div>

						</div>
					</fieldset>
				</td>
			</tr>

		</table>
	</section>

