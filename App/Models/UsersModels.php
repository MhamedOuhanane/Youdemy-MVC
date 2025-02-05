<?php
    namespace App\Models;

use App\Controllers\Autentification\Users;
use App\Models\Requites;

    class UsersModels {
        private $users = [];
        
        public function ObjectsUsers($columnName = null, $columnValue = null) {
            $requite = new Requites();
            try{
                $role =$requite->selectAll('users', $columnName , $columnValue);
                foreach ($role as $value) {
                    $this->users[] = new Users($value);
                }
                return $this->users;
            }catch (\PDOException $e){
                return $e->getMessage();
            }
        }

    }