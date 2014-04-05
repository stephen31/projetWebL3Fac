<li class="btn_session_inscription">
	<a href="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=afficherInscription'; ?>">Inscription</a>
</li>
<li class="btn_session_connexion">
	<a href="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=afficherConnexion'; ?>">Connexion</a>
	<div class="triangle"></div>
	<div class="login-box">
		<div class="form registration">
			<form name="login" action="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=connexion'; ?>" method="post">
				<div class="horizontal-row">
					<label class="control-label" for="pseudo">

						Pseudo:

					</label>
					<div class="controls">
						<input id="pseudo" type="text" value="" required="required" autocomplete="off" placeholder="Pseudo" name="pseudo"></input>
						<span class="inline-message"></span>
					</div>
				</div>
				<div class="horizontal-row">
					<label class="control-label" for="pass1">

						Mot de Passe:

					</label>
					<div class="controls">
						<input id="pass1" type="password" required="required" placeholder="Mot de Passe" name="pass1"></input>
					</div>
				</div>
				<div class="horizontal-row">
					<input class="btn2 black" type="submit" value="Connexion"></input>
				</div>
				<hr class="horizontal-hr"></hr>
				<div class="horizontal-row">
					<a class="btn2 forgot" href="<?php echo ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=afficherMDPPerdu'; ?>">

						Mot de passe Oublié?

					</a>
				</div>
			</form>
		</div>
	</div>
</li>