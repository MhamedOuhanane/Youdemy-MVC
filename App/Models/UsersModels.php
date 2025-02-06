<?php
    namespace App\Models;

use App\Controllers\Autentification\Users;
use App\Models\Requites;

    class UsersModels {
        private static $users = [];
        
        public static function ObjectsUsers($columnName = null, $columnValue = null) {
            $requite = new Requites();
            try{
                $role =$requite->selectAll('users', $columnName , $columnValue);
                foreach ($role as $value) {
                    self::$users[] = new Users($value);
                }
                return self::$users;
            }catch (\PDOException $e){
                return $e->getMessage();
            }
        }

    }