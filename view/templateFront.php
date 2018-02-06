<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="public/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<div class="headerBar">
    <div class="container">
        <h3>ASK YOUR QUESTIONS</h3>
        <p>A small Q&A project to practice POO.</p>
    </div>
</div>
<div class="container">
    <?php
    if(isset($_SESSION['warning']))
    {
    ?>
    <div class="alert alert-warning alert-dismissable fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning! </strong> <?= $_SESSION['warning'] ?>
    </div>
        <?php
        unset($_SESSION['warning']);
    }
    elseif(isset($_SESSION['success']))
    {
        ?>
        <div class="alert alert-success alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success! </strong> <?= $_SESSION['success'] ?>
        </div>
        <?php
        unset($_SESSION['success']);
    }
    ?>
<?= $content ?>
</div>
<script src="public/bootstrap/js/jquery.min.js"></script>
<script src="public/bootstrap/js//bootstrap.min.js"></script>
</body>
</html>