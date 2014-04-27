<?php
//session_start();
require_once "Controleur.php";
/*require_once ROOT.'/Vues/Vue.php';
require_once ROOT.'/Vues/VueConnecter.php';
require_once ROOT.'/Vues/VueNonConnecter.php';*/
require_once ROOT.'/models/Utilisateur.php';
require_once ROOT.'/models/Sondage.php';
require_once ROOT.'/models/Groupe.php';
require_once ROOT.'/models/Commentaire.php';
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
			//print_r($sondages);
			$this->vue = new VueConnecter("SondagesCres");
			$this->vue->generer(array("sondages"=>$sondages));
		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
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
			exit();
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
			$moderateur = $this->sondage->checkIsModerateur($id); // moderateur ?
			if($admin == true || $moderateur == true)
			{
				$this->vue = new VueConnecter("ModifSondage");
				$this->vue->generer(array("sondage"=>$sondageInfos,"groupes"=>$groupes));
			}
			else
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
				exit();
			}

		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
		}
	}

	public function afficherAjoutModerateurSondage($id_s)
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
			//$noModerator = $this->sondage->checkHaveModerateur($id_s); // on check s'il le sondage a deja un moderateur
			if($admin == true)
			{
				$this->vue = new VueConnecter("AjoutModerateur");
				$this->vue->generer(array("sondage"=>$sondageInfos));
			}
			else
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
				exit();
			}

		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
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
			$moderateur = $this->sondage->checkIsModerateur($id);
			if(($admin == true && $isPrivate == true) && ($moderateur == true && $isPrivate == true)) 
			{
				$this->vue = new VueConnecter("AjoutVotant");
				$this->vue->generer(array("sondage"=>$sondageInfos));
			}
			else
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
				exit();
			}

		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
		}
	}

	// methdoe de retrait de votant
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
			$moderateur = $this->sondage->checkIsModerateur($id);
			if(($admin == true && $isPrivate == true) && ($moderateur == true && $isPrivate == true)) 
			{
				$this->vue = new VueConnecter("RetraitVotant");
				$this->vue->generer(array("sondage"=>$sondageInfos,"infosUser"=>$infosUser));
			}
			else
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
				exit();;
			}

		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
		}
	}


	// methdoe de retrait de Moderateur
	public function afficherRetraitModerateur($id_s)
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
			//$isPrivate = $this->sondage->checkSondagePrivate($id_s);
			$infosModerateurs = $this->sondage->getUserInfosModerateurSondage($id_s);
			//print_r($infosModerateurs);
			if($admin == true)
			{
				$this->vue = new VueConnecter("RetraitModerateur");
				$this->vue->generer(array("sondage"=>$sondageInfos,"infosUser"=>$infosModerateurs ));
			}
			else
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
				exit();
			}

		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
		}
	}


	// affiche l'etat du sodnage

	public function afficherInfosSondage($id_s)
	{
		$resBorda=$this->sondage->borda($id_s);
		$resCondorcet=$this->sondage->condorcet($id_s);
		$checkGagnant=$this->sondage->checkGagnant($resCondorcet);
		
		$tab=array(array());
		$nbtour=1;
		$resAlternative=$this->sondage->alternative($id_s,$tab,$nbtour);
		
		$IdutDejaVote=$this->sondage->getIdVote($id_s);
		$id_vote=$this->sondage->getVoteNonConnect($id_s);
		$ensReponses=$this->sondage->getReponses($id_s);
		$ensReponsesAnonymes=$this->sondage->getReponsesAnnonymes($id_s);
		//"ensIdUt"=>$IdutDejaVote,"ensIdVote"=>$IdutDejaVote,"reponses"=>$ensReponses,"reponsesanonymes"=>$ensReponsesAnonymes
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			//$sondageInstance = new Sondage($id_s);
			//$this->sondage=new Sondage($id_s);
			$this->sondage->setSondageId($id_s);
			$sondageInfos = $this->sondage->getInfosSondage($id_s); // on recupere les infos du sondage
			$optionsGroupe = $this->sondage->getOptions($id_s); // on recupere les options du sondage

			$id=$_SESSION['id'];


			$admin =$this->sondage->checkSondageAdmin($id_s,$id); // on check s'il est admin du sondage (c.a.d) que c'est lui qui l'a cree
			$isModerateur=$this->sondage->checkIsModerateur($id);

			$isPrivate = $this->sondage->checkSondagePrivate($id_s); // on check si le sondage est privee

			$isInSondagePrivate = $this->sondage->checkDroitAccesSondagePrivee($_SESSION['id']);
			$isSondageGroupe = $this->sondage->checkSondageGroupe($id_s);
			$isInGroupe = $this->sondage->checkAppartientGroupe($id_s,$id);


			//echo ($sondageInfos[0]['groupe_id']);
			$groupeInstance = new Groupe($sondageInfos[0]['groupe_id']);
			$allComments = $this->sondage->getAllCommentaire();
			$allSousCommentaire = $this->sondage->getAllSousCommentaire();
			$infosGroupe = $groupeInstance->getInfosGroupe($sondageInfos[0]['groupe_id']); // on recupere les infos du groupe du sondage
			/*print_r($infosGroupe);
			print_r($sondageInfos);
			print_r($allComments);
			print_r($allSousCommentaire);*/

			if($admin==true)
			{
				$this->vue = new VueConnecter("InfosSondage");

				$this->vue->generer(array("sondage"=>$sondageInfos,"groupe"=>$infosGroupe,"options"=>$optionsGroupe,"comments"=>$allComments,"Souscomments"=>$allSousCommentaire,"borda"=>$resBorda,"condorcet"=>$resCondorcet,"gagnant"=>$checkGagnant,"alternative"=>$resAlternative,"tableau"=>$tab,"nombreTour"=>$nbtour,"isAdmin"=>$admin,"isModerateur"=>$isModerateur,"ensIdUt"=>$IdutDejaVote,"ensIdVote"=>$id_vote,"reponses"=>$ensReponses,"reponsesanonymes"=>$ensReponsesAnonymes));

			}
			else
			{
				if($isPrivate == true)
				{
					if($isInSondagePrivate == true)
					{
						$this->vue = new VueConnecter("InfosSondage");
						$this->vue->generer(array("sondage"=>$sondageInfos,"groupe"=>$infosGroupe,"options"=>$optionsGroupe,"comments"=>$allComments,"Souscomments"=>$allSousCommentaire,"borda"=>$resBorda,"condorcet"=>$resCondorcet,"gagnant"=>$checkGagnant,"alternative"=>$resAlternative,"tableau"=>$tab,"nombreTour"=>$nbtour,"isAdmin"=>$admin,"isModerateur"=>$isModerateur,"ensIdUt"=>$IdutDejaVote,"ensIdVote"=>$id_vote,"reponses"=>$ensReponses,"reponsesanonymes"=>$ensReponsesAnonymes));
					}
					else
					{
						$this->erreur("Vous ne pouvez acceder a cette page");
						exit();
					}

				}
				else if($isSondageGroupe == true)
				{
					if($isInGroupe == true)
					{
						$this->vue = new VueConnecter("InfosSondage");

						$this->vue->generer(array("sondage"=>$sondageInfos,"groupe"=>$infosGroupe,"options"=>$optionsGroupe,"comments"=>$allComments,"Souscomments"=>$allSousCommentaire,"borda"=>$resBorda,"condorcet"=>$resCondorcet,"gagnant"=>$checkGagnant,"alternative"=>$resAlternative,"tableau"=>$tab,"nombreTour"=>$nbtour,"isAdmin"=>$admin,"isModerateur"=>$isModerateur,"ensIdUt"=>$IdutDejaVote,"ensIdVote"=>$id_vote,"reponses"=>$ensReponses,"reponsesanonymes"=>$ensReponsesAnonymes));

					}
					else
					{
						$this->erreur("Vous ne pouvez acceder a cette page");
						exit();
					}
				}
				else
				{
					$this->vue = new VueConnecter("InfosSondage");

					$this->vue->generer(array("sondage"=>$sondageInfos,"groupe"=>$infosGroupe,"options"=>$optionsGroupe,"comments"=>$allComments,"Souscomments"=>$allSousCommentaire,"borda"=>$resBorda,"condorcet"=>$resCondorcet,"gagnant"=>$checkGagnant,"alternative"=>$resAlternative,"tableau"=>$tab,"nombreTour"=>$nbtour,"isAdmin"=>$admin,"isModerateur"=>$isModerateur,"ensIdUt"=>$IdutDejaVote,"ensIdVote"=>$id_vote,"reponses"=>$ensReponses,"reponsesanonymes"=>$ensReponsesAnonymes));

				}
				
			}

		}
		else
		{	
			if($this->sondage->checkPublic($id_s) == true)
			{
				$sondageInfos = $this->sondage->getInfosSondage($id_s); // on recupere les infos du sondage
				$optionsGroupe = $this->sondage->getOptions($id_s); // on recupere les options du sondage
				$groupeInstance = new Groupe($sondageInfos[0]['groupe_id']);
				$allComments = $this->sondage->getAllCommentaire();
				$allSousCommentaire = $this->sondage->getAllSousCommentaire();
				$infosGroupe = $groupeInstance->getInfosGroupe($sondageInfos[0]['groupe_id']); // on recupere les infos du groupe du sondage
				$this->vue = new VueNonConnecter("InfosSondage");

				$this->vue->generer(array("sondage"=>$sondageInfos,"groupe"=>$infosGroupe,"options"=>$optionsGroupe,"comments"=>$allComments,"borda"=>$resBorda,"condorcet"=>$resCondorcet,"gagnant"=>$checkGagnant,"alternative"=>$resAlternative,"tableau"=>$tab,"nombreTour"=>$nbtour,"ensIdUt"=>$IdutDejaVote,"ensIdVote"=>$id_vote,"reponses"=>$ensReponses,"reponsesanonymes"=>$ensReponsesAnonymes));
			}
			else
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
				exit();
			}

		}
	}
	//fonction qui verifie si un pseudo peut etre ajouter a un sondage prive
	public function verifPseudoVotant($id_s)
	{
		if(isset($_SESSION['id']) && isset($_SESSION['email']) )
		{
			$user = new Utilisateur();
			$user->POSTToVar($_POST);// on echappe le code html des possible donnees recues et on initialise les attributs de l'instance avec les donnees!!
			//print_r($user->getPseudo());
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

	//fonction qui verifie si un pseudo peut etre ajouter a un sondage prive
	public function verifPseudoModerateur($id_s)
	{
		if(isset($_SESSION['id']) && isset($_SESSION['email']) )
		{
			$user = new Utilisateur();
			$user->POSTToVar($_POST);// on echappe le code html des possible donnees recues et on initialise les attributs de l'instance avec les donnees!!
			$this->sondage->setSondageId($id_s);
			if($user->is_dispo_pseudo($user->getPseudo()) == false) // si le pseudo est dispo 
			{
				$infosUser = $user->getInfosUser2($user->getPseudo()); // on recupere els infos du nom envoyer
				if($this->sondage->checkIsModerateur($infosUser['ut_id'])==false  && $this->sondage->checkSondageAdmin($id_s,$infosUser['ut_id']) == false)
				{
					//echo $this->sondage->getSondageId();
					echo "dispo";
					return 0;
				}
				else
				{
					echo "Cette personne est déja moderateur de ce sondage!!";
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

	public function validerAjoutModerateur($id_s)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->sondage->setSondageId($id_s);
			$sondageInfos = $this->sondage->getInfosSondage($id_s); // on recupere les infos du sondage
			//$groupes=$this->sondage->getGroupe($_SESSION['id']); // on recupere les groupes crees par lutilisateur
			$id=$_SESSION['id'];

			$admin =$this->sondage->checkSondageAdmin($id_s,$id); // on check s'il est admin du sondage (c.a.d) que c'est lui qui l'a cree
			//$noModerator = $this->sondage->checkHaveModerateur($id_s); // on check s'il le sondage a deja un moderateur
			if($admin == true)
			{
				$user = new Utilisateur();
				$user->POSTToVar($_POST);// on echappe le code html des possible donnees recues et on initialise les attributs de l'instance avec les donnees!!
				if($user->getPseudo()=="")
				{
					echo "Veuillez precisez le pseudo";
					exit();
				}
				else if($res=($this->verifPseudoModerateur($id_s))==1)
				{
					//echo "Cette personne a deja été ajouter a ce sondage!!";
					exit();
				}
				else if($res=($this->verifPseudoModerateur($id_s))==2)
				{
					//echo "pseudo inconnu";
					exit();
				}
				else if($res=($this->verifPseudoModerateur($id_s))==3)
				{
					//echo ("Vous ne pouvez acceder a cette page");
					exit();
				}
				else // pas d'erreur on peut inserer en base
				{
					$info = $user->getInfosUser2($user->getPseudo()); // recupere els infos par rapport au pseudo
					$resultatAddModerateur = $this->sondage->addModerateur($info['ut_id']);
					if($resultatAddModerateur)
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





	//methode de validation d'ajout d'un moderateur a un sondage
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
			$moderateur = $this->sondage->checkIsModerateur($id);
			if(($admin == true && $isPrivate == true) && ($moderateur == true && $isPrivate == true)) 
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
			$moderateur = $this->sondage->checkIsModerateur($id);
			if(($admin == true && $isPrivate == true) && ($moderateur == true && $isPrivate == true)) 
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
				exit();
			}

		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
		}
	}

	public function validerRetraitModerateur($id_s,$ut_id)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->sondage->setSondageId($id_s);
			$sondageInfos = $this->sondage->getInfosSondage($id_s); // on recupere les infos du sondage
			//$groupes=$this->sondage->getGroupe($_SESSION['id']); // on recupere les groupes crees par lutilisateur
			$id=$_SESSION['id'];

			$admin =$this->sondage->checkSondageAdmin($id_s,$id); // on check s'il est admin du sondage (c.a.d) que c'est lui qui l'a cree
			if($admin == true)
			{
				$user = new Utilisateur($ut_id);
				//echo $ut_id,$this->sondage->getSondageId();
				$resultatDeleteModerateur= $this->sondage->deleteModerateur($ut_id);
				if(!$resultatDeleteModerateur)
				{
					$this->erreur("Erreur lors de la suppression");
				}
				Header('Location: '.ABSOLUTE_ROOT.'/controleurs/ControleurSondage.php?action=afficherRetraitModerateur&donnee='.$id_s);

			}
			else
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
				exit();
			}

		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
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
						exit();
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
						exit();
					}		
				}
				else if(!($this->sondage->checkDejaVoter($_SESSION['id'],$id_s)) && !isset($_COOKIE['sondage_id']))
				{
					$sondageInstance = new Sondage($id_s);
					$sondageInfos = $sondageInstance->getInfosSondage($id_s);
					$options = $this->sondage->getOptions($id_s);
					$this->vue = new VueConnecter("ParticiperSondage");
					$this->vue->generer(array("options"=>$options,"sondage"=>$sondageInfos));
				}
				else //pas le droit d'acceder au vote
				{
					$this->erreur("Vous n'avez pas le droit de participer");
					exit();
				}
			}
			else 
			{
				$this->erreur("cette page n'existe pas");
				exit();
			}

		}
		else
		{
			if(count($res)>0)
			{
				if($this->sondage->checkSondageGroupe($id_s) || $this->sondage->checkSondagePrivate($id_s) || !$this->sondage->checkPublic($id_s))
				{
					$this->erreur("Vous ne pouvez pas participer");
					exit();
				}
				else if(!isset($_COOKIE[$id_s]))
				{
					$sondageInstance = new Sondage($id_s);
					$sondageInfos = $sondageInstance->getInfosSondage($id_s);

					$options = $this->sondage->getOptions($id_s);
					$this->vue = new VueNonConnecter("ParticiperSondage");
					$this->vue->generer(array("options"=>$options,"sondage"=>$sondageInfos));
				}
				else 
				{
					$this->erreur("Vous avez deja participer");
					exit();
				}
			}
			else 
			{
				$this->erreur("cettte page n'existe pas");
				exit();
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
			exit();
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
				exit();
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
				exit();
			}
		}

	}
	public function afficherSondagesFinis()
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email']))
		{
			$id=$_SESSION['id'];
			$sondages=$this->sondage->getSondagesFinisConnect($id);
			$this->vue = new VueConnecter("SondagesFinis");
			$this->vue->generer(array("sondages"=>$sondages));
		}
		else
		{	
			$sondages=$this->sondage->getSondagesFinisNonConnect();
			$vue = new VueNonConnecter("SondagesFinis");
			$vue->generer(array("sondages"=>$sondages));
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
			exit();
		}
	}



	/* ajout d'un commentaire */

	public function validerAjoutCommentaire($idS)
	{
		$res=$this->sondage->getInfosSondage($idS);
		if($res>0)
		{
			if(isset($_SESSION['pseudo']) && isset($_SESSION['email']))
			{

				$comInstance = new Commentaire();
				$comInstance->POSTToVar($_POST);
				// on verifie si le commentaire contient du texte
				if($comInstance->getTexte()=="")
				{
					echo " veuillez remplir le champ commentaire";
					exit();
				}

				else
				{

					$comInstance->setSondageId($idS);
					$comInstance->setUtId($_SESSION['id']);
					$idCom = $comInstance->addCommentaire();
					if($idCom)
					{
						echo "success";
						exit();
					}
					else
					{
						echo "veuillez revalider votre commentaire , une erreur est survenue";
						exit();
					}
				}
			}
			else
			{
				echo "Vous devez etre connecter pour poster des commentaires";
				exit();
			}
		}
		else
		{
			$this->erreur("cette page n'existe pas");
			exit();
		}
	}


	/* ajout d'un Sous commentaire */

	public function validerAjoutSousCommentaire($idS)
	{
		$res=$this->sondage->getInfosSondage($idS);
		$comInstance = new Commentaire();
		$res2 = $comInstance->getInfosCommentaire($_POST['com_parent_id']); 
		if($res>0  && $res2 >0)
		{
			if(isset($_SESSION['pseudo']) && isset($_SESSION['email']))
			{
				$comInstance->POSTToVar($_POST);
				$comInstance->setSondageId($idS);
				$comInstance->setUtId($_SESSION['id']);
			// on verifie si le commentaire contient du texte
				if($comInstance->getTexte()=="")
				{
					echo " veuillez remplir le champ commentaire";
					exit();
				}

				else
				{
					$comInstance->setSondageId($idS);
					$idCom = $comInstance->addSousCommentaire();
					if($idCom)
					{
						echo "success";
						exit();
					}
					else
					{
						echo "veuillez revalider votre commentaire , une erreur est survenue";
						exit();
					}
				}
			}
			else
			{
				echo "Vous devez etre connecter pour poster des commentaires";
				exit();
			}
		}
		else
		{
			$this->erreur("cette page n'existe pas");
			exit();
		}
	}




	/* ajout d'un Soutient */

	public function validerAjoutSoutien($idS)
	{
		$res=$this->sondage->getInfosSondage($idS);
		$comInstance = new Commentaire();
		$res2 = $comInstance->getInfosCommentaire(intval($_POST['com_id']));

		if($res>0  && $res2 >0)
		{
			if(isset($_SESSION['pseudo']) && isset($_SESSION['email']))
			{
				//echo $comInstance->getComId();

				$comInstance->POSTToVar($_POST);
				$comInstance->setSondageId($idS);
				$comInstance->setUtId($_SESSION['id']);


				$res3 = $comInstance->checkDejaSoutenu($_SESSION['id']) ;
				if($res3==true)
				{
					echo " Vous avez deja aimé";
					exit();
				}
			// on verifie si le commentaire contient du texte
				if($comInstance->getSoutien()=="")
				{
					echo " Erreur lors de la prise en comtpe de votre soutien";
					exit();
				}

				else
				{

					$comInstance->setSondageId($idS);
					$rep = $comInstance->addSoutien($comInstance->getComId(),$_SESSION['id']);
					if($rep==true)
					{
						echo "success";
						exit();
					}
					else
					{
						echo "veuillez refaire votre soutient , une erreur est survenue";
						exit();
					}
				}
			}
			else
			{
				echo "Vous devez etre connecter pour soutenir";
				exit();
			}
		}
		else
		{
			$this->erreur("cette page n'existe pas");
			exit();
		}
	}




	public function supprimerCommentaire($id_s,$id_c)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->sondage->setSondageId($id_s);
			$sondageInfos = $this->sondage->getInfosSondage($id_s); // on recupere les infos du sondage
			//$groupes=$this->sondage->getGroupe($_SESSION['id']); // on recupere les groupes crees par lutilisateur
			$id=$_SESSION['id'];

			$admin =$this->sondage->checkSondageAdmin($id_s,$id); // on check s'il est admin du sondage (c.a.d) que c'est lui qui l'a cree
			$moderateur = $this->sondage->checkIsModerateur($id);
			if($admin == true || $moderateur == true )
			{
				$comInstance = new Commentaire();
				$comInstance->setSondageId($id_s);
				$comInstance->setUtId($_SESSION['id']);
				$resultatDeleteCom = $comInstance->deleteCommentaire($id_c);
				if(!$resultatDeleteCom)
				{
					$this->erreur("Erreur lors de la suppression");
				}
				Header('Location: '.ABSOLUTE_ROOT.'/controleurs/ControleurSondage.php?action=afficherInfosSondage&donnee='.$id_s);

			}
			else
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
				exit();
			}

		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
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
				exit();
			}
		}
		?>



