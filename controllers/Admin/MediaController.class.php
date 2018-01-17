<?php

class MediaController
{
    public function indexAction()
    {
        $v = new View("admin/media", "backend");
        $media = new Media(-1);
        $allMedia = $media->getAll();
        $v->assign("allMedia", $allMedia);
        $tag = new Tag(-1);
        $allTag = $tag->getAll();
        $v->assign("allTag", $allTag);
    }
    public function listAction()
    {
    }

    public function createAction()
    {
        $data = $_POST;
        $id=$data['tag'];
        $tag = new Tag(-1);
        $thisTag = $tag->getOneBy(["id" => $id]);
        $avatarFileType = ["png", "jpg", "jpeg", "gif"];
        $avatarLimitSize = 10000000;
        $infoFile = pathinfo($_FILES["media"]["name"]);
        if (!in_array(strtolower($infoFile["extension"]), $avatarFileType)) {
            $error = true;
            echo '1';
        }

        if ($_FILES["media"]["size"]>$avatarLimitSize) {
            $error = true;
            echo '2';
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
        $exist = false;
        $idMedia=0;
        $media = new Media(-1);
        $allMedia = $media->getAll();
        foreach ($allMedia as $key => $value) {
            if ($allMedia[$key]["title"]==$thisTag['name']) {
                $exist= true;
                $idMedia=$allMedia[$key]["id"];
            }
        }
        if ($exist ==true) {
            move_uploaded_file($_FILES["media"]["tmp_name"], $avatar);
            $menu = new Media($idMedia);
            $menu->setLink($avatar1);
            $menu->save();
        } else {
            move_uploaded_file($_FILES["media"]["tmp_name"], $avatar);

            $menu = new Media(-1, $thisTag['name'], $avatar1, $id);
            $menu->save();
        }
        header("Location: /admin/media");
    }

    public function editAction()
    {
        $data = $_POST;
        // faux trouver où récupérer le data[id]
        $media = new Media($data['id']);
        $media->setName($data['name']);
        $media->save();

        header("Location: /admin/media");
    }

    public function deleteAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $media = new Media($id);
        $media->setArchived(1);
        $media->save();

        header("Location: /admin/media");
    }
}
