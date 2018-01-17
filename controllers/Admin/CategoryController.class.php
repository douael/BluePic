<?php


class CategoryController
{
    public function indexAction()
    {
        $v = new View("admin/category", "backend");
        $category = new Category(-1);
        $allCategory = $category->getAll();
        $v->assign("allCategory", $allCategory);
    }
    public function showAction()
    {
        $v = new View("admin/category", "backend");
        $category = new Category(-1);
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $allCategory = $category->getAll();
        $thisCategory = $category->getOneBy(["id" => $id]);
        $v->assign("allCategory", $allCategory);
        $v->assign("thisCategory", $thisCategory);
    }
    public function listAction()
    {
        $v= new View("admin/categoryList", "backend");
    }

    public function createAction()
    {
        $data = $_POST;
        if (!isset($data['active'])) {
            $data['active'] = 0;
        } else {
            $data['active'] = 1;
        }
        $category = new Category(-1, $data['title'], $data['active']);
        $category->save();

        header("Location: /admin/category");
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
        $category = new Category($id);
        $category->setTitle($data['title']);
        $category->setActive($data['active']);
        $category->save();
        header('Location: /admin/category/show/'.$id);
    }

    public function deleteAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $category = new Category($id);
        $category->setArchived(1);
        $category->setActive(0);
        $category->save();
        header('Location: /admin/category/');
    }
}
