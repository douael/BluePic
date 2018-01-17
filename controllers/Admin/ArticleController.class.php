<?php


class ArticleController
{
    public function indexAction()
    {
        $v = new View("admin/articleCreate", "backend");
        $article = new Article(-1);
        $allArticles = $article->getAll(0, "DESC", "", 0);
        $v->assign("allArticles", $allArticles);
    }

    public function showAction()
    {
        $v = new View("admin/articleEdit", "backend");
        $article = new Article(-1);
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];

        $allArticles = $article->getAll(0, "DESC", "", 0);
        $thisArticle = $article->getOneBy(["id" => $id]);
        $v->assign("allArticles", $allArticles);
        $v->assign("thisArticle", $thisArticle);
    }
    public function listAction()
    {
        $v= new View("admin/articleList", "backend");
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
        $article = new Article($id);
        $article->setTitle($data['title']);
        $article->setText($data['text']);

        var_dump($_FILES);

        if (isset($_FILES["thumbnail"]["name"]) && $_FILES["thumbnail"]["name"] != "") {
            $error = false;
            $avatarFileType = ["png", "jpg", "jpeg", "gif"];
            $avatarLimitSize = 10000000;
            $error = false;
            $infoFile = pathinfo($_FILES["thumbnail"]["name"]);

            if (!in_array(strtolower($infoFile["extension"]), $avatarFileType)) {
                $error = true;
            }

            if ($_FILES["thumbnail"]["size"]>$avatarLimitSize) {
                $error = true;
            }

            //Est ce que le dossier upload existe
            $pathUpload ="./assets/media";
            $pathUpload1 ="/assets/media";
            if (!file_exists($pathUpload)) {
                //Sinon le créer
                mkdir($pathUpload);
            }
            //Déplacer l'avatar dedans
            $nameAvatar =uniqid().".". strtolower($infoFile["extension"]);
            $avatar =$pathUpload."/".$nameAvatar;
            $avatar1 =$pathUpload1."/".$nameAvatar;
            move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $avatar);

            $article->setThumbnail($avatar1);
        }
        $article->setActive($data['active']);
        $article->setUser($_SESSION['id']);
        $article->setCategory($data['food_category_id']);
        $article->save();
        header('Location: /admin/article/show/'.$id);
    }

    public function deleteAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $article = new Article($id);
        $article->setArchived(1);
        $article->setActive(0);
        $article->save();
        header('Location: /admin/article/');
    }

    public function createAction()
    {
        $v= new View("admin/articleCreate", "backend");
        $article = new Article(-1);
        $allArticles = $article->getAll();
        $v->assign("allArticles", $allArticles);
    }


    public function registerAction()
    {
        $data = $_POST;
        $error = false;
        $avatarFileType = ["png", "jpg", "jpeg", "gif"];
        $avatarLimitSize = 10000000;
        $error = false;
        $infoFile = pathinfo($_FILES["thumbnail"]["name"]);

        if (!in_array(strtolower($infoFile["extension"]), $avatarFileType)) {
            $error = true;
        }

        if ($_FILES["thumbnail"]["size"]>$avatarLimitSize) {
            $error = true;
        }

        //Est ce que le dossier upload existe
        $pathUpload ="./assets/media";
        $pathUpload1 ="/assets/media";
        if (!file_exists($pathUpload)) {
            //Sinon le créer
            mkdir($pathUpload);
        }
        //Déplacer l'avatar dedans
        $nameAvatar = uniqid().".". strtolower($infoFile["extension"]);
        $avatar = $pathUpload."/".$nameAvatar;
        $avatar1 = $pathUpload1."/".$nameAvatar;
        move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $avatar);
        if ($data['active'] == "on" || $data['active'] === 1) {
            $active = 1;
        } elseif ($data['active'] == "off" || $data['active'] === 0) {
            $active = 0;
        }

        if (!$error) {
            $article = new Article(-1, $data['title'], $data['text'], $avatar1, $active, $_SESSION['id'], $data['food_category_id']);
            $article->save();
            header('Location: /admin/article');
        } else {
            echo "Erreur d'upload d'image";
        }

        header('Location: /admin/article');
    }


    public function getTagsAction()
    {
        $text = $_POST['text'];
        $text = array_filter($text, function ($value) {
            return $value !== '';
        });

        $words = [];

        foreach ($text as $line) {
            $wordsLine = explode(' ', $line);

            foreach ($wordsLine as $word) {
                $word = preg_replace("/(\w{4,})s/u", "$1", $word);
                $words[] = strtolower($word);
            }
        }

        $tag = new Tag(-1);
        $tags_array = $tag->getAll();

        $arrayTagsInText = [];

        foreach ($tags_array as $key => $tag) {
            if (in_array($tag['name'], $words)) {
                $arrayTagsInText[] = ["id" => $tag['id'],
        "name" => $tag['name']
      ];
            }
        }

        echo json_encode($arrayTagsInText);
    }

    public function saveTagsAction($params = null)
    {
        if (isset($params[0])) {
            $idArticle = $params[0];
        } else {
            $article  = new Article(-1);
            $idArticle = $article->getLastId();
            $idArticle++;
        }

        $tags = $_POST['idList'];

        $tagArticleAssociation = new TagArticleAssociation(-1, -1);
        $tagArticleAssociation->deleteTagsForArticle($idArticle);
        unset($tagArticleAssociation);

        foreach ($tags as $idTag) {
            $tagArticleAssociation = new TagArticleAssociation($idTag, $idArticle);
            $tagArticleAssociation->Save();
            unset($tagArticleAssociation);
        }
    }
}
