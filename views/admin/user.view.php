<header>
    <h1 id="titre">Utilisateur</h1>
</header>
<section id="content">

  <?php
  $uri = $_SERVER['REQUEST_URI'];
  $this->uri = trim($uri, "/");
  $this->uriExploded = explode("/", $this->uri);
  $link = $this->uriExploded;
  if (!array_key_exists(2, $link)) {
      $this->includeModal("form", User::getUserCreationForm());
  } else {
      if ($link[2]!="show") {
          $this->includeModal("form", User::getUserCreationForm());
      } else {
          $this->includeModal("form", User::getUserEditForm($thisUser));
          $this->includeModal("form", User::getUserArchivedForm($thisUser));
      }
  }
  ?>
</section>
