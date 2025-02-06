<?php
namespace App\Models;

use App\Controllers\listeIns;

    class listeInsModels {
        private static $list = [];

        public static function ObjectsListe($columnfilter1, $filter1, $columnfilter2 = "", $filter2 = "", $columnsearch1 = "", $search = "", $status = null, $id_user=null, $enseig = null) {
            $requite = new Requites();
            $Result = $requite->fetchData('listeinscriptioncours', $columnfilter1, $filter1, $columnfilter2, $filter2, $columnsearch1, $search, $status, $id_user, $enseig);
            foreach ($Result as $value) {
                self::$list[] = new listeIns($value);
            }
            return self::$list;
        }

        public static function find($columnName1, $columnValue1, $columnName2=null, $columnValue2=null) {
            $requite = new Requites();
            $Result = $requite->selectWhere('listeinscriptioncours', $columnName1, $columnValue1, $columnName2, $columnValue2);
            $list = new listeIns($Result);
            return $list;
        }
    }