<?php

class PageController
{
    public function indexAction()
    {
        $v = new View("admin/page", "backend");
        $page = new Page(-1);
        $allPage = $page->getAll();
        $v->assign("allPage", $allPage);
    }

    public function showAction()
    {
        $v = new View("admin/page", "backend");
        $page = new Page(-1);
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $allPage = $page->getAll();
        $thisPage = $page->getOneBy(["id" => $id]);
        $v->assign("allPage", $allPage);
        $v->assign("thisPage", $thisPage);
    }
    public function listAction()
    {
        $v= new View("admin/pageList", "backend");
    }


    public function createAction()
    {
        $data = $_POST;
        if (!isset($data['active'])) {
            $data['active'] = 0;
        } else {
            $data['active'] = 1;
        }
        $page = new Page(-1, $data['title'], $data['text'], $data['active']);
        $page->save();
        header("Location: /admin/page");
    }

    public function editAction()
    {
        $data = $_POST;
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        if (!isset($data['active'])) {
            $data['active'] = 0;
        } else {
            $data['active'] = 1;
        }
        if ($data['category'] == "") {
            $data['category'] = null;
        }
        $page = new Page($id);
        $page->setTitle($data['title']);
        $page->setText($data['text']);
        $page->setActive($data['active']);
        $page->save();
        header('Location: /admin/page/show/'.$id);
    }

    public function deleteAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $page = new Page($id);
        $page->setArchived(1);
        $page->setActive(0);
        $page->save();
        header('Location: /admin/page/');
    }
}
