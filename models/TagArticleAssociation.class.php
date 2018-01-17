<?php

class TagArticleAssociation
{
    protected $idTag;
    protected $idArticle;

    /**
     * MenuElement constructor.
     * @param $idTag
     * @param $idArticle
     */
    public function __construct($idTag, $idArticle)
    {
        $this->idTag     = $idTag;
        $this->idArticle = $idArticle;
    }

    /**
     * @return mixed
     */
    public function getIdTag()
    {
        return $this->idTag;
    }

    /**
     * @param mixed $idTag
     */
    public function setIdTag($idTag)
    {
        $this->idTag = $idTag;
    }

    /**
     * @return mixed
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * @param mixed $idArticle
     */
    public function setIdArticle($idArticle)
    {
        $this->idArticle = $idArticle;
    }
    public function getTagForArticle($idArticle)
    {
        try {
            $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
            $db->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            die("Erreur SQL : ".$e->getMessage());
        }
        $sql = "SELECT * FROM ".DB_PREFIXE."tag_article WHERE article_id=".$idArticle;

        $query = $db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function deleteTagsForArticle($idArticle)
    {
        try {
            $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
            $db->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            die("Erreur SQL : ".$e->getMessage());
        }

        $sql = "DELETE FROM ".DB_PREFIXE."tag_article
                      WHERE article_id = ".$idArticle;

        $query = $db->prepare($sql);
        $query->execute();
    }

    public function Save()
    {
        try {
            $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
            $db->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            die("Erreur SQL : ".$e->getMessage());
        }

        $sql = "INSERT INTO ".DB_PREFIXE."tag_article()
                      VALUES(".$this->idTag.", ".$this->idArticle.")";

        $query = $db->prepare($sql);
        $query->execute();
    }
}
