<?php

use Ask\QuestionManager;

if(isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
}
$title = 'Hello '.htmlspecialchars(ucfirst($user->getFirstName()));

ob_start();

$questionManager = new QuestionManager();
$publishedQuestions = $questionManager->countPubQuestions($user);
$unpublishedQuestions = $questionManager->countUnpubQuestions($user);
?>
<h2>My published questions</h2>
<hr>
<?php
if($publishedQuestions == 0)
{
    echo 'No questions';
}
else
{
    ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="col-xs-9">Question</th>
            <th class="col-xs-3">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $req = $questionManager->readUserPubQuestions($user);
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            ?>
            <tr>
                <td class="col-xs-9"><?= htmlspecialchars($data['question']) ?></td>
                <td class="col-xs-3"><a href="index?pub=0&id=<?= $data['id'] ?>" class="btn btn-info">Unpublish</a>
                    <a href="index?delete=1&id=<?= $data['id'] ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}
?>

<h2>My unpublished questions</h2>
<hr>
<?php
if($unpublishedQuestions == 0)
{
    echo 'No questions';
}
else
{
    ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="col-xs-9">Question</th>
            <th class="col-xs-3">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $req = $questionManager->readUserUnpubQuestions($user);
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            ?>
            <tr>
                <td class="col-xs-9"><?= htmlspecialchars($data['question']) ?></td>
                <td class="col-xs-3"><a href="index?pub=1&id=<?= $data['id'] ?>" class="btn btn-info">Publish</a>
                    <a href="index?delete=1&id=<?= $data['id'] ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}
?>

<?php
$content = ob_get_clean();
require('view/templateBack.php');
?>