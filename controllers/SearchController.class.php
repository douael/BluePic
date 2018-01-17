<?php

/**
 * Created by PhpStorm.
 * User: robilol
 * Date: 13/06/17
 * Time: 14:03
 */
class SearchController
{
    public function indexAction()
    {
        $v = new View("search");

        $tag = new Tag(-1);
        $category = new Category(-1);

        $tags_array = $tag->getAll();
        $v->assign("tagsArray", $tags_array);

        $categories_array = $category->getAllCategories();
        $v->assign("categoriesArray", $categories_array);
    }

    public function searchAction()
    {
        $data = $_POST;

        try {
            $this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
        } catch (Exception $e) {
            die("Erreur SQL : ".$e->getMessage());
        }


        if (isset($data["searchInput"])) {
            $name = $data["searchInput"];
        } else {
            $name = "";
        }


        $sql = "SELECT DISTINCT(a.id)
                      FROM ".DB_PREFIXE."article a
                      LEFT JOIN ".DB_PREFIXE."tag_article ta ON a.id = ta.article_id
                      WHERE
                      a.title LIKE '%".$name."%'";

        if (!empty($data["categorySelect"])) {
            $sql .= " AND food_category_id IN (";
            foreach ($data["categorySelect"] as $id) {
                $sql .= $id;
                $sql .= ",";
            }

            $sql = substr($sql, 0, -1);
            $sql .= ")";
        }

        if (!empty($data["tagSelect"])) {
            $sql .= " AND ta.tag_id IN (";
            foreach ($data["tagSelect"] as $id) {
                $sql .= $id;
                $sql .= ",";
            }

            $sql = substr($sql, 0, -1);
            $sql .= ")";
        }
            
        $sql .= " AND
        a.active = 1
        AND
        a.archived = 0";


        $query = $this->db->prepare($sql);
        $query->execute();

        $articlesId = [];

        while ($data = $query->fetch()) {
            $articlesId[] = $data['id'];
        }

        $articleArray = [];

        foreach ($articlesId as $id) {
            $article = new Article($id);
            $articleArray[] = $article;
            unset($article);
        }

        $v = new View("searchResult");
        $v->assign("articlesArray", $articleArray);
    }
}
