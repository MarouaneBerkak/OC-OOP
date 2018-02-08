<?php
use Ask\QuestionManager;
use Ask\ReplyManager;
?>
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
    <?php
    $questionManager = new QuestionManager();
    $replyManager = new ReplyManager();

    $publishedQuestions = $questionManager->countPubQuestions($user);
    $unpublishedQuestions = $questionManager->countUnpubQuestions($user);
    $questions = $questionManager->countQuestions($user);
    $answerQuestions = $replyManager->countAnsweredQuestions($user);

    ?>
    <div class="col-xs-8">
        <div class="row">
            <div class="col-xs-4">
                <div class="panel panel-primary shadowBoxPanel">
                    <div class="panel-heading" align="center"><h4>Published questions</h4></div>
                    <div class="panel-body" align="center"><h4><?= $publishedQuestions ?></h4></div>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="panel panel-warning shadowBoxPanel">
                    <div class="panel-heading" align="center"><h4>Unpublished questions</h4></div>
                    <div class="panel-body" align="center"><h4><?= $unpublishedQuestions ?></h4></div>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="panel panel-success shadowBoxPanel">
                    <div class="panel-heading" align="center"><h4>Answered questions</h4></div>
                    <div class="panel-body" align="center"><h4><?= $answerQuestions ?></h4></div>
                </div>
            </div>
        </div>
        <div class="row myQuestions">
            <?= $content ?>
        </div>
    </div>
    <div class="panel-group col-xs-4">
        <div class="panel panel-primary shadowBoxPanel">
            <div class="panel-heading" align="center"><h4>Hello <?= htmlspecialchars(ucfirst($user->getFirstName())) ?></h4></div>
            <div class="panel-body" align="center"><img src="public/img/profile.png" alt="profile"></div>
            <div class="panel-body" align="center"><a href="">My questions </a><kbd><?= $questions ?></kbd></div>
            <div class="panel-body" align="center"><a href="index.php" class="btn btn-primary">Get Back to the wall</a></div>
            <div class="panel-body" align="center"><a href="index.php?logout=1" class="btn btn-danger">Log out</a></div>
        </div>
    </div>
</div>
<script src="public/bootstrap/js/jquery.min.js"></script>
<script src="public/bootstrap/js//bootstrap.min.js"></script>
</body>
</html>