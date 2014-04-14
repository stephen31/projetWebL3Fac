<?php

require_once(ROOT . '/models/Model.php');

class Groupe extends Model
{

    // attributs
    private $groupe_id;
    private $groupe_desc;
    private $groupe_nom;
    private $groupe_date_creation;
    private $groupe_droit;
    private $ut_id;
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

    public function constructeurVide()
    {
        $this->groupe_id = -1;
        $this->groupe_desc="";
        $this->ut_id =-1;
        $this->groupe_nom='';
        $this->groupe_droit=0;
        $this->groupe_date_creation='0000-00-00';
    }


    public function constructeurParametre($id_g)
    {
        $req = "SELECT * FROM groupe WHERE groupe_id=?";
        $res = $this->executerRequete($req,array($id_g));
        $result = $res->fetch(PDO::FETCH_ASSOC);;
        if($res->rowCount()==1)
        {
            $this->groupe_id = $result['groupe_id'];
            $this->groupe_desc=$result['groupe_desc'];
            $this->ut_id =$result['ut_id'];
            $this->groupe_nom=$result['groupe_nom'];
            $this->groupe_droit=$result['groupe_droit'];
            $this->groupe_date_creation=$result['groupe_date_creation'];
        }
        else
        {
            $this->groupe_id = -1;
            $this->groupe_desc="";
            $this->ut_id =-1;
            $this->groupe_nom='';
            $this->groupe_droit=0;
            $this->groupe_date_creation='0000-00-00';
        }
    }

    // Getters et setters

    public function getGroupeId()
    {
        return $this->groupe_id;
    }
    public function getGroupeDesc()
    {
        return $this->groupe_desc;
    }
    public function getUtid()
    {
        return $this->ut_id;
    }
    public function getGroupeNom()
    {
        return $this->groupe_nom;
    }
    public function getGroupeDroit()
    {
        return $this->groupe_droit;
    }
    public function getDateCreation()
    {
        return $this->groupe_date_creation;
    }

    /*************************/


    public function setGroupeId($g_id)
    {
        $this->groupe_id=$g_id;
    }
    public function setGroupeDesc($g_desc)
    {
        $this->groupe_id=$g_desc;
    }
    public function setUtid($gutId)
    {
        $this->ut_id=$gutId;
    }
    public function setGroupeNom($g_nom)
    {
        $this->groupe_nom=$g_nom;
    }
    public function setGroupeDroit($g_droit)
    {
        $this->groupe_droit=$g_droit;
    }
    public function setDateCreation($g_date)
    {
        $this->groupe_date_creation=$g_date;
    }



    /*************************/


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


    /* Renvoie les infos d'un groupe en fonction de son id*/

    public function getInfosGroupe($id_g)
    {
        $sql="SELECT * FROM groupe WHERE groupe_id=?";
        $tuple = $this->executerRequete($sql,array($id_g));
        return $tuple->fetchAll();
    }


    /* fonction dajout d'un groupe */

    public function addGroupe()
    {
        $sql ='INSERT INTO groupe SET
        groupe_desc=?,
        groupe_nom=?,
        groupe_droit=?,
        ut_id=?';

        $res = $this->executerRequete($sql,array($this->groupe_desc,$this->groupe_nom,$this->groupe_droit,$this->ut_id));
        if($res->rowCount() == 1)
        {
            return $this->getBdd()->lastInsertId();
        }
        else
        {
            return false;  
        }

    }


    /* verifie si un nom de groupe est deja present en base */

    public function is_dispo_groupe($groupeN)
    {
        $sql="SELECT groupe_id FROM groupe WHERE groupe_nom=?";
        $tuple = $this->executerRequete($sql,array($groupeN));
        $numRows = $tuple->rowCount();
        if($numRows>0)
        {
            return false;
        }
        return true;
    }


    /* accesseurs aux groupes public */

    public function getGroupePublic()
    {
        $sql='SELECT * from groupe
        WHERE groupe_droit=0';

        $res = $this->executerRequete($sql,array());

        return $res->fetchAll();
    }

    /* accesseurs a tous les groupes ou l'utilisateur connecter n'y est pas inscrit*/
    public function getGroupePublicNotIn($idU)
    {
        $sql='SELECT * from groupe,inscrit
        WHERE groupe_droit=0 and NOT EXISTS(SELECT * FROM groupe natural join inscrit WHERE ut_id=?)';

        $res = $this->executerRequete($sql,array($idU));

        return $res->fetchAll();
    }


    /* ajout d'un inscrit au groupe */

    public function addInscrit($idU)
    {
        $sql ='INSERT INTO inscrit SET
        groupe_id=?,
        ut_id=?';
        

        $res = $this->executerRequete($sql,array($this->groupe_id,$idU));

        if($res->rowCount() == 1)
        {
            return true;
        }
        else
        {
            return false;  
        }

    }



}
















