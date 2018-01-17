<?php

class PageController
{
    public function showAction()
    {
        $v = new View("page", "frontend");
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[2];
        $page = new Page($id);
        $active = $page ->getActive();
        $archived = $page ->getArchived();
        $title = $page->getTitle();
        if ($title == "Flux Rss") {
            header('Location: /Index/feed');
        }
        if ($active == 0 || $archived == 1) {
            header("Location: /");
        }
        $text = $page->getText();
        $v->assign("title", $title);
        $v->assign("text", $text);
    }
}
