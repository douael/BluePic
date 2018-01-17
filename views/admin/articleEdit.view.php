<header>
    <h1 id="titre">Article</h1>
</header>
<section id="content">
    <?php
    $article = new Article($link[3]);
    $user = new User($article->getFoodUserId());
    $media = new Media($article->getThumbnail());

    echo "<div class='modifArticlePres'>
      <p>Rédigé le ".$article->getUtime()." par ".$user->getUsername().".</p>";
    ?>

    <a target="_blank" href="<?php echo $article->getThumbnail(); ?>">
        <img src="<?php echo $article->getThumbnail(); ?>" alt="<?php echo $article->getThumbnail(); ?>" width="300" height="200">
    </a>
    </div>
    <?php
    $this->includeModal("form", Article::getArticleEditForm($thisArticle));
    $this->includeModal("form", Article::getArticleArchivedForm($thisArticle));
    ?>
    <button style="position: relative; margin: 0;" onclick="generateTags()">Générer les ingrédients</button>
    <div class="tags-list">
        <div class='tag' data-id='-1'>Pas de tag</div>
    </div>
</form>
</section>

<script>

    function strip_tags(html) {
        if (arguments.length < 3) {
            html = html.replace(/<\/?(?!\!)[^>]*>/gi, '');
        } else {
            var allowed = arguments[1];
            var specified = eval("[" + arguments[2] + "]");
            if (allowed) {
                var regex = '</?(?!(' + specified.join('|') + '))\b[^>]*>';
                html = html.replace(new RegExp(regex, 'gi'), '');
            } else {
                var regex = '</?(' + specified.join('|') + ')\b[^>]*>';
                html = html.replace(new RegExp(regex, 'gi'), '');
            }
        }

        html = html.replace(/\&nbsp;/g, '');

        return html;
    }

    function generateTags() {
        var text = strip_tags(CKEDITOR.instances.text.getData()).split("\n");

        $.ajax({
            url: "/admin/article/getTags",
            type: 'POST',
            data: { text : text },
            dataType: "JSON",
            success: function (json) {
                $('.tags-list').html('');
                for(var i=0;i<json.length;i++){
                    $(".tags-list").append("<div class='tag' data-id='"+json[i].id+"'>"+json[i].name+"</div>");
                }

                if (json.length == 0) {
                    $(".tags-list").append("<div class='tag' data-id='-1'>Pas de tag</div>");
                }
            }
        });
    }

    CKEDITOR.replace('text');

    $(document).on("click", ".tag", function(){
        $(this).remove();
    });

    $('.submit').click(function () {
        var dataList = $(".tag").map(function() {
            return $(this).data("id");
        }).get();

        $.ajax({
            url: "/admin/article/saveTags/<?php echo $article->getId() ?>",
            type: 'POST',
            data: { idList : dataList },
            success: function () {
                $("#articleEditForm").submit();
            },
            error: function () {
                alert("erreur");
            }
        });
    });
</script>