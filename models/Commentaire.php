<?php

require_once(ROOT . '/models/Model.php');

class Commentaire extends Model
{

    // attributs
    private $com_id;
    private $com_parent_id;
    private $ut_id;
    private $sondage_id;
    private $soutien;
    private $texte;
    private $commentaire_date;

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
        $this->com_id = -1;
        $this->com_parent_id = -1;
        $this->ut_id =-1;
        $this->sondage_id=-1;
        $this->soutien=0;
        $this->commentaire_date='0000-00-00';
        $this->texte='';
    }


    public function constructeurParametre($id_c)
    {
        $req = "SELECT * FROM commentaire WHERE com_id=?";
        $res = $this->executerRequete($req,array($id_c));
        $result = $res->fetch(PDO::FETCH_ASSOC);;
        if($res->rowCount()==1)
        {
            $this->com_id = $result['com_id'];
            $this->com_parent_id = $result['com_parent_id'];
            $this->ut_id =$result['ut_id'];
            $this->sondage_id=$result['sondage_id'];
            $this->soutien=$result['soutien'];
            $this->commentaire_date=$result['commentaire_date'];
            $this->texte=$result['texte'];
        }
        else
        {
            $this->com_id = -1;
            $this->com_parent_id = -1;
            $this->ut_id =-1;
            $this->sondage_id=-1;
            $this->soutien=0;
            $this->commentaire_date='0000-00-00';
            $this->texte='';
        }
    }

    // Getters et setters

    public function getComId()
    {
        return $this->com_id;
    }

    public function getComParentId()
    {
        return $this->com_parent_id;
    }

    public function getUtid()
    {
        return $this->ut_id;
    }
    public function getSondageId()
    {
        return $this->sondage_id;
    }
    public function getSoutien()
    {
        return $this->soutien;
    }


    public function getComdate()
    {
        return $this->commentaire_date;
    }
    public function getTexte()
    {
        return $this->texte;
    }

    /*************************/

    public function setComId($idC)
    {
        $this->com_id=$idC;
    }

    public function setComParentId($idCp)
    {
        $this->com_parent_id=$idCp;
    }
    public function setUtid($idU)
    {
        $this->ut_id=$idU;
    }
    public function setSondageId($idS)
    {
        $this->sondage_id=$idS;
    }
    public function setSoutien($s)
    {
        $this->soutien = $s;
    }
    public function setComdate($comDate)
    {
        $this->commentaire_date=$comDate;
    }
    public function setTexte($t)
    {
        $this->texte =$t;
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

    public function getInfosCommentaire($id_c)
    {
        $sql="SELECT * FROM commentaire WHERE com_id=?";
        $tuple = $this->executerRequete($sql,array($id_c));
        return $tuple->fetchAll();
    }

    /* renvoie tout les commentaires d'un sondage */


    /* ajoute un commentaire renvoie l'id du commentaire rajouter*/

    public function addCommentaire()
    {
        $sql ='INSERT INTO commentaire SET
        com_parent_id=NULL,
        ut_id=?,
        sondage_id=?,
        soutien=0,
        texte=?';

        $res = $this->executerRequete($sql,array($this->ut_id,$this->sondage_id,$this->texte));
        if($res->rowCount() == 1)
        {
            return $this->getBdd()->lastInsertId();
        }
        else
        {
            return false;  
        }
    }


    /* ajoute un sous commentaire  renvoie l'id du sous-commentaire rajouter  */

    public function addSousCommentaire()
    {
        $sql ='INSERT INTO commentaire SET
        com_parent_id=?,
        ut_id=?,
        sondage_id=?,
        soutien=0,
        texte=?';

        $res = $this->executerRequete($sql,array($this->com_parent_id,$this->ut_id,$this->sondage_id,$this->texte));
        if($res->rowCount() == 1)
        {
            return $this->getBdd()->lastInsertId();
        }
        else
        {
            return false;  
        }
    }

    /* incremente le nombre de soutient d'un comentaire */
    public function addSoutien($comid,$utid)
    {
        $infosCom = $this->getInfosCommentaire($this->com_id);

        $nbSoutient = $infosCom[0]['soutien'];
        $this->beginTransaction(); // demarrage d'une transaction
        $sql = 'UPDATE commentaire SET
        soutien=?
        WHERE com_id = ?';

        $sql2 = 'INSERT INTO soutien SET utilisateur_id=?,commentaire_id=?';

        $res1 = $this->executerRequete($sql,array($nbSoutient+1,$this->com_id));
        $res2 = $this->executerRequete($sql2,array($utid,$this->com_id));
        if ($res1->rowCount() == 1 && $res2->rowCount()==1)
        {
            $this->commit();
            return true;
        }
        else
        {
            $this->rollback();
            return false;
        }
    }

    /*verifie si une personne a deja voter */
    public function checkDejaSoutenu($utid)
    {
        $sql='SELECT * FROM soutien
        WHERE soutien.commentaire_id=? and soutien.utilisateur_id=?';

        $res = $this->executerRequete($sql,array($this->com_id,$utid));
        //echo count($res->fetchAll());
        //print_r($res->fetchAll());
        if(count($res->fetchAll())>0)
        {
            return true;
        }
        else
            return false;
    }

    // retire un votant a la table votant
    public function deleteCommentaire($idc)
    {
        $sql ='DELETE FROM commentaire WHERE
        sondage_id =? and
        com_id=?';

        $res = $this->executerRequete($sql,array($this->sondage_id,$idc));
        //echo $this->sondage_id,$opt;
        if($res->rowCount()==1)
        {

            return true;
        }
        else
        {
            return false;
        }
    }


    /* Renvoie le nombre de commentaire*/

    public function getNbCommentaire($id_s)
    {
        $sql='SELECT count(com_id) FROM commentaire WHERE sondage_id=?';
        $tuple = $this->executerRequete($sql,array($id_s));
        return $tuple->fetchAll();
    }




}
















