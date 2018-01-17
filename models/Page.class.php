<?php

class Page extends BaseSql
{
    protected $id;
    protected $title;
    protected $active;
    protected $archived;
    protected $text;

    public function __construct($id, $title = null, $text = null, $active=null)
    {
        parent::__construct();

        if ($id > 0) {
            $page = parent::getOneBy(["id" => $id]);

            $this->id                = $page['id'];
            $this->title             = $page['title'];
            $this->text              = $page['text'];
            $this->active          = $page['active'];
            $this->archived          = $page['archived'];
        } else {
            $this->id                = $id;
            $this->setTitle($title);
            $this->setText($text);
            $this->active          = $active;
            $this->archived          = 0;
        }
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = Tools::antiXSS($text);
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }
    
    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
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
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
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

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = Tools::antiXSS($title);
    }

    public static function getPageForm()
    {
        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/page/create",
                "class"     =>"form-group",
                "id"        =>"pageForm",
                "submit"    =>"Valider"
            ],

            "struct"=>[
                [
                    "fieldset"=> "",
                    "elements"=>[
                        "title"=>[
                            "id"            =>"title",
                            "label"         =>"Titre :",
                            "type"          =>"text",
                            "placeholder"   =>"Le titre: ",
                            "required"      =>true
                        ],
                        "text"=>[
                            "id"            =>"text",
                            "label"         =>"Contenu :",
                            "type"          =>"textarea",
                            "placeholder"   =>"Votre contenu",
                            "required"      =>true,
                            "readonly"      =>false,
                            "text"          =>""
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

    public static function getPageEditForm($thisPage)
    {
        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/page/edit/".$thisPage['id'],
                "class"     =>"form-group",
                "id"        =>"pageEditForm",
                "submit"    =>"Modifier"
            ],
            "struct"=>[
                [
                    "fieldset"=> "",
                    "elements"=>[
                        "title"=>[
                            "id"            =>"title",
                            "label"         =>"Titre :",
                            "type"          =>"text",
                            "placeholder"   =>$thisPage['title'],
                            "value"         =>$thisPage['title'],
                            "required"      =>true
                        ],
                        "text"=>[
                            "id"            =>"text",
                            "label"         =>"Contenu :",
                            "type"          =>"textarea",
                            "placeholder"   =>$thisPage['text'],
                            "value"         =>$thisPage['text'],
                            "required"      =>true,
                            "readonly"      =>false,
                            "text"          =>$thisPage['text']
                        ],
                        "active"=>[
                            "id"            =>"active",
                            "label"         =>"Mettre en ligne :",
                            "type"          =>"checkbox",
                            "checked"       =>$thisPage['active'],
                            "required"      =>false
                        ]
                    ]
                ]
            ]
        ];
    }

    public static function getPageArchivedForm($thisPage)
    {
        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/page/delete/".$thisPage['id'],
                "class"     =>"form-delete",
                "id"        =>"pageDeleteForm",
                "submit"    =>"Archiver"
                ],
            "struct"=>[]
            ];
    }
}
