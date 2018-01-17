<header>
  <h1 id="titre">Media</h1>
</header>
<section id="contentMedia">
  <form id="gallery" enctype="multipart/form-data" method="post" action="/admin/media/create">
    <select id='tag' name='tag'>
<?php
      foreach ($this->data["allTag"] as $tag):
        ?><option value="<?php echo $tag['id']; ?>" ><?php echo $tag['name']; ?></option>
      <?php endforeach; ?>

    </select>
    <input type="file" name="media" required="required">
    <input type="submit" value="Ajouter" id="addImage">
  </form>
  <div id="gallery">
    <?php foreach ($this->data["allMedia"] as $media):?>

    <div class="gallery">
      <a target="_blank" href="<?php echo $media['link']; ?>">
        <img src="<?php echo $media['link']; ?>" alt="<?php echo $media['title']; ?>" width="300" height="200">
      </a>
      <div class="desc"><?php echo $media['title']; ?><a href="/admin/media/delete/<?php echo $media['id']; ?>"><i class="fa fa-trash"></i></a></div>
    </div>
      <?php endforeach; ?>
  </div>
</section>
