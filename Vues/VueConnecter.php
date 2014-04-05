<?php


require_once(ROOT.'/Vues/Vue.php');

class vueConnecter extends Vue
{
	private $menu_usr;

	public function __construct($action)
	{
		parent::__construct($action);
		$this->menu_usr = ROOT ."/Vues/vueMenuUsr.php"; // menu utilisateur connecter
		$this->headinfos = ROOT ."/Vues/vueHeadinfosConnecter.php";
	}

	  // Génère et affiche la vue
	public function generer($donnees) 
	{
    // Génération de la partie spécifique de la vue
		$contenu = $this->genererFichier($this->fichier, $donnees); // generation du contenu
		$menu_usr = $this->genererFichier($this->menu_usr,$donnees); // generation du menu utilsiateur connecter
		$headinfos = $this->genererFichier($this->headinfos,$donnees); // generation du bouton header1 
    // Génération du gabarit commun utilisant la partie spécifique
		$vue = $this->genererFichier(ROOT.'/Vues/gabarit.php',
			array('titre' => $this->titre,'bloc_intro' => '','contenu' => $contenu,'menu_usr'=>$menu_usr,'headinfos'=>$headinfos));
    // Renvoi de la vue au navigateur
		echo $vue;
	}

}

?>