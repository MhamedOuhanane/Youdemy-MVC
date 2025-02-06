<?php 
namespace App\Controllers;

use App\Controllers\Cours;

class listecours extends Cours {
    private $username;
    private $useremail;
    private $userimage;
    private $id_tag;
    private $tag_titre;


    public function __construct($Array)
    {
        parent::__construct($Array);
        $this->username = $Array['username'] ?? null;
        $this->useremail = $Array['email'] ?? null;
        $this->userimage = stream_get_contents($Array['image']) ?? null;
        $this->id_tag = $Array['id_tag'] ?? null;
        $this->tag_titre = $Array['tag_titre'] ?? null;
    }

    
}