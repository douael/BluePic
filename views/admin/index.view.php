<div id="container-back">
		<!-- accueil -->
	<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
	<script src="https://www.amcharts.com/lib/3/serial.js"></script>
	<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
	<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
	<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>


	<script>
	var chart = AmCharts.makeChart("chartdiv", {
    "theme": "light",
    "type": "serial",
    "dataProvider": [{
    	<?php $dateArticle = DateTime::createFromFormat('!m', $articleMonthFirst - 4);?>
        "mois": " <?php echo $dateArticle->format('F'); ?>",
        "articles": <?php echo $articleVariables['article5'] ?>,
        "commentaires": <?php echo $commentVariables['comment5'] ?>
    }, {
    	<?php $dateArticle = DateTime::createFromFormat('!m', $articleMonthFirst - 3);?>
        "mois": " <?php echo $dateArticle->format('F'); ?>",
        "articles": <?php echo $articleVariables['article4'] ?>,
        "commentaires": <?php echo $commentVariables['comment4'] ?>
    }, {
    	<?php $dateArticle = DateTime::createFromFormat('!m', $articleMonthFirst - 2);?>
        "mois": " <?php echo $dateArticle->format('F'); ?>",
        "articles": <?php echo $articleVariables['article3'] ?>,
        "commentaires": <?php echo $commentVariables['comment3'] ?>
    }, {
    	<?php $dateArticle = DateTime::createFromFormat('!m', $articleMonthFirst - 1);?>
        "mois": " <?php echo $dateArticle->format('F'); ?>",
        "articles": <?php echo $articleVariables['article2'] ?>,
        "commentaires": <?php echo $commentVariables['comment2'] ?>
    }, {
    	<?php $dateArticle = DateTime::createFromFormat('!m', $articleMonthFirst);?>
        "mois": " <?php echo $dateArticle->format('F'); ?>",
        "articles": <?php echo $articleVariables['article1'] ?>,
        "commentaires": <?php echo $commentVariables['comment1'] ?>
    }],
    "valueAxes": [{
        "unit": "",
        "position": "left",
        "title": "Nombre",
    }],
    "startDuration": 1,
    "graphs": [{
        "balloonText": "Nombre d'articles en [[category]]: <b>[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "articles",
        "type": "column",
        "valueField": "articles"
    }, {
        "balloonText": "Nombre de commentaires en [[category]]: <b>[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "commentaires",
        "type": "column",
        "clustered":false,
        "columnWidth":0.5,
        "valueField": "commentaires"
    }],
    "plotAreaFillAlphas": 0.1,
    "categoryField": "mois",
    "categoryAxis": {
        "gridPosition": "start"
    },
    "export": {
    	"enabled": false
     }

});
</script>

	<section id="menu-verticale">
	</section>

	<section id="section-haut">
		<h3>Statistique</h3>
		<p>Nombre total d'articles:<?php echo $articleVariables['articleTotal'] ?> - Nombre total de commentaires:<?php echo $commentVariables['commentTotal'] ?></p>
		<div id="chartdiv"></div>
	</section>
  <section id="menu-verticale">

  </section>
	<section id="section-bas">
		<h3>Derniers Articles</h3>
		<?php foreach ($this->data["lastArticles"] as $article):?>
			<div class="articleDiv">
				<div>
					<p class="title"><?php echo $article['title']; ?></p>
					<a href="/admin/article/delete/<?php echo $article['id']; ?>"><i class="fa fa-trash"></i></a>
					<a href="/admin/article/show/<?php echo $article['id']; ?>"><i class="fa fa-pencil-square-o"></i></a>
					<p><?php echo substr($article['text'], 0, 140); ?> <br><a href="/admin/article/show/<?php echo $article['id']; ?>">Lire la suite</a></p>
			    </div>
			    </div>
		<?php endforeach; ?>

	</section>
	<section id="section-bas">
		<h3>Derniers Commentaires</h3>
		<?php if (count($this->data["lastComment"])!=0) {
    foreach ($this->data["lastComment"] as $comment):
        $user = new User($comment['food_user_id']);
    $article = new Article($comment['article_id']); ?>
			<div class="articleDiv">
				<div>
						<p><a href="/admin/comment/delete/<?php echo $comment['id']; ?>"><i class="fa fa-trash"></i></a>
						<a href="/admin/comment/moderate/<?php echo $comment['id']; ?>"><i class="fa fa-check"></i></a></p>
						<p><?php echo  substr($comment['text'], 0, 140); ?></p>
						<p style="font-style: italic;"><?php echo "Posté par ".$user->getUsername()." le ".$comment['utime']." sur l'article ".$article->getTitle()."."; ?></p>

			    </div>
			    </div>
		<?php endforeach;
} else {
    ?>
	<div class="articleDiv">
		<div>
		<?php echo "Il n'y a pas de commentaires à valider pour l'instant"; ?>
	</div>
	</div>
<?php
}
    ?>
     </div>

	</section>
</div>
