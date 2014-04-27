	<?php $this->titre="Creation Sondage"; ?>
	<section id="bloc_global">
		<table id="table_connexion">
			<tr>

				<td>

					<fieldset>
						<legend>


							CREER UN SONDAGE

						</legend>
						<div class="form registration">
							<form id="creerSondage" onsubmit="return false;" autocomplete="off" method="post" name="login" action="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurSondage.php?action=validerCreerSondage'; ?>">

								<div class="control-group">
									<label class="control-label" for="sondage_titre">


										Titre:


									</label>
									<div class="controls">
										<input id="sondage_titre" type="text" autocomplete="off" maxlength="20" value="" placeholder="Titre du Sondage" name="sondage_titre" required="required"></input>
										<br></br>
										<small id="checkTitreSondage"></small>
									</div>
								</div>


								<div class="control-group">
									<label class="control-label" for="sondage_desc">


										Description :


									</label>
									<div class="controls">
										<TEXTAREA id="sondage_desc" name="sondage_desc" rows=5 COLS=52></TEXTAREA>
										<br></br>
										<small id="checkTitreSondage"></small>
									</div>
								</div>




								<!--type sondage -->
								<div class="control-group">
									<label class="control-label" for="sondage_type">


										Type:


									</label>
									<div class="controls">
										<SELECT id="sondage_type" name="sondage_type" required="required">
											<OPTION VALUE="0">Public</OPTION>
											<OPTION VALUE="1">Public Inscrit</OPTION>
											<OPTION VALUE="2">Privé</OPTION>
											<OPTION VALUE="3">Privé Groupe</OPTION>
										</SELECT>
										<small id="checkTypeSondage"></small>
									</div>
								</div>

								<!--Option sondage -->
								<div class="control-group" id="groupeSondageListe" style="display:none;">
									<label class="control-label" for="sondage_groupe">


										Groupe:


									</label>
									<div class="controls" >
										<SELECT id="sondage_groupe" name="sondage_groupe">
											<OPTION VALUE="-1"></OPTION>
											<?php foreach ($groupes as $groupe): ?>
												<OPTION VALUE=<?php echo "".$groupe['groupe_id'];?>><?php echo $groupe['groupe_nom'];?></OPTION>
											<?php endforeach; ?>
										</SELECT>
										<small id="checkGroupeSondage"></small>
									</div>
								</div>

								<!--type sondage -->
								<div class="control-group">
									<label class="control-label" for="sondage_typeMethode">


										Type Mythode:


									</label>
									<div class="controls">
										<SELECT id="sondage_typeMethode" name="sondage_typeMethode" required="required">
											<OPTION VALUE="0">Borda</OPTION>
											<OPTION VALUE="1">Condorcet</OPTION>
											<OPTION VALUE="2">Vote Alternatif</OPTION>
										</SELECT>
										<small id="checkTypeSondage"></small>
									</div>
								</div>


								<div class="control-group">
									<label class="control-label" for="sondage_fin">


										Date Fin:


									</label>
									<div class="controls">
										<input id="sondage_fin" type="text" placeholder ="aaaa-mm-jj" name="sondage_fin" required="required"></input>
										<br></br>
										<small id="checkDateFin_s"></small>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="sondage_visi">


										Visibilité:


									</label>
									<div class="controls">
										<SELECT id="sondage_visi" name="sondage_visi">
											<OPTION VALUE="0">Secret</OPTION>
											<OPTION VALUE="1">Secret durant Scrutin</OPTION>
											<OPTION VALUE="2">Non Secret</OPTION>
										</SELECT>
										<small id="checkVisiSondage"></small>
									</div>
								</div>



								<!-- option 1 -->

								<div class="control-group">
									<label class="control-label" for="sondage_opt1">


										Option 1:


									</label>
									<div class="controls">
										<input id="sondage_opt1" type="text" autocomplete="off" maxlength="20" value="" placeholder="Titre de L'option 1" name="sondage_opt1" required="required"></input>
										<br></br>
										<small id="checkOption1Sondage"></small>
									</div>
								</div>



								<!-- option 2 -->

								<div class="control-group">
									<label class="control-label" for="sondage_opt2">


										Option 2:


									</label>
									<div class="controls">
										<input id="sondage_opt2" type="text" autocomplete="off" maxlength="20" value="" placeholder="Titre de L'option 2" name="sondage_opt2" required="required"></input>
										<br></br>
										<small id="checkOption2Sondage"></small>
									</div>
								</div>




								<!-- option 3 -->

								<div class="control-group">
									<label class="control-label" for="sondage_opt3">


										Option 3:


									</label>
									<div class="controls">
										<input id="sondage_opt3" type="text" autocomplete="off" maxlength="20" value="" placeholder="Titre de L'option 3" name="sondage_opt3" ></input>
										<br></br>
										<small id="checkOption3Sondage"></small>
									</div>
								</div>



								<!-- option 4 -->

								<div class="control-group">
									<label class="control-label" for="sondage_opt4">


										Option 4:


									</label>
									<div class="controls">
										<input id="sondage_opt4" type="text" autocomplete="off" maxlength="20" value="" placeholder="Titre de L'option 4" name="sondage_opt4"></input>
										<br></br>
										<small id="checkOption4Sondage"></small>
									</div>
								</div>


								<!-- option 5 -->

								<div class="control-group">
									<label class="control-label" for="sondage_opt5">


										Option 5:


									</label>
									<div class="controls">
										<input id="sondage_opt5" type="text" autocomplete="off" maxlength="20" value="" placeholder="Titre de L'option 5" name="sondage_opt5"></input>
										<br></br>
										<small id="checkOption5Sondage"></small>
									</div>
								</div>


								<!-- option 6 -->

								<div class="control-group">
									<label class="control-label" for="sondage_opt6">


										Option 6:


									</label>
									<div class="controls">
										<input id="sondage_opt6" type="text" autocomplete="off" maxlength="20" value="" placeholder="Titre de L'option 6" name="sondage_opt6"></input>
										<br></br>
										<small id="checkOption6Sondage"></small>
									</div>
								</div>



								<!-- option 7 -->

								<div class="control-group">
									<label class="control-label" for="sondage_opt7">


										Option 7:


									</label>
									<div class="controls">
										<input id="sondage_opt7" type="text" autocomplete="off" maxlength="20" value="" placeholder="Titre de L'option 7" name="sondage_opt7"></input>
										<br></br>
										<small id="checkOption7Sondage"></small>
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


	$("#sondage_type").change(function(){
		if($(this).val()=="3")
			{$("#groupeSondageListe").fadeIn(400);}
		else
			{$("#groupeSondageListe").fadeOut(400);}
	});
	
	/*$("#NonBtn").click(function(){
		//$("#groupeSondageListe").hide();
		$("#groupeSondageListe").fadeOut(400);
	});*/

	$("input").focus(function(){
		$(".checkSubmit").fadeOut(800);
	});

	// FONCTION DE VERIFIACTION DE LA DATE


	function checkDate(_date) 
	{
		reg = new RegExp(/^[0-9]{4}[-][0-1]{1}[0-9]{1}[-][0-3]{1}[0-9]{1}$/);
		if(!reg.test(_date)){ // VERIFICATION DU FORMAT aaaa-mm-jj
			return false;
		}
		tabDate = _date.split('-');
		dateTest = new Date(tabDate[0], tabDate[1] - 1, tabDate[2]);

		var today = new Date();
		var d1 = new Date(today.getFullYear(),today.getMonth(),today.getDate());
		console.log(d1>dateTest);

		if(parseInt(tabDate[2], 10) != parseInt(dateTest.getDate(), 10)
			|| parseInt(tabDate[1], 10) != parseInt(dateTest.getMonth(), 10) + parseInt(1, 10)
			|| parseInt(tabDate[0], 10) != parseInt(dateTest.getFullYear(), 10) )
		{ // VERIFICATION DE L'EXSISTANCE
			return 0; // si date non coherente
		}
		else if(dateTest<d1)
		{
			return 1; // si date inferieur a la date actuel
		}
		else return 2; // si date bon format , coherente et superieur a la date actuel
	} 




	$("#sondage_fin").keyup(function()
	{
		if(checkDate($(this).val()) == 0)
		{
			$("#checkDateFin_s").css("color","red").html("Date Invalide (aaaa-mm-jj)");
		}
		else if(checkDate($(this).val()) == 2)
			$("#checkDateFin_s").html('<img src="../public/images/check.png" class="small_image" alt="" /><p class="text_ok">Date Valide</p>');
		else
			$("#checkDateFin_s").css("color","red").html("Date doit etre superieur a aujourd'hui");
	});








	// FONCTION DE VERIFiCATION DU FORMULAIRE AVANT ENVOI


		///// DERNIERE VERIFICATION AVANT DE SUBMIT LE FORMULAIRE ////

		$("#creerSondage").submit(function(){
			// on definit nos variables

			var status = $(".checkSubmit");
			var nom = $("#sondage_titre").val();
			var desc = $("#sondage_desc").val();
			var type= $("#sondage_type").val();
			var typeMethode= $("#sondage_typeMethode").val();
			var datefin = $("#sondage_fin").val();
			var visi = $("#sondage_visi").val();
			var groupe = $("#sondage_groupe").val();
			var option1 = $("#sondage_opt1").val();
			var option2 = $("#sondage_opt2").val();
			var option3 = $("#sondage_opt3").val();
			var option4 = $("#sondage_opt4").val();
			var option5 = $("#sondage_opt5").val();
			var option6 = $("#sondage_opt6").val();
			var option7 = $("#sondage_opt7").val();


			//on teste si les Champs sont vides
			if(nom==""|| desc ==""|| type ==""||typeMethode==""|| datefin ==""|| visi ==""|| option1=="" || option2=="" )
			{
				status.html("Veuillez Remplir Tous les Champs S.V.P").fadeIn(400);
			}
			else // on traite la creation du sondage avec AJAX
			{
				/*alert(nom);
				alert(desc);
				alert(type);
				alert(typeMethode);
				alert(visi);
				alert(datefin);
				alert(option1);
				alert(option2);*/

				$.ajax({
					type:"post",
					url:$(this).attr('action'),
					data: {
						'titre' :nom,
						'texte_desc' :desc,
						'sondage_droit' :type,
						'date_fin' :datefin,
						'visibilite' :visi,
						'type_methode' :visi,
						'groupe_id' :groupe,
						'option1' :option1,
						'option2' :option2,
						'option3' :option3,
						'option4' :option4,
						'option5' :option5,
						'option6' :option6,
						'option7' :option7,
					},
					beforeSend:function()
					{
						$("#registerbtn").attr('value', 'Traitement en Cours....').fadeIn(1000);
					},
					success:function(result){
						if($.trim(result) != "UpdateSuccess"){
							status.html(" Respectez ce qui est ecrit en rouge SVP!!!!").fadeIn(400); // on fadeIn les echo renvoyer par la fonction inscription
							$("#registerbtn").attr('value','VALIDER');
						}
						else
						{
							//$("#table_connexion").replaceWith('<p>Vous venez d\'effectuer votre inscription sur Sondagax<br/>Un lien d\'activation de votre vient de vous etre envoyer</p>');
							alert("Vous venez de Creer un Sondage")
							window.location.href="ControleurSondage.php?action=afficherMesSondagesCres";
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