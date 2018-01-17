<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ma page food CMS</title>
    <meta name="description" content="description de la page">
    <link rel="stylesheet" href="/assets/css/bo.css">
    <script src="/ckeditor/ckeditor.js"></script>
    <script src="https://use.fontawesome.com/e97a5a7c76.js"></script>
    <script src="/assets/js/jquery.js"></script>

</head>
<body>
<?php $uri = $_SERVER['REQUEST_URI'];
$this->uri = trim($uri, "/");
$this->uriExploded = explode("/", $this->uri);
$link = $this->uriExploded;
?>
<div id="mainBack">
    <ul id="headerBack">
        <li><a href="/admin"><img id="logo" src="/assets/img/logo.png"></a></li>
        <h1 id="titreBE">Food CMS</h1>
        <h1 id="lienBE"><a href="/">Voir le site<i class="fa fa-external-link" aria-hidden="true"></i></a></h1>
    </ul>
    <ul id="navigationBE">

        <li class="menu"><a href="/admin/article"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Articles</a></li>
        <li class="menu"><a href="/admin/comment"><i class="fa fa-comment-o" aria-hidden="true"></i> Commentaires</a></li>
        <li class="menu"><a href="/admin/category"><i class="fa fa-clone" aria-hidden="true"></i> Catégories</a></li>
        <li class="menu"><a href="/admin/page"><i class="fa fa-file-o" aria-hidden="true"></i> Pages</a></li>
        <?php if ($_SESSION['role'] == 1) {
    echo'<li class="menu"><a href="/admin/user"><i class="fa fa-group" aria-hidden="true"></i> Utilisateurs / droits</a></li>';
} ?>
        <li class="menu"><a href="/admin/tag"><i class="fa fa-tags" aria-hidden="true"></i> Tags</a></li>
        <?php if ($_SESSION['role'] == 1) {
    echo '<li class="menu"><a href="/admin/menu"><i class="fa fa-navicon" aria-hidden="true"></i> Menu</a></li>';
} ?>
        <?php if ($_SESSION['role'] == 1) {
    echo '<li class="menu"><a href="/admin/menuElement"><i class="fa fa-navicon" aria-hidden="true"></i> Menu Elements</a></li>';
}?>
        <li class="menu"><a href="/admin/media"><i class="fa fa-image" aria-hidden="true"></i> Médias</a></li>
        <li class="menu"><a href="/admin/archive"><i class="fa fa-archive" aria-hidden="true"></i> Archives</a></li>
        <li class="menu"><a href="/admin/user/logout"><i class="fa fa-power-off" aria-hidden="true"></i> Se déconnecter</a></li>

    </ul>
    <?php $uri = $_SERVER['REQUEST_URI'];
    $this->uri = trim($uri, "/");
    $this->uriExploded = explode("/", $this->uri);
    $link = $this->uriExploded;

    if (array_key_exists(1, $link) && $link[1] != "media" && $link[1] != "archive") {
        ?>

        <ul id="navigationList">
            <?php
            if (strtolower($link[1]) == 'article') {
                foreach ($this->data["allArticles"] as $article):?>
                    <li><a href="/admin/article/show/<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a>
                    </li><?php endforeach;
            }
        if (strtolower($link[1]) == 'comment') {
            foreach ($this->data["allComment"] as $comment):?>
                    <li><a href="/admin/comment/show/<?php echo $comment['id']; ?>"><?php echo $comment['text']; ?></a>
                    </li><?php endforeach;
        }
        if (strtolower($link[1]) == 'category') {
            foreach ($this->data["allCategory"] as $category):?>
                    <li>
                        <a href="/admin/category/show/<?php echo $category['id']; ?>"><?php echo $category['title']; ?></a>
                    </li>
                <?php endforeach;
        }
        if (strtolower($link[1]) == 'page') {
            foreach ($this->data["allPage"] as $page):?>
                    <li><a href="/admin/page/show/<?php echo $page['id']; ?>"><?php echo $page['title']; ?></a></li>
                <?php endforeach;
        }
        if (strtolower($link[1]) == 'tag') {
            foreach ($this->data["allTag"] as $tag):?>
                    <li><a href="/admin/tag/show/<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></a></li>
                <?php endforeach;
        }
        if (strtolower($link[1]) == 'menu') {
            foreach ($this->data["allMenu"] as $menu):?>
                    <li><a href="/admin/menu/show/<?php echo $menu['id']; ?>"><?php echo $menu['name']; ?></a></li>
                <?php endforeach;
        }
        if (strtolower($link[1]) == 'menuelement') {
            foreach ($this->data["allMenuElement"] as $menuElement):?>
                    <li><a href="/admin/menuElement/show/<?php echo $menuElement['id']; ?>"><?php echo $menuElement['name']; ?></a></li>
                <?php endforeach;
        }
        if (strtolower($link[1]) == 'user') {
            foreach ($this->data["allUsers"] as $user):?>
                    <li><a href="/admin/user/show/<?php echo $user['id']; ?>"><?php echo $user['username']; ?></a></li>
                <?php endforeach;
        } ?>
        </ul>
    <?php
    } ?>
    <?php
    //  var_dump($thisArticle);die;
    include $this->view . ".view.php";
    ?>

</div>
<script src="/assets/js/script.js"></script>
<script>

</script>

</body>
</html>
