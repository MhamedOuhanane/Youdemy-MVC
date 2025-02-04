<?php

use App\Controllers\Roles;

    $roles = new Roles();

    if (isset($_POST['submitInscr'])) {
        $id_role = null;
        if ($_POST['role']) {
            $roles->setData($_POST['role']);
            $id_role = $roles->getData()['id_role'];
            if ($_POST['role'] == 'Enseignant') {
                $status = 'En Vérification';
            } else if ($_POST['role'] == 'Etudiant') {
                $status = 'Activé';
            }
        }

        if ($_FILES['profile_image']['size'] > 0) {
            $image = file_get_contents($_FILES['profile_image']['tmp_name']);
        } else {
            $defoultImage = '../../../assets/images/user.jpg';
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
            'role' => $_POST['role']
        ];

        $user = new Users($ArrayUser);
        
        $user->Inscription();
    }