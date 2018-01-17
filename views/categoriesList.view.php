<header>
    <h1 id="titre">Catégories</h1>
</header>
    <?php foreach ($this->data["allCategories"] as $category):?>
      <div class="categoryDiv">
            <a href="/category/show/<?php echo $category['id']; ?>">
              <div class="desc"><h3><?php echo $category['title']; ?></h3>
            </a>
          </div>
          </div>
    <?php endforeach; ?>
