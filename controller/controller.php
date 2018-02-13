<?php

use Ask\App\Reply;
use Ask\App\User;
use Ask\App\Question;
use Ask\QuestionManager;
use Ask\ReplyManager;
use Ask\UserManager;

require('vendor/autoload.php');

function logInView()
{
    require('view/frontend/logInView.php');
}
function logOut()
{
    session_destroy();
    header('location: index.php');
}
function createUser(array $data)
{
    $userManager = new UserManager();
    if($userManager->exists($data['emailAddress']))
    {
        $_SESSION['warning'] = 'Email address already used !';
        header('location: index.php');
        exit();
    }
    else
    {
        $user = new User($data);
        $userManager->create($user);
        $_SESSION['success'] = 'Account successfuly created !';
        $_SESSION['user'] = $user;
        require('view/frontend/questionListView.php');
    }
}
function logIn(array $data)
{
    $userManager = new UserManager();
    if($userManager->exists($data['emailAddress']))
    {
        $user = $userManager->read($data['emailAddress']);
        if($user->getPassword() != $data['password'])
        {
            $_SESSION['warning'] = 'Wrong password!';
            header('location: index.php');
        }
        else
        {
            $_SESSION['success'] = 'You are logged in';
            $_SESSION['user'] = $user;
            require('view/frontend/questionListView.php');
        }
    }
    else
    {
        $_SESSION['warning'] = 'This email address does not correspond to any user';
        header('location: index.php');
    }
}
function questionList()
{
    require('view/frontend/questionListView.php');
}
function postQuestion(array $data)
{
    $questionManager = new QuestionManager();
    $question = new Question($data);
    
    if($questionManager->exists($question))
    {
        $_SESSION['warning'] = 'This question already exists';
    }
    else
    {
        $questionManager->create($question);
        $_SESSION['success'] = 'Your question is successfuly published';
    }
}
function postReply(array $data)
{
    $replyManager = new ReplyManager();
    $reply = new Reply($data);
    $last = $replyManager->last($data['questionId']);
    if($last['userId'] != $reply->getUserId() OR $last['reply'] != $reply->getReply())
    {
        $replyManager->create($reply);
        $_SESSION['success'] = 'Your reply is successfully posted';
    }
}
function backQuestions()
{
    require('view/backend/myQuestionsView.php');
}
function updateQuestion(array $info)
{
    $questionManager = new QuestionManager();
    return $questionManager->update($info);
}
function deleteQuestion(int $id)
{
    $questionManager = new QuestionManager();
    return $questionManager->delete($id);
}
