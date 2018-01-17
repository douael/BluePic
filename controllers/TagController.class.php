<?php


class TagController
{
    public function indexAction()
    {
        $v = new View("tagList", "frontend");
        $media = new Media(-1);
        $allMedia = $media->getAll();
        $v->assign("allMedia", $allMedia);
    }



    public function listAction()
    {
    }
}
