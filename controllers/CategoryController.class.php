<?php


class CategoryController
{
    public function indexAction()
    {
        $v = new View("categoriesList", "frontend");
        $category = new Category(-1);
        $allCategories = $category->getAll(0, "DESC", 1);
        $v->assign("allCategories", $allCategories);
    }
    public function showAction()
    {
        $v = new View("articleCategory", "frontend");
        $category = new Category(-1);
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[2];
        $article = new Article(-1);
        $category = new Category(-1);
        $thisCategory = $category->getOneBy(["id" => $id]);
        if ($thisCategory['active'] == 0 || $thisCategory['archived'] == 1) {
            header("Location: /category");
        }
        $allArticles = $article->getAllArticles(0, "DESC", 1, 0, $id);
        $v->assign("allArticles", $allArticles);
        $v->assign("thisCategory", $thisCategory);
    }


    public function listAction()
    {
    }
}
