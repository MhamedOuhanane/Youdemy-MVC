<?php
namespace App\Models;

use App\Controllers\Cours;

    class CoursModels {
        private static $Cours = [];

        public static function ObjectsCours($con1=null, $con2=null) {
            $requite = new Requites();
            $Result = $requite->selectAll('cours', $con1, $con2);

            foreach ($Result as $value) {
                self::$Cours[] = new Cours($value);
            }
            return self::$Cours;
        }

        public static function find($columnName1, $columnValue1, $columnName2=null, $columnValue2=null) {
            $requite = new Requites();
            $Result = $requite->selectWhere('cours', $columnName1, $columnValue1, $columnName2, $columnValue2);
            $list = new Cours($Result);
            return $list;
        }
    }