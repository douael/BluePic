<?php

class Tag extends BaseSql
{
    protected $id;
    protected $name;
    protected $archived;

    /**
     * @return mixed
     */
    public function __construct($id, $name = null)
    {
        parent::__construct();

        if ($id > 0) {
            $tag = parent::getOneBy(["id" => $id]);

            $this->id                = $tag['id'];
            $this->name              = $tag['name'];
            $this->archived          = $tag['archived'];
        } else {
            $this->id                = $id;
            $this->setName($name);
            $this->archived          = 0;
        }
    }

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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = Tools::antiXSS($name);
    }
  
    public static function getTagForm()
    {
        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/tag/create",
                "class"     =>"form-group",
                "id"        =>"tagForm",
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
                        "name"=>[
                            "id"            =>"name",
                            "label"         =>"Nom :",
                            "type"          =>"text",
                            "placeholder"   =>"Le nom du tag: ",
                            "required"      =>true
                        ]
                    ]
                ]
            ]
        ];
    }

    public static function getTagEditForm($thisTag)
    {
        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/tag/edit/".$thisTag['id'],
                "class"     =>"form-group",
                "id"        =>"tagEditForm",
                "submit"    =>"Modifier"
            ],

            "struct"=>[
                [
                    "fieldset"=> "",
                    "elements"=>[
                        "name"=>[
                            "id"            =>"name",
                            "label"         =>"Nom :",
                            "type"          =>"text",
                            "placeholder"   =>$thisTag['name'],
                            "value"         =>$thisTag['name'],
                            "required"      =>true
                        ]
                    ]
                ]
            ]
        ];
    }
    
    public static function getTagArchivedForm($thisTag)
    {
        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/tag/delete/".$thisTag['id'],
                "class"     =>"form-delete",
                "id"        =>"tagDeleteForm",
                "submit"    =>"Archiver"
                ],
            "struct"=>[]
            ];
    }
}
