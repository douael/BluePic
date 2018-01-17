<?php


class BackController
{
    public function indexAction()
    {
        $v = new View("admin/index", "backend");

        $article = new Article(-1);
        $allArticle = $article->getAll(0, "DESC");
        $articleVariables = array('article1' => 0, 'article2' => 0, 'article3' => 0, 'article4' => 0, 'article5' => 0, 'articleTotal' => 0);
        foreach ($allArticle as $i => $value) {
            $articleMonthExploded = explode("-", $allArticle[$i]['utime']);
            if (!isset($articleMonthExploded[1])) {
                $articleMonthExploded = explode("-", $allArticle[$i]['ctime']);
            }
            if ($i == 0) {
                $articleMonthFirst = intval($articleMonthExploded[1]);
            }
            $articleMonth = intval($articleMonthExploded[1]);
            if ($articleMonth == $articleMonthFirst) {
                $articleVariables['article1']++;
            }
            if ($articleMonth == $articleMonthFirst - 1) {
                $articleVariables['article2']++;
            }
            if ($articleMonth == $articleMonthFirst - 2) {
                $articleVariables['article3']++;
            }
            if ($articleMonth == $articleMonthFirst - 3) {
                $articleVariables['article4']++;
            }
            if ($articleMonth == $articleMonthFirst - 4) {
                $articleVariables['article5']++;
            }
            $articleVariables['articleTotal']++;
        }

        $comment = new Comment(-1);
        $allComment = $comment->getAll(0, "DESC");
        $commentVariables = array('comment1' => 0, 'comment2' => 0, 'comment3' => 0, 'comment4' => 0, 'comment5' => 0, 'commentTotal' => 0);
        foreach ($allComment as $i => $value) {
            $commentMonthExploded = explode("-", $allComment[$i]['utime']);
            if (!isset($commentMonthExploded[1])) {
                $commentMonthExploded = explode("-", $allComment[$i]['ctime']);
            }
            $commentMonth = intval($commentMonthExploded[1]);
            if ($commentMonth == $articleMonthFirst) {
                $commentVariables['comment1']++;
            }
            if ($commentMonth == $articleMonthFirst - 1) {
                $commentVariables['comment2']++;
            }
            if ($commentMonth == $articleMonthFirst - 2) {
                $commentVariables['comment3']++;
            }
            if ($commentMonth == $articleMonthFirst - 3) {
                $commentVariables['comment4']++;
            }
            if ($commentMonth == $articleMonthFirst - 4) {
                $commentVariables['comment5']++;
            }
            $commentVariables['commentTotal']++;
        }

        $v->assign("articleVariables", $articleVariables);
        $v->assign("commentVariables", $commentVariables);
        $v->assign("articleMonthFirst", $articleMonthFirst);

        $article2 = new Article(-1);
        $lastArticles = $article2->getAll(3, "DESC", 1);
        $v->assign("lastArticles", $lastArticles);

        $comment2 = new Comment(-1);
        $lastComment = $comment2->getAll(3, "DESC", 0);
        $v->assign("lastComment", $lastComment);

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if ($value == "connected") {
                    $v->assign("connected", "Vous êtes connecté");
                }
            }
        }
    }
    public function loginAction()
    {
        $v = new View("admin/login", "empty");
    }
    public function page404Action($params)
    {
        $v = new View("/admin/404", "empty");
    }
    public function loginVerifAction()
    {
        $data = $_POST;
        $user = new User(0);
        $user->getUserByUsername($data['login']);

        session_destroy();

        if (password_verify($data['pwd'], $user->getPassword())) {
            if ($user->getStatus() == 0) {
                header('Location: /Index/login/verify');
                exit();
            }
            session_start();
            $_SESSION['id']         = $user->getId();
            $_SESSION['username']   = $user->getUsername();
            $_SESSION['role']   = $user->getRoleId();

            header('Location: /admin');
        } else {
            header('Location: /Index/login/error');
            exit();
        }
    }

    public function logoutAction()
    {
        session_destroy();
        header('Location: /admin/back/login');
    }
}
