<?php

require_once(ROOT . '/models/Model.php');

class Utilisateur extends Model
{

	// attributs

	private $id;
	private $nom;
	private $prenom;
	private $pseudo;
	private $email;
	private $pass;
	private $pass1;
	private $pass2;
	private $date_inscription;
	private $hash_validation;
	private $compte_valide;
	private $aGroupeOui;
	private $aGroupeNon;

	// constructeur

	public function __construct()
	{

		switch(func_num_args())
		{
			case 0:
			$this->constructeurVide();
			break;
			case 1:
			$this->constructeurParametre(func_get_arg(0));
			break;
		}

	}

	/* Formate les variables récupérées d'un formulaire et les stocke dans $this */ 
	public function POSTToVar($array){
		foreach ($array as $key => $value) 
		{
		    //Suppression des espaces en début et en fin de chaîne
			$trimedValue = trim($value);
		    //Conversion des tags HTML par leur entité HTML
			$this->$key = htmlspecialchars($trimedValue);
		}
	}

	public function constructeurVide()
	{
		$this->id = -1;
		$this->nom ='';
		$this->prenom='';
		$this->pseudo='';
		$this->email='';
		$this->pass1='';
		$this->pass2='';
		$this->date_inscription='0000-00-00';
		$this->hash_validation='';
		$this->compte_valide=false;
	}

	public function constructeurParametre($id_user)
	{
		$req = "SELECT * FROM utilisateur WHERE ut_id=?";
		$res = $this->executerRequete($req,array($id_user));
		if($result = $res->fetch(PDO::FETCH_ASSOC))
		{
			$this->id=$result['ut_id'];
			$this->nom=$result['ut_nom'];
			$this->pseudo=$result['ut_pseudo'];
			$this->prenom=$result['ut_prenom'];
			$this->pass=$result['ut_mdp'];
			$this->email=$result['ut_mail'];
			$this->compte_valide=$result['ut_compte_valide'];
			$this->hash_validation=$result['ut_hash_validation'];
			$this->date_inscription=$result['ut_date_inscription'];
		}
		else
		{
			$this->id = -1;
			$this->nom ='';
			$this->prenom='';
			$this->pseudo='';
			$this->email='';
			$this->pass1='';
			$this->pass2='';
			$this->date_inscription='0000-00-00';
			$this->hash_validation='';
			$this->compte_valide=false;
		}
	}


		// Accesseurs et Setteurs
	public function getId()
	{
		return $this->id;
	}
	public function getNom()
	{
		return $this->nom;
	}

	public function getPrenom()
	{
		return $this->prenom;
	}

	public function getPseudo()
	{
		return $this->pseudo;
	}
	public function getEmail()
	{
		return $this->email;
	}

	public function getPass()
	{
		return $this->pass;
	}
	public function getPass1()
	{
		return $this->pass1;
	}
	public function getPass2()
	{
		return $this->pass2;
	}

	public function getDateInscription()
	{
		return $this->date_inscription;
	}

	public function getHashValidation()
	{
		return $this->hash_validation;
	}

	public function setId($i)
	{
		$this->id = $i;
	}

	public function setNom($n)
	{
		$this->nom = $n;
	}

	public function setPrenom($pren)
	{
		$this->prenom = $pren;
	}

	public function setPseudo($p)
	{
		$this->pseudo=$p;
	}
	public function setEmail($m)
	{
		$this->mail=$m;
	}

	public function setPass($pp)
	{
		$this->pass=$pp;
	}
	public function setPass1($p1)
	{
		$this->pass1=$p1;
	}
	public function setPass2($p2)
	{
		$this->pass2=$p2;
	}

	public function setDateInscription($di)
	{
		$this->date_inscription = $di;
	}

	public function setHashValidation($hv)
	{
		$this->hash_validation=$hv;
	}


		// verifcation en base si le pseudo est dispo , renvoie true si dispo , false sinon
	public function is_dispo_pseudo($pseudo)
	{
		$sql="SELECT ut_id FROM utilisateur WHERE ut_pseudo=?";
		$tuple = $this->executerRequete($sql,array($pseudo));
		$numRows = $tuple->rowCount();
		if($numRows>0)
		{
			return false;
		}
		return true;
	}

		// verifcation en base si lemailest dispo , renvoie true si dispo , false sinon
	public function is_dispo_email($email)
	{
		$sql="SELECT ut_id FROM utilisateur WHERE ut_mail=?";
		$tuple = $this->executerRequete($sql,array($email));
		$numRows = $tuple->rowCount();
		if($numRows>0)
		{
			return false;
		}
		return true;
	}

		// retourner les infos d'un utilisateur en fonction de son email

	public function getInfosUser()
	{
		$sql = "SELECT * FROM utilisateur WHERE ut_mail=?";
		$res = $this -> executerRequete($sql,array($this->email));
		if($result = $res->fetch(PDO::FETCH_ASSOC))
		{
			return $result;
		}
		else return false;
	}


	//recupere l'id a partir du pseudo

	public function getInfosUser2($pseudo)
	{
		$sql = "SELECT ut_id FROM utilisateur WHERE ut_pseudo=?";
		$res = $this -> executerRequete($sql,array($pseudo));
		if($result = $res->fetch(PDO::FETCH_ASSOC))
		{
			return $result;
		}
		else return false;
	}

	/* verification encore avant l'insertion dans la base , si l'email est dispo et si le pseudo est dispo , 
	renvoie un tableau associatif pseudo => nmbre de ligne ayant ce pseudo , email => nbre le ligneayant cet email*/
	public function is_valid_inscription($pseudo,$email)
	{
			$sql1="SELECT ut_id FROM utilisateur WHERE ut_pseudo=?";
			$tuple1 = $this->executerRequete($sql1,array($pseudo));
			$pseudochek = $tuple1->rowCount();

			$sql2="SELECT ut_id FROM utilisateur WHERE ut_mail=?";
			$tuple2 = $this->executerRequete($sql2,array($email));
			$emailcheck = $tuple2->rowCount();

			$array = array("pseudocheck"=>$pseudochek,"emailcheck"=>$emailcheck);
			return $array;

	}

	// teste si la combinaison pseudo / mot de passe est dispo en base ,return true si dispo , false sinon
	public function combinaisonCorrect() 
	{
		$sql = "SELECT ut_id,ut_pseudo,ut_mail FROM utilisateur WHERE ut_pseudo = ? AND ut_mdp = ? AND ut_compte_valide='1'";
		$tuple = $this->executerRequete($sql,array($this->pseudo,$this->pass));
			//$nbRow = $tuple->rowCount();
		if($res = $tuple->fetch(PDO::FETCH_ASSOC))
		{
			return $res;
		}
		else 
			return false;

	}

	public function hashValidation(){ //on cree un hash unique pour l'utilisateur'
		$this->hash_validation = md5(uniqid(rand(), true).$this->email); 
		return $this->hash_validation;
	}

	// on valide le compte avec le hash de validation recu par mail

	public function valid_compte_hashValidation($hash){ 

		$sql = "UPDATE utilisateur SET ut_compte_valide = '1' WHERE ut_hash_validation = ?";
		$res = $this->executerRequete($sql,array($hash));
			return ($res->rowCount() == 1); // si 1 alors mise a jour ok

		}

	// Ajout d'un utilisateur en Base
	public function addUtilisateur()
	{
			$sql = "INSERT INTO utilisateur SET
			ut_nom=?,
			ut_prenom=?,
			ut_pseudo=?,
			ut_mail=?,
			ut_mdp=?,
			ut_date_inscription=NOW(),
			ut_hash_validation =?";

			$res = $this->addTuple($sql,array($this->nom,
				$this->prenom,
				$this->pseudo,
				$this->email,
				$this->pass,
				$this->hashValidation()
				));
			return $res;
	}

	// Mise a jour de l'utilisateur

	public function updateUtilisateur() {
			$sql = 'UPDATE utilisateur SET
			ut_nom = ?,
			ut_prenom = ?,
			ut_pseudo = ?,
			ut_mail = ?,
			ut_mdp = ?,
			ut_compte_valide = ?
			WHERE ut_id = ?';

			$res = $this->executerRequete($sql, array($this->nom,
				$this->prenom,
				$this->pseudo,
				$this->email,
				$this->pass,
				1,
				$this->id));

			return ($res->rowCount() == 1);
		}
}

?>