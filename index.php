<?php
require_once('controller/controller.php');
session_start();
if(isset($_GET['logout']))
{
    logOut();
}
elseif(isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
    if(isset($_GET['ask']))
    {
        if(!empty($_POST['question']))
        {
            if(isset($_POST['ask']))
            {
                $data = array(
                    'userId' => $user->getId(),
                    'question' => $_POST['question'],
                    'published' => 1
                );
                postQuestion($data);
                questionList();
            }
            elseif(isset($_POST['save']))
            {
                $data = array(
                    'userId' => $user->getId(),
                    'question' => $_POST['question'],
                    'published' => 0
                );
                postQuestion($data);
                questionList();
            }
        }
        else
        {
            $_SESSION['warning'] = 'Enter your Question please';
            questionList();
        }
    }
    elseif(isset($_GET['reply']))
    {
        if(!empty($_POST['reply']))
        {
            $data = array(
                'reply' => $_POST['reply'],
                'userId' => $user->getId(),
                'questionId' => (int)$_GET['questionId']
            );
            postReply($data);
            questionList();
        }
        else
        {
            questionList();
        }
    }
    elseif(isset($_GET['go']))
    {
        if($_GET['go'] == 'questions')
        {
            backQuestions();
        }
    }
    elseif(isset($_GET['pub']))
    {
        $info = array(
            'id' => (int)$_GET['id'],
            'pub' => (int)$_GET['pub']
        );

        updateQuestion($info);
        $_SESSION['success'] = 'Action success !';
        backQuestions();
    }
    elseif(isset($_GET['delete']))
    {
        $id = (int) $_GET['id'];
        deleteQuestion($id);
        $_SESSION['success'] = 'Question deleted !';
        backQuestions();
    }
    else
    {
        questionList();
    }
}
elseif(isset($_GET['action']))
{
    if($_GET['action'] == 'createAccount')
    {
        if(!empty($_POST['firstName']) AND !empty($_POST['surname']) AND !empty($_POST['emailAddress']) AND !empty($_POST['password']))
        {
            $data = array(
                'firstName' => $_POST['firstName'],
                'surname' => $_POST['surname'],
                'emailAddress' => $_POST['emailAddress'],
                'password' => $_POST['password']
            );
            createUser($data);
        }
        else
        {
            $_SESSION['warning'] = 'The form is not correctly filled !';
            header('location: index.php');
            exit();
        }
    }
    elseif($_GET['action'] == 'login')
    {
        if(!empty($_POST['emailAddress']) AND !empty($_POST['password']))
        {
            $data = array(
                'emailAddress' => $_POST['emailAddress'],
                'password' => $_POST['password']
            );
            logIn($data);
        }
        else
        {
            $_SESSION['warning'] = 'The form is not correctly filled !';
            header('location: index.php');
            exit();
        }

    }
}
else
{
    logInView();
}




