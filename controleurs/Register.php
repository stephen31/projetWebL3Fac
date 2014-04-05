<?php

	require_once('ControleurUser.php');
	$obj = new ControleurUser();
	if(isset($_POST['pseudo_check']))
	{
		$obj->verifPseudo();
	}
	if(isset($_POST['email_check']))
	{
		$obj->verifEmail();
	}


?>