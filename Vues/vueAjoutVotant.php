<?php $this->titre="Ajout Votant Sondage"; ?>
<section id="bloc_global">
	<table id="table_connexion">
		<tr>

			<td>

				<fieldset>
					<legend>


						AJOUTER UN VOTANT AU SONDAGE : <?php echo "".$sondage[0]['titre'];?>

					</legend>
					<div class="form registration">
						<form id="ajoutVotant" onsubmit="return false;" autocomplete="off" method="post" name="ajoutVotant" action="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=validerAjoutVotant&donnee={$sondage[0]['sondage_id']}"; ?>">
							<div class="control-group">
								<label class="control-label" for="pseudoVotant">


									Pseudo:


								</label>
								<input id="sendId" type="hidden" value="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=verifPseudoVotant&donnee={$sondage[0]['sondage_id']}"; ?>">
								<div class="controls">
									<input id="pseudoVotant" type="text" autocomplete="off" maxlength="20" value="" placeholder="Pseudo..." name="pseudoVotant" required="required"></input>
									<br></br>
									<small id="checkAjoutVotant"></small>
								</div>
							</div>

							<!-- Verif-->
							<div class="control-group">
								<div class="checkSubmit">
									<br/>Remplissez les champs <br/><br/>
								</div>
							</div>
							<div class="control-group">

								<div class="controls">
									<input id="registerbtn" class="btn2" type="submit" value="VALIDER"></input>
									<br></br>
								</div>

							</div>
						</form>
					</div>
				</fieldset>
			</td>
		</tr>
	</table>
</section>





<!--VERIFICATION DU FORMULAIRE -->


<script type="text/javascript">
//window.onload = function () // Javascript version 
$(document).ready(function(){

	$("input").focus(function(){
		$(".checkSubmit").fadeOut(800);
	});

	$("#pseudoVotant").keyup(function(){

		check_pseudoVotant();
	});

	function check_pseudoVotant()
	{
		$.ajax({
			type:"post",
			url:$("#sendId").attr('value'), //on redirige vers fichier de traitement
			data: {
				'pseudo' : $("#pseudoVotant").val(),

			},
			success:function(data){
					if($.trim(data) == 'dispo') // $.trim permet de retirer les espaces
					{
						// si le resulat (data) == succes on affiche l'image de validation
						$("#checkAjoutVotant").html('<img src="../public/images/check.png" class="small_image" alt="" /><p class="text_ok">Pseudo éligible a etre ajouter</p>');
						return true;
					}
					else
					{
						$("#checkAjoutVotant").css("color","red").html(data);
					}
				}

			});
	}








	// FONCTION DE VERIFiCATION DU FORMULAIRE AVANT ENVOI


		///// DERNIERE VERIFICATION AVANT DE SUBMIT LE FORMULAIRE ////

		$("#ajoutVotant").submit(function(){
			// on definit nos variables

			var status = $(".checkSubmit");
			var pseudo = $("#pseudoVotant").val();


			//on teste si les Champs sont vides
			if(pseudo=="")
			{
				status.html("Veuillez Remplir Tous les Champs S.V.P").fadeIn(400);
			}
			else // on traite la creation du sondage avec AJAX
			{

				$.ajax({
					type:"post",
					url:$(this).attr('action'),
					data: {
						'pseudo' :pseudo,
					},
					beforeSend:function()
					{
						$("#registerbtn").attr('value', 'Traitement en Cours....').fadeIn(1000);
					},
					success:function(result){
						if($.trim(result) != "dispodispodispoUpdateSuccess"){
							status.html(result).fadeIn(400); // on fadeIn les echo renvoyer par la fonction inscription
							$("#registerbtn").attr('value','VALIDER');
						}
						else
						{
							//$("#table_connexion").replaceWith('<p>Vous venez d\'effectuer votre inscription sur Sondagax<br/>Un lien d\'activation de votre vient de vous etre envoyer</p>');
							alert("Vous venez d'ajoutez un votant");
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

});



</script>