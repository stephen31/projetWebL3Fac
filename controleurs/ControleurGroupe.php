<?php
//session_start();
require_once "Controleur.php";
/*require_once ROOT.'/Vues/Vue.php';
require_once ROOT.'/Vues/VueConnecter.php';
require_once ROOT.'/Vues/VueNonConnecter.php';*/
require_once ROOT.'/models/Utilisateur.php';
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
			$groupes=$this->groupe->getGroupePublicAndPriveNotIn($id);
			$this->vue = new VueConnecter("Groupes");
			$this->vue->generer(array("groupes"=>$groupes));
		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
		}
	}

	/* afficher Groupes  CRees*/
	public function afficherMesGroupesCrees()
	{
		// si les variables de sessions sont definit on affiche la vue connecter
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) 
		{
			$id=$_SESSION['id'];
			$groupes=$this->groupe->getGroupesCrees($id);
			$this->vue = new VueConnecter("MesGroupesCrees");
			$this->vue->generer(array("groupes"=>$groupes));
		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
		}
	}

	/* afficher Groupes Actifs*/
	public function afficherMesGroupesActifs()
	{
		// si les variables de sessions sont definit on affiche la vue connecter
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) 
		{
			$id=$_SESSION['id'];
			$groupes=$this->groupe->getGroupesActifs($id);
			$this->vue = new VueConnecter("MesGroupesActifs");
			$this->vue->generer(array("groupes"=>$groupes));
		}
		else
		{	
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
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
			exit();
		}
	}


	public function afficherInfosGroupe($id_g)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->groupe->setGroupeId($id_g);
			$groupeInfos = $this->groupe->getInfosGroupe($id_g); // on recupere les infos du groupe
			$id=$_SESSION['id'];
			$admin =$this->groupe->checkGroupeAdmin($id); // on check s'il est admin du groupe (c.a.d) que c'est lui qui l'a cree
			$isPrivate = $this->groupe->checkGroupePrivate(); // on check si le sondage est privee		
			$isInGroupePrivate = $this->groupe->isInGroupePrivate($_SESSION['pseudo']);
			$infosSondage = $this->groupe->getAllSondagesGroupe();
			$createurGroupe = $this->groupe->getCreateurGroupe();
			$haveModerateur = $this->groupe->checkHaveModerateur();

			$UserInscrit = $this->groupe->getUserInscrit($id);
			$UserDemande = $this->groupe->getUserDemande();


			$isInGroupe =$this->groupe->checkIsInGroupe($id);
			$isInListeAttente =$this->groupe->checkIsInGroupeAttente($id);

			if(($isInGroupe==false && $isInListeAttente==false) || ($isInGroupe==false && $isInListeAttente==true))
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
				exit();

			}

			$isModerateur;
			$isAdmin;

			if($admin==true)
			{
				$isAdmin=1;
			}
			else
			{
				$isAdmin=0;
			}

			if($this->groupe->checkModerateur($id)==true)
			{
				$isModerateur=1;
			}
			else
			{
				$isModerateur=0;
			}

			echo $isModerateur;
			echo $isAdmin;
			/*print_r($infosGroupe);
			print_r($sondageInfos);
			print_r($allComments);
			print_r($allSousCommentaire);*/

			if($admin==true)
			{
				$this->vue = new VueConnecter("InfosGroupe");
				$this->vue->generer(array("groupe"=>$groupeInfos,"sondages"=>$infosSondage,"UserInscrit"=>$UserInscrit,"UserDemande"=>$UserDemande,
					"isModerateur"=>$isModerateur,"isAdmin"=>$isAdmin,"createur"=>$createurGroupe,"haveModerateur"=>$haveModerateur));
			}
			else
			{
				if($isPrivate == true)
				{
					if($isInGroupePrivate == true)
					{
						$this->vue = new VueConnecter("InfosGroupe");
						$this->vue->generer(array("groupe"=>$groupeInfos,"sondages"=>$infosSondage,"UserInscrit"=>$UserInscrit,"UserDemande"=>$UserDemande,
							"isModerateur"=>$isModerateur,"isAdmin"=>$isAdmin,"createur"=>$createurGroupe,"haveModerateur"=>$haveModerateur));
					}
					else
					{
						$this->erreur("Vous ne pouvez acceder a cette page");
						exit();
					}
				}
				else
				{
					$this->vue = new VueConnecter("InfosGroupe");
					$this->vue->generer(array("groupe"=>$groupeInfos,"sondages"=>$infosSondage,"UserInscrit"=>$UserInscrit,"UserDemande"=>$UserDemande,
						"isModerateur"=>$isModerateur,"isAdmin"=>$isAdmin,"createur"=>$createurGroupe,"haveModerateur"=>$haveModerateur));
				}
				
			}

		}
		else
		{
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
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

			$resultAddInscrit=$this->groupe->addInscrit2($this->groupe->getUtid());
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

	//S'iscrire a un groupe public //
	public function validerAjoutUserGroupe($id_g)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->groupe->setGroupeId($id_g);
			$id=$_SESSION['id'];
			$admin =$this->groupe->checkGroupeAdmin($id); // on check s'il est admin du groupe (c.a.d) que c'est lui qui l'a cree
			$isPrivate = $this->groupe->checkGroupePrivate(); // on check si le sondage est privee	
			$isPublicInscrit = $this->groupe->checkGroupePublicInscrit(); // on check si le sondage est public inscrit		
			$isModerateur=$this->groupe->checkModerateur($id);
			$isInGroupe =$this->groupe->checkIsInGroupe($id);

			if(($admin==false || $isModerateur==false) and ($isPrivate ==true || $isPublicInscrit == true))
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
				exit();
			}
			else if ($isInGroupe == true)
			{
				$this->erreur("Vous etes déja inscrit a ce groupe");
				exit();
			}
			else{
				$res = $this->groupe->addInscrit2($id);
				Header('Location: '.ABSOLUTE_ROOT.'/controleurs/ControleurGroupe.php?action=afficherInfosGroupe&donnee='.$id_g);
			}

		}
		else
		{
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
		}
	}


	//faire une demande a un groupe public inscrit//
	public function DemandeAjoutUserGroupe($id_g)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->groupe->setGroupeId($id_g);
			$id=$_SESSION['id'];
			$admin =$this->groupe->checkGroupeAdmin($id); // on check s'il est admin du groupe (c.a.d) que c'est lui qui l'a cree
			$isPrivate = $this->groupe->checkGroupePrivate(); // on check si le sondage est privee	
			$isPublic = $this->groupe->checkGroupePublic(); // on check si le sondage est public	
			$isModerateur=$this->groupe->checkModerateur($id);
			$isInGroupe =$this->groupe->checkIsInGroupe($id);
			$isInListeAttente =$this->groupe->checkIsInGroupeAttente($id);


			if(($admin==false || $isModerateur==false) and ($isPrivate ==true || $isPublic == true))
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
				exit();
			}
			else if ($isInGroupe == true)
			{
				$this->erreur("Vous etes deja dans ce groupe");
				exit();
			}
			else if ($isInListeAttente== true)
			{
				$this->erreur("Vous avez fait une demande pour integrer ce groupe ! Le moderateur ou l'admin valideront votre demande");
				exit();
			}
			else
			{
				$res = $this->groupe->addInscrit($id);
				$this->erreur("Vous Venez de faire une demande pour integrer le groupe");
				exit();
			}

		}
		else
		{
			$this->erreur("Vous ne pouvez acceder a cette page");
			exit();
		}
	}

	//valider une demande a un groupe public inscrit//
	public function validerDemandeUserGroupe($id_g,$idU)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->groupe->setGroupeId($id_g);
			$id=$_SESSION['id'];
			$admin =$this->groupe->checkGroupeAdmin($id); // on check s'il est admin du groupe (c.a.d) que c'est lui qui l'a cree
			$isPrivate = $this->groupe->checkGroupePrivate(); // on check si le sondage est privee	
			$isPublic = $this->groupe->checkGroupePublic(); // on check si le sondage est public	
			$isModerateur=$this->groupe->checkModerateur($id);
			$isInGroupe =$this->groupe->checkIsInGroupe($idU);


			if(($admin==false || $isModerateur==false) and ($isPrivate ==true || $isPublic == true))
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
				exit();
			}
			else if ($isInGroupe == true)
			{
				$this->erreur("cette utiliateur est déja inscrit a ce groupe");
				exit();
			}
			else
			{
				$res = $this->groupe->validationInscrit($idU);
				if($res)
				{
					Header('Location: '.ABSOLUTE_ROOT.'/controleurs/ControleurGroupe.php?action=afficherInfosGroupe&donnee='.$id_g);
					exit();
				}
				else
				{
					$this->erreur("Erreur lors de la valdiation de la demande");
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

	// inscrire un utilisateur a un groupe caché (privé)
	public function validerAjoutUserGroupePrive($id_g,$idU)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->groupe->setGroupeId($id_g);
			$id=$_SESSION['id'];
			$admin =$this->groupe->checkGroupeAdmin($id); // on check s'il est admin du groupe (c.a.d) que c'est lui qui l'a cree
			$isPublicInscrit = $this->groupe->checkGroupePublicInscrit(); // on check si le sondage est public inscrit
			$isPublic = $this->groupe->checkGroupePublic(); // on check si le sondage est public inscrit	
			$isPrivate = $this->groupe->checkGroupePrivate(); // on check si le sondage est privee		
			$isModerateur=$this->groupe->checkModerateur($id);
			$isInGroupe =$this->groupe->checkIsInGroupe($idU);


			if(($admin==false || $isModerateur==false) and ($isPublicInscrit==true || $isPublic == true || $isPrivate==true ))
			{
				$this->erreur("Vous ne pouvez acceder a cette page");
				exit();
			}
			else if ($isInGroupe == true)
			{
				$this->erreur("cette utiliateur est déja inscrit a ce groupe");
				exit();
			}
			else if($admin==true && $isPrivate == true)
			{
				$res = $this->groupe->addInscrit2($idU);
				exit();
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


	public function validerRetraitInscrit($id_g,$ut_id)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->groupe->setGroupeId($id_g);
			$id=$_SESSION['id'];

			$admin =$this->groupe->checkGroupeAdmin($id); // on check s'il est admin du groupe (c.a.d) que c'est lui qui l'a cree
			$isPublicInscrit = $this->groupe->checkGroupePublicInscrit(); // on check si le sondage est public inscrit
			$isPublic = $this->groupe->checkGroupePublic(); // on check si le sondage est public inscrit	
			$isPrivate = $this->groupe->checkGroupePrivate(); // on check si le sondage est privee		
			$isModerateur=$this->groupe->checkModerateur($id);
			$isInGroupe =$this->groupe->checkIsInGroupe($ut_id);

			if($ut_id == $id) // eviter quil se supprime s'il est admin ou moderateur
			{
				$this->erreur("Vous etes admin de ce groupe vous ne pouvez donc pas vous supprimer");
				exit();
			}
			if($this->groupe->checkGroupeAdmin($ut_id)==true && $isModerateur == true)
			{
				$this->erreur("Vous ne pouvez pas supprimer l'administrateur du groupe");
				exit();
			}
			if($this->groupe->checkModerateur($ut_id)==true && $isModerateur == true)
			{
				$this->erreur("Seul l'administratur a le droitd e retirer un moderateur");
				exit();
			}


			if(($admin == true || $isModerateur == true) && ($isPublicInscrit == true || $isPublic== true)) 
			{
				$resultatDeleteInscrit = $this->groupe->deleteInscrit($ut_id);
				if(!$resultatDeleteInscrit)
				{
					$this->erreur("Erreur lors de la suppression de l'inscrit");
				}
				Header('Location: '.ABSOLUTE_ROOT.'/controleurs/ControleurGroupe.php?action=afficherInfosGroupe&donnee='.$id_g);
				exit();

			}
			else if(($admin == true || $isModerateur == true) && ($isPrivate == true ))
			{
				$resultatDeleteInscrit = $this->groupe->deleteInscrit($ut_id);
				if(!$resultatDeleteInscrit)
				{
					$this->erreur("Erreur lors de la suppression de l'inscrit");
					exit();
				}
				Header('Location: '.ABSOLUTE_ROOT.'/controleurs/ControleurGroupe.php?action=afficherInfosGroupe&donnee='.$id_g);
				exit();
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


	public function afficherAjoutModerateurGroupe($id_g)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{

			$this->groupe->setGroupeId($id_g);
			$groupeInfos = $this->groupe->getInfosGroupe($id_g); // on recupere les infos du groupe
			$id=$_SESSION['id'];
			$admin =$this->groupe->checkGroupeAdmin($id); // on check s'il est admin du groupe (c.a.d) que c'est lui qui l'a cree
			if($admin == true)
			{
				$this->vue = new VueConnecter("AjoutModerateurGroupe");
				$this->vue->generer(array("groupe"=>$groupeInfos));
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


	// methdoe de retrait de Moderateur
	public function afficherRetraitModerateurGroupe($id_g)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{

			$this->groupe->setGroupeId($id_g);
			$groupeInfos = $this->groupe->getInfosGroupe($id_g); // on recupere les infos du groupe
			$id=$_SESSION['id'];
			$admin =$this->groupe->checkGroupeAdmin($id); // on check s'il est admin du groupe (c.a.d) que c'est lui qui l'a cree
			$infosModerateurs = $this->groupe->getUserInfosModerateurGroupe($id_g);
			//print_r($infosModerateurs);
			if($admin == true)
			{
				$this->vue = new VueConnecter("RetraitModerateurGroupe");
				$this->vue->generer(array("groupe"=>$groupeInfos,"infosUser"=>$infosModerateurs ));
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

	public function verifPseudoModerateurG($id_g)
	{
		if(isset($_SESSION['id']) && isset($_SESSION['email']) )
		{
			$user = new Utilisateur();
			$user->POSTToVar($_POST);// on echappe le code html des possible donnees recues et on initialise les attributs de l'instance avec les donnees!!
			$this->groupe->setGroupeId($id_g);

			$info = $user->getInfosUser2($user->getPseudo()); // recupere les infos par rapport au pseudo
			$isInGroupe =$this->groupe->checkIsInGroupe($info['ut_id']);
			$isInListeAttente =$this->groupe->checkIsInGroupeAttente($info['ut_id']);

			if(($isInGroupe==false && $isInListeAttente==false) || ($isInGroupe==false && $isInListeAttente==true))
			{
				echo "cette personne n'est pas dans le groupe";
				return 4;

			}

			if($user->is_dispo_pseudo($user->getPseudo()) == false) // si le pseudo est dispo 
			{
				$infosUser = $user->getInfosUser2($user->getPseudo()); // on recupere els infos du nom envoyer
				if($this->groupe->checkModerateur($infosUser['ut_id'])==false  && $this->groupe->checkGroupeAdmin($infosUser['ut_id']) == false)
				{
					//echo $this->sondage->getSondageId();
					echo "dispo";
					return 0;
				}
				else
				{
					echo "Cette personne est déja moderateur de ce Groupe!!";
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



	public function validerAjoutModerateurGroupe($id_g)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->groupe->setGroupeId($id_g);
			$groupeInfos = $this->groupe->getInfosGroupe($id_g); // on recupere les infos du groupe
			$id=$_SESSION['id'];
			$admin =$this->groupe->checkGroupeAdmin($id); // on check s'il est admin du groupe (c.a.d) que c'est lui qui l'a cree


			if($admin == true)
			{
				$user = new Utilisateur();
				$user->POSTToVar($_POST);// on echappe le code html des possible donnees recues et on initialise les attributs de l'instance avec les donnees!!
				if($user->getPseudo()=="")
				{
					echo "Veuillez precisez le pseudo";
					exit();
				}
				else if($res=($this->verifPseudoModerateurG($id_g))==1)
				{
					//echo "Cette personne a deja été ajouter a ce groupe!!";
					exit();
				}
				else if($res=($this->verifPseudoModerateurG($id_g))==2)
				{
					//echo "pseudo inconnu";
					exit();
				}
				else if($res=($this->verifPseudoModerateurG($id_g))==3)
				{
					//echo ("Vous ne pouvez acceder a cette page");
					exit();
				}
				else if($res=($this->verifPseudoModerateurG($id_g))==4)
				{
					//echo ("Pas dans le groupe");
					exit();
				}
				else // pas d'erreur on peut inserer en base
				{
					$info = $user->getInfosUser2($user->getPseudo()); // recupere les infos par rapport au pseudo

					$resultatAddModerateur = $this->groupe->addModerateur($info['ut_id']);
					if($resultatAddModerateur)
					{
						echo "UpdateSuccess";
						exit();
					}
					else
					{
						echo "Erreur Ajout Moderateur";
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


	public function validerRetraitModerateurGroupe($id_g,$ut_id)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{

			$this->groupe->setGroupeId($id_g);
			$groupeInfos = $this->groupe->getInfosGroupe($id_g); // on recupere les infos du groupe
			$id=$_SESSION['id'];
			$admin =$this->groupe->checkGroupeAdmin($id); // on check s'il est admin du groupe (c.a.d) que c'est lui qui l'a cree

			if($ut_id == $id) // eviter quil se supprime s'il est admin ou moderateur
			{
				$this->erreur("Vous etes admin de ce groupe vous ne pouvez donc pas vous supprimer");
				exit();
			}

			if($admin == true)
			{
				$user = new Utilisateur($ut_id);
				$resultatDeleteModerateur= $this->groupe->deleteModerateur($ut_id);
				if(!$resultatDeleteModerateur)
				{
					$this->erreur("Erreur lors de la suppression");
					exit();
				}
				Header('Location: '.ABSOLUTE_ROOT.'/controleurs/ControleurGroupe.php?action=afficherRetraitModerateurGroupe&donnee='.$id_g);

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


	public function afficherAjoutUtilisateurGroupe($id_g)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{

			$this->groupe->setGroupeId($id_g);
			$groupeInfos = $this->groupe->getInfosGroupe($id_g); // on recupere les infos du groupe
			$id=$_SESSION['id'];
			$admin =$this->groupe->checkGroupeAdmin($id); // on check s'il est admin du groupe (c.a.d) que c'est lui qui l'a cree
			$isModerateur=$this->groupe->checkModerateur($id);
			if($admin == true||$isModerateur==true)
			{
				$this->vue = new VueConnecter("AjoutUtilisateurGroupe");
				$this->vue->generer(array("groupe"=>$groupeInfos));
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


	//fonction qui verifie si un pseudo peut etre ajouter a un sondage prive
	public function verifPseudoUtilisateurG($id_g)
	{
		if(isset($_SESSION['id']) && isset($_SESSION['email']) )
		{
			$user = new Utilisateur();
			$user->POSTToVar($_POST);// on echappe le code html des possible donnees recues et on initialise les attributs de l'instance avec les donnees!!
			//print_r($user->getPseudo());
			$this->groupe->setGroupeId($id_g);
			$infosUser = $user->getInfosUser2($user->getPseudo()); // on recupere els infos du nom envoyer
			if($user->is_dispo_pseudo($user->getPseudo()) == false) // si le pseudo est dispo 
			{
				if($this->groupe->checkIsInGroupe($infosUser['ut_id'])==false)
				{
					echo "dispo";
					return 0;
				}
				else
				{
					echo "Cette personne a deja été ajouter a ce groupe!!";
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



	public function validerAjoutUtilisateurGroupe($id_g)
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->groupe->setGroupeId($id_g);
			$groupeInfos = $this->groupe->getInfosGroupe($id_g); // on recupere les infos du groupe
			$id=$_SESSION['id'];
			$admin =$this->groupe->checkGroupeAdmin($id); // on check s'il est admin du groupe (c.a.d) que c'est lui qui l'a cree


			if($admin == true)
			{
				$user = new Utilisateur();
				$user->POSTToVar($_POST);// on echappe le code html des possible donnees recues et on initialise les attributs de l'instance avec les donnees!!
				if($user->getPseudo()=="")
				{
					echo "Veuillez precisez le pseudo";
					exit();
				}
				else if($res=($this->verifPseudoUtilisateurG($id_g))==1)
				{
					//echo "Cette personne a deja été ajouter a ce groupe!!";
					exit();
				}
				else if($res=($this->verifPseudoUtilisateurG($id_g))==2)
				{
					//echo "pseudo inconnu";
					exit();
				}
				else if($res=($this->verifPseudoUtilisateurG($id_g))==3)
				{
					//echo ("Vous ne pouvez acceder a cette page");
					exit();
				}
				else // pas d'erreur on peut inserer en base
				{
					$info = $user->getInfosUser2($user->getPseudo()); // recupere les infos par rapport au pseudo

					$resultatAddU = $this->groupe->addInscrit2($info['ut_id']);
					if($resultatAddU)
					{
						echo "UpdateSuccess";
						exit();
					}
					else
					{
						echo "Erreur Ajout Utilisateur";
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
				exit();
			}
		}
		?>



