<?php

class TagController
{
    public function indexAction()
    {
        $v = new View("admin/tag", "backend");
        $tag = new Tag(-1);
        $allTag = $tag->getAll();
        $v->assign("allTag", $allTag);
    }
    public function showAction()
    {
        $v = new View("admin/tag", "backend");
        $tag = new Tag(-1);
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $allTag = $tag->getAll();
        $thisTag = $tag->getOneBy(["id" => $id]);
        $v->assign("allTag", $allTag);
        $v->assign("thisTag", $thisTag);
    }
    public function listAction()
    {
        $v= new View("admin/tagList", "backend");
    }


    public function createAction()
    {
        $data = $_POST;
        $tag = new Tag(-1, $data['name']);
        $tag->save();

        header("Location: /admin/tag");
    }

    public function editAction()
    {
        $data = $_POST;
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $tag = new Tag($id);
        $tag->setName($data['name']);
        $tag->save();
        header('Location: /admin/tag/show/'.$id);
    }

    public function deleteAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $tag = new Tag($id);
        $tag->setArchived(1);
        $tag->save();
        header('Location: /admin/tag/');
    }
}
