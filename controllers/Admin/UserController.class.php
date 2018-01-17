<?php

class UserController
{
    public function indexAction()
    {
        $v = new View("admin/user", "backend");
        $user = new User(-1);
        $allUsers = $user->getAll();
        $v->assign("allUsers", $allUsers);
    }

    public function showAction()
    {
        $v = new View("admin/user", "backend");
        $user = new User(-1);
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $allUsers = $user->getAll();
        $thisUser = $user->getOneBy(["id" => $id]);
        $v->assign("allUsers", $allUsers);
        $v->assign("thisUser", $thisUser);
    }

    public function addAction()
    {
        $data = $_POST;
        $user = new User(-1, $data['email'], null, $data['username'], $data['firstname'], $data['lastname'], $data['role_id']);

        if ($user->getUserByEmail($data['email'])) {
        }

        $user->setPassword($data['pwd']);
        $user->save();

        $variables['username']  = $user->getUsername();
        $variables['hostname']  = HOSTNAME;
        $variables['token']     = $user->getToken();

        $mail = new Mailer($user->getEmail(), "Confirmation d'inscription", "register", $variables);
        $mail->send();

        header('Location: /admin/user');
    }
    public function editAction()
    {
        $data = $_POST;
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $user = new User($id);
        $user->setUsername($data['username']);
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $user->setEmail($data['email']);
        if ($data['pwd'] != "") {
            $user->setPassword($data['pwd']);
        }
        $user->setRoleId($data['role_id']);
        $user->setArchived(0);
        $user->setActive(1);
        $user->save();
        header('Location: /admin/user/show/'.$id);
    }
    public function deleteAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[3];
        $user = new User($id);
        $user->setArchived(1);
        $user->setActive(0);
        $user->save();
        print_r($user);
        header('Location: /admin/user/');
    }
    public function listAction()
    {
    }
    public function resetAction()
    {
    }

    public function loginAction()
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
            header('Location: /admin/back/login/error');
            exit();
        }
    }

    public function logoutAction()
    {
        print_r($_SESSION);
        session_destroy();
        header('Location: /admin/back/login');
    }
}
