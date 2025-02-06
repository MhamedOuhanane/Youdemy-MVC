<?php 
    namespace App\Controllers;

    class Cours extends Catalogues {
        protected $id_cour;
        protected $cours_titre;
        protected $description;
        protected $cours_contenu;
        protected $cours_video;
        protected $type;
        protected $createDate;
        protected $status;
        protected $imageCours;
        protected $id_user;

        public function __construct($Arrays)
        {
            parent::__construct($Arrays['id_catalogue'] ?? NULL);
            $this->id_cour = $Arrays['id_cour'] ?? null;
            $this->cours_titre = $Arrays['cours_titre'] ?? null;
            $this->description = $Arrays['description'] ?? null;
            $this->cours_contenu = $Arrays['cours_contenu'] ?? null;
            $this->cours_video = $Arrays['cours_video'] ?? null;
            $this->type = $Arrays['type'] ?? null;
            $this->createDate = $Arrays['createDate'] ?? null;
            $this->imageCours = $Arrays['imageCours'] ?? null;
            $this->status = $Arrays['status'] ?? null;
            $this->id_user = $Arrays['id_user'] ?? null;
        }
        
        function setData($name, $value)
        {
            return $this->$name;
        }

        function getData($name)
        {
            return $this->$name;
        }

        

        // function AjouterData() {
        //     $requite = new Requites();

        //     $values = [
        //         'cours_titre' => $this->cours_titre,
        //         'description' => $this->description,
        //         'cours_contenu' => $this->cours_contenu,
        //         'cours_video' => $this->cours_video,
        //         'type' => $this->type,
        //         'imageCours' => $this-> imageCours,
        //         'status' => $this->status,
        //         'id_catalogue' => $this->id_catalogue,
        //         'id_user' => $this->id_user
        //     ];

        //     return $requite->insertData('cours', $values);
        // } 

        // function UpdateCours() {
        //     $requite = new Requites();

        //     $values = [
        //         'cours_titre' => $this->cours_titre,
        //         'description' => $this->description,
        //         'type' => $this->type,
        //         'id_catalogue' => $this->id_catalogue
        //     ];
        //     if ($this->cours_contenu != null) {
        //         $values['cours_contenu'] = $this->cours_contenu; 
        //     }
        //     if ($this->imageCours != null) {
        //         $values['imageCours'] = $this->imageCours; 
        //     }
        //     var_dump($this->id_cour);

        //     return $requite->update('cours', $values, 'id_cour', $this->id_cour);
        // }

        // function toString()
        // {
        //     echo '<div class="bg-white rounded-lg shadow-md overflow-hidden">
        //                                     <div class="relative">
        //                                         <img src="data:image/pnp;base64,'. htmlspecialchars(base64_encode($this->imageCours)) .'" alt="Course" class="w-full h-48 object-cover">
        //                                         <span class="absolute top-4 right-4 px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-500">
        //                                             '. htmlspecialchars($this->status) .'
        //                                         </span>
        //                                     </div>
        //                                     <div class="p-6">
        //                                         <h3 class="text-lg font-semibold mb-2 min-h-14">'. htmlspecialchars($this->cours_titre) .'</h3>
        //                                         <p class="text-gray-600 text-sm mb-4">'. htmlspecialchars($this->description) .'</p>
        //                                         <p class="text-gray-600 text-sm mb-4"> <i class="fas fa-folder w-6"></i> '. htmlspecialchars($this->catalogue_titre) .'</p>
        //                                         <div class="flex items-center justify-between mb-4">
        //                                             <span class="text-sm text-gray-500">
        //                                                 <i class="fas fa-clock mr-2"></i>
        //                                                 '. htmlspecialchars($this->createDate) .'
        //                                             </span>
        //                                         </div>
        //                                         <div class="flex justify-end space-x-4">
        //                                             <a href="./crud/StatusCours.php?idCours='. htmlspecialchars($this->id_cour) .'&status=Publicé" class="flex-1 bg-green-500 text-white hover:bg-green-600">
        //                                                 <button class="w-full flex-1 rounded-lg">
        //                                                     <i class="fas fa-check"></i>
        //                                                 </button>
        //                                             </a>
        //                                             <a href="./crud/StatusCours.php?idCours='. htmlspecialchars($this->id_cour) .'&status=Refusé" class="flex-1 bg-red-500 text-white hover:bg-red-600">
        //                                                 <button class="w-full  rounded-lg">
        //                                                     <i class="fa fa-times"></i>
        //                                                 </button>
        //                                             </a>
        //                                         </div>
        //                                     </div>
        //                                 </div>';
        // }

        // public function toStringMesCours($id) {
        //     $requite = new Requites();
        //     $enseign = $requite->selectWhere('users', 'id_user', $id);
        //     echo '<div class="bg-white rounded-lg shadow-md overflow-hidden">
        //             <img src="data:image/png;base64,'.  htmlspecialchars(base64_encode($this->imageCours)) .'" class="w-full h-48 object-cover">
        //             <div class="p-6">
        //                 <div class="flex items-center justify-between mb-4">
        //                     <span class="text-sm text-gray-500">#ID: '.  htmlspecialchars($this->id_cour) .'</span>
        //                     <div class="flex self-end flex-wrap gap-2">
        //                         <p class="text-xs text-gray-500">'.  htmlspecialchars($this->createDate)  .'</p>
        //                     </div>
        //                 </div>
        //                 <h3 class="text-xl font-semibold mb-2">'.  htmlspecialchars($this->cours_titre) .'</h3>
        //                 <p class="text-gray-600 mb-4 line-clamp-2">'.  htmlspecialchars($this->description) .'</p>
        //                 <div class="flex items-center mb-4">
        //                     <img src="data:image/png;base64,'.  htmlspecialchars(base64_encode($enseign['image'])) .'" alt="Author" class="w-8 h-8 rounded-full mr-3">
        //                     <div>
        //                         <p class="text-sm font-semibold">Mr.'.  htmlspecialchars($enseign['username']) .'</p>
        //                         <p class="text-xs text-gray-500">'.  htmlspecialchars($enseign['email'])  .'</p>
        //                     </div>
        //                 </div>
        //                 <div class="catalog flex items-center justify-between">
        //                     <div class="text-sm text-gray-500">
        //                         <i class="fas fa-folder-open mr-2"></i>
        //                         '.  htmlspecialchars($this->catalogue_titre)  .'
        //                     </span>
        //                     </div>
        //                         <a href="./Details.php?idCours='.  htmlspecialchars($this->id_cour)  .'" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        //                             Voir le cours
        //                         </a>
        //                     </div>
        //             </div>
        //         </div>';

        // }

        // public function AfficheContenu() {
        //     if ($this->type == 'video') {
                
        //         echo '<iframe width="600" height="350" src="'.$this->cours_video.'" 
        //                     frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        //                     allowfullscreen>
        //             </iframe>';
        //     } else if ($this->type == 'document') {
        //         echo '<iframe 
        //                 src="./proccessors/document.php?id=' . $this->id_cour . '" 
        //                 style="width: 100%; height: 800px;" 
        //                 frameborder="0"
        //                 allowfullscreen>
        //             </iframe>';
        //     }
        // }

        // public function totalCours() {
        //     $requite = new Requites();
        //     $totale = $requite->selectCount('cours');
        //     return $totale;
        // }
    }