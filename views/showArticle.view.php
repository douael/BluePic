
<section id ="showArticle">
  <img src="<?php echo $thisArticle['thumbnail']; ?>" alt="Image de l'article">
  <h1 id="titre-article"><?php echo $thisArticle['title']; ?></h1>
</section>
<section id="content">
  <div class="text-article"><?php echo $thisArticle['text']; ?></div>
  <div class="info-article">
    <p><b>Posté par : </b> <?php echo $thisUser['username']; ?></p>
    <p><b>Le : </b> <?php echo $thisArticle['ctime']; ?></p>
  </div>

  <div class="info-article">
    <p><b>Tags:</b></p>
    <?php 
    $ingredients ="";
    foreach ($tags as $i => $value) {
        $ingredients .= "$tags[$i], ";
    }
    
    if ($ingredients == "") {
        echo "Pas de tags";
    } else {
          $ingredients = trim($ingredients);
          echo trim($ingredients, ',');
      }
    ?>
  </div>
<?php
if (isset($_SESSION['id'])) {
        ?>
  <div class="commentArea">
    <form id="comment" enctype="multipart/form-data" method="post" action="/article/createComment">
      <label>Commentaire : </label>
      <textarea name="comment" required="required"></textarea>
      <input type="hidden" name="id" value="<?php echo $thisArticle['id']; ?>">
      <input type="submit" value="Ajouter un commentaire" id="addComment">
    </form>
  </div>
  <?php
    }
$test = count($this->data["allComment"]);
if ($test != 0) {
    ?>
  <div class="commentArea">
    <?php foreach ($this->data["allComment"] as $comment):
      $user = new User($comment['food_user_id']); ?>
      <div class="articleDiv">
        <div>
          <p><?php echo $comment['text']; ?></p><br>
          <p style="font-style: italic;"><?php echo "Posté par ".$user->getUsername()." le ".$comment['utime']; ?></p>
    </div>
    </div>
    <?php endforeach;
} else {
    ?>
  <div class="commentArea">
    <p> Il n'y a aucun commentaire pour l'instant </p>
  </div><?php
}?>
  </div>
</section>
