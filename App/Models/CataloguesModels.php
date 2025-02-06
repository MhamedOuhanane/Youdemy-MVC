<?php 
namespace App\Models;
use App\Controllers\Catalogues;

class CataloguesModels {
    private static $Catalogue = [];

    public static function ObjectsCatalogues($con1=null, $con2=null) {
        $requite = new Requites();
        $Result = $requite->selectAll('catalogues', $con1, $con2);
        
        foreach ($Result as $row) {
            self::$Catalogue[] = new Catalogues($row['id_catalogue'], $row['catalogue_titre'], $row['catalogue_contenu'], $row['catalogue_image']);
        }

        return self::$Catalogue;
    }
}