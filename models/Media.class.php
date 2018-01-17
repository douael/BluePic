<?php

class Media extends BaseSql
{
    protected $id;
    protected $title;
    protected $link;
    protected $archived;
    protected $active;
    protected $ctime;
    protected $utime;
    protected $food_tag_id;

    /**
     * @param mixed $id
     */
    public function __construct($id, $title = null, $link = null, $food_tag_id = null, $archived = 0, $active = 1, $ctime = null, $utime = null)
    {
        parent::__construct();

        if ($id > 0) {
            $media = parent::getOneBy(["id" => $id]);

            $this->id           = $media['id'];
            $this->title        = $media['title'];
            $this->link        = $media['link'];
            $this->archived     = $media['archived'];
            $this->active     = $media['active'];
            $this->ctime        = $media['ctime'];
            $this->utime        = $media['utime'];
            $this->food_tag_id   = $media['food_tag_id'];
        } else {
            $this->id           = $id;
            $this->setTitle($title);
            $this->setLink($link);
            $this->archived    = $archived;
            $this->active    = $active;
            $this->ctime        = $ctime;
            $this->utime        = $utime;
            $this->food_tag_id   = $food_tag_id;
        }
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $archived
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
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
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * @return mixed
     */

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = Tools::antiXSS($link);
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = Tools::antiXSS($title);
    }
    public function getCtime()
    {
        $date = new DateTime($this->ctime);
        return $date->format("j M Y G:i");
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
    public function setTagId($food_tag_id)
    {
        $this->food_tag_id = $food_tag_id;
    }

    public function getTagId()
    {
        return $this->food_tag_id;
    }
}
