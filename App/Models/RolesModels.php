<?php
    namespace App\Models;

use App\Controllers\Roles;
use App\Models\Requites;

    class RolesModels {
        private $roles = [];
        
        public function ObjectsRoles($columnName = null, $columnValue = null) {
            $requite = new Requites();
            try{
                $role =$requite->selectAll('roles', $columnName , $columnValue);
                foreach ($role as $value) {
                    $this->roles[] = new Roles($value['id_role'], $value['role']);
                }
                return $this->roles;
            }catch (\PDOException $e){
                return $e->getMessage();
            }
        }

    }