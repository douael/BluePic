<?php


    class Article extends BaseSql
    {
        protected $id;
        protected $title;
        protected $text;
        protected $thumbnail;
        protected $active;
        protected $food_user_id;
        protected $archived;
        protected $ctime;
        protected $utime;
        protected $food_category_id;

        /**
         * Article constructor.
         * @param $id
         * @param $title
         * @param $text
         * @param $thumbnail
         * @param $active
         * @param $user
         * @param $archived
         * @param $ctime
         * @param $utime
         * @param $category
         */
        public function __construct($id, $title = null, $text = null, $thumbnail = null, $active = null, $user = null, $category = null, $archived = 0, $ctime = null, $utime = null)
        {
            parent::__construct();

            if ($id > 0) {
                $article = parent::getOneBy(["id" => $id]);

                $this->id           = $article['id'];
                $this->title        = $article['title'];
                $this->text         = $article['text'];
                $this->thumbnail    = $article['thumbnail'];
                $this->active       = $article['active'];
                $this->food_user_id         = $article['food_user_id'];
                $this->food_category_id         = $article['food_category_id'];
                $this->archived     = $article['archived'];
                $this->ctime        = $article['ctime'];
                $this->utime        = $article['utime'];
            } else {
                $this->id = $id;
                $this->setTitle($title);
                $this->setText($text);
                $this->setThumbnail($thumbnail);
                $this->setActive($active);
                $this->food_user_id = $user;
                $this->archived = $archived;
                $this->ctime = $ctime;
                $this->utime = $utime;
                $this->food_category_id = $category;
            }
        }

        /**
         * @param mixed $text
         */
        public function setText($text)
        {
            $this->text = Tools::antiXSS($text);
        }

        /**
         * @param mixed $id_user
         */

        public function setUser($food_user_id)
        {
            $this->food_user_id = $food_user_id;
        }

        public function setCategory($food_category_id)
        {
            $this->food_category_id = $food_category_id;
        }
        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getActive()
        {
            return $this->active;
        }

        /**
         * @return mixed
         */
        public function getArchived()
        {
            return $this->archived;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @return mixed
         */
        public function getFoodUserId()
        {
            return $this->food_user_id;
        }

        public function getFoodCategoryId()
        {
            return $this->food_category_id;
        }

        /**
         * @return mixed
         */
        public function getText()
        {
            return $this->text;
        }

        /**
         * @return mixed
         */
        public function getThumbnail()
        {
            return $this->thumbnail;
        }

        /**
         * @return mixed
         */
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * @param mixed $active
         */
        public function setActive($active)
        {
            $this->active = $active;
        }

        /**
         * @param mixed $archived
         */
        public function setArchived($archived)
        {
            $this->archived = $archived;
        }

        /**
         * @param mixed $thumbnail
         */
        public function setThumbnail($thumbnail)
        {
            $this->thumbnail = Tools::antiXSS($thumbnail);
        }

        /**
         * @param mixed $title
         */
        public function setTitle($title)
        {
            $this->title = Tools::antiXSS($title);
        }


        /**
         * Gets the value of ctime.
         *
         * @return mixed
         */
        public function getCtime()
        {
            $date = new DateTime($this->ctime);
            return $date->format("j M Y");
        }

        /**
         * Sets the value of ctime.
         *
         * @param mixed $ctime the date created
         *
         * @return self
         */
        protected function setCtime($ctime)
        {
            $this->ctime = $ctime;
        }

        /**
         * Gets the value of utime.
         *
         * @return mixed
         */
        public function getUtime()
        {
            $date = new DateTime($this->utime);
            return $date->format("j M Y G:i");
        }

        /**
         * Sets the value of utime.
         *
         * @param mixed $utime the date modified
         *
         * @return self
         */
        protected function setUtime($utime)
        {
            $this->utime = $utime;
        }

        public static function getArticleCreationForm()
        {
            $options= [];
            $category = new Category(-1);
            $allCategory = $category->getAll(0, "ASC", 1);
            foreach ($allCategory as $i => $value) {
                $options[] =
                        [
                            "value"=>$allCategory[$i]['id'],
                            "name"=>$allCategory[$i]['title'],
                            "selected"=>0,
                        ];
            }

            /* foreach ($options as $i => $value) {
                 if ($options[$i]['value'] == $thisArticle['food_category_id'])
                     $options[$i]['selected'] = 1;
                 else
                     $options[$i]['selected'] = 0;
             }*/
            return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/article/register",
                "class"     =>"form-group",
                "id"        =>"articleCreationForm",
                "button"    =>"Ajouter"
            ],

            "struct"=>[
                [
                    "fieldset"=> "",
                    "elements"=>[
                        "title"=>[
                            "id"            =>"title",
                            "label"         =>"Titre :",
                            "type"          =>"text",
                            "placeholder"   =>"Votre titre",
                            "required"      =>true
                        ],
                        "thumbnail"=>[
                            "label"         =>"Image :",
                            "type"          =>"file",
                            "placeholder"   =>"Votre image",
                            "required"      =>true
                        ],
                        "food_category_id"=>[
                                "label"=>"Catégorie: ",
                                "id"=>"food_category_id",
                                "type"=>"select",
                                "required"=>"required",
                                "option"=>$options
                            ],
                        "text"=>[
                            "id"            =>"text",
                            "label"         =>"Contenu :",
                            "type"          =>"textarea",
                            "placeholder"   =>"Votre contenu",
                            "required"      =>true,
                            "readonly"      =>false,
                            "text"          =>""
                        ],
                        "active"=>[
                            "id"            =>"active",
                            "label"         =>"Mettre en ligne :",
                            "type"          =>"checkbox",
                            "checked"       =>1,
                            "required"      =>false
                        ]
                    ]
                ]
            ]
        ];
        }

        public static function getArticleEditForm($thisArticle)
        {
            $options= [];
            $category = new Category(-1);
            $allCategory = $category->getAll(0, "ASC", 1);
            foreach ($allCategory as $i => $value) {
                $options[] =
                        [
                            "value"=>$allCategory[$i]['id'],
                            "name"=>$allCategory[$i]['title'],
                            
                        ];
            }

            foreach ($options as $i => $value) {
                if ($options[$i]['value'] == $thisArticle['food_category_id']) {
                    $options[$i]['selected'] = 1;
                } else {
                    $options[$i]['selected'] = 0;
                }
            }
            return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/article/edit/".$thisArticle['id'],
                "class"     =>"form-group",
                "id"        =>"articleEditForm",
                "button"    =>"Modifier"
            ],

            "struct"=>[
                [
                    "fieldset"=> "",
                    "elements"=>[
                        "title"=>[
                            "id"            =>"title",
                            "label"         =>"Titre :",
                            "type"          =>"text",
                            "placeholder"   =>$thisArticle['title'],
                            "value"         =>$thisArticle['title'],
                            "required"      =>true
                        ],
                        "thumbnail"=>[
                            "id"            =>"thumbnail",
                            "label"         =>"Image :",
                            "type"          =>"file",
                            "placeholder"   =>"Votre image",
                            "value"         =>$thisArticle['thumbnail'],
                            "required"      =>false
                        ],
                        "food_category_id"=>[
                                "label"=>"Catégorie: ",
                                "id"=>"food_category_id",
                                "type"=>"select",
                                "required"=>"required",
                                "option"=>$options
                            ],
                        "text"=>[
                            "id"            =>"text",
                            "label"         =>"Contenu :",
                            "type"          =>"textarea",
                            "placeholder"   =>$thisArticle['text'],
                            "value"         =>$thisArticle['text'],
                            "required"      =>true,
                            "readonly"      =>false,
                            "text"          =>$thisArticle['text']
                        ],
                        "active"=>[
                            "id"            =>"active",
                            "label"         =>"Mettre en ligne :",
                            "type"          =>"checkbox",
                            "checked" => $thisArticle['active'],
                            "required"      =>false
                        ]
                    ]
                ]
            ]
        ];
        }

        public static function getArticleArchivedForm($thisArticle)
        {
            return [
            "options"=>[
                "method"    =>"POST",
                "action"    =>"/admin/article/delete/".$thisArticle['id'],
                "class"     =>"form-delete",
                "id"        =>"articleDeleteForm",
                "submit"    =>"Archiver"
                ],
            "struct"=>[]
            ];
        }
    }
