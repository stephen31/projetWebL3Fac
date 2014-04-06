<?php $this->titre="Participer au Sondage"; ?>

<section id="bloc_global">
	<table id="table_connexion">
		<tr>

			<td>

				<fieldset>
					<legend>
					<?php foreach($sondage as $s): ?>
						PARTICIPER AU SONDAGE : <?php echo "<span style='color:orange'>".$s['titre']."</span>"; ?>
					
					</legend>
					<div class="form registration">
						<form id="voteSondage"  autocomplete="off" method="post" name="login" action="<?php echo ABSOLUTE_ROOT . "/controleurs/ControleurSondage.php?action=validerVoteSondage&donnee=".$s['sondage_id']; ?>">
					<?php endforeach; ?>
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