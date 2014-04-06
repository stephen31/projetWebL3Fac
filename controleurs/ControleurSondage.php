<?php
//session_start();
require_once "Controleur.php";
/*require_once ROOT.'/Vues/Vue.php';
require_once ROOT.'/Vues/VueConnecter.php';
require_once ROOT.'/Vues/VueNonConnecter.php';*/
require_once ROOT.'/models/Utilisateur.php';
require_once ROOT.'/models/Sondage.php';
//require_once ROOT.'/controleurs/ControleurUser.php';



class ControleurSondage extends Controleur
{
	private $sondage;

	public function __construct()
	{
		parent::__construct();
		$this->sondage=new Sondage(); 
	}



	public function afficherSondages()
	{
		//print_r($sondages);
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$id=$_SESSION['id'];
			$sondages=$this->sondage->getSondagesUserConnect($id);
			$this->vue = new VueConnecter("Sondages");
			$this->vue->generer(array("sondages"=>$sondages));
		}
		else
		{	
			$sondages=$this->sondage->getSondagesPublic();
			$vue = new VueNonConnecter("Sondages");
			$vue->generer(array("sondages"=>$sondages));
		}
	}

	public function afficherMesSondagesCres()
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$id=$_SESSION['id'];
			$sondages=$this->sondage->getSondagesCres($id);
			$this->vue = new VueConnecter("SondagesCres");
			$this->vue->generer(array("sondages"=>$sondages));
		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
		}
	}


	public function afficherMesSondagesRepondus()
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$id=$_SESSION['id'];
			$sondages=$this->sondage->getSondagesRepondus($id);
			$this->vue = new VueConnecter("SondagesRepondus");
			$this->vue->generer(array("sondages"=>$sondages));
		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
		}
	}

	public function afficherModifSondage($id_s)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			//$sondageInstance = new Sondage($id_s);
			$this->sondage=new Sondage($id_s);
			//$this->sondage->setSondageId($id_s);
			$sondageInfos = $this->sondage->getInfosSondage($id_s); // on recupere les infos du sondage
			$groupes=$this->sondage->getGroupe($_SESSION['id']); // on recupere les groupes crees par lutilisateur
			$id=$_SESSION['id'];

			$admin =$this->sondage->checkSondageAdmin($id_s,$id); // on check s'il est admin du sondage (c.a.d) que c'est lui qui l'a cree
			if($admin == true)
			{
				$this->vue = new VueConnecter("ModifSondage");
				$this->vue->generer(array("sondage"=>$sondageInfos,"groupes"=>$groupes));
			}
			else
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
			}

		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
		}
	}

	public function afficherAjoutVotantSondage($id_s)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			//$sondageInstance = new Sondage($id_s);
			//$this->sondage=new Sondage($id_s);
			$this->sondage->setSondageId($id_s);
			$sondageInfos = $this->sondage->getInfosSondage($id_s); // on recupere les infos du sondage
			//$groupes=$this->sondage->getGroupe($_SESSION['id']); // on recupere les groupes crees par lutilisateur
			$id=$_SESSION['id'];

			$admin =$this->sondage->checkSondageAdmin($id_s,$id); // on check s'il est admin du sondage (c.a.d) que c'est lui qui l'a cree
			$isPrivate = $this->sondage->checkSondagePrivate($id_s);
			if($admin == true && $isPrivate == true)
			{
				$this->vue = new VueConnecter("AjoutVotant");
				$this->vue->generer(array("sondage"=>$sondageInfos));
			}
			else
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
			}

		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
		}
	}


	public function afficherRetraitVotantSondage($id_s)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			//$sondageInstance = new Sondage($id_s);
			//$this->sondage=new Sondage($id_s);
			$this->sondage->setSondageId($id_s);
			$sondageInfos = $this->sondage->getInfosSondage($id_s); // on recupere les infos du sondage
			//$groupes=$this->sondage->getGroupe($_SESSION['id']); // on recupere les groupes crees par lutilisateur
			$id=$_SESSION['id'];

			$admin =$this->sondage->checkSondageAdmin($id_s,$id); // on check s'il est admin du sondage (c.a.d) que c'est lui qui l'a cree
			$isPrivate = $this->sondage->checkSondagePrivate($id_s);
			$infosUser = $this->sondage->getUserInfosSondagePrive($id_s);
			//print_r($infosUser);
			if($admin == true && $isPrivate == true)
			{
				$this->vue = new VueConnecter("RetraitVotant");
				$this->vue->generer(array("sondage"=>$sondageInfos,"infosUser"=>$infosUser));
			}
			else
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
			}

		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
		}
	}


	// affiche l'etat du sodnage

	public function afficherInfosSondage($id_s)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			//$sondageInstance = new Sondage($id_s);
			//$this->sondage=new Sondage($id_s);
			$this->sondage->setSondageId($id_s);
			$sondageInfos = $this->sondage->getInfosSondage($id_s); // on recupere les infos du sondage
			//$groupes=$this->sondage->getGroupe($_SESSION['id']); // on recupere les groupes crees par lutilisateur
			$id=$_SESSION['id'];

			$admin =$this->sondage->checkSondageAdmin($id_s,$id); // on check s'il est admin du sondage (c.a.d) que c'est lui qui l'a cree
			//$isAccessible = 
			$infosUser = $this->sondage->getUserInfosSondagePrive($id_s);
			//print_r($infosUser);
			if(1)
			{
				$this->vue = new VueConnecter("InfosSondage");
				$this->vue->generer(array("sondage"=>$sondageInfos,"infosUser"=>$infosUser));
			}
			else
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
			}

		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
		}
	}




	//fonction qui verifie si un pseudo peut etre ajouter a un sondage prive
	public function verifPseudoVotant($id_s)
	{
		if(isset($_SESSION['id']) && isset($_SESSION['email']) )
		{
			$user = new Utilisateur();
			$user->POSTToVar($_POST);// on echappe le code html des possible donnees recues et on initialise les attributs de l'instance avec les donnees!!
			if($user->is_dispo_pseudo($user->getPseudo()) == false) // si le pseudo est dispo 
			{
				if($this->sondage->checkPseudoVotant($user->getPseudo(),$id_s)==true)
				{
					//echo $this->sondage->getSondageId();
					echo "dispo";
					return 0;
				}
				else
				{
					echo "Cette personne a deja été ajouter a ce sondage!!";
					return 1;
				}
			}
			else
			{
				echo "pseudo inconnu";
				return 2;
			}
		}
		else
		{	
			echo ("Vous ne pouvez acceder a cette page");
			return 3;
		}

	}

	public function validerAjoutVotant($id_s)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->sondage->setSondageId($id_s);
			$sondageInfos = $this->sondage->getInfosSondage($id_s); // on recupere les infos du sondage
			//$groupes=$this->sondage->getGroupe($_SESSION['id']); // on recupere les groupes crees par lutilisateur
			$id=$_SESSION['id'];

			$admin =$this->sondage->checkSondageAdmin($id_s,$id); // on check s'il est admin du sondage (c.a.d) que c'est lui qui l'a cree
			$isPrivate = $this->sondage->checkSondagePrivate($id_s);
			if($admin == true && $isPrivate == true)
			{
				$user = new Utilisateur();
				$user->POSTToVar($_POST);// on echappe le code html des possible donnees recues et on initialise les attributs de l'instance avec les donnees!!
				if($user->getPseudo()=="")
				{
					echo "Veuillez precisez le pseudo";
					exit();
				}
				else if($res=($this->verifPseudoVotant($id_s))==1)
				{
					//echo "Cette personne a deja été ajouter a ce sondage!!";
					exit();
				}
				else if($res=($this->verifPseudoVotant($id_s))==2)
				{
					//echo "pseudo inconnu";
					exit();
				}
				else if($res=($this->verifPseudoVotant($id_s))==3)
				{
					//echo ("Vous ne pouvez acceder a cette page");
					exit();
				}
				else // pas d'erreur on peut inserer en base
				{
					$info = $user->getInfosUser2($user->getPseudo()); // recupere els infos par rapport au pseudo
					$resultatAddVotant = $this->sondage->addVotant($info['ut_id']);
					if($resultatAddVotant)
					{
						echo "UpdateSuccess";
						exit();
					}
					else
					{
						echo "Erreur Ajout Votant";
						exit();
					}
				}
			}
			else
			{
				echo ("Vous ne pouvez acceder a cette page");
				exit();
			}

		}
		else
		{	
			echo ("Vous ne pouvez acceder a cette page");
			exit();
		}
	}

	public function validerRetraitVotant($id_s,$ut_id)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->sondage->setSondageId($id_s);
			$sondageInfos = $this->sondage->getInfosSondage($id_s); // on recupere les infos du sondage
			//$groupes=$this->sondage->getGroupe($_SESSION['id']); // on recupere les groupes crees par lutilisateur
			$id=$_SESSION['id'];

			$admin =$this->sondage->checkSondageAdmin($id_s,$id); // on check s'il est admin du sondage (c.a.d) que c'est lui qui l'a cree
			$isPrivate = $this->sondage->checkSondagePrivate($id_s); // on verifie si le sondage est privé 
			if($admin == true && $isPrivate == true)
			{
				$user = new Utilisateur($ut_id);
				//echo $ut_id,$this->sondage->getSondageId();
				$resultatDeleteVotant = $this->sondage->deleteVotant($ut_id);
				if(!$resultatDeleteVotant)
				{
					$this->erreur("Erreur lors de la suppression");
				}
				Header('Location: '.ABSOLUTE_ROOT.'/controleurs/ControleurSondage.php?action=afficherRetraitVotantSondage&donnee='.$id_s);

			}
			else
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
			}

		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
		}
	}

	public function participerSondage($id_s)
	{
		$res=$this->sondage->getInfosSondage($id_s);
		
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			if(count($res)>0)
			{
			if($this->sondage->checkSondagePrivate($id_s))//si le sondage est prive
			{
				if($this->sondage->checkPseudoVotant($_SESSION['pseudo'],$id_s) && !$this->sondage->checkDejaVoter($_SESSION['id'],$id_s))//s'il a le droit de voter et qu'il n'a pas deja voter
				{
					$sondageInstance = new Sondage($id_s);
					$sondageInfos = $sondageInstance->getInfosSondage($id_s);

					$options = $this->sondage->getOptions($id_s);
					//print_r($options);
					$this->vue = new VueConnecter("ParticiperSondage");
					$this->vue->generer(array("options"=>$options,"sondage"=>$sondageInfos));
				}
				else
				{
					$this->erreur("Vous n'avez pas le droit de participer");
				}
			}
			
			else if($this->sondage->checkSondageGroupe($id_s))//si le sondage appartient a un groupe
			{
				if($this->sondage->checkAppartientGroupe($id_s,$_SESSION['id']) && !$this->sondage->checkDejaVoter($_SESSION['id'],$id_s))//tester qu'il est inscrit et qu'il n'a pas voter
				{
					$sondageInstance = new Sondage($id_s);
					$sondageInfos = $sondageInstance->getInfosSondage($id_s);

					$options = $this->sondage->getOptions($id_s);
					//print_r($options);
					$this->vue = new VueConnecter("ParticiperSondage");
					$this->vue->generer(array("options"=>$options,"sondage"=>$sondageInfos));
				}
				else
				{
					$this->erreur("Vous n'avez pas le droit de participer");
				}		
			}
			else if(!($this->sondage->checkDejaVoter($_SESSION['id'],$id_s)) && !isset($_COOKIE['sondage_id']))
			{
				$sondageInstance = new Sondage($id_s);
				$sondageInfos = $sondageInstance->getInfosSondage($id_s);

				$options = $this->sondage->getOptions($id_s);
				//print_r($options);
				$this->vue = new VueConnecter("ParticiperSondage");
				$this->vue->generer(array("options"=>$options,"sondage"=>$sondageInfos));
			}
			else //pas le droit d'acceder au vote
			{
				$this->erreur("Vous n'avez pas le droit de participer");
			}
			}
			else 
			{
				$this->erreur("cette page n'existe pas");
			}

		}
		else
		{
			if(count($res)>0)
			{
			if(!isset($_COOKIE[$id_s]) && !$this->sondage->checkSondageGroupe($id_s) && !$this->sondage->checkSondagePrivate($id_s))
			{
				$sondageInstance = new Sondage($id_s);
				$sondageInfos = $sondageInstance->getInfosSondage($id_s);

				$options = $this->sondage->getOptions($id_s);
				//print_r($options);
				$this->vue = new VueNonConnecter("ParticiperSondage");
				$this->vue->generer(array("options"=>$options,"sondage"=>$sondageInfos));
			}
			else 
			{
				$this->erreur("Vous avez deja participer");
			}
			}
			else 
			{
				$this->erreur("cettte page n'existe pas");
			}
		}
	}

	public function afficherCreerSondage()
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$groupes=$this->sondage->getGroupe($_SESSION['id']);
			$this->vue = new VueConnecter("CreerSondage");
			$this->vue->generer(array("groupes"=>$groupes));
			//$this->vue->generer(array());
			//$vue->generer(array("sondages"=>$sondages));
		}
		else
		{
			$this->erreur("Vous ne pouvez acceder a cette page");
		}
	}

	//validation du vote
	public function validerVoteSondage($id_s)
	{
		//print_r($_POST);
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email']))
		{
			if(!$this->sondage->checkDejaVoter($_SESSION['id'],$id_s))//tester qu'il n'a pas deja voté
			{
				$res=$this->sondage->addReponse($id_s,$_SESSION['id'],$_POST);
				if($res)
				{
					echo "UpdateSuccess";
					exit();
				}
				else
				{
					echo "erreur interne lors de la validation du vote ";
					exit();
				}
				//$sondages=$this->sondage->getSondagesUserConnectAccueuil($_SESSION['id']);
				
				/*$this->vue= new VueConnecter("Accueil");
				$this->vue->generer(array("sondages"=>$sondages));*/
			}
			else //pas le droit d'acceder de voter
			{
				$this->erreur("Vous n'avez pas le droit de participer");
			}
			
		}
		else
		{
			if(!isset($_COOKIE[$id_s]))
			{
				//setcookie($id_s, 'M@teo21', time() + 365*24*3600);

				$res=$this->sondage->addReponseAnonyme($id_s,$_POST);
				if($res)
				{
					setcookie($id_s, 'voter', time() + 365*24*3600, null, null, false, true);
					echo "UpdateSuccess";
					exit();
				}
				else
				{
					echo "erreur interne lors de la validation du vote ";
					exit();
				}
				/*$sondages=$this->sondage->getSondagesPublic();
				$this->vue= new VueNonConnecter("Accueil");
				$this->vue->generer(array("sondages"=>$sondages));*/
			}
			else
			{
				$this->erreur("Vous avez deja voté");
			}
		}
	
	}

	// Fonction de validation du formulaire et creation

	public function validerCreerSondage()
	{
		$this->sondage->POSTToVar($_POST); // on recupere tout les donneé de la variable globale POST , et on les set dans les attributs de l'instance sondage
		//print_r($this->sondage);
		// on verifie que les champs sont pas vide 

		$today = new DateTime();
		$todayString = $today->format('Y-m-d');

		if($this->sondage->getTitre() =="" || $this->sondage->getTexteDesc() =="" ||$this->sondage->getDateFin()==""|| $this->sondage->getOption1()=="" || $this->sondage->getOption2()=="")
		{
			echo " Veuillez remplir le formulaire ";
			exit();
		}
		else if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$this->sondage->getDateFin()) ==0)
		{
			echo "Date de fin invalide (aaaa-mm-jj) SVP";
			exit();
		}
		else if(strtotime($this->sondage->getDateFin()) < strtotime($todayString))
		{
			echo "La date doit etre superieur a celle d'aujourdhui";
			exit();
		}
		else // on cree le sondage et on ajoute les options
		{
			$this->sondage->setUtId($_SESSION['id']);

			$this->sondage->beginTransaction(); // demarre une transaction
			//echo $this->sondage->getUtId();
			/*echo $this->sondage->getSondageId();
			echo $this->sondage->getGroupeId();
			echo $this->sondage->getTitre();*/

			$resultatAddSondage = $this->sondage->addSondage(); // on ajoute le sondage en base
			//echo($resultatAddSondage);
			if($resultatAddSondage)
			{
				$this->sondage->setSondageId($resultatAddSondage);
			}
			else
			{
				$this->sondage->rollback(); // on annule la transaction
				echo "Erreur Ajout Sondage";
				exit();

			}
			$this->sondage->setSondageId($resultatAddSondage); // on set l'id du sondage ajouter en bd


			// ajout des options obligatoires


			if($this->sondage->addOption($this->sondage->getOption1()))
			{
				if($this->sondage->addOption($this->sondage->getOption2()) == false)
				{
					$this->sondage->rollback(); // on annule la transaction
					echo "Erreur Ajout Option 2";
					$this->sondage->setSondageId(-1);
					exit();
				}
			}
			else
			{
				$this->sondage->rollback(); // on annule la transaction
				echo "Erreur Ajout Option 1";
				$this->sondage->setSondageId(-1);
				exit();
			}

			// ajout des options optionnelles


			$res3;$res4;$res4;$res5;$res6;$res7;
			if($this->sondage->getOption3()!= "")
			{
				$res3 =$this->sondage->addOption($this->sondage->getOption3());
			}
			if($this->sondage->getOption4()!= "")
			{
				$res4 =$this->sondage->addOption($this->sondage->getOption4());
			}
			if($this->sondage->getOption5()!= "")
			{
				$res5 =$this->sondage->addOption($this->sondage->getOption5());
			}
			if($this->sondage->getOption6()!= "")
			{
				$res6 =$this->sondage->addOption($this->sondage->getOption6());
			}
			if($this->sondage->getOption7()!= "")
			{
				$res7 =$this->sondage->addOption($this->sondage->getOption7());
			}

			if((isset($res3) && $res3== false) || (isset($res4) && $res4 == false) || (isset($res5) && $res5 == false) || (isset($res6) && $res6 == false)|| (isset($res7) && $res7 == false))
			{
				$this->sondage->rollback(); // on annule la transaction
				echo $this->sondage->getOption3(), $res3,$res4,$res5,$res6,$res7;
				echo "Error";
				$this->sondage->setSondageId(-1);
				exit();
			}
			else
			{
				$this->sondage->commit(); // on valide la transaction
				echo "UpdateSuccess";
				exit();
			}
		}
	}



	/*********************************************/

	public function validerModifSondage($idS)
	{
		$admin =$this->sondage->checkSondageAdmin($idS,$_SESSION['id']); // Deuxieme verification : on check s'il est admin du sondage (c.a.d) que c'est lui qui l'a cree
		if($admin == true)
		{
			$this->sondage->POSTToVar($_POST); // on recupere tout les donneé de la variable globale POST , et on les set dans les attributs de l'instance sondage
			//print_r($this->sondage);
			// on verifie que les champs sont pas vide 

			$today = new DateTime();
			$todayString = $today->format('Y-m-d');

			if($this->sondage->getTitre() =="" || $this->sondage->getTexteDesc() =="" ||$this->sondage->getDateFin()=="")
			{
				echo " Veuillez remplir le formulaire ";
				exit();
			}
			else if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$this->sondage->getDateFin()) ==0)
			{
				echo "Date de fin invalide (aaaa-mm-jj) SVP";
				exit();
			}
			else if(strtotime($this->sondage->getDateFin()) < strtotime($todayString))
			{
				echo "La date doit etre superieur a celle d'aujourdhui";
				exit();
			}
			else // on cree le sondage et on ajoute les options
			{
				$this->sondage->setUtId($_SESSION['id']);
				$this->sondage->setSondageId($idS);
			//echo $this->sondage->getSondageId();

				$resultatUpdateSondage = $this->sondage->updateSondage(); // on ajoute le sondage en base
			//echo($resultatAddSondage);
				if($resultatUpdateSondage)
				{
					echo "UpdateSuccess";
					exit();
				}
				else
				{
					echo "Erreur Mise a jour Sondage";
					exit();

				}
			}
		}
		else
		{
			$this->erreur("Vous ne pouvez acceder a cette page");
		}
	}

}
?>	

<?php

		if(isset($_GET["action"])) // si action est pas vide
		{	
			$instance = new ControleurSondage();
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



