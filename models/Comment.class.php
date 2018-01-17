<?php

    class Comment extends BaseSql
    {
        protected $id;
        protected $text;
        protected $active;
        protected $archived;
        protected $food_user_id;
        protected $article_id;
        protected $ctime;
        protected $utime;

        public function __construct($id, $text = null, $active = null, $archived = null, $user = null, $article = null, $ctime = null, $utime = null)
        {
            parent::__construct();

            if ($id > 0) {
                $comment = parent::getOneBy(["id" => $id]);

                $this->id           = $comment['id'];
                $this->text        = $comment['text'];
                $this->active         = $comment['active'];
                $this->archived    = $comment['archived'];
                $this->food_user_id       = $comment['food_user_id'];
                $this->article_id         = $comment['article_id'];
                $this->ctime        = $comment['ctime'];
                $this->utime        = $comment['utime'];
            } else {
                $this->id           = $id;
                $this->setText($text);
                $this->active         = $active;
                $this->archived    = $archived;
                $this->food_user_id       = $user;
                $this->article_id         = $article;
                $this->ctime        = $ctime;
                $this->utime        = $utime;
            }
        }
        
        public function getId()
        {
            return $this->id;
        }

        public function getText()
        {
            return $this->text;
        }

        public function getActive()
        {
            return $this->active;
        }

        public function getArchived()
        {
            return $this->archived;
        }

        public function getFoodUserId()
        {
            return $this->food_user_id;
        }

        public function getArticleId()
        {
            return $this->article_id;
        }


        public function setId($id)
        {
            $this->id = $id;
        }
        public function setText($text)
        {
            $this->text = Tools::antiXSS($text);
        }

        public function setActive($active)
        {
            $this->active = $active;
        }
        public function setArchived($archived)
        {
            $this->archived = $archived;
        }

        public function setFoodUserId($user)
        {
            $this->food_user_id = $user;
        }

        public function setArticleId($article)
        {
            $this->article_id = $article;
        }

        public function getCtime()
        {
            $date = new DateTime($this->ctime);
            return $date->format("j M Y G:i");
        }
        public function setCtime($ctime)
        {
            $this->ctime = $ctime;
        }
        public function getUtime()
        {
            $date = new DateTime($this->utime);
            return $date->format("j M Y G:i");
        }
        public function setUtime($utime)
        {
            $this->utime = $utime;
        }

        public static function getCommentCreationForm()
        {
            return [
                "options"=>[
                    "method"    =>"POST",
                    "action"    =>"/admin/article/register",
                    "class"     =>"form-group",
                    "id"        =>"articleCreationForm",
                    "submit"    =>"Ajouter"
                ],

                "struct"=>[
                    [
                        "fieldset"=> "",
                        "elements"=>[
                            "text"=>[
                                "id"            =>"text",
                                "label"         =>"Contenu :",
                                "type"          =>"textarea",
                                "placeholder"   =>"Votre contenu",
                                "text"          =>"",
                                "readonly"      =>false,
                                "required"      =>true
                            ],
                            "active"=>[
                                "id"            =>"active",
                                "label"         =>"Mettre en ligne :",
                                "type"          =>"checkbox",
                                "checked"       =>0,
                                "required"      =>false
                            ]
                        ]
                    ]
                ]
            ];
        }

        public static function getCommentEditForm($thisComment)
        {
            return [
                "options"=>[
                    "method"    =>"POST",
                    "action"    =>"/admin/comment/delete/".$thisComment['id'],
                    "class"     =>"form-group",
                    "id"        =>"commentEditForm",
                    "submit"    =>"Archiver"
                ],

                "struct"=>[
                    [
                        "fieldset"=> "",
                        "elements"=>[
                            "text"=>[
                                "id"            =>"text",
                                "label"         =>"Contenu :",
                                "type"          =>"textarea",
                                "placeholder"   =>"Votre contenu",
                                "text"   =>$thisComment['text'],
                                "required"      =>false,
                                "readonly"      =>true
                            ]
                        ]
                    ]
                ]
            ];
        }
        public static function getCommentArchivedForm($thisComment)
        {
            return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/comment/delete/".$thisComment['id'],
                "class"     =>"form-delete",
                "id"        =>"commentDeleteForm",
                "submit"    =>"Archiver"
                ],
            "struct"=>[]
            ];
        }
    }
