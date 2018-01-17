<header>
  <h1 id="titre">Archive Articles</h1>
</header>
<section id="contentArchived">
  <?php if (count($this->data["allArticle"])!=0) {
    ?>

  <table>
    <tr>
      <th>Titre</th>
      <th>Texte</th>
      <th>Thumbnail</th>
      <th>Posté par</th>
      <th>Remettre en ligne</th>
    </tr>
    <?php
    foreach ($this->data["allArticle"] as $article):?>
    <tr>
      <?php $user = new User($article['food_user_id']); ?>
      <td><?php echo $article['title']; ?></td>
      <td><?php echo  substr($article['text'], 0, 50); ?></td>
      <td><img src="<?php echo $article['thumbnail']; ?>"></td>
      <td><?php echo $user->getUsername(); ?></td>
      <td><a href="/admin/archive/activate/article/<?php echo $article['id'] ?>"><i class="fa fa-share" aria-hidden="true"></i></a></td>
    </tr>
  <?php endforeach;
} else {
    echo "Il n'y a pas d'article archivée<br>";
    echo "<a href='/admin/archive'>Retour aux archives</a>";
}
 ?>

</table>
</section>
