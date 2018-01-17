<header>
    <h1 id="titre">Article</h1>
</header>
<section id="content">

  <?php
  $uri = $_SERVER['REQUEST_URI'];
  $this->uri = trim($uri, "/");
  $this->uriExploded = explode("/", $this->uri);
  $link = $this->uriExploded;
  if (!array_key_exists(2, $link)) {
      $this->includeModal("form", Article::getArticleCreationForm());
  } else {
      if ($link[2]!="show") {
          $this->includeModal("form", Article::getArticleCreationForm());
      } else {
          $article = new Article($link[3]);
          $user = new User($article->getFoodUserId());
          $media = new Media($article->getThumbnail());
      
          echo "<div class='modifArticlePres'>
      <p>Rédigé le ".$article->getUtime()." par ".$user->getUsername().".</p>"; ?>
      
      <a target="_blank" href="<?php echo $article->getThumbnail(); ?>">
        <img src="<?php echo $article->getThumbnail(); ?>" alt="<?php echo $article->getThumbnail(); ?>" width="300" height="200">
      </a>
      </div>
      <?php
      $this->includeModal("form", Article::getArticleEditForm($thisArticle));
          $this->includeModal("form", Article::getArticleArchivedForm($thisArticle));
      }
  }
  ?>
  <script type="text/javascript">    CKEDITOR.replace('text');
  </script>
  
</section>
