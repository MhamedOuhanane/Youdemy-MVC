<?php 
namespace App\Controllers;

use App\Controllers\Autentification\Users;
use App\Models\Requites;

class listeIns extends Users {
    private $id_cour;
    private $cours_titre;
    private $description;
    private $createDate;
    private $imageCours;
    private $id_catalogue;
    private $catalogue_titre;
    private $date_inscret;
    private $id_ensei;


    public function __construct($Array)
    {
        parent::__construct($Array);
        $this->id_cour = $Array['id_cour'] ?? null;
        $this->cours_titre = $Array['cours_titre'] ?? null;
        $this->description = $Array['description'] ?? null;
        $this->createDate = $Array['createdate'] ?? null;
        $this->imageCours = $Array['imagecours'] ?? null;
        $this->id_catalogue = $Array['id_catalogue'] ?? null;
        $this->catalogue_titre = $Array['catalogue_titre'] ?? null;
        $this->date_inscret = $Array['date_inscret'] ?? null;
        $this->id_ensei = $Array['id_enseign'] ?? null;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }  
    
    public function __get($name)
    {
        return $this->$name;
    }
    
    public static function totalCours($columnName1 = null, $columnValue1 = null, $columnName2 = null, $columnValue2 = null) {
        $requite = new Requites();
        $totale = $requite->selectCount('cours', $columnName1 = null, $columnValue1 = null, $columnName2 = null, $columnValue2 = null);
        return $totale;
    }
}