<?php

class View
{
    private $view;
    private $template;

    public function __construct($view = "index", $template = "frontend")
    {
        $this->setView($view);
        $this->setTemplate($template);
    }

    public function setView($view)
    {
        if (file_exists("views/".$view.".view.php")) {
            $this->view = $view;
        } else {
            // logs
            die("La vue n'existe pas");
        }
    }

    public function setTemplate($template)
    {
        if (file_exists("views/".$template.".view.php")) {
            $this->template = $template;
        } else {
            // logs

            die("Le template n'existe pas");
        }
    }

    public function includeAlert($type, $text)
    {
        if (file_exists("views/modals/alert.mod.php")) {
            include "views/modals/alert.mod.php";
        } else {
            // logs
            die("Le modal n'existe pas");
        }
    }

    public function includeModal($modal, $config)
    {
        if (file_exists("views/modals/".$modal.".mod.php")) {
            include "views/modals/".$modal.".mod.php";
        } else {
            // logs
            die("Le modal n'existe pas");
        }
    }

    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __destruct()
    {
        if (!empty($this->data)) {
            extract($this->data);
        }
        include "views/".$this->template.".view.php";
    }
}
