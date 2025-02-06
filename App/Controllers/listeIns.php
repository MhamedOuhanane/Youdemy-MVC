<?php 
namespace App\Controllers;

use App\Controllers\Autentification\Users;

class listeIns extends Users {
    private $id_cour;
    private $cours_titre;
    private $id_catalogue;
    private $catalogue_titre;
    private $id_ensei;


    public function __construct($Array)
    {
        parent::__construct($Array);
        $this->id_cour = $Array['id_cour'] ?? null;
        $this->cours_titre = $Array['cours_titre'] ?? null;
        $this->id_catalogue = $Array['id_catalogue'] ?? null;
        $this->catalogue_titre = $Array['catalogue_titre'] ?? null;
        $this->id_ensei = $Array['id_enseign'] ?? null;
    }
    
}