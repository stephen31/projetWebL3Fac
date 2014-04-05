	<?php $this->titre="Modification Sondage"; ?>
	<section id="bloc_global">
		<table id="table_connexion">
			<tr>

				<td>

					<fieldset>
						<legend>


							MODIFICATION DU SONDAGE <?php echo "".$sondage[0]['titre'];?>

						</legend>
						<div class="form registration">
							<form id="modifSondage" onsubmit="return false;" autocomplete="off" method="post" name="login" action="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=validerModifSondage&donnee={$sondage[0]['sondage_id']}"; ?>">

								<div class="control-group">
									<label class="control-label" for="sondage_titreM">


										Titre:


									</label>
									<div class="controls">
										<input id="sondage_titreM" type="text" autocomplete="off" maxlength="20" value=<?php echo "".$sondage[0]['titre']; ?> placeholder="Titre du Sondage" name="sondage_titreM" required="required"></input>
										<br></br>
										<small id="checkTitreSondageModif"></small>
									</div>
								</div>


								<div class="control-group">
									<label class="control-label" for="sondage_descM">


										Description :


									</label>
									<div class="controls">
										<TEXTAREA id="sondage_descM" name="sondage_descM" rows=5 COLS=52><?php echo "".$sondage[0]['texte_desc']; ?> </TEXTAREA>
										<br></br>
									</div>
								</div>




								<!--type sondage -->
								<div class="control-group">
									<label class="control-label" for="sondage_typeM">


										Type:


									</label>
									<div class="controls">
										<SELECT id="sondage_typeM" name="sondage_typeM" required="required">
											<OPTION VALUE="0">Public</OPTION>
											<OPTION VALUE="1">Public Inscrit</OPTION>
											<OPTION VALUE="2">Privé</OPTION>
											<OPTION VALUE="3">Privé Groupe</OPTION>
										</SELECT>
										<small id="checkTypeSondageM"></small>
									</div>
								</div>

								<!--Groupe sondage -->
								<div class="control-group" id="groupeSondageListeM" style="display:none;">
									<label class="control-label" for="sondage_groupe">


										Groupe:


									</label>
									<div class="controls" >
										<SELECT id="sondage_groupeM" name="sondage_groupeM">
											<OPTION VALUE="-1"></OPTION>
											<?php foreach ($groupes as $groupe): ?>
												<OPTION VALUE=<?php echo "".$groupe['groupe_id'];?>><?php echo $groupe['groupe_nom'];?></OPTION>
											<?php endforeach; ?>
										</SELECT>
										<small id="checkGroupeSondageM"></small>
									</div>
								</div>

								<!--type sondage -->
								<div class="control-group">
									<label class="control-label" for="sondage_typeMethodeM">


										Type Mythode par default:


									</label>
									<div class="controls">
										<SELECT id="sondage_typeMethodeM" name="sondage_typeMethodeM" required="required">
											<OPTION VALUE="0">Borda</OPTION>
											<OPTION VALUE="1">Condorcet</OPTION>
											<OPTION VALUE="2">Vote Alternatif</OPTION>
										</SELECT>
										<small id="checkTypeSondageM"></small>
									</div>
								</div>


								<div class="control-group">
									<label class="control-label" for="sondage_finM">


										Date Fin:


									</label>
									<div class="controls">
										<input id="sondage_finM" type="text" placeholder ="aaaa-mm-jj" value=<?php echo "".$sondage[0]['date_fin']; ?> name="sondage_fin" required="required"></input>
										<br></br>
										<small id="checkDateFin_sM"></small>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="sondage_visi">


										Visibilité vote utilisateur:


									</label>
									<div class="controls">
										<SELECT id="sondage_visiM" name="sondage_visiM">
											<OPTION VALUE="0">Secret</OPTION>
											<OPTION VALUE="1">Secret durant Scrutin</OPTION>
											<OPTION VALUE="2">Non Secret</OPTION>
										</SELECT>
										<small id="checkVisiSondageM"></small>
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


	$("#sondage_typeM").change(function(){
		if($(this).val()=="3")
			{$("#groupeSondageListeM").fadeIn(400);}
		else
			{$("#groupeSondageListeM").fadeOut(400);}
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




	$("#sondage_finM").keyup(function()
	{
		if(checkDate($(this).val()) == 0)
		{
			$("#checkDateFin_sM").css("color","red").html("Date Invalide (aaaa-mm-jj)");
		}
		else if(checkDate($(this).val()) == 2)
			$("#checkDateFin_sM").html('<img src="../public/images/check.png" class="small_image" alt="" /><p class="text_ok">Date Valide</p>');
		else
			$("#checkDateFin_sM").css("color","red").html("Date doit etre superieur a aujourd'hui");
	});








	// FONCTION DE VERIFiCATION DU FORMULAIRE AVANT ENVOI


		///// DERNIERE VERIFICATION AVANT DE SUBMIT LE FORMULAIRE ////

		$("#modifSondage").submit(function(){
			// on definit nos variables

			var status = $(".checkSubmit");
			var nom = $("#sondage_titreM").val();
			var desc = $("#sondage_descM").val();
			var type= $("#sondage_typeM").val();
			var typeMethode= $("#sondage_typeMethodeM").val();
			var datefin = $("#sondage_finM").val();
			var visi = $("#sondage_visiM").val();
			var groupe = $("#sondage_groupeM").val();


			//on teste si les Champs sont vides
			if(nom==""|| desc ==""|| type ==""||typeMethode==""|| datefin ==""|| visi =="")
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
					},
					beforeSend:function()
					{
						$("#registerbtn").attr('value', 'Traitement en Cours....').fadeIn(1000);
					},
					success:function(result){
						if($.trim(result) != "UpdateSuccess"){
							status.html(result).fadeIn(400); // on fadeIn les echo renvoyer par la fonction inscription
							$("#registerbtn").attr('value','VALIDER');
						}
						else
						{
							//$("#table_connexion").replaceWith('<p>Vous venez d\'effectuer votre inscription sur Sondagax<br/>Un lien d\'activation de votre vient de vous etre envoyer</p>');
							//alert("VOus venez de modifier le sondage")
							$("#bloc_global").replaceWith('<div id="bloc_contents"><p style="text-align:center;color:red"> Modification effectuée avec succes</div>');
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