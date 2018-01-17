<?php

class MenuElementController
{
    public function indexAction()
    {
        $v = new View("admin/menuElement", "backend");
        $menuElement = new MenuElement(-1);
        $allMenuElement = $menuElement->getAll();
        $v->assign("allMenuElement", $allMenuElement);
    }
    public function showAction()
    {
        $v    = new View("admin/menuElement", "backend");
        $menuElement = new MenuElement(-1);

        $uri = $_SERVER['REQUEST_URI'];

        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);

        $link = $this->uriExploded;
        $id = $link[3];

        $allMenuElement = $menuElement->getAll();
        $thisMenuElement = $menuElement->getOneBy(["id" => $id]);

        $v->assign("allMenuElement", $allMenuElement);
        $v->assign("thisMenuElement", $thisMenuElement);
    }

    public function listAction()
    {
        $v= new View("admin/menuElementList", "backend");
    }


    public function createAction()
    {
        $data = $_POST;
        $menuElement = new MenuElement(-1, $data['name'], $data['redirection']);
        $menuElement->save();

        header("Location: /admin/menuElement");
    }

    public function editAction()
    {
        $data = $_POST;
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $menuElement = new MenuElement($id);
        $menuElement->setName($data['name']);
        $menuElement->setRedirection($data['redirection']);
        $menuElement->save();
        header('Location: /admin/menuElement/show/'.$id);
    }

    public function deleteAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $menuElement = new MenuElement($id);
        $menuElement->setArchived(1);
        $menuElement->save();
        header('Location: /admin/menuElement/');
    }
}
