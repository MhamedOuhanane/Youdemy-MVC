<?php
    namespace App\Models;

use App\Controllers\Roles;
use App\Models\Requites;

    class RolesModels {
        private static $roles = [];
        
        public static function ObjectsRoles($columnName = null, $columnValue = null) {
            $requite = new Requites();
            try{
                $role =$requite->selectAll('roles', $columnName , $columnValue);
                foreach ($role as $value) {
                    self::$roles[] = new Roles($value['id_role'], $value['role']);
                }
                return self::$roles;
            }catch (\PDOException $e){
                return $e->getMessage();
            }
        }

    }