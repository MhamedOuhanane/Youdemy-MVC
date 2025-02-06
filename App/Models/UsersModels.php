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

        public static function find($columnName1, $columnValue1, $columnName2=null, $columnValue2=null) {
            $requite = new Requites();
            $Result = $requite->selectWhere('listeinscriptioncours', $columnName1, $columnValue1, $columnName2, $columnValue2);
            $list = new Users($Result);
            return $list;
        }

    }