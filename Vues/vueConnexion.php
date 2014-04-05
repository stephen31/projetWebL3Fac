<section id="bloc_global">
	<table id="table_connexion">
		<tr>
			<td>

				<fieldset>
					<legend>

						CONNEXION

					</legend>
					<div class="form registration">
						<form name="login" action="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=connexion'; ?>" method="post">
							<input type="hidden" value="1" name="login"></input>
							<input type="hidden" value="login" name="a"></input>
							<div class="control-group">
								<label class="control-label" for="pseudo">

									Pseudo:

								</label>
								<div class="controls">
									<input id="pseudo" type="text" value="" required="required" autocomplete="off" placeholder="Pseudo" name="pseudo"></input>
									<span class="inline-message"></span>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="pass1">

									Mot de passe:

								</label>
								<div class="controls">
									<input id="pass1" type="password" required="required" placeholder="Password" name="pass1"></input>
								</div>
							</div>
							<div class="control-group">
								<div class="controls">
									<input class="btn2" type="submit" value="CONNEXION"></input>
								</div>
							</div>
							<div class="control-group">
								<div class="controls">
									<div>
										<a class="register-button" href="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=afficherInscription'; ?>">

											Enregistrez vous ici

										</a>
									</div>
									<br></br>
									<div>
										<a class="forgot-button" href="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=afficherMDPPerdu'; ?>">

											Mot de Passe Oublié?

										</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</fieldset>
				<div class="clear"></div>

			</td>
		</tr>
	</table>
</section>