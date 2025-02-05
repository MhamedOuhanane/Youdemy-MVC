<?php
    namespace App\Controllers\Autentification;

use App\Models\Requites;
use App\Models\RolesModels;
use App\Models\UsersModels;

    class Users{
        protected $id_user;
        protected $username;
        protected $email;
        protected $ville;
        protected $telephone;
        protected $image;
        protected $password;
        protected $status;
        protected $id_role;

        public function __construct($ArrayUser)
                {
                    $this->id_user = $ArrayUser['id_user'] ?? null;
                    $this->username = $ArrayUser['username'] ?? null;
                    $this->email = $ArrayUser['email'] ?? null;
                    $this->ville = $ArrayUser['ville'] ?? null;
                    $this->telephone = $ArrayUser['telephone'] ?? null;
                    $this->image = $ArrayUser['image'] ?? null;
                    $this->password = $ArrayUser['password'] ?? null;
                    $this->status = $ArrayUser['status'] ?? null;
                    $this->id_role = $ArrayUser['id_role'] ?? null;
                }

        public function Inscription() {
            $requite = new Requites();
            $users = $requite->selectWhere('users', 'email', $this->email);
            if ($users == NULL) {
                $password = password_hash($this->password, PASSWORD_BCRYPT);
                $utilisateur = [
                    'username' =>$this->username,
                    'email' =>$this->email,
                    'password' =>$password,
                    'telephone' => $this->telephone,
                    'ville' => $this->ville,
                    'image' => pg_escape_bytea($this->image),
                    'status' => $this->status,
                    'id_role' =>$this->id_role
                ];            

                $result = $requite->insertData('users', $utilisateur);
                if ($result) {
                    $message = "Le compts a ete crée avec succés.";
                    header('Location:  ../../../Views/Authentification/connexion.php?message='.$message);
                    exit;
                }
                
            } else {
                $erreur = "Ce compts est déjat éxicte .";
                header('Location: ../../../Views/Authentification/inscription.php?erreur='.$erreur);
                exit;
            }
        }

        public function connexion() {
            $UsersModels = new UsersModels();
            $RolesModels = new RolesModels();
            $users = $UsersModels->ObjectsUsers('email', $this->email);
            $roles = $RolesModels->ObjectsRoles('id_role', $users[0]->id_role);
            
            if ($users != NULL) {
                
                if ($users[0]->status == 'Activé') {
                    if (password_verify($this->password , $users[0]->password)) {
                        $image = stream_get_contents($users[0]->image);
                        session_start();
                        $_SESSION['id_user'] = $users[0]->id_user;
                        $_SESSION['username'] = $users[0]->username;
                        $_SESSION['email'] = $users[0]->email;
                        $_SESSION['telephone'] = $users[0]->telephone;
                        $_SESSION['image'] = base64_encode($image);
                        $_SESSION['ville'] = $users[0]->ville;
                        $_SESSION['role'] = $roles[0]->getData('role');
                        header("Location: ../../../../Public/index.php");
                    } else {
                        $erreur = 'Le mot de pas est inccorect . ';
                        header("Location: ../../../Views/Authentification/connexion.php?erreur=$erreur");
                        exit;
                    }
                } else if ($users[0]->status == 'En Vérification') {
                    $erreur = "Votre compte n'a pas encore été vérifié par l'administrateur, veuillez patienter.";
                    header("Location: ../../../Views/Authentification/connexion.php?erreur=$erreur");
                    exit;
                } else if ($users[0]->status == 'Suspendu') {
                    $erreur = "Votre compte a été suspendu. Veuillez patienter, votre compte sera activé prochainement.";
                    header("Location: ../../../Views/Authentification/connexion.php?erreur=$erreur");
                    exit;
                }
            } else {
                $erreur = 'Cette Compts n\'existe pas .';
                header("Location: ../../../Views/Authentification/connexion.php?erreur=$erreur");
                exit;
            }
        }
                
    }