<?php 
namespace App\Controllers;

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
        $this->userimage = $Array['image'] ?? null;
        $this->id_tag = $Array['id_tag'] ?? null;
        $this->tag_titre = $Array['tag_titre'] ?? null;
    }

    
}