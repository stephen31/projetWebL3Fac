<?php

require_once(ROOT.'/Vues/Vue.php');

class vueNonConnecter extends Vue
{
	private $menu_not_usr;
	private $bloc_intro;

	public function __construct($action)
	{
		parent::__construct($action);
		$this->menu_not_usr = ROOT ."/Vues/vueMenuNoUsr.php" ;// menu utilisateur Non connecter
		$this->bloc_intro = ROOT ."/Vues/vueBlocIntro.php" ;
		$this->headinfos = ROOT ."/Vues/vueHeadinfosNonConnecter.php";

	}

	  // Génère et affiche la vue
	public function generer($donnees) 
	{
    // Génération de la partie spécifique de la vue
		$contenu = $this->genererFichier($this->fichier, $donnees); // generation du contenu
		$menu_not_usr = $this->genererFichier($this->menu_not_usr,$donnees); // generation du menu utilsiateur non connecter
		$bloc_intro = $this->genererFichier($this->bloc_intro,$donnees); // generation du menu utilsiateur non connecter
		$headinfos = $this->genererFichier($this->headinfos,$donnees); // generation de l'entete non connecter
    // Génération du gabarit commun utilisant la partie spécifique
		$vue = $this->genererFichier(ROOT.'/Vues/gabarit.php',
			array('titre' => $this->titre,'contenu' => $contenu,'menu_usr'=>$menu_not_usr,'bloc_intro'=>$bloc_intro,'headinfos'=>$headinfos));
    // Renvoi de la vue au navigateur
		echo $vue;
	}

}

?>