<?php

use Ask\QuestionManager;
use Ask\ReplyManager;

if(isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
}

$title = 'Hello '.htmlspecialchars(ucfirst($user->getFirstName()));
ob_start();
$questionManager = new QuestionManager();
$questions = $questionManager->countQuestions($user);
?>

<div class="col-xs-8">
    <h1>Wall</h1>
    <hr>
    <form action="index?ask=1&amp;userId=<?= $user->getId() ?>" method="POST">
        <div class="form-group">
            <label for="question">Ask your question</label>
            <input type="text" name="question" class="form-control" id="question">
        </div>
        <input type="submit" name="ask" class="btn btn-primary" value="Ask">
        <input type="submit" name="save" class="btn btn-warning" value="Save for another time">
    </form>
    
    <div>
        <?php
        $questionManager = new QuestionManager();
        $question = $questionManager->read();
        while($data = $question->fetch(PDO::FETCH_ASSOC))
        {
            ?>
            <h3><?= htmlspecialchars($data['question']) ?></h3>
            <p><img src="public/img/smallProfile.png" alt="profile">
                <span class="small">Asked by <strong><?= htmlspecialchars($data['firstName']) ?> <?=  htmlspecialchars($data['surname']) ?></strong> - <?= $data['date'] ?></span></p>
            <form action="index?reply=reply&amp;userId=<?= $user->getId() ?>&amp;questionId=<?= $data['id'] ?>" method="POST">
                <div class="form-group">
                    <input type="text" name="reply" class="form-control" placeholder="Type your answer">
                </div>
                <input type="submit" class="btn btn-primary" value="Answer">
            </form>
            <?php
            $replyManager = new ReplyManager();
            $reply = $replyManager->read($data['id']);
            while($data = $reply->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <div class="reply">
                    <p><span class="small"><strong><?= htmlspecialchars($data['firstName']) ?> <?=  htmlspecialchars($data['surname']) ?></strong> - <?= $data['date'] ?></span></p>
                    <p><?= htmlspecialchars($data['reply']) ?></p>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>

<div class="panel-group col-xs-4">
    <div class="panel panel-primary shadowBoxPanel">
        <div class="panel-heading"><h4>Hello <?= htmlspecialchars(ucfirst($user->getFirstName())); ?></h4></div>
        <div class="panel-body" align="center"><img src="public/img/profile.png" alt="profile"></div>
        <div class="panel-body" align="center"><a href="index.php?go=questions">My questions </a><kbd><?= $questions ?></kbd></div>
        <div class="panel-body" align="center"><a href="index.php?logout=1" class="btn btn-danger">Log out</a></div>
    </div>
</div>
<?php
$content = ob_get_clean();
require('view/templateFront.php');
?>