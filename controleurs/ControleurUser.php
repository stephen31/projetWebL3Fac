<?php
//session_start();
require_once "Controleur.php";
require_once ROOT.'/models/Utilisateur.php';
require_once ROOT.'/models/Sondage.php';
require ROOT . '/public/lib/PHPMailer/class.phpmailer.php';



class ControleurUser extends Controleur
{
	private $utilisateur;


	public function __construct()
	{
		parent::__construct();
		$this->utilisateur=new Utilisateur(); 
	}

	public function afficherAccueil()
	{
		$sondage=new Sondage();
		
        //print_r($sondages);
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$id=$_SESSION['id'];
			echo $id;
			$sondages=$sondage->getSondagesUserConnectAccueuil($id);
			$this->vue = new VueConnecter("Accueil");
			$this->vue->generer(array("sondages"=>$sondages));
		}
		else
		{
			$sondages=$sondage->getSondagesPublic();
			$this->vue = new VueNonConnecter("Accueil");
			$this->vue->generer(array("sondages"=>$sondages));
		}
	}

	public function afficherInscription()
	{
		$this->vue = new VueNonConnecter("Inscription");
		$this->vue->generer(array());
	}

	public function afficherConnexion()
	{
		$this->vue = new VueNonConnecter("Connexion");
		$this->vue->generer(array());
	}

	public function afficherMDPPErdu()
	{
		$this->vue = new VueNonConnecter("MDPPerdu");
		$this->vue->generer(array());
	}

	public function afficherInscriptionTerminee()
	{
		$this->vue = new VueNonConnecter("InscriptionTerminee");
		$this->vue->generer(array());
	}

	public function afficherCompteValider()
	{
		$this->vue = new VueNonConnecter("CompteValider");
		$this->vue->generer(array());
	}

	public function afficherErreurValidation()
	{
		$this->vue = new VueNonConnecter("ErreurValidation");
		$this->vue->generer(array());
	}

	public function afficherInfosUser()
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) // si les variables de sessions sont definit on affiche la vue connecter
		{
			$this->vue = new VueConnecter("InfosUser");
			$utilisateur = new Utilisateur($_SESSION['id']);
			$this->vue->generer(array("utilisateur"=>$utilisateur));
		}
		else
		{
			$this->erreur("Vous ne pouvez acceder a cette page");
		}
	}

	public function afficherModifMesinfos()
	{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['email']))
		{
			$this->vue = new VueConnecter("ModifInfos");
			$utilisateur = new Utilisateur($_SESSION['id']);
			$this->vue->generer(array("utilisateur"=>$utilisateur));
		}
		else
		{
			$this->erreur("Vous ne pouvez acceder a cette page");
		}
	}

	// activation du compte apres que l'utilisateur ait recu le mail et cliquer sur le lien d'activaion
	public function activationCompte()  
	{
		$res = $this->utilisateur->valid_compte_hashValidation($_GET["hash"]);
		if($res)
		{
			$this->afficherCompteValider();
		}
		else
		{
			$this->afficherErreurValidation();
		}
	}



	//*******  FONCTION DE VERIFICATION *******//

	public function verifPseudo()
	{
		$this->utilisateur->POSTToVar($_POST);// on echappe le code html des possible donnees recues!!
		//$this->utilisateur->getPseudo() = preg_replace('#[^a-z0-9]#i', '', $this->utilisateur->getPseudo()); // on filtre le pseudo s'il contient des caractere tel que #
		//	$this->utilisateur->setPseudo($this->utilisateur->getPseudo());
		if(mb_strlen($this->utilisateur->getPseudo(),'UTF-8')<3 || mb_strlen($this->utilisateur->getPseudo(),'UTF-8') >16)
		{
			echo'3 a 16 caractéres SVP<br />';
			return 0;
			//exit();
		}
		if(is_numeric($this->utilisateur->getPseudo()[0])) // Si le pseudo commence par un numeric
		{
			echo 'Le pseudo doit commencer par une lettre.<br />';
			return 1;
			exit();
		}
		if(isset($_SESSION['id']))
		{
			$ut=new Utilisateur($_SESSION['id']); // on cree une instance utilisateur pour recuperer le pseudo de l'utisateur connecter
			$infos_user = $ut->getInfosUser();// on recupere infos utilisateur
			if(strcasecmp($infos_user['ut_pseudo'],$this->utilisateur->getPseudo())!=0) // s'il est connecter ( pour la page modif infos)on compare le pseudo dans le input avec celui de l'ulisateur connecter , si different on effectue teste si dispo en base
			{
				$dispo = $this->utilisateur->is_dispo_pseudo($this->utilisateur->getPseudo());
				if($dispo == false)
				{
					echo "Pseudo déja utilisé !<br />";
					return 2;
					exit();
				}
				else
				{

					echo "success";
					return 3;
					exit();
				}
			}
			else // sinon sa veut dire que le pseudo entrer est identique a celui de l'ulitisateur connecter , dans ce cas on affiche pas d'erreur car dans la page modifier infos on admet que l'utilisateur desire garder le meme pseudo
			{
				echo "success";
				return 4;
				exit();
			}
		}
		else
		{
			$dispo = $this->utilisateur->is_dispo_pseudo($this->utilisateur->getPseudo());
			if($dispo == false)
			{
				echo "Pseudo déja utilisé !<br />";
				return 2;
				exit();
			}
			else
			{

				echo "success";
				return 3;
				exit();
			}
		}
	}

	public function verifEmail()
	{
		$this->utilisateur->POSTToVar($_POST);// on echappe le code html des possible donnees recues!!
		if(!filter_var($this->utilisateur->getEmail(),FILTER_VALIDATE_EMAIL))
		{
			echo 'Adresse email invalide<br />';
			return 0;
			exit();
		}
		if(isset($_SESSION['id']))
		{
			$ut=new Utilisateur($_SESSION['id']); // on cree une instance utilisateur pour recuperer le pseudo de l'utisateur connecter
			$infos_user = $ut->getInfosUser();// on recupere infos utilisateur
			if(strcasecmp($infos_user['ut_mail'],$this->utilisateur->getEmail())!=0) // on compare le pseudo dans le input avec celui de l'ulisateur connecter , si different on effectue teste si dispo en base
			{
				$dispo= $this->utilisateur->is_dispo_email($this->utilisateur->getEmail());

				if($dispo == false)
				{
					echo "Email déja utilisé !<br />";
					return 1;
				//echo $infos_user['ut_mail'];
				//echo $this->utilisateur->getEmail();
					exit();
				}
				else
				{
					echo "success";
					return 2;
					exit();
				}
			}
			else // sinon sa veut dire que le pseudo entrer est identique a celui de l'ulitisateur connecter , dans ce cas on affiche pas d'erreur car dans la page modifier infos on admet que l'utilisateur desire garder le meme pseudo
			{
				echo "success";
				return 3;
				exit();
			}
		}
		else
		{
			$dispo= $this->utilisateur->is_dispo_email($this->utilisateur->getEmail());

			if($dispo == false)
			{
				echo "Email déja utilisé !<br />";
				return 1;
				//echo $infos_user['ut_mail'];
				//echo $this->utilisateur->getEmail();
				exit();
			}
			else
			{
				echo "success";
				return 2;
				exit();
			}
		}
	}



	////// TRAITEMENT DE l'INSCRIPTION ///////



	public function validerInscription()
	{
		$this->utilisateur->POSTToVar($_POST);
		//extract($_POST);
		//print_r($_POST);
		if(empty($this->utilisateur->getNom())||empty($this->utilisateur->getPrenom())||empty($this->utilisateur->getPseudo())||empty($this->utilisateur->getPass1())||empty($this->utilisateur->getPass2()))
		{
			echo " tous les champs n'ont pas été rempli<br />";
			exit();
		}

		//$this->utilisateur->getPseudo() = preg_replace('#[^a-z0-9]#i', '', $this->utilisateur->getPseudo()); // on filtre le pseudo s'il contient des caractere tel que #
		$valid= $this->utilisateur->is_valid_inscription($this->utilisateur->getPseudo(),$this->utilisateur->getEmail());
		$validpseudo =$valid["pseudocheck"];
		$validemail =$valid["emailcheck"];

		if($validpseudo>0)
		{
			echo "Pseudo non dispo<br />";
			exit();
		}
		else if($validemail>0)
		{
			echo "Email Non valide<br />";
			exit();
		}
		else if($this->utilisateur->getPass1() != $this->utilisateur->getPass2())
		{
			echo "Les mots de passe ne correspondent pas<br />";
			exit();
		}
		else if(mb_strlen($this->utilisateur->getPass1(),'UTF-8')<6 || mb_strlen($this->utilisateur->getPass2(),'UTF-8') <6)
		{
			echo "Les mots de passe sont trop court <br />";
			exit();
		}
		else // on effectue l'inscription 
		{
			// on hash le mot de passe 

			$this->utilisateur->setPass(sha1($this->utilisateur->getPass1())); 

				// demarre une transaction

			$this->utilisateur->beginTransaction(); 

				// on recupere l'id de l'utilisateur

			$id_utilisateur = $this->utilisateur->addUtilisateur();

				// on verifie que l'ajout a été fait avec succes



			if(ctype_digit($id_utilisateur))
			{

				$id_utilisateur = (int) $id_utilisateur; // on cast en entier par precaution

					/// ON ENVOIE LE MAIL 
				$mail = new PHPMailer();

				$mail -> IsSMTP();
				$mail->IsHTML(true);
					// telling the class to use SMTP
				$mail -> SMTPAuth = true;
				$mail->SMTPSecure = 'ssl';
					// turn on SMTP authentication
				$mail -> Host = EMAIL_HOST; 
					// SMTP server
				$mail -> Port = EMAIL_PORT;
				$mail -> Username = EMAIL_USERNAME;
				$mail -> Password = EMAIL_PASSWD;
				$mail->addAddress(''.$this->utilisateur->getEmail());
				$mail -> FromName = 'SONDAGAX';
				$mail -> From = EMAIL_FROM;
				$mail->CharSet = EMAIL_CHARSET;	
				$mail -> Subject = " Sondagax - Activation de votre Compte ";
				$mail -> Body ='
				<html>
				<head>
				</head>
				<body>
					<p> Vous venez de vous inscrire sur '. NOM_SITE . ' </p>
					<p> Pour valider votre compte veuillez cliquez sur ce <a href="' . ABSOLUTE_ROOT . '/controleurs/ControleurUser.php?action=activationCompte&amp;hash='.$this->utilisateur->getHashValidation().'">lien</a></p>
					<h3> Vos identifiants de connexion </h3>
					<p> 
						Pseudo : '.$this->utilisateur->getPseudo().'<br/>
						Password : '.$this->utilisateur->getPass1().'<br/>
					</p>
				</body>
				</html>';
					// on teste si le mail a bien été envoyer 

				if($mail->send())
				{

					$this->utilisateur->commit(); // on valide la requete , on insere le tuple
						//$this->afficherInscriptionTerminee(); // on affiche la page inscription finit
					echo 'RegisterSuccess';
					exit();
				}
				else
				{
						// si pas bien derouler on rollback 
					$this->utilisateur->rollback();
						//$this->utilisateur->afficherInscription();
					echo "Erreur Lors de l'envoie du mail". $mail->ErrorInfo;
					exit();
				}
			}
			else
			{
				echo "erreur ajout dans la bdd";
				exit();
			}
		}
	}

	/// TRAITEMENT DE LA CONNEXION ////

	public function connexion()
	{
		$this->utilisateur->POSTToVar($_POST); // on recupere les champs envoyer par le formulaire

		$this->utilisateur->setPass(sha1($this->utilisateur->getPass1())); // on rehash le pass

		if($this->utilisateur->is_dispo_pseudo($this->utilisateur->getPseudo())==true) // si le pseudo n'est pas en base
		{
			$this->erreur("Pseudo non reconnue");
			exit();
		}
		$retourCombinaisonCorrect = $this->utilisateur->combinaisonCorrect();
		if($retourCombinaisonCorrect == false) // si la combinaison pseudo , pass est incorrect
		{
			$this->erreur("Combinaison pseudo mot de passe incorrect");
		}
		else// si combinaison correct
		{
			// on stocke les variables de sessions
			$_SESSION['id'] = $retourCombinaisonCorrect['ut_id'];
			$_SESSION['pseudo'] = $retourCombinaisonCorrect['ut_pseudo'];
			$_SESSION['email'] = $retourCombinaisonCorrect['ut_mail'];
			// on affiche la vue accueil connecter
			$this->afficherAccueil();
		}
	}

	// ENVOIE MOT DE PASSE PERDU

	public function envoiMotDePassePerdu()
	{
		$this->utilisateur->POSTToVar($_POST); // on recupere les champs envoyer par le formulaire
		
		if(!filter_var($this->utilisateur->getEmail(),FILTER_VALIDATE_EMAIL)) // reverification de la syntaxe de l'email
		{
			echo $this->utilisateur->getEmail();
			//echo 'Adresse email invalide';
			echo "salut";
			exit();
		}
		// on verifie que l'email est base
		if(($this->utilisateur->is_dispo_email($_POST['email'])==true))
		{
			echo $this->utilisateur->getEmail();
			echo 'Email inconnu';
			exit();
		}
		else
		{
			// on genere une mot de passe Aleatoire
			$newpass = generateRandomPassword();

			$infos_user = $this->utilisateur->getInfosUser();// on recupere infos utilisateur

			$this->utilisateur = new Utilisateur($infos_user['ut_id']); // on reinitialise l'instance utilisateur avec les variables de infosuser

			$this->utilisateur->setPass(sha1($newpass));

			// demarre une transaction

			$this->utilisateur->beginTransaction(); 

			// on met a jour le mot de passe de l'utilisateur

			$resultat = $this->utilisateur->updateUtilisateur();


			// on envoie le mail
			if($resultat == true) // si on mise a jour ok 
			{

				/// ON ENVOIE LE MAIL 
				$mail = new PHPMailer();

				$mail -> IsSMTP();
				$mail->IsHTML(true);
						// telling the class to use SMTP
				$mail -> SMTPAuth = true;
				$mail->SMTPSecure = 'ssl';
						// turn on SMTP authentication
				$mail -> Host = EMAIL_HOST; 
						// SMTP server
				$mail -> Port = EMAIL_PORT;
				$mail -> Username = EMAIL_USERNAME;
				$mail -> Password = EMAIL_PASSWD;
				$mail->addAddress(''.$this->utilisateur->getEmail());
				$mail -> FromName = 'SONDAGAX';
				$mail -> From = EMAIL_FROM;
				$mail->CharSet = EMAIL_CHARSET;	
				$mail -> Subject = " Sondagax - Reinitialisation Mot de Passe ";
				$mail -> Body ='
				<html>
				<head>
				</head>
				<body>
					<p> Vous venez de vous faire une demande de mot de passe sur '. NOM_SITE . ' </p>
					<h3> Vos identifiants de connexion </h3>
					<p> 
						Pseudo : '.$infos_user['ut_pseudo'].'<br/>
						Password : '.$newpass.'<br/>
					</p>
				</body>
				</html>';
						// on teste si le mail a bien été envoyer 

				if($mail->send())
				{
					$this->utilisateur->commit(); // on applique la mise a jour
					echo 'SendSuccess';
					exit();
				}
				else
				{
					$this->utilisateur->rollback(); // on annule la mise a jour
					echo "Erreur lors de l'envoi du mail";

				}

			}
			else
			{
				echo "Erreur retour de mise a jour";
				//print_r($infos_user);
				echo $resultat;
			}

		} 
	}


	// DECONNEXION

	public function deconnexion()
	{
		session_destroy(); // on detruit la session
		header("location:" . ABSOLUTE_ROOT); // on redirige vers l'accueil
	} 

	// MODIFICATION UTILISATEUR

	public function miseAJourUtilisateur()
	{
		//echo "sauceman";
		$this->utilisateur->POSTToVar($_POST);
		//echo $this->utilisateur->getNom(),$this->utilisateur->getPrenom(),$this->utilisateur->getPseudo(),$this->utilisateur->getEmail(),$this->utilisateur->getPass1(),$this->utilisateur->getPass2();
		if(empty($this->utilisateur->getNom())||empty($this->utilisateur->getPrenom())||empty($this->utilisateur->getPseudo())||empty($this->utilisateur->getEmail())||empty($this->utilisateur->getPass1())||empty($this->utilisateur->getPass2()))
		{
			echo " tous les champs n'ont pas été rempli<br />";
		}

		//$this->utilisateur->getPseudo() = preg_replace('#[^a-z0-9]#i', '', $this->utilisateur->getPseudo()); // on filtre le pseudo s'il contient des caractere tel que #
		$valid= $this->utilisateur->is_valid_inscription($this->utilisateur->getPseudo(),$this->utilisateur->getEmail());
		$validpseudo =$valid["pseudocheck"];
		$validemail =$valid["emailcheck"];

		// on reverifie le formulaire
		$return1=$this->verifPseudo();
		$return2=$this->verifEmail();

		//echo $validpseudo,$validemail,$return1,$return2;

		if($validpseudo>0 && $return1 != 4) // on teste si le pseudo est dispo et qu'il n'est pa identique a celui actuel
		{
			exit();
		}
		else if($validpseudo==0 && $return1==0)
		{
			exit();
		}
		else if($validemail>0 && $return2!=3)
		{
			exit();
		}
		else if($validemail==0 && $return2==0)
		{
			exit();
		}
		else if($this->utilisateur->getPass1() != $this->utilisateur->getPass2())
		{
			echo "Les mots de passe ne correspondent pas<br />";
			exit();
		}
		else if(mb_strlen($this->utilisateur->getPass1(),'UTF-8')<6 || mb_strlen($this->utilisateur->getPass2(),'UTF-8') <6)
		{
			echo "Les mots de passe sont trop court <br />";
			exit();
		}
		else // on effectue la mise a jour 
		{
			//echo"salut";
			$this->utilisateur->setId($_SESSION['id']); // pour l'update on initialise l'id de l'insatance utilisateur
				// on hash le mot de passe 

			$this->utilisateur->setPass(sha1($this->utilisateur->getPass1())); 

				// demarre une transaction

			$this->utilisateur->beginTransaction(); 

				// on recupere le resulatat de la requette 

			$res = $this->utilisateur->updateUtilisateur();
				// on verifie que l'ajout a été fait avec succes

			if($res!=false)
			{

				$this->utilisateur->commit(); // on valide la requete , on insere le tuple
				//$this->afficherInscriptionTerminee(); // on affiche la page inscription finit


				//on mt a jour les variables de session
				$_SESSION['pseudo']=$this->utilisateur->getPseudo();
				$_SESSION['email']=$this->utilisateur->getEmail();


				echo 'UpdateSuccess';
				//header ("location:" . ABSOLUTE_ROOT, 3); // on redirige vers l'accueil
				exit();
			}
			else
			{
				// si pas bien derouler on rollback 
				$this->utilisateur->rollback();
				echo 'erreur Lors de la mise a jour';
				exit();
			}
		}
	}









}


// generation mot de pase Aleatoire

function generateRandomPassword() {
    // initialiser la variable $mdp
    $mdp = "";
 	$longueur = 6;
    // Définir tout les caractères possibles dans le mot de passe,
    // Il est possible de rajouter des voyelles ou bien des caractères spéciaux
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
 
    // obtenir le nombre de caractères dans la chaîne précédente
    // cette valeur sera utilisé plus tard
    $longueurMax = strlen($possible);
 
    if ($longueur > $longueurMax) {
        $longueur = $longueurMax;
    }
 
    // initialiser le compteur
    $i = 0;
 
    // ajouter un caractère aléatoire à $mdp jusqu'à ce que $longueur soit atteint
    while ($i < $longueur) {
        // prendre un caractère aléatoire
        $caractere = substr($possible, mt_rand(0, $longueurMax-1), 1);
 
        // vérifier si le caractère est déjà utilisé dans $mdp
        if (!strstr($mdp, $caractere)) {
            // Si non, ajouter le caractère à $mdp et augmenter le compteur
            $mdp .= $caractere;
            $i++;
        }
    }
 
    // retourner le résultat final
    return $mdp;
}






?>

<?php


	if(isset($_GET["action"])) // si action est pas vide
	{	
		$instance = new ControleurUser();
		
		if(method_exists($instance,$_GET["action"])) // on verifie que l'action / la methode existe
		{
			if(isset($_GET["donnee"]))
			{
				$instance->$_GET["action"]($_GET["donnee"]);
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



