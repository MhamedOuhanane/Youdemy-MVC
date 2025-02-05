<?php

use App\Controllers\Autentification\Users;

require "../../../../vendor/autoload.php";
    
    if ($_POST['submitConne']) {
        $ArrayUser = [
            'email' => $_POST['emailConnex'],
            'password' => $_POST['password']
        ];
        $user = new Users($ArrayUser);
        $user->connexion();
    }