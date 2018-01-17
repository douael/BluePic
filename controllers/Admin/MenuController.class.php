<?php

class MenuController
{
    public function indexAction()
    {
        $v = new View("admin/menu", "backend");
        $menu = new Menu(-1);
        $menuElement = new MenuElement(-1);
        $allMenu = $menu->getAll();
        $allMenuElement = $menuElement->getAll();
        $v->assign("allMenuElement", $allMenuElement);
        $v->assign("allMenu", $allMenu);
    }
    public function showAction()
    {
        $v    = new View("admin/menu", "backend");
        $menu = new Menu(-1);
        $menuElement = new MenuElement(-1);

        $uri = $_SERVER['REQUEST_URI'];

        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);

        $link = $this->uriExploded;
        $id = $link[3];

        $allMenu = $menu->getAll();
        $thisMenu = $menu->getOneBy(["id" => $id]);
        $allMenuElement = $menuElement->getAll();

        $v->assign("allMenuElement", $allMenuElement);
        $v->assign("allMenu", $allMenu);
        $v->assign("thisMenu", $thisMenu);
    }
    public function listAction()
    {
        $v= new View("admin/menuList", "backend");
    }


    public function createAction()
    {
        $data = $_POST;

        try {
            $this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
        } catch (Exception $e) {
            die("Erreur SQL : ".$e->getMessage());
        }

        if (isset($data['active'])) {
            $active = 1;
        }

        $menu = new Menu(-1, $data['name'], $active);
        if ($menu->getActive() == 1) {
            $menu->resetAll();
        }
        $menu->save();

        $id_menu = $menu->getLastInsertedId();

        if (!empty($data['elements'])) {
            $sql = "INSERT INTO ".DB_PREFIXE."menu_menu_element VALUES";

            for ($i=0;$i<count($data['elements']);$i++) {
                if ($i == count($data['elements']) - 1) {
                    $sql .= "(".$id_menu.", ".$data['elements'][$i].", ".$i.");";
                } else {
                    $sql .= "(".$id_menu.", ".$data['elements'][$i].", ".$i."),";
                }
            }

            $query = $this->db->prepare($sql);
            $query->execute();
        }

        header("Location: /admin/menu");
    }

    public function editAction()
    {
        $data = $_POST;


        try {
            $this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
        } catch (Exception $e) {
            die("Erreur SQL : ".$e->getMessage());
        }

        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];

        $menu = new Menu($id);
        $menu->setName($data['name']);

        if (isset($data['active'])) {
            $menu->setActive(1);
        }

        if ($menu->getActive() == 1) {
            $menu->resetAll();
        }

        $sql = "DELETE FROM ".DB_PREFIXE."menu_menu_element WHERE menu_id = ".$id;
        $query = $this->db->prepare($sql);
        $query->execute();

        if (!empty($data['elements'])) {
            $sql = "INSERT INTO " . DB_PREFIXE . "menu_menu_element VALUES";

            for ($i = 0; $i < count($data['elements']); $i++) {
                if ($i == count($data['elements']) - 1) {
                    $sql .= "(" . $id . ", " . $data['elements'][$i] . ", " . $i . ");";
                } else {
                    $sql .= "(" . $id . ", " . $data['elements'][$i] . ", " . $i . "),";
                }
            }

            $query = $this->db->prepare($sql);
            $query->execute();
        }

        $menu->save();
        header('Location: /admin/menu/show/'.$id);
    }

    public function deleteAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $menu = new Menu($id);
        $menu->setArchived(1);
        $menu->save();
        header('Location: /admin/menu/');
    }
}
