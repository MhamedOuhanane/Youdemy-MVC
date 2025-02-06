<?php
namespace App\Models;

    use App\Controllers\listecours;

    class listecoursModels {
        private static $list = [];

        public static function ObjectsListe($columnfilter1, $filter1, $columnfilter2, $filter2, $columnsearch1, $columnsearch2, $search, $status = null, $id_user=null, $enseig = null) {
            $requite = new Requites();
            $Result = $requite->fetchData($columnfilter1, $filter1, $columnfilter2, $filter2, $columnsearch1, $columnsearch2, $search, $status, $id_user, $enseig);
            foreach ($Result as $value) {
                self::$list[] = new listecours($value);
            }
            
        }
    }