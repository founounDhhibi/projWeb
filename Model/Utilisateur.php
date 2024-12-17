<?PHP

	class Utilisateur{
		private $id_user = null;
		private $nom_user = null ;
		private $prenom_user = null; 
		private $email_user = null;
		private $tel_user = null;
		private $adresse_user = null ;
		private $username = null ;
		private $password_user = null ;
		private $role_user = null ;


		function __construct(string $nom_user, string $prenom_user, String $email_user, int $tel_user, string $adresse_user, 
			string $username, string $password_user, string $role_user)
		{
			$this->nom_user = $nom_user ;
			$this->prenom_user = $prenom_user ; 
			$this->email_user = $email_user ;
			$this->tel_user = $tel_user ;
			$this->adresse_user = $adresse_user ;
			$this->username = $username ;
			$this->password_user = $password_user ;
			$this->role_user = $role_user ;
		}

		//-------------------GETTERS-----------------
		function getIdUser(): int{
			return $this->id_user;
		}
		function getNomUser(): string{
			return $this->nom_user;
		}
		function getPrenomUser(): string{
			return $this->prenom_user;
		}
		function getEmailUser(): string{
			return $this->email_user;
		}
		function getTelUser(): int{
			return $this->tel_user;
		}   
		function getAdresseUser(): string{
			return $this->adresse_user;
		}
		function getUsername(): string{
			return $this->username;
		}   
		function getPasswordUser(): string{
			return $this->password_user;
		}
		function getRoleUser(): string{
			return $this->role_user;
		}

		//---------------SETTERS-------------------
		function setNomUser(string $nom_user): void {
			$this->nom_user = $nom_user;
		}
		function setPrenomUser(string $prenom_user): void{
			$this->prenom_user = $prenom_user;
		}
		function setEmailUser(string $email_user): void{
			$this->email_user = $email_user;
		}
		function setTelUser(int $tel_user): void{
			$this->tel_user = $tel_user;
		}   
		function setAdresseUser(string $adresse_user): void{
			$this->adresse_user = $adresse_user;
		}
		function setUsername(string $username): void{
			$this->username = $username;
		}
		function setPasswordUser(string $password_user): void{
			$this->password_user = $password_user;
		}
		function setRoleUser(string $role_user): void{
			$this->role_user = $role_user;
		}   
	}
?>