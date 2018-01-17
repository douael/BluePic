
<section id ="showArticle">
  <h1 id="titre">Profil</h1>
</section>
<section id="content">

  <div class="commentArea">

      <div class="articleDiv">
        <form class="form-group" id="registerForm" enctype="multipart/form-data" method="post" action="/user/edit/<?php echo $thisUser['id']; ?>">
          
          <div class="form-row"><label>Pseudo : </label><input type="text" name="username" value="<?php echo $thisUser['username']; ?>"></div>
          <div class="form-row"><label>Nom  : </label><input type="text" name="lastname" value="<?php echo $thisUser['lastname']; ?>"></div>
          <div class="form-row"><label>Prénom : </label><input type="text" name="firstname" value="<?php echo $thisUser['firstname']; ?>"></div>
          <div class="form-row"><label>Email : </label><input type="text" name="email" value="<?php echo $thisUser['email']; ?>"></div>
          <div class="form-row"><label>Mot de passe : </label><input type="password" name="pwd" placeholder="mot de passe" value=""></div>
          <div class="form-row"><input class="submit" type="submit" value="Modifier" id="addImage"></div>
    
        </form>
    <div>


</section>
