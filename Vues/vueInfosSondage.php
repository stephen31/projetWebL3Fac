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
					<div id='com' class="form registration">
						<div class="control-group">
							<?php foreach ($comments as $comment): ?>
								<div id="comment">
									<div id="ligneInfo">
										<div class="auteur">
											<a href="#"><?php echo $comment['ut_pseudo'] ?></a>
										</div>
										<div class="date">
											<span class="live-date">il y a <?php echo $comment['commentaire_date'] ?></span>
										</div>
										<div class="comment-controls">
											<span href="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=validerAjoutSoutien&donnee={$sondage[0]['sondage_id']}"; ?>" class="like-button">
												<em value=<?php echo $comment['soutien'].""?> class="nbS"><?php echo $comment['soutien'] ?></em><em> J'aime</em>
											</span>
											<span id="comId" style="VISIBILITY:hidden;display:none">
												<?php echo $comment['com_id'] ?>
											</span>
											<span class="repondre">Repondre</span>
										</div>	
									</div>
									<p id="comment_content"><?php echo $comment['texte'] ?></p>
									<div style="display:none" id="textCommentInput">
										<textarea maxlength="500"></textarea>
										<!-- Verif-->
										<div class="control-group">
											<div class="checkComment">Ecrivez votre commentaire
											</div>
										</div>
										<span id="comId" style="VISIBILITY:hidden;display:none">
											<?php echo $comment['com_id'] ?>
										</span>
										<button class="closeBtn">Fermer</button>
										<button class="SendBtn ajoutComment" value="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=validerAjoutSousCommentaire&donnee={$sondage[0]['sondage_id']}"; ?>">valider</button>

									</div>
									<?php foreach ($Souscomments as $Souscomment): ?>
										<?php if($Souscomment['com_parent_id']==$comment['com_id']):?>
											<div id="sous-comment">
												<div id="ligneInfo">
													<div class="auteur">
														<a href="#"><?php echo $Souscomment['ut_pseudo'] ?></a>
													</div>
													<div class="date">
														<span class="live-date">il ya <?php echo $Souscomment['commentaire_date'] ?></span>
													</div>
													<div class="comment-controls">
														<span href="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=validerAjoutSoutien&donnee={$sondage[0]['sondage_id']}"; ?>" class="like-button">
															<em class="nbS"><?php echo $Souscomment['soutien'] ?></em><em> J'aime</em>
														</span>
														<span id="comId" style="VISIBILITY:hidden;display:none">
															<?php echo $Souscomment['com_id'] ?>
														</span>
													</div>	
												</div>
												<span id="comId" style="VISIBILITY:hidden;display:none">
													<?php echo $Souscomment['com_id'] ?>
												</span>
												<p id="comment_content"><?php echo $Souscomment['texte'] ?></p>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							<?php endforeach; ?>
						</div>
						<div id="textCommentInput">
							<textarea maxlength="500"></textarea>
							<!-- Verif-->
							<div class="control-group">
								<div class="checkComment">Ecrivez votre commentaire
								</div>
							</div>
							<button class="SendBtn ajoutComment" value="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=validerAjoutCommentaire&donnee={$sondage[0]['sondage_id']}"; ?>">valider</button>
						</div>
					</div>
				</fieldset>
			</td>
		</tr>

	</table>
</section>


<script type="text/javascript">
//window.onload = function () // Javascript version 
$(document).ready(function(){






	$('.repondre').click(function()
	{
		$(this).parent().parent().next().next().fadeIn(600);
	});


	$('.closeBtn').click(function()
	{
		$(this).parent().parent().find('#textCommentInput').fadeOut(600);
	});


	$("textarea").focus(function(){
		$(this).parent().find(".checkComment").fadeOut(800);
	});





	$(".ajoutComment").click(function(){
			// on definit nos variables

			var status =$(this).parent().find(".checkComment");
			var texte = $(this).parent().find("textarea").val();
			var comId = $(this).parent().find("#comId").html();
			var utId = $(this).parent().find("#utId").html();
			
			if(texte=="")
			{
				status.html("Le Champ commentaire est vide !!!").fadeIn(400);
			}
			else // on traite l'envoie du commentaire avec AJAX
			{

				$.ajax({
					type:"post",
					url:$(this).attr('value'),
					data: {
						'texte' :texte,
						'com_parent_id':comId,
					},
					success:function(result){
						if($.trim(result) != "success"){
							status.html(result).fadeIn(400); // on fadeIn les echo renvoyer par la fonction inscription
						}
						else
						{
							//$("#table_connexion").replaceWith('<p>Vous venez d\'effectuer votre inscription sur Sondagax<br/>Un lien d\'activation de votre vient de vous etre envoyer</p>');
							alert("Vous venez de poster un comentaire");
							window.location = self.location;
							//$("#bloc_global").replaceWith('<div id="bloc_contents"><p style="text-align:center;color:red"> Bravo Bravo Bravo </br> Vous venez de creer un sondage sur Sondagax</div>');
						}
					},
					error:function(result)
					{
						alert("ERROR");
					}
				});
			}
			return false;
		});


	$(".like-button").click(function(){
		var status =$(this).parent().find(".checkComment");
		var comId = $(this).parent().find("#comId").html();
		var nbSoutient = $(this).find(".nbS").html();
		var $this = this;
		$.ajax({
			type:"post",
			url:$(this).attr('href'),
			data: {
				'soutien' :1,
				'com_id':comId,
			},
			success:function(result){
				if($.trim(result) != "success")
				{
					status.html(result).fadeIn(400); // on fadeIn les echo renvoyer par la fonction inscription
				}
				else
				{

					//$("#table_connexion").replaceWith('<p>Vous venez d\'effectuer votre inscription sur Sondagax<br/>Un lien d\'activation de votre vient de vous etre envoyer</p>');
					$($this).find(".nbS").hide().html(parseInt(nbSoutient)+1).fadeIn(400);
					//$("#bloc_global").replaceWith('<div id="bloc_contents"><p style="text-align:center;color:red"> Bravo Bravo Bravo </br> Vous venez de creer un sondage sur Sondagax</div>');
				}
			},
			error:function(result)
			{
				alert("ERROR");
			}
		});

	});

});



</script>