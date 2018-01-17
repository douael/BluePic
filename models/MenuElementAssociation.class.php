<?php

class MenuElementAssociation
{
    protected $idMenu;
    protected $idMenuElement;

    /**
     * MenuElement constructor.
     * @param $idMenu
     * @param $idMenuElement
     */
    public function __construct($idMenu, $idMenuElement)
    {
        $this->idMenu = $idMenu;
        $this->idMenuElement = $idMenuElement;
    }

    /**
     * @return mixed
     */
    public function getIdMenu()
    {
        return $this->idMenu;
    }

    /**
     * @param mixed $idMenu
     */
    public function setIdMenu($idMenu)
    {
        $this->idMenu = $idMenu;
    }

    /**
     * @return mixed
     */
    public function getIdMenuElement()
    {
        return $this->idMenuElement;
    }

    /**
     * @param mixed $idMenuElement
     */
    public function setIdMenuElement($idMenuElement)
    {
        $this->idMenuElement = $idMenuElement;
    }

    public static function LoadByMenuId($idMenu)
    {
        try {
            $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
            $db->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            die("Erreur SQL : ".$e->getMessage());
        }

        $sql = "SELECT *
                      FROM ".DB_PREFIXE."menu_menu_element mme
                      WHERE menu_id = ".$idMenu."
                      ORDER BY `order` ASC";

        $query = $db->prepare($sql);
        $query->execute();

        $menuElementsId = [];

        while ($data = $query->fetch()) {
            $menuElementsId[] = $data['menu_element_id'];
        }

        $menuElements = [];

        foreach ($menuElementsId as $id) {
            $menuElements[] = new MenuElement($id);
        }

        return $menuElements;
    }
}
