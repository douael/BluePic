<?php

    class User extends BaseSql
    {
        protected $id;
        protected $email;
        protected $password;
        protected $username;
        protected $firstname;
        protected $lastname;
        protected $status;
        protected $token;
        protected $role_id;
        protected $active;
        protected $archived;

        /**
         * User constructor.
         * @param $id
         * @param $email
         * @param $password
         * @param $username
         * @param $firstname
         * @param $lastname
         */
        public function __construct($id, $email = null, $password = null, $username = null, $firstname = null, $lastname = null, $role_id = null)
        {
            parent::__construct();

            if ($id > 0) {
                $user = parent::getOneBy(["id" => $id]);

                $this->id           = $user['id'];
                $this->email        = $user['email'];
                $this->password     = $user['password'];
                $this->username     = $user['username'];
                $this->firstname    = $user['firstname'];
                $this->lastname     = $user['lastname'];
                $this->token        = $user['token'];
                $this->status       = $user['status'];
                $this->active       = $user['active'];
                $this->archived     = $user['archived'];
                $this->role_id      = $user['role_id'];
            } else {
                $this->id           = $id;
                $this->setEmail($email);
                $this->password     = $password;
                $this->setUsername($username);
                $this->setFirstname($firstname);
                $this->setLastname($lastname);
                $this->token        = uniqid('token', true);
                $this->status       = 0;
                $this->active       = 1;
                $this->archived     = 0;
                $this->role_id      = $role_id;
            }
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setEmail($email)
        {
            $this->email = Tools::antiXSS(trim($email));
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setPassword($pwd)
        {
            $this->password = $this->cryptPassword(Tools::antiXSS($pwd));
        }

        public function cryptPassword($pwd)
        {
            password_hash($pwd, PASSWORD_BCRYPT);
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setUsername($username)
        {
            $this->username = Tools::antiXSS($username);
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function setActive($active)
        {
            $this->active = $active;
        }

        public function getActive()
        {
            return $this->active;
        }

        public function setArchived($archived)
        {
            $this->archived = $archived;
        }

        public function getArchived()
        {
            return $this->archived;
        }
        public function setFirstname($firstname)
        {
            $this->firstname = Tools::antiXSS($firstname);
        }

        public function getFirstname()
        {
            return $this->firstname;
        }

        public function setLastname($lastname)
        {
            $this->lastname = Tools::antiXSS($lastname);
        }

        public function getLastname()
        {
            return $this->lastname;
        }

        public function setStatus($status)
        {
            $this->status = $status;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function setRoleId($role_id)
        {
            $this->role_id = $role_id;
        }

        public function getRoleId()
        {
            return $this->role_id;
        }

        /**
         * @return string
         */
        public function getToken()
        {
            return $this->token;
        }

        /**
         * @param string $token
         */
        public function setToken($token)
        {
            $this->token = $token;
        }

        public function generateNewPassword()
        {
            $pwd = uniqid("pwd");
            $this->setPassword($pwd);

            return $pwd;
        }

        public function getUserByUsername($username)
        {
            $user =  parent::getOneBy(["username" => $username]);

            if (is_null($user['id'])) {
                return false;
            }

            $this->id           = $user['id'];
            $this->email        = $user['email'];
            $this->password     = $user['password'];
            $this->username     = $user['username'];
            $this->firstname    = $user['firstname'];
            $this->lastname     = $user['lastname'];
            $this->token        = $user['token'];
            $this->status       = $user['status'];
            $this->role_id       = $user['role_id'];

            return true;
        }

        public function getUserByEmail($email)
        {
            $user =  parent::getOneBy(["email" => $email]);

            if (is_null($user['id'])) {
                return false;
            }

            $this->id           = $user['id'];
            $this->email        = $user['email'];
            $this->password     = $user['password'];
            $this->username     = $user['username'];
            $this->firstname    = $user['firstname'];
            $this->lastname     = $user['lastname'];
            $this->token        = $user['token'];
            $this->status       = $user['status'];

            return true;
        }

        public function getUserByToken($token)
        {
            $user =  parent::getOneBy(["token" => $token]);

            if (is_null($user['id'])) {
                return false;
            }

            $this->id           = $user['id'];
            $this->email        = $user['email'];
            $this->password     = $user['password'];
            $this->username     = $user['username'];
            $this->firstname    = $user['firstname'];
            $this->lastname     = $user['lastname'];
            $this->token        = $user['token'];
            $this->status       = $user['status'];

            return true;
        }

        public static function getRegisterForm()
        {
            return [
                "options"=>[
                    "method"    =>"POST",
                    "action"    =>"/user/register",
                    "class"     =>"form-group",
                    "id"        =>"registerForm",
                    "submit"    =>"S'incrire"
                ],

                "struct"=>[
                    [
                        "fieldset"=> "",
                        "elements"=>[
                            "username"=>[
                                "id"            =>"pseudo",
                                "label"         =>"Votre pseudo :",
                                "type"          =>"text",
                                "placeholder"   =>"Votre pseudo",
                                "required"      =>true
                            ],
                            "firstname"=>[
                                "id"            =>"firstname",
                                "label"         =>"Votre prenom :",
                                "type"          =>"text",
                                "placeholder"   =>"Votre prenom",
                                "required"      =>true
                            ],
                            "lastname"=>[
                                "id"            =>"lastname",
                                "label"         =>"Votre nom :",
                                "type"          =>"text",
                                "placeholder"   =>"Votre nom",
                                "required"      =>true
                            ],
                            "email"=>[
                                "id"            =>"email",
                                "label"         =>"Votre email :",
                                "type"          =>"email",
                                "placeholder"   =>"Votre email",
                                "required"      =>true
                            ],
                            "pwd"=>[
                                "id"            =>"pwd",
                                "label"         =>"Votre mot de passe :",
                                "type"          =>"password",
                                "placeholder"   =>"Votre mot de passe",
                                "required"      =>true
                            ]
                        ]
                    ]
                ]
            ];
        }

        public static function getLoginForm()
        {
            return [
                "options"=>[
                    "method"    =>"POST",
                    "action"    =>"/user/login",
                    "class"     =>"form-group",
                    "id"        =>"loginForm",
                    "submit"    =>"Se connecter"
                ],

                "struct"=>[
                    [
                        "fieldset"=> "",
                        "elements"=>[
                            "login"=>[
                                "id"            =>"login",
                                "label"         =>"Login :",
                                "type"          =>"text",
                                "placeholder"   =>"Votre login",
                                "required"      =>true
                            ],
                            "pwd"=>[
                                "id"            =>"pwd",
                                "label"         =>"Votre mot de passe :",
                                "type"          =>"password",
                                "placeholder"   =>"Votre mot de passe",
                                "required"      =>true
                            ]
                        ]
                    ]
                ]
            ];
        }
        public static function getLoginFormAdmin()
        {
            return [
                "options"=>[
                    "method"    =>"POST",
                    "action"    =>"/admin/user/login",
                    "class"     =>"form-group",
                    "id"        =>"loginForm",
                    "submit"    =>"Se connecter"
                ],

                "struct"=>[
                    [
                        "fieldset"=> "",
                        "elements"=>[
                            "login"=>[
                                "id"            =>"login",
                                "label"         =>"Login :",
                                "type"          =>"text",
                                "placeholder"   =>"Votre login",
                                "required"      =>true
                            ],
                            "pwd"=>[
                                "id"            =>"pwd",
                                "label"         =>"Votre mot de passe :",
                                "type"          =>"password",
                                "placeholder"   =>"Votre mot de passe",
                                "required"      =>true
                            ]
                        ]
                    ]
                ]
            ];
        }

        public static function getUserCreationForm()
        {
            return [
                "options"=>[
                    "method"    =>"POST",
                    "action"    =>"/admin/user/add",
                    "class"     =>"form-group",
                    "id"        =>"userCreationForm",
                    "submit"    =>"Ajouter"
                ],

                "struct"=>[
                    [
                        "fieldset"=> "",
                        "elements"=>[
                            "username"=>[
                                "id"            =>"pseudo",
                                "label"         =>"Votre pseudo :",
                                "type"          =>"text",
                                "placeholder"   =>"Votre pseudo",
                                "required"      =>true
                            ],
                            "firstname"=>[
                                "id"            =>"firstname",
                                "label"         =>"Votre prenom :",
                                "type"          =>"text",
                                "placeholder"   =>"Votre prenom",
                                "required"      =>true
                            ],
                            "lastname"=>[
                                "id"            =>"lastname",
                                "label"         =>"Votre nom :",
                                "type"          =>"text",
                                "placeholder"   =>"Votre nom",
                                "required"      =>true
                            ],
                            "email"=>[
                                "id"            =>"email",
                                "label"         =>"Votre email :",
                                "type"          =>"email",
                                "placeholder"   =>"Votre email",
                                "required"      =>true
                            ],
                            "pwd"=>[
                                "id"            =>"pwd",
                                "label"         =>"Votre mot de passe :",
                                "type"          =>"password",
                                "placeholder"   =>"Votre mot de passe",
                                "required"      =>true
                            ],
                            "role_id"=>[
                                "label"=>"Role: ",
                                "id"=>"role_id",
                                "type"=>"select",
                                "required"=>"required",
                                "option"=>[
                                    [
                                        "value"=>1,
                                        "name"=>"Administrateur",
                                        "selected"=>0
                                    ],
                                    [
                                        "value"=>2,
                                        "name"=>"Modérateur",
                                        "selected"=>0
                                    ],
                                    [
                                        "value"=>3,
                                        "name"=>"Utilisateur",
                                        "selected"=>1
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];
        }

        public static function getUserEditForm($thisUser)
        {
            $options=[
                        [
                            "value"=>1,
                            "name"=>"Administrateur",
                        ],
                        [
                            "value"=>2,
                            "name"=>"Modérateur",
                        ],
                        [
                            "value"=>3,
                            "name"=>"Utilisateur",
                        ]
                    ];

            foreach ($options as $i => $value) {
                if ($options[$i]['value'] == $thisUser['role_id']) {
                    $options[$i]['selected'] = 1;
                } else {
                    $options[$i]['selected'] = 0;
                }
            }
            return [
                "options"=>[
                    "method"    =>"POST",
                    "action"    =>"/admin/user/edit/".$thisUser['id'],
                    "class"     =>"form-group",
                    "id"        =>"userEditForm",
                    "submit"    =>"Modifier"
                ],

                "struct"=>[
                    [
                        "fieldset"=> "",
                        "elements"=>[
                            "username"=>[
                                "id"            =>"pseudo",
                                "label"         =>"Votre pseudo :",
                                "type"          =>"text",
                                "placeholder"   =>"Votre pseudo",
                                "required"      =>true,
                                "value"         =>$thisUser['username'],
                            ],
                            "firstname"=>[
                                "id"            =>"firstname",
                                "label"         =>"Votre prenom :",
                                "type"          =>"text",
                                "placeholder"   =>"Votre prenom",
                                "value"         =>$thisUser['firstname'],
                                "required"      =>true
                            ],
                            "lastname"=>[
                                "id"            =>"lastname",
                                "label"         =>"Votre nom :",
                                "type"          =>"text",
                                "placeholder"   =>"Votre nom",
                                "value"         =>$thisUser['lastname'],
                                "required"      =>true
                            ],
                            "email"=>[
                                "id"            =>"email",
                                "label"         =>"Votre email :",
                                "type"          =>"email",
                                "placeholder"   =>"Votre email",
                                "value"         =>$thisUser['email'],
                                "required"      =>true
                            ],
                            "pwd"=>[
                                "id"            =>"pwd",
                                "label"         =>"Votre mot de passe :",
                                "type"          =>"password",
                                "placeholder"   =>"Votre mot de passe",
                                "required"      =>false
                            ],
                            "role_id"=>[
                                "label"=>"Role: ",
                                "id"=>"role_id",
                                "type"=>"select",
                                "required"=>"required",
                                "option"=>$options
                            ]
                            
                        ]
                    ]
                ]
            ];
        }
        public static function getUserArchivedForm($thisUser)
        {
            return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/user/delete/".$thisUser['id'],
                "class"     =>"form-delete",
                "id"        =>"userDeleteForm",
                "submit"    =>"Archiver"
                ],
            "struct"=>[]
            ];
        }
    }
