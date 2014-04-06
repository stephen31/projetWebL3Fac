<?php $this->titre="Participer au Sondage"; ?>

<section id="bloc_global">
	<table id="table_connexion">
		<tr>

			<td>

				<fieldset>
					<legend>
						<?php foreach($sondage as $s): ?>
							PARTICIPER AU SONDAGE : <?php echo "<span style='color:orange'>".$s['titre']."</span>"; ?>
						<?php endforeach; ?>
					</legend>
					<div class="form registration">
						<form id="voteSondage"  autocomplete="off" onsubmit="return false;" method="post" name="login" action="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=validerVoteSondage&donnee=".$s['sondage_id']; ?>">

							<?php foreach($options as $option): ?>
								<!--type sondage -->
								<div class="control-group">
									<label class="control-label" for=<?php echo "".$option['titre']; ?> >


										<?php echo $option['titre']?>:


									</label>
									<div class="controls">
										<SELECT id=<?php echo "".$option['titre']; ?> name=<?php echo "".$option['titre']; ?> required="required">
											<?php for($i=1;$i<=sizeof($options);$i++) 

											echo "<OPTION VALUE=".$i.">".$i."</OPTION>";
											?>
										</SELECT>
									</div>
								</div>
							<?php endforeach; ?>
							<!-- Verif-->
							<div class="control-group">
								<div class="checkSubmit">
									<br/>Faitez vos choix<br/><br/>
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

<script type="text/javascript">
//window.onload = function () // Javascript version 
$(document).ready(function(){
	//alert("chien");

	$("select").focus(function(){
		$(".checkSubmit").fadeOut(800);
	});


	$("#voteSondage").submit(function()
	{
		var status = $(".checkSubmit");
		$.ajax({
			type:"post",
			url:$(this).attr('action'),
			beforeSend:function()
			{
				$("#registerbtn").attr('value', 'Traitement en Cours....').fadeIn(1000);
			},
			success:function(result)
			{
				if($.trim(result) != "UpdateSuccess")
				{
					status.html(result).fadeIn(400); // on fadeIn les echo renvoyer par la fonction inscription
					$("#registerbtn").attr('value','VALIDER');
				}
				else
				{
					//$("#table_connexion").replaceWith('<p>Vous venez d\'effectuer votre inscription sur Sondagax<br/>Un lien d\'activation de votre vient de vous etre envoyer</p>');
					alert("Vous venez de voter");
					window.location = self.location;
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