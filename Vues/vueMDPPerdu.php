			<section id="bloc_global">
				<table id="table_connexion">
					<tr>
						<td>

							<fieldset>

								<legend>


									MOT DE PASSE OUBLIE

								</legend>
								<div class="form registration">
									<form id="passR" name="forgotpassword" action="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=envoiMotDePassePerdu'; ?>" method="post">
										<div class="control-group">
											<label class="control-label" for="email2">

												Email:

											</label>
											<div class="controls">
												<input id="email2" class="input-error" type="text" value="" placeholder="Email" name="email2" required="required"></input>
												<br></br>
											</div>
										</div>
										<div class="control-group">
											<div class="checkSubmit">
												<br/>Entrez votre email <br/><br/>
											</div>
											<small id="checkemail2"></small>
										</div>
										<div class="control-group">
											<div class="controls">
												<input id="registerbtn" class="submit-btn btn2" type="submit" value="ENVOYER MOT DE PASSE"></input>
											</div>
										</div>
									</form>
								</div>
							</td>
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
	</table>
</section>


<script>
	$(document).ready(function(){

		$("input").focus(function(){
			$(".checkSubmit").fadeOut(800);
			//effacer("#register");
		});

		$("#email2").keyup(function(){  // si activité dans le champs input email alors :
			/* Act on the event */
			check_email();
		});

		function check_email()
		{
			$.ajax({
				type:"post",
				url:"../controleurs/ControleurUser.php?action=verifEmail",//on redirige vers fichier de traitement
				data: {
					'email' : $("#email2").val()
				},
				success:function(data){
					if($.trim(data) == 'success') // $.trim permet de retirer les espaces
					{
						$("#checkemail2").css("color","red").html("email inconnu");
					}
					else if($.trim(data) == 'Adresse email invalide') // $.trim permet de retirer les espaces
					{
						$("#checkemail2").css("color","red").html(data);
					}
					else
					{
						// si le resulat (data) == succes on affiche l'image de validation
						$("#checkemail2").html('<img src="../public/images/check.png" class="small_image" alt="" /><p class="text_ok">Email valide</p>');
						return true;
					}
				}

			});
		}

		///// DERNIERE VERIFICATION AVANT DE SUBMIT LE FORMULAIRE ////

		$("#passR").submit(function(){
			// on definit nos variables
			var status = $(".checkSubmit");
			var email = $("#email2").val();

			//on teste si les Champs sont vides
			if(email =="")
			{
				status.html("Veuillez Remplir le champ Email").fadeIn(400);
			}
			else // on traite l'inscription avec AJAX
			{
				$.ajax({
					type:"post",
					url:$(this).attr('action'),
					data: {
						'email' :email
					},
					beforeSend:function()
					{
						$("#registerbtn").attr('value', 'Traitement en Cours....').fadeIn(1000);
					},
					success:function(result){
						if($.trim(result) != "SendSuccess"){
							status.html(result).fadeIn(400); // on fadeIn les echo renvoyer par la fonction inscription
							$("#registerbtn").attr('value','ENVOYER MOT DE PASSE');
						}
						else
						{
							//$("#table_connexion").replaceWith('<p>Vous venez d\'effectuer votre inscription sur Sondagax<br/>Un lien d\'activation de votre vient de vous etre envoyer</p>');
							$("#bloc_global").replaceWith('<?php $this->titre = "Envoi Mot de Passe Terminee"; ?><div id="bloc_contents"><p style="text-align:center;color:red">Votre Mot de passe vient de vous etre envoyer a votre email</p></div>');
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

