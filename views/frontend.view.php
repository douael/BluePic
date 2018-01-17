<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php if (isset($this->data['title'])): ?>
        <title><?php echo $this->data['title'] ?></title>
    <?php else: ?>
        <title>BluePic</title>
    <?php endif; ?>
    <meta name="description" content="description de la page">
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/fo.css">
    <script src="https://use.fontawesome.com/e97a5a7c76.js"></script>
    <script src="/assets/js/jquery.js"></script>
</head>
<body>

    <?php
    include $this->view.".view.php";
    ?>
    <script src="/assets/js/particles.js"></script>
    <script src="/assets/js/app.js"></script>
</body>
</html>
