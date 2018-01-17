<?php

/**
 *
 */
class ArchiveController
{
    public function indexAction()
    {
        $v = new View("admin/archive", "backend");
    }
    public function userArchiveAction()
    {
        if ($_SESSION['role'] != 1) {
            header('Location: /admin');
        }
        $v = new View("admin/userArchive", "backend");
        $user = new User(-1);
        $allUsers = $user->getAll(0, "DESC", "", 1);
        $v->assign("allUsers", $allUsers);
        //var_dump($allUsers);die;
    }
    public function commentArchiveAction()
    {
        $v = new View("admin/commentArchive", "backend");
        $comment = new Comment(-1);
        $allComment = $comment->getAll(0, "DESC", "", 1);
        $v->assign("allComment", $allComment);
    }
    public function articleArchiveAction()
    {
        $v = new View("admin/articleArchive", "backend");
        $article = new Article(-1);
        $allArticle = $article->getAll(0, "DESC", "", 1);
        $v->assign("allArticle", $allArticle);
    }
    public function mediaArchiveAction()
    {
        $v = new View("admin/mediaArchive", "backend");
        $media = new Media(-1);
        $allMedia = $media->getAll(0, "DESC", "", 1);
        $v->assign("allMedia", $allMedia);
    }
    public function tagArchiveAction()
    {
        $v = new View("admin/tagArchive", "backend");
        $tag = new Tag(-1);
        $allTag = $tag->getAll(0, "DESC", "", 1);
        $v->assign("allTag", $allTag);
    }
    public function menuArchiveAction()
    {
        if ($_SESSION['role'] != 1) {
            header('Location: /admin');
        }
        $v = new View("admin/menuArchive", "backend");
        $menu = new Menu(-1);
        $allMenu = $menu->getAll(0, "DESC", "", 1);
        $v->assign("allMenu", $allMenu);
    }
    public function categoryArchiveAction()
    {
        $v = new View("admin/categoryArchive", "backend");
        $category = new Category(-1);
        $allCategories = $category->getAll(0, "DESC", "", 1);
        $v->assign("allCategories", $allCategories);
    }
    public function pageArchiveAction()
    {
        $v = new View("admin/pageArchive", "backend");
        $page = new Page(-1);
        $allPages = $page->getAll(0, "DESC", "", 1);
        $v->assign("allPages", $allPages);
    }
    public function activateAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $table = $link[3];
        $id = $link[4];
        if ($table == "user") {
            $user = new User($id);
            $user->setArchived(0);
            $user->setActive(0);
            $user->save();
            header('Location: /admin/archive/userArchive');
        }
        if ($table == "article") {
            $article = new Article($id);
            $article->setArchived(0);
            $article->setActive(0);
            $article->save();
            header('Location: /admin/archive/articleArchive');
        }
        if ($table == "comment") {
            $comment = new Comment($id);
            $comment->setArchived(0);
            $comment->setActive(0);
            $comment->save();
            header('Location: /admin/archive/commentArchive');
        }
        if ($table == "category") {
            $category = new Category($id);
            $category->setArchived(0);
            $category->setActive(0);
            $category->save();
            header('Location: /admin/archive/categoryArchive');
        }
        if ($table == "page") {
            $page = new Page($id);
            $page->setArchived(0);
            $page->setActive(0);
            $page->save();
            header('Location: /admin/archive/pageArchive');
        }
        if ($table == "tag") {
            $tag = new Tag($id);
            $tag->setArchived(0);
            $tag->save();
            header('Location: /admin/archive/tagArchive');
        }
        if ($table == "menu") {
            $menu = new Menu($id);
            $menu->setArchived(0);
            $menu->save();
            header('Location: /admin/archive/menuArchive');
        }
        if ($table == "media") {
            $media = new Media($id);
            $media->setArchived(0);
            $media->save();
            header('Location: /admin/archive/mediaArchive');
        }
    }
}
