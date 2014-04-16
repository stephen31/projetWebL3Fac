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

    public function getGroupePublicAndPrive()
    {
        $sql='SELECT * from groupe
        WHERE groupe_droit=0 or groupe_droit=1';

        $res = $this->executerRequete($sql,array());

        return $res->fetchAll();
    }

    /* accesseurs a tous les groupes ou l'utilisateur connecter n'y est pas inscrit*/
    public function getGroupePublicAndPriveNotIn($idU)
    {
        $sql='SELECT DISTINCT groupe.groupe_id,groupe_nom,groupe_desc,groupe_droit,groupe_date_creation from groupe
        WHERE groupe.groupe_id NOT IN (SELECT groupe_id FROM inscrit WHERE inscrit.ut_id=?) and groupe_droit <>2;';

        $res = $this->executerRequete($sql,array($idU));

        return $res->fetchAll();
    }


    /* get groupe privee */
    public function getGroupesCrees($idU)
    {
        $sql='SELECT * from groupe
        WHERE ut_id=?';

        $res = $this->executerRequete($sql,array($idU));

        return $res->fetchAll();
    }

    /* get groupe privee */
    public function getGroupesActifs($idU)
    {
        $sql='SELECT * from groupe,inscrit
        WHERE groupe.groupe_id = inscrit.groupe_id and inscrit.ut_id=?';

        $res = $this->executerRequete($sql,array($idU));

        return $res->fetchAll();
    }


    /* ajout d'un inscrit au groupe public inscrit  */

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

    /* ajout d'un inscrit au groupe public et privee */

    public function addInscrit2($idU)
    {
        $sql ='INSERT INTO inscrit SET
        groupe_id=?,
        ut_id=?,
        inscrit_valide=1';
        

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

    // fonction qui check si l'utilisateur est admin du groupe
    public function checkGroupeAdmin($utId)
    {
        $sql='SELECT * FROM groupe
        WHERE groupe.ut_id=? and groupe.groupe_id=?';

        $res = $this->executerRequete($sql,array($utId,$this->groupe_id));
        if(count($res->fetchAll())>0)
        {
            return true;
        }       
        else
            return false;
    }

    // check si un groupe est public inscrit
    public function checkGroupePublic()
    {

        $sql='SELECT * FROM groupe
        WHERE groupe.groupe_id=? and groupe_droit=0';

        $res = $this->executerRequete($sql,array($this->groupe_id));

        //print_r($res->fetchAll());
        if(count($res->fetchAll())>0)
        {
            return true;
        }
        else
            return false;
    }

    // check si un groupe est privee
    public function checkGroupePrivate()
    {

        $sql='SELECT * FROM groupe
        WHERE groupe.groupe_id=? and groupe_droit=2';

        $res = $this->executerRequete($sql,array($this->groupe_id));

        //print_r($res->fetchAll());
        if(count($res->fetchAll())>0)
        {
            return true;
        }
        else
            return false;
    }

    // check si un groupe est public inscrit
    public function checkGroupePublicInscrit()
    {

        $sql='SELECT * FROM groupe
        WHERE groupe.groupe_id=? and groupe_droit=1';

        $res = $this->executerRequete($sql,array($this->groupe_id));

        //print_r($res->fetchAll());
        if(count($res->fetchAll())>0)
        {
            return true;
        }
        else
            return false;
    }

    // fonction qui check si le groupe a des moderateur
    public function checkHaveModerateur()
    {
        $sql='SELECT * FROM groupe,moderateur_groupe
        WHERE groupe.groupe_id=moderateur_groupe.groupe_id and groupe.groupe_id=?';

        $res = $this->executerRequete($sql,array($this->groupe_id));
        if(count($res->fetchAll())>0)
        {
            return true;
        }       
        else
            return false;
    }

    // check si un utilisateur est dans un groupe privee
    public function isInGroupePrivate($id_u)
    {
        $sql='SELECT * FROM inscrit,groupe
        WHERE inscrit.groupe_id = groupe.groupe_id and inscrit.ut_id=? and inscrit.groupe_id=? and groupe.groupe_droit=2';

        $res = $this->executerRequete($sql,array($id_u,$this->groupe_id));
        if(count($res->fetchAll())>0)
        {
            return true;
        }       
        else
            return false;
    }


    /* tous les sondages d'un groupe*/
    public function getAllSondagesGroupe()
    {
        $sql='SELECT * from groupe natural join sondage WHERE groupe.groupe_id=?';

        $res = $this->executerRequete($sql,array($this->groupe_id));

        return $res->fetchAll();
    }


    /* tous les utilisateurs d'un groupe*/
    public function getUserInscrit()
    {
        $sql='SELECT DISTINCT utilisateur.ut_id,utilisateur.ut_id,utilisateur.ut_pseudo from inscrit natural join utilisateur WHERE inscrit.groupe_id=? and inscrit.inscrit_valide=1';

        $res = $this->executerRequete($sql,array($this->groupe_id));

        return $res->fetchAll();
    }

    /* toute les demandes utilisateurs d'un groupe*/
    public function getUserDemande()
    {
        $sql='SELECT * from inscrit natural join utilisateur WHERE inscrit.groupe_id=? and inscrit_valide=0';

        $res = $this->executerRequete($sql,array($this->groupe_id));

        return $res->fetchAll();
    }

    /* createur d'un groupe*/
    public function getCreateurGroupe()
    {
        $sql='SELECT utilisateur.ut_pseudo from groupe natural join utilisateur WHERE groupe.groupe_id=?';

        $res = $this->executerRequete($sql,array($this->groupe_id));

        return $res->fetchAll();
    }

    // check si un utilisateur est moderateur du groupe
    public function checkModerateur($id_u)
    {
        $sql="SELECT ut_id FROM moderateur_groupe WHERE ut_id=? and groupe_id=?";
        $tuple = $this->executerRequete($sql,array($id_u,$this->groupe_id));

        $result = $tuple->fetchAll();
        if(count($result)>0)
        {
            return 1;
        }
        return 0;
    }


    // check si un utilisateur est dans le groupe
    public function checkIsInGroupe($id_u)
    {
        $sql='SELECT * FROM inscrit
        WHERE groupe_id = ? and ut_id=? and inscrit_valide=1';

        $res = $this->executerRequete($sql,array($this->groupe_id,$id_u));
        if(count($res->fetchAll())>0)
        {
            return true;
        }       
        else
            return false;
    }

    // check si un utilisateur est dans le groupe
    public function checkIsInGroupeAttente($id_u)
    {
        $sql='SELECT * FROM inscrit
        WHERE groupe_id = ? and ut_id=? and inscrit_valide=0';

        $res = $this->executerRequete($sql,array($this->groupe_id,$id_u));
        if(count($res->fetchAll())>0)
        {
            return true;
        }       
        else
            return false;
    }


    // retire un inscrit a la table inscrit
    public function deleteInscrit($idU)
    {
        $sql ='DELETE FROM inscrit WHERE
        groupe_id =? and
        ut_id=?';

        $res = $this->executerRequete($sql,array($this->groupe_id,$idU));
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


    // retire un moderateur a la table moderateur
    public function deleteModerateur($idU)
    {
        $sql ='DELETE FROM moderateur_groupe WHERE
        groupe_id =? and
        ut_id=?';

        $res = $this->executerRequete($sql,array($this->groupe_id,$idU));
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

    public function validationInscrit($idU)
    {
        $sql = 'UPDATE inscrit SET
        inscrit_valide=1
        WHERE groupe_id = ? and ut_id=?';

        $res = $this->executerRequete($sql,array($this->groupe_id,$idU));
        return $res;
    }


        // methode qui ajoute un moderateur au groupe
    public function addModerateur($id_u)
    {

        $sql='INSERT INTO moderateur_groupe SET
        ut_id=?,
        groupe_id=?';

        $res= $this->executerRequete($sql,array($id_u,$this->groupe_id));

        if($res->rowCount()==1)
        {
            return true;
        }
        else
            return false;
    }
    // recupere les infos d'un utilisateur participant a un sondage privé
    public function getUserInfosModerateurGroupe($id_g)
    {
        $sql="SELECT ut_id,ut_pseudo,ut_mail,groupe_id FROM utilisateur natural join moderateur_groupe WHERE groupe_id=?";
        $tuple = $this->executerRequete($sql,array($id_g));
        return $tuple->fetchAll();

    }




}
















