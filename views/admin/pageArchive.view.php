<header>
  <h1 id="titre">Archive Pages</h1>
</header>
<section id="contentArchived">
  <?php if (count($this->data["allPages"])!=0) {
    ?>
  <table>
    <tr>
      <th>Titre</th>
      <th>Remettre en ligne</th>
    </tr>
    <?php
    foreach ($this->data["allPages"] as $page):?>
    <tr>

      <td><?php echo  $page['title']; ?></td>
      <td><a href="/admin/archive/activate/page/<?php echo $page['id'] ?>"><i class="fa fa-share" aria-hidden="true"></i></a></td>
    </tr>
  <?php endforeach;
} else {
    echo "Il n'y a pas de page archivé<br>";
    echo "<a href='/admin/archive'>Retour aux archives</a>";
}
?>

</table>
</section>
