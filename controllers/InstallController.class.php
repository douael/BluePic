<?php

class InstallController
{
    public function indexAction()
    {
        $v = new View("install/index", "empty");
    }


    public function configAction()
    {
        $v = new View("install/config", "empty");
    }
    public function saveConfigAction()
    {
        $data = $_POST;

        include './assets/foodcms.php';

        $user = new User(-1, $data['email'], null, $data['username'], $data['firstname'], $data['lastname'], 1);
        $user->setPassword($data['pwd']);
        $user->save();

        session_start();
        $_SESSION['id']         = $user->getId();
        $_SESSION['username']   = $user->getUsername();
        $_SESSION['role']       = $user->getRoleId();

        header('Location: /admin');
    }
}
