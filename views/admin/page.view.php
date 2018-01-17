<header>
    <h1 id="titre">Page</h1>
</header>
<section id="content">
	<?php
        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        $link = $this->uriExploded;
        if (!array_key_exists(2, $link)) {
            $this->includeModal("form", Page::getPageForm());
        } else {
            if ($link[2]!="show") {
                $this->includeModal("form", Page::getPageForm());
            } else {
                $this->includeModal("form", Page::getPageEditForm($thisPage));
                $this->includeModal("form", Page::getPageArchivedForm($thisPage));
            }
        }
    ?>
<script type="text/javascript">    CKEDITOR.replace('text');
  </script>
  
</section>
