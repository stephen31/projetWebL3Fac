<?php

abstract class Vue
{

	protected $fichier; // nom fichier de la vue
	protected $titre; // le titre de la page;
	protected $headinfos; // le bouton inscription dans le cas de qquns non connecter / le pseudo dans le cas d'une personne connnecter
	public function __construct($action)
	{
		$this->fichier = ROOT . "/Vues/vue" . $action . ".php"; // nom du fichier a partir de l'action
	}


	abstract public function generer($donnees);
  // Génère un fichier vue et renvoie le résultat produit
	protected function genererFichier($fichier, $donnees) 
	{
		if (file_exists($fichier)) 
		{
      // Rend les éléments du tableau $donnees accessibles dans la vue
			extract($donnees);
      // Démarrage de la temporisation de sortie
			ob_start();
      // Inclut le fichier vue
      // Son résultat est placé dans le tampon de sortie
			require $fichier;
      // Arrêt de la temporisation et renvoi du tampon de sortie
			return ob_get_clean();
		}
		else 
		{
			throw new Exception("Fichier '$fichier' introuvable");
		}
	}
}

?>