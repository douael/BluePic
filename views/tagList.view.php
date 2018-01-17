<header>
    <h1 id="titre">Tags</h1>
</header>
<section id="content">
  <div id="gallery">
    <?php foreach ($this->data["allMedia"] as $media):
      $tag = new Tag(-1);
      $thisTag = $tag->getOneBy(["id" => $media['food_tag_id']]);
?>
          <div class="gallery">

                <img src="<?php echo $media['link']; ?>" alt="<?php echo $thisTag['name']; ?>">

            <div class="desc"><h3><?php echo $thisTag['name']; ?></h3>

            </div>
          </div>

    <?php endforeach; ?>
  </div>
</section>
