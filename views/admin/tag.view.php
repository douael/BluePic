<header>
    <h1 id="titre">Tag</h1>
</header>
<section id="content">
	<?php
      $uri = $_SERVER['REQUEST_URI'];
      $this->uri = trim($uri, "/");
      $this->uriExploded = explode("/", $this->uri);
      $link = $this->uriExploded;
      if (!array_key_exists(2, $link)) {
          $this->includeModal("form", Tag::getTagForm());
      } else {
          if ($link[2]!="show") {
              $this->includeModal("form", Tag::getTagForm());
          } else {
              $this->includeModal("form", Tag::getTagEditForm($thisTag));
              $this->includeModal("form", Tag::getTagArchivedForm($thisTag));
          }
      }
      ?>
</section>
