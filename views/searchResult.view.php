<header>
    <h1 id="titre">Résultats de la recherche</h1>
</header>
<section id="content">
    <?php if (empty($this->data["articlesArray"])) {
    $this->includeAlert("danger", "Pas de recettes trouvées");
} ?>

    <div id="gallery">
        <?php foreach ($this->data["articlesArray"] as $article):?>
            <?php  $user = new User($article->getFoodUserId()); ?>
            <div class="gallery">
                <a href="/article/show/<?php echo $article->getId(); ?>">
                    <img src="<?php echo $article->getThumbnail(); ?>" alt="Trolltunga Norway">
                    <div class="desc">
                        <h3><?php echo $article->getTitle(); ?></h3>
                        <p><?php echo substr($article->getText(), 0, 140); ?></p>
                    </div>
                    <div class="bottom">
                        <span>Par <?php echo $user->getUsername(); ?></span>
                        <span>Le <?php echo $article->getCtime(); ?></span>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>
