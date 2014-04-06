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
										Type: <?php echo "".$sondage[0]['sondage_droit'];?>
								</div>

								<!--Option sondage -->
								<div class="control-group" id="groupeSondageListe" style="display:none;">
										Groupe: <?php echo $groupe['groupe_nom'];?></OPTION>
								</div>

								<!--type Methode-->
								<div class="control-group">
										Type Mythode:
										<?php
										$sondage[0]['type_methode'];
										$sondage[0]['type_methode'];
										$sondage[0]['type_methode'];
										$sondage[0]['type_methode'];
											switch($sondage[0]['type_methode'])
											{
												case O:
													echo " Borda";
													break;
												case 1:
													echo " Condorcet";
													break;
												case 2:
													echo " Vote Alternatif";
													break;
												default:
													echo "sait pas";
											}
										?>
								</div>


								<div class="control-group">
										Date Fin: <?php echo "".$sondage[0]['date_fin'];?>
								</div>

								<div class="control-group">
										Visibilité:
										<?php
											switch($sondage[0]['visibilite'])
											{
												case O:
													echo " Secret";
													break;
												case 1:
													echo " Secret durant Scrutin";
													break;
												case 2:
													echo " Non Secret";
													break;
											}
										?>
								</div>



								<!-- option 1 -->

								<div class="control-group">
										Option 1:
								</div>
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
							status.html(result).fadeIn(400); // on fadeIn les echo renvoyer par la fonction inscription
							$("#registerbtn").attr('value','VALIDER');
						}
						else
						{
							//$("#table_connexion").replaceWith('<p>Vous venez d\'effectuer votre inscription sur Sondagax<br/>Un lien d\'activation de votre vient de vous etre envoyer</p>');
							$("#bloc_global").replaceWith('<div id="bloc_contents"><p style="text-align:center;color:red"> Bravo Bravo Bravo </br> Vous venez de creer un sondage sur Sondagax</div>');
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