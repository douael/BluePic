<?php

class CommentController
{
    public function indexAction()
    {
        $v = new View("admin/comment", "backend");
        $comment = new Comment(-1);
        $inactiveComment = $comment->getAll(0, "DESC", 0, 0);
        $allComment = $comment->getAll(0, "DESC", 1, 0);
        $v->assign("allComment", $allComment);
        $v->assign("inactiveComment", $inactiveComment);
    }
    public function showAction()
    {
        $v = new View("admin/comment", "backend");
        $comment = new Comment(-1);
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $allComment = $comment->getAll(0, "DESC", 1, 0);
        $thisComment = $comment->getOneBy(["id" => $id]);
        $v->assign("allComment", $allComment);
        $v->assign("thisComment", $thisComment);
    }

    public function listAction()
    {
    }

    public function deleteAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $comment = new Comment($id);
        $comment->setArchived(1);
        $comment->setActive(0);
        $comment->save();
        header('Location: /admin/comment/');
    }

    public function moderateAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $comment = new Comment($id);
        $comment->setArchived(0);
        $comment->setActive(1);
        $comment->save();
        header('Location: /admin/comment/');
    }
}
