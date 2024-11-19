<?php

    include_once '../../config.php';
    require_once '../../Model/Utilisateur.php';

    class UtilisateurC{
		// CRUD
        public function afficher_Utilisateur(){
			$sql="SELECT * FROM utilisateurs" ;
            $db = config::getConnexion() ;
            try {
                $liste = $db->query($sql) ;
                return $liste ;
            }
            catch(Exception $e) {
                die('Erreur:' .$e->getMessage()) ;
            }
        }
 
		function ajouter_Utilisateur($Utilisateur){
			$sql="INSERT INTO utilisateurs (nom_user,prenom_user,email_user,tel_user,adresse_user,
					username,password_user,role_user) 
				VALUES (:nom_user,:prenom_user,:email_user,:tel_user,:adresse_user,
					:username,:password_user,:role_user)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
			
				$query->execute([
					'nom_user' => $Utilisateur->getNomUser(),
					'prenom_user' => $Utilisateur->getPrenomUser(),
					'email_user' => $Utilisateur->getEmailUser(),
					'tel_user' => $Utilisateur->getTelUser(),
					'adresse_user' => $Utilisateur->getAdresseUser(), 
					'username' => $Utilisateur->getUsername(),
					'password_user' => $Utilisateur->getPasswordUser(),
					'role_user' => $Utilisateur->getRoleUser()
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}

		function supprimer_Utilisateur($id_user){
			$sql="DELETE FROM utilisateurs WHERE id_user= :id_user";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id_user',$id_user);
			try{
				$req->execute();
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
        }

		function modifier_Utilisateur($utilisateur, $id_user){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					"UPDATE utilisateurs SET 
						nom_user = :nom_user, 
						prenom_user = :prenom_user, 
						email_user = :email_user, 
						tel_user = :tel_user,
						adresse_user = :adresse_user, 
						username = :username, 
						password_user = :password_user, 
						role_user = :role_user
					WHERE id_user = :id_user"
                );
                
                $query->execute([
                    'id_user' => $id_user,
					'nom_user' => $utilisateur->getNomUser(), 
					'prenom_user' => $utilisateur->getPrenomUser(), 
					'email_user' => $utilisateur->getEmailUser(), 
					'tel_user' => $utilisateur->getTelUser(), 
					'adresse_user' => $utilisateur->getAdresseUser(), 
					'username' => $utilisateur->getUsername(), 
					'password_user' => $utilisateur->getPasswordUser(), 
					'role_user' => $utilisateur->getRoleUser()
				]);		
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

        function getUtilisateurbyId($id)
        {
            $requete = "select * from utilisateurs where id_user= '".$id."'";
            $config = config::getConnexion();
            try {
                $querry = $config->prepare($requete);
                $querry->execute();
                $result = $querry->fetch();
                return $result ;
            } catch (PDOException $th) {
                echo $th->getMessage();
            }
        }





    }
?>