<?php $this->titre="Inscription"; ?>
<section id="bloc_global">
	<table id="table_connexion">
		<tr>

			<td>

				<fieldset>
					<legend>


						MODIFIER VOS INFORMATIONS

					</legend>
					<div class="form registration">
						<form id="updateRegister" autocomplete="off" method="post" name="login" onsubmit="return false" action="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=miseAJourUtilisateur'; ?>">
							<input id="reg" type="hidden" value="1" name="reg" required="required"></input>
							<div class="control-group">
								<label class="control-label" for="newpseudo">

									
									Pseudo:


								</label>
								<div class="controls">
									<input id="newpseudo" type="text" autocomplete="off" maxlength="20" value="" placeholder="Pseudo" name="newpseudo" required="required"></input>
									<br></br>
									<small id="checkuser"></small>
								</div>
							</div>
							<!--password -->
							<div class="control-group">
								<label class="control-label" for="pass1I">


									Mot de passe:


								</label>
								<div class="controls">
									<input id="pass1I" type="password" autocomplete="off" maxlength="20" value="" placeholder="Mot de passe" name="pass1I" required="required"></input>
									<br></br>
									<small id="checkpass1"></small>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="pass2">


									Confirmez Mot de Passe:


								</label>
								<div class="controls">
									<input id="pass2" type="password" autocomplete="off" maxlength="20" value="" placeholder="Confirmez Mot de Passe" name="pass2" required="required"></input>
									<br></br>
									<small id="checkpass2"></small>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="nom">


									Nom:


								</label>
								<div class="controls" style="display: inline-block; margin-left: 0;">
									<input id="nom" type="text" autocomplete="off" maxlength="100" value="" placeholder="Nom" name="nom" style="width:140px;" required="required"></input>
									<br></br>
								</div>
								<div class="controls" style="display: inline-block; margin-left: 0;">
									<input id="prenom" type="text" autocomplete="off" maxlength="100" value="" placeholder="Prenom" name="prenom" style="width:140px;" required="required"></input>
									<br></br>
								</div>
							</div>
							<!--email -->
							<div class="control-group">
								<label class="control-label" for="email1">


									Email:


								</label>
								<div class="controls">
									<input id="email1" type="text" autocomplete="off" maxlength="200" value="" placeholder="Email" required="required" name="email1"></input>
									<br></br>
									<small id="checkemail1"></small>
								</div>
							</div>
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

<script>
	$(document).ready(function(){

		$("input").focus(function(){
			$(".checkSubmit").fadeOut(800);
			//effacer("#register");
		});

		$("#newpseudo").keyup(function() {  // si activité dans le champs input alors :
			/* Act on the event */
			check_pseudo(); // on appele la fonction de verif pseudo
		});

		$("#pass1I").keyup(function() {  // si activité dans le champs input pass1I alors :
			/* Act on the event */
			if($(this).val().length<6)
			{
				$("#checkpass1").css("color","red").html("Mot de passe Trop Court (6 Caracteres requis)");
			}
			else if(($("#pass2").val() != "") && ($("#pass2").val() != $("#pass1I").val()))
			{
				$("#checkpass1").html("Les mots de passe sont différents");
				$("#checkpass2").html("Les mots de passe sont différents");
			}
			else
			{
				//alert("sal");
				$("#checkpass1").html('<img src="../public/images/check.png" class="small_image" alt="" /><p class="text_ok">Mot de Passe correct</p>');
				if($("#pass2").val()!="")
				{
					$("#checkpass2").html('<img src="../public/images/check.png" class="small_image" alt="" /><p class="text_ok">Les mots de passe correspondent</p>');
				}

			}
		});

		$("#pass2").keyup(function(){  // si activité dans le champs input pass2 alors :
			/* Act on the event */

			if($(this).val().length>=6)
			{

				if(($("#pass2").val() != "") && ($("#pass2").val() != $("#pass1I").val()))
				{
					$("#checkpass1").html("Les mots de passe sont différents");
					$("#checkpass2").html("Les mots de passe sont différents");
				}
				else
				{
					$("#checkpass2").html('<img src="../public/images/check.png" class="small_image" alt="" /><p class="text_ok">Mot de Passe correct</p>');
					$("#checkpass1").html('<img src="../public/images/check.png" class="small_image" alt="" /><p class="text_ok">Mot de Passe correct</p>');
					if($("#pass2").val()=="")
					{
						$("#checkpass2").html('<img src="../public/images/check.png" class="small_image" alt="" /><p class="text_ok">Veuillez confirmez le mot de passe</p>');
					}
				}
			}
			else
			{
				$("#checkpass2").css("color","red").html("Mot de passe different");
			}

		});

		$("#email1").keyup(function(){  // si activité dans le champs input email alors :
			/* Act on the event */
			check_email();
		});


		/*function effacer (formulaire) { 
			$(formulaire+' :input') .not(':button, :submit, :reset') .val('') .removeAttr('checked') .removeAttr('selected'); 
		}*/


		function check_pseudo()
		{
			$.ajax({
				type:"post",
				url:"../controleurs/ControleurUser.php?action=verifPseudo", //on redirige vers fichier de traitement
				data: {
					'pseudo' : $("#newpseudo").val()
				},
				success:function(data){
					if($.trim(data) == 'success') // $.trim permet de retirer les espaces
					{
						// si le resulat (data) == succes on affiche l'image de validation
						$("#checkuser").html('<img src="../public/images/check.png" class="small_image" alt="" /><p class="text_ok">Pseudo disponible</p>');
						return true;
					}
					else
					{
						$("#checkuser").css("color","red").html(data);
					}
				}

			});
		}


		function check_email()
		{
			$.ajax({
				type:"post",
				url:"../controleurs/ControleurUser.php?action=verifEmail",//on redirige vers fichier de traitement
				data: {
					'email' : $("#email1").val()
				},
				success:function(data){
					if($.trim(data) == 'success') // $.trim permet de retirer les espaces
					{
						// si le resulat (data) == succes on affiche l'image de validation
						$("#checkemail1").html('<img src="../public/images/check.png" class="small_image" alt="" /><p class="text_ok">Email valide</p>');
						return true;
					}
					else
					{
						$("#checkemail1").css("color","red").html(data);
					}
				}

			});
		}

		///// DERNIERE VERIFICATION AVANT DE SUBMIT LE FORMULAIRE ////

		$("#updateRegister").submit(function(){
			// on definit nos variables
			var status = $(".checkSubmit");
			var nom = $("#nom").val();
			var prenom = $("#prenom").val();
			var pseudo = $("#newpseudo").val();
			var email = $("#email1").val();
			var pass1 = $("#pass1I").val();
			var pass2 = $("#pass2").val();

			/*alert(nom);
			alert(prenom);
			alert(register);
			alert(pseudo);
			alert(email);
			alert(pass1);
			alert(pass2);*/

			//on teste si les Champs sont vides
			if(nom==""|| prenom ==""|| email ==""|| pseudo ==""|| pass1 ==""|| pass2 =="")
			{
				status.html("Veuillez Remplir Tous les Champs S.V.P").fadeIn(400);
			}
			else if(pass1 != pass2)
			{
				status.html("Les deux mots de passe sont differents").fadeIn(400);
			}
			else if(pass1.length<6 || pass2.length<6)
			{
				status.html("Mot de passe Trop Court (6 Caracteres requis)").fadeIn(400);
			}
			else // on traite l'inscription avec AJAX
			{
				$.ajax({
					type:"post",
					url:$(this).attr('action'),
					data: {
						'nom' :nom,
						'prenom' :prenom,
						'pseudo' :pseudo,
						'email' :email,
						'pass1' :pass1,
						'pass2' :pass2,
					},
					beforeSend:function()
					{
						$("#registerbtn").attr('value', 'Traitement en Cours....').fadeIn(1000);
					},
					success:function(result){
						if($.trim(result) != "successsuccessUpdateSuccess"){ //success renvoyer par verif pseudo et verifemail et de la confirmation de la mise a jour
							status.html("Respectez ce qui est ecrit en rouge !!!").fadeIn(400); // on fadeIn les echo renvoyer par la fonction inscription
							$("#registerbtn").attr('value','VALIDER');
						}
						else
						{
							//$("#table_connexion").replaceWith('<p>Vous venez d\'effectuer votre inscription sur Sondagax<br/>Un lien d\'activation de votre vient de vous etre envoyer</p>');
							alert('modification effectuée');
							window.location.href = "../index.php";
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

