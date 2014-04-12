<?php

require_once(ROOT . '/models/Model.php');

class Groupe extends Model
{

    // attributs
    private $groupe_id;
    private $groupe_nom;
    private $groupe_date_creation;
    private $groupe_droit;
    private $ut_id;
    private $groupe_visibilite;

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
        $this->ut_id =-1;
        $this->groupe_nom='';
        $this->groupe_droit=0;
        $this->groupe_date_creation='0000-00-00';
        $this->groupe_visibilite=0;
    }


    public function constructeurParametre($id_g)
    {
        $req = "SELECT * FROM groupe WHERE groupe_id=?";
        $res = $this->executerRequete($req,array($id_g));
        $result = $res->fetch(PDO::FETCH_ASSOC);;
        if($res->rowCount()==1)
        {
            $this->groupe_id = $result['groupe_id'];
            $this->ut_id =$result['ut_id'];
            $this->groupe_nom=$result['groupe_nom'];
            $this->groupe_droit=$result['groupe_droit'];
            $this->groupe_date_creation=$result['groupe_date_creation'];
            $this->groupe_visibilite=$result['groupe_visibilite'];
        }
        else
        {
            $this->groupe_id = -1;
            $this->ut_id =-1;
            $this->groupe_nom='';
            $this->groupe_droit=0;
            $this->groupe_date_creation='0000-00-00';
            $this->groupe_visibilite=0;
        }
    }

    // Getters et setters

    public function getGroupeId()
    {
        return $this->groupe_id;
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
    public function getVisibilite()
    {
        return $this->groupe_visibilite;
    }

    /*************************/


    public function setGroupeId($g_id)
    {
        $this->groupe_id=$g_id;
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
    public function setVisibilite($g_visi)
    {
        $this->groupe_visibilite=$g_visi;
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


    /* Renvoie les infos d'un sondage en fonction de son id*/

    public function getInfosGroupe($id_g)
    {
        $sql="SELECT * FROM groupe WHERE groupe_id=?";
        $tuple = $this->executerRequete($sql,array($id_g));
        return $tuple->fetchAll();
    }



}
















