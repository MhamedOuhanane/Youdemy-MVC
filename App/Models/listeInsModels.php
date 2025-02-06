<?php
namespace App\Models;

use App\Controllers\listeIns;

    class listeInsModels {
        private static $list = [];

        public static function ObjectsListe($con1 = null, $value1 = null, $con2 = null, $value2 = null) {
            $requite = new Requites();
            $Result = $requite->selectAll('listeinscriptioncours', $con1, $value1, $con2, $value2);
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