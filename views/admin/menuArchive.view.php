<header>
  <h1 id="titre">Archive Menus</h1>
</header>
<section id="contentArchived">
  <?php if (count($this->data["allMenu"])!=0) {
    ?>
  <table>
    <tr>
      <th>Nom</th>
      <th>Remettre en ligne</th>
    </tr>
    <?php
    foreach ($this->data["allMenu"] as $menu):?>
    <tr>
      <td><?php echo  $menu['name']; ?></td>
      <td><a href="/admin/archive/activate/menu/<?php echo $menu['id'] ?>"><i class="fa fa-share" aria-hidden="true"></i></a></td>
    </tr>
  <?php endforeach;
} else {
    echo "Il n'y a pas de menu archivé<br>";
    echo "<a href='/admin/archive'>Retour aux archives</a>";
} ?>

</table>
</section>
