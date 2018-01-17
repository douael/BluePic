<header>
  <h1 id="titre">Archive Comments</h1>
</header>
<section id="contentArchived">
  <?php if (count($this->data["allComment"])!=0) {
    ?>

  <table>
    <tr>
      <th>Texte</th>
      <th>Article</th>
      <th>Posté par</th>
      <th>Remettre en ligne</th>
    </tr>
    <?php
    foreach ($this->data["allComment"] as $comment):?>
    <tr>
      <?php $user = new User($comment['food_user_id']); ?>
      <?php $article = new Article($comment['article_id']); ?>
      <td><?php echo  substr($comment['text'], 0, 50); ?></td>
      <td><?php echo $article->getTitle(); ?></td>
      <td><?php echo $user->getUsername(); ?></td>
      <td><a href="/admin/archive/activate/comment/<?php echo $comment['id'] ?>"><i class="fa fa-share" aria-hidden="true"></i></a></td>
    </tr>
  <?php endforeach;
} else {
    echo "Il n'y a pas de commentaire archivé<br>";
    echo "<a href='/admin/archive'>Retour aux archives</a>";
}
?>

</table>
</section>
