<?php

class UserController
{
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
            header('Location: /Index/index/connected');
        } else {
            header('Location: /Index/login/error');
            exit();
        }
    }

    public function logoutAction()
    {
        session_destroy();
    }

    public function resetPassword($params)
    {
        $email = $params[0];
        $user = new User(0);
        if (!$user->getUserByEmail($email)) {
            header('Location: /Index/login/wrongAccount');
            exit();
        } else {
            $variables['username']   = $user->getUsername();
            $variables['pwd']        = $user->generateNewPassword();

            $mail = new Mailer($user->getEmail(), "Votre nouveau mot de passe", "resetPassword", $variables);
            $mail->send();

            header('Location: /Index/login/newPassword');
            exit();
        }
    }
    public function showAction()
    {
        $v = new View("showUser", "frontend");
        $user = new User(-1);
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[2];
        if ($id == $_SESSION['id']) {
            $thisUser = $user->getOneBy(["id" => $id]);
            $v->assign("thisUser", $thisUser);
        } else {
            header('Location: /Index');
        }
    }
    public function registerAction($params)
    {
        $data = $_POST;

        $user = new User(-1, $data['email'], null, $data['username'], $data['firstname'], $data['lastname'], 3);

        if ($user->getUserByEmail($data['email'])) {
        }

        $user->setPassword($data['pwd']);
        $user->save();

        $variables['username']  = $user->getUsername();
        $variables['hostname']  = HOSTNAME;
        $variables['token']     = $user->getToken();

        $mail = new Mailer($user->getEmail(), "Confirmation d'inscription", "register", $variables);
        $mail->send();

        header('Location: /Index/login/verify');
        exit();
    }
    public function editAction()
    {
        $data = $_POST;
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        $id = $link[2];
        $user = new User($id);
        $user->setUsername($data['username']);
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $user->setEmail($data['email']);
        if ($data['pwd'] != "") {
            $user->setPassword($data['pwd']);
        }
        $user->setRoleId($_SESSION['role']);
        $user->setArchived(0);
        $user->setActive(1);
        $user->save();
        header('Location: /user/show/'.$id);
    }
    public function resetAction()
    {
    }


    public function validateRegistrationAction($params)
    {
        $token = $params[0];
        $user = new User(0);

        if ($user->getUserByToken($token)) {
            $user->setStatus(1);
            $user->save();

            header('Location: /Index/login/tokenVerified');
            exit();
        } else {
            header('Location: /Index/login/wrongAccount');
            exit();
        }
    }
}
