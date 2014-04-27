<?php $this->titre="Information Groupe"; ?>
<section id="bloc_global">
	<table id="table_connexion">
		<tr>

			<td>

				<fieldset>
					<legend>


						INFORMATION GROUPE <?php echo "".$groupe[0]['groupe_nom'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div id="blocControlGroupe">
						<?php 
							if($isAdmin == 1)
							{
								echo 
								'<a href="../controleurs/ControleurGroupe.php?action=afficherAjoutModerateurGroupe&donnee='.$groupe[0]["groupe_id"].'">
									<div class="btn_modif">
										Ajout<br/>Moderateur
									</div>
								</a>';
								if($haveModerateur == true)
								{
									echo 
									'<a href="../controleurs/ControleurGroupe.php?action=afficherRetraitModerateurGroupe&donnee='.$groupe[0]["groupe_id"].'">

									<div class="btn_modif">
										retrait<br/>Moderateur
									</div>
									</a>';
								}
								if($groupe[0]['groupe_droit']==2)
								{
									echo 
									'<a href="../controleurs/ControleurGroupe.php?action=afficherAjoutUtilisateurGroupe&donnee='.$groupe[0]["groupe_id"].'">
									<div class="btn_participer">
										Ajout<br/>Utilisateur
									</div>
									</a>';
								}
							}



						?>
						</div>
					</legend>
					<div class="form registration">
						<div class="control-group">
							Titre: <?php echo "".$groupe[0]['groupe_nom'];?>
						</div>

						<div class="control-group">
							Createur du Groupe : <?php echo "".$createur[0]['ut_pseudo'];?>
						</div>
						<div class="control-group">
							Description : <?php echo "".$groupe[0]['groupe_desc'];?>
						</div>
						<!--type groupe -->
						<div class="control-group">
							Accessibilité du groupe:
							<?php

							if($groupe[0]['groupe_droit'] == 0)
							{
								echo " Public";
							}
							else if($groupe[0]['groupe_droit'] == 1)
							{
								echo " Public Prive";
							}
							else
							{
								echo "Prive Caché";
							}
							?>
						</div>

						<!--Liste des sondages du groupe-->
						<div class="control-group" id="SondagegroupeListe">

							Sondage: 
							<?php 
							if(!isset($sondages[0]['sondage_id']))
							{

								echo " Pas de Groupe pour ce groupe";
							}
							else
							{
								foreach ($sondages as $sondage) {
									echo $sondage['titre'].' . ';
								}
							}
							?>
						</div>


						<div class="control-group">
							Date Creation: <?php echo "".$groupe[0]['groupe_date_creation'];?>
						</div>
					</div>
				</fieldset>
			</td>
		</tr>
		<tr>

			<td>

				<fieldset>
					<legend>


					</legend>
					<?php
					if($isModerateur==1 || $isAdmin==1)
					{

						echo
						'<table cellspacing="0"> 
						<!-- Table Header -->
						<thead>
							<tr>
								<th>Utilisateur Inscrit</th>
								<th>Supprimer</th>
							</tr>
						</thead>
						<!-- Table Header -->

						<!-- Table Body -->
						<tbody>';
							foreach($UserInscrit as $UserI)
							{
								echo '<tr>
										<td>'.$UserI['ut_pseudo'].'</td>
										<td class="deleteUser"><a href="../controleurs/ControleurGroupe.php?action=validerRetraitInscrit&donnee='.$groupe[0]['groupe_id'].'&donnee2='.$UserI['ut_id'].'"><img src="../public/images/delete.png"></a></td>
										</tr><!-- Table Row -->';
							}
							echo '</tbody>
									<!-- Table Body -->
								</table>';
								if($groupe[0]['groupe_droit']==1)
								{
									echo
									'<table cellspacing="0"> 
									<!-- Table Header -->
									<thead>
									<tr>
										<th>Demande utilisateur</th>
										<th>Valider</th>
									</tr>
									</thead>
									<!-- Table Header -->

									<!-- Table Body -->
									<tbody>';
									foreach($UserDemande as $UserD)
									{
										echo '<tr>
										<td>'.$UserD['ut_pseudo'].'</td>
										<td class="deleteUser"><a href="../controleurs/ControleurGroupe.php?action=validerDemandeUserGroupe&donnee='.$groupe[0]['groupe_id'].'&donnee2='.$UserD['ut_id'].'"><img src="../public/images/check.png"></a></td>
										</tr><!-- Table Row -->';
									}
									echo '</tbody>
									<!-- Table Body -->
									</table>';
								}

					}
					else
					{
						echo
						'<table cellspacing="0"> 
						<!-- Table Header -->
						<thead>
							<tr>
								<th>Utilisateur Inscrit</th>
							</tr>
						</thead>
						<!-- Table Header -->

						<!-- Table Body -->
						<tbody>';
							foreach($UserInscrit as $UserI)
							{
								echo '<tr>
										<td>'.$UserI['ut_pseudo'].'</td>
										</tr><!-- Table Row -->';
							}
							echo '</tbody>
									<!-- Table Body -->
								</table>';

					}
					?>
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
							//$("#bloc_global").replaceWith('<div id="bloc_contents"><p style="text-align:center;color:red"> Bravo Bravo Bravo </br> Vous venez de creer un groupe sur Sondagax</div>');
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
		//$(this).OnClientClick.disabled = true;
		var status =$(this).parent().parent().parent().parent().find("#textCommentInput").find(".checkComment");
		var comId = $(this).parent().parent().find("#comId").html();
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
					alert(result); // on fadeIn les echo renvoyer par la fonction inscription
				}
				else
				{

					//$("#table_connexion").replaceWith('<p>Vous venez d\'effectuer votre inscription sur Sondagax<br/>Un lien d\'activation de votre vient de vous etre envoyer</p>');
					$($this).find(".nbS").hide().html(parseInt(nbSoutient)+1).fadeIn(400);
					//$("#bloc_global").replaceWith('<div id="bloc_contents"><p style="text-align:center;color:red"> Bravo Bravo Bravo </br> Vous venez de creer un groupe sur Sondagax</div>');
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