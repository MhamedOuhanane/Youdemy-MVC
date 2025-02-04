<?php
    namespace App\Controllers;
    class Roles {
        protected $id_role;
        protected $role;

        public function __construct($id = null, $role = null)
        {
            $this->id_role = $id;
            $this->role = $role;
        }

        public function getData($name) {
            return $this->$name;
        }


    }