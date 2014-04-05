<?php
abstract class Model{

		private $bdd; // objet d'acces a la bdd

	// Exécute une requête SQL éventuellement paramétrée
		protected function executerRequete($sql, $params = null) 
		{
			if ($params == null) 
			{
				$resultat = $this->getBdd()->query($sql);    // exécution directe
			}
			else 
			{
				$resultat = $this->getBdd()->prepare($sql);  // requête préparée
				$resultat->execute($params);
			}

			return $resultat;
		}

		protected function getBdd() {
			if ($this->bdd == null) {
      		// Création de la connexion
				try
				{
					$this->bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
						DB_USERNAME, DB_PASSWD);
				}
				catch(Exception $e)
				{
					die('Erreur: '.$e->getMessage());
				}
			}
			return $this->bdd;
		}


		// demarre une transaction
		public function beginTransaction(){
			$this->getBdd()->beginTransaction();
		}

		// envoie la/les requettes 
		public function commit()
		{
			$this->getBdd()->commit();
		}

		// Annuler le commit
		public function rollback(){
			$this->getBdd()->rollback();
		}

		// Ajout d'un tuple dans la table , retourne l'identifiant de cette ligne Retourne l'erreur si probleme a l'ajout de la ligne
		protected function addTuple($sql, $params)
		{
			$res = $this->getBdd()->prepare($sql);  // requête préparée

			if ($res->execute($params)) {   
				return $this->getBdd()->lastInsertId(); // Identifiant ajouté
			}

			return $res->errorInfo(); // Message d'erreur
		}

		abstract public function POSTToVar($array);




	}

	?>