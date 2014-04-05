<?php
session_start();

if (!defined('ROOT'))
	require_once("../config.php");
require_once ROOT.'/Vues/Vue.php';
require_once ROOT.'/Vues/VueConnecter.php';
require_once ROOT.'/Vues/VueNonConnecter.php';


class Controleur{

	private $vue;
	public function __construct()
	{
	}
	public function erreur($msgErreur) 
	{
		$this->vue = new VueNonConnecter("Erreur");
		$this->vue->generer(array("erreur"=>$msgErreur));
	}
}

?>
