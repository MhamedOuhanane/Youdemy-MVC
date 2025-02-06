<?php
namespace App\Models;

use App\Controllers\tags;

    class tagsModels {
        private static $tags = [];

        public static function ObjectsTags($con1=null, $con2=null) {
            $requite = new Requites();
            $Result = $requite->selectAll('tags', $con1, $con2);
            foreach ($Result as $value) {
                self::$tags[] = new tags($value['id_tag'], $value['tag_titre']);
            }
            return self::$tags;
        }
    }