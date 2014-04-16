	<?php $this->titre="Creation Groupe"; ?>
	<section id="bloc_global">
		<table id="table_connexion">
			<tr>

				<td>

					<fieldset>
						<legend>


							CREER UN GROUPE

						</legend>
						<div class="form registration">
							<form id="creerGroupe" onsubmit="return false;" autocomplete="off" method="post" name="login" action="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurGroupe.php?action=validerCreerGroupe'; ?>">

								<div class="control-group">
									<label class="control-label" for="groupe_nom">


										Nom:


									</label>
									<div class="controls">
										<input id="groupe_nom" type="text" autocomplete="off" maxlength="20" value="" placeholder="Nom du Groupe" name="groupe_nom" required="required"></input>
										<br></br>
										<small id="checkNomGroupe"></small>
									</div>
								</div>


								<div class="control-group">
									<label class="control-label" for="groupe_desc">


										Description :


									</label>
									<div class="controls">
										<TEXTAREA id="groupe_desc" name="groupe_desc" rows=5 COLS=52></TEXTAREA>
										<br></br>
										<small id="checkDescriptionGroupe"></small>
									</div>
								</div>




								<!--type groupe -->
								<div class="control-group">
									<label class="control-label" for="groupe_type">


										Type:


									</label>
									<div class="controls">
										<SELECT id="groupe_type" name="groupe_type" required="required">
											<OPTION VALUE="0">Public</OPTION>
											<OPTION VALUE="1">Privé Public</OPTION>
											<OPTION VALUE="2">Privé Caché</OPTION>
										</SELECT>
										<small id="checkTypeGroupe"></small>
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

	$("#groupe_nom").keyup(function() {  // si activité dans le champs input alors :
		/* Act on the event */
			check_nom(); // on appele la fonction de verif pseudo
		});

		function check_nom()
		{
			$.ajax({
				type:"post",
				url:"../controleurs/ControleurGroupe.php?action=verifNom", //on redirige vers fichier de traitement
				data: {
					'groupe_nom' : $("#groupe_nom").val()
				},
				success:function(data){
					if($.trim(data) == 'success') // $.trim permet de retirer les espaces
					{
						// si le resulat (data) == succes on affiche l'image de validation
						$("#checkNomGroupe").html('<img src="../public/images/check.png" class="small_image" alt="" /><p class="text_ok">Nom disponible</p>');
						return true;
					}
					else
					{
						$("#checkNomGroupe").css("color","red").html(data);
					}
				}

			});
		}

	// FONCTION DE VERIFiCATION DU FORMULAIRE AVANT ENVOI


		///// DERNIERE VERIFICATION AVANT DE SUBMIT LE FORMULAIRE ////

		$("#creerGroupe").submit(function(){
			// on definit nos variables

			var status = $(".checkSubmit");
			var nom = $("#groupe_nom").val();
			var desc = $("#groupe_desc").val();
			var type= $("#groupe_type").val();
			//on teste si les Champs sont vides
			if(nom==""|| desc ==""|| type =="")
			{
				status.html("Veuillez Remplir Tous les Champs S.V.P").fadeIn(400);
			}
			else // on traite la creation du groupe avec AJAX
			{
				/*alert(nom);
				alert(desc);
				alert(type);*/

				$.ajax({
					type:"post",
					url:$(this).attr('action'),
					data: {
						'groupe_nom' :nom,
						'groupe_desc' :desc,
						'groupe_droit' :type,
						'groupe_desc' :desc,
					},
					beforeSend:function()
					{
						$("#registerbtn").attr('value', 'Traitement en Cours....').fadeIn(1000);
					},
					success:function(result){
						if($.trim(result) != "successUpdateSuccess"){
							status.html(result).fadeIn(400); // on fadeIn les echo renvoyer par la fonction inscription
							$("#registerbtn").attr('value','VALIDER');
						}
						else
						{
							//$("#table_connexion").replaceWith('<p>Vous venez d\'effectuer votre inscription sur Sondagax<br/>Un lien d\'activation de votre vient de vous etre envoyer</p>');
							alert("Vous venez de Creer un Groupe")
							window.location.href="ControleurGroupe.php?action=afficherMesGroupesCrees";
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