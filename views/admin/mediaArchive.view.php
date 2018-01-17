<header>
  <h1 id="titre">Archive Medias</h1>
</header>
<section id="contentArchived">
  <?php if (count($this->data["allMedia"])!=0) {
    ?>
  <table>
    <tr>
      <th>Nom du Tag</th>
      <th>Media</th>
      <th>Remettre en ligne</th>
    </tr>
    <?php
    foreach ($this->data["allMedia"] as $media):?>
    <tr>
      <td><?php echo  $media['title']; ?></td>
      <td><img src="<?php echo $media['link']; ?>"></td>
      <td><a href="/admin/archive/activate/media/<?php echo $media['id'] ?>"><i class="fa fa-share" aria-hidden="true"></i></a></td>
    </tr>
  <?php endforeach;
} else {
    echo "Il n'y a pas de media archivé<br>";
    echo "<a href='/admin/archive'>Retour aux archives</a>";
} ?>

</table>
</section>
