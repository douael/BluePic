<header>
    <h1 id="titre">Recettes de la categorie <?php echo ucfirst($thisCategory['title']); ?></h1>
</header>
<section id="content">
  <div id="gallery">
    <?php foreach ($this->data["allArticles"] as $article):?>

          <div class="gallery">
            <a href="/article/show/<?php echo $article['id']; ?>">
              <img src="<?php echo $article['thumbnail']; ?>" alt="Trolltunga Norway">
            </a>
            <div class="desc"><h3><?php echo $article['title']; ?></h3>
            <p><?php echo substr($article['text'], 0, 140); ?></p></div>
          </div>
    <?php endforeach; ?>
  </div>
</section>
