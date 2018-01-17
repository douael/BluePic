<?php


class ArticleController
{
    public function indexAction()
    {
        $v = new View("articleList", "frontend");
        $article = new Article(-1);
        $allArticles = $article->getAll(0, "DESC", 1);
        $v->assign("allArticles", $allArticles);
    }


    public function showAction()
    {
        $v = new View("showArticle", "frontend");
        $article = new Article(-1);
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[2];
        $comment = new Comment(-1);
        $allComment = $comment->getAllComment(0, "DESC", 1, 0, $id);
        $v->assign("allComment", $allComment);
        $thisArticle = $article->getOneBy(["id" => $id]);
        if ($thisArticle['active'] == 0 || $thisArticle['archived'] == 1) {
            header("Location: /article");
        }

        $user = new User(-1);
        $userId = $thisArticle['food_user_id'];
        $thisUser = $user->getOneBy(["id" => $userId]);

        $tags = [];
        $tagArticle = new TagArticleAssociation(-1, -1);
        $allTagArticle = $tagArticle->getTagForArticle($id);
        if ($allTagArticle) {
            foreach ($allTagArticle as $value) {
                $tag = new Tag($value['tag_id']);
                $name = $tag->getName();
                $tags[] .= $name;
            }
        }
        $v->assign("tags", $tags);
        $v->assign("thisArticle", $thisArticle);
        $v->assign("thisUser", $thisUser);
    }
    public function createCommentAction()
    {
        $data = $_POST;


        $comment = new Comment(-1, $data['comment'], 0, 0, $_SESSION['id'], $data['id']);
        $comment->save();

        header("Location: /article/show/".$data['id']);
    }
}
