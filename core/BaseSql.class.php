<?php

    class BaseSql
    {
        private $db;

        private $table;
        private $columns = [];

        public function __construct()
        {
            try {
                $this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
                $this->db->exec("SET CHARACTER SET utf8");
            } catch (Exception $e) {
                die("Erreur SQL : ".$e->getMessage());
            }

            $this->table = strtolower(get_class($this));

            // Devoir : trouver solution pour columns
            $this->columns = array_diff_key(get_class_vars($this->table), get_class_vars(get_parent_class($this)));
        }

        // INSERT ou UPDATE
        public function save()
        {
            if ($this->id == -1) {
                unset($this->columns['id']);
                $sqlCol = null;
                $sqlKey = null;

                foreach ($this->columns as $columns => $value) {
                    $data[$columns] = $this->$columns;
                    $sqlCol .= ",".$columns;
                    $sqlKey .= ", :".$columns;
                }
                $sqlCol = trim($sqlCol, ",");
                $sqlKey = trim($sqlKey, ",");
                $req = $this->db->prepare("INSERT INTO ".DB_PREFIXE.$this->table." (".$sqlCol.") VALUES (".$sqlKey.");");
                $req->execute($data);
            } else {
                $sqlQuery = null;
                foreach ($this->columns as $columns => $value) {
                    $data[$columns] = $this->$columns;
                    $sqlQuery .= $columns . " = :" . $columns . ", ";
                }
                $sqlQuery = trim($sqlQuery, ", ");
                $req = $this->db->prepare("UPDATE ".DB_PREFIXE.$this->table." SET ".$sqlQuery." WHERE id = :id;");
                $req->execute($data);
                echo "update";
            }
        }


        public function populate($search = [])
        {
            $query = $this->getOneBy($search, true);
            $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $this->table);
            $object = $query->fetch();

            return $object;
        }

        public function getOneBy($search = [], $returnQuery = false)
        {
            foreach ($search as $key => $value) {
                $where[] = $key.' = :'.$key;
                $param[":".$key] = $value;
            }
            $query = $this->db->prepare("SELECT * FROM ".DB_PREFIXE.$this->table." WHERE ".implode(" AND ", $where));

            $query->execute($param);

            if ($returnQuery) {
                return $query;
            }
            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function getAll($limit = 0, $orderBy = "", $active = "", $archived=0, $returnQuery = false)
        {
            $sql = "SELECT * FROM ".DB_PREFIXE.$this->table;

            if ($active === 0  || $active === 1) {
                $sql .=" WHERE active=".$active." AND archived=".$archived;
            } else {
                $sql .=" WHERE archived=".$archived;
            }
            if ($orderBy != "") {
                reset($this->columns);
                $columnToOrder = key($this->columns);
                $sql .= " ORDER BY ".$columnToOrder." ".$orderBy;
            }
            if ($limit > 0) {
                $sql .= " LIMIT 0, ".$limit;
            }

            $query = $this->db->prepare($sql);
            $query->execute();

            if ($returnQuery) {
                return $query;
            }

            return $query->fetchAll();
        }

        public function getAllComment($limit = 0, $orderBy = "", $active = "", $archived=0, $id = "", $returnQuery = false)
        {
            $sql = "SELECT * FROM ".DB_PREFIXE.$this->table;

            if ($active === 0  || $active === 1) {
                $sql .=" WHERE active=".$active." AND archived=".$archived;
            } else {
                $sql .=" WHERE archived=".$archived;
            }

            if ($id != "") {
                $sql .=" AND article_id=".$id;
            }
            if ($orderBy != "") {
                reset($this->columns);
                $columnToOrder = key($this->columns);
                $sql .= " ORDER BY ".$columnToOrder." ".$orderBy;
            }
            if ($limit > 0) {
                $sql .= " LIMIT 0, ".$limit;
            }

            $query = $this->db->prepare($sql);
            $query->execute();

            if ($returnQuery) {
                return $query;
            }

            return $query->fetchAll();
        }

        public function getAllArticles($limit = 0, $orderBy = "", $active = "", $archived=0, $id = "", $returnQuery = false)
        {
            $sql = "SELECT * FROM ".DB_PREFIXE.$this->table;

            if ($active === 0  || $active === 1) {
                $sql .=" WHERE active=".$active." AND archived=".$archived;
            } else {
                $sql .=" WHERE archived=".$archived;
            }

            if ($id != "") {
                $sql .=" AND food_category_id=".$id;
            }
            if ($orderBy != "") {
                reset($this->columns);
                $columnToOrder = key($this->columns);
                $sql .= " ORDER BY ".$columnToOrder." ".$orderBy;
            }
            if ($limit > 0) {
                $sql .= " LIMIT 0, ".$limit;
            }

            $query = $this->db->prepare($sql);
            $query->execute();

            if ($returnQuery) {
                return $query;
            }

            return $query->fetchAll();
        }
        public function resetAll()
        {
            $sql = "UPDATE ".DB_PREFIXE.$this->table." SET active = 0";
            $query = $this->db->prepare($sql);
            $query->execute();
        }

        public function getLastInsertedId()
        {
            return $this->db->lastInsertId();
        }

        public function getLastId()
        {
            $sql = "SELECT id FROM ".DB_PREFIXE."article ORDER BY id DESC LIMIT 1";
            $query = $this->db->prepare($sql);
            $query->execute();

            $f = $query->fetch();
            return $f['id'];
        }
    }
