<header>
    <h1 id="titre">Recettes</h1>
</header>
<section id="content">
  <div id="gallery">
    <?php foreach ($this->data["allArticles"] as $article):?>
<?php  $user = new User($article['food_user_id']); ?>
          <div class="gallery">
            <a href="/article/show/<?php echo $article['id']; ?>">
              <img src="<?php echo $article['thumbnail']; ?>" alt="Trolltunga Norway">
            </a>
            <div class="desc"><h3><?php echo $article['title']; ?></h3>
            <p><?php echo substr($article['text'], 0, 140); ?></p></div>
            <div class="bottom">
                <span>Par <?php echo $user->getUsername(); ?></span>
                <span>Le <?php echo Tools::dateConverter($article['ctime']); ?></span>
            </div>
          </div>
    <?php endforeach; ?>
  </div>
</section>
