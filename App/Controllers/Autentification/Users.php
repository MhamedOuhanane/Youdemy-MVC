<?php
    namespace App\Controllers;

    use App\Models\Requites;

    class Users extends Roles {
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
                    $requite = new Requites;
                    $users = $requite->selectWhere('users', 'email', $this->email);
                    if ($users == NULL) {
                        $password = password_hash($this->password, PASSWORD_BCRYPT);
                        $utilisateur = [
                            'username' =>$this->username,
                            'email' =>$this->email,
                            'password' =>$password,
                            'telephone' => $this->telephone,
                            'ville' => $this->ville,
                            'image' => $this->image,
                            'status' => $this->status,
                            'id_role' =>$this->id_role
                        ];            
                        
                        $result = $requite->insertData('users', $utilisateur);
                        if ($result) {
                            $message = "Le compts a ete crée avec succés.";
                            header('Location: ../connexion.php?message='.$message);
                            exit;
                        }
                        
                    } else {
                        $erreur = "Ce compts est déjat éxicte .";
                        header('Location: ../inscription.php?erreur='.$erreur);
                        exit;
                    }
                }
    }