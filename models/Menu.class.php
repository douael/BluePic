<?php

class Menu extends BaseSql
{
    protected $id;
    protected $name;
    protected $active;
    protected $archived;

    public function __construct($id, $name = null, $active = 0)
    {
        parent::__construct();

        if ($id > 0) {
            $menu = parent::getOneBy(["id" => $id]);

            $this->id                = $menu['id'];
            $this->name             = $menu['name'];
            $this->active          = $menu['active'];
            $this->archived          = $menu['archived'];
        } else {
            $this->id                = $id;
            $this->setName($name);
            $this->active          = $active;
            $this->archived          = 0;
        }
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = Tools::antiXSS($name);
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $archived
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    public function loadActive()
    {
        $menu = parent::getOneBy(["active" => 1]);
        return new Menu($menu['id']);
    }

    public static function getMenuForm($menuElements)
    {
        $options = [];
        foreach ($menuElements as $menuElement) {
            $options[] = [
                "value" => $menuElement['id'],
                "name" => $menuElement['name'],
                "selected" => 0,
            ];
        }

        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/menu/create",
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
                        "elements[]"=>[
                            "id"            =>"elements",
                            "label"         =>"Redirection :",
                            "type"          =>"select",
                            "option"        => $options,
                            "placeholder"   =>"La redirection du menu: ",
                            "required"      =>true,
                            "multiple"      =>true,
                            "extra"         => '<a href="JavaScript:void(0);" id="btn-up">Monter</a> <a href="JavaScript:void(0);" id="btn-down">Descendre</a>'
                        ],
                        "active"=>[
                            "id"            =>"active",
                            "label"         =>"Activer :",
                            "type"          =>"checkbox",
                            "checked"       =>0,
                            "required"      =>false
                        ]
                    ]
                ],
            ]
        ];
    }

    public static function getMenuEditForm($thisMenu, $menuElements)
    {
        $options = [];

        $menuElementsArray = MenuElementAssociation::LoadByMenuId($thisMenu['id']);

        foreach ($menuElementsArray as $me) {
            $options[] = [
                "value" => $me->getId(),
                "name" => $me->getName(),
                "selected" => 0,
            ];
        }

        foreach ($menuElements as $menuElement) {
            if (!in_array($menuElement['id'], $options)) {
                $options[] = [
                    "value" => $menuElement['id'],
                    "name" => $menuElement['name'],
                    "selected" => 0,
                ];
            }
        }

        $newArr = array();
        foreach ($options as $val) {
            $newArr[$val['value']] = $val;
        }
        $options = array_values($newArr);

        foreach ($menuElementsArray as $me) {
            foreach ($options as $key => $option) {
                if ($me->getId() == $option['value']) {
                    $options[$key]['selected'] = 1;
                }
            }
        }

        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/menu/edit/".$thisMenu['id'],
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
                            "value"         => $thisMenu['name'],
                            "placeholder"   => $thisMenu['name'],
                            "required"      =>true
                        ],
                        "elements[]"=>[
                            "id"            =>"elements",
                            "label"         =>"Redirection :",
                            "type"          =>"select",
                            "option"        => $options,
                            "placeholder"   =>"La redirection du menu: ",
                            "required"      =>true,
                            "multiple"      =>true,
                            "extra"         => '<a href="JavaScript:void(0);" id="btn-up">Monter</a> <a href="JavaScript:void(0);" id="btn-down">Descendre</a>'
                        ],
                        "active"=>[
                            "id"            =>"active",
                            "label"         =>"Activer :",
                            "type"          =>"checkbox",
                            "checked"       => $thisMenu['active'],
                            "required"      =>false
                        ]
                    ]
                ],
            ]
        ];
    }

    public static function getMenuArchivedForm($thisMenu)
    {
        return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/menu/delete/".$thisMenu['id'],
                "class"     =>"form-delete",
                "id"        =>"menuDeleteForm",
                "submit"    =>"Archiver"
                ],
            "struct"=>[]
            ];
    }

    public function getMenuHTML()
    {
        $menu = $this->loadActive();

        $menuElements = MenuElementAssociation::LoadByMenuId($menu->getId());

        $html = "";

        foreach ($menuElements as $menuElement) {
            if ($menuElement->getRedirection() == "Index/login") {
                if (!empty($_SESSION['id'])) {
                    $html .= "<li><a href='/user/show/".$_SESSION['id']."'><i class='fa fa-user' aria-hidden='true' style='margin-right: 5px;'></i>".$_SESSION['username']."</a></li>";
                } else {
                    $html .= "<li><a href='/".$menuElement->getRedirection()."'>".$menuElement->getName()."</a></li>";
                }
            } elseif ($menuElement->getRedirection() == "Index/register") {
                if (empty($_SESSION['id'])) {
                    $html .= "<li><a href='/".$menuElement->getRedirection()."'>".$menuElement->getName()."</a></li>";
                }
            } elseif ($menuElement->getRedirection() == "Index/logout") {
                if (!empty($_SESSION['id'])) {
                    $html .= "<li><a href='/".$menuElement->getRedirection()."'>".$menuElement->getName()."</a></li>";
                }
            } else {
                $html .= "<li><a href='/".$menuElement->getRedirection()."'>".$menuElement->getName()."</a></li>";
            }
        }

        echo $html;
    }
}
