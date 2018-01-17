<header>
    <h1 id="titre">Menu Element</h1>
</header>
<section id="content">
    <?php
    $uri = $_SERVER['REQUEST_URI'];
    $this->uri = trim($uri, "/");
    $this->uriExploded = explode("/", $this->uri);
    $link = $this->uriExploded;
    if (!array_key_exists(2, $link)) {
        $this->includeModal("form", MenuElement::getMenuElementForm());
    } else {
        if ($link[2]!="show") {
            $this->includeModal("form", MenuElement::getMenuElementForm());
        } else {
            $this->includeModal("form", MenuElement::getMenuElementEditForm($thisMenuElement));
            $this->includeModal("form", MenuElement::getMenuElementArchivedForm($thisMenuElement));
        }
    }
    ?>
</section>
