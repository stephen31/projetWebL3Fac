<?php

require_once(ROOT . '/models/Model.php');

class Sondage extends Model
{

    // attributs
    private $sondage_id;
    private $ut_id;
    private $titre;
    private $texte_desc;
    private $sondage_droit;
    private $date_fin;
    private $type_methode;
    private $visibilite;
    private $groupe_id;
    private $option1;
    private $option2;
    private $option3;
    private $option4;
    private $option5;
    private $option6;
    private $option7;


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
        $this->sondage_id = -1;
        $this->ut_id =-1;
        $this->titre='';
        $this->texte_desc='';
        $this->sondage_droit=0;
        $this->date_fin='0000-00-00';
        $this->type_methode=0;
        $this->visibilite='';
        $this->groupe_id=-1;
        $this->option1='';
        $this->option2='';
        $this->option3='';
        $this->option4='';
        $this->option5='';
        $this->option6='';
        $this->option7='';
    }


    public function constructeurParametre($id_s)
    {
        $req = "SELECT * FROM sondage WHERE sondage_id=?";
        $res = $this->executerRequete($req,array($id_s));
        $result = $res->fetch(PDO::FETCH_ASSOC);;
        if($res->rowCount()==1)
        {
            $this->sondage_id = $result['sondage_id'];
            $this->ut_id =$result['ut_id'];
            $this->titre=$result['titre'];
            $this->texte_desc=$result['texte_desc'];
            $this->sondage_droit=$result['sondage_droit'];
            $this->date_fin=$result['date_fin'];
            $this->type_methode=$result['type_methode'];
            $this->visibilite=$result['visibilite'];
            $this->groupe_id=$result['groupe_id'];
        }
        else
        {
            $this->sondage_id = -1;
            $this->ut_id =-1;
            $this->titre='';
            $this->texte_desc='';
            $this->sondage_droit=0;
            $this->date_fin='0000-00-00';
            $this->type_methode=0;
            $this->visibilite='';
            $this->groupe_id=-1;
            $this->option1='';
            $this->option2='';
            $this->option3='';
            $this->option4='';
            $this->option5='';
            $this->option6='';
            $this->option7='';
        }
    }

    // Getters et setters

    public function getSondageId()
    {
        return $this->sondage_id;
    }
    public function getUtid()
    {
        return $this->ut_id;
    }
    public function getTitre()
    {
        return $this->titre;
    }
    public function getTexteDesc()
    {
        return $this->texte_desc;
    }
    public function getSondageDroit()
    {
        return $this->sondage_droit;
    }
    public function getDateFin()
    {
        return $this->date_fin;
    }
    public function getTypeMethode()
    {
        return $this->typeMethode;
    }
    public function getVisibilite()
    {
        return $this->visibilite;
    }
    public function getGroupeId()
    {
        return $this->groupe_id;
    }
    public function getOption1()
    {
        return $this->option1;
    }
    public function getOption2()
    {
        return $this->option2;
    }
    public function getOption3()
    {
        return $this->option3;
    }
    public function getOption4()
    {
        return $this->option4;
    }
    public function getOption5()
    {
        return $this->option5;
    }
    public function getOption6()
    {
        return $this->option6;
    }
    public function getOption7()
    {
        return $this->option7;
    }




    /*************************/


    public function setSondageId($si)
    {
        $this->sondage_id=$si;
    }
    public function setUtId($ui)
    {
        $this->ut_id=$ui;
    }

    public function setTitre($t)
    {
        $this->titre=$t;
    }
    public function setTexteDesc($td)
    {
        $this->texte_desc=$td;
    }
    public function setSondageDroit($sd)
    {
        $this->sondage_droit=$sd;
    }
    public function seDateFin($df)
    {
        $this->date_fin=$df;
    }
    public function setTypeMethode($tp)
    {
        $this->typeMethode=$tp;
    }
    public function setVisibilite($vs)
    {
        $this->visibilite=$vs;
    }
    public function setOption1($op1)
    {
        $this->option1=$op1;
    }
    public function setOption2($op2)
    {
        $this->option2=$op2;
    }
    public function setOption3($op3)
    {
        $this->option3=$op3;
    }
    public function setOption4($op4)
    {
        $this->option4=$op4;
    }
    public function setOption5($op5)
    {
        $this->option5=$op5;
    }
    public function setOption6($op6)
    {
        $this->option6=$op6;

    }
    public function setOption7($op7)
    {
        $this->option7=$op7;
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
    public function addSondage()
    {
        if(($this->groupe_id == -1))
        {

            $sql ='INSERT INTO sondage SET
            ut_id=?,
            titre=?,
            texte_desc=?,
            sondage_droit=?,
            date_fin=?,
            type_methode=?,
            visibilite=?,
            groupe_id=NULL';

            $res = $this->executerRequete($sql,array($this->ut_id,$this->titre,$this->texte_desc,$this->sondage_droit,$this->date_fin,$this->type_methode,$this->visibilite));
            if($res->rowCount() == 1)
            {
                return $this->getBdd()->lastInsertId();
            }
            else
            {
                return false;  
            }

        }
        else
        {
            $sql ='INSERT INTO sondage SET
            ut_id=?,
            titre=?,
            texte_desc=?,
            sondage_droit=?,
            date_fin=?,
            type_methode=?,
            visibilite=?,
            groupe_id=?
            ';

            $res = $this->executerRequete($sql,array($this->ut_id,$this->titre,$this->texte_desc,$this->sondage_droit,$this->date_fin,$this->type_methode,$this->visibilite,$this->groupe_id));

            if($res->rowCount() == 1)
            {
                return $this->getBdd()->lastInsertId();
            }
            else
            {
                return false;  
            }
        }
    }

    /* MISE A jour du sondage */

    public function updateSondage()
    {
        if(($this->groupe_id == -1))
        {
            $sql = 'UPDATE sondage SET
            ut_id=?,
            titre=?,
            texte_desc=?,
            sondage_droit=?,
            date_fin=?,
            type_methode=?,
            visibilite=?,
            groupe_id=NULL
            WHERE sondage_id = ?';

            $res = $this->executerRequete($sql,array($this->ut_id,$this->titre,
                $this->texte_desc,$this->sondage_droit,$this->date_fin,
                $this->type_methode,$this->visibilite,$this->sondage_id));
        //echo $this->groupe_id;

            return ($res->rowCount() == 1);
        }
        else
        {
           $sql = 'UPDATE sondage SET
           ut_id=?,
           titre=?,
           texte_desc=?,
           sondage_droit=?,
           date_fin=?,
           type_methode=?,
           visibilite=?,
           groupe_id=?
           WHERE sondage_id = ?';

           $res = $this->executerRequete($sql,array($this->ut_id,$this->titre,
            $this->texte_desc,$this->sondage_droit,$this->date_fin,
            $this->type_methode,$this->visibilite,$this->groupe_id,$this->sondage_id));

           return ($res->rowCount() == 1);
       }
   }


   public function addOption($opt)
   {
    $sql ='INSERT INTO sondagax.option SET
    sondage_id =?,
    titre=?';

    $res = $this->executerRequete($sql,array($this->sondage_id,$opt));
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


    // ajoute un votant a la table votant
public function addVotant($idV)
{
    $sql ='INSERT INTO votant SET
    sondage_id =?,
    ut_id=?';

    $res = $this->executerRequete($sql,array($this->sondage_id,$idV));
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

    // methode qui ajoute un moderateur au sondage
public function addModerateur($id_u)
{
    $sql='INSERT INTO moderateur_sondage SET
    ut_id=?,
    sondage_id=?';

    $res= $this->executerRequete($sql,array($id_u,$this->sondage_id));
    if($res->rowCount()==1)
    {

        return true;
    }
    else
    {
        return false;
    }
}
    // methode qui check si un utilisateur est moderateur d'un sondage
public function checkIsModerateur($id_u)
{   
    $sql="SELECT ut_id FROM moderateur_sondage WHERE ut_id=? and sondage_id=?";
    $tuple = $this->executerRequete($sql,array($id_u,$this->sondage_id));

    $result = $tuple->fetchAll();
    if(count($result)>0)
    {
        return 1;
    }
    return 0;
}

    // check si un moderateur a été definit pour le sondage

public function checkHaveModerateur($id_u)
{   
    $sql="SELECT * FROM moderateur_sondage WHERE sondage_id=?";
    $tuple = $this->executerRequete($sql,array($this->sondage_id));

    $result = $tuple->fetchAll();
    if(count($result)>0)
    {
        return true;
    }
    return false;
}

    // retire un votant a la table votant
public function deleteVotant($idV)
{
    $sql ='DELETE FROM votant WHERE
    sondage_id =? and
    ut_id=?';

    $res = $this->executerRequete($sql,array($this->sondage_id,$idV));
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

    // retire un mdoerateur a la table votant
public function deleteModerateur($idM)
{
    $sql ='DELETE FROM moderateur_sondage WHERE
    sondage_id =? and
    ut_id=?';

    $res = $this->executerRequete($sql,array($this->sondage_id,$idM));
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

    //check si deja dans la liste des personnes pouvant voter au sondage // retourne vrai si present dans votant , faux sinon
public function checkPseudoVotant($pseudo,$id_s)
{
        //echo $this->getSondageId();
    $sql="SELECT u.ut_id FROM votant v,utilisateur u WHERE u.ut_id=v.ut_id and u.ut_pseudo=? and v.sondage_id=?";
    $tuple = $this->executerRequete($sql,array($pseudo,$id_s));

    $result = $tuple->fetchAll();
    if(count($result)>0)
    {
        return true;
    }
    return false;
}


    // recupere les infos d'un utilisateur
    /*public function getUserInfosSondage($pseudo)
    {
        $sql="SELECT ut_id,ut_pseudo,ut_mail FROM utilisateur WHERE pseudo=?";
        $tuple = $this->executerRequete($sql,array($pseudo));
        return $tuple->fetchAll();

    }*/

    // recupere les infos d'un utilisateur participant a un sondage privé
    public function getUserInfosSondagePrive($id_s)
    {
        $sql="SELECT ut_id,ut_pseudo,ut_mail,sondage_id FROM utilisateur natural join votant WHERE sondage_id=?";
        $tuple = $this->executerRequete($sql,array($id_s));
        return $tuple->fetchAll();

    }

    // recupere les infos d'un utilisateur participant a un sondage privé
    public function getUserInfosModerateurSondage($id_s)
    {
        $sql="SELECT ut_id,ut_pseudo,ut_mail,sondage_id FROM utilisateur natural join moderateur_sondage WHERE sondage_id=?";
        $tuple = $this->executerRequete($sql,array($id_s));
        return $tuple->fetchAll();

    }

    // methode de recuperation des groupes
    public function getGroupe($utId)
    {
        $sql='SELECT * from groupe
        WHERE ut_id=?';

        $res = $this->executerRequete($sql,array($utId));

        return $res->fetchAll();
    }

    // verifie si une personne a deja participer au sondage ou non

    public function checkDejaVoter($utId,$id_s)
    {
        $sql='SELECT * FROM reponse
        WHERE ut_id=? and sondage_id=?';

        $res= $this->executerRequete($sql,array($utId,$id_s));
        if(count($res->fetchAll())>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	//fonstion qui renvoie vrai si le sondage appartient à un groupe
    public function checkSondageGroupe($id_s)
    {
        $sql='SELECT * FROM sondage
        WHERE sondage.groupe_id IS NOT NULL and sondage.sondage_id=?';

        $res = $this->executerRequete($sql,array($id_s));
        if(count($res->fetchAll())>0)
        {
            return true;
        }
        else
            return false;
    }
    //teste si le mec appartient au groupe
    public function checkAppartientGroupe($id_s,$id_u)
    {
        $sql='SELECT * FROM sondage s,groupe g,inscrit i 
        WHERE s.groupe_id=g.groupe_id and g.groupe_id=i.groupe_id and s.sondage_id=? and (i.ut_id=? or g.ut_id=?)';

        $res = $this->executerRequete($sql,array($id_s,$id_u,$id_u));
        if(count($res->fetchAll())>0)
        {
            return true;
        }
        else
            return false;
    }
    // fonction qui check si l'utilisateur est admin du sondage
    public function checkSondageAdmin($idS,$utId)
    {
        $sql='SELECT * FROM sondage
        WHERE sondage.ut_id=? and sondage.sondage_id=?';

        $res = $this->executerRequete($sql,array($utId,$idS));
        if(count($res->fetchAll())>0)
        {
            return true;
        }       
        else
            return false;
    }

    // fonction qui check si le sondage est privé

    public function checkSondagePrivate($id_s)
    {

        $sql='SELECT * FROM sondage
        WHERE sondage.sondage_id=? and sondage_droit=2';

        $res = $this->executerRequete($sql,array($id_s));

        //print_r($res->fetchAll());
        if(count($res->fetchAll())>0)
        {
            return true;
        }
        else
            return false;
    }


    public function checkDroitAccesSondagePrivee($id_u)
    {
        $sql='SELECT * FROM sondage,utilisateur
        WHERE sondage.ut_id=? and sondage.sondage_id=?';

        $res = $this->executerRequete($sql,array($id_u,$this->sondage_id));
        if(count($res->fetchAll())>0)
        {
            return true;
        }       
        else
            return false;
    }

	//check si le sondage est plublic
    public function checkPublic($id_s)
    {
        $sql='SELECT * FROM sondage
        WHERE sondage.sondage_id=? and sondage_droit=0';

        $res = $this->executerRequete($sql,array($id_s));

        //print_r($res->fetchAll());
        if(count($res->fetchAll())>0)
        {
            return true;
        }
        else
            return false;
    }

    // fonction qui recupere les options du sondage
    public function getOptions($idS)
    {
        $sql='SELECT * FROM `option` WHERE sondage_id=? ORDER BY `option`.option_id';

        $res = $this->executerRequete($sql,array($idS));
        return $res->fetchAll();
    }


    // fonctions qui recupere les infos d'un sondage
    public function getInfosSondage($idS)
    {
        $sql='SELECT * FROM sondage
        WHERE sondage_id =?';

        $res = $this->executerRequete($sql,array($idS));
        return $res->fetchAll();
    }

    // fonctions qui recupere les sondages au quel un utilisateur a deja voter
    public function getSondagesRepondus($utId)
    {
        $sql='SELECT DISTINCT  s.sondage_date_create,s.sondage_id, s.ut_id, s.titre, s.texte_desc, s.sondage_droit, s.date_fin, s.type_methode, s.visibilite, s.groupe_id, u.ut_nom, u.ut_prenom
        FROM reponse r,sondage s,utilisateur u
        WHERE s.sondage_id=r.sondage_id and u.ut_id=r.ut_id and u.ut_id =?';

        $res = $this->executerRequete($sql,array($utId));
        return $res->fetchAll();
    }

	// methode qui renvoie les sondages public
    public function getSondagesPublic()
    {
        $sql ='SELECT * FROM
        sondage 
        natural join utilisateur 
        WHERE sondage_droit=0 and groupe_id IS NULL ORDER BY sondage_id desc';


        $sondage_pub=$this->executerRequete($sql,array());
        return ($sondage_pub->fetchAll());
    }


    // methode qui renvoie les sondages auquel l'utilisateur peut participer ordonner par ordre d'insertion (dont la date de fin n'est pas depassée et oter de ce qu'il a crée lui même
    //et ceux qu'il n'a pas repondu)
    public function getSondagesUserConnect($id_ut)
    {
        $sql ='SELECT DISTINCT  s.sondage_date_create,s.sondage_id, s.ut_id, s.titre, s.texte_desc, s.sondage_droit, s.date_fin, s.type_methode, s.visibilite, s.groupe_id, u.ut_nom, u.ut_prenom
        FROM sondage s natural join utilisateur u
        WHERE s.date_fin >= NOW() AND s.ut_id<>? AND (((s.sondage_droit=0 AND s.groupe_id IS NULL) OR (s.sondage_droit=1 AND s.groupe_id IS NULL)
            OR EXISTS(SELECT * FROM votant v WHERE s.sondage_id=v.sondage_id AND v.ut_id=? ) 
            OR EXISTS(SELECT * FROM groupe g WHERE s.groupe_id=g.groupe_id AND(g.ut_id=? OR EXISTS( SELECT * FROM inscrit i WHERE g.groupe_id=i.groupe_id AND i.ut_id=?))) ) 
AND NOT EXISTS ( SELECT * FROM reponse r WHERE r.ut_id=? AND r.sondage_id=s.sondage_id))
ORDER BY s.sondage_date_create desc';

$sondage_pub=$this->executerRequete($sql,array($id_ut,$id_ut,$id_ut,$id_ut,$id_ut));
return ($sondage_pub->fetchAll());
}
    // pour n'afficher que 5 sondage sur la page d'accueil dont la date de fin n'est pas depassée
public function getSondagesUserConnectAccueuil($id_ut)
{
    $sql ='SELECT DISTINCT  s.sondage_date_create,s.sondage_id, s.ut_id, s.titre, s.texte_desc, s.sondage_droit, s.date_fin, s.type_methode, s.visibilite, s.groupe_id, u.ut_nom, u.ut_prenom
    FROM sondage s natural join utilisateur u 
    WHERE s.date_fin >= NOW() AND s.ut_id<>? AND (( (s.sondage_droit=0 AND s.groupe_id IS NULL) OR (s.sondage_droit=1 AND s.groupe_id IS NULL) 
        OR EXISTS(SELECT * FROM votant v WHERE s.sondage_id=v.sondage_id AND v.ut_id=? ) 
        OR EXISTS(SELECT * FROM groupe g WHERE s.groupe_id=g.groupe_id AND(g.ut_id=? OR EXISTS( SELECT * FROM inscrit i WHERE g.groupe_id=i.groupe_id AND i.ut_id=?))) ) 
AND NOT EXISTS ( SELECT * FROM reponse r WHERE r.ut_id=? AND r.sondage_id=s.sondage_id)) 
ORDER BY s.sondage_date_create desc LIMIT 5';


$sondage_pub=$this->executerRequete($sql,array($id_ut,$id_ut,$id_ut,$id_ut,$id_ut));
return ($sondage_pub->fetchAll());
} 
    //methode qui renvoie les sondages dont la date de fin est depassée afin de connaitre le resultat (pas encore utilisée)
public function getSondagesFinisConnect($id_ut)
{
    $sql ='SELECT DISTINCT  s.sondage_date_create,s.sondage_id, s.ut_id, s.titre, s.texte_desc, s.sondage_droit, s.date_fin, s.type_methode, s.visibilite, s.groupe_id, u.ut_nom, u.ut_prenom
    FROM sondage s natural join utilisateur u
    WHERE s.date_fin < NOW() AND ((s.ut_id=? OR s.sondage_droit=0 OR s.sondage_droit=1 
        OR EXISTS(SELECT * FROM votant v WHERE s.sondage_id=v.sondage_id AND v.ut_id=? ) 
        OR EXISTS(SELECT * FROM groupe g WHERE s.groupe_id=g.groupe_id AND(g.ut_id=? OR EXISTS( SELECT * FROM inscrit i WHERE g.groupe_id=i.groupe_id AND i.ut_id=?))) ) 
AND NOT EXISTS ( SELECT * FROM reponse r WHERE r.ut_id=? AND r.sondage_id=s.sondage_id)) 
ORDER BY s.sondage_id desc';


$sondage_pub=$this->executerRequete($sql,array($id_ut,$id_ut,$id_ut,$id_ut,$id_ut));
return ($sondage_pub->fetchAll());
} 
public function getSondagesFinisNonConnect()
{
	$sql='SELECT s.sondage_date_create,s.sondage_id, s.ut_id, s.titre, s.texte_desc, s.sondage_droit, s.date_fin, s.type_methode, s.visibilite, s.groupe_id, u.ut_nom, u.ut_prenom 
	FROM sondage s natural join utilisateur u WHERE s.sondage_droit=0 and s.date_fin<NOW()';
	
	$sondage_pub=$this->executerRequete($sql,array());
	return ($sondage_pub->fetchAll());
}


    //methode qui renvoie les sondages crees par un utilisateur
public function getSondagesCres($id)
{
    $sql='SELECT DISTINCT  s.sondage_date_create,s.sondage_id, s.ut_id, s.titre, s.texte_desc, s.sondage_droit, s.date_fin, s.type_methode, s.visibilite, s.groupe_id, u.ut_nom, u.ut_prenom,moderateur_sondage.ut_id as idModerateur
    FROM sondage s natural join utilisateur u
    LEFT JOIN moderateur_sondage ON moderateur_sondage.sondage_id = s.sondage_id
    WHERE s.ut_id=?
    ORDER BY s.sondage_date_create DESC';

    $sondage_pub=$this->executerRequete($sql,array($id));
    return ($sondage_pub->fetchAll());

}
/* Ajout des reponses */
public function addReponse($id_s,$id_ut,$array)
{
    $opts=$this->getOptions($id_s);
        $this->beginTransaction(); // demarrage d'une transaction
        foreach ($array as $key => $value)
        {
            $id_opt=0;
            foreach($opts as $opt)
            {
                if($opt['titre']===$key)
                {
                    $id_opt=$opt['option_id'];
                }
            }
            $sql ='INSERT INTO reponse SET
            sondage_id =?,
            ut_id=?,
            option_id=?,
            rang=?';
            $res = $this->executerRequete($sql,array($id_s,$id_ut,$id_opt,$value));
            if($res->rowcount()==0) // si aucune ligne affecter par la requete alors on rollback et on return faux
            {
                $this->rollback();
                return false;
            }
        }
        $this->commit();//on valide toute les insertions de reponse
        return true;

    }

    public function addReponseAnonyme($id_s,$array)
    {
        $opts=$this->getOptions($id_s);
        $this->beginTransaction(); // demarrage d'une transaction
        foreach ($array as $key => $value)
        {
            $id_opt=0;
            foreach($opts as $opt)
            {
                if($opt['titre']===$key)
                {
                    //echo "yea";
                    $id_opt=$opt['option_id'];
                }
            }
            $sql ='INSERT INTO reponseanonyme SET
            sondage_id =?,
            option_id=?,
            rang=?';
            $res = $this->executerRequete($sql,array($id_s,$id_opt,$value));
            if($res->rowcount()==0) // si aucune ligne affecter par la requete alors on rollback et on return faux
            {
                $this->rollback();
                return false;
            }
        }
        $this->commit(); // on valide toute les insertions de reponse
        return true;

    }


     /* renvoie tout les commentaires d'un sondage */

    public function getAllCommentaire()
    {
        $sql='SELECT u.ut_pseudo,u.ut_id,s.sondage_id,c.commentaire_date,c.soutien,c.texte,c.com_id 
        FROM commentaire c,sondage s ,utilisateur u 
        WHERE s.sondage_id=? and c.ut_id=u.ut_id and s.sondage_id = c.sondage_id and c.com_parent_id IS NULL
        ORDER BY c.soutien DESC';
        $allcommentaires=$this->executerRequete($sql,array($this->sondage_id));
        return ($allcommentaires->fetchAll());
    }

    /* renvoie tout les Sous commentaires d'un sondage */

    public function getAllSousCommentaire()
    {
        $sql='SELECT u.ut_pseudo,u.ut_id,s.sondage_id,c.commentaire_date,c.soutien,c.texte,c.com_id,c.com_parent_id 
        FROM commentaire c,sondage s ,utilisateur u 
        WHERE s.sondage_id=? and c.ut_id=u.ut_id and s.sondage_id = c.sondage_id and c.com_parent_id IS NOT NULL
        ORDER BY c.soutien DESC';
        //echo $this->sondage_id;
        $allSubcommentaires=$this->executerRequete($sql,array($this->sondage_id));
        return ($allSubcommentaires->fetchAll());
    }



    public function borda($id_s)
    {
        $sond=new Sondage();
        $sond->constructeurParametre($id_s);
        $opts=$this->getOptions($id_s);
        $tab=array(array());;
        $k=1;
        $id;
		$mafonction;
        foreach($opts as $opt)
        {
            $mafonction="setOption".$k;
            $sond->$mafonction($opt['titre']);
            $k++;
        }
        for($i=0 ; $i<sizeof($opts) ; $i++)
        {
          $tab[$i][sizeof($opts)]=0;
          for($j=0 ; $j<=sizeof($opts) ; $j++)
          {
            $k=$i+1;
            $mafonction="getOption".$k;
            foreach($opts as $opt)
            {
                if($opt['titre']===$sond->$mafonction())
                {
                    $id=$opt['option_id'];
                }
            }           
            $sql1="SELECT COUNT(*) as nb FROM reponse WHERE rang= ($j+1) and option_id=$id and sondage_id=?";
            $res1=$this->executerRequete($sql1,array($id_s));
            $resul1=$res1->fetch();
            $resultat1=$resul1['nb'];
            
            $sql2="SELECT COUNT(*) as nb FROM reponseanonyme WHERE rang= ($j+1) and option_id=$id and sondage_id=?";
            $res2=$this->executerRequete($sql2,array($id_s));
            $resul2=$res2->fetch();
            $resultat2=$resul2['nb'];
            
            $resultat=$resultat1+$resultat2;    

            $tab[$i][$j]=$resultat;
			}
        }
        for($i=0 ; $i<sizeof($opts) ; $i++)
        {
            $k=sizeof($opts);
            for($j=0 ; $j<=sizeof($opts) ; $j++)
            {
                $tab[$i][sizeof($opts)]+=$tab[$i][$j] * $k;
                $k--;
            }
            
        }
        return $tab;
    }



}
















