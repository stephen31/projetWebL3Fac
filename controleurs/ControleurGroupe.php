<?php
//session_start();
require_once "Controleur.php";
/*require_once ROOT.'/Vues/Vue.php';
require_once ROOT.'/Vues/VueConnecter.php';
require_once ROOT.'/Vues/VueNonConnecter.php';*/
require_once ROOT.'/models/Utilisateur.php';
require_once ROOT.'/models/groupe.php';
require_once ROOT.'/models/Groupe.php';
//require_once ROOT.'/models/Commentaire.php';
//require_once ROOT.'/controleurs/ControleurUser.php';



class ControleurGroupe extends Controleur
{
	private $groupe;

	public function __construct()
	{
		parent::__construct();
		$this->groupe=new Groupe(); 
	} 

	/* afficher Groupes */
	public function afficherGroupes()
	{
		// si les variables de sessions sont definit on affiche la vue connecter
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) 
		{
			$id=$_SESSION['id'];
			$groupes=$this->groupe->getGroupePublic($id);
			$this->vue = new VueConnecter("Groupes");
			$this->vue->generer(array("groupes"=>$groupe));
		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
		}
	}

	public function afficherCreerGroupe()
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->vue = new VueConnecter("CreerGroupe");
			$this->vue->generer(array());
			//$this->vue->generer(array());
			//$vue->generer(array("groupes"=>$groupes));
		}
		else
		{
			$this->erreur("Vous ne pouvez acceder a cette page");
		}
	}

	public function verifNom()
	{
		$this->groupe->POSTToVar($_POST);

		$dispo = $this->groupe->is_dispo_groupe($this->groupe->getGroupeNom());
		if($dispo == false)
		{
			echo "Nom déja utilisé !<br />";
			return 0;
		}
		else
		{
			echo "success";
			return 1;
		}
	}

	// Fonction de validation du formulaire et creation

	public function validerCreerGroupe()
	{
		$this->groupe->POSTToVar($_POST);
		// on verifie que les champs sont pas vide 

		if($this->groupe->getGroupeNom() =="" || $this->groupe->getGroupeDesc() =="" ||$this->groupe->getGroupeDroit()=="")
		{
			echo " Veuillez remplir le formulaire ";
			exit();
		}
		else if($this->verifNom($this->groupe->getGroupeNom())==0)
		{
			exit();
		}
		else // on cree le groupe 
		{
			$this->groupe->setUtId($_SESSION['id']);

			$this->groupe->beginTransaction(); // demarre une transaction

			$resultatAddGroupe = $this->groupe->addGroupe();
			//echo($resultatAddgroupe);
			if($resultatAddGroupe)
			{
				$this->groupe->setGroupeId($resultatAddGroupe);
			}
			else
			{
				$this->groupe->rollback(); // on annule la transaction
				echo "Erreur Ajout Groupe";
				exit();

			}
			$this->groupe->setGroupeId($resultatAddGroupe);

			$resultAddInscrit=$this->groupe->addInscrit($this->groupe->getUtid());
			if($resultAddInscrit)
			{
				$this->groupe->commit(); // on valide la transaction
				echo "UpdateSuccess";
				exit();
			}
			else
			{
				$this->groupe->rollback(); // on annule la transaction
				echo "Erreur Ajout inscrit";
				$this->groupe->setGroupeId(-1);
				exit();
			}
		}
	}



























}


?>


<?php

		if(isset($_GET["action"])) // si action est pas vide
		{	
			$instance = new ControleurGroupe();
			if(method_exists($instance,$_GET["action"])) // on verifie que l'action / la methode existe
			{	
				if(isset($_GET["donnee"]))
				{
					if(isset($_GET["donnee2"]))
					{
						$instance->$_GET["action"]($_GET["donnee"],$_GET["donnee2"]);
					}
					else
					{
						$instance->$_GET["action"]($_GET["donnee"]);
					}
				}
				else
				{
					$instance->$_GET["action"]();
				}
			}
			else
			{
			//echo "KEKE PRO";
				$instance->erreur("Cette page n'existe pas");
			}
		}
		?>



