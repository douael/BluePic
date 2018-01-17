<?php

class MenuElement extends BaseSql
{
    protected $id;
    protected $name;
    protected $redirection;
    protected $archived;

    public function __construct($id, $name = null, $redirection = null)
    {
        parent::__construct();

        if ($id > 0) {
            $menuElement = parent::getOneBy(["id" => $id]);

            $this->id               = $menuElement['id'];
            $this->name             = $menuElement['name'];
            $this->redirection      = $menuElement['redirection'];
            $this->archived         = $menuElement['archived'];
        } else {
            $this->id               = $id;
            $this->setName($name);
            $this->setRedirection($redirection);
            $this->archived         = 0;
        }
    }

    /**
     * @return null
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * @param null $archived
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name)
    {
        $this->name = Tools::antiXSS($name);
    }

    /**
     * @return null
     */
    public function getRedirection()
    {
        return $this->redirection;
    }

    /**
     * @param null $redirection
     */
    public function setRedirection($redirection)
    {
        $this->redirection = Tools::antiXSS($redirection);
    }



    public static function getMenuElementForm()
    {
        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/menuElement/create",
                "class"     =>"form-group",
                "id"        =>"menuForm",
                "submit"    =>"Valider"
            ],

            "struct"=>[
                // "id"=>[
                //     "id"            =>"id",
                //     "type"          =>"hidden"
                // ],
                [
                    "fieldset"=> "",
                    "elements"=>[
                        "name"=>[
                            "id"            =>"name",
                            "label"         =>"Nom :",
                            "type"          =>"text",
                            "placeholder"   =>"Le nom du menu: ",
                            "required"      =>true
                        ],
                        "redirection"=>[
                            "id"            =>"redirection",
                            "label"         =>"Redirection :",
                            "type"          =>"text",
                            "placeholder"   =>"La redirection du menu: ",
                            "required"      =>true
                        ],
                    ]
                ],
            ]
        ];
    }

    public static function getMenuElementEditForm($thisMenuElement)
    {
        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/menuElement/edit/".$thisMenuElement['id'],
                "class"     =>"form-group",
                "id"        =>"menuEditForm",
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
                            "value"         => $thisMenuElement['name'],
                            "placeholder"   => $thisMenuElement['name'],
                            "required"      =>true
                        ],
                        "redirection"=>[
                            "id"            =>"redirection",
                            "label"         =>"Redirection :",
                            "type"          =>"text",
                            "value"         => $thisMenuElement['redirection'],
                            "placeholder"   => $thisMenuElement['redirection'],
                            "required"      =>true
                        ],
                    ]
                ],
            ]
        ];
    }

    public static function getMenuElementArchivedForm($thisMenuElement)
    {
        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/menu/delete/".$thisMenuElement['id'],
                "class"     =>"form-delete",
                "id"        =>"menuDeleteForm",
                "submit"    =>"Archiver"
            ],
            "struct"=>[]
        ];
    }
}
