<header>
    <h1 id="titre">Rechercher</h1>
</header>
<section id="content">
    <?php if (!empty($this->data) && array_key_exists("error", $this->data)) {
    $this->includeAlert("danger", $this->data['error']);
} ?>

    <form id="search" class="form-group" method="post" action="/search/search">
        <div class="form-row">
            <label for="search">Recherche :</label>
            <input id="search" type="text" name="searchInput" placeholder="Entrer votre recherche...">
        </div>
        <br>
        <div class="form-row">
            <label for="category-select">Catégories :</label>
            <select name="categorySelect[]" id="category-select" class="search-selector" multiple="multiple">
                <?php foreach ($this->data["categoriesArray"] as $category):?>
                    <option value="<?php echo $category['id'] ?>"><?php echo $category['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        <div class="form-row">
            <label for="tag-select">Ingrédients :</label>
            <select name="tagSelect[]" id="tag-select" class="search-selector" multiple="multiple">
                <?php foreach ($this->data["tagsArray"] as $tag):?>
                    <option value="<?php echo $tag['id'] ?>"><?php echo $tag['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-row">
            <input class="submit" type="submit" name="" value="Rechercher">
        </div>
    </form>
</section>

<script>
    $('option').mousedown(function(e) {
        e.preventDefault();
        $(this).prop('selected', $(this).prop('selected') ? false : true);
        return false;
    });
</script>