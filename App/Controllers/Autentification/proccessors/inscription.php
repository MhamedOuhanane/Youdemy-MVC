<?php

require "../../../../vendor/autoload.php";
use App\Controllers\Autentification\Users;
use App\Models\RolesModels;

    if (isset($_POST['submitInscr'])) {
        $role = $_POST['role'];
        $RolesModels = new RolesModels();
        $roles = $RolesModels->ObjectsRoles();
        foreach ($roles as $value) {
            if ($value->getData('role') == $role) {
                $id_role = $value->getData('id_role');
            }
        }
        
        if ($role) {
            if ($role == 'Enseignant') {
                $status = 'En Vérification';
            } else {
                $status = 'Activé';
            }
        }
        if ($_FILES['profile_image']['size'] > 0) {
            $image = file_get_contents($_FILES['profile_image']['tmp_name']);
        } else {
            $defoultImage = "../../../../Public/assets/images/user.jpg";
            $image = file_get_contents($defoultImage);
        }

        $ArrayUser = [
            'username' => $_POST['username'],
            'email' => $_POST['emailInscr'],
            'ville' => $_POST['city'],
            'telephone' => $_POST['telephone'],
            'image' => $image,
            'password' => $_POST['password'],
            'status' => $status,
            'id_role' => $id_role,
        ];
        $user = new Users($ArrayUser);
        
        $user->Inscription();
    }
