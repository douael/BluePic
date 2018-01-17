<?php

class Routing
{
    private $uri;
    private $uriExploded;

    private $controller;
    private $controllerName;
    private $action;
    private $actionName;
    private $params;

    public function __construct()
    {
        $this->setUri($_SERVER["REQUEST_URI"]);
        $this->setController();
        $this->setAction();
        $this->setParams();
        $this->runRoute();
    }

    public function setUri($uri)
    {
        $uri = preg_replace("/".PATH_RELATIVE_PATTERN."/i", "", $uri, 1);
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
    }

    public function setController()
    {
        if ($this->uriExploded[0]=="admin") {
            $this->controller = (empty($this->uriExploded[1])) ? "back" : $this->uriExploded[1];
            $this->controllerName = $this->controller."Controller";
        } else {
            $this->controller = (empty($this->uriExploded[0])) ? "index" : $this->uriExploded[0];
            $this->controllerName = $this->controller."Controller";
        }
    }

    public function setAction()
    {
        if ($this->uriExploded[0] == "admin") {
            $this->action = (empty($this->uriExploded[2])) ? "index" : $this->uriExploded[2];
            $this->actionName = $this->action."Action";
        } else {
            $this->action = (empty($this->uriExploded[1])) ? "index" : $this->uriExploded[1];
            $this->actionName = $this->action."Action";
        }
    }

    public function setParams()
    {
        if ($this->uriExploded[0] == "admin") {
            for ($i=3; $i<count($this->uriExploded); $i++) {
                $this->params[] = $this->uriExploded[$i];
            }
        } else {
            for ($i=2; $i<count($this->uriExploded); $i++) {
                $this->params[] = $this->uriExploded[$i];
            }
        }
    }

    /*
    - est-ce que le fichier existe correspondant au controleur
    - est-ce qu'on peut créer un objet à partir de ce controleur
    - est-ce que dans l'objet il y a cette méthode
    - s'il y a cette méthode on retourne le booléen, sinon on retourne false
    */

    public function checkRoute()
    {
        if ($this->uriExploded[0]=="admin") {
            $pathController = "controllers".DS."Admin".DS.ucfirst($this->controllerName).".class.php";
        } else {
            $pathController = "controllers".DS.ucfirst($this->controllerName).".class.php";
        }
        if (!file_exists($pathController)) {
            Helpers::log("Le contrôleur ".$this->controllerName." n'existe pas.");
            return false;
        }

        include $pathController;

        if (!class_exists($this->controllerName)) {
            Helpers::log("La classe ".$this->controllerName." n'existe pas.");
            return false;
        }

        if (!method_exists($this->controllerName, $this->actionName)) {
            Helpers::log("La méthode ".$this->actionName." n'existe pas dans la classe ".$this->controllerName.".");
            return false;
        }

        return true;
    }

    public function runRoute()
    {
        if ($this->checkRoute()) {
            if (isset($this->uriExploded[1])) {
                if ($this->uriExploded[0] == "admin" && $this->uriExploded[1] == "back" && $this->uriExploded[2] == "login") {
                    $controller = new $this->controllerName;
                    $controller->{$this->actionName}($this->params);
                    exit();
                }
            }
            if ($this->uriExploded[0] == "admin") {
                if (!isset($_SESSION['username'])) {
                    header('Location: /admin/back/login');
                } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 3) {
                    header('Location: /admin/back/login');
                } elseif (isset($this->uriExploded[1]) && $_SESSION['role'] != 1) {
                    if ($this->uriExploded[0] == "admin" && $this->uriExploded[1] == "user") {
                        header('Location: /admin');
                    } elseif ($this->uriExploded[0] == "admin" && $this->uriExploded[1] == "menu") {
                        header('Location: /admin');
                    } elseif ($this->uriExploded[0] == "admin" && $this->uriExploded[1] == "menuElement") {
                        header('Location: /admin');
                    }
                }
            }

            $controller = new $this->controllerName;
            $controller->{$this->actionName}($this->params);
        } else {
            $this->page404();
        }
    }

    public function page404()
    {
        if ($this->uriExploded[0] == "admin") {
            header('Location: /admin/back/page404');
        } else {
            header('Location: /Index/page404');
        }
    }
}
