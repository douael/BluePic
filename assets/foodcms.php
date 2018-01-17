<?php

try {
    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
    $db->exec("SET CHARACTER SET utf8");
} catch (Exception $e) {
    die("Erreur SQL : ".$e->getMessage());
}

$sql = 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"';
$query = $db->prepare($sql);
$query->execute();

$sql = 'SET time_zone = "+00:00"';
$query = $db->prepare($sql);
$query->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `food_article` (
`id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `text` longtext,
  `thumbnail` varchar(45) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT NULL,
  `ctime` datetime DEFAULT NULL,
  `utime` datetime DEFAULT NULL,
  `food_user_id` int(11) NOT NULL,
  `food_category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
$query = $db->prepare($sql);
$query->execute();


$sql = 'DELIMITER //
CREATE TRIGGER `ctime` BEFORE INSERT ON `food_article`
 FOR EACH ROW SET NEW.ctime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `utime` BEFORE UPDATE ON `food_article`
 FOR EACH ROW SET NEW.utime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `food_article_category` (
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
$query = $db->prepare($sql);
$query->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `food_category` (
`id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT NULL,
  `ctime` datetime DEFAULT NULL,
  `utime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `ctime_category` BEFORE INSERT ON `food_category`
 FOR EACH ROW SET NEW.ctime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `utime_category` BEFORE UPDATE ON `food_category`
 FOR EACH ROW SET NEW.utime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `food_comment` (
`id` int(11) NOT NULL,
  `text` text,
  `active` tinyint(1) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT NULL,
  `ctime` datetime DEFAULT NULL,
  `utime` datetime DEFAULT NULL,
  `food_user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `ctime_comment` BEFORE INSERT ON `food_comment`
 FOR EACH ROW SET NEW.ctime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `utime_comment` BEFORE UPDATE ON `food_comment`
 FOR EACH ROW SET NEW.utime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `food_media` (
`id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `archived` tinyint(1) DEFAULT NULL,
  `ctime` datetime DEFAULT NULL,
  `utime` datetime DEFAULT NULL,
  `food_tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `ctime_media` BEFORE INSERT ON `food_media`
 FOR EACH ROW SET NEW.ctime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `utime_media` BEFORE UPDATE ON `food_media`
 FOR EACH ROW SET NEW.utime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `food_menu` (
`id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT NULL,
  `ctime` datetime DEFAULT NULL,
  `utime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `ctime_menu` BEFORE INSERT ON `food_menu`
 FOR EACH ROW SET NEW.ctime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `utime_menu` BEFORE UPDATE ON `food_menu`
 FOR EACH ROW SET NEW.utime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `food_menuelement` (
`id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `redirection` varchar(100) DEFAULT NULL,
  `archived` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
$query = $db->prepare($sql);
$query->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `food_menu_menu_element` (
  `menu_id` int(11) NOT NULL,
  `menu_element_id` int(11) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1';
$query = $db->prepare($sql);
$query->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `food_page` (
`id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `text` longtext,
  `active` tinyint(1) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT NULL,
  `ctime` datetime DEFAULT NULL,
  `utime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `ctime_page` BEFORE INSERT ON `food_page`
 FOR EACH ROW SET NEW.ctime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `utime_page` BEFORE UPDATE ON `food_page`
 FOR EACH ROW SET NEW.utime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `food_tag` (
`id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0,
  `ctime` datetime DEFAULT NULL,
  `utime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `ctime_tag` BEFORE INSERT ON `food_tag`
 FOR EACH ROW SET NEW.ctime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `utime_tag` BEFORE UPDATE ON `food_tag`
 FOR EACH ROW SET NEW.utime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `food_tag_article` (
  `tag_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
$query = $db->prepare($sql);
$query->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `food_user` (
`id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `archived` int(11) NOT NULL DEFAULT 0,
  `ctime` datetime DEFAULT NULL,
  `utime` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 3,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `ctime_user` BEFORE INSERT ON `food_user`
 FOR EACH ROW SET NEW.ctime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'DELIMITER //
CREATE TRIGGER `utime_user` BEFORE UPDATE ON `food_user`
 FOR EACH ROW SET NEW.utime = NOW()
//
DELIMITER';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_article`
 ADD PRIMARY KEY (`id`), ADD KEY `food_user_id` (`food_user_id`), ADD KEY `food_category_id` (`food_category_id`)';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_article_category`
 ADD PRIMARY KEY (`article_id`,`category_id`)';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_category`
 ADD PRIMARY KEY (`id`)';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_comment`
 ADD PRIMARY KEY (`id`), ADD KEY `article_id` (`article_id`), ADD KEY `food_user_id` (`food_user_id`)';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_media`
 ADD PRIMARY KEY (`id`), ADD KEY `food_tag_id` (`food_tag_id`)';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_menu`
 ADD PRIMARY KEY (`id`)';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_menuelement`
 ADD PRIMARY KEY (`id`)';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_menu_menu_element`
 ADD PRIMARY KEY (`menu_id`,`menu_element_id`)';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_page`
 ADD PRIMARY KEY (`id`)';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_tag`
 ADD PRIMARY KEY (`id`)';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_tag_article`
 ADD PRIMARY KEY (`tag_id`,`article_id`)';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_user`
 ADD PRIMARY KEY (`id`)';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_article`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_media`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_menuelement`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_page`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_tag`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT';
$query = $db->prepare($sql);
$query->execute();

$sql = 'ALTER TABLE `food_media`
ADD CONSTRAINT `food_media_tag_id_fk` FOREIGN KEY (`food_tag_id`) REFERENCES `food_tag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION';
$query = $db->prepare($sql);
$query->execute();

$sql = "INSERT INTO `food_tag` (`id`, `name`, `archived`, `ctime`) VALUES
(, 'ail', 0, '2017-07-23 11:49:28'),
(, 'beurre', 0, '2017-07-23 11:49:28'),
(, 'margarine', 0, '2017-07-23 11:49:28'),
(, 'chocolat', 0, '2017-07-23 11:49:28'),
(, 'crème fraîche', 0, '2017-07-23 11:49:28'),
(, 'eau', 0, '2017-07-23 11:49:28'),
(, 'farine de blé', 0, '2017-07-23 11:49:28'),
(, 'gruyère', 0, '2017-07-23 11:49:28'),
(, 'emmental', 0, '2017-07-23 11:49:28'),
(, 'huile d''olive', 0, '2017-07-23 11:49:28'),
(, 'huile de tournesol', 0, '2017-07-23 11:49:28'),
(, 'lait', 0, '2017-07-23 11:49:28'),
(, 'miel', 0, '2017-07-23 11:49:28'),
(, 'oeuf', 0, '2017-07-23 11:49:28'),
(, 'oignon', 0, '2017-07-23 11:49:28'),
(, 'pâte brisée', 0, '2017-07-23 11:49:28'),
(, 'pâte feuilletée', 0, '2017-07-23 11:49:28'),
(, 'pâtes', 0, '2017-07-23 11:49:28'),
(, 'poivre', 0, '2017-07-23 11:49:28'),
(, 'pomme de terre', 0, '2017-07-23 11:49:28'),
(, 'riz blanc', 0, '2017-07-23 11:49:28'),
(, 'sel', 0, '2017-07-23 11:49:28'),
(, 'sucre', 0, '2017-07-23 11:49:28'),
(, 'tomate', 0, '2017-07-23 11:49:28'),
(, 'vinaigre balsamique', 0, '2017-07-23 11:49:28'),
(, 'vinaigre de vin', 0, '2017-07-23 11:49:28'),
(, 'yaourt nature', 0, '2017-07-23 11:49:28'),
(, 'artichaut', 0, '2017-07-23 11:49:28'),
(, 'asperge', 0, '2017-07-23 11:49:28'),
(, 'aubergine', 0, '2017-07-23 11:49:28'),
(, 'avocat', 0, '2017-07-23 11:49:28'),
(, 'betterave', 0, '2017-07-23 11:49:28'),
(, 'bettes', 0, '2017-07-23 11:49:28'),
(, 'blettes', 0, '2017-07-23 11:49:28'),
(, 'broccoli', 0, '2017-07-23 11:49:28'),
(, 'carotte', 0, '2017-07-23 11:49:28'),
(, 'céleri', 0, '2017-07-23 11:49:28'),
(, 'céleri rave', 0, '2017-07-23 11:49:28'),
(, 'chou blanc', 0, '2017-07-23 11:49:28'),
(, 'chou vert', 0, '2017-07-23 11:49:28'),
(, 'chou chinois', 0, '2017-07-23 11:49:28'),
(, 'chou fractal', 0, '2017-07-23 11:49:28'),
(, 'chou romanesco', 0, '2017-07-23 11:49:28'),
(, 'chou rouge', 0, '2017-07-23 11:49:28'),
(, 'chou-fleur', 0, '2017-07-23 11:49:28'),
(, 'choux de bruxelles', 0, '2017-07-23 11:49:28'),
(, 'citrouille', 0, '2017-07-23 11:49:28'),
(, 'coeur de palmier', 0, '2017-07-23 11:49:28'),
(, 'concombre', 0, '2017-07-23 11:49:28'),
(, 'courge', 0, '2017-07-23 11:49:28'),
(, 'courgette', 0, '2017-07-23 11:49:28'),
(, 'cresson', 0, '2017-07-23 11:49:28'),
(, 'endive', 0, '2017-07-23 11:49:28'),
(, 'épinards', 0, '2017-07-23 11:49:28'),
(, 'fenouil', 0, '2017-07-23 11:49:28'),
(, 'fèves', 0, '2017-07-23 11:49:28'),
(, 'flageolets', 0, '2017-07-23 11:49:28'),
(, 'germes de soja', 0, '2017-07-23 11:49:28'),
(, 'haricots beurre', 0, '2017-07-23 11:49:28'),
(, 'haricots blancs', 0, '2017-07-23 11:49:28'),
(, 'haricots rouges', 0, '2017-07-23 11:49:28'),
(, 'haricots verts', 0, '2017-07-23 11:49:28'),
(, 'lentilles', 0, '2017-07-23 11:49:28'),
(, 'lentilles corail', 0, '2017-07-23 11:49:28'),
(, 'mâche', 0, '2017-07-23 11:49:28'),
(, 'maïs', 0, '2017-07-23 11:49:28'),
(, 'navet', 0, '2017-07-23 11:49:28'),
(, 'olives noires', 0, '2017-07-23 11:49:28'),
(, 'olives vertes', 0, '2017-07-23 11:49:28'),
(, 'orties', 0, '2017-07-23 11:49:28'),
(, 'oseille', 0, '2017-07-23 11:49:28'),
(, 'panais', 0, '2017-07-23 11:49:28'),
(, 'patate douce', 0, '2017-07-23 11:49:28'),
(, 'petits pois', 0, '2017-07-23 11:49:28'),
(, 'piment frais', 0, '2017-07-23 11:49:28'),
(, 'pissenlits', 0, '2017-07-23 11:49:28'),
(, 'poireau(x)', 0, '2017-07-23 11:49:28'),
(, 'pois cassés', 0, '2017-07-23 11:49:28'),
(, 'pois chiches', 0, '2017-07-23 11:49:28'),
(, 'pois gourmands', 0, '2017-07-23 11:49:28'),
(, 'poivron', 0, '2017-07-23 11:49:28'),
(, 'potimarron', 0, '2017-07-23 11:49:28'),
(, 'potiron', 0, '2017-07-23 11:49:28'),
(, 'pourpier', 0, '2017-07-23 11:49:28'),
(, 'radis', 0, '2017-07-23 11:49:28'),
(, 'radis noir', 0, '2017-07-23 11:49:28'),
(, 'roquette', 0, '2017-07-23 11:49:28'),
(, 'rutabaga', 0, '2017-07-23 11:49:28'),
(, 'salade rouge', 0, '2017-07-23 11:49:28'),
(, 'salade verte', 0, '2017-07-23 11:49:28'),
(, 'tomate verte', 0, '2017-07-23 11:49:28'),
(, 'topinambour', 0, '2017-07-23 11:49:28'),
(, 'agneau', 0, '2017-07-23 11:49:28'),
(, 'andouille', 0, '2017-07-23 11:49:28'),
(, 'andouillette', 0, '2017-07-23 11:49:28'),
(, 'bacon', 0, '2017-07-23 11:49:28'),
(, 'boeuf', 0, '2017-07-23 11:49:28'),
(, 'boudin blanc', 0, '2017-07-23 11:49:28'),
(, 'boudin noir', 0, '2017-07-23 11:49:28'),
(, 'caille', 0, '2017-07-23 11:49:28'),
(, 'caillette', 0, '2017-07-23 11:49:28'),
(, 'canard', 0, '2017-07-23 11:49:28'),
(, 'chorizo', 0, '2017-07-23 11:49:28'),
(, 'crêpine', 0, '2017-07-23 11:49:28'),
(, 'dindee', 0, '2017-07-23 11:49:28'),
(, 'scargots', 0, '2017-07-23 11:49:28'),
(, 'foie de génisse', 0, '2017-07-23 11:49:28'),
(, 'foie de veau', 0, '2017-07-23 11:49:28'),
(, 'foie gras', 0, '2017-07-23 11:49:28'),
(, 'foies de volaille', 0, '2017-07-23 11:49:28'),
(, 'gésiers', 0, '2017-07-23 11:49:28'),
(, 'jambon blanc', 0, '2017-07-23 11:49:28'),
(, 'jambon cru', 0, '2017-07-23 11:49:28'),
(, 'jambon fumé', 0, '2017-07-23 11:49:28'),
(, 'lapin', 0, '2017-07-23 11:49:28'),
(, 'lard', 0, '2017-07-23 11:49:28'),
(, 'lardons', 0, '2017-07-23 11:49:28'),
(, 'merguez', 0, '2017-07-23 11:49:28'),
(, 'mouton', 0, '2017-07-23 11:49:28'),
(, 'oeufs de caille', 0, '2017-07-23 11:49:28'),
(, 'os à moëlle', 0, '2017-07-23 11:49:28'),
(, 'petit salé', 0, '2017-07-23 11:49:28'),
(, 'pied de veau', 0, '2017-07-23 11:49:28'),
(, 'pigeon', 0, '2017-07-23 11:49:28'),
(, 'porc', 0, '2017-07-23 11:49:28'),
(, 'poulet', 0, '2017-07-23 11:49:28'),
(, 'quenelles', 0, '2017-07-23 11:49:28'),
(, 'rognons', 0, '2017-07-23 11:49:28'),
(, 'saucisse', 0, '2017-07-23 11:49:28'),
(, 'saucisson', 0, '2017-07-23 11:49:28'),
(, 'tripes', 0, '2017-07-23 11:49:28'),
(, 'veau', 0, '2017-07-23 11:49:28'),
(, 'aiglefin', 0, '2017-07-23 11:49:28'),
(, 'amandes de mer', 0, '2017-07-23 11:49:28'),
(, 'anchois au sel', 0, '2017-07-23 11:49:28'),
(, 'anchois frais', 0, '2017-07-23 11:49:28'),
(, 'anguille', 0, '2017-07-23 11:49:28'),
(, 'araignée de mer', 0, '2017-07-23 11:49:28'),
(, 'bar', 0, '2017-07-23 11:49:28'),
(, 'barbu', 0, '2017-07-23 11:49:28'),
(, 'bonite', 0, '2017-07-23 11:49:28'),
(, 'brochet', 0, '2017-07-23 11:49:28'),
(, 'cabillaud', 0, '2017-07-23 11:49:28'),
(, 'calamars', 0, '2017-07-23 11:49:28'),
(, 'carpe', 0, '2017-07-23 11:49:28'),
(, 'colin', 0, '2017-07-23 11:49:28'),
(, 'congre', 0, '2017-07-23 11:49:28'),
(, 'coques', 0, '2017-07-23 11:49:28'),
(, 'crevettes', 0, '2017-07-23 11:49:28'),
(, 'daurade', 0, '2017-07-23 11:49:28'),
(, 'écrevisses', 0, '2017-07-23 11:49:28'),
(, 'encornets', 0, '2017-07-23 11:49:28'),
(, 'éperlans', 0, '2017-07-23 11:49:28'),
(, 'espadon', 0, '2017-07-23 11:49:28'),
(, 'étrilles', 0, '2017-07-23 11:49:28'),
(, 'flétan', 0, '2017-07-23 11:49:28'),
(, 'fumet de poisson', 0, '2017-07-23 11:49:28'),
(, 'gambas', 0, '2017-07-23 11:49:28'),
(, 'haddock', 0, '2017-07-23 11:49:28'),
(, 'hareng', 0, '2017-07-23 11:49:28'),
(, 'homard', 0, '2017-07-23 11:49:28'),
(, 'huîtres', 0, '2017-07-23 11:49:28'),
(, 'langouste', 0, '2017-07-23 11:49:28'),
(, 'langoustines', 0, '2017-07-23 11:49:28'),
(, 'lieu', 0, '2017-07-23 11:49:28'),
(, 'limande', 0, '2017-07-23 11:49:28'),
(, 'lotte', 0, '2017-07-23 11:49:28'),
(, 'loup de mer', 0, '2017-07-23 11:49:28'),
(, 'maquereau', 0, '2017-07-23 11:49:28'),
(, 'merlan', 0, '2017-07-23 11:49:28'),
(, 'merlu', 0, '2017-07-23 11:49:28'),
(, 'mérou', 0, '2017-07-23 11:49:28'),
(, 'morue', 0, '2017-07-23 11:49:28'),
(, 'moules', 0, '2017-07-23 11:49:28'),
(, 'noix de pétoncle', 0, '2017-07-23 11:49:28'),
(, 'oeufs de lump', 0, '2017-07-23 11:49:28'),
(, 'palourdes', 0, '2017-07-23 11:49:28'),
(, 'panga', 0, '2017-07-23 11:49:28'),
(, 'perche', 0, '2017-07-23 11:49:28'),
(, 'poulpe', 0, '2017-07-23 11:49:28'),
(, 'poutargue', 0, '2017-07-23 11:49:28'),
(, 'rouget', 0, '2017-07-23 11:49:28'),
(, 'rouille', 0, '2017-07-23 11:49:28'),
(, 'roussette', 0, '2017-07-23 11:49:28'),
(, 'saint jacques', 0, '2017-07-23 11:49:28'),
(, 'sandre', 0, '2017-07-23 11:49:28'),
(, 'sardines', 0, '2017-07-23 11:49:28'),
(, 'saumon', 0, '2017-07-23 11:49:28'),
(, 'saumon fumé', 0, '2017-07-23 11:49:28'),
(, 'seiche', 0, '2017-07-23 11:49:28'),
(, 'sole', 0, '2017-07-23 11:49:28'),
(, 'surimi', 0, '2017-07-23 11:49:28'),
(, 'thon en boîte', 0, '2017-07-23 11:49:28'),
(, 'thon frais', 0, '2017-07-23 11:49:28'),
(, 'tourteau', 0, '2017-07-23 11:49:29'),
(, 'truite', 0, '2017-07-23 11:49:29'),
(, 'péche', 0, '2017-07-23 14:43:45'),
(, 'melon', 0, '2017-07-23 14:43:45'),
(, 'abricot', 0, '2017-07-23 14:43:45'),
(, 'banane', 0, '2017-07-23 14:43:45'),
(, 'fraise', 0, '2017-07-23 14:43:45'),
(, 'pastèque', 0, '2017-07-23 14:43:45'),
(, 'orange', 0, '2017-07-23 14:43:45'),
(, 'cerise', 0, '2017-07-23 14:43:45'),
(, 'nectarine', 0, '2017-07-23 14:43:45'),
(, 'citron', 0, '2017-07-23 14:43:45'),
(, 'pomme', 0, '2017-07-23 14:43:45'),
(, 'raisin', 0, '2017-07-23 14:43:45'),
(, 'kiwi', 0, '2017-07-23 14:43:45'),
(, 'pamplemousse', 0, '2017-07-23 14:43:45'),
(, 'melon jaune', 0, '2017-07-23 14:43:45'),
(, 'framboise', 0, '2017-07-23 14:43:45'),
(, 'fruit de la passion', 0, '2017-07-23 14:43:45'),
(, 'ananas', 0, '2017-07-23 14:43:45'),
(, 'mangue', 0, '2017-07-23 14:43:45'),
(, 'poire', 0, '2017-07-23 14:43:45'),
(, 'noix ', 0, '2017-07-23 14:43:45'),
(, 'mure', 0, '2017-07-23 14:43:45'),
(, 'prune', 0, '2017-07-23 14:43:45'),
(, 'grenade', 0, '2017-07-23 14:43:45'),
(, 'myrtilles', 0, '2017-07-23 14:43:45'),
(, 'noix de coco', 0, '2017-07-23 14:43:45'),
(, 'amande', 0, '2017-07-23 14:43:45'),
(, 'noisette', 0, '2017-07-23 14:43:45'),
(, 'pistache', 0, '2017-07-23 14:43:45'),
(, 'anis', 0, '2017-07-23 14:49:12'),
(, 'poivre', 0, '2017-07-23 14:49:12'),
(, 'sel', 0, '2017-07-23 14:49:12'),
(, 'cannelle', 0, '2017-07-23 14:49:12'),
(, 'coriandre', 0, '2017-07-23 14:49:12'),
(, 'curcuma', 0, '2017-07-23 14:49:12'),
(, 'vanille', 0, '2017-07-23 14:49:12'),
(, 'gingembre', 0, '2017-07-23 14:49:12'),
(, 'macis', 0, '2017-07-23 14:49:12'),
(, 'paprika', 0, '2017-07-23 14:49:12'),
(, 'piment', 0, '2017-07-23 14:49:12'),
(, 'safran', 0, '2017-07-23 14:49:12'),
(, 'sumac', 0, '2017-07-23 14:49:12')";
$query = $db->prepare($sql);
$query->execute();

$sql = "INSERT INTO `food_article` (`id`, `title`, `text`, `thumbnail`, `active`, `archived`, `ctime`, `utime`, `food_user_id`, `food_category_id`) VALUES ('', 'Article de démonstration', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<p>', '/assets/img/demo.jpg', 1, 0, CURRENT_DATE(), NULL, 1, NULL)";
$query = $db->prepare($sql);
$query->execute();

$sql = "INSERT INTO `food_comment` (`id`, `text`, `active`, `archived`, `ctime`, `utime`, `food_user_id`, `article_id`) VALUES (, 'Commentaire de demonstration', '1', '0', CURRENT_DATE(), NULL, '1', '1')";
$query = $db->prepare($sql);
$query->execute();

$sql = "INSERT INTO `food_tag_article` (`tag_id`, `article_id`) VALUES ('1', '1')";
$query = $db->prepare($sql);
$query->execute();

$sql = "INSERT INTO `food_menu` (`id`, `name`, `active`, `archived`, `ctime`, `utime`) VALUES (, 'Menu de base', 1, 0, CURRENT_DATE(), NULL)";
$query = $db->prepare($sql);
$query->execute();

$sql = "INSERT INTO `food_menuelement` (`id`, `name`, `redirection`, `archived`) VALUES
(, 'S''identifier', 'Index/login', 0),
(, 'S''inscrire', 'Index/register', 0),
(, 'Recherche', 'Search/index', 0),
(, 'Catégories', 'Category', 0),
(, 'Recettes', 'Article', 0),
(, 'Se deconnecter', 'Index/logout', 0)";
$query = $db->prepare($sql);
$query->execute();

$sql = "INSERT INTO `food_menu_menu_element` (`menu_id`, `menu_element_id`, `order`) VALUES
(1, 1, 5),
(1, 2, 4),
(1, 3, 1),
(1, 4, 2),
(1, 5, 3),
(1, 6, 6)";
$query = $db->prepare($sql);
$query->execute();
