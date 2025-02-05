<?php
    namespace App\Controllers\Autentification;

use App\Models\Requites;
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
            $users = $UsersModels->ObjectsUsers('email', $this->email);
            $role = 'Admine';
            
            
            // if ($users != NULL) {
            //     if ($users['status'] == 'Activé') {
            //         if (password_verify($this->password , $users['password'])) {
            //             session_start();
            //             $this->id_role = $users[0]->id_r;
            //             $_SESSION['id_user'] = $users['id_user'];
            //             $_SESSION['username'] = $users['username'];
            //             $_SESSION['email'] = $users['email'];
            //             $_SESSION['telephone'] = $users['telephone'];
            //             $_SESSION['image'] = base64_encode($users['image']);
            //             $_SESSION['ville'] = $users['ville'];
            //             $_SESSION['role'] = $role;
            //         } else {
            //             $erreur = 'Le mot de pas est inccorect . ';
            //             header("Location: ../connexion.php?erreur=$erreur");
            //             exit;
            //         }
            //     } else if ($users['status'] == 'En Vérification') {
            //         $erreur = "Votre compte n'a pas encore été vérifié par l'administrateur, veuillez patienter.";
            //         header("Location: ../connexion.php?erreur=$erreur");
            //         exit;
            //     } else if ($users['status'] == 'Suspendu') {
            //         $erreur = "Votre compte a été suspendu. Veuillez patienter, votre compte sera activé prochainement.";
            //         header("Location: ../connexion.php?erreur=$erreur");
            //         exit;
            //     }
            // } else {
            //     $erreur = 'Cette Compts n\'existe pas .';
            //     header("Location: ../connexion.php?erreur=$erreur");
            //     exit;
            // }
        }
                
    }