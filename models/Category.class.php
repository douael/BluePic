<?php


class Category extends BaseSql
{
    protected $id;
    protected $title;
    protected $active;
    protected $archived;

    /**
     * @param mixed $title
     */
    public function __construct($id, $title = null, $active = null)
    {
        parent::__construct();

        if ($id > 0) {
            $category = parent::getOneBy(["id" => $id]);

            $this->id                = $category['id'];
            $this->title             = $category['title'];
            $this->active            = $category['active'];
            $this->archived          = $category['archived'];
        } else {
            $this->id                = $id;
            $this->setTitle($title);
            $this->active            = $active;
            $this->archived          = 0;
        }
    }
    public function setTitle($title)
    {
        $this->title = Tools::antiXSS($title);
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /*
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }


    /**
     * @return mixed
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param mixed $archived
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAllCategories()
    {
        return parent::getAll();
    }
  
    public static function getCategoryForm()
    {
        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/category/create",
                "class"     =>"form-group",
                "id"        =>"categoryForm",
                "submit"    =>"Valider"
            ],

            "struct"=>[
                [
                    "fieldset"=> "",
                    "elements"=>[
                        // "id"=>[
                        //     "id"            =>"id",
                        //     "type"          =>"hidden"
                        // ],
                        "libelle"=>[
                            "id"            =>"libelle",
                            "label"         =>"Libelle :",
                            "type"          =>"text",
                            "placeholder"   =>"Votre libellé",
                            "required"      =>false
                        ],
                        "select"=>[
                            "id"            =>"parentCategory",
                            "label"         =>"Catégorie parente",
                            "type"          =>"select",
                            "option"        => [ "category1" => "Categorie1",
                                                "category2"=>"Categorie2",
                                                "category3"=>"Categorie3",
                                                "category4"=>"Categorie4",
                                                "category5"=>"Categorie5"
                            ],
                            "required"      =>true
                        ],

                        "active"=>[
                            "id"            =>"active",
                            "label"         =>"Mettre en ligne :",
                            "type"          =>"checkbox",
                            "checked"       =>0,
                            "required"      =>false
                        ]
                    ]
                ]
            ]
            
        ];
    }
    public static function getCategoryEditForm($thisCategory)
    {
        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/category/edit/".$thisCategory['id'],
                "class"     =>"form-group",
                "id"        =>"categoryEditForm",
                "submit"    =>"Modifier"
            ],
            "struct"=>[
                [
                    "fieldset"=> "",
                    "elements"=>[
                        // "id"=>[
                        //     "id"            =>"id",
                        //     "type"          =>"hidden"
                        // ],
                        "libelle"=>[
                            "id"            =>"libelle",
                            "label"         =>"Libelle :",
                            "type"          =>"text",
                            "placeholder"   =>$thisCategory['title'],
                            "value"         =>$thisCategory['title'],
                            "required"      =>false
                        ],
                        "select"=>[
                            "id"            =>"parentCategory",
                            "label"         =>"Catégorie parente",
                            "type"          =>"select",
                            "option"        => [ "category1" => "Categorie1",
                                                "category2"=>"Categorie2",
                                                "category3"=>"Categorie3",
                                                "category4"=>"Categorie4",
                                                "category5"=>"Categorie5"
                            ],
                            "required"      =>true
                        ],
                        "active"=>[
                            "id"            =>"active",
                            "label"         =>"Mettre en ligne :",
                            "type"          =>"checkbox",
                            "checked"       =>$thisCategory['active'],
                            "required"      =>false
                        ]
                    ]
                ]
            ]
            
        ];
    }
    
    public static function getCategoryArchivedForm($thisCategory)
    {
        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/category/delete/".$thisCategory['id'],
                "class"     =>"form-delete",
                "id"        =>"categoryDeleteForm",
                "submit"    =>"Archiver"
                ],
            "struct"=>[]
            ];
    }
}
