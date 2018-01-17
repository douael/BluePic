<header>
  <h1 id="titre">Archive Categories</h1>
</header>
<section id="contentArchived">
  <?php if (count($this->data["allCategories"])!=0) {
    ?>

  <table>
    <tr>
      <th>Titre</th>
      <th>Remettre en ligne</th>
    </tr>
    <?php
    foreach ($this->data["allCategories"] as $category):?>
    <tr>

      <td><?php echo  $category['title']; ?></td>
      <td><a href="/admin/archive/activate/category/<?php echo $category['id'] ?>"><i class="fa fa-share" aria-hidden="true"></i></a></td>
    </tr>
  <?php endforeach;
} else {
    echo "Il n'y a pas de catégorie archivée<br>";
    echo "<a href='/admin/archive'>Retour aux archives</a>";
}
 ?>

</table>
</section>
