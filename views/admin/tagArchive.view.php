<header>
  <h1 id="titre">Archive Tags</h1>
</header>
<section id="contentArchived">
  <?php if (count($this->data["allTag"])!=0) {
    ?>
  <table>
    <tr>
      <th>Nom</th>
      <th>Remettre en ligne</th>
    </tr>
    <?php
    foreach ($this->data["allTag"] as $tag):?>
    <tr>
      <td><?php echo  $tag['name']; ?></td>
      <td><a href="/admin/archive/activate/tag/<?php echo $tag['id'] ?>"><i class="fa fa-share" aria-hidden="true"></i></a></td>
    </tr>
  <?php endforeach;
} else {
    echo "Il n'y a pas de tag archivé<br>";
    echo "<a href='/admin/archive'>Retour aux archives</a>";
}
 ?>

</table>
</section>
